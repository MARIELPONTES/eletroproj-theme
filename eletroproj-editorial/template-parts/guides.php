<?php
/**
 * Guias essenciais: 3 posts de uma categoria escolhida no Personalizador.
 *
 * @package Eletroproj
 */

$eletroproj_slug = eletroproj_mod( 'guias_categoria' );
$eletroproj_cat  = $eletroproj_slug ? get_category_by_slug( $eletroproj_slug ) : null;
if ( ! $eletroproj_cat ) {
	return;
}
$eletroproj_guides = new WP_Query(
	array(
		'cat'                 => $eletroproj_cat->term_id,
		'posts_per_page'      => 3,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
if ( ! $eletroproj_guides->have_posts() ) {
	return;
}
?>
<section class="section guides" aria-labelledby="guias-titulo">
	<h2 class="section__title" id="guias-titulo"><?php echo esc_html( eletroproj_mod( 'guias_titulo' ) ); ?></h2>
	<ul class="guides__grid">
		<?php
		$eletroproj_n = 0;
		while ( $eletroproj_guides->have_posts() ) :
			$eletroproj_guides->the_post();
			++$eletroproj_n;
			?>
			<li class="guide guide--<?php echo (int) $eletroproj_n; ?>">
				<h3 class="guide__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="guide__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22, '…' ) ); ?></p>
				<span class="guide__more" aria-hidden="true"><?php esc_html_e( 'Explorar', 'eletroproj' ); ?> ↬</span>
			</li>
		<?php endwhile; ?>
	</ul>
	<p class="section__more"><a href="<?php echo esc_url( get_category_link( $eletroproj_cat ) ); ?>"><?php esc_html_e( 'Ver todos os guias', 'eletroproj' ); ?> <span aria-hidden="true">↬</span></a></p>
</section>
<?php
wp_reset_postdata();
