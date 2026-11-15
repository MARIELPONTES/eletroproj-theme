<?php
/**
 * Página de posts (blog) e modelo de reserva.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ep_blog  = (int) get_option( 'page_for_posts' );
$ep_title = $ep_blog ? get_the_title( $ep_blog ) : __( 'Artigos técnicos', 'eletroproj' );
?>
<main id="conteudo">
	<section class="guide-hero compact container">
		<div>
			<?php ep_breadcrumb( array( array( $ep_title, '' ) ) ); ?>
			<span class="eyebrow"><?php echo esc_html( sprintf( /* translators: %d: número de artigos */ _n( 'Biblioteca técnica · %d artigo', 'Biblioteca técnica · %d artigos', (int) $GLOBALS['wp_query']->found_posts, 'eletroproj' ), (int) $GLOBALS['wp_query']->found_posts ) ); ?></span>
			<h1><?php echo esc_html( $ep_title ); ?></h1>
		</div>
	</section>
	<?php get_template_part( 'template-parts/archive/list', null, array( 'title' => __( 'Mais recentes', 'eletroproj' ) ) ); ?>
</main>
<?php
get_footer();
