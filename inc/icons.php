<?php
/**
 * Ícones SVG (Lucide v1.73.0, licença ISC — https://lucide.dev/license).
 *
 * Uso: ep_icon( 'arrow-right' ) imprime <svg><use href="#i-arrow-right"/></svg>.
 * Só os ícones realmente usados na página entram no sprite, impresso no rodapé.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Desenhos dos ícones (conteúdo interno do <svg>, viewBox 0 0 24 24).
 *
 * @return array<string,string>
 */
function ep_icon_paths(): array {
	return array(
		'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
		'book-open' => '<path d="M12 5v16"/><path d="M20.001 19A2 2 0 0022 17V5a2 2 0 00-1.999-2L16 3.002A5 5 0 0012 5a5 5 0 00-4-2H4a2 2 0 00-2 2v12a2 2 0 001.999 2H8a5 5 0 014 2 5 5 0 014-2z"/>',
		'calculator' => '<rect width="16" height="20" x="4" y="2" rx="2"/><line x1="8" x2="16" y1="6" y2="6"/><line x1="16" x2="16" y1="14" y2="18"/><path d="M16 10h.01"/><path d="M12 10h.01"/><path d="M8 10h.01"/><path d="M12 14h.01"/><path d="M8 14h.01"/><path d="M12 18h.01"/><path d="M8 18h.01"/>',
		'check' => '<path d="M20 6 9 17l-5-5"/>',
		'chevron-down' => '<path d="m6 9 6 6 6-6"/>',
		'chevron-right' => '<path d="m9 18 6-6-6-6"/>',
		'clipboard-check' => '<rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/>',
		'clock-3' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6h4"/>',
		'file-check-2' => '<path d="M10.5 22H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.706.706l3.588 3.588A2.4 2.4 0 0 1 20 8v6"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="m14 20 2 2 4-4"/>',
		'gauge' => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
		'info' => '<circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/>',
		'layers-3' => '<path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"/><path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12"/><path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17"/>',
		'menu' => '<path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>',
		'moon' => '<path d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401"/>',
		'search' => '<path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/>',
		'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
		'sliders-horizontal' => '<path d="M10 5H3"/><path d="M12 19H3"/><path d="M14 3v4"/><path d="M16 17v4"/><path d="M21 12h-9"/><path d="M21 19h-5"/><path d="M21 5h-7"/><path d="M8 10v4"/><path d="M8 12H3"/>',
		'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
		'wrench' => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.106-3.105c.32-.322.863-.22.983.218a6 6 0 0 1-8.259 7.057l-7.91 7.91a1 1 0 0 1-2.999-3l7.91-7.91a6 6 0 0 1 7.057-8.259c.438.12.54.662.219.984z"/>',
		'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
		'zap' => '<path d="M15.914 4a1.5 1.5 0 00-2.474-1.561l-9 9A1.5 1.5 0 005.5 14h4.002a.5.5 0 01.471.666L8.086 20a1.5 1.5 0 002.475 1.56l9-9A1.5 1.5 0 0018.5 10h-3.997a.5.5 0 01-.472-.667z"/>',
		'message-circle' => '<path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/>',
		'phone' => '<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/>',
		'mail' => '<path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/>',
	);
}

/**
 * Registra/consulta os ícones usados na página.
 *
 * @param string|null $name Ícone a registrar; null apenas consulta.
 * @return array<string,bool>
 */
function ep_icons_used( ?string $name = null ): array {
	static $used = array();
	if ( null !== $name ) {
		$used[ $name ] = true;
	}
	return $used;
}

/**
 * Retorna o markup de um ícone.
 *
 * @param string $name  Nome do ícone (ver ep_icon_paths()).
 * @param int    $size  Largura/altura em px.
 * @param array  $args  class, stroke (largura do traço), label (texto acessível; sem label = decorativo).
 */
function ep_get_icon( string $name, int $size = 20, array $args = array() ): string {
	if ( ! isset( ep_icon_paths()[ $name ] ) ) {
		return '';
	}
	ep_icons_used( $name );

	$class  = trim( 'icon icon-' . $name . ' ' . ( $args['class'] ?? '' ) );
	$stroke = isset( $args['stroke'] ) ? (float) $args['stroke'] : 2;
	$a11y   = empty( $args['label'] )
		? 'aria-hidden="true" focusable="false"'
		: 'role="img" aria-label="' . esc_attr( $args['label'] ) . '"';

	return sprintf(
		'<svg class="%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%3$s" stroke-linecap="round" stroke-linejoin="round" %4$s><use href="#i-%5$s"/></svg>',
		esc_attr( $class ),
		$size,
		esc_attr( (string) $stroke ),
		$a11y,
		esc_attr( $name )
	);
}

/**
 * Imprime um ícone.
 *
 * @param string $name Nome.
 * @param int    $size Tamanho.
 * @param array  $args Ver ep_get_icon().
 */
function ep_icon( string $name, int $size = 20, array $args = array() ): void {
	echo ep_get_icon( $name, $size, $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- montado e escapado em ep_get_icon().
}

/**
 * Sprite com os ícones usados, no fim do <body>.
 */
function ep_print_icon_sprite(): void {
	$used = ep_icons_used();
	if ( ! $used ) {
		return;
	}
	$paths = ep_icon_paths();
	echo '<svg xmlns="http://www.w3.org/2000/svg" style="display:none" aria-hidden="true">';
	foreach ( array_keys( $used ) as $name ) {
		// Conteúdo estático deste arquivo.
		echo '<symbol id="i-' . esc_attr( $name ) . '" viewBox="0 0 24 24">' . $paths[ $name ] . '</symbol>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo "</svg>\n";
}
add_action( 'wp_footer', 'ep_print_icon_sprite', 5 );
