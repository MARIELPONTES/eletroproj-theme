<?php
/**
 * Linha de capítulo/artigo (Figma: chapter-list do guia).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_post  = get_post( $args['post'] ?? null );
$ep_n     = (int) ( $args['n'] ?? 0 );
$ep_label = (string) ( $args['label'] ?? 'level' );
if ( ! $ep_post ) {
	return;
}
$ep_level  = (string) get_post_meta( $ep_post->ID, 'ep_level', true );
$ep_levels = ep_levels();
$ep_small  = '';
if ( 'level' === $ep_label && isset( $ep_levels[ $ep_level ] ) ) {
	$ep_small = $ep_levels[ $ep_level ];
} elseif ( 'category' === $ep_label ) {
	$ep_cat   = ep_primary_category( $ep_post );
	$ep_small = $ep_cat ? $ep_cat->name : '';
}
?>
<a href="<?php echo esc_url( get_permalink( $ep_post ) ); ?>" data-chapter="<?php echo esc_attr( $ep_level ? $ep_level : 'sem-nivel' ); ?>">
	<span class="chapter-n"><?php echo esc_html( sprintf( '%02d', $ep_n ) ); ?></span>
	<div>
		<?php if ( $ep_small ) : ?>
			<small><?php echo esc_html( $ep_small ); ?></small>
		<?php endif; ?>
		<h3><?php echo esc_html( get_the_title( $ep_post ) ); ?></h3>
		<p><?php echo esc_html( ep_excerpt( $ep_post ) ); ?></p>
	</div>
	<span class="chapter-time"><?php echo esc_html( sprintf( '%d min', ep_reading_time( $ep_post ) ) ); ?> <?php ep_icon( 'arrow-right', 17 ); ?></span>
</a>
