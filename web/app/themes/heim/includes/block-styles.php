<?php
/**
 * Block Styles
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles
	 */
	function heim_register_block_styles() {
		/* Core: Columns */
		register_block_style(
			'core/columns',
			array(
				'name'  => 'heim-standard-margins',
				'label' => esc_html__( 'Smaller Margins', 'heim' ),
			)
		);
		register_block_style(
			'core/columns',
			array(
				'name'  => 'heim-columns-gap-small',
				'label' => esc_html__( 'Smaller Columns Gap', 'heim' ),
			)
		);
		
		/* Core: Group */
		register_block_style(
			'core/group',
			array(
				'name'  => 'heim-cover-padding',
				'label' => esc_html__( 'Cover Feature Padding', 'heim' ),
			)
		);
		
		/* Core: Paragraph */
		register_block_style(
			'core/paragraph',
			array(
				'name'  => 'heim-no-margin',
				'label' => esc_html__( 'No Margin', 'heim' ),
			)
		);
		
		/* Core: Cover */
		register_block_style(
			'core/cover',
			array(
				'name'  => 'heim-preset-feature',
				'label' => esc_html__( 'Feature Preset', 'heim' ),
			)
		);
		
		/* Core: Media text */
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'heim-split',
				'label' => esc_html__( 'Split align', 'heim' ),
			)
		);
		
		/* Core: Spacer */
		register_block_style(
			'core/spacer',
			array(
				'name'  => 'heim-max-height-mobile',
				'label' => esc_html__( 'Mobile: Max height', 'heim' ),
			)
		);
		register_block_style(
			'core/spacer',
			array(
				'name'  => 'heim-hide-on-mobile',
				'label' => esc_html__( 'Mobile: Hide', 'heim' ),
			)
		);
		
		/* Core: Quote */
		register_block_style(
			'core/quote',
			array(
				'name'  => 'heim-slim-border',
				'label' => esc_html__( 'Slim Border', 'heim' ),
			)
		);
		
		/* WooCommerce: Featured Category */
		register_block_style(
			'woocommerce/featured-category',
			array(
				'name'  => 'heim-simplified',
				'label' => esc_html__( 'Simplified', 'heim' ),
			)
		);
	}
	add_action( 'init', 'heim_register_block_styles' );
}
