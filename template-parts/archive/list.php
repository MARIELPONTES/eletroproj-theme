<?php
/**
 * Lista de posts do loop principal + paginação (guia, blog, tags, autor, busca).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

$ep_eyebrow = (string) ( $args['eyebrow'] ?? '' );
$ep_title   = (string) ( $args['title'] ?? '' );
$ep_label   = (string) ( $args['label'] ?? 'category' );
$ep_filter  = ! empty( $args['filter'] );

global $wp_query;
$ep_paged  = max( 1, (int) get_query_var( 'paged' ) );
$ep_offset = ( $ep_paged - 1 ) * (int) get_query_var( 'posts_per_page' );

// Mostra o filtro de nível só se algum post da página tiver nível.
$ep_has_levels = false;
if ( $ep_filter ) {
	foreach ( $wp_query->posts as $ep_p ) {
		if ( get_post_meta( $ep_p->ID, 'ep_level', true ) ) {
			$ep_has_levels = true;
			break;
		}
	}
}
?>
<section class="section container list-section">
	<div class="chapter-controls">
		<div>
			<?php if ( $ep_eyebrow ) : ?>
				<span class="eyebrow"><?php echo esc_html( $ep_eyebrow ); ?></span>
			<?php endif; ?>
			<?php if ( $ep_title ) : ?>
				<h2><?php echo esc_html( $ep_title ); ?></h2>
			<?php endif; ?>
		</div>
		<?php if ( $ep_has_levels ) : ?>
			<div class="level-filter" data-level-filter role="group" aria-label="<?php esc_attr_e( 'Filtrar por nível', 'eletroproj' ); ?>">
				<?php ep_icon( 'sliders-horizontal', 17 ); ?>
				<button type="button" data-level="todos" aria-pressed="true"><?php esc_html_e( 'Todos', 'eletroproj' ); ?></button>
				<?php foreach ( ep_levels() as $ep_key => $ep_name ) : ?>
					<button type="button" data-level="<?php echo esc_attr( $ep_key ); ?>" aria-pressed="false"><?php echo esc_html( $ep_name ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>

	<?php if ( have_posts() ) : ?>
		<div class="chapter-list">
			<?php
			$ep_n = $ep_offset;
			while ( have_posts() ) :
				the_post();
				get_template_part(
					'template-parts/cards/chapter-row',
					null,
					array(
						'post'  => get_post(),
						'n'     => ++$ep_n,
						'label' => $ep_has_levels ? 'level' : $ep_label,
					)
				);
			endwhile;
			?>
		</div>
		<?php
		the_posts_pagination(
			array(
				'mid_size'           => 1,
				'prev_text'          => '←<span class="screen-reader-text"> ' . __( 'Anterior', 'eletroproj' ) . '</span>',
				'next_text'          => '<span class="screen-reader-text">' . __( 'Próxima', 'eletroproj' ) . ' </span>→',
				'screen_reader_text' => __( 'Paginação', 'eletroproj' ),
			)
		);
		?>
	<?php else : ?>
		<p class="empty-state"><?php echo esc_html( (string) ( $args['empty'] ?? __( 'Nenhum conteúdo publicado aqui ainda.', 'eletroproj' ) ) ); ?></p>
	<?php endif; ?>
</section>
