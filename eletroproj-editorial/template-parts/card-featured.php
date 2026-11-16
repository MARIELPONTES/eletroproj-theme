<?php
/**
 * Card grande (artigo em destaque).
 *
 * @package Eletroproj
 */

?>
<article <?php post_class( 'card-featured' ); ?>>
	<?php eletroproj_tilted_media( 'eletroproj-card', 'tilted--lg' ); ?>
	<div class="card-featured__body">
		<?php eletroproj_author_wrote(); ?>
		<h2 class="card-featured__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="card-meta"><?php eletroproj_date_and_cats(); ?> <span class="card-meta__time">· <?php echo esc_html( eletroproj_reading_time() ); ?></span></p>
		<div class="card-featured__excerpt"><?php the_excerpt(); ?></div>
		<a class="read-more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Continuar lendo', 'eletroproj' ); ?> <span aria-hidden="true">↬</span>
			<span class="screen-reader-text"><?php the_title(); ?></span>
		</a>
	</div>
</article>
