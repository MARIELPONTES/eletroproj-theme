<?php
/**
 * Formulário de busca (Figma: hero-search).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_id = wp_unique_id( 'busca-' );
?>
<form class="hero-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<?php ep_icon( 'search', 21 ); ?>
	<label class="screen-reader-text" for="<?php echo esc_attr( $ep_id ); ?>"><?php esc_html_e( 'Buscar no site', 'eletroproj' ); ?></label>
	<input id="<?php echo esc_attr( $ep_id ); ?>" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Busque por norma, tema ou equipamento...', 'eletroproj' ); ?>">
	<button type="submit"><?php esc_html_e( 'Buscar', 'eletroproj' ); ?></button>
</form>
