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
		'perigo' => __( 'Caixa: perigo (risco elétrico)', 'eletroproj' ),
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
	$ensino = array(
		'objetivos' => __( 'Caixa: o que você vai aprender', 'eletroproj' ),
		'exemplo'   => __( 'Caixa: exemplo resolvido', 'eletroproj' ),
		'definicao' => __( 'Caixa: definição', 'eletroproj' ),
		'ferramenta' => __( 'Caixa: ferramenta (calculadora)', 'eletroproj' ),
	);
	foreach ( $ensino as $slug => $label ) {
		register_block_style(
			'core/group',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
	register_block_style(
		'core/paragraph',
		array(
			'name'  => 'definicao',
			'label' => __( 'Caixa: definição', 'eletroproj' ),
		)
	);
	$listas = array(
		'leitura'   => __( 'Leitura complementar', 'eletroproj' ),
		'passos'    => __( 'Passo a passo (lista numerada)', 'eletroproj' ),
		'checklist' => __( 'Checklist', 'eletroproj' ),
	);
	foreach ( $listas as $slug => $label ) {
		register_block_style(
			'core/list',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
	$colunas = array(
		'cartoes'     => __( 'Cartões', 'eletroproj' ),
		'comparativo' => __( 'Comparativo (prós × contras)', 'eletroproj' ),
	);
	foreach ( $colunas as $slug => $label ) {
		register_block_style(
			'core/columns',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
	register_block_style(
		'core/image',
		array(
			'name'  => 'moldura',
			'label' => __( 'Com moldura', 'eletroproj' ),
		)
	);
	$formulas = array(
		'destaque' => __( 'Fórmula em destaque', 'eletroproj' ),
		'numerada' => __( 'Numerada', 'eletroproj' ),
		'limpa'    => __( 'Sem caixa', 'eletroproj' ),
	);
	foreach ( $formulas as $slug => $label ) {
		register_block_style(
			'core/math',
			array(
				'name'  => $slug,
				'label' => $label,
			)
		);
	}
	register_block_style(
		'core/table',
		array(
			'name'  => 'tecnica',
			'label' => __( 'Tabela técnica', 'eletroproj' ),
		)
	);
	register_block_style(
		'core/table',
		array(
			'name'  => 'ficha',
			'label' => __( 'Ficha técnica (nome × valor)', 'eletroproj' ),
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

	register_block_pattern(
		'eletroproj/objetivos',
		array(
			'title'      => __( 'O que você vai aprender', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:group {"className":"is-style-objetivos","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-objetivos"><!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li>Primeiro objetivo do artigo.</li><!-- /wp:list-item --><!-- wp:list-item --><li>Segundo objetivo do artigo.</li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'eletroproj/exemplo-resolvido',
		array(
			'title'      => __( 'Exemplo resolvido (com solução escondida)', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:group {"className":"is-style-exemplo","layout":{"type":"constrained"}} --><div class="wp-block-group is-style-exemplo"><!-- wp:paragraph --><p>Enunciado do exercício.</p><!-- /wp:paragraph --><!-- wp:details --><details class="wp-block-details"><summary>Ver solução</summary><!-- wp:paragraph --><p>Resolução passo a passo.</p><!-- /wp:paragraph --></details><!-- /wp:details --></div><!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'eletroproj/passo-a-passo',
		array(
			'title'      => __( 'Passo a passo', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:list {"ordered":true,"className":"is-style-passos"} --><ol class="wp-block-list is-style-passos"><!-- wp:list-item --><li><strong>Título do passo.</strong> Explicação do passo.</li><!-- /wp:list-item --><!-- wp:list-item --><li><strong>Título do passo.</strong> Explicação do passo.</li><!-- /wp:list-item --></ol><!-- /wp:list -->',
		)
	);

	register_block_pattern(
		'eletroproj/pros-contras',
		array(
			'title'      => __( 'Prós e contras', 'eletroproj' ),
			'categories' => array( 'eletroproj' ),
			'content'    => '<!-- wp:columns {"className":"is-style-comparativo"} --><div class="wp-block-columns is-style-comparativo"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Vantagens</h3><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li>Vantagem.</li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">Desvantagens</h3><!-- /wp:heading --><!-- wp:list --><ul class="wp-block-list"><!-- wp:list-item --><li>Desvantagem.</li><!-- /wp:list-item --></ul><!-- /wp:list --></div><!-- /wp:column --></div><!-- /wp:columns -->',
		)
	);
}
add_action( 'init', 'eletroproj_register_patterns' );
