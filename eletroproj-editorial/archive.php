<?php
/**
 * Arquivos: categoria, tag, autor, data.
 *
 * @package Eletroproj
 */

get_header();
$eletroproj_desc = get_the_archive_description();
?>
<div class="container page-head">
	<?php eletroproj_breadcrumbs(); ?>
	<?php if ( is_author() ) : ?>
		<div class="page-head__author">
			<span class="tilted tilted--md"><?php echo get_avatar( get_queried_object_id(), 200 ); ?></span>
			<div>
				<p class="page-head__kicker"><?php esc_html_e( 'Artigos de', 'eletroproj' ); ?></p>
				<h1 class="page-head__title"><?php echo esc_html( get_the_author_meta( 'display_name', get_queried_object_id() ) ); ?></h1>
				<?php if ( get_the_author_meta( 'description', get_queried_object_id() ) ) : ?>
					<div class="page-head__desc"><?php echo wp_kses_post( wpautop( get_the_author_meta( 'description', get_queried_object_id() ) ) ); ?></div>
				<?php endif; ?>
			</div>
		</div>
	<?php else : ?>
		<h1 class="page-head__title"><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ) ); ?></h1>
		<?php if ( $eletroproj_desc ) : ?>
			<div class="page-head__desc"><?php echo wp_kses_post( $eletroproj_desc ); ?></div>
		<?php endif; ?>
	<?php endif; ?>
</div>
<div class="container">
	<?php get_template_part( 'template-parts/listing' ); ?>
</div>
<?php
get_footer();
