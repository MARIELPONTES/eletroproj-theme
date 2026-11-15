<?php
/**
 * Página inicial (Figma: HomePage). Textos em Aparência › Personalizar › Eletroproj › Página inicial.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

get_header();

$ep_posts_total = (int) wp_count_posts()->publish;
$ep_posts_label = $ep_posts_total >= 20 ? '+' . ( floor( $ep_posts_total / 10 ) * 10 ) : (string) $ep_posts_total;
$ep_hero_image  = (int) ep_opt( 'ep_hero_image' );
?>
<main id="conteudo">
	<section class="home-hero">
		<div class="hero-grid container">
			<div class="hero-copy">
				<span class="eyebrow"><?php echo esc_html( (string) ep_opt( 'ep_hero_eyebrow' ) ); ?></span>
				<h1><?php echo esc_html( (string) ep_opt( 'ep_hero_title' ) ); ?></h1>
				<p><?php echo esc_html( (string) ep_opt( 'ep_hero_text' ) ); ?></p>
				<form class="hero-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php ep_icon( 'search', 21 ); ?>
					<label class="screen-reader-text" for="hero-busca"><?php esc_html_e( 'Buscar na biblioteca', 'eletroproj' ); ?></label>
					<input id="hero-busca" type="search" name="s" placeholder="<?php esc_attr_e( 'O que você precisa resolver?', 'eletroproj' ); ?>">
					<span aria-hidden="true">Ctrl K</span>
				</form>
				<div class="hero-actions">
					<a class="btn btn-primary" href="<?php echo esc_url( ep_guides_url() ); ?>"><?php esc_html_e( 'Explorar guias', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 17 ); ?></a>
					<a class="btn btn-secondary" href="<?php echo esc_url( ep_services_url() ); ?>"><?php esc_html_e( 'Falar com engenheiro', 'eletroproj' ); ?></a>
				</div>
				<div class="proof">
					<span><b><?php echo esc_html( $ep_posts_label ); ?></b> <?php esc_html_e( 'artigos técnicos', 'eletroproj' ); ?></span>
					<span><b><?php echo esc_html( (string) ep_opt( 'ep_proof2_b' ) ); ?></b> <?php echo esc_html( (string) ep_opt( 'ep_proof2_t' ) ); ?></span>
					<span><b><?php echo esc_html( (string) ep_opt( 'ep_proof3_b' ) ); ?></b> <?php echo esc_html( (string) ep_opt( 'ep_proof3_t' ) ); ?></span>
				</div>
			</div>
			<div class="hero-visual<?php echo $ep_hero_image ? '' : ' no-image'; ?>">
				<?php
				if ( $ep_hero_image ) {
					echo wp_get_attachment_image(
						$ep_hero_image,
						'large',
						false,
						array(
							'sizes'         => '(min-width: 1100px) 540px, (min-width: 768px) 45vw, 100vw',
							'loading'       => 'eager',
							'fetchpriority' => 'high',
							'decoding'      => 'async',
						)
					);
				}
				?>
				<div class="drawing-lines" aria-hidden="true"></div>
				<div class="visual-note" aria-hidden="true">
					<span><?php echo esc_html( (string) ep_opt( 'ep_hero_note1' ) ); ?></span>
					<strong><?php echo esc_html( (string) ep_opt( 'ep_hero_note2' ) ); ?></strong>
					<small><?php echo esc_html( (string) ep_opt( 'ep_hero_note3' ) ); ?></small>
				</div>
			</div>
		</div>
	</section>

	<section class="section container" aria-labelledby="pilares-titulo">
		<div class="section-head">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Comece pelos fundamentos', 'eletroproj' ); ?></span>
				<h2 id="pilares-titulo"><?php esc_html_e( 'Guias pilares', 'eletroproj' ); ?></h2>
			</div>
			<a href="<?php echo esc_url( ep_guides_url() ); ?>"><?php esc_html_e( 'Ver todos', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 16 ); ?></a>
		</div>
		<div class="pillar-grid">
			<?php
			$ep_icons = array( 1 => 'shield-check', 2 => 'zap', 3 => 'gauge' );
			foreach ( ep_pillar_categories() as $ep_i => $ep_cat ) :
				$ep_url = $ep_cat ? get_term_link( $ep_cat ) : ep_guides_url();
				?>
				<a class="pillar-card" href="<?php echo esc_url( is_wp_error( $ep_url ) ? home_url( '/' ) : $ep_url ); ?>">
					<div><?php ep_icon( $ep_icons[ $ep_i ], 25 ); ?><span><?php echo esc_html( sprintf( '%02d', $ep_i ) ); ?></span></div>
					<small><?php echo esc_html( $ep_cat ? $ep_cat->name : '' ); ?></small>
					<h3><?php echo esc_html( (string) ep_opt( "ep_pillar{$ep_i}_title" ) ); ?></h3>
					<p><?php echo esc_html( (string) ep_opt( "ep_pillar{$ep_i}_text" ) ); ?></p>
					<?php ep_icon( 'arrow-right', 19, array( 'class' => 'card-arrow' ) ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="section alt-section" aria-labelledby="ferramentas-titulo">
		<div class="container">
			<div class="section-head">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Ferramentas de projeto', 'eletroproj' ); ?></span>
					<h2 id="ferramentas-titulo"><?php esc_html_e( 'Calcule com confiança', 'eletroproj' ); ?></h2>
				</div>
			</div>
			<div class="tools-grid">
				<?php
				$ep_tool_icons = array( 1 => 'zap', 2 => 'calculator', 3 => 'gauge' );
				for ( $ep_i = 1; $ep_i <= 3; $ep_i++ ) :
					$ep_url = (string) ep_opt( "ep_tool{$ep_i}_url" );
					if ( '' === $ep_url ) {
						$ep_url = ep_calculators_url();
					}
					?>
					<a class="tool-card" href="<?php echo esc_url( $ep_url ); ?>">
						<span><?php ep_icon( $ep_tool_icons[ $ep_i ], 24 ); ?></span>
						<div>
							<h3><?php echo esc_html( (string) ep_opt( "ep_tool{$ep_i}_title" ) ); ?></h3>
							<p><?php echo esc_html( (string) ep_opt( "ep_tool{$ep_i}_text" ) ); ?></p>
						</div>
						<?php ep_icon( 'arrow-right', 18 ); ?>
					</a>
				<?php endfor; ?>
			</div>
		</div>
	</section>

	<section class="section container">
		<div class="content-split">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Atualizações técnicas', 'eletroproj' ); ?></span>
				<h2><?php esc_html_e( 'Leituras recentes', 'eletroproj' ); ?></h2>
				<div class="post-list">
					<?php
					$ep_recent = get_posts(
						array(
							'posts_per_page'      => 3,
							'ignore_sticky_posts' => true,
							'no_found_rows'       => true,
						)
					);
					foreach ( $ep_recent as $ep_post ) {
						get_template_part( 'template-parts/cards/post-row', null, array( 'post' => $ep_post ) );
					}
					?>
				</div>
			</div>
			<div class="service-panel">
				<span class="eyebrow"><?php echo esc_html( (string) ep_opt( 'ep_svc_eyebrow' ) ); ?></span>
				<h2><?php echo esc_html( (string) ep_opt( 'ep_svc_title' ) ); ?></h2>
				<p><?php echo esc_html( (string) ep_opt( 'ep_svc_text' ) ); ?></p>
				<ul>
					<?php for ( $ep_i = 1; $ep_i <= 3; $ep_i++ ) : ?>
						<li><?php ep_icon( 'check', 15 ); ?> <?php echo esc_html( (string) ep_opt( "ep_svc_item{$ep_i}" ) ); ?></li>
					<?php endfor; ?>
				</ul>
				<?php $ep_svc_url = (string) ep_opt( 'ep_svc_url' ); ?>
				<a class="btn btn-primary" href="<?php echo esc_url( $ep_svc_url ? $ep_svc_url : ep_services_url() ); ?>"><?php esc_html_e( 'Conhecer serviços', 'eletroproj' ); ?> <?php ep_icon( 'arrow-right', 17 ); ?></a>
			</div>
		</div>
	</section>

	<div class="container home-newsletter">
		<?php get_template_part( 'template-parts/cta/newsletter' ); ?>
	</div>
</main>
<?php
get_footer();
