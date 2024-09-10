<?php
	
/**
 * Styles
 */
function heim_child_theme_styles() {
    // Enqueue child theme styles
    wp_enqueue_style( 'heim-style-child', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'heim_child_theme_styles', 1000 ); // Note: Use priority "1000" to include the stylesheet after the parent theme stylesheets
