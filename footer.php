<?php
/**
 * Rodapé do site (Figma: Footer).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_footer_menus = array(
	'footer-conteudo' => __( 'Conteúdo', 'eletroproj' ),
	'footer-empresa'  => __( 'Empresa', 'eletroproj' ),
);
?>
<footer class="site-footer">
	<div class="container footer-grid">
		<div class="footer-brand">
			<?php ep_logo( 'footer' ); ?>
			<p><?php echo esc_html( (string) ep_opt( 'ep_tagline' ) ); ?></p>
		</div>

		<?php foreach ( $ep_footer_menus as $ep_location => $ep_title ) : ?>
			<?php if ( has_nav_menu( $ep_location ) ) : ?>
				<nav class="footer-col" aria-label="<?php echo esc_attr( $ep_title ); ?>">
					<strong><?php echo esc_html( $ep_title ); ?></strong>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => $ep_location,
							'container'      => false,
							'depth'          => 1,
							'items_wrap'     => '<ul>%3$s</ul>',
						)
					);
					?>
				</nav>
			<?php endif; ?>
		<?php endforeach; ?>

		<div class="footer-col">
			<strong><?php esc_html_e( 'Responsável técnico', 'eletroproj' ); ?></strong>
			<p>
				<?php echo esc_html( (string) ep_opt( 'ep_rt_name' ) ); ?><br>
				<?php echo esc_html( (string) ep_opt( 'ep_rt_role' ) ); ?>
			</p>
		</div>
	</div>
	<div class="container footer-bottom">
		<span>&copy; <?php echo esc_html( wp_date( 'Y' ) . ' ' . ep_opt( 'ep_company' ) ); ?></span>
		<span><?php echo esc_html( (string) ep_opt( 'ep_city' ) ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
