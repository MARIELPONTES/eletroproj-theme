<?php
/**
 * Rodapé.
 *
 * @package Eletroproj
 */

$eletroproj_social = array(
	'instagram' => 'Instagram',
	'youtube'   => 'YouTube',
	'linkedin'  => 'LinkedIn',
	'whatsapp'  => 'WhatsApp',
);
?>
</main>

<footer class="site-footer">
	<div class="container">
		<?php if ( eletroproj_mod( 'home_temas' ) || ! is_front_page() ) : ?>
			<section class="all-topics" id="todos-os-temas" aria-labelledby="todos-os-temas-titulo">
				<h2 id="todos-os-temas-titulo" class="all-topics__title"><?php esc_html_e( 'Todos os temas', 'eletroproj' ); ?></h2>
				<ul class="all-topics__list">
					<?php
					wp_list_categories(
						array(
							'title_li'   => '',
							'orderby'    => 'name',
							'show_count' => false,
							'hide_empty' => true,
						)
					);
					?>
				</ul>
			</section>
		<?php endif; ?>

		<div class="site-footer__grid">
			<div class="site-footer__about">
				<a class="brand__text brand__text--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<span class="brand__mark" aria-hidden="true"><?php echo eletroproj_icon( 'raio', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="brand__name"><?php bloginfo( 'name' ); ?></span>
				</a>
				<p><?php echo esc_html( eletroproj_mod( 'rodape_texto' ) ); ?></p>
				<ul class="social">
					<?php
					foreach ( $eletroproj_social as $eletroproj_key => $eletroproj_label ) :
						$eletroproj_url = eletroproj_mod( $eletroproj_key );
						if ( ! $eletroproj_url ) {
							continue;
						}
						?>
						<li><a href="<?php echo esc_url( $eletroproj_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $eletroproj_label ); ?>"><?php echo eletroproj_icon( $eletroproj_key, 22 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Links do rodapé', 'eletroproj' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'rodape',
						'container'      => false,
						'menu_class'     => 'footer-links',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		</div>

		<div class="site-footer__bottom">
			<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos os direitos reservados.', 'eletroproj' ); ?></p>
		</div>
	</div>
</footer>

<a class="back-to-top" href="#main" title="<?php esc_attr_e( 'Voltar ao topo', 'eletroproj' ); ?>"><span class="back-to-top__texto"><?php esc_html_e( 'Voltar ao topo', 'eletroproj' ); ?></span> <?php echo eletroproj_icon( 'topo', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>

<?php wp_footer(); ?>
</body>
</html>
