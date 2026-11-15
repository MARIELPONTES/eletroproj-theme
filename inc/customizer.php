<?php
/**
 * Dados da empresa editáveis em Aparência › Personalizar › Eletroproj.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Valores padrão de cada opção.
 *
 * @return array<string,string|int>
 */
function ep_option_defaults(): array {
	return array(
		'ep_company'       => 'Eletroproj Engenharia',
		'ep_tagline'       => 'Engenharia elétrica aplicada, com rigor técnico e clareza.',
		'ep_city'          => 'Rio de Janeiro, RJ',
		'ep_rt_name'       => 'Mariel Pontes',
		'ep_rt_role'       => 'Engenheiro eletricista',
		'ep_phone_display' => '(21) 98346-6355',
		'ep_whatsapp'      => '5521983466355',
		'ep_quote_page'    => 0,
	);
}

/**
 * Lê uma opção do tema com o padrão definido acima.
 *
 * @param string $key Nome da opção.
 * @return string|int
 */
function ep_opt( string $key ) {
	$defaults = ep_option_defaults();
	return get_theme_mod( $key, $defaults[ $key ] ?? '' );
}

/**
 * Link do WhatsApp (wa.me) com mensagem opcional.
 *
 * @param string $message Texto pré-preenchido.
 */
function ep_whatsapp_url( string $message = '' ): string {
	$number = preg_replace( '/\D+/', '', (string) ep_opt( 'ep_whatsapp' ) );
	$url    = 'https://wa.me/' . $number;
	return $message ? add_query_arg( 'text', rawurlencode( $message ), $url ) : $url;
}

/**
 * Destino do botão "Pedir orçamento": a página escolhida no Personalizar ou, sem ela, o WhatsApp.
 */
function ep_quote_url(): string {
	$page = (int) ep_opt( 'ep_quote_page' );
	if ( $page && 'publish' === get_post_status( $page ) ) {
		return (string) get_permalink( $page ) . '#orcamento';
	}
	return ep_whatsapp_url( 'Olá! Gostaria de pedir um orçamento.' );
}

/**
 * Registra a seção "Eletroproj" no Personalizar.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function ep_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section(
		'ep_company',
		array(
			'title'    => __( 'Eletroproj', 'eletroproj' ),
			'priority' => 30,
		)
	);

	$text_fields = array(
		'ep_company'       => __( 'Nome da empresa (rodapé)', 'eletroproj' ),
		'ep_tagline'       => __( 'Frase do rodapé', 'eletroproj' ),
		'ep_city'          => __( 'Cidade (rodapé)', 'eletroproj' ),
		'ep_rt_name'       => __( 'Responsável técnico — nome', 'eletroproj' ),
		'ep_rt_role'       => __( 'Responsável técnico — título', 'eletroproj' ),
		'ep_phone_display' => __( 'Telefone (como aparece no site)', 'eletroproj' ),
		'ep_whatsapp'      => __( 'WhatsApp (só números, com 55 e DDD)', 'eletroproj' ),
	);

	$defaults = ep_option_defaults();
	foreach ( $text_fields as $id => $label ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $defaults[ $id ],
				'sanitize_callback' => 'ep_whatsapp' === $id ? 'ep_sanitize_digits' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'ep_company',
				'type'    => 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'ep_quote_page',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'ep_quote_page',
		array(
			'label'       => __( 'Página do botão "Pedir orçamento"', 'eletroproj' ),
			'description' => __( 'Sem página escolhida, o botão abre o WhatsApp.', 'eletroproj' ),
			'section'     => 'ep_company',
			'type'        => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'ep_customize_register' );

/**
 * Mantém só dígitos.
 *
 * @param string $value Valor digitado.
 */
function ep_sanitize_digits( $value ): string {
	return preg_replace( '/\D+/', '', (string) $value );
}
