<?php
/**
 * Busca em tela cheia (Figma: search-overlay), com <dialog> nativo.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_trending = array( 'NBR 5419', 'SPDA', 'dimensionamento de cabos' );
?>
<dialog class="search-overlay" id="busca" aria-labelledby="busca-titulo">
	<button type="button" class="search-close" data-search-close aria-label="<?php esc_attr_e( 'Fechar busca', 'eletroproj' ); ?>">
		<?php ep_icon( 'x', 24 ); ?>
	</button>
	<div class="search-dialog">
		<span class="eyebrow"><?php esc_html_e( 'Biblioteca técnica', 'eletroproj' ); ?></span>
		<h2 id="busca-titulo"><?php esc_html_e( 'O que você precisa resolver?', 'eletroproj' ); ?></h2>
		<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="search-field">
				<?php ep_icon( 'search', 22 ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Buscar no site', 'eletroproj' ); ?></span>
				<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Busque por norma, tema ou equipamento...', 'eletroproj' ); ?>" autocomplete="off">
				<kbd>ESC</kbd>
			</label>
			<button type="submit" class="screen-reader-text"><?php esc_html_e( 'Buscar', 'eletroproj' ); ?></button>
		</form>
		<p>
			<?php esc_html_e( 'Em alta:', 'eletroproj' ); ?>
			<?php foreach ( $ep_trending as $ep_i => $ep_term ) : ?>
				<?php echo $ep_i ? ' · ' : ' '; ?><a href="<?php echo esc_url( add_query_arg( 's', rawurlencode( $ep_term ), home_url( '/' ) ) ); ?>"><?php echo esc_html( $ep_term ); ?></a>
			<?php endforeach; ?>
		</p>
	</div>
</dialog>
