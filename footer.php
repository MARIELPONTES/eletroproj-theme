<?php
/**
 * Rodapé. (Etapa 1: estrutura mínima — o rodapé do Figma entra na etapa 2.)
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;
?>
<footer class="site-footer">
	<div class="container">
		<small>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></small>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
