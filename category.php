<?php
/**
 * Categoria = guia (Figma: GuidePage).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ep_term    = get_queried_object();
$ep_title   = (string) get_term_meta( $ep_term->term_id, 'ep_guide_title', true );
$ep_code    = (string) get_term_meta( $ep_term->term_id, 'ep_guide_code', true );
$ep_code    = $ep_code ? $ep_code : $ep_term->name;
$ep_parts   = preg_split( '/\s+/', trim( $ep_code ), 2 );
$ep_count   = (int) $ep_term->count;
$ep_pillars = array_filter( ep_pillar_categories() );
$ep_pillar  = 0;
foreach ( $ep_pillars as $ep_i => $ep_p ) {
	if ( $ep_p->term_id === $ep_term->term_id ) {
		$ep_pillar = $ep_i;
	}
}
$ep_icon   = array( 1 => 'shield-check', 2 => 'zap', 3 => 'gauge' )[ $ep_pillar ] ?? 'book-open';
$ep_latest = get_posts(
	array(
		'cat'            => $ep_term->term_id,
		'posts_per_page' => 1,
		'orderby'        => 'modified',
		'no_found_rows'  => true,
	)
);
?>
<main id="conteudo">
	<section class="guide-hero container">
		<div>
			<?php ep_breadcrumb( array( array( $ep_term->name, '' ) ) ); ?>
			<span class="eyebrow">
				<?php
				echo esc_html(
					( $ep_pillar ? __( 'Guia pilar', 'eletroproj' ) : __( 'Guia técnico', 'eletroproj' ) ) . ' · ' .
					sprintf( /* translators: %d: número de artigos */ _n( '%d capítulo', '%d capítulos', $ep_count, 'eletroproj' ), $ep_count )
				);
				?>
			</span>
			<h1><?php echo esc_html( $ep_title ? $ep_title : $ep_term->name ); ?></h1>
			<?php if ( $ep_term->description ) : ?>
				<p><?php echo esc_html( wp_strip_all_tags( $ep_term->description ) ); ?></p>
			<?php endif; ?>
			<div class="guide-meta">
				<span><?php ep_icon( 'book-open', 16 ); ?> <?php echo esc_html( sprintf( /* translators: %s: tempo */ __( '%s de conteúdo', 'eletroproj' ), ep_format_minutes( ep_category_minutes( $ep_term->term_id ) ) ) ); ?></span>
				<span><?php ep_icon( 'file-check-2', 16 ); ?> <?php esc_html_e( 'Revisado por engenheiro', 'eletroproj' ); ?></span>
				<span><?php ep_icon( 'layers-3', 16 ); ?> <?php esc_html_e( 'Do básico ao avançado', 'eletroproj' ); ?></span>
			</div>
		</div>
		<div class="guide-schematic" aria-hidden="true">
			<?php ep_icon( $ep_icon, 72, array( 'stroke' => 1.5 ) ); ?>
			<span><?php echo esc_html( $ep_parts[0] ); ?><?php if ( isset( $ep_parts[1] ) ) : ?><br><b><?php echo esc_html( $ep_parts[1] ); ?></b><?php endif; ?></span>
			<small><?php esc_html_e( 'EDIÇÃO TÉCNICA', 'eletroproj' ); ?><br><?php echo esc_html( $ep_latest ? get_the_modified_date( 'Y.m', $ep_latest[0] ) : wp_date( 'Y.m' ) ); ?></small>
		</div>
	</section>
	<?php
	get_template_part(
		'template-parts/archive/list',
		null,
		array(
			'eyebrow' => __( 'Índice do guia', 'eletroproj' ),
			'title'   => __( 'Capítulos', 'eletroproj' ),
			'label'   => 'level',
			'filter'  => true,
		)
	);
	?>
</main>
<?php
get_footer();
