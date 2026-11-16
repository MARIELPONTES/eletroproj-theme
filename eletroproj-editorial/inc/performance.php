<?php
/**
 * Ajustes de performance (PageSpeed).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

// Remove o script e o CSS de emojis (o navegador já mostra emojis nativos).
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter(
	'emoji_svg_url',
	'__return_false'
);

// Limpa o <head>.
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Carrega o CSS dos blocos só para os blocos usados na página.
 */
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

// A prioridade da primeira imagem (fetchpriority/lazy-load) já é tratada pelo próprio WordPress 6.3+.
