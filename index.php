<?php
/**
 * Modelo de reserva (fallback) do WordPress.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="conteudo" class="container">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php if ( is_singular() ) : ?>
					<?php the_content(); ?>
				<?php else : ?>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nenhum conteúdo encontrado.', 'eletroproj' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
