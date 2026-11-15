<?php
/**
 * Eletroproj — carregamento dos módulos do tema.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

define( 'EP_VERSION', '0.1.0' );
define( 'EP_DIR', get_template_directory() );
define( 'EP_URI', get_template_directory_uri() );

require_once EP_DIR . '/inc/setup.php';
require_once EP_DIR . '/inc/cleanup.php';
require_once EP_DIR . '/inc/assets.php';
require_once EP_DIR . '/inc/icons.php';
require_once EP_DIR . '/inc/logo.php';
require_once EP_DIR . '/inc/customizer.php';
require_once EP_DIR . '/inc/content.php';
require_once EP_DIR . '/inc/newsletter.php';
require_once EP_DIR . '/inc/editor.php';
require_once EP_DIR . '/inc/meta.php';
require_once EP_DIR . '/inc/forms.php';
