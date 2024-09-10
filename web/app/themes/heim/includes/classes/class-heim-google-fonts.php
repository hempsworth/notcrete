<?php
/**
 * Google Fonts
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Heim_Google_Fonts' ) ) {
	/**
	 * Class: Generate Google Fonts data
	 */
	class Heim_Google_Fonts {
		
		/**
		 * Get a list of standard web fonts
		 */
		private static function get_standard_fonts() {
			return apply_filters( 'heim_standard_web_fonts', array(
				// Sans-serif
				'Arial',
				'Tahoma',
				'Trebuchet MS',
				'Verdana',
				// Serif
				'Georgia',
				'Garamond',
				'Palatino',
				'Baskerville',
				'Times New Roman',
				// Monospaced
				'Courier New',
				'Lucida Sans Typewriter',
			) );
		}
		
		/**
		 * Get font URLs
		 */
		public static function get_font_urls() {
			$fonts              = array();
			$fonts['main']      = Heim_Customize::get_setting( 'font_family_body' );
			$fonts['headings']  = Heim_Customize::get_setting( 'font_family_headings' );
			
			$standard_fonts = self::get_standard_fonts();
			$font_urls = array();
			$font_family_names = array();
			
			$font_weights = apply_filters( 'heim_google_font_weights', '400,500,700,900' );
			$font_weights = ( $font_weights ) ? ':' . esc_attr( $font_weights ) : '';
			
			$font_url_swap_query = apply_filters( 'heim_google_font_display_query', 'swap' );
			$font_url_swap_query = ( $font_url_swap_query ) ? '&display=' . esc_attr( $font_url_swap_query ) : '';
			
			foreach ( $fonts as $font_section => $font ) {
				if (
					! $font || // Avoid empty name
					in_array( $font, $font_family_names ) || // Avoid duplicates
					in_array( $font, $standard_fonts, true ) // Avoid standard font
				) {
					continue;
				}
				
				$font_family_name = apply_filters( 'heim_google_font_name', rawurlencode( $font ) );
				$font_urls[$font_section] = '//fonts.googleapis.com/css?family=' . $font_family_name . $font_weights . $font_url_swap_query;
				
				$font_family_names[$font] = $font; // Used for checking duplicates
			}
			
			return $font_urls;
		}
		
		
		/**
		 * Enqueue fonts
		 */
		public static function enqueue_fonts() {
			$google_font_urls = self::get_font_urls();
			
			if ( ! empty( $google_font_urls ) ) {
				foreach ( $google_font_urls as $font_section => $font_url ) {
					wp_enqueue_style( 'heim-' . $font_section . '-google-font', $font_url, false, HEIM_THEME_VERSION, 'all' );
				}
			}
		}
		
	}
}
