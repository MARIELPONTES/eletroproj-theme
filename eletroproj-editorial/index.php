<?php
/**
 * Template padrão (lista de posts do blog e fallback geral).
 *
 * @package Eletroproj
 */

get_header();
?>
<div class="container page-head">
	<?php eletroproj_breadcrumbs(); ?>
	<h1 class="page-head__title">
		<?php
		if ( is_home() && get_option( 'page_for_posts' ) ) {
			echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) );
		} else {
			esc_html_e( 'Artigos', 'eletroproj' );
		}
		?>
	</h1>
</div>
<div class="container">
	<?php get_template_part( 'template-parts/listing' ); ?>
</div>
<?php
get_footer();
