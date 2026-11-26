<?php
/**
 * Cabeçalho.
 *
 * @package Eletroproj
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<ul class="skip-links">
	<li><a class="skip-link" href="#main"><?php esc_html_e( 'Pular para o conteúdo', 'eletroproj' ); ?></a></li>
	<?php if ( is_front_page() || is_home() ) : ?>
		<li><a class="skip-link" href="#ultimos-artigos"><?php esc_html_e( 'Ir para a lista de artigos', 'eletroproj' ); ?></a></li>
	<?php endif; ?>
	<li><a class="skip-link" href="#todos-os-temas"><?php esc_html_e( 'Ir para todos os temas', 'eletroproj' ); ?></a></li>
</ul>

<?php if ( is_singular( 'post' ) && eletroproj_mod( 'artigo_progresso' ) ) : ?>
	<div class="progress" aria-hidden="true"><span class="progress__bar"></span></div>
<?php endif; ?>

<header class="site-header">
	<div class="site-header__bar">
		<div class="container site-header__inner">
			<div class="brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="brand__text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
						<span class="brand__mark" aria-hidden="true"><?php echo eletroproj_icon( 'raio', 26 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<span class="brand__name"><?php bloginfo( 'name' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<nav class="primary-nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Menu principal', 'eletroproj' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'principal',
						'container'      => false,
						'menu_class'     => 'primary-nav__list',
						'depth'          => 3,
						'fallback_cb'    => 'eletroproj_primary_fallback',
					)
				);
				?>
			</nav>

			<div class="site-header__tools">
				<button type="button" class="menu-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="<?php esc_attr_e( 'Menu', 'eletroproj' ); ?>">
					<?php echo eletroproj_icon( 'menu', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<span><?php esc_html_e( 'Menu', 'eletroproj' ); ?></span>
				</button>
				<button type="button" class="theme-toggle" aria-label="<?php esc_attr_e( 'Alternar modo claro/escuro', 'eletroproj' ); ?>">
					<span class="theme-toggle__sun"><?php echo eletroproj_icon( 'sol', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="theme-toggle__moon"><?php echo eletroproj_icon( 'lua', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</button>
				<form role="search" method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="header-search-input"><?php esc_html_e( 'Buscar artigos', 'eletroproj' ); ?></label>
					<?php echo eletroproj_icon( 'busca', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<input id="header-search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Buscar artigos…', 'eletroproj' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
				</form>
			</div>
		</div>
	</div>

	<?php eletroproj_topics_bar(); ?>
</header>

<main id="main" class="site-main" tabindex="-1">
