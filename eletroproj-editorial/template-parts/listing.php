<?php
/**
 * Lista de artigos em grade de 2 colunas (usada em blog, arquivos e busca).
 *
 * @package Eletroproj
 */

if ( have_posts() ) :
	?>
	<div class="post-grid" id="ultimos-artigos">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/card' );
		endwhile;
		?>
	</div>
	<?php
	eletroproj_pagination();
else :
	get_template_part( 'template-parts/none' );
endif;
