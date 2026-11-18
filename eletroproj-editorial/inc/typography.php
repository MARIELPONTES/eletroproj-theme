<?php
/**
 * Tipografia no Personalizador: fonte, tamanho, peso, altura da linha e cores
 * (modo claro e escuro) de cada tipo de texto, com botão de restaurar o padrão.
 *
 * Só o que for alterado vira CSS; campos vazios mantêm o estilo original do tema.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Elementos de texto configuráveis.
 *
 * Cada item: rótulo, seletor CSS, descrição do padrão do tema.
 *
 * @return array
 */
function eletroproj_tipo_elementos() {
	return array(
		'geral'        => array(
			__( 'Texto geral do site', 'eletroproj' ),
			'body',
			__( 'Padrão: Literata, 18 px (17 px no celular), linha 1,6.', 'eletroproj' ),
		),
		'artigo'       => array(
			__( 'Texto dos artigos', 'eletroproj' ),
			'.entry-content',
			__( 'Padrão: Literata, 18 a 20 px conforme a tela, linha 1,7.', 'eletroproj' ),
		),
		'h1'           => array(
			__( 'Título do artigo e das páginas (H1)', 'eletroproj' ),
			'.article-head__title, .page-head__title, .entry-content h1',
			__( 'Padrão: Bricolage Grotesque, peso 800, 34 a 51 px conforme a tela.', 'eletroproj' ),
		),
		'h2'           => array(
			__( 'Subtítulos H2 (dentro do artigo)', 'eletroproj' ),
			'.entry-content h2',
			__( 'Padrão: Bricolage Grotesque, peso 800, 25 a 31 px conforme a tela.', 'eletroproj' ),
		),
		'h3'           => array(
			__( 'Subtítulos H3 (dentro do artigo)', 'eletroproj' ),
			'.entry-content h3',
			__( 'Padrão: Bricolage Grotesque, peso 800, 21 a 24 px conforme a tela.', 'eletroproj' ),
		),
		'h4'           => array(
			__( 'Subtítulos H4, H5 e H6 (dentro do artigo)', 'eletroproj' ),
			'.entry-content h4, .entry-content h5, .entry-content h6',
			__( 'Padrão: Bricolage Grotesque, peso 800, 18 px.', 'eletroproj' ),
		),
		'resumo'       => array(
			__( 'Resumo rápido (topo do artigo)', 'eletroproj' ),
			'.summary p',
			__( 'Padrão: Literata itálico, 21 px, linha 1,55.', 'eletroproj' ),
		),
		'card_titulo'  => array(
			__( 'Títulos dos posts nas listas', 'eletroproj' ),
			'.card__title, .card-featured__title, .card-mini__title',
			__( 'Padrão: Bricolage Grotesque, peso 800, 21 a 25 px conforme a tela.', 'eletroproj' ),
		),
		'card_resumo'  => array(
			__( 'Resumo dos posts nas listas', 'eletroproj' ),
			'.card__excerpt, .card-featured__excerpt',
			__( 'Padrão: Literata, 16 px, linha 1,65.', 'eletroproj' ),
		),
		'meta'         => array(
			__( 'Autor, data, categorias e trilha (breadcrumbs)', 'eletroproj' ),
			'.card-meta, .meta-line, .article-head__byline, .byline, .meta-box, .breadcrumbs ol',
			__( 'Padrão: 14 a 15 px, cor suave.', 'eletroproj' ),
		),
		'menu'         => array(
			__( 'Menu principal (cabeçalho)', 'eletroproj' ),
			'.primary-nav__list a',
			__( 'Padrão: Bricolage Grotesque, peso 700, 16 px, branco.', 'eletroproj' ),
		),
		'categorias'   => array(
			__( 'Faixa de categorias (abaixo do menu)', 'eletroproj' ),
			'.pills a',
			__( 'Padrão: Bricolage Grotesque, peso 700, 14 px, cor da marca.', 'eletroproj' ),
		),
		'indice'       => array(
			__( 'Índice do artigo ("Neste artigo")', 'eletroproj' ),
			'.toc__title, .toc__list, .toc__item a',
			__( 'Padrão: 15 a 16 px, linha 1,5.', 'eletroproj' ),
		),
		'lateral'      => array(
			__( 'Lateral do artigo (widgets)', 'eletroproj' ),
			'.widget',
			__( 'Padrão: 16 px.', 'eletroproj' ),
		),
		'rodape'       => array(
			__( 'Rodapé', 'eletroproj' ),
			'.site-footer, .site-footer a',
			__( 'Padrão: 16 px, branco.', 'eletroproj' ),
		),
	);
}

/**
 * Propriedades configuráveis de cada elemento.
 *
 * @return array id => rótulo
 */
function eletroproj_tipo_props() {
	return array(
		'fonte'         => __( 'Fonte', 'eletroproj' ),
		'tamanho'       => __( 'Tamanho (px)', 'eletroproj' ),
		'tamanho_cel'   => __( 'Tamanho no celular (px)', 'eletroproj' ),
		'peso'          => __( 'Peso (espessura)', 'eletroproj' ),
		'linha'         => __( 'Altura da linha', 'eletroproj' ),
		'cor_claro'     => __( 'Cor no modo claro', 'eletroproj' ),
		'cor_escuro'    => __( 'Cor no modo escuro', 'eletroproj' ),
	);
}

/**
 * Fontes disponíveis. As do tema já estão hospedadas no site; as "do sistema"
 * não baixam nada (melhor para o PageSpeed).
 *
 * @return array id => array( rótulo, pilha CSS )
 */
function eletroproj_tipo_fontes() {
	return array(
		'literata'  => array( __( 'Literata (serifada, do tema)', 'eletroproj' ), "Literata, Georgia, 'Times New Roman', serif" ),
		'bricolage' => array( __( 'Bricolage Grotesque (títulos, do tema — pesos 700 e 800)', 'eletroproj' ), "'Bricolage Grotesque', 'Segoe UI', system-ui, -apple-system, Arial, sans-serif" ),
		'jetbrains' => array( __( 'JetBrains Mono (monoespaçada, do tema)', 'eletroproj' ), "'JetBrains Mono', ui-monospace, SFMono-Regular, Menlo, Consolas, monospace" ),
		'sistema'   => array( __( 'Sem serifa do sistema (Segoe UI / San Francisco / Roboto)', 'eletroproj' ), "system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif" ),
		'arial'     => array( __( 'Arial / Helvetica', 'eletroproj' ), "Arial, 'Helvetica Neue', Helvetica, sans-serif" ),
		'verdana'   => array( __( 'Verdana', 'eletroproj' ), 'Verdana, Geneva, sans-serif' ),
		'tahoma'    => array( __( 'Tahoma', 'eletroproj' ), 'Tahoma, Verdana, sans-serif' ),
		'trebuchet' => array( __( 'Trebuchet MS', 'eletroproj' ), "'Trebuchet MS', 'Lucida Grande', sans-serif" ),
		'georgia'   => array( __( 'Georgia (serifada do sistema)', 'eletroproj' ), "Georgia, 'Times New Roman', serif" ),
		'times'     => array( __( 'Times New Roman', 'eletroproj' ), "'Times New Roman', Times, serif" ),
		'mono'      => array( __( 'Monoespaçada do sistema', 'eletroproj' ), 'ui-monospace, SFMono-Regular, Menlo, Consolas, monospace' ),
	);
}

/**
 * Nome do setting.
 *
 * @param string $el   Elemento.
 * @param string $prop Propriedade.
 * @return string
 */
function eletroproj_tipo_id( $el, $prop ) {
	return 'eletroproj_tipo_' . $el . '_' . $prop;
}

/**
 * Todos os IDs de settings da tipografia.
 *
 * @return string[]
 */
function eletroproj_tipo_all_ids() {
	$ids = array();
	foreach ( array_keys( eletroproj_tipo_elementos() ) as $el ) {
		foreach ( array_keys( eletroproj_tipo_props() ) as $prop ) {
			$ids[] = eletroproj_tipo_id( $el, $prop );
		}
	}
	return $ids;
}

/**
 * Sanitiza conforme a propriedade (vazio = padrão do tema).
 *
 * @param mixed  $v    Valor.
 * @param string $prop Propriedade.
 * @return string
 */
function eletroproj_tipo_sanitize( $v, $prop ) {
	$v = is_string( $v ) || is_numeric( $v ) ? trim( (string) $v ) : '';
	if ( '' === $v ) {
		return '';
	}
	switch ( $prop ) {
		case 'fonte':
			return array_key_exists( $v, eletroproj_tipo_fontes() ) ? $v : '';
		case 'tamanho':
		case 'tamanho_cel':
			$n = (float) str_replace( ',', '.', $v );
			return ( $n >= 8 && $n <= 120 ) ? (string) round( $n, 1 ) : '';
		case 'peso':
			return in_array( $v, array( '300', '400', '500', '600', '700', '800', '900' ), true ) ? $v : '';
		case 'linha':
			$n = (float) str_replace( ',', '.', $v );
			return ( $n >= 0.8 && $n <= 3 ) ? (string) round( $n, 2 ) : '';
		case 'cor_claro':
		case 'cor_escuro':
			$c = sanitize_hex_color( $v );
			return $c ? $c : '';
	}
	return '';
}

/**
 * Valor salvo de uma propriedade.
 *
 * @param string $el   Elemento.
 * @param string $prop Propriedade.
 * @return string
 */
function eletroproj_tipo_get( $el, $prop ) {
	return eletroproj_tipo_sanitize( get_theme_mod( eletroproj_tipo_id( $el, $prop ), '' ), $prop );
}

/**
 * Prefixa cada parte de uma lista de seletores.
 *
 * @param string $prefix Prefixo.
 * @param string $sel    Seletores separados por vírgula.
 * @return string
 */
function eletroproj_tipo_prefix( $prefix, $sel ) {
	$parts = array_map( 'trim', explode( ',', $sel ) );
	return implode(
		',',
		array_map(
			function ( $p ) use ( $prefix ) {
				return 'body' === $p ? $prefix . ' body' : $prefix . ' ' . $p;
			},
			$parts
		)
	);
}

/**
 * Gera o CSS só com o que foi alterado.
 *
 * @return string
 */
function eletroproj_tipo_css() {
	$fontes = eletroproj_tipo_fontes();
	$base   = '';
	$claro  = '';
	$escuro = '';
	$cel    = '';

	foreach ( eletroproj_tipo_elementos() as $el => $info ) {
		$sel   = $info[1];
		$rules = '';

		$fonte = eletroproj_tipo_get( $el, 'fonte' );
		if ( $fonte ) {
			$rules .= 'font-family:' . $fontes[ $fonte ][1] . ';';
		}
		$tam = eletroproj_tipo_get( $el, 'tamanho' );
		if ( $tam ) {
			$rules .= 'font-size:' . $tam . 'px;';
		}
		$peso = eletroproj_tipo_get( $el, 'peso' );
		if ( $peso ) {
			$rules .= 'font-weight:' . $peso . ';';
		}
		$linha = eletroproj_tipo_get( $el, 'linha' );
		if ( $linha ) {
			$rules .= 'line-height:' . $linha . ';';
		}
		if ( $rules ) {
			$base .= $sel . '{' . $rules . '}';
		}

		$cor = eletroproj_tipo_get( $el, 'cor_claro' );
		if ( $cor ) {
			$claro .= eletroproj_tipo_prefix( 'html:not([data-theme="dark"])', $sel ) . '{color:' . $cor . '}';
		}
		$cor = eletroproj_tipo_get( $el, 'cor_escuro' );
		if ( $cor ) {
			$escuro .= eletroproj_tipo_prefix( 'html[data-theme="dark"]', $sel ) . '{color:' . $cor . '}';
		}
		$tam_cel = eletroproj_tipo_get( $el, 'tamanho_cel' );
		if ( $tam_cel ) {
			$cel .= $sel . '{font-size:' . $tam_cel . 'px}';
		}
	}

	$css = $base . $claro . $escuro;
	if ( $cel ) {
		$css .= '@media (max-width:760px){' . $cel . '}';
	}
	return $css;
}

/**
 * Tag <style> da tipografia (sempre impressa, mesmo vazia, para a pré-visualização ao vivo).
 *
 * @return string
 */
function eletroproj_tipo_style_tag() {
	return '<style id="eletroproj-tipografia-css">' . eletroproj_tipo_css() . '</style>';
}

/**
 * Imprime o CSS depois do CSS do tema (para ter prioridade).
 */
function eletroproj_tipo_print() {
	echo eletroproj_tipo_style_tag() . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- CSS gerado só com valores sanitizados.
}
add_action( 'wp_head', 'eletroproj_tipo_print', 20 );

/**
 * Define o botão "Restaurar padrão" (só existe dentro do Personalizador).
 */
function eletroproj_tipo_define_controls() {
	if ( class_exists( 'Eletroproj_Reset_Control' ) || ! class_exists( 'WP_Customize_Control' ) ) {
		return;
	}

	/**
	 * Botão que volta um grupo de opções ao padrão do tema.
	 */
	class Eletroproj_Reset_Control extends WP_Customize_Control {
		/**
		 * Tipo.
		 *
		 * @var string
		 */
		public $type = 'eletroproj-reset';

		/**
		 * IDs que o botão limpa.
		 *
		 * @var string[]
		 */
		public $reset_ids = array();

		/**
		 * Texto do botão.
		 *
		 * @var string
		 */
		public $button_text = '';

		/**
		 * HTML do controle.
		 */
		public function render_content() {
			?>
			<?php if ( $this->label ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( $this->description ) : ?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php endif; ?>
			<button type="button" class="button eletroproj-reset" data-ids="<?php echo esc_attr( wp_json_encode( array_values( $this->reset_ids ) ) ); ?>">
				<?php echo esc_html( $this->button_text ? $this->button_text : __( 'Restaurar padrão', 'eletroproj' ) ); ?>
			</button>
			<?php
		}
	}
}
add_action( 'customize_register', 'eletroproj_tipo_define_controls', 0 );

/**
 * Registra o painel de tipografia.
 *
 * @param WP_Customize_Manager $wp_customize Gerenciador.
 */
function eletroproj_tipo_customize_register( $wp_customize ) {
	$elementos = eletroproj_tipo_elementos();
	$props     = eletroproj_tipo_props();
	$fontes    = array( '' => __( '— Padrão do tema —', 'eletroproj' ) );
	foreach ( eletroproj_tipo_fontes() as $id => $f ) {
		$fontes[ $id ] = $f[0];
	}
	$pesos = array(
		''    => __( '— Padrão do tema —', 'eletroproj' ),
		'300' => '300 — fino',
		'400' => '400 — normal',
		'500' => '500 — médio',
		'600' => '600 — seminegrito',
		'700' => '700 — negrito',
		'800' => '800 — extranegrito',
		'900' => '900 — preto',
	);

	$wp_customize->add_panel(
		'eletroproj_tipografia',
		array(
			'title'       => __( 'Tipografia (Eletroproj)', 'eletroproj' ),
			'priority'    => 31,
			'description' => __( 'Fonte, tamanho, peso, altura da linha e cores de cada tipo de texto. Campo vazio = padrão do tema.', 'eletroproj' ),
		)
	);

	// Seção com o botão de restaurar tudo.
	$wp_customize->add_section(
		'eletroproj_tipo_geral_reset',
		array(
			'title'    => __( 'Restaurar toda a tipografia', 'eletroproj' ),
			'panel'    => 'eletroproj_tipografia',
			'priority' => 999,
		)
	);
	$wp_customize->add_control(
		new Eletroproj_Reset_Control(
			$wp_customize,
			'eletroproj_tipo_reset_tudo',
			array(
				'settings'    => array(),
				'section'     => 'eletroproj_tipo_geral_reset',
				'description' => __( 'Volta todos os textos ao padrão do tema. Nada é salvo até você clicar em Publicar.', 'eletroproj' ),
				'button_text' => __( 'Restaurar tudo ao padrão', 'eletroproj' ),
				'reset_ids'   => eletroproj_tipo_all_ids(),
			)
		)
	);

	$prio = 10;
	foreach ( $elementos as $el => $info ) {
		$section = 'eletroproj_tipo_' . $el;
		$wp_customize->add_section(
			$section,
			array(
				'title'       => $info[0],
				'panel'       => 'eletroproj_tipografia',
				'priority'    => $prio,
				'description' => $info[2],
			)
		);
		$prio += 10;

		$ids = array();
		foreach ( array_keys( $props ) as $prop ) {
			$ids[] = eletroproj_tipo_id( $el, $prop );
		}

		// Botão de restaurar desta seção (no topo).
		$wp_customize->add_control(
			new Eletroproj_Reset_Control(
				$wp_customize,
				$section . '_reset',
				array(
					'settings'    => array(),
					'section'     => $section,
					'priority'    => 1,
					'button_text' => __( 'Restaurar padrão deste texto', 'eletroproj' ),
					'reset_ids'   => $ids,
				)
			)
		);

		foreach ( $props as $prop => $label ) {
			$id = eletroproj_tipo_id( $el, $prop );
			$wp_customize->add_setting(
				$id,
				array(
					'default'           => '',
					'transport'         => 'postMessage',
					'sanitize_callback' => function ( $v ) use ( $prop ) {
						return eletroproj_tipo_sanitize( $v, $prop );
					},
				)
			);

			if ( 'cor_claro' === $prop || 'cor_escuro' === $prop ) {
				$wp_customize->add_control(
					new WP_Customize_Color_Control(
						$wp_customize,
						$id,
						array(
							'label'       => $label,
							'section'     => $section,
							'priority'    => 10,
							'description' => __( 'Vazio = cor padrão do tema.', 'eletroproj' ),
						)
					)
				);
				continue;
			}

			$args = array(
				'label'    => $label,
				'section'  => $section,
				'priority' => 10,
			);
			if ( 'fonte' === $prop ) {
				$args['type']    = 'select';
				$args['choices'] = $fontes;
			} elseif ( 'peso' === $prop ) {
				$args['type']        = 'select';
				$args['choices']     = $pesos;
				$args['description'] = __( 'Se a fonte não tiver o peso escolhido, o navegador usa o mais próximo.', 'eletroproj' );
			} elseif ( 'linha' === $prop ) {
				$args['type']        = 'number';
				$args['input_attrs'] = array(
					'min'         => 0.8,
					'max'         => 3,
					'step'        => 0.05,
					'placeholder' => __( 'padrão', 'eletroproj' ),
				);
				$args['description'] = __( 'Ex.: 1.6 (vazio = padrão).', 'eletroproj' );
			} else {
				$args['type']        = 'number';
				$args['input_attrs'] = array(
					'min'         => 8,
					'max'         => 120,
					'step'        => 1,
					'placeholder' => __( 'padrão', 'eletroproj' ),
				);
				$args['description'] = ( 'tamanho_cel' === $prop )
					? __( 'Telas até 760 px. Vazio = usa o tamanho acima (ou o padrão).', 'eletroproj' )
					: __( 'Vazio = tamanho padrão do tema.', 'eletroproj' );
			}
			$wp_customize->add_control( $id, $args );
		}
	}

	// Pré-visualização ao vivo: recarrega só o bloco de CSS da tipografia.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'eletroproj_tipografia',
			array(
				'selector'            => '#eletroproj-tipografia-css',
				'settings'            => eletroproj_tipo_all_ids(),
				'container_inclusive' => true,
				'fallback_refresh'    => true,
				'render_callback'     => 'eletroproj_tipo_style_tag',
			)
		);
	}
}
add_action( 'customize_register', 'eletroproj_tipo_customize_register', 20 );

/**
 * Script dos botões "Restaurar padrão" (tela do Personalizador).
 */
function eletroproj_tipo_controls_script() {
	?>
	<script>
	( function () {
		document.addEventListener( 'click', function ( e ) {
			var btn = e.target.closest ? e.target.closest( '.eletroproj-reset' ) : null;
			if ( ! btn || ! window.wp || ! wp.customize ) {
				return;
			}
			e.preventDefault();
			var ids = [];
			try {
				ids = JSON.parse( btn.getAttribute( 'data-ids' ) || '[]' );
			} catch ( err ) {}
			ids.forEach( function ( id ) {
				var setting = wp.customize( id );
				if ( setting ) {
					setting.set( '' );
				}
				// Seletor de cor: usa o próprio botão "Limpar" para atualizar a amostra.
				var control = wp.customize.control( id );
				if ( control && control.container ) {
					var clear = control.container.find( '.wp-picker-clear' );
					if ( clear.length ) {
						clear.trigger( 'click' );
					}
				}
			} );
			var original = btn.textContent;
			btn.textContent = <?php echo wp_json_encode( __( 'Restaurado! Clique em Publicar para salvar.', 'eletroproj' ) ); ?>;
			setTimeout( function () {
				btn.textContent = original;
			}, 2500 );
		} );
	} )();
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'eletroproj_tipo_controls_script' );
