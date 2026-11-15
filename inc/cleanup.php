<?php
/**
 * Limpeza do front-end: tudo o que o WordPress carrega por padrão e o tema não usa.
 *
 * Só afeta o site público; o painel continua igual.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/*
 * 1. Emojis (script + CSS + dns-prefetch para s.w.org).
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'emoji_svg_url', '__return_false' );
add_filter(
	'tiny_mce_plugins',
	static fn( $plugins ) => is_array( $plugins ) ? array_diff( $plugins, array( 'wpemoji' ) ) : array()
);

/*
 * 2. oEmbed: o site não precisa anunciar a si mesmo para ser incorporado em outros sites.
 *    (Incorporar vídeos do YouTube nos posts continua funcionando.)
 */
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );

/*
 * 3. Links desnecessários no <head>.
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

/*
 * 4. CSS de blocos e "global styles": o tema estiliza os blocos que usa no próprio CSS.
 *    Com a carga separada desligada, todo o CSS de blocos do núcleo vira um único
 *    handle (wp-block-library), que é removido abaixo.
 */
add_filter( 'should_load_separate_core_block_assets', '__return_false' );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Remove estilos e scripts do núcleo que o visitante não precisa.
 */
function ep_dequeue_core_assets(): void {
	if ( is_admin() ) {
		return;
	}

	foreach ( array( 'wp-block-library', 'wp-block-library-theme', 'classic-theme-styles', 'global-styles' ) as $handle ) {
		wp_dequeue_style( $handle );
	}

	wp_dequeue_script( 'wp-embed' );

	if ( ! is_user_logged_in() ) {
		wp_dequeue_style( 'dashicons' );
	}
}
add_action( 'wp_enqueue_scripts', 'ep_dequeue_core_assets', 100 );

/**
 * Verifica se algum script da fila depende (direta ou indiretamente) do jQuery.
 *
 * @param WP_Scripts $scripts Registro de scripts.
 * @param string     $handle  Handle a verificar.
 * @param array      $seen    Handles já visitados.
 */
function ep_script_needs_jquery( WP_Scripts $scripts, string $handle, array &$seen = array() ): bool {
	if ( isset( $seen[ $handle ] ) || ! isset( $scripts->registered[ $handle ] ) ) {
		return false;
	}
	$seen[ $handle ] = true;

	foreach ( (array) $scripts->registered[ $handle ]->deps as $dep ) {
		if ( in_array( $dep, array( 'jquery', 'jquery-core', 'jquery-migrate' ), true ) ) {
			return true;
		}
		if ( ep_script_needs_jquery( $scripts, $dep, $seen ) ) {
			return true;
		}
	}
	return false;
}

/**
 * 5. jQuery: removido do front para visitantes, a menos que algum plugin ainda dependa dele.
 *    Nesse caso ele fica (para não quebrar o plugin) e o handle aparece num comentário HTML
 *    "ep-jquery-required-by", para identificar qual plugin é o responsável.
 */
function ep_maybe_drop_jquery(): void {
	if ( is_admin() || is_user_logged_in() || apply_filters( 'ep_allow_jquery', false ) ) {
		return;
	}

	$scripts  = wp_scripts();
	$requires = array();

	foreach ( $scripts->queue as $handle ) {
		if ( in_array( $handle, array( 'jquery', 'jquery-core', 'jquery-migrate' ), true ) ) {
			continue;
		}
		$seen = array();
		if ( ep_script_needs_jquery( $scripts, $handle, $seen ) ) {
			$requires[] = $handle;
		}
	}

	if ( $requires ) {
		add_action(
			'wp_footer',
			static function () use ( $requires ) {
				echo "\n<!-- ep-jquery-required-by: " . esc_html( implode( ', ', $requires ) ) . " -->\n";
			},
			999
		);
		return;
	}

	wp_dequeue_script( 'jquery' );
	wp_dequeue_script( 'jquery-core' );
	wp_dequeue_script( 'jquery-migrate' );
}
add_action( 'wp_enqueue_scripts', 'ep_maybe_drop_jquery', 9999 );
