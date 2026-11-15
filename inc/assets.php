<?php
/**
 * CSS, fontes e JS do tema.
 *
 * - CSS: impresso inline no <head>, só os arquivos que o template precisa (sem requisição bloqueante).
 * - Fonte: 1 arquivo WOFF2 com preload.
 * - Tema claro/escuro: script mínimo inline antes do CSS (sem "flash").
 * - JS: um arquivo vanilla com defer.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Arquivos CSS (em assets/css/) usados na página atual, em ordem.
 *
 * @return string[]
 */
function ep_css_files(): array {
	$files = array( 'base' );

	/**
	 * Permite que cada etapa/template acrescente seus arquivos (post, home, guide...).
	 *
	 * @param string[] $files Nomes sem extensão.
	 */
	return array_values( array_unique( apply_filters( 'ep_css_files', $files ) ) );
}

/**
 * Minificação simples e segura para o CSS escrito à mão do tema.
 *
 * @param string $css CSS original.
 */
function ep_minify_css( string $css ): string {
	$css = preg_replace( '#/\*.*?\*/#s', '', $css ) ?? $css;
	$css = preg_replace( '/\s+/', ' ', $css ) ?? $css;
	$css = preg_replace( '/\s*([{};,])\s*/', '$1', $css ) ?? $css;
	$css = preg_replace( '/:\s+/', ':', $css ) ?? $css;
	$css = str_replace( ';}', '}', $css );
	return trim( $css );
}

/**
 * CSS final da página (concatenado, minificado e em cache).
 */
function ep_inline_css(): string {
	$files = ep_css_files();
	$parts = array();
	$stamp = EP_VERSION . EP_URI;

	foreach ( $files as $name ) {
		$path = EP_DIR . '/assets/css/' . sanitize_file_name( $name ) . '.css';
		if ( is_readable( $path ) ) {
			$parts[ $name ] = $path;
			$stamp         .= $name . filemtime( $path );
		}
	}

	$key    = 'ep_css_' . md5( $stamp );
	$cached = get_transient( $key );
	if ( is_string( $cached ) && '' !== $cached ) {
		return $cached;
	}

	$css = '';
	foreach ( $parts as $path ) {
		$css .= (string) file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	}
	$css = str_replace( '{{theme}}', esc_url_raw( EP_URI ), $css );
	$css = ep_minify_css( $css );

	set_transient( $key, $css, WEEK_IN_SECONDS );
	return $css;
}

/**
 * <head>: script de tema, preload da fonte e CSS inline — nesta ordem, antes de qualquer outra coisa.
 */
function ep_head_assets(): void {
	// Aplica o tema salvo antes da pintura. Padrão (Figma): escuro, já definido no <html>.
	echo "<script>try{var t=localStorage.getItem('ep-theme');if(t==='light'||t==='dark')document.documentElement.dataset.theme=t}catch(e){}</script>\n";

	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( EP_URI . '/assets/fonts/barlow-condensed-600.woff2' )
	);

	// O CSS é do próprio tema (arquivos estáticos do repositório), não entrada de usuário.
	echo '<style id="ep-css">' . ep_inline_css() . "</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'ep_head_assets', 1 );

/**
 * JS do tema (vanilla, defer, rodapé).
 */
function ep_enqueue_scripts(): void {
	$path = EP_DIR . '/assets/js/theme.js';
	wp_enqueue_script(
		'ep-theme',
		EP_URI . '/assets/js/theme.js',
		array(),
		(string) ( is_readable( $path ) ? filemtime( $path ) : EP_VERSION ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ep_enqueue_scripts' );

/**
 * Limpa o cache de CSS ao trocar/atualizar o tema.
 */
function ep_flush_css_cache(): void {
	global $wpdb;
	// phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\\_transient\\_ep\\_css\\_%' OR option_name LIKE '\\_transient\\_timeout\\_ep\\_css\\_%'" );
}
add_action( 'after_switch_theme', 'ep_flush_css_cache' );
