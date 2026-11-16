<?php
/**
 * Resultados de busca.
 *
 * @package Eletroproj
 */

get_header();
?>
<div class="container page-head">
	<?php eletroproj_breadcrumbs(); ?>
	<p class="page-head__kicker"><?php esc_html_e( 'Resultados da busca', 'eletroproj' ); ?></p>
	<h1 class="page-head__title">“<?php echo esc_html( get_search_query() ); ?>”</h1>
	<p class="page-head__count">
		<?php
		/* translators: %s: número de resultados */
		printf( esc_html( _n( '%s resultado', '%s resultados', (int) $wp_query->found_posts, 'eletroproj' ) ), esc_html( number_format_i18n( $wp_query->found_posts ) ) );
		?>
	</p>
	<div class="page-head__search"><?php get_search_form(); ?></div>
</div>
<div class="container">
	<?php get_template_part( 'template-parts/listing' ); ?>
</div>
<?php
get_footer();
