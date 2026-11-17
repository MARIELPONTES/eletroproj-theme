<?php
/**
 * Carregamento de CSS, JS e fontes.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Versão do arquivo baseada na data de modificação (cache busting).
 *
 * @param string $rel Caminho relativo ao tema.
 * @return string
 */
function eletroproj_asset_ver( $rel ) {
	$file = ELETROPROJ_DIR . '/' . $rel;
	return file_exists( $file ) ? (string) filemtime( $file ) : ELETROPROJ_VERSION;
}

/**
 * CSS e JS do front-end.
 */
function eletroproj_enqueue() {
	wp_enqueue_style( 'eletroproj', ELETROPROJ_URI . '/assets/css/main.css', array(), eletroproj_asset_ver( 'assets/css/main.css' ) );
	wp_add_inline_style( 'eletroproj', eletroproj_custom_colors_css() );

	wp_enqueue_script(
		'eletroproj',
		ELETROPROJ_URI . '/assets/js/main.js',
		array(),
		eletroproj_asset_ver( 'assets/js/main.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_localize_script(
		'eletroproj',
		'eletroprojI18n',
		array(
			'copiar'  => __( 'Copiar', 'eletroproj' ),
			'copiado' => __( 'Copiado!', 'eletroproj' ),
			'link'    => __( 'Link copiado!', 'eletroproj' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'eletroproj_enqueue' );

/**
 * Cores escolhidas no Personalizador (sobrescrevem as do theme.json).
 *
 * @return string
 */
function eletroproj_custom_colors_css() {
	$marca = sanitize_hex_color( get_theme_mod( 'eletroproj_cor_marca', '#C2410C' ) );
	$link  = sanitize_hex_color( get_theme_mod( 'eletroproj_cor_link', '#0B66C3' ) );
	$css   = 'html:root{';
	if ( $marca ) {
		$css .= '--wp--preset--color--marca:' . $marca . ';';
		$css .= '--wp--preset--color--marca-clara:color-mix(in srgb,' . $marca . ' 12%,#fff);';
	}
	if ( $link ) {
		$css .= '--wp--preset--color--link:' . $link . ';';
	}
	foreach ( eletroproj_larguras() as $id => $lim ) {
		$px = (int) eletroproj_mod( $id );
		if ( $px ) {
			$css .= $lim[3] . ':' . max( $lim[0], min( $lim[1], $px ) ) . 'px;';
		}
	}
	$css .= '}';
	return $css;
}

/**
 * Preload das duas fontes usadas acima da dobra + script anti-"flash" do modo escuro.
 */
function eletroproj_head_early() {
	$fonts = array(
		'assets/fonts/literata-latin-wght-normal.woff2',
		'assets/fonts/bricolage-grotesque-latin-800-normal.woff2',
	);
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( ELETROPROJ_URI . '/' . $font )
		);
	}
	/*
	 * Aplica o modo antes da pintura, para não piscar:
	 * 1) escolha do visitante (botão sol/lua), se feita com o padrão atual;
	 * 2) senão, o padrão do Personalizar (claro/escuro);
	 * 3) senão, o modo do sistema do visitante.
	 */
	echo "<script>(function(){var d=document.documentElement,p=d.getAttribute('data-tema-padrao')||'sistema',t=null,b=null;try{t=localStorage.getItem('eletroproj-tema');b=localStorage.getItem('eletroproj-tema-base');}catch(e){}if(b===null){b='sistema';}if(b!==p){t=null;}if(t!=='dark'&&t!=='light'){t=p==='escuro'?'dark':p==='claro'?'light':(window.matchMedia&&matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');}d.setAttribute('data-theme',t);})();</script>\n";
}
add_action( 'wp_head', 'eletroproj_head_early', 1 );

/**
 * Estilos no editor de blocos.
 */
function eletroproj_editor_assets() {
	wp_add_inline_style( 'wp-block-library', eletroproj_custom_colors_css() );
}
add_action( 'enqueue_block_editor_assets', 'eletroproj_editor_assets' );

/**
 * Marca no <html> o modo de cor padrão escolhido no Personalizar.
 * Com claro/escuro, já sai o data-theme certo no HTML (funciona até sem JavaScript).
 *
 * @param string $output Atributos do <html>.
 * @return string
 */
function eletroproj_html_modo_padrao( $output ) {
	if ( is_admin() ) {
		return $output;
	}
	$modo    = eletroproj_sanitize_modo_padrao( eletroproj_mod( 'modo_padrao' ) );
	$output .= ' data-tema-padrao="' . esc_attr( $modo ) . '"';
	if ( 'claro' === $modo ) {
		$output .= ' data-theme="light"';
	} elseif ( 'escuro' === $modo ) {
		$output .= ' data-theme="dark"';
	}
	return $output;
}
add_filter( 'language_attributes', 'eletroproj_html_modo_padrao' );
