<?php
/**
 * Customizer heading control
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
	 * Class: Customizer heading control
	 */
	class Heim_Customize_Heading_Control extends WP_Customize_Control {
		
		public $type = 'heim_heading';
		
		public function render_content() {
			?>
			<label class="customize-control-title" style="margin-bottom:0px;"><?php echo esc_html( $this->label ); ?></label>
			<?php if ( $this->description && strlen( $this->description ) > 0 ) : ?>
			<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span
			<?php
			endif;
		}
		
	}
}
