<?php
/**
 * Post (Figma: ArticlePage).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$ep_content = ep_prepare_content();
	// Sumário só com H2, como no Figma (os H3 recebem id e continuam linkáveis).
	$ep_toc     = array_values( array_filter( $ep_content['toc'], static fn( $i ) => 2 === $i['level'] ) );
	$ep_cat     = ep_primary_category();
	$ep_author  = (string) ep_opt( 'ep_rt_name' );
	?>
	<main id="conteudo">
		<div class="progress-line" aria-hidden="true"></div>

		<header class="article-hero container">
			<?php
			ep_breadcrumb( $ep_cat ? array( array( $ep_cat->name, (string) get_term_link( $ep_cat ) ) ) : array() );
			?>
			<?php if ( $ep_cat ) : ?>
				<a class="cat-label" href="<?php echo esc_url( get_term_link( $ep_cat ) ); ?>"><?php echo esc_html( $ep_cat->name ); ?></a>
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="article-deck"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<div class="byline">
				<div class="ep-avatar" aria-hidden="true"><?php echo esc_html( ep_initials( $ep_author ) ); ?></div>
				<div class="byline-who">
					<strong><?php echo esc_html( $ep_author ); ?></strong>
					<span><?php echo esc_html( (string) ep_opt( 'ep_rt_role' ) ); ?></span>
				</div>
				<div class="meta">
					<span><?php esc_html_e( 'Atualizado em', 'eletroproj' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( ep_date( null, true ) ); ?></time></span>
					<span><?php ep_icon( 'clock-3', 15 ); ?> <?php echo esc_html( sprintf( /* translators: %d: minutos */ __( '%d min de leitura', 'eletroproj' ), ep_reading_time() ) ); ?></span>
				</div>
			</div>
		</header>

		<?php if ( $ep_toc ) : ?>
			<details class="mobile-toc container">
				<summary><span><?php ep_icon( 'book-open', 17 ); ?> <?php esc_html_e( 'Neste artigo', 'eletroproj' ); ?></span><?php ep_icon( 'chevron-down', 17 ); ?></summary>
				<nav aria-label="<?php esc_attr_e( 'Neste artigo', 'eletroproj' ); ?>">
					<?php foreach ( $ep_toc as $ep_item ) : ?>
						<a class="toc-l<?php echo (int) $ep_item['level']; ?>" href="#<?php echo esc_attr( $ep_item['id'] ); ?>"><?php echo esc_html( $ep_item['text'] ); ?></a>
					<?php endforeach; ?>
				</nav>
			</details>
		<?php endif; ?>

		<div class="article-layout container<?php echo $ep_toc ? '' : ' no-toc'; ?>">
			<?php if ( $ep_toc ) : ?>
				<aside class="toc">
					<span class="eyebrow" id="toc-titulo"><?php esc_html_e( 'Neste artigo', 'eletroproj' ); ?></span>
					<nav aria-labelledby="toc-titulo" data-toc>
						<?php
						$ep_n = 0;
						foreach ( $ep_toc as $ep_item ) :
							$ep_is_h2 = 2 === $ep_item['level'];
							if ( $ep_is_h2 ) {
								++$ep_n;
							}
							?>
							<a class="toc-l<?php echo (int) $ep_item['level']; ?>" href="#<?php echo esc_attr( $ep_item['id'] ); ?>"><span><?php echo $ep_is_h2 ? esc_html( sprintf( '%02d', $ep_n ) ) : ''; ?></span><?php echo esc_html( $ep_item['text'] ); ?></a>
						<?php endforeach; ?>
					</nav>
					<div class="toc-help">
						<span><?php esc_html_e( 'Dúvida no seu projeto?', 'eletroproj' ); ?></span>
						<a href="<?php echo esc_url( ep_quote_url() ); ?>"><?php esc_html_e( 'Fale com um engenheiro', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 14 ); ?></a>
					</div>
				</aside>
			<?php endif; ?>

			<article <?php post_class( 'article-body' ); ?>>
				<div class="entry-content">
					<?php echo $ep_content['html']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- the_content filtrado. ?>
				</div>
				<?php
				wp_link_pages(
					array(
						'before' => '<nav class="page-links">',
						'after'  => '</nav>',
					)
				);

				get_template_part( 'template-parts/post/author-box' );
				get_template_part( 'template-parts/cta/newsletter' );
				get_template_part( 'template-parts/post/related' );

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</article>
		</div>
	</main>
	<?php
endwhile;

get_footer();
