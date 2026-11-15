<?php
/**
 * "Conteúdos relacionados" (Figma: related-grid + mini-card).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_related = ep_related_posts( 3 );
if ( ! $ep_related ) {
	return;
}
?>
<section class="related" aria-labelledby="relacionados-titulo">
	<span class="section-number"><?php esc_html_e( 'Continue estudando', 'eletroproj' ); ?></span>
	<h2 id="relacionados-titulo"><?php esc_html_e( 'Conteúdos relacionados', 'eletroproj' ); ?></h2>
	<div class="related-grid">
		<?php
		foreach ( $ep_related as $ep_post ) {
			get_template_part( 'template-parts/cards/mini-card', null, array( 'post' => $ep_post ) );
		}
		?>
	</div>
</section>
