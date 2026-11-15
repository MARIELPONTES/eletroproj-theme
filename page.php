<?php
/**
 * Página comum (Sobre, Contato...): cabeçalho do artigo + texto em 740 px.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="conteudo">
		<header class="article-hero container page-hero">
			<?php ep_breadcrumb( array( array( get_the_title(), '' ) ) ); ?>
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="article-deck"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</header>
		<div class="article-layout container no-toc">
			<article <?php post_class( 'article-body' ); ?>>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</article>
		</div>
	</main>
	<?php
endwhile;

get_footer();
