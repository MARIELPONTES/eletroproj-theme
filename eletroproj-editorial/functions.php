<?php
/**
 * Eletroproj Editorial — funções do tema.
 *
 * Cada responsabilidade fica num arquivo separado em /inc.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

define( 'ELETROPROJ_VERSION', '1.0.0' );
define( 'ELETROPROJ_DIR', get_template_directory() );
define( 'ELETROPROJ_URI', get_template_directory_uri() );

require ELETROPROJ_DIR . '/inc/setup.php';
require ELETROPROJ_DIR . '/inc/enqueue.php';
require ELETROPROJ_DIR . '/inc/performance.php';
require ELETROPROJ_DIR . '/inc/template-tags.php';
require ELETROPROJ_DIR . '/inc/reading-time.php';
require ELETROPROJ_DIR . '/inc/toc.php';
require ELETROPROJ_DIR . '/inc/customizer.php';
require ELETROPROJ_DIR . '/inc/typography.php';
require ELETROPROJ_DIR . '/inc/schema.php';
require ELETROPROJ_DIR . '/inc/block-styles.php';
