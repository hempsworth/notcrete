<?php
/**
 * Customizer divider control
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Class: Customizer divider control
	 */
	class Heim_Customize_Divider_Control extends WP_Customize_Control {
		
		public $type = 'heim_divider';
		
		public function render_content() {
			echo '<hr>';
		}
		
	}
}
