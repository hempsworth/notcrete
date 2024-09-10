<?php
/**
 * Displays the site header
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

$wrapper_classes = array();

// Wrapper classes: Logo images
if ( has_custom_logo() ) {
	$wrapper_classes[] = 'has-logo-image';
}
if ( Heim_Customize::get_setting( 'logo_mobile' ) ) {
	$wrapper_classes[] = 'has-mobile-logo-image';
}

// Wrapper class: Desktop menu button
if ( Heim_Customize::get_setting( 'mobile_menu_enable_on_desktop' ) ) {
	$wrapper_classes[] = 'has-desktop-menu-button';
}

// Wrapper classes: Tools
if ( Heim_Customize::get_setting( 'header_color_mode' ) ) {
	$wrapper_classes[] = 'has-color-mode-tool';
}
if ( Heim_Customize::get_setting( 'header_search' ) ) {
	$wrapper_classes[] = 'has-search-tool';
}
if ( Heim_Customize::get_setting( 'header_myaccount' ) ) {
	$wrapper_classes[] = 'has-myaccount-tool';
}
if ( class_exists( 'NM_WooCommerce_Wishlist' ) && Heim_Customize::get_setting( 'header_wishlist' ) ) {
	$wrapper_classes[] = 'has-wishlist-tool';
}
if ( Heim_Customize::get_setting( 'header_cart' ) ) {
	$wrapper_classes[] = 'has-cart-tool';
}
?>

<?php
/**
 * Hook: heim_before_header
 *
 * @hooked woocommerce_demo_store - 10
 */
do_action( 'heim_before_header' );
?>

<header id="masthead" class="site-header <?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>">
	
	<div class="site-header-wrapper">
	
		<?php
		/**
		 * Hook: heim_before_header_bar
		 */
		do_action( 'heim_before_header_bar' );
		?>

		<div id="site-header" class="page-max-width">
			
			<?php
			// Mobile menu button
			heim_mobile_menu_button();
			?>
			<?php get_template_part( 'template-parts/header/branding' ); ?>
			<?php get_template_part( 'template-parts/header/menu-primary' ); ?>
			<?php get_template_part( 'template-parts/header/menu-secondary' ); ?>

		</div><!-- #site-header -->
	
	</div><!-- .site-header-wrapper -->
	
</header><!-- #masthead -->

<?php get_template_part( 'template-parts/header/mobile-menu' ); ?>
