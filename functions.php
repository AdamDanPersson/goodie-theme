<?php
/**
 * Theme setup for Goodie.
 *
 * @package GoodieTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme support and core features.
 *
 * @return void
 */
function goodie_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'goodie_theme_setup' );

/**
 * Enqueue the main stylesheet.
 *
 * @return void
 */
function goodie_theme_enqueue_assets() {
	wp_enqueue_style( 'goodie-theme-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'goodie_theme_enqueue_assets' );
