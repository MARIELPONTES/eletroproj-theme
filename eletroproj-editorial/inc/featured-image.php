<?php
/**
 * Exibir ou ocultar a imagem destacada dentro do artigo.
 *
 * Ordem de prioridade:
 * 1. Opção do próprio post (meta _eletroproj_destacada: "mostrar" ou "ocultar").
 * 2. Se o post estiver em "padrão", vale o Personalizar > Tema Eletroproj > Artigo.
 *
 * Ocultar aqui só tira a imagem do topo do artigo. Ela continua sendo usada
 * nos cards, nos relacionados, nas redes sociais e no SEO.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Decide se a imagem destacada aparece no artigo.
 *
 * @param int|null $post_id ID do post (padrão: post atual).
 * @return bool
 */
function eletroproj_show_featured_image( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$escolha = get_post_meta( $post_id, '_eletroproj_destacada', true );

	if ( 'mostrar' === $escolha ) {
		return true;
	}
	if ( 'ocultar' === $escolha ) {
		return false;
	}
	return (bool) eletroproj_mod( 'mostrar_destacada' );
}

/**
 * Registra o meta (também disponível na API REST/editor de blocos).
 */
function eletroproj_register_destacada_meta() {
	register_post_meta(
		'post',
		'_eletroproj_destacada',
		array(
			'type'              => 'string',
			'single'            => true,
			'default'           => '',
			'show_in_rest'      => true,
			'sanitize_callback' => 'eletroproj_sanitize_destacada',
			'auth_callback'     => function ( $allowed, $meta_key, $post_id ) {
				return current_user_can( 'edit_post', $post_id );
			},
		)
	);
}
add_action( 'init', 'eletroproj_register_destacada_meta' );

/**
 * Aceita só os valores válidos.
 *
 * @param string $value Valor recebido.
 * @return string
 */
function eletroproj_sanitize_destacada( $value ) {
	return in_array( $value, array( 'mostrar', 'ocultar' ), true ) ? $value : '';
}

/**
 * Caixa lateral no editor do post.
 */
function eletroproj_add_destacada_box() {
	add_meta_box(
		'eletroproj-destacada',
		__( 'Imagem destacada no artigo', 'eletroproj' ),
		'eletroproj_render_destacada_box',
		'post',
		'side',
		'low'
	);
}
add_action( 'add_meta_boxes', 'eletroproj_add_destacada_box' );

/**
 * Conteúdo da caixa lateral.
 *
 * @param WP_Post $post Post atual.
 */
function eletroproj_render_destacada_box( $post ) {
	wp_nonce_field( 'eletroproj_destacada_salvar', 'eletroproj_destacada_nonce' );
	$atual  = get_post_meta( $post->ID, '_eletroproj_destacada', true );
	$global = eletroproj_mod( 'mostrar_destacada' ) ? __( 'mostrar', 'eletroproj' ) : __( 'ocultar', 'eletroproj' );
	$opcoes = array(
		''        => sprintf( /* translators: %s: mostrar/ocultar */ __( 'Padrão do tema (hoje: %s)', 'eletroproj' ), $global ),
		'mostrar' => __( 'Mostrar neste post', 'eletroproj' ),
		'ocultar' => __( 'Ocultar neste post', 'eletroproj' ),
	);
	foreach ( $opcoes as $valor => $rotulo ) {
		printf(
			'<p><label><input type="radio" name="eletroproj_destacada" value="%1$s" %2$s> %3$s</label></p>',
			esc_attr( $valor ),
			checked( $atual, $valor, false ),
			esc_html( $rotulo )
		);
	}
	echo '<p class="description">' . esc_html__( 'Vale só para o topo do artigo. A imagem continua nos cards e nas redes sociais.', 'eletroproj' ) . '</p>';
}

/**
 * Salva a escolha.
 *
 * @param int $post_id ID do post.
 */
function eletroproj_save_destacada( $post_id ) {
	if ( ! isset( $_POST['eletroproj_destacada_nonce'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['eletroproj_destacada_nonce'] ) ), 'eletroproj_destacada_salvar' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$valor = isset( $_POST['eletroproj_destacada'] )
		? eletroproj_sanitize_destacada( sanitize_text_field( wp_unslash( $_POST['eletroproj_destacada'] ) ) )
		: '';
	if ( '' === $valor ) {
		delete_post_meta( $post_id, '_eletroproj_destacada' );
	} else {
		update_post_meta( $post_id, '_eletroproj_destacada', $valor );
	}
}
add_action( 'save_post_post', 'eletroproj_save_destacada' );
