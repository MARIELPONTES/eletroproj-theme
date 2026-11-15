<?php
/**
 * Cabeçalho do site (Figma: Header).
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?> data-theme="<?php echo esc_attr( ep_html_theme() ); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#conteudo"><?php esc_html_e( 'Pular para o conteúdo', 'eletroproj' ); ?></a>
<header class="site-header">
	<div class="header-inner">
		<?php ep_logo( 'header' ); ?>

		<nav id="menu-principal" class="main-nav" aria-label="<?php esc_attr_e( 'Navegação principal', 'eletroproj' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
					'items_wrap'     => '<ul class="main-nav-list">%3$s</ul>',
					'fallback_cb'    => false,
				)
			);
			?>
			<button type="button" class="main-nav-search" data-search-open aria-haspopup="dialog">
				<?php ep_icon( 'search', 22 ); ?><?php esc_html_e( 'Buscar', 'eletroproj' ); ?>
			</button>
		</nav>

		<div class="header-actions">
			<button type="button" class="icon-btn header-search" data-search-open aria-haspopup="dialog" aria-label="<?php esc_attr_e( 'Buscar', 'eletroproj' ); ?>">
				<?php ep_icon( 'search', 19 ); ?>
			</button>
			<button type="button" class="icon-btn" data-theme-toggle aria-label="<?php esc_attr_e( 'Alternar tema claro/escuro', 'eletroproj' ); ?>">
				<?php ep_icon( 'sun', 19 ); ?>
				<?php ep_icon( 'moon', 19 ); ?>
			</button>
			<a class="btn btn-primary header-cta" href="<?php echo esc_url( ep_quote_url() ); ?>"><?php esc_html_e( 'Pedir orçamento', 'eletroproj' ); ?></a>
			<button type="button" class="icon-btn mobile-menu" data-menu-toggle aria-controls="menu-principal" aria-expanded="false" aria-label="<?php esc_attr_e( 'Abrir menu', 'eletroproj' ); ?>">
				<?php ep_icon( 'menu', 21 ); ?>
				<?php ep_icon( 'x', 21 ); ?>
			</button>
		</div>
	</div>
</header>
<?php
get_template_part( 'template-parts/header/search-dialog' );
