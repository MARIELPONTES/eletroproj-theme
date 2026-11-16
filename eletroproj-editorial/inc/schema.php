<?php
/**
 * Dados estruturados (JSON-LD) para artigos e breadcrumbs.
 * Desativado automaticamente se Yoast SEO, Rank Math ou SEOPress estiverem ativos.
 *
 * @package Eletroproj
 */

defined( 'ABSPATH' ) || exit;

/**
 * Verifica se há plugin de SEO que já gera schema.
 *
 * @return bool
 */
function eletroproj_has_seo_plugin() {
	return defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) || class_exists( 'All_in_One_SEO_Pack' ) || defined( 'AIOSEO_VERSION' );
}

/**
 * Imprime o JSON-LD no <head>.
 */
function eletroproj_schema() {
	if ( eletroproj_has_seo_plugin() || ! is_singular( 'post' ) ) {
		return;
	}
	$post_id = get_queried_object_id();
	$author  = (int) get_post_field( 'post_author', $post_id );
	$logo_id = get_theme_mod( 'custom_logo' );

	$article = array(
		'@context'         => 'https://schema.org',
		'@type'            => 'Article',
		'headline'         => wp_strip_all_tags( get_the_title( $post_id ) ),
		'description'      => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
		'datePublished'    => get_the_date( DATE_W3C, $post_id ),
		'dateModified'     => get_the_modified_date( DATE_W3C, $post_id ),
		'mainEntityOfPage' => get_permalink( $post_id ),
		'inLanguage'       => get_bloginfo( 'language' ),
		'author'           => array(
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $author ),
			'url'   => get_author_posts_url( $author ),
		),
		'publisher'        => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
			'url'   => home_url( '/' ),
		),
	);
	if ( $logo_id ) {
		$article['publisher']['logo'] = array(
			'@type' => 'ImageObject',
			'url'   => wp_get_attachment_image_url( $logo_id, 'full' ),
		);
	}
	if ( has_post_thumbnail( $post_id ) ) {
		$article['image'] = get_the_post_thumbnail_url( $post_id, 'full' );
	}

	$crumbs = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => __( 'Início', 'eletroproj' ),
			'item'     => home_url( '/' ),
		),
	);
	$cats   = get_the_category( $post_id );
	if ( ! empty( $cats ) ) {
		$crumbs[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => $cats[0]->name,
			'item'     => get_category_link( $cats[0] ),
		);
	}
	$crumbs[] = array(
		'@type'    => 'ListItem',
		'position' => count( $crumbs ) + 1,
		'name'     => wp_strip_all_tags( get_the_title( $post_id ) ),
	);
	$breadcrumb = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $crumbs,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( array( $article, $breadcrumb ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'eletroproj_schema', 20 );
