<?php
/**
 * Funções de apoio usadas nos templates.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Ícones SVG inline (sem requisições extras).
 *
 * @param string $name Nome do ícone.
 * @param int    $size Tamanho em px.
 * @return string
 */
function eletroproj_icon( $name, $size = 20 ) {
	$paths = array(
		'busca'      => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4.3-4.3"/>',
		'menu'       => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'fechar'     => '<path d="M6 6l12 12M18 6 6 18"/>',
		'relogio'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'pasta'      => '<path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>',
		'compartilhar' => '<circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4"/>',
		'raio'       => '<path d="M13 2 4 14h7l-1 8 9-12h-7z"/>',
		'escudo'     => '<path d="M12 3 4 6v6c0 5 3.4 8.4 8 9 4.6-.6 8-4 8-9V6z"/><path d="m13 8-3 5h4l-3 4"/>',
		'livro'      => '<path d="M4 5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2z"/><path d="M4 19V5M8 7h7"/>',
		'calculadora' => '<rect x="5" y="2.5" width="14" height="19" rx="2"/><path d="M8 6.5h8M8.5 11h.01M12 11h.01M15.5 11h.01M8.5 14.5h.01M12 14.5h.01M15.5 14.5h.01M8.5 18h.01M12 18h3.5"/>',
		'documento'  => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5M9 13h6M9 17h6"/>',
		'chip'       => '<rect x="6" y="6" width="12" height="12" rx="2"/><path d="M9 2v4M15 2v4M9 18v4M15 18v4M2 9h4M2 15h4M18 9h4M18 15h4"/>',
		'sol'        => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
		'lua'        => '<path d="M20 14.5A8 8 0 0 1 9.5 4a8 8 0 1 0 10.5 10.5z"/>',
		'seta'       => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'topo'       => '<path d="M12 19V5M6 11l6-6 6 6"/>',
		'email'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'instagram'  => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
		'youtube'    => '<rect x="2.5" y="5.5" width="19" height="13" rx="4"/><path d="m10 9 5 3-5 3z"/>',
		'linkedin'   => '<rect x="3" y="3" width="18" height="18" rx="3"/><path d="M8 10v7M8 7v.01M12 17v-4a2 2 0 0 1 4 0v4M12 10v7"/>',
		'whatsapp'   => '<path d="M4 20l1.3-3.9A8 8 0 1 1 8 19z"/><path d="M9 9.5c.5 2 2 3.5 4 4l1-1 2 1c0 1-1 2-2 2-3 0-6.5-3.5-6.5-6.5 0-1 1-2 2-2l1 2z"/>',
		'link'       => '<path d="M10 14a4 4 0 0 0 5.7 0l3-3a4 4 0 0 0-5.7-5.7l-1 1"/><path d="M14 10a4 4 0 0 0-5.7 0l-3 3a4 4 0 0 0 5.7 5.7l1-1"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="icon icon--%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		(int) $size,
		$paths[ $name ]
	);
}

/**
 * Imagem inclinada do card: imagem de destaque ou, na falta dela, avatar do autor.
 *
 * @param string $size  Tamanho registrado.
 * @param string $class Classe extra.
 */
function eletroproj_tilted_media( $size = 'eletroproj-card', $class = '' ) {
	$classes = trim( 'tilted ' . $class );
	echo '<a class="' . esc_attr( $classes ) . '" href="' . esc_url( get_permalink() ) . '" tabindex="-1" aria-hidden="true">';
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size, array( 'alt' => '' ) );
	} else {
		$px = ( 'eletroproj-thumb' === $size ) ? 160 : 320;
		echo get_avatar( get_the_author_meta( 'ID' ), $px, '', '', array( 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</a>';
}

/**
 * Lista de categorias com links, separadas por vírgula.
 *
 * @return string
 */
function eletroproj_category_links() {
	$cats = get_the_category();
	if ( empty( $cats ) ) {
		return '';
	}
	$out = array();
	foreach ( $cats as $cat ) {
		$out[] = '<a href="' . esc_url( get_category_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
	}
	return implode( ', ', $out );
}

/**
 * Linha "Fulano escreveu" usada nos cards.
 */
function eletroproj_author_wrote() {
	printf(
		'<span class="byline"><a class="byline__author" href="%1$s">%2$s</a> <em>%3$s</em></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_html( get_the_author() ),
		esc_html__( 'escreveu', 'eletroproj' )
	);
}

/**
 * Data + categorias ("12 nov 2026 em SPDA, Normas").
 */
function eletroproj_date_and_cats() {
	$cats = eletroproj_category_links();
	echo '<span class="meta-line">';
	printf(
		'<time class="meta-line__date" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date( 'j M Y' ) )
	);
	if ( $cats ) {
		echo ' <em>' . esc_html__( 'em', 'eletroproj' ) . '</em> <span class="meta-line__cats">' . wp_kses_post( $cats ) . '</span>';
	}
	echo '</span>';
}

/**
 * Paginação numerada acessível.
 */
function eletroproj_pagination() {
	$links = paginate_links(
		array(
			'type'      => 'list',
			'mid_size'  => 1,
			'prev_text' => '← ' . __( 'Anteriores', 'eletroproj' ),
			'next_text' => __( 'Próximos', 'eletroproj' ) . ' →',
		)
	);
	if ( $links ) {
		echo '<nav class="pagination" aria-label="' . esc_attr__( 'Paginação', 'eletroproj' ) . '">' . wp_kses_post( $links ) . '</nav>';
	}
}

/**
 * Links de compartilhamento (sem scripts de terceiros).
 */
function eletroproj_share_links() {
	$url   = rawurlencode( get_permalink() );
	$title = rawurlencode( get_the_title() );
	$links = array(
		'whatsapp' => array( 'WhatsApp', 'https://wa.me/?text=' . $title . '%20' . $url ),
		'linkedin' => array( 'LinkedIn', 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url ),
	);
	echo '<span class="share">';
	echo eletroproj_icon( 'compartilhar', 16 ) . ' <span>' . esc_html__( 'Compartilhar:', 'eletroproj' ) . '</span> '; // phpcs:ignore WordPress.Security.EscapeOutput
	$parts = array();
	foreach ( $links as $key => $data ) {
		$parts[] = sprintf(
			'<a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a>',
			esc_url( $data[1] ),
			esc_html( $data[0] )
		);
	}
	$parts[] = '<button type="button" class="share__copy" data-copy-link="' . esc_url( get_permalink() ) . '">' . esc_html__( 'copiar link', 'eletroproj' ) . '</button>';
	echo implode( ', ', $parts ); // phpcs:ignore WordPress.Security.EscapeOutput
	echo '</span>';
}

/**
 * Posts relacionados (mesma categoria).
 *
 * @param int $count Quantidade.
 * @return WP_Query|null
 */
function eletroproj_related_query( $count = 3 ) {
	$cats = wp_get_post_categories( get_the_ID() );
	if ( empty( $cats ) ) {
		return null;
	}
	$q = new WP_Query(
		array(
			'category__in'        => $cats,
			'post__not_in'        => array( get_the_ID() ),
			'posts_per_page'      => $count,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	return $q->have_posts() ? $q : null;
}

/**
 * Breadcrumbs simples: Início › Categoria › Artigo.
 */
function eletroproj_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Você está aqui', 'eletroproj' ) . '">', '</nav>' );
		return;
	}
	$items   = array();
	$items[] = '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Início', 'eletroproj' ) . '</a>';
	if ( is_singular( 'post' ) ) {
		$cats = get_the_category();
		if ( ! empty( $cats ) ) {
			$items[] = '<a href="' . esc_url( get_category_link( $cats[0] ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
		}
	} elseif ( is_category() ) {
		$items[] = '<span aria-current="page">' . esc_html( single_cat_title( '', false ) ) . '</span>';
	} elseif ( is_search() ) {
		$items[] = '<span aria-current="page">' . esc_html__( 'Busca', 'eletroproj' ) . '</span>';
	} elseif ( is_page() ) {
		$items[] = '<span aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	}
	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Você está aqui', 'eletroproj' ) . '"><ol><li>' . implode( '</li><li>', $items ) . '</li></ol></nav>'; // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Faixa de categorias abaixo do menu.
 *
 * Prioridade: categorias marcadas no Personalizador → menu "Faixa de categorias" → categorias com mais artigos.
 */
function eletroproj_topics_bar() {
	if ( ! eletroproj_mod( 'faixa_mostrar' ) ) {
		return;
	}
	$ids = array_filter( array_map( 'absint', explode( ',', (string) eletroproj_mod( 'faixa_categorias' ) ) ) );

	ob_start();
	if ( $ids ) {
		$ordem = eletroproj_mod( 'faixa_ordem' );
		$args  = array(
			'include'    => $ids,
			'hide_empty' => false,
		);
		if ( 'nome' === $ordem ) {
			$args['orderby'] = 'name';
		} elseif ( 'quantidade' === $ordem ) {
			$args['orderby'] = 'count';
			$args['order']   = 'DESC';
		} else {
			$args['orderby'] = 'include';
		}
		eletroproj_render_category_pills( get_categories( $args ) );
	} else {
		wp_nav_menu(
			array(
				'theme_location' => 'categorias',
				'container'      => false,
				'menu_class'     => 'pills',
				'depth'          => 1,
				'fallback_cb'    => 'eletroproj_categories_fallback',
			)
		);
	}
	$html = trim( ob_get_clean() );
	if ( '' === $html ) {
		return;
	}
	echo '<nav class="topics-bar" aria-label="' . esc_attr__( 'Categorias', 'eletroproj' ) . '"><div class="container">' . $html . '</div></nav>'; // phpcs:ignore WordPress.Security.EscapeOutput
}

/**
 * Imprime a lista de categorias no formato de "pílulas".
 *
 * @param WP_Term[] $cats Categorias.
 */
function eletroproj_render_category_pills( $cats ) {
	if ( empty( $cats ) || is_wp_error( $cats ) ) {
		return;
	}
	echo '<ul class="pills">';
	$current = is_category() ? get_queried_object_id() : 0;
	foreach ( $cats as $cat ) {
		$is_current = ( $current === $cat->term_id );
		echo '<li' . ( $is_current ? ' class="current-cat"' : '' ) . '><a href="' . esc_url( get_category_link( $cat ) ) . '"' . ( $is_current ? ' aria-current="page"' : '' ) . '>' . esc_html( $cat->name ) . '</a></li>'; // phpcs:ignore WordPress.Security.EscapeOutput
	}
	echo '</ul>';
}

/**
 * Menu de fallback quando o usuário ainda não criou o menu de categorias.
 */
function eletroproj_categories_fallback() {
	$cats = get_categories(
		array(
			'orderby' => 'count',
			'order'   => 'DESC',
			'number'  => 16,
		)
	);
	eletroproj_render_category_pills( $cats );
}

/**
 * Fallback do menu principal.
 */
function eletroproj_primary_fallback() {
	echo '<ul class="primary-nav__list">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Artigos', 'eletroproj' ) . '</a></li>';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
			'number'   => 5,
		)
	);
	echo '</ul>';
}

/**
 * Destaca o termo buscado no título e no resumo dos resultados de busca.
 *
 * @param string $text Texto.
 * @return string
 */
function eletroproj_highlight_search( $text ) {
	if ( is_admin() || ! is_search() || ! in_the_loop() ) {
		return $text;
	}
	$term = trim( get_search_query( false ) );
	if ( mb_strlen( $term ) < 3 ) {
		return $text;
	}
	$pattern = '/(' . preg_quote( esc_html( $term ), '/' ) . ')(?![^<]*>)/iu';
	return preg_replace( $pattern, '<mark>$1</mark>', $text );
}
add_filter( 'the_title', 'eletroproj_highlight_search' );
add_filter( 'get_the_excerpt', 'eletroproj_highlight_search', 20 );
