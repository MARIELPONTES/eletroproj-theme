<?php
/**
 * Cabeçalho. (Etapa 1: estrutura mínima — o header do Figma entra na etapa 2.)
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#conteudo"><?php esc_html_e( 'Pular para o conteúdo', 'eletroproj' ); ?></a>
<header class="site-header">
	<div class="container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<button type="button" class="icon-btn" data-theme-toggle aria-label="<?php esc_attr_e( 'Alternar tema claro/escuro', 'eletroproj' ); ?>">
			<?php ep_icon( 'sun', 19 ); ?>
			<?php ep_icon( 'moon', 19 ); ?>
		</button>
	</div>
</header>
