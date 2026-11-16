<?php
/**
 * Cards de serviços ("família Eletroproj").
 *
 * @package Eletroproj
 */

$eletroproj_cards = array();
for ( $eletroproj_i = 1; $eletroproj_i <= 4; $eletroproj_i++ ) {
	$eletroproj_t = eletroproj_mod( "familia_{$eletroproj_i}_titulo" );
	if ( ! $eletroproj_t ) {
		continue;
	}
	$eletroproj_cards[] = array(
		'titulo' => $eletroproj_t,
		'texto'  => eletroproj_mod( "familia_{$eletroproj_i}_texto" ),
		'url'    => eletroproj_mod( "familia_{$eletroproj_i}_url" ),
		'icone'  => eletroproj_mod( "familia_{$eletroproj_i}_icone" ),
	);
}
if ( empty( $eletroproj_cards ) ) {
	return;
}
?>
<section class="section services" aria-labelledby="servicos-titulo">
	<h2 class="section__title" id="servicos-titulo"><?php echo esc_html( eletroproj_mod( 'familia_titulo' ) ); ?></h2>
	<ul class="services__grid">
		<?php foreach ( $eletroproj_cards as $eletroproj_n => $eletroproj_card ) : ?>
			<li class="service service--<?php echo (int) $eletroproj_n + 1; ?>">
				<span class="service__icon" aria-hidden="true"><?php echo eletroproj_icon( $eletroproj_card['icone'], 34 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<h3 class="service__title">
					<?php if ( $eletroproj_card['url'] ) : ?>
						<a href="<?php echo esc_url( $eletroproj_card['url'] ); ?>"><?php echo esc_html( $eletroproj_card['titulo'] ); ?></a>
					<?php else : ?>
						<?php echo esc_html( $eletroproj_card['titulo'] ); ?>
					<?php endif; ?>
				</h3>
				<p class="service__text"><?php echo esc_html( $eletroproj_card['texto'] ); ?></p>
				<?php if ( $eletroproj_card['url'] ) : ?>
					<span class="service__more" aria-hidden="true"><?php esc_html_e( 'Saiba mais', 'eletroproj' ); ?> ↬</span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
