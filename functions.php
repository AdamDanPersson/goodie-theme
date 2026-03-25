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

/**
 * Return the frontend collection form page URL.
 *
 * @return string
 */
function goodie_theme_get_collection_form_url() {
	$pages = get_posts(
		array(
			'post_type'              => 'page',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'meta_key'               => '_wp_page_template',
			'meta_value'             => 'page-template-goodie-collection-form.php',
		)
	);

	if ( ! empty( $pages ) ) {
		return get_permalink( $pages[0] );
	}

	return goodie_theme_get_collection_archive_url();
}

/**
 * Return the collection archive URL.
 *
 * @return string
 */
function goodie_theme_get_collection_archive_url() {
	if ( post_type_exists( 'goodie_collection' ) ) {
		$archive_url = get_post_type_archive_link( 'goodie_collection' );

		if ( $archive_url ) {
			return $archive_url;
		}
	}

	return home_url( '/' );
}

/**
 * Return the current frontend URL.
 *
 * @return string
 */
function goodie_theme_get_current_url() {
	$scheme = is_ssl() ? 'https' : 'http';
	$host   = isset( $_SERVER['HTTP_HOST'] ) ? wp_unslash( $_SERVER['HTTP_HOST'] ) : '';
	$uri    = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';

	if ( empty( $host ) ) {
		return home_url( '/' );
	}

	return esc_url_raw( $scheme . '://' . $host . $uri );
}

/**
 * Return the account page URL when available.
 *
 * @return string
 */
function goodie_theme_get_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$account_url = wc_get_page_permalink( 'myaccount' );

		if ( $account_url ) {
			return $account_url;
		}
	}

	return home_url( '/' );
}

/**
 * Return the WooCommerce cart URL.
 *
 * @return string
 */
function goodie_theme_get_cart_url() {
	if ( function_exists( 'wc_get_cart_url' ) ) {
		return wc_get_cart_url();
	}

	return home_url( '/' );
}

/**
 * Return the current WooCommerce cart count.
 *
 * @return int
 */
function goodie_theme_get_cart_count() {
	if ( function_exists( 'WC' ) && WC()->cart ) {
		return (int) WC()->cart->get_cart_contents_count();
	}

	return 0;
}

/**
 * Render a continue shopping action on the cart page.
 *
 * @return void
 */
function goodie_theme_render_continue_shopping_button() {
	if ( ! function_exists( 'is_cart' ) || ! is_cart() ) {
		return;
	}
	?>
	<p class="goodie-cart-continue-wrap goodie-cart-continue-wrap--top">
		<a class="goodie-button goodie-button--secondary goodie-cart-continue" href="<?php echo esc_url( goodie_theme_get_collection_archive_url() ); ?>"><?php echo esc_html__( 'Fortsätt handla', 'goodie-collections' ); ?></a>
	</p>
	<?php
}
add_action( 'woocommerce_before_cart', 'goodie_theme_render_continue_shopping_button', 5 );
