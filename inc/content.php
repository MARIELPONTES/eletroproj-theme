<?php
/**
 * Utilidades de conteúdo: tempo de leitura, categoria principal, iniciais,
 * ids nos títulos e sumário automático (H2/H3).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Minutos de leitura (200 palavras/min, mínimo 1).
 *
 * @param int|WP_Post|null $post Post.
 */
function ep_reading_time( $post = null ): int {
	$post = get_post( $post );
	if ( ! $post ) {
		return 1;
	}
	$words = str_word_count( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 0, 'ÀÁÂÃÇÉÊÍÓÔÕÚàáâãçéêíóôõú' );
	return max( 1, (int) round( $words / 200 ) );
}

/**
 * Categoria principal (a do Rank Math, se definida; senão a primeira).
 *
 * @param int|WP_Post|null $post Post.
 */
function ep_primary_category( $post = null ): ?WP_Term {
	$post = get_post( $post );
	if ( ! $post ) {
		return null;
	}
	$primary = (int) get_post_meta( $post->ID, 'rank_math_primary_category', true );
	if ( $primary ) {
		$term = get_term( $primary, 'category' );
		if ( $term instanceof WP_Term ) {
			return $term;
		}
	}
	$cats = get_the_category( $post->ID );
	return $cats ? $cats[0] : null;
}

/**
 * Iniciais de um nome ("Mariel Pontes" → "MP").
 *
 * @param string $name Nome.
 */
function ep_initials( string $name ): string {
	$parts = preg_split( '/\s+/', trim( preg_replace( '/^(eng\.?|dr\.?|prof\.?)\s+/i', '', $name ) ) );
	$first = $parts ? mb_substr( $parts[0], 0, 1 ) : '';
	$last  = count( $parts ) > 1 ? mb_substr( end( $parts ), 0, 1 ) : '';
	return mb_strtoupper( $first . $last );
}

/**
 * Data no formato do Figma: "18 jun. 2025".
 *
 * @param int|WP_Post|null $post     Post.
 * @param bool             $modified Usar data de atualização.
 */
function ep_date( $post = null, bool $modified = false ): string {
	$ts = $modified ? get_post_modified_time( 'U', true, $post ) : get_post_time( 'U', true, $post );
	return wp_date( 'j M. Y', (int) $ts ) ?: '';
}

/**
 * Processa o conteúdo do post: aplica os filtros do WordPress, coloca id nos H2/H3
 * que não têm e devolve o HTML + itens do sumário.
 *
 * @return array{html:string,toc:array<int,array{id:string,text:string,level:int}>}
 */
function ep_prepare_content(): array {
	$html = apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	$html = str_replace( ']]>', ']]&gt;', (string) $html );
	$toc  = array();
	$used = array();

	$html = preg_replace_callback(
		'#<h([23])(\s[^>]*)?>(.*?)</h\1>#is',
		static function ( array $m ) use ( &$toc, &$used ): string {
			$level = (int) $m[1];
			$attrs = $m[2] ?? '';
			$text  = trim( wp_strip_all_tags( $m[3] ) );
			if ( '' === $text ) {
				return $m[0];
			}
			if ( preg_match( '/\sid=(["\'])(.*?)\1/i', $attrs, $idm ) ) {
				$id = $idm[2];
			} else {
				$base = sanitize_title( $text ) ?: 'secao';
				$id   = $base;
				$n    = 2;
				while ( isset( $used[ $id ] ) ) {
					$id = $base . '-' . $n++;
				}
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}
			$used[ $id ] = true;
			$toc[]       = array(
				'id'    => $id,
				'text'  => $text,
				'level' => $level,
			);
			return '<h' . $level . $attrs . '>' . $m[3] . '</h' . $level . '>';
		},
		$html
	) ?? $html;

	return array(
		'html' => $html,
		'toc'  => $toc,
	);
}

/**
 * Posts relacionados: mesma categoria principal, mais recentes, sem o atual.
 *
 * @param int $count Quantidade.
 * @return WP_Post[]
 */
function ep_related_posts( int $count = 3 ): array {
	$cat   = ep_primary_category();
	$args  = array(
		'post__not_in'        => array( get_the_ID() ),
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
	if ( $cat ) {
		$args['cat'] = $cat->term_id;
	}
	$posts = get_posts( $args );
	if ( count( $posts ) < $count ) {
		$more  = get_posts(
			array(
				'post__not_in'        => array_merge( array( get_the_ID() ), wp_list_pluck( $posts, 'ID' ) ),
				'posts_per_page'      => $count - count( $posts ),
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		$posts = array_merge( $posts, $more );
	}
	return $posts;
}

/**
 * Trecho limpo (resumo manual ou começo do texto).
 *
 * @param int|WP_Post|null $post  Post.
 * @param int              $words Palavras.
 */
function ep_excerpt( $post = null, int $words = 22 ): string {
	$post = get_post( $post );
	if ( ! $post ) {
		return '';
	}
	$text = has_excerpt( $post ) ? $post->post_excerpt : strip_shortcodes( $post->post_content );
	return wp_trim_words( wp_strip_all_tags( $text ), $words, '…' );
}

/**
 * Breadcrumb visual (o JSON-LD fica com o Rank Math).
 *
 * @param array<int,array{0:string,1:string}> $items Pares [texto, url] depois de "Início". Último sem link.
 */
function ep_breadcrumb( array $items ): void {
	echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Você está em', 'eletroproj' ) . '"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Início', 'eletroproj' ) . '</a>';
	$last = count( $items ) - 1;
	foreach ( $items as $i => list( $text, $url ) ) {
		ep_icon( 'chevron-right', 14 );
		if ( $i === $last || '' === $url ) {
			echo '<span' . ( $i === $last ? ' aria-current="page"' : '' ) . '>' . esc_html( $text ) . '</span>';
		} else {
			echo '<a href="' . esc_url( $url ) . '">' . esc_html( $text ) . '</a>';
		}
	}
	echo '</nav>';
}

/**
 * Link de "Ver todos os guias": opção do Personalizar ou a página de posts.
 */
function ep_guides_url(): string {
	$url = (string) ep_opt( 'ep_guides_url' );
	if ( $url ) {
		return $url;
	}
	$blog = (int) get_option( 'page_for_posts' );
	return $blog ? (string) get_permalink( $blog ) : home_url( '/' );
}

/**
 * Um comentário (sem Gravatar: evita requisição externa; usa iniciais como no Figma).
 *
 * @param WP_Comment $comment Comentário.
 * @param array      $args    Argumentos.
 * @param int        $depth   Nível.
 */
function ep_comment( $comment, $args, $depth ): void {
	$name = get_comment_author( $comment );
	?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
		<article class="comment-card">
			<header>
				<div class="ep-avatar" aria-hidden="true"><?php echo esc_html( ep_initials( $name ) ); ?></div>
				<div>
					<strong><?php echo esc_html( $name ); ?></strong>
					<time datetime="<?php comment_time( 'c' ); ?>"><?php echo esc_html( get_comment_date( 'j M. Y', $comment ) ); ?></time>
				</div>
			</header>
			<?php if ( '0' === (string) $comment->comment_approved ) : ?>
				<p class="comment-awaiting"><?php esc_html_e( 'Seu comentário aguarda moderação.', 'eletroproj' ); ?></p>
			<?php endif; ?>
			<div class="comment-text"><?php comment_text(); ?></div>
			<?php
			comment_reply_link(
				array_merge(
					$args,
					array(
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="comment-reply">',
						'after'     => '</div>',
					)
				)
			);
			?>
		</article>
	<?php
	// O </li> é fechado pelo walker.
}
