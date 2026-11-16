<?php
/**
 * Páginas.
 *
 * @package Eletroproj
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'page-article' ); ?>>
		<div class="container">
			<header class="page-head page-head--page">
				<?php eletroproj_breadcrumbs(); ?>
				<h1 class="page-head__title"><?php the_title(); ?></h1>
			</header>
			<div class="page-body">
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="article-hero"><?php the_post_thumbnail( 'large' ); ?></figure>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</div>
		</div>
	</article>
	<?php
	if ( comments_open() || get_comments_number() ) :
		echo '<div class="container"><div class="page-body">';
		comments_template();
		echo '</div></div>';
	endif;
endwhile;

get_footer();
