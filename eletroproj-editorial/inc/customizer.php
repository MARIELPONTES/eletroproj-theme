<?php
/**
 * Opções do Personalizador (Aparência → Personalizar).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valores padrão de todas as opções.
 *
 * @return array
 */
function eletroproj_defaults() {
	return array(
		'eletroproj_cor_marca'           => '#C2410C',
		'eletroproj_cor_link'            => '#0B66C3',

		'eletroproj_home_destaque'       => true,
		'eletroproj_home_newsletter'     => true,
		'eletroproj_home_guias'          => true,
		'eletroproj_home_familia'        => true,
		'eletroproj_home_temas'          => true,
		'eletroproj_guias_categoria'     => 'guias',
		'eletroproj_guias_titulo'        => 'Guias essenciais',

		'eletroproj_nl_titulo'           => 'Dicas práticas de elétrica e automação, uma vez por semana.',
		'eletroproj_nl_texto'            => 'Normas, cálculos e projetos explicados sem enrolação. Cancele quando quiser.',
		'eletroproj_nl_shortcode'        => '',
		'eletroproj_nl_action'           => '',
		'eletroproj_nl_campo'            => 'email',
		'eletroproj_nl_prova'            => 'Junte-se a outros profissionais da área elétrica.',

		'eletroproj_familia_titulo'      => 'O que a Eletroproj faz por você',
		'eletroproj_familia_1_titulo'    => 'Projetos de SPDA',
		'eletroproj_familia_1_texto'     => 'Projetos de proteção contra descargas atmosféricas conforme a NBR 5419.',
		'eletroproj_familia_1_url'       => '',
		'eletroproj_familia_1_icone'     => 'escudo',
		'eletroproj_familia_2_titulo'    => 'Laudos técnicos',
		'eletroproj_familia_2_texto'     => 'Inspeções e laudos de SPDA e instalações elétricas com ART.',
		'eletroproj_familia_2_url'       => '',
		'eletroproj_familia_2_icone'     => 'documento',
		'eletroproj_familia_3_titulo'    => 'Calculadoras',
		'eletroproj_familia_3_texto'     => 'Dimensionamento de cabos, queda de tensão e eletrodutos (NBR 5410).',
		'eletroproj_familia_3_url'       => '',
		'eletroproj_familia_3_icone'     => 'calculadora',
		'eletroproj_familia_4_titulo'    => 'Cursos',
		'eletroproj_familia_4_texto'     => 'Automação, CLP e elétrica na prática, do básico ao avançado.',
		'eletroproj_familia_4_url'       => '',
		'eletroproj_familia_4_icone'     => 'livro',

		'eletroproj_artigo_sumario'      => true,
		'eletroproj_artigo_progresso'    => true,
		'eletroproj_artigo_relacionados' => true,
		'eletroproj_mostrar_sumario'     => true,

		'eletroproj_rodape_texto'        => 'Conteúdo técnico de qualidade sobre engenharia elétrica, automação industrial e SPDA.',
		'eletroproj_instagram'           => '',
		'eletroproj_youtube'             => '',
		'eletroproj_linkedin'            => '',
		'eletroproj_whatsapp'            => '',
	);
}

/**
 * Lê uma opção com o padrão correto.
 *
 * @param string $key Nome (sem o prefixo eletroproj_ também funciona).
 * @return mixed
 */
function eletroproj_mod( $key ) {
	if ( 0 !== strpos( $key, 'eletroproj_' ) ) {
		$key = 'eletroproj_' . $key;
	}
	$defaults = eletroproj_defaults();
	return get_theme_mod( $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Sanitiza checkbox.
 *
 * @param mixed $v Valor.
 * @return bool
 */
function eletroproj_sanitize_checkbox( $v ) {
	return (bool) $v;
}

/**
 * Sanitiza o nome do ícone.
 *
 * @param string $v Valor.
 * @return string
 */
function eletroproj_sanitize_icon( $v ) {
	$allowed = array_keys( eletroproj_icon_choices() );
	return in_array( $v, $allowed, true ) ? $v : 'raio';
}

/**
 * Ícones disponíveis para os cards de serviço.
 *
 * @return array
 */
function eletroproj_icon_choices() {
	return array(
		'raio'        => 'Raio',
		'escudo'      => 'Escudo',
		'documento'   => 'Documento',
		'calculadora' => 'Calculadora',
		'livro'       => 'Livro',
		'chip'        => 'Chip / CLP',
	);
}

/**
 * Registra painéis, seções e controles.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function eletroproj_customize_register( $wp_customize ) {
	$d = eletroproj_defaults();

	$wp_customize->add_panel(
		'eletroproj',
		array(
			'title'    => __( 'Tema Eletroproj', 'eletroproj' ),
			'priority' => 30,
		)
	);

	// Helper interno.
	$add = function ( $id, $section, $label, $type = 'text', $extra = array() ) use ( $wp_customize, $d ) {
		$sanitize = 'sanitize_text_field';
		if ( 'checkbox' === $type ) {
			$sanitize = 'eletroproj_sanitize_checkbox';
		} elseif ( 'url' === $type ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'textarea' === $type ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'color' === $type ) {
			$sanitize = 'sanitize_hex_color';
		} elseif ( 'icon' === $type ) {
			$sanitize = 'eletroproj_sanitize_icon';
		}
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => isset( $d[ $id ] ) ? $d[ $id ] : '',
				'sanitize_callback' => $sanitize,
			)
		);
		if ( 'color' === $type ) {
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$id,
					array(
						'label'   => $label,
						'section' => $section,
					)
				)
			);
			return;
		}
		$args = array_merge(
			array(
				'label'   => $label,
				'section' => $section,
				'type'    => ( 'icon' === $type ) ? 'select' : $type,
			),
			$extra
		);
		if ( 'icon' === $type ) {
			$args['choices'] = eletroproj_icon_choices();
		}
		$wp_customize->add_control( $id, $args );
	};

	// Cores.
	$wp_customize->add_section(
		'eletroproj_cores',
		array(
			'title' => __( 'Cores', 'eletroproj' ),
			'panel' => 'eletroproj',
		)
	);
	$add( 'eletroproj_cor_marca', 'eletroproj_cores', __( 'Cor da marca (cabeçalho, botões, destaques)', 'eletroproj' ), 'color' );
	$add( 'eletroproj_cor_link', 'eletroproj_cores', __( 'Cor dos links no texto', 'eletroproj' ), 'color' );

	// Página inicial.
	$wp_customize->add_section(
		'eletroproj_home',
		array(
			'title'       => __( 'Página inicial', 'eletroproj' ),
			'panel'       => 'eletroproj',
			'description' => __( 'Ligue ou desligue as seções da página inicial.', 'eletroproj' ),
		)
	);
	$add( 'eletroproj_home_destaque', 'eletroproj_home', __( 'Mostrar o primeiro artigo em destaque', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_home_newsletter', 'eletroproj_home', __( 'Mostrar bloco de newsletter', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_home_guias', 'eletroproj_home', __( 'Mostrar guias essenciais', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_guias_titulo', 'eletroproj_home', __( 'Título da seção de guias', 'eletroproj' ) );
	$add(
		'eletroproj_guias_categoria',
		'eletroproj_home',
		__( 'Slug da categoria dos guias', 'eletroproj' ),
		'text',
		array( 'description' => __( 'Os 3 posts mais recentes dessa categoria aparecem como guias. Ex.: guias', 'eletroproj' ) )
	);
	$add( 'eletroproj_home_familia', 'eletroproj_home', __( 'Mostrar cards de serviços', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_home_temas', 'eletroproj_home', __( 'Mostrar lista de todos os temas', 'eletroproj' ), 'checkbox' );

	// Newsletter.
	$wp_customize->add_section(
		'eletroproj_newsletter',
		array(
			'title'       => __( 'Newsletter', 'eletroproj' ),
			'panel'       => 'eletroproj',
			'description' => __( 'Use o shortcode do seu plugin (MailPoet, Mailchimp etc.) OU a URL de envio de um formulário externo.', 'eletroproj' ),
		)
	);
	$add( 'eletroproj_nl_titulo', 'eletroproj_newsletter', __( 'Título', 'eletroproj' ) );
	$add( 'eletroproj_nl_texto', 'eletroproj_newsletter', __( 'Texto', 'eletroproj' ), 'textarea' );
	$add( 'eletroproj_nl_shortcode', 'eletroproj_newsletter', __( 'Shortcode do formulário (opcional)', 'eletroproj' ) );
	$add( 'eletroproj_nl_action', 'eletroproj_newsletter', __( 'URL de envio do formulário (action)', 'eletroproj' ), 'url' );
	$add( 'eletroproj_nl_campo', 'eletroproj_newsletter', __( 'Nome do campo de e-mail', 'eletroproj' ) );
	$add( 'eletroproj_nl_prova', 'eletroproj_newsletter', __( 'Linha de prova social', 'eletroproj' ) );

	// Serviços.
	$wp_customize->add_section(
		'eletroproj_familia',
		array(
			'title' => __( 'Cards de serviços', 'eletroproj' ),
			'panel' => 'eletroproj',
		)
	);
	$add( 'eletroproj_familia_titulo', 'eletroproj_familia', __( 'Título da seção', 'eletroproj' ) );
	for ( $i = 1; $i <= 4; $i++ ) {
		/* translators: %d: número do card */
		$n = sprintf( __( 'Card %d', 'eletroproj' ), $i );
		$add( "eletroproj_familia_{$i}_titulo", 'eletroproj_familia', $n . ' — ' . __( 'título', 'eletroproj' ) );
		$add( "eletroproj_familia_{$i}_texto", 'eletroproj_familia', $n . ' — ' . __( 'texto', 'eletroproj' ), 'textarea' );
		$add( "eletroproj_familia_{$i}_url", 'eletroproj_familia', $n . ' — ' . __( 'link', 'eletroproj' ), 'url' );
		$add( "eletroproj_familia_{$i}_icone", 'eletroproj_familia', $n . ' — ' . __( 'ícone', 'eletroproj' ), 'icon' );
	}

	// Artigo.
	$wp_customize->add_section(
		'eletroproj_artigo',
		array(
			'title' => __( 'Página do artigo', 'eletroproj' ),
			'panel' => 'eletroproj',
		)
	);
	$add( 'eletroproj_mostrar_sumario', 'eletroproj_artigo', __( 'Sumário automático (3+ subtítulos)', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_artigo_progresso', 'eletroproj_artigo', __( 'Barra de progresso de leitura', 'eletroproj' ), 'checkbox' );
	$add( 'eletroproj_artigo_relacionados', 'eletroproj_artigo', __( 'Artigos relacionados no final', 'eletroproj' ), 'checkbox' );

	// Rodapé e redes.
	$wp_customize->add_section(
		'eletroproj_rodape',
		array(
			'title' => __( 'Rodapé e redes sociais', 'eletroproj' ),
			'panel' => 'eletroproj',
		)
	);
	$add( 'eletroproj_rodape_texto', 'eletroproj_rodape', __( 'Texto de apresentação', 'eletroproj' ), 'textarea' );
	$add( 'eletroproj_instagram', 'eletroproj_rodape', 'Instagram (URL)', 'url' );
	$add( 'eletroproj_youtube', 'eletroproj_rodape', 'YouTube (URL)', 'url' );
	$add( 'eletroproj_linkedin', 'eletroproj_rodape', 'LinkedIn (URL)', 'url' );
	$add( 'eletroproj_whatsapp', 'eletroproj_rodape', 'WhatsApp (URL, ex.: https://wa.me/5521999999999)', 'url' );
}
add_action( 'customize_register', 'eletroproj_customize_register' );
