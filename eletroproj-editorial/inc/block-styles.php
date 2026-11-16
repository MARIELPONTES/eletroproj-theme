<?php
/**
 * Estilos de bloco e padrões (patterns) para usar no editor.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Estilos extras para blocos nativos.
 */
function eletroproj_register_block_styles() {
	$caixas = array(
		'nota'   => __( 'Caixa: nota', 'eletroproj' ),
		'dica'   => __( 'Caixa: dica', 'eletroproj' ),
		'alerta' => __( 'Caixa: atenção', 'eletroproj' ),
		'norma'  => __( 'Caixa: norma técnica', 'eletroproj' ),
	);
	foreach ( array( 'core/group', 'core/paragraph' ) as $block ) {
		foreach ( $caixas as $slug => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $slug,
					'label' => $label,
				)
			);
		}
	}
	register_block_style(
		'core/list',
		array(
			'name'  => 'leitura',
			'label' => __( 'Leitura complementar', 'eletroproj' ),
		)
	);
	register_block_style(
		'core/image',
		array(
			'name'  => 'moldura',
			'label' => __( 'Com moldura', 'eletroproj' ),
		)
	);
	register_block_style(
		'core/table',
		array(
			'name'  => 'tecnica',
			'label' => __( 'Tabela técnica', 'eletroproj' ),
		)
	);
}
add_action( 'init', 'eletroproj_register_block_styles' );

/**
 * Categoria e padrões de bloco do tema.
 */
function eletroproj_register_patterns() {
	register_block_pattern_category( 'eletroproj', array( 'label' => __( 'Eletroproj', 'eletroproj' ) ) );

	register_block_pattern(
		'eletroproj/leitura-complementar',
		array(
			'title'      => __( 'Leitura complementar', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:list {"className":"is-style-leitura"} --><ul class="wp-block-list is-style-leitura"><!-- wp:list-item --><li><a href="#">Título do artigo relacionado</a></li><!-- /wp:list-item --><!-- wp:list-item --><li><a href="#">Outro artigo relacionado</a></li><!-- /wp:list-item --></ul><!-- /wp:list -->',
		)
	);

	register_block_pattern(
		'eletroproj/caixa-norma',
		array(
			'title'      => __( 'Caixa: o que diz a norma', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:group {"className":"is-style-norma","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-norma"><!-- wp:paragraph --><p><strong>NBR 5410, item 6.2.6</strong> — Descreva aqui o requisito da norma de forma resumida.</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'eletroproj/resumo-pontos',
		array(
			'title'      => __( 'Resumo em pontos', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:group {"className":"is-style-dica","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-dica"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Resumo</h3><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li>Primeiro ponto principal.</li><!-- /wp:list-item --><!-- wp:list-item --><li>Segundo ponto principal.</li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'eletroproj_register_patterns' );
