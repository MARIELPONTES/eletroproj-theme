<?php
/**
 * Template Name: Largura total (landing page)
 * Template Post Type: page, post
 *
 * Sem título nem breadcrumbs: o conteúdo ocupa toda a largura.
 * Ideal para montar landing pages com blocos.
 *
 * @package Eletroproj
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="entry-content entry-content--full">
		<?php the_content(); ?>
	</div>
	<?php
endwhile;

get_footer();
