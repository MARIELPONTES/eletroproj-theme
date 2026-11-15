<?php
/**
 * Newsletter com isca em PDF (Figma: newsletter + pdf-cover). Envio para a Brevo em inc/newsletter.php.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

if ( '1' !== (string) ep_opt( 'ep_nl_enabled' ) ) {
	return;
}

// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- só exibe o resultado do envio.
$ep_status = isset( $_GET['nl'] ) ? sanitize_key( wp_unslash( $_GET['nl'] ) ) : '';
$ep_lines  = static fn( string $key ): string => implode( '<br>', array_map( 'esc_html', explode( '|', (string) ep_opt( $key ) ) ) );
?>
<section class="newsletter" id="newsletter" aria-labelledby="newsletter-titulo">
	<div class="pdf-cover" aria-hidden="true">
		<span><?php echo $ep_lines( 'ep_nl_cover1' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escapado em $ep_lines. ?></span>
		<small><?php echo $ep_lines( 'ep_nl_cover2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></small>
	</div>
	<div>
		<span class="eyebrow"><?php echo esc_html( (string) ep_opt( 'ep_nl_eyebrow' ) ); ?></span>
		<h2 id="newsletter-titulo"><?php echo esc_html( (string) ep_opt( 'ep_nl_title' ) ); ?></h2>
		<p><?php echo esc_html( (string) ep_opt( 'ep_nl_text' ) ); ?></p>
		<?php if ( 'ok' === $ep_status ) : ?>
			<div class="success" role="status"><?php ep_icon( 'check', 17 ); ?> <?php echo esc_html( (string) ep_opt( 'ep_nl_success' ) ); ?></div>
		<?php else : ?>
			<?php if ( 'erro' === $ep_status ) : ?>
				<p class="form-error" role="alert"><?php esc_html_e( 'Não foi possível cadastrar agora. Confira o e-mail e tente de novo.', 'eletroproj' ); ?></p>
			<?php endif; ?>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="ep_newsletter">
				<input type="hidden" name="ep_back" value="<?php echo esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ); ?>">
				<?php wp_nonce_field( 'ep_newsletter', 'ep_nl_nonce' ); ?>
				<label class="screen-reader-text" for="ep-nl-email"><?php esc_html_e( 'Seu melhor e-mail', 'eletroproj' ); ?></label>
				<input id="ep-nl-email" required type="email" name="email" autocomplete="email" placeholder="<?php esc_attr_e( 'Seu melhor e-mail', 'eletroproj' ); ?>">
				<input class="ep-hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
				<button type="submit" class="btn btn-primary"><?php echo esc_html( (string) ep_opt( 'ep_nl_button' ) ); ?></button>
			</form>
		<?php endif; ?>
		<small><?php echo esc_html( (string) ep_opt( 'ep_nl_note' ) ); ?></small>
	</div>
</section>
