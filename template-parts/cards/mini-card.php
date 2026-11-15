<?php
/**
 * Card pequeno (Figma: mini-card).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_post = get_post( $args['post'] ?? null );
if ( ! $ep_post ) {
	return;
}
$ep_cat = ep_primary_category( $ep_post );
?>
<a class="mini-card" href="<?php echo esc_url( get_permalink( $ep_post ) ); ?>">
	<?php if ( $ep_cat ) : ?>
		<span><?php echo esc_html( $ep_cat->name ); ?></span>
	<?php endif; ?>
	<h3><?php echo esc_html( get_the_title( $ep_post ) ); ?></h3>
	<small><?php echo esc_html( sprintf( /* translators: %d: minutos */ __( '%d min de leitura', 'eletroproj' ), ep_reading_time( $ep_post ) ) ); ?> <?php ep_icon( 'arrow-right', 14 ); ?></small>
</a>
