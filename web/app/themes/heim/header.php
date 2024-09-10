<?php
/**
 * The header
 *
 * This is the template that displays all of the <head> section and everything up until main
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

// Note: The color-mode is set with the inline JavaScript directly below the opening <body> tag as well (for compatibility with cached pages)
$color_mode = heim_color_mode_get_state();

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-color-mode="<?php echo esc_attr( $color_mode ); ?>">
	<?php if ( ! is_customize_preview() && Heim_Customize::get_setting( 'header_color_mode' ) ) : ?>
	<script id="heim-color-mode-js">const colorMode=document.cookie.split('; ').find((row)=>row.startsWith('heim_theme_color_mode='))?.split('=')[1];if(colorMode){document.body.setAttribute('data-color-mode',colorMode);}</script>
	<?php endif; ?>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'heim' ); ?></a>
		
		<?php
			// Header template, or Elementor header location
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
			get_template_part( 'template-parts/header/content-header' );
		}
		?>

		<div id="content" class="site-content">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">
				
				<div id="overlay"></div>
