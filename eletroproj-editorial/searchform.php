<?php
/**
 * Formulário de busca.
 *
 * @package Eletroproj
 */

$eletroproj_sid = wp_unique_id( 'busca-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $eletroproj_sid ); ?>"><?php esc_html_e( 'Buscar por:', 'eletroproj' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $eletroproj_sid ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Ex.: queda de tensão, NBR 5419…', 'eletroproj' ); ?>">
	<button type="submit"><?php echo eletroproj_icon( 'busca', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput ?><span><?php esc_html_e( 'Buscar', 'eletroproj' ); ?></span></button>
</form>
