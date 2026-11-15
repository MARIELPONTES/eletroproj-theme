<?php
/**
 * Tags, autor e datas (sem tela no Figma: cabeçalho e lista do guia).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( is_tag() ) {
	$ep_eyebrow = __( 'Tag', 'eletroproj' );
	$ep_title   = single_tag_title( '', false );
} elseif ( is_author() ) {
	$ep_eyebrow = __( 'Autor', 'eletroproj' );
	$ep_title   = get_the_author_meta( 'display_name', (int) get_query_var( 'author' ) );
} else {
	$ep_eyebrow = __( 'Arquivo', 'eletroproj' );
	$ep_title   = wp_strip_all_tags( get_the_archive_title() );
}
$ep_desc = wp_strip_all_tags( (string) get_the_archive_description() );
?>
<main id="conteudo">
	<section class="guide-hero compact container">
		<div>
			<?php ep_breadcrumb( array( array( (string) $ep_title, '' ) ) ); ?>
			<span class="eyebrow"><?php echo esc_html( $ep_eyebrow . ' · ' . sprintf( /* translators: %d: número de artigos */ _n( '%d artigo', '%d artigos', (int) $GLOBALS['wp_query']->found_posts, 'eletroproj' ), (int) $GLOBALS['wp_query']->found_posts ) ); ?></span>
			<h1><?php echo esc_html( (string) $ep_title ); ?></h1>
			<?php if ( $ep_desc ) : ?>
				<p><?php echo esc_html( $ep_desc ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<?php get_template_part( 'template-parts/archive/list', null, array( 'title' => __( 'Artigos', 'eletroproj' ) ) ); ?>
</main>
<?php
get_footer();
