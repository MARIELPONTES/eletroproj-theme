<?php
/**
 * Configuração básica do tema: suportes, menus e largura do conteúdo.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Suportes do tema e menus.
 */
function ep_setup(): void {
	load_theme_textdomain( 'eletroproj', EP_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	// O tema não usa os padrões de bloco remotos do WordPress.org (evita requisições no editor).
	remove_theme_support( 'core-block-patterns' );

	register_nav_menus(
		array(
			'primary'         => __( 'Menu principal', 'eletroproj' ),
			'footer-conteudo' => __( 'Rodapé — Conteúdo', 'eletroproj' ),
			'footer-empresa'  => __( 'Rodapé — Empresa', 'eletroproj' ),
		)
	);
}
add_action( 'after_setup_theme', 'ep_setup' );

/**
 * Largura do texto do post (Figma: 740px).
 */
function ep_content_width(): void {
	$GLOBALS['content_width'] = 740; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}
add_action( 'after_setup_theme', 'ep_content_width', 0 );

// Não buscar padrões no diretório remoto.
add_filter( 'should_load_remote_block_patterns', '__return_false' );
