<?php
/**
 * Caixa de newsletter. Use get_template_part( 'template-parts/newsletter', null, array( 'variant' => 'sidebar' ) ).
 *
 * @package Eletroproj
 */

$eletroproj_variant   = isset( $args['variant'] ) ? $args['variant'] : 'sidebar';
$eletroproj_shortcode = eletroproj_mod( 'nl_shortcode' );
$eletroproj_action    = eletroproj_mod( 'nl_action' );
$eletroproj_field     = eletroproj_mod( 'nl_campo' ) ? eletroproj_mod( 'nl_campo' ) : 'email';
$eletroproj_uid       = wp_unique_id( 'nl-' );
?>
<section class="newsletter newsletter--<?php echo esc_attr( $eletroproj_variant ); ?>" aria-labelledby="<?php echo esc_attr( $eletroproj_uid ); ?>-t">
	<div class="newsletter__art" aria-hidden="true">
		<svg viewBox="0 0 120 120" width="120" height="120">
			<circle cx="60" cy="60" r="56" class="nl-bg"/>
			<rect x="26" y="40" width="68" height="48" rx="6" class="nl-env"/>
			<path d="M28 44l32 24 32-24" class="nl-flap"/>
			<path d="M72 14 54 46h14l-6 26 24-36H72z" class="nl-bolt"/>
		</svg>
	</div>
	<p class="newsletter__label"><?php esc_html_e( 'Newsletter', 'eletroproj' ); ?></p>
	<h2 class="newsletter__title" id="<?php echo esc_attr( $eletroproj_uid ); ?>-t"><?php echo esc_html( eletroproj_mod( 'nl_titulo' ) ); ?></h2>
	<p class="newsletter__text"><?php echo esc_html( eletroproj_mod( 'nl_texto' ) ); ?></p>

	<?php if ( $eletroproj_shortcode ) : ?>
		<div class="newsletter__plugin"><?php echo do_shortcode( $eletroproj_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
	<?php elseif ( $eletroproj_action ) : ?>
		<form class="newsletter__form" method="post" action="<?php echo esc_url( $eletroproj_action ); ?>" target="_blank">
			<label class="screen-reader-text" for="<?php echo esc_attr( $eletroproj_uid ); ?>-e"><?php esc_html_e( 'Seu e-mail', 'eletroproj' ); ?></label>
			<input id="<?php echo esc_attr( $eletroproj_uid ); ?>-e" type="email" name="<?php echo esc_attr( $eletroproj_field ); ?>" placeholder="<?php esc_attr_e( 'Seu melhor e-mail', 'eletroproj' ); ?>" required autocomplete="email">
			<button type="submit"><?php esc_html_e( 'Assinar', 'eletroproj' ); ?></button>
		</form>
	<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>
		<p class="newsletter__admin-hint">
			<?php esc_html_e( 'Só administradores veem este aviso: configure o formulário em Aparência → Personalizar → Tema Eletroproj → Newsletter.', 'eletroproj' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( eletroproj_mod( 'nl_prova' ) ) : ?>
		<p class="newsletter__proof"><?php echo esc_html( eletroproj_mod( 'nl_prova' ) ); ?></p>
	<?php endif; ?>
</section>
