<?php
/**
 * Card padrão da lista de artigos.
 *
 * @package Eletroproj
 */

?>
<article <?php post_class( 'post-card' ); ?>>
	<header class="card__head">
		<?php eletroproj_tilted_media( 'eletroproj-thumb', 'tilted--sm' ); ?>
		<div>
			<?php eletroproj_author_wrote(); ?>
			<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>
	</header>
	<div class="card__excerpt"><?php the_excerpt(); ?></div>
	<p class="card-meta">
		<?php echo eletroproj_icon( 'raio', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<?php eletroproj_date_and_cats(); ?>
	</p>
</article>
