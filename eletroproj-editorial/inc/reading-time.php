<?php
/**
 * Tempo de leitura (200 palavras por minuto), salvo em post meta.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Calcula os minutos de leitura de um texto.
 *
 * @param string $content Conteúdo bruto.
 * @return int
 */
function eletroproj_calc_reading_time( $content ) {
	$text  = wp_strip_all_tags( strip_shortcodes( $content ) );
	$words = count( preg_split( '/\s+/u', trim( $text ), -1, PREG_SPLIT_NO_EMPTY ) );
	return max( 1, (int) ceil( $words / 200 ) );
}

/**
 * Salva o tempo de leitura ao gravar o post.
 *
 * @param int     $post_id ID.
 * @param WP_Post $post    Post.
 */
function eletroproj_save_reading_time( $post_id, $post ) {
	if ( wp_is_post_revision( $post_id ) || 'post' !== $post->post_type ) {
		return;
	}
	update_post_meta( $post_id, '_eletroproj_reading_time', eletroproj_calc_reading_time( $post->post_content ) );
}
add_action( 'save_post', 'eletroproj_save_reading_time', 10, 2 );

/**
 * Retorna "8 min de leitura".
 *
 * @param int|null $post_id ID.
 * @return string
 */
function eletroproj_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$min     = (int) get_post_meta( $post_id, '_eletroproj_reading_time', true );
	if ( ! $min ) {
		$min = eletroproj_calc_reading_time( get_post_field( 'post_content', $post_id ) );
	}
	/* translators: %d: minutos */
	return sprintf( _n( '%d min de leitura', '%d min de leitura', $min, 'eletroproj' ), $min );
}
