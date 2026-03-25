<?php
/**
 * Theme header.
 *
 * @package GoodieTheme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
$collection_form_url    = goodie_theme_get_collection_form_url();
$collection_archive_url = goodie_theme_get_collection_archive_url();
$cart_url               = goodie_theme_get_cart_url();
$cart_count             = goodie_theme_get_cart_count();
$current_url            = goodie_theme_get_current_url();
$login_url              = wp_login_url( $current_url );
$logout_url             = wp_logout_url( $current_url );
$register_url           = get_option( 'users_can_register' ) ? wp_registration_url() : '';
$account_url            = goodie_theme_get_account_url();
?>
<header class="goodie-site-header">
	<div class="goodie-site-header__inner">
		<a class="goodie-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>
		<nav class="goodie-site-nav" aria-label="<?php echo esc_attr__( 'Primary navigation', 'goodie-collections' ); ?>">
			<a class="goodie-site-nav__link<?php echo is_front_page() ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Home', 'goodie-collections' ); ?></a>
			<a class="goodie-site-nav__link<?php echo is_post_type_archive( 'goodie_collection' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( $collection_archive_url ); ?>"><?php echo esc_html__( 'Collections', 'goodie-collections' ); ?></a>
			<a class="goodie-site-nav__link<?php echo is_page_template( 'page-template-goodie-collection-form.php' ) ? ' is-current' : ''; ?>" href="<?php echo esc_url( $collection_form_url ); ?>"><?php echo esc_html__( 'Create collection', 'goodie-collections' ); ?></a>
			<a class="goodie-site-nav__link goodie-site-nav__cart<?php echo function_exists( 'is_cart' ) && is_cart() ? ' is-current' : ''; ?>" href="<?php echo esc_url( $cart_url ); ?>">
				<span><?php echo esc_html__( 'Cart', 'goodie-collections' ); ?></span>
				<span class="goodie-site-nav__cart-count"><?php echo esc_html( $cart_count ); ?></span>
			</a>
			<?php if ( is_user_logged_in() ) : ?>
				<a class="goodie-site-nav__link" href="<?php echo esc_url( $account_url ); ?>"><?php echo esc_html__( 'My account', 'goodie-collections' ); ?></a>
				<a class="goodie-site-nav__link goodie-site-nav__link--secondary" href="<?php echo esc_url( $logout_url ); ?>"><?php echo esc_html__( 'Log out', 'goodie-collections' ); ?></a>
			<?php else : ?>
				<a class="goodie-site-nav__link" href="<?php echo esc_url( $login_url ); ?>"><?php echo esc_html__( 'Log in', 'goodie-collections' ); ?></a>
				<?php if ( ! empty( $register_url ) ) : ?>
					<a class="goodie-site-nav__link goodie-site-nav__link--secondary" href="<?php echo esc_url( $register_url ); ?>"><?php echo esc_html__( 'Register', 'goodie-collections' ); ?></a>
				<?php endif; ?>
			<?php endif; ?>
		</nav>
	</div>
</header>
<main class="goodie-shell">
