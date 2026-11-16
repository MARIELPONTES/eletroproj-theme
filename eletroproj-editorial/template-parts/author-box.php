<?php
/**
 * Caixa "Sobre o autor".
 *
 * @package Eletroproj
 */

$eletroproj_author_id = (int) get_the_author_meta( 'ID' );
$eletroproj_compact   = ! empty( $args['compact'] );
?>
<section class="author-box<?php echo $eletroproj_compact ? ' author-box--compact' : ''; ?>" aria-label="<?php esc_attr_e( 'Sobre o autor', 'eletroproj' ); ?>">
	<a class="tilted tilted--md" href="<?php echo esc_url( get_author_posts_url( $eletroproj_author_id ) ); ?>" tabindex="-1" aria-hidden="true">
		<?php echo get_avatar( $eletroproj_author_id, 200, '', '', array( 'loading' => 'lazy' ) ); ?>
	</a>
	<div class="author-box__body">
		<p class="author-box__label"><?php esc_html_e( 'Sobre o autor', 'eletroproj' ); ?></p>
		<p class="author-box__name"><a href="<?php echo esc_url( get_author_posts_url( $eletroproj_author_id ) ); ?>"><?php the_author(); ?></a></p>
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<p class="author-box__bio"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
		<?php endif; ?>
		<a class="read-more read-more--small" href="<?php echo esc_url( get_author_posts_url( $eletroproj_author_id ) ); ?>"><?php esc_html_e( 'Mais artigos do autor', 'eletroproj' ); ?> <span aria-hidden="true">↬</span></a>
	</div>
</section>
