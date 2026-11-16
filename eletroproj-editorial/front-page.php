<?php
/**
 * Página inicial em formato de revista.
 *
 * @package Eletroproj
 */

get_header();

// Página 2, 3… da lista de posts: mostra a grade simples.
if ( is_paged() && 'posts' === get_option( 'show_on_front' ) ) :
	?>
	<div class="container page-head">
		<h1 class="page-head__title"><?php esc_html_e( 'Artigos', 'eletroproj' ); ?></h1>
	</div>
	<div class="container">
		<?php get_template_part( 'template-parts/listing' ); ?>
	</div>
	<?php
	get_footer();
	return;
endif;

$eletroproj_posts = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 11,
		'no_found_rows'  => true,
	)
);
$eletroproj_all   = $eletroproj_posts->posts;
$eletroproj_top   = array_slice( $eletroproj_all, 0, 3 );
$eletroproj_rest  = array_slice( $eletroproj_all, 3 );

if ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
	$eletroproj_more_url = get_permalink( get_option( 'page_for_posts' ) );
} else {
	$eletroproj_more_url = get_pagenum_link( 2 );
}
?>

<div class="container magazine">
	<h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?> — <?php bloginfo( 'description' ); ?></h1>

	<div class="magazine__top">
		<div class="magazine__feed">
			<?php
			global $post;
			foreach ( $eletroproj_top as $eletroproj_index => $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride
				setup_postdata( $post );
				if ( 0 === $eletroproj_index && eletroproj_mod( 'home_destaque' ) ) {
					get_template_part( 'template-parts/card-featured' );
				} else {
					?>
					<article <?php post_class( 'card-mini' ); ?>>
						<?php eletroproj_tilted_media( 'eletroproj-thumb', 'tilted--sm' ); ?>
						<div>
							<p class="card-mini__meta">
								<a class="byline__author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
								<span aria-hidden="true">/</span>
								<?php eletroproj_date_and_cats(); ?>
							</p>
							<h2 class="card-mini__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
					</article>
					<?php
				}
			endforeach;
			wp_reset_postdata();
			?>
		</div>

		<?php if ( eletroproj_mod( 'home_newsletter' ) ) : ?>
			<aside class="magazine__aside">
				<?php get_template_part( 'template-parts/newsletter', null, array( 'variant' => 'sidebar' ) ); ?>
			</aside>
		<?php endif; ?>
	</div>

	<?php
	if ( eletroproj_mod( 'home_guias' ) ) {
		get_template_part( 'template-parts/guides' );
	}
	?>

	<?php if ( $eletroproj_rest ) : ?>
		<section class="section latest" aria-labelledby="ultimos-artigos">
			<h2 class="latest__label" id="ultimos-artigos"><?php esc_html_e( 'Últimos artigos', 'eletroproj' ); ?></h2>
			<div class="post-grid">
				<?php
				foreach ( $eletroproj_rest as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride
					setup_postdata( $post );
					get_template_part( 'template-parts/card' );
				endforeach;
				wp_reset_postdata();
				?>
			</div>
			<p class="section__cta">
				<a class="button" href="<?php echo esc_url( $eletroproj_more_url ); ?>"><?php esc_html_e( 'Ver mais artigos', 'eletroproj' ); ?> <span aria-hidden="true">↬</span></a>
			</p>
		</section>
	<?php endif; ?>

	<?php
	if ( eletroproj_mod( 'home_familia' ) ) {
		get_template_part( 'template-parts/services' );
	}
	?>
</div>

<?php
get_footer();
