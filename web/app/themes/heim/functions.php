<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

// Constant: Theme version
$theme = wp_get_theme();
$theme_parent = $theme->parent();
$theme_version = ( $theme_parent ) ? $theme_parent->get( 'Version' ) : $theme->get( 'Version' );
define( 'HEIM_THEME_VERSION', $theme_version );

// Constant: Includes folder directory
define( 'HEIM_THEME_INC_DIR', get_template_directory() . '/includes' );

// Admin include: Theme setup
if ( is_admin() ) {
	require_once HEIM_THEME_INC_DIR . '/setup/setup-data.php';
	require_once HEIM_THEME_INC_DIR . '/setup/class-heim-setup.php';
}

// Include: Theme setup functions
require HEIM_THEME_INC_DIR . '/functions/function-theme-setup.php';

// Include: Customizer controls and settings 
require HEIM_THEME_INC_DIR . '/classes/class-heim-customize-heading-control.php';
require HEIM_THEME_INC_DIR . '/classes/class-heim-customize-divider-control.php';
require HEIM_THEME_INC_DIR . '/classes/class-heim-customize.php';

// Include: Customizer settings
require HEIM_THEME_INC_DIR . '/classes/class-heim-google-fonts.php';

// Include: Enqueue functions
require HEIM_THEME_INC_DIR . '/functions/function-enqueue.php';

// Include: WooCommerce functions
if ( heim_woocommerce_active() ) {
	require HEIM_THEME_INC_DIR . '/functions/function-woocommerce.php';
}

// Include: Template tags
require HEIM_THEME_INC_DIR . '/template-tags.php';

// Admin include: Block patterns
if ( is_admin() ) {
	include HEIM_THEME_INC_DIR . '/block-patterns.php';
}

// Include: Block styles
require HEIM_THEME_INC_DIR . '/block-styles.php';

// Include: Wishlist
/*if ( heim_woocommerce_active() && ! class_exists( 'NM_WooCommerce_Wishlist' ) ) {
	include HEIM_THEME_INC_DIR . '/wishlist/wishlist.php';
}*/
