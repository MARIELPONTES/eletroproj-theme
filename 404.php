<?php
/**
 * Página não encontrada (sem tela no Figma: cabeçalho do guia + busca + leituras recentes).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="conteudo">
	<section class="guide-hero compact container">
		<div>
			<span class="eyebrow"><?php esc_html_e( 'Erro 404', 'eletroproj' ); ?></span>
			<h1><?php esc_html_e( 'Página não encontrada.', 'eletroproj' ); ?></h1>
			<p><?php esc_html_e( 'O endereço mudou ou não existe. Busque na biblioteca técnica ou veja as leituras mais recentes.', 'eletroproj' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>
	<section class="section container list-section">
		<div class="chapter-controls">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Atualizações técnicas', 'eletroproj' ); ?></span>
				<h2><?php esc_html_e( 'Leituras recentes', 'eletroproj' ); ?></h2>
			</div>
		</div>
		<div class="chapter-list">
			<?php
			$ep_n = 0;
			foreach ( get_posts(
				array(
					'posts_per_page' => 5,
					'no_found_rows'  => true,
				)
			) as $ep_post ) {
				get_template_part(
					'template-parts/cards/chapter-row',
					null,
					array(
						'post'  => $ep_post,
						'n'     => ++$ep_n,
						'label' => 'category',
					)
				);
			}
			?>
		</div>
	</section>
</main>
<?php
get_footer();
