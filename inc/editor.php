<?php
/**
 * Editor de blocos: estilos de bloco e padrões com os componentes do Figma,
 * e o visual do tema dentro do editor.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Estilos de bloco (aparecem na aba "Estilos" do bloco).
 */
function ep_register_block_styles(): void {
	$styles = array(
		'core/paragraph' => array( 'section-number' => __( 'Rótulo de seção', 'eletroproj' ) ),
		'core/quote'     => array( 'norma' => __( 'Caixa da norma', 'eletroproj' ) ),
		'core/group'     => array(
			'callout' => __( 'Aviso', 'eletroproj' ),
			'formula' => __( 'Fórmula', 'eletroproj' ),
		),
		'core/list'      => array(
			'checklist' => __( 'Checklist', 'eletroproj' ),
			'steps'     => __( 'Etapas numeradas', 'eletroproj' ),
		),
	);
	foreach ( $styles as $block => $list ) {
		foreach ( $list as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'ep_register_block_styles' );

/**
 * Padrões (botão + › Padrões › Eletroproj).
 */
function ep_register_patterns(): void {
	register_block_pattern_category( 'eletroproj', array( 'label' => 'Eletroproj' ) );

	$wa = esc_url( ep_whatsapp_url( 'Olá! Vim pelo site e gostaria de uma avaliação técnica.' ) );

	$patterns = array(
		'secao'     => array(
			__( 'Título de seção com rótulo (01 — FUNDAMENTOS)', 'eletroproj' ),
			'<!-- wp:paragraph {"className":"is-style-section-number"} --><p class="is-style-section-number">01 — Fundamentos</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">O que é o SPDA e por que ele importa</h2><!-- /wp:heading -->',
		),
		'norma'     => array(
			__( 'Caixa da norma (NBR)', 'eletroproj' ),
			'<!-- wp:quote {"className":"is-style-norma"} --><blockquote class="wp-block-quote is-style-norma"><!-- wp:paragraph --><p>NBR 5419:2015 · Parte 3, seção 5.1</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>“O SPDA deve ser composto por sistemas externo e interno de proteção contra descargas atmosféricas.”</p><!-- /wp:paragraph --><cite>Nota técnica: consulte sempre a edição vigente da norma.</cite></blockquote><!-- /wp:quote -->',
		),
		'aviso'     => array(
			__( 'Aviso (Importante)', 'eletroproj' ),
			'<!-- wp:group {"className":"is-style-callout","layout":{"type":"default"}} --><div class="wp-block-group is-style-callout"><!-- wp:paragraph --><p><strong>Importante</strong></p><!-- /wp:paragraph --><!-- wp:paragraph --><p>O SPDA protege a estrutura. Equipamentos eletrônicos exigem proteção coordenada por DPS e equipotencialização.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
		),
		'formula'   => array(
			__( 'Fórmula', 'eletroproj' ),
			'<!-- wp:group {"className":"is-style-formula","layout":{"type":"default"}} --><div class="wp-block-group is-style-formula"><!-- wp:paragraph --><p>R = N<sub>D</sub> × P<sub>B</sub> × L<sub>B</sub></p><!-- /wp:paragraph --><!-- wp:paragraph --><p>Risco de perda de vida = eventos perigosos × probabilidade de dano × perda consequente</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
		),
		'etapas'    => array(
			__( 'Etapas numeradas', 'eletroproj' ),
			'<!-- wp:list {"ordered":true,"className":"is-style-steps"} --><ol class="wp-block-list is-style-steps"><!-- wp:list-item --><li><strong>Captação</strong>Intercepta a descarga por hastes, cabos suspensos ou malhas.</li><!-- /wp:list-item --><!-- wp:list-item --><li><strong>Descidas</strong>Distribuem a corrente até o aterramento, com trajetos curtos e diretos.</li><!-- /wp:list-item --><!-- wp:list-item --><li><strong>Aterramento</strong>Dissipa a corrente no solo e integra a equipotencialização.</li><!-- /wp:list-item --></ol><!-- /wp:list -->',
		),
		'checklist' => array(
			__( 'Checklist', 'eletroproj' ),
			'<!-- wp:list {"className":"is-style-checklist"} --><ul class="wp-block-list is-style-checklist"><!-- wp:list-item --><li>Continuidade elétrica</li><!-- /wp:list-item --><!-- wp:list-item --><li>Estado dos captores</li><!-- /wp:list-item --><!-- wp:list-item --><li>Conexões e corrosão</li><!-- /wp:list-item --><!-- wp:list-item --><li>Equipotencialização</li><!-- /wp:list-item --></ul><!-- /wp:list -->',
		),
		'whatsapp'  => array(
			__( 'Chamada para WhatsApp', 'eletroproj' ),
			'<!-- wp:group {"className":"whatsapp-cta","layout":{"type":"default"}} --><div class="wp-block-group whatsapp-cta"><!-- wp:group {"layout":{"type":"default"}} --><div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow"} --><p class="eyebrow">Avaliação técnica</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Precisa validar o SPDA do seu edifício?</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Envie plantas ou fotos. Um engenheiro analisa o cenário e orienta o próximo passo.</p><!-- /wp:paragraph --></div><!-- /wp:group --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' . $wa . '">Conversar no WhatsApp →</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
		),
		'faq'       => array(
			__( 'Perguntas frequentes', 'eletroproj' ),
			'<!-- wp:paragraph {"className":"is-style-section-number"} --><p class="is-style-section-number">Dúvidas frequentes</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Perguntas frequentes</h2><!-- /wp:heading --><!-- wp:details --><details class="wp-block-details"><summary>Toda edificação precisa de SPDA?</summary><!-- wp:paragraph --><p>Não necessariamente. A necessidade é definida pela análise de risco da NBR 5419-2.</p><!-- /wp:paragraph --></details><!-- /wp:details --><!-- wp:details --><details class="wp-block-details"><summary>Qual é a validade de um laudo de SPDA?</summary><!-- wp:paragraph --><p>A norma define periodicidades de inspeção conforme o tipo da estrutura.</p><!-- /wp:paragraph --></details><!-- /wp:details -->',
		),
	);

	foreach ( $patterns as $slug => list( $title, $content ) ) {
		register_block_pattern(
			'eletroproj/' . $slug,
			array(
				'title'      => $title,
				'categories' => array( 'eletroproj' ),
				'content'    => $content,
			)
		);
	}
}
add_action( 'init', 'ep_register_patterns' );

/**
 * Visual do tema dentro do editor (mesmo CSS do site, aplicado à área de edição).
 *
 * @param array $settings Configurações do editor.
 */
function ep_editor_styles( array $settings ): array {
	$css = '';
	foreach ( array( 'base', 'post' ) as $file ) {
		$path = EP_DIR . '/assets/css/' . $file . '.css';
		if ( is_readable( $path ) ) {
			$css .= (string) file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		}
	}
	$css  = str_replace( array( '{{theme}}', '.entry-content' ), array( esc_url_raw( EP_URI ), '.is-root-container' ), $css );
	$css .= 'body{padding:24px}.editor-styles-wrapper .wp-block-post-content,.editor-styles-wrapper .is-root-container{color:var(--muted)}';
	$css .= '.editor-styles-wrapper .is-root-container{max-width:740px;margin-inline:auto}';

	$settings['styles'][] = array( 'css' => $css );
	return $settings;
}
add_filter( 'block_editor_settings_all', 'ep_editor_styles' );
