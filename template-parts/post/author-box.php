<?php
/**
 * "Sobre o autor" (Figma: author-box).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_name = (string) ep_opt( 'ep_rt_name' );
$ep_bio  = (string) ep_opt( 'ep_rt_bio' );
if ( '' === $ep_bio ) {
	$ep_bio = (string) get_the_author_meta( 'description' );
}
?>
<section class="author-box" aria-label="<?php esc_attr_e( 'Sobre o autor', 'eletroproj' ); ?>">
	<div class="ep-avatar large" aria-hidden="true"><?php echo esc_html( ep_initials( $ep_name ) ); ?></div>
	<div>
		<span class="eyebrow"><?php esc_html_e( 'Sobre o autor', 'eletroproj' ); ?></span>
		<h2 class="h3"><?php echo esc_html( $ep_name ); ?></h2>
		<p><?php echo esc_html( $ep_bio ? $ep_bio : (string) ep_opt( 'ep_rt_role' ) ); ?></p>
		<p class="author-updated"><?php esc_html_e( 'Artigo atualizado em', 'eletroproj' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( ep_date( null, true ) ); ?></time></p>
	</div>
</section>
