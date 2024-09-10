<?php
/**
 * Enqueue scripts and styles
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

/**
 * Scripts and styles
 */
function heim_scripts() {
	// Google fonts
	Heim_Google_Fonts::enqueue_fonts();
	
	// Core styles
	wp_enqueue_style( 'heim-style', get_template_directory_uri() . '/style.css', array(), HEIM_THEME_VERSION );
	
	// RTL styles
	wp_style_add_data( 'heim-style', 'rtl', 'replace' );
	
	// WooCommerce styles
	if ( heim_woocommerce_active() ) {
		wp_enqueue_style( 'heim-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), HEIM_THEME_VERSION );
		wp_enqueue_style( 'heim-woocommerce-block-style', get_template_directory_uri() . '/assets/css/woocommerce-blocks-prefixed.css', array(), HEIM_THEME_VERSION );
		
		// WooCommerce RTL styles
		wp_style_add_data( 'heim-woocommerce-style', 'rtl', 'replace' );
		wp_style_add_data( 'heim-woocommerce-block-style', 'rtl', 'replace' );
	}
	
	// Customizer styles
	wp_add_inline_style( 'heim-style', Heim_Customize::get_styles() );
	
	// Threaded comment reply styles
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'heim-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), HEIM_THEME_VERSION, true );
	
	$scripts_data = array();
	
	// WooCommerce JavaScript data
	if ( heim_woocommerce_active() ) {
		$scripts_data['mini_cart_count_refresh']              = intval( apply_filters( 'heim_mini_cart_always_refresh_count', 0 ) );
		$scripts_data['shop_filters_panel_close_on_unload'] = intval( apply_filters( 'heim_shop_filters_panel_close_on_unload', 1 ) );
		$scripts_data['shop_ajax_pagination_set_page_url']  = intval( apply_filters( 'heim_shop_ajax_pagination_set_page_url', 0 ) );
		$scripts_data['breakpoint_product_gallery']          = intval( apply_filters( 'heim_breakpoint_product_gallery', 1023 ) );
	}
	
	// Include JavaScript data
	wp_localize_script( 'heim-scripts', 'heim_data', $scripts_data );
}
add_action( 'wp_enqueue_scripts', 'heim_scripts' );


/**
 * Admin scripts and styles
 */
function heim_admin_scripts() {
	// Google fonts
	Heim_Google_Fonts::enqueue_fonts();
	
	wp_enqueue_style( 'heim-style-admin', get_template_directory_uri() . '/assets/css/style-admin.css', array(), HEIM_THEME_VERSION, 'all' );
	
	// Customizer styles (needed for Block Editor)
	wp_add_inline_style( 'heim-style-admin', Heim_Customize::get_styles() );
	
	wp_enqueue_script( 'heim-scripts-admin', get_template_directory_uri() . '/assets/js/scripts-admin.js', array( 'jquery' ), HEIM_THEME_VERSION, true );
	
	// Include JavaScript data
	$color_mode = Heim_Customize::get_setting( 'color_mode' );
	wp_localize_script( 'heim-scripts-admin', 'heim_data_admin', array(
		'color_mode' => $color_mode,
	) );
}
add_action( 'admin_enqueue_scripts', 'heim_admin_scripts' );
