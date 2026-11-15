<?php
/**
 * Resultados da busca (sem tela no Figma: cabeçalho do guia + campo de busca + lista).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ep_total = (int) $GLOBALS['wp_query']->found_posts;
?>
<main id="conteudo">
	<section class="guide-hero compact container">
		<div>
			<?php ep_breadcrumb( array( array( __( 'Busca', 'eletroproj' ), '' ) ) ); ?>
			<span class="eyebrow"><?php echo esc_html( sprintf( /* translators: %d: resultados */ _n( '%d resultado', '%d resultados', $ep_total, 'eletroproj' ), $ep_total ) ); ?></span>
			<h1><?php echo esc_html( sprintf( /* translators: %s: termo */ __( 'Busca: %s', 'eletroproj' ), get_search_query() ) ); ?></h1>
			<?php get_search_form(); ?>
		</div>
	</section>
	<?php
	get_template_part(
		'template-parts/archive/list',
		null,
		array(
			'title' => __( 'Resultados', 'eletroproj' ),
			'empty' => __( 'Nada encontrado. Tente outro termo, como "NBR 5419", "SPDA" ou "queda de tensão".', 'eletroproj' ),
		)
	);
	?>
</main>
<?php
get_footer();
