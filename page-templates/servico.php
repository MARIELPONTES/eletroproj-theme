<?php
/**
 * Template Name: Página de serviço
 *
 * Figma: ServicePage. Textos em Aparência › Personalizar › Eletroproj › Página de serviço.
 * O conteúdo escrito no editor (se houver) aparece antes do formulário.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ep_o     = static fn( string $k ): string => (string) ep_opt( $k );
$ep_image = (int) ep_opt( 'ep_sv_image' );
$ep_tel   = preg_replace( '/\D+/', '', $ep_o( 'ep_whatsapp' ) );
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- só exibe o resultado do envio.
$ep_state = isset( $_GET['orcamento'] ) ? sanitize_key( wp_unslash( $_GET['orcamento'] ) ) : '';
?>
<main id="conteudo">
	<section class="service-hero">
		<div class="container service-hero-grid">
			<div>
				<span class="eyebrow"><?php echo esc_html( $ep_o( 'ep_sv_eyebrow' ) ); ?></span>
				<h1><?php echo esc_html( $ep_o( 'ep_sv_title' ) ); ?></h1>
				<p><?php echo esc_html( $ep_o( 'ep_sv_text' ) ); ?></p>
				<div class="hero-actions">
					<a href="#orcamento" class="btn btn-primary"><?php esc_html_e( 'Solicitar avaliação', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 17 ); ?></a>
					<a href="tel:+<?php echo esc_attr( $ep_tel ); ?>" class="btn btn-secondary"><?php esc_html_e( 'Ligar para um engenheiro', 'eletroproj' ); ?></a>
				</div>
				<div class="cert-row">
					<span><?php ep_icon( 'shield-check', 15 ); ?> <?php echo esc_html( $ep_o( 'ep_sv_cert1' ) ); ?></span>
					<span><?php ep_icon( 'clock-3', 15 ); ?> <?php echo esc_html( $ep_o( 'ep_sv_cert2' ) ); ?></span>
					<span><?php ep_icon( 'file-check-2', 15 ); ?> <?php echo esc_html( $ep_o( 'ep_sv_cert3' ) ); ?></span>
				</div>
			</div>
			<div class="service-image<?php echo $ep_image ? '' : ' no-image'; ?>">
				<?php
				if ( $ep_image ) {
					echo wp_get_attachment_image(
						$ep_image,
						'large',
						false,
						array(
							'sizes'         => '(min-width: 1100px) 450px, (min-width: 768px) 40vw, 100vw',
							'loading'       => 'eager',
							'fetchpriority' => 'high',
							'decoding'      => 'async',
						)
					);
				}
				?>
				<span><?php echo esc_html( $ep_o( 'ep_sv_tag' ) ); ?></span>
			</div>
		</div>
	</section>

	<section class="section container">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php echo esc_html( $ep_o( 'ep_sv_b_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( $ep_o( 'ep_sv_b_title' ) ); ?></h2>
			</div>
		</div>
		<div class="benefit-grid">
			<?php foreach ( array( 1 => 'clipboard-check', 2 => 'wrench', 3 => 'shield-check' ) as $ep_i => $ep_ic ) : ?>
				<div class="info-card">
					<span><?php ep_icon( $ep_ic, 24 ); ?></span>
					<h3><?php echo esc_html( $ep_o( "ep_sv_b{$ep_i}_title" ) ); ?></h3>
					<p><?php echo esc_html( $ep_o( "ep_sv_b{$ep_i}_text" ) ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="section alt-section">
		<div class="container process">
			<div>
				<span class="eyebrow"><?php echo esc_html( $ep_o( 'ep_sv_p_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( $ep_o( 'ep_sv_p_title' ) ); ?></h2>
			</div>
			<ol class="process-steps">
				<?php for ( $ep_i = 1; $ep_i <= 4; $ep_i++ ) : ?>
					<li><span><?php echo esc_html( sprintf( '%02d', $ep_i ) ); ?></span><h3><?php echo esc_html( $ep_o( "ep_sv_p{$ep_i}" ) ); ?></h3></li>
				<?php endfor; ?>
			</ol>
		</div>
	</section>

	<section class="section container standards">
		<div>
			<span class="eyebrow"><?php echo esc_html( $ep_o( 'ep_sv_n_eyebrow' ) ); ?></span>
			<h2><?php echo esc_html( $ep_o( 'ep_sv_n_title' ) ); ?></h2>
			<p><?php echo esc_html( $ep_o( 'ep_sv_n_text' ) ); ?></p>
		</div>
		<dl>
			<?php for ( $ep_i = 1; $ep_i <= 3; $ep_i++ ) : ?>
				<dt><?php echo esc_html( $ep_o( "ep_sv_n{$ep_i}_code" ) ); ?></dt>
				<dd><?php echo esc_html( $ep_o( "ep_sv_n{$ep_i}_text" ) ); ?></dd>
			<?php endfor; ?>
		</dl>
	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( '' !== trim( (string) get_the_content() ) ) :
			?>
			<section class="section narrow entry-content service-content">
				<?php the_content(); ?>
			</section>
			<?php
		endif;
	endwhile;
	?>

	<section class="quote-section" id="orcamento">
		<div class="container quote-grid">
			<div>
				<span class="eyebrow"><?php echo esc_html( $ep_o( 'ep_sv_q_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( $ep_o( 'ep_sv_q_title' ) ); ?></h2>
				<p><?php echo esc_html( $ep_o( 'ep_sv_q_text' ) ); ?></p>
				<div class="contact-note">
					<strong><?php esc_html_e( 'Prefere WhatsApp?', 'eletroproj' ); ?></strong>
					<a href="<?php echo esc_url( ep_whatsapp_url( 'Olá! Gostaria de um orçamento.' ) ); ?>"><?php echo esc_html( $ep_o( 'ep_phone_display' ) ); ?></a>
				</div>
			</div>
			<?php if ( 'ok' === $ep_state ) : ?>
				<div class="quote-success" role="status">
					<?php ep_icon( 'check', 36 ); ?>
					<h3><?php esc_html_e( 'Solicitação recebida.', 'eletroproj' ); ?></h3>
					<p><?php esc_html_e( 'Nossa equipe técnica entrará em contato em até um dia útil.', 'eletroproj' ); ?></p>
				</div>
			<?php else : ?>
				<form class="quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<?php if ( 'erro' === $ep_state ) : ?>
						<p class="form-error" role="alert"><?php esc_html_e( 'Não foi possível enviar. Confira os campos ou chame no WhatsApp.', 'eletroproj' ); ?></p>
					<?php endif; ?>
					<input type="hidden" name="action" value="ep_quote">
					<input type="hidden" name="ep_back" value="<?php echo esc_url( get_permalink() ); ?>">
					<?php wp_nonce_field( 'ep_quote', 'ep_quote_nonce' ); ?>
					<label><?php esc_html_e( 'Nome completo', 'eletroproj' ); ?>
						<input required name="nome" autocomplete="name" placeholder="<?php esc_attr_e( 'Como podemos chamar você?', 'eletroproj' ); ?>">
					</label>
					<label><?php esc_html_e( 'E-mail corporativo', 'eletroproj' ); ?>
						<input required type="email" name="email" autocomplete="email" placeholder="nome@empresa.com.br">
					</label>
					<div>
						<label><?php esc_html_e( 'Telefone', 'eletroproj' ); ?>
							<input required type="tel" name="telefone" autocomplete="tel" placeholder="(21) 99999-9999">
						</label>
						<label><?php esc_html_e( 'Tipo de imóvel', 'eletroproj' ); ?>
							<select name="tipo">
								<?php foreach ( ep_quote_types() as $ep_type ) : ?>
									<option><?php echo esc_html( $ep_type ); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</div>
					<label><?php esc_html_e( 'Como podemos ajudar?', 'eletroproj' ); ?>
						<textarea name="mensagem" rows="4" placeholder="<?php esc_attr_e( 'Descreva o imóvel e a sua necessidade...', 'eletroproj' ); ?>"></textarea>
					</label>
					<input class="ep-hp" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
					<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Enviar solicitação', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 17 ); ?></button>
					<small><?php esc_html_e( 'Seus dados serão usados apenas para responder a esta solicitação.', 'eletroproj' ); ?></small>
				</form>
			<?php endif; ?>
		</div>
	</section>

	<section class="section narrow service-faq">
		<span class="eyebrow"><?php esc_html_e( 'Dúvidas comuns', 'eletroproj' ); ?></span>
		<h2><?php esc_html_e( 'Perguntas frequentes', 'eletroproj' ); ?></h2>
		<?php for ( $ep_i = 1; $ep_i <= 3; $ep_i++ ) : ?>
			<?php if ( $ep_o( "ep_sv_f{$ep_i}_q" ) ) : ?>
				<details class="faq">
					<summary><span><?php echo esc_html( $ep_o( "ep_sv_f{$ep_i}_q" ) ); ?></span><?php ep_icon( 'chevron-down', 19 ); ?></summary>
					<p><?php echo esc_html( $ep_o( "ep_sv_f{$ep_i}_a" ) ); ?></p>
				</details>
			<?php endif; ?>
		<?php endfor; ?>
	</section>
</main>
<?php
get_footer();
