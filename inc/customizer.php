<?php
/**
 * Textos e dados editáveis em Aparência › Personalizar › Eletroproj.
 * Valores padrão = textos do Figma (exceto dados reais da empresa).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Campos por seção: id => array( rótulo, padrão, tipo ).
 * Tipos: text, textarea, url, digits, page, category, image.
 *
 * @return array<string,array{title:string,fields:array<string,array{0:string,1:mixed,2:string}>}>
 */
function ep_fields(): array {
	return array(
		'ep_company'    => array(
			'title'  => __( 'Empresa e contato', 'eletroproj' ),
			'fields' => array(
				'ep_company'       => array( 'Nome da empresa (rodapé)', 'Eletroproj Engenharia', 'text' ),
				'ep_tagline'       => array( 'Frase do rodapé', 'Engenharia elétrica aplicada, com rigor técnico e clareza.', 'textarea' ),
				'ep_city'          => array( 'Cidade (rodapé)', 'Rio de Janeiro, RJ', 'text' ),
				'ep_rt_name'       => array( 'Responsável técnico — nome', 'Mariel Pontes', 'text' ),
				'ep_rt_role'       => array( 'Responsável técnico — título', 'Engenheiro eletricista', 'text' ),
				'ep_rt_bio'        => array( 'Responsável técnico — mini bio ("Sobre o autor" nos posts)', '', 'textarea' ),
				'ep_phone_display' => array( 'Telefone (como aparece no site)', '(21) 98346-6355', 'text' ),
				'ep_whatsapp'      => array( 'WhatsApp (só números, com 55 e DDD)', '5521983466355', 'digits' ),
				'ep_quote_page'    => array( 'Página do botão "Pedir orçamento" (sem página: abre o WhatsApp)', 0, 'page' ),
			),
		),
		'ep_home'       => array(
			'title'  => __( 'Página inicial', 'eletroproj' ),
			'fields' => array(
				'ep_hero_eyebrow' => array( 'Topo — rótulo', 'Biblioteca técnica Eletroproj', 'text' ),
				'ep_hero_title'   => array( 'Topo — título', 'Engenharia elétrica explicada por quem executa.', 'textarea' ),
				'ep_hero_text'    => array( 'Topo — texto', 'Guias, ferramentas e critérios de campo para tomar decisões mais seguras em instalações elétricas.', 'textarea' ),
				'ep_hero_image'   => array( 'Topo — imagem (mín. 1120 × 970 px)', 0, 'image' ),
				'ep_hero_note1'   => array( 'Topo — etiqueta da imagem, linha 1', 'PROJETO EM ANÁLISE', 'text' ),
				'ep_hero_note2'   => array( 'Topo — etiqueta da imagem, linha 2', 'QD-03 / ALIMENTADORES', 'text' ),
				'ep_hero_note3'   => array( 'Topo — etiqueta da imagem, linha 3', 'REV. 04 · 18.06.2025', 'text' ),
				'ep_guides_url'   => array( 'Link "Explorar guias" e "Ver todos"', '', 'url' ),
				'ep_proof2_b'     => array( 'Prova 2 — destaque', '12 anos', 'text' ),
				'ep_proof2_t'     => array( 'Prova 2 — texto', 'em campo', 'text' ),
				'ep_proof3_b'     => array( 'Prova 3 — destaque', 'CREA-RJ', 'text' ),
				'ep_proof3_t'     => array( 'Prova 3 — texto', 'ativo', 'text' ),
				'ep_pillar1_cat'  => array( 'Guia pilar 1 — categoria', 0, 'category' ),
				'ep_pillar1_title' => array( 'Guia pilar 1 — título', 'Proteção contra descargas atmosféricas', 'text' ),
				'ep_pillar1_text' => array( 'Guia pilar 1 — texto', 'Da análise de risco à inspeção periódica.', 'text' ),
				'ep_pillar2_cat'  => array( 'Guia pilar 2 — categoria', 0, 'category' ),
				'ep_pillar2_title' => array( 'Guia pilar 2 — título', 'Instalações elétricas de baixa tensão', 'text' ),
				'ep_pillar2_text' => array( 'Guia pilar 2 — texto', 'Dimensionamento, proteção e segurança.', 'text' ),
				'ep_pillar3_cat'  => array( 'Guia pilar 3 — categoria', 0, 'category' ),
				'ep_pillar3_title' => array( 'Guia pilar 3 — título', 'Automação e painéis industriais', 'text' ),
				'ep_pillar3_text' => array( 'Guia pilar 3 — texto', 'Comando, controle e confiabilidade.', 'text' ),
				'ep_tool1_title'  => array( 'Ferramenta 1 — título', 'Queda de tensão', 'text' ),
				'ep_tool1_text'   => array( 'Ferramenta 1 — texto', 'Verifique circuitos monofásicos e trifásicos.', 'text' ),
				'ep_tool1_url'    => array( 'Ferramenta 1 — link', '', 'url' ),
				'ep_tool2_title'  => array( 'Ferramenta 2 — título', 'Seção de condutores', 'text' ),
				'ep_tool2_text'   => array( 'Ferramenta 2 — texto', 'Dimensione por capacidade e queda.', 'text' ),
				'ep_tool2_url'    => array( 'Ferramenta 2 — link', '', 'url' ),
				'ep_tool3_title'  => array( 'Ferramenta 3 — título', 'Corrente de projeto', 'text' ),
				'ep_tool3_text'   => array( 'Ferramenta 3 — texto', 'Converta potência em corrente elétrica.', 'text' ),
				'ep_tool3_url'    => array( 'Ferramenta 3 — link', '', 'url' ),
				'ep_svc_eyebrow'  => array( 'Painel de serviços — rótulo', 'Engenharia aplicada', 'text' ),
				'ep_svc_title'    => array( 'Painel de serviços — título', 'Do diagnóstico à entrega técnica.', 'text' ),
				'ep_svc_text'     => array( 'Painel de serviços — texto', 'Projetos, laudos e inspeções conduzidos por engenheiro eletricista, com documentação clara e responsabilidade técnica.', 'textarea' ),
				'ep_svc_item1'    => array( 'Painel de serviços — item 1', 'Projetos de SPDA e aterramento', 'text' ),
				'ep_svc_item2'    => array( 'Painel de serviços — item 2', 'Laudos e inspeções NR-10', 'text' ),
				'ep_svc_item3'    => array( 'Painel de serviços — item 3', 'Adequação de painéis elétricos', 'text' ),
				'ep_svc_url'      => array( 'Painel de serviços — link do botão', '', 'url' ),
			),
		),
		'ep_newsletter' => array(
			'title'  => __( 'Newsletter (Brevo)', 'eletroproj' ),
			'fields' => array(
				'ep_nl_enabled'  => array( 'Mostrar newsletter (1 = sim, 0 = não)', '1', 'digits' ),
				'ep_nl_eyebrow'  => array( 'Rótulo', 'Material gratuito', 'text' ),
				'ep_nl_title'    => array( 'Título', 'Leve o checklist para a próxima inspeção', 'text' ),
				'ep_nl_text'     => array( 'Texto', 'Receba o PDF com 28 itens essenciais para uma vistoria de SPDA consistente.', 'textarea' ),
				'ep_nl_cover1'   => array( 'Capa — texto grande (use | para quebrar linha)', 'NBR|5419', 'text' ),
				'ep_nl_cover2'   => array( 'Capa — texto pequeno (use | para quebrar linha)', 'CHECKLIST|DE INSPEÇÃO', 'text' ),
				'ep_nl_button'   => array( 'Botão', 'Receber PDF', 'text' ),
				'ep_nl_note'     => array( 'Nota abaixo do campo', 'Sem spam. Conteúdo técnico, uma vez por mês.', 'text' ),
				'ep_nl_success'  => array( 'Mensagem de sucesso', 'Material enviado. Verifique sua caixa de entrada.', 'text' ),
				'ep_brevo_key'   => array( 'Brevo — chave da API (v3)', '', 'text' ),
				'ep_brevo_list'  => array( 'Brevo — ID da lista', '', 'digits' ),
			),
		),
	);
}

/**
 * Padrões de todas as opções.
 *
 * @return array<string,mixed>
 */
function ep_option_defaults(): array {
	static $defaults = null;
	if ( null === $defaults ) {
		$defaults = array();
		foreach ( ep_fields() as $section ) {
			foreach ( $section['fields'] as $id => $field ) {
				$defaults[ $id ] = $field[1];
			}
		}
	}
	return $defaults;
}

/**
 * Lê uma opção do tema (com o padrão do Figma).
 *
 * @param string $key Nome da opção.
 * @return mixed
 */
function ep_opt( string $key ) {
	$defaults = ep_option_defaults();
	$value    = get_theme_mod( $key, $defaults[ $key ] ?? '' );
	return ( '' === $value || null === $value ) && isset( $defaults[ $key ] ) ? $defaults[ $key ] : $value;
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
 * Destino do botão "Pedir orçamento": a página escolhida ou, sem ela, o WhatsApp.
 */
function ep_quote_url(): string {
	$page = (int) ep_opt( 'ep_quote_page' );
	if ( $page && 'publish' === get_post_status( $page ) ) {
		return (string) get_permalink( $page ) . '#orcamento';
	}
	return ep_whatsapp_url( 'Olá! Gostaria de pedir um orçamento.' );
}

/**
 * Página de serviços (a do orçamento) ou WhatsApp.
 */
function ep_services_url(): string {
	$page = (int) ep_opt( 'ep_quote_page' );
	if ( $page && 'publish' === get_post_status( $page ) ) {
		return (string) get_permalink( $page );
	}
	return ep_whatsapp_url( 'Olá! Gostaria de falar com um engenheiro.' );
}

/**
 * Mantém só dígitos.
 *
 * @param mixed $value Valor digitado.
 */
function ep_sanitize_digits( $value ): string {
	return preg_replace( '/\D+/', '', (string) $value );
}

/**
 * Registra o painel "Eletroproj" no Personalizar.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function ep_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel(
		'ep_panel',
		array(
			'title'    => __( 'Eletroproj', 'eletroproj' ),
			'priority' => 30,
		)
	);

	$categories = array( 0 => __( '— Automático —', 'eletroproj' ) );
	foreach ( get_categories( array( 'hide_empty' => false ) ) as $cat ) {
		$categories[ $cat->term_id ] = $cat->name;
	}

	$sanitizers = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'url'      => 'esc_url_raw',
		'digits'   => 'ep_sanitize_digits',
		'page'     => 'absint',
		'category' => 'absint',
		'image'    => 'absint',
	);

	foreach ( ep_fields() as $section_id => $section ) {
		$wp_customize->add_section(
			$section_id,
			array(
				'title' => $section['title'],
				'panel' => 'ep_panel',
			)
		);

		foreach ( $section['fields'] as $id => list( $label, $default, $type ) ) {
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => $default,
					'sanitize_callback' => $sanitizers[ $type ],
				)
			);

			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize,
						$id,
						array(
							'label'     => $label,
							'section'   => $section_id,
							'mime_type' => 'image',
						)
					)
				);
				continue;
			}

			$args = array(
				'label'   => $label,
				'section' => $section_id,
				'type'    => array(
					'page'     => 'dropdown-pages',
					'category' => 'select',
					'textarea' => 'textarea',
					'url'      => 'url',
				)[ $type ] ?? 'text',
			);
			if ( 'category' === $type ) {
				$args['choices'] = $categories;
			}
			$wp_customize->add_control( $id, $args );
		}
	}
}
add_action( 'customize_register', 'ep_customize_register' );
