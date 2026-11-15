<?php
/**
 * Aparência e leitura: tema padrão (escuro, claro ou o do sistema), cores dos textos
 * e tipografia. Fica em Aparência › Personalizar › Eletroproj › Aparência e leitura.
 *
 * Só o que for diferente do padrão (Figma) vira CSS, impresso inline logo depois do CSS do tema.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cores editáveis: id => array( rótulo, padrão, variável CSS, tema ).
 *
 * @return array<string,array{0:string,1:string,2:string,3:string}>
 */
function ep_color_fields(): array {
	return array(
		'ep_st_dark_text'    => array( 'Escuro — títulos e textos fortes', '#e8eaed', '--text', 'dark' ),
		'ep_st_dark_body'    => array( 'Escuro — texto corrido e textos secundários', '#9aa1ac', '--muted', 'dark' ),
		'ep_st_dark_accent'  => array( 'Escuro — destaque (links, rótulos, botões)', '#f5a623', '--accent', 'dark' ),
		'ep_st_light_text'   => array( 'Claro — títulos e textos fortes', '#15181d', '--text', 'light' ),
		'ep_st_light_body'   => array( 'Claro — texto corrido e textos secundários', '#5e6670', '--muted', 'light' ),
		'ep_st_light_accent' => array( 'Claro — destaque (links, rótulos, botões)', '#9a5a00', '--accent', 'light' ),
	);
}

/**
 * Fundos de cada tema (para o aviso de contraste no Personalizar).
 *
 * @return array<string,string>
 */
function ep_theme_backgrounds(): array {
	return array(
		'dark'  => '#0e1013',
		'light' => '#f5f3ee',
	);
}

/**
 * Opções de seleção: id => array( rótulo, padrão, escolhas, descrição ).
 *
 * @return array<string,array{0:string,1:string,2:array<string,string>,3:string}>
 */
function ep_style_selects(): array {
	return array(
		'ep_st_default_theme' => array(
			'Tema padrão para quem visita',
			'dark',
			array(
				'dark'   => 'Escuro (padrão do layout)',
				'light'  => 'Claro',
				'system' => 'Seguir o sistema do visitante (Windows, Android, iPhone, Mac)',
			),
			'O visitante ainda pode trocar no botão de sol/lua do cabeçalho; a escolha dele fica salva no navegador dele.',
		),
		'ep_st_heading_font'  => array(
			'Fonte dos títulos',
			'barlow',
			array(
				'barlow' => 'Barlow Condensed (padrão do layout)',
				'system' => 'Fonte do sistema (mais leve: nenhum arquivo de fonte)',
			),
			'',
		),
		'ep_st_h1_size'       => array(
			'Títulos principais (H1) — tamanho',
			'100',
			array( '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100% (padrão)', '110' => '110%', '120' => '120%', '130' => '130%', '140' => '140%' ),
			'Título do post e o título grande do topo da página inicial, dos guias e da página de serviço.',
		),
		'ep_st_h2_size'       => array(
			'Títulos de seção (H2) — tamanho',
			'100',
			array( '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100% (padrão)', '110' => '110%', '120' => '120%', '130' => '130%', '140' => '140%' ),
			'Os H2 dos artigos e os títulos das seções das páginas.',
		),
		'ep_st_h3_size'       => array(
			'Subtítulos (H3) — tamanho',
			'100',
			array( '70' => '70%', '80' => '80%', '90' => '90%', '100' => '100% (padrão)', '110' => '110%', '120' => '120%', '130' => '130%', '140' => '140%' ),
			'Os H3 dos artigos e os títulos dos cards.',
		),
		'ep_st_heading_weight' => array(
			'Títulos — peso',
			'600',
			array(
				'500' => 'Médio',
				'600' => 'Seminegrito (padrão)',
				'700' => 'Negrito',
				'800' => 'Extranegrito',
			),
			'Com a Barlow Condensed só existe o seminegrito; os outros pesos ficam corretos com a fonte do sistema.',
		),
		'ep_st_heading_case'  => array(
			'Títulos — letras',
			'none',
			array(
				'none'      => 'Como foram digitados (padrão)',
				'uppercase' => 'TUDO EM MAIÚSCULAS',
			),
			'',
		),
		'ep_st_heading_spacing' => array(
			'Títulos — espaço entre as letras',
			'-0.02em',
			array(
				'-0.03em' => 'Mais justo',
				'-0.02em' => 'Justo (padrão)',
				'0'       => 'Normal',
				'0.02em'  => 'Espaçado',
				'0.05em'  => 'Bem espaçado',
			),
			'',
		),
		'ep_st_heading_line'  => array(
			'Títulos — espaço entre as linhas (títulos com mais de uma linha)',
			'1.04',
			array(
				'1'    => 'Bem justo (1,0)',
				'1.04' => 'Justo (1,04 — padrão)',
				'1.15' => 'Normal (1,15)',
				'1.25' => 'Arejado (1,25)',
			),
			'',
		),
		'ep_st_body_font'     => array(
			'Fonte do texto',
			'inter',
			array(
				'inter'                      => 'Inter (padrão — nítida em telas, ótima para números)',
				'source-sans-3'              => 'Source Sans 3 (elegante, um pouco mais estreita)',
				'ibm-plex-sans'              => 'IBM Plex Sans (visual técnico, de engenharia)',
				'atkinson-hyperlegible-next' => 'Atkinson Hyperlegible Next (máxima legibilidade)',
				'sans'                       => 'Sem serifa do sistema (Segoe UI, Roboto, San Francisco)',
				'serif'                      => 'Com serifa do sistema (Georgia, Noto Serif, Times)',
			),
			'As quatro primeiras são do próprio site (≈ 20–28 KB, um arquivo só, sem Google Fonts). As do sistema não baixam nada, mas mudam conforme o aparelho.',
		),
		'ep_st_text_size'     => array(
			'Tamanho do texto dos artigos (em telas de 1920 px; as menores acompanham)',
			'18',
			array(
				'16' => '16 px',
				'17' => '17 px',
				'18' => '18 px (padrão)',
				'19' => '19 px',
				'20' => '20 px',
				'21' => '21 px',
			),
			'',
		),
		'ep_st_line_height'   => array(
			'Espaço entre as linhas do texto',
			'1.7',
			array(
				'1.6' => 'Compacto (1,6)',
				'1.7' => 'Normal (1,7 — padrão)',
				'1.8' => 'Arejado (1,8)',
				'1.9' => 'Bem arejado (1,9)',
			),
			'',
		),
	);
}

/**
 * Fontes do texto hospedadas no tema: slug => array( nome, métricas Arial, métricas Roboto ).
 * Métricas (size-adjust, ascent, descent em %) para a fonte de reserva ocupar o mesmo espaço (CLS 0).
 * Arquivos: assets/fonts/<slug>.woff2 — variável 400–700, latin, licença OFL.
 *
 * @return array<string,array{0:string,1:array{0:float,1:float,2:float},2:array{0:float,1:float,2:float}}>
 */
function ep_body_webfonts(): array {
	return array(
		'inter' => array( 'Inter', array( 106.55, 90.92, 22.64 ), array( 106.82, 90.69, 22.58 ) ),
		'source-sans-3' => array( 'Source Sans 3', array( 93.24, 109.82, 42.9 ), array( 93.49, 109.53, 42.79 ) ),
		'ibm-plex-sans' => array( 'IBM Plex Sans', array( 100.19, 102.31, 27.45 ), array( 100.45, 102.04, 27.38 ) ),
		'atkinson-hyperlegible-next' => array( 'Atkinson Hyperlegible Next', array( 98.87, 99.53, 31.96 ), array( 99.13, 99.27, 31.88 ) ),
	);
}

/**
 * Slug da fonte do texto hospedada no tema ('' quando é fonte do sistema).
 */
function ep_body_webfont(): string {
	$slug = ep_style( 'ep_st_body_font' );
	return isset( ep_body_webfonts()[ $slug ] ) ? $slug : '';
}

/**
 * @font-face da fonte do texto e das reservas com métricas ajustadas.
 */
function ep_body_font_css(): string {
	$slug = ep_body_webfont();
	if ( '' === $slug ) {
		return '';
	}
	list( $name, $arial, $roboto ) = ep_body_webfonts()[ $slug ];
	$url = esc_url_raw( EP_URI . '/assets/fonts/' . $slug . '.woff2' );
	$css = sprintf(
		'@font-face{font-family:"%1$s";src:url(%2$s) format("woff2");font-weight:400 700;font-style:normal;font-display:swap;unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02C6,U+02DA,U+02DC,U+2013-2014,U+2018-201E,U+2022,U+2026,U+2032-2033,U+2039-203A,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215}',
		$name,
		$url
	);
	foreach ( array( 'EP Body Fallback' => array( $arial, 'local("Arial"),local("ArialMT"),local("Liberation Sans")' ), 'EP Body Fallback Roboto' => array( $roboto, 'local("Roboto"),local("Roboto-Regular")' ) ) as $family => list( $m, $src ) ) {
		$css .= sprintf(
			'@font-face{font-family:"%1$s";src:%2$s;size-adjust:%3$s%%;ascent-override:%4$s%%;descent-override:%5$s%%;line-gap-override:0%%}',
			$family,
			$src,
			$m[0],
			$m[1],
			$m[2]
		);
	}
	return $css;
}

/**
 * Preload da fonte do texto (quando é do tema), logo no início do <head>.
 */
function ep_preload_body_font(): void {
	$slug = ep_body_webfont();
	if ( '' !== $slug ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( EP_URI . '/assets/fonts/' . $slug . '.woff2' )
		);
	}
}
add_action( 'wp_head', 'ep_preload_body_font', 0 );

/**
 * Valor de uma opção de aparência, sempre válido.
 *
 * @param string $key Opção.
 */
function ep_style( string $key ): string {
	$selects = ep_style_selects();
	if ( isset( $selects[ $key ] ) ) {
		$value = (string) get_theme_mod( $key, $selects[ $key ][1] );
		return array_key_exists( $value, $selects[ $key ][2] ) ? $value : $selects[ $key ][1];
	}
	$colors = ep_color_fields();
	if ( isset( $colors[ $key ] ) ) {
		$value = sanitize_hex_color( (string) get_theme_mod( $key, $colors[ $key ][1] ) );
		return $value ? strtolower( $value ) : $colors[ $key ][1];
	}
	return '';
}

/**
 * Tema que vai no <html> (o do sistema começa escuro e o script do <head> troca antes da pintura).
 */
function ep_html_theme(): string {
	return 'light' === ep_style( 'ep_st_default_theme' ) ? 'light' : 'dark';
}

/**
 * Script do <head>: aplica a escolha salva do visitante ou, sem ela, o padrão do sistema (se configurado).
 */
function ep_theme_script(): string {
	$system = 'system' === ep_style( 'ep_st_default_theme' )
		? "if(t!=='light'&&t!=='dark')t=matchMedia('(prefers-color-scheme: light)').matches?'light':'dark';"
		: '';
	return "<script>try{var t=localStorage.getItem('ep-theme');{$system}if(t==='light'||t==='dark')document.documentElement.dataset.theme=t}catch(e){}</script>\n";
}

/**
 * A fonte Barlow Condensed só é pré-carregada quando está em uso.
 */
function ep_uses_display_font(): bool {
	return 'barlow' === ep_style( 'ep_st_heading_font' );
}

/**
 * CSS das escolhas que diferem do padrão ('' quando está tudo no padrão).
 *
 * @param string $scope Seletor do texto dos artigos ('.entry-content' no site, '.is-root-container' no editor).
 */
function ep_style_css( string $scope = '.entry-content' ): string {
	$vars = array(
		'dark'  => '',
		'light' => '',
	);
	foreach ( ep_color_fields() as $id => list( , $default, $var, $theme ) ) {
		$value = ep_style( $id );
		if ( $value !== $default ) {
			$vars[ $theme ] .= $var . ':' . $value . ';';
		}
	}

	$root = $vars['dark'];
	foreach ( array( 'h1', 'h2', 'h3' ) as $level ) {
		$scale = (int) ep_style( 'ep_st_' . $level . '_size' );
		if ( 100 !== $scale ) {
			$root .= '--' . $level . 's:' . ( $scale / 100 ) . ';';
		}
	}
	if ( 'system' === ep_style( 'ep_st_heading_font' ) ) {
		$root .= '--font-display:var(--font-body);';
	}
	$body_font = ep_style( 'ep_st_body_font' );
	if ( 'serif' === $body_font ) {
		$root .= '--font-body:Georgia,"Noto Serif","Times New Roman",Times,serif;';
	} elseif ( '' !== ep_body_webfont() ) {
		$root .= '--font-body:"' . ep_body_webfonts()[ $body_font ][0] . '","EP Body Fallback","EP Body Fallback Roboto",system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;';
	}

	$css = ep_body_font_css();
	if ( '' !== $root ) {
		$css .= ':root{' . $root . '}';
	}
	if ( '' !== $vars['light'] ) {
		$css .= ':root[data-theme="light"]{' . $vars['light'] . '}';
	}

	$heading = '';
	foreach ( array(
		'ep_st_heading_weight'  => array( 'font-weight', '600' ),
		'ep_st_heading_case'    => array( 'text-transform', 'none' ),
		'ep_st_heading_spacing' => array( 'letter-spacing', '-0.02em' ),
		'ep_st_heading_line'    => array( 'line-height', '1.04' ),
	) as $key => list( $property, $default ) ) {
		$value = ep_style( $key );
		if ( $value !== $default ) {
			$heading .= $property . ':' . $value . ';';
		}
	}
	if ( '' !== $heading ) {
		$css .= 'h1,h2,h3{' . $heading . '}';
	}

	$size = (int) ep_style( 'ep_st_text_size' );
	if ( 18 !== $size ) {
		// Desktop = tamanho escolhido; celular = 1 px a menos (como no padrão 18/17); 1º parágrafo na mesma proporção (23/18).
		$css .= sprintf(
			'%1$s{font-size:%2$srem;font-size:round(%2$srem,1px)}%1$s>p:first-child{font-size:%3$srem;font-size:round(%3$srem,1px)}@media (max-width:767px){%1$s{font-size:%4$srem}}',
			$scope,
			ep_rem( $size ),
			ep_rem( $size * 23 / 18 ),
			ep_rem( $size - 1 )
		);
	}

	$line = ep_style( 'ep_st_line_height' );
	if ( '1.7' !== $line ) {
		$css .= $scope . '{line-height:' . $line . '}';
	}

	return $css;
}

/**
 * px → rem (base 16), sem zeros sobrando.
 *
 * @param float $px Pixels.
 */
function ep_rem( float $px ): string {
	return rtrim( rtrim( number_format( $px / 16, 4, '.', '' ), '0' ), '.' );
}

/**
 * Imprime o CSS das escolhas logo depois do CSS do tema.
 */
function ep_print_style_css(): void {
	$css = ep_style_css();
	if ( '' !== $css ) {
		// Valores validados (cores hex, listas fechadas de opções).
		echo '<style id="ep-custom">' . $css . "</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'ep_print_style_css', 2 );

/**
 * As mesmas escolhas no editor de blocos.
 *
 * @param array $settings Configurações do editor.
 */
function ep_editor_custom_style( array $settings ): array {
	$css = ep_style_css( '.is-root-container' );
	if ( '' !== $css ) {
		$settings['styles'][] = array( 'css' => $css );
	}
	return $settings;
}
add_filter( 'block_editor_settings_all', 'ep_editor_custom_style', 20 );

/**
 * Seção "Aparência e leitura" no painel Eletroproj do Personalizar.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function ep_customize_appearance( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section(
		'ep_style',
		array(
			'title'       => __( 'Aparência e leitura', 'eletroproj' ),
			'panel'       => 'ep_panel',
			'priority'    => 1,
			'description' => __( 'Tema padrão, cores dos textos e tipografia. Depois de publicar, limpe o cache (LiteSpeed Cache › Painel › Limpar tudo).', 'eletroproj' ),
		)
	);

	foreach ( ep_style_selects() as $id => list( $label, $default, $choices, $description ) ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $default,
				'sanitize_callback' => static function ( $value ) use ( $choices, $default ) {
					return array_key_exists( (string) $value, $choices ) ? (string) $value : $default;
				},
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => 'ep_style',
				'type'        => 'select',
				'choices'     => $choices,
			)
		);
	}

	foreach ( ep_color_fields() as $id => list( $label, $default, , $theme ) ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $default,
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$id,
				array(
					'label'       => $label,
					'section'     => 'ep_style',
					'description' => sprintf(
						/* translators: %s: cor padrão. */
						__( 'Padrão: %s', 'eletroproj' ),
						$default
					),
				)
			)
		);
	}
}
add_action( 'customize_register', 'ep_customize_appearance', 20 );

/**
 * Aviso de contraste ao vivo embaixo de cada cor (só no Personalizar, não vai para o site).
 */
function ep_customize_contrast_script(): void {
	$map = array();
	foreach ( ep_color_fields() as $id => $field ) {
		$map[ $id ] = ep_theme_backgrounds()[ $field[3] ];
	}
	?>
	<script>
	( function ( api, map ) {
		function lum( hex ) {
			hex = String( hex || '' ).replace( '#', '' );
			if ( hex.length === 3 ) { hex = hex.replace( /./g, '$&$&' ); }
			if ( ! /^[0-9a-f]{6}$/i.test( hex ) ) { return null; }
			return [ 0, 2, 4 ].map( function ( i ) {
				var c = parseInt( hex.substr( i, 2 ), 16 ) / 255;
				return c <= 0.03928 ? c / 12.92 : Math.pow( ( c + 0.055 ) / 1.055, 2.4 );
			} ).reduce( function ( s, c, i ) { return s + c * [ 0.2126, 0.7152, 0.0722 ][ i ]; }, 0 );
		}
		function ratio( a, b ) {
			var x = lum( a ), y = lum( b );
			if ( x === null || y === null ) { return null; }
			return ( Math.max( x, y ) + 0.05 ) / ( Math.min( x, y ) + 0.05 );
		}
		Object.keys( map ).forEach( function ( id ) {
			api( id, function ( setting ) {
				api.control( id, function ( control ) {
					var note = document.createElement( 'p' );
					note.className = 'description';
					control.container.append( note );
					function update() {
						var r = ratio( setting.get(), map[ id ] );
						if ( r === null ) { note.textContent = ''; return; }
						var ok = r >= 4.5;
						note.textContent = 'Contraste com o fundo: ' + r.toFixed( 1 ).replace( '.', ',' ) + ':1 — ' + ( ok ? 'OK para leitura (mínimo 4,5:1).' : 'baixo: difícil de ler e reduz a nota de Acessibilidade no PageSpeed.' );
						note.style.color = ok ? '#1e7b34' : '#b32d2e';
					}
					setting.bind( update );
					update();
				} );
			} );
		} );
	} )( wp.customize, <?php echo wp_json_encode( $map ); ?> );
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'ep_customize_contrast_script' );
