<?php
/**
 * Página não encontrada.
 *
 * @package Eletroproj
 */

get_header();
?>
<div class="container">
	<div class="not-found">
		<p class="not-found__code" aria-hidden="true">404</p>
		<h1 class="page-head__title"><?php esc_html_e( 'Circuito aberto: página não encontrada', 'eletroproj' ); ?></h1>
		<p><?php esc_html_e( 'O endereço pode ter mudado ou o artigo foi removido. Busque pelo assunto ou navegue pelos temas abaixo.', 'eletroproj' ); ?></p>
		<?php get_search_form(); ?>
		<p><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Voltar para o início', 'eletroproj' ); ?></a></p>
	</div>
</div>
<?php
get_footer();
