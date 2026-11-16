<?php
/**
 * Configuração do tema: suportes, menus, tamanhos de imagem, widgets.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registra os recursos do tema.
 */
function eletroproj_setup() {
	load_theme_textdomain( 'eletroproj', ELETROPROJ_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 96,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'assets/css/editor.css' );

	// Miniatura inclinada (cards) e imagem de destaque do artigo.
	add_image_size( 'eletroproj-card', 320, 320, true );
	add_image_size( 'eletroproj-thumb', 160, 160, true );

	register_nav_menus(
		array(
			'principal'  => __( 'Menu principal (cabeçalho)', 'eletroproj' ),
			'categorias' => __( 'Faixa de categorias', 'eletroproj' ),
			'rodape'     => __( 'Links do rodapé', 'eletroproj' ),
		)
	);
}
add_action( 'after_setup_theme', 'eletroproj_setup' );

/**
 * Largura de conteúdo para embeds.
 */
function eletroproj_content_width() {
	$GLOBALS['content_width'] = 680;
}
add_action( 'after_setup_theme', 'eletroproj_content_width', 0 );

/**
 * Áreas de widgets.
 */
function eletroproj_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Lateral do artigo', 'eletroproj' ),
			'id'            => 'lateral-artigo',
			'description'   => __( 'Aparece na lateral dos artigos, abaixo da caixa do autor e da newsletter.', 'eletroproj' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget__title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'eletroproj_widgets_init' );

/**
 * Resumo mais curto e com "…" simples.
 */
add_filter(
	'excerpt_length',
	function () {
		return 34;
	}
);
add_filter(
	'excerpt_more',
	function () {
		return '…';
	}
);

/**
 * Remove o prefixo "Categoria:"/"Tag:" do título dos arquivos (o tema já mostra o tipo acima do título).
 */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
