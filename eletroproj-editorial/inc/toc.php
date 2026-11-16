<?php
/**
 * Sumário automático: adiciona âncoras aos H2/H3 do artigo e monta a lista.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Itens do sumário da requisição atual.
 *
 * @var array
 */
$GLOBALS['eletroproj_toc_items'] = array();

/**
 * Gera um id único a partir do texto do título.
 *
 * @param string $text Texto.
 * @param array  $used IDs já usados.
 * @return string
 */
function eletroproj_toc_slug( $text, array &$used ) {
	$slug = sanitize_title( $text );
	if ( '' === $slug ) {
		$slug = 'secao';
	}
	$base = $slug;
	$i    = 2;
	while ( in_array( $slug, $used, true ) ) {
		$slug = $base . '-' . $i;
		++$i;
	}
	$used[] = $slug;
	return $slug;
}

/**
 * Filtro do conteúdo: põe id nos H2/H3 que não têm e guarda os itens.
 *
 * @param string $content HTML.
 * @return string
 */
function eletroproj_toc_filter( $content ) {
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$used  = array();
	$items = array();

	$content = preg_replace_callback(
		'#<h([23])([^>]*)>(.*?)</h\1>#is',
		function ( $m ) use ( &$used, &$items ) {
			$level = (int) $m[1];
			$attrs = $m[2];
			$text  = trim( wp_strip_all_tags( $m[3] ) );
			if ( '' === $text ) {
				return $m[0];
			}
			if ( preg_match( '/\sid=("|\')([^"\']+)\1/i', $attrs, $idm ) ) {
				$id     = $idm[2];
				$used[] = $id;
			} else {
				$id     = eletroproj_toc_slug( $text, $used );
				$attrs .= ' id="' . esc_attr( $id ) . '"';
			}
			$items[] = array(
				'level' => $level,
				'id'    => $id,
				'text'  => $text,
			);
			return '<h' . $level . $attrs . '>' . $m[3] . '</h' . $level . '>';
		},
		$content
	);

	$GLOBALS['eletroproj_toc_items'] = $items;
	return $content;
}
add_filter( 'the_content', 'eletroproj_toc_filter', 20 );

/**
 * Pré-calcula o sumário antes de exibir (para poder mostrá-lo acima do texto).
 *
 * @return array
 */
function eletroproj_toc_items() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$html    = do_blocks( $content );
	$items   = array();
	$used    = array();
	if ( preg_match_all( '#<h([23])([^>]*)>(.*?)</h\1>#is', $html, $all, PREG_SET_ORDER ) ) {
		foreach ( $all as $m ) {
			$text = trim( wp_strip_all_tags( $m[3] ) );
			if ( '' === $text ) {
				continue;
			}
			if ( preg_match( '/\sid=("|\')([^"\']+)\1/i', $m[2], $idm ) ) {
				$id     = $idm[2];
				$used[] = $id;
			} else {
				$id = eletroproj_toc_slug( $text, $used );
			}
			$items[] = array(
				'level' => (int) $m[1],
				'id'    => $id,
				'text'  => $text,
			);
		}
	}
	return $items;
}

/**
 * Mostra o sumário (só se houver 3 ou mais seções e se estiver ativado).
 */
function eletroproj_the_toc() {
	if ( ! get_theme_mod( 'eletroproj_mostrar_sumario', true ) ) {
		return;
	}
	$items = eletroproj_toc_items();
	$h2    = array_filter(
		$items,
		function ( $i ) {
			return 2 === $i['level'];
		}
	);
	if ( count( $h2 ) < 3 ) {
		return;
	}
	echo '<details class="toc" open><summary class="toc__title">' . esc_html__( 'Neste artigo', 'eletroproj' ) . '</summary><ol class="toc__list">';
	foreach ( $items as $item ) {
		printf(
			'<li class="toc__item toc__item--h%1$d"><a href="#%2$s">%3$s</a></li>',
			(int) $item['level'],
			esc_attr( $item['id'] ),
			esc_html( $item['text'] )
		);
	}
	echo '</ol></details>';
}
