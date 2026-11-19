<?php
/**
 * Artigo.
 *
 * @package Eletroproj
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class( 'article' ); ?>>
		<div class="container container--artigo">
			<header class="article-head">
				<?php eletroproj_breadcrumbs(); ?>
				<p class="article-head__byline">
					<a class="byline__author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
					<?php if ( eletroproj_mod( 'mostrar_datas' ) ) : ?>
						<span aria-hidden="true">/</span>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'j M Y' ) ); ?></time>
						<?php if ( eletroproj_mod( 'mostrar_atualizado' ) && get_the_modified_date( 'Ymd' ) > get_the_date( 'Ymd' ) ) : ?>
							<span class="article-head__updated">(<?php esc_html_e( 'atualizado em', 'eletroproj' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_modified_date( 'j M Y' ) ); ?></time>)</span>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( comments_open() || get_comments_number() ) : ?>
						<span aria-hidden="true">/</span>
						<a href="#comentarios">
							<?php
							/* translators: %s: número de comentários */
							printf( esc_html( _n( '%s comentário', '%s comentários', (int) get_comments_number(), 'eletroproj' ) ), esc_html( number_format_i18n( get_comments_number() ) ) );
							?>
						</a>
					<?php endif; ?>
				</p>
				<?php if ( eletroproj_mod( 'titulo_degrade' ) ) : ?>
					<h1 class="article-head__title article-head__title--degrade"><span><?php the_title(); ?></span></h1>
				<?php else : ?>
					<h1 class="article-head__title"><?php the_title(); ?></h1>
				<?php endif; ?>
				<ul class="meta-box">
					<li><?php echo eletroproj_icon( 'relogio', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <span><?php echo esc_html( eletroproj_reading_time() ); ?></span></li>
					<?php if ( eletroproj_category_links() ) : ?>
						<li><?php echo eletroproj_icon( 'pasta', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput ?> <span><?php echo wp_kses_post( eletroproj_category_links() ); ?></span></li>
					<?php endif; ?>
					<li><?php eletroproj_share_links(); ?></li>
				</ul>
			</header>

			<div class="article-layout">
				<div class="article-main">
					<?php if ( has_excerpt() ) : ?>
						<section class="summary" aria-label="<?php esc_attr_e( 'Resumo rápido', 'eletroproj' ); ?>">
							<p><span class="summary__label"><?php esc_html_e( 'Resumo rápido', 'eletroproj' ); ?> <span aria-hidden="true">↬</span></span> <?php echo esc_html( get_the_excerpt() ); ?></p>
						</section>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="article-hero">
							<?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?>
							<?php if ( get_the_post_thumbnail_caption() ) : ?>
								<figcaption><?php the_post_thumbnail_caption(); ?></figcaption>
							<?php endif; ?>
						</figure>
					<?php endif; ?>

					<?php eletroproj_the_toc( 'inline' ); ?>

					<div class="entry-content">
						<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<nav class="page-links">' . esc_html__( 'Páginas:', 'eletroproj' ),
								'after'  => '</nav>',
							)
						);
						?>
					</div>

					<?php
					$eletroproj_tags = get_the_tags();
					if ( $eletroproj_tags ) :
						?>
						<ul class="tag-list" aria-label="<?php esc_attr_e( 'Tags', 'eletroproj' ); ?>">
							<?php foreach ( $eletroproj_tags as $eletroproj_tag ) : ?>
								<li><a href="<?php echo esc_url( get_tag_link( $eletroproj_tag ) ); ?>">#<?php echo esc_html( $eletroproj_tag->name ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php get_template_part( 'template-parts/author-box' ); ?>
				</div>

				<aside class="article-aside">
					<?php get_template_part( 'template-parts/author-box', null, array( 'compact' => true ) ); ?>
					<?php if ( is_active_sidebar( 'lateral-artigo' ) ) : ?>
						<?php dynamic_sidebar( 'lateral-artigo' ); ?>
					<?php endif; ?>
					<div class="article-aside__sticky">
						<?php eletroproj_the_toc( 'lateral' ); ?>
						<?php get_template_part( 'template-parts/newsletter', null, array( 'variant' => 'sidebar' ) ); ?>
					</div>
				</aside>
			</div>
		</div>
	</article>

	<?php
	if ( eletroproj_mod( 'artigo_relacionados' ) ) :
		$eletroproj_related = eletroproj_related_query( 4 );
		if ( $eletroproj_related ) :
			?>
			<section class="related" aria-labelledby="relacionados-titulo">
				<div class="container">
					<h2 class="section__title" id="relacionados-titulo"><?php esc_html_e( 'Continue lendo', 'eletroproj' ); ?></h2>
					<div class="post-grid">
						<?php
						while ( $eletroproj_related->have_posts() ) :
							$eletroproj_related->the_post();
							get_template_part( 'template-parts/card' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</section>
			<?php
		endif;
	endif;
	?>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<div class="container container--artigo">
			<div class="article-layout">
				<div class="article-main"><?php comments_template(); ?></div>
			</div>
		</div>
	<?php endif; ?>
	<?php
endwhile;

get_footer();
