<?php
/**
 * Customizer settings
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Heim_Customize' ) ) {
	/**
	 * Class: Customizer settings
	 */
	class Heim_Customize {
		
		/**
		 * Cache
		 */
		protected static $cache_default_settings = array();
		protected static $cache_settings = array();
		
		
		/**
		 * Default color scheme
		 */
		protected static $colors = array(
			'light' => array(
				'font'             => '#282828',
				'body'             => '#ffffff',
				'body_contrast'    => '#f3f3f3',
				'body_contrast_2'  => '#f1f1f1',
				'body_contrast_3'  => '#eeeeee',
				'body_contrast_4'  => '#e8e8e8',
				'body_contrast_5'  => '#e3e3e3',
				'body_contrast_6'  => '#dddddd',
				'body_contrast_7'  => '#d2d2d2',
				'body_contrast_8'  => '#cbcbcb',
				'body_contrast_9'  => '#c1c1c1',
				'highlight'        => '#e00b25',
			),
			'dark'  => array(
				'font'             => '#f8f8f8',
				'body'             => '#22262c',
				'body_contrast'    => '#2d3138',
				'body_contrast_2'  => '#343842',
				'body_contrast_3'  => '#40434e',
				'body_contrast_4'  => '#4a4e58',
				'body_contrast_5'  => '#555862',
				'body_contrast_6'  => '#5e6471',
				'body_contrast_7'  => '#6a707b',
				'body_contrast_8'  => '#7f848e',
				'body_contrast_9'  => '#93989f',
				'highlight'        => '#19d5e0',
			),
		);
		
		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'register' ) );
			add_action( 'customize_controls_print_scripts', array( $this, 'add_scripts' ), 30 );
		}
		
		/**
		 * Add scripts
		 */
		public function add_scripts() {
			?>
			<script type="text/javascript">
				jQuery(function($) {
					wp.customize.section('shop', function(section) { // Redirect to shop page when expanding "shop" section
						section.expanded.bind(function(isExpanded) {
							if (isExpanded) {
								wp.customize.previewer.previewUrl.set('<?php echo esc_js( wc_get_page_permalink( 'shop' ) ); ?>');
							}
						});
					});
				});
			</script>
			<?php
		}
		
		/**
		 * Register customizer options
		 */
		public function register( $wp_customize ) {
			// Site title & description: Change to postMessage
			$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

			// Site title & description: Add partial
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title',
					'render_callback' => array( $this, 'partial_blogname' ),
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'partial_blogdescription' ),
				)
			);
			
			self::add_settings( $wp_customize );
		}
		
		/**
		 * Get settings config
		 */
		public static function get_settings_config() {
			$settings = array(
				'fonts' => array(
					'is_panel'  => true,
					'title'     => esc_html_x( 'Fonts', 'Theme customizer', 'heim' ),
					'priority'  => 21,
					'settings'  => array(), // Needed for default settings loop
				),
				'font_families' => array(
					'parent_panel' => 'fonts',
					'title'        => esc_html_x( 'Font Types', 'Theme customizer', 'heim' ),
					'priority'     => 21,
					'settings'     => array(
						'font_family_body' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'wp_filter_nohtml_kses',
							'default'           => 'Inter',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'text',
								'label'         => esc_html_x( 'Main', 'Theme customizer', 'heim' ),
								'description'   => wp_kses_post( 'Use any <a href="https://fonts.google.com/" target="_blank">Google Font</a> or <a href="https://www.w3schools.com/cssref/css_websafe_fonts.asp" target="_blank">Standard web font</a> by entering its name below.' ),
								'section'       => 'font_families',
								'priority'      => 1,
								'input_attrs'   => array(
									'placeholder'    => esc_html_x( 'Enter font name e.g: Inter', 'Theme customizer', 'heim' ),
									'autocorrect'    => 'off',
									'spellcheck'     => 'false',
								),
							)
						),
						'font_family_headings' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'wp_filter_nohtml_kses',
							'default'           => 'Inter',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'text',
								'label'         => esc_html_x( 'Headings', 'Theme customizer', 'heim' ),
								'description'   => wp_kses_post( 'Use any <a href="https://fonts.google.com/" target="_blank">Google Font</a> or <a href="https://www.w3schools.com/cssref/css_websafe_fonts.asp" target="_blank">Standard web font</a> by entering its name below.' ),
								'section'       => 'font_families',
								'priority'      => 2,
								'input_attrs'   => array(
									'placeholder'    => esc_html_x( 'Enter font name e.g: Inter', 'Theme customizer', 'heim' ),
									'autocorrect'    => 'off',
									'spellcheck'     => 'false',
								),
							)
						),
					)
				),
				'font_sizes' => array(
					'parent_panel' => 'fonts',
					'title'        => esc_html_x( 'Font Sizes', 'Theme customizer', 'heim' ),
					'priority'     => 21,
					'settings'     => array(
						'font_size_base' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 16,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Base body text', 'Theme customizer', 'heim' ),
								/* translators: %s: line breaks */
								'description'   => sprintf( esc_html_x( 'Used for Body text, all elements (Headings, Paragraphs, Buttons etc.) are adjusted to their relative sizes based on this single size.%sA size between 14 and 18 is recommended.', 'Theme customizer', 'heim' ), '<br><br>' ),
								'section'       => 'font_sizes',
								'priority'      => 10,
								'input_attrs' => array(
									'min'   => 10,
									'max'   => 26,
									'step'  => 1,
								),
							)
						),
						'font_size_header' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 16,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Header menu', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'A size between 14 and 18 is recommended.', 'Theme customizer', 'heim' ),
								'section'       => 'font_sizes',
								'priority'      => 10,
								'input_attrs' => array(
									'min'   => 10,
									'max'   => 26,
									'step'  => 1,
								),
							)
						),
						'font_size_menus' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 15,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Header submenus', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'A size between 14 and 18 is recommended.', 'Theme customizer', 'heim' ),
								'section'       => 'font_sizes',
								'priority'      => 10,
								'input_attrs' => array(
									'min'   => 10,
									'max'   => 26,
									'step'  => 1,
								),
							)
						),
					)
				),
				'colors' => array(
					'is_panel'  => true,
					'title'     => esc_html_x( 'Colors', 'Theme customizer', 'heim' ),
					'priority'  => 22,
					'settings'  => array(), // Needed for default settings loop
				),
				'colors_settings' => array(
					'parent_panel' => 'colors',
					'title'        => esc_html_x( 'Settings', 'Theme customizer', 'heim' ),
					'priority'     => 22,
					'settings'     => array(
						'color_mode' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_select',
							'default'           => 'light',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'select',
								'label'         => esc_html_x( 'Color mode', 'Theme customizer', 'heim' ),
								'section'       => 'colors_settings',
								'priority'      => 9,
								'choices'       => array(
									'light' => esc_html_x( 'Light', 'Theme customizer', 'heim' ),
									'dark'  => esc_html_x( 'Dark', 'Theme customizer', 'heim' ),
									'auto'  => esc_html_x( 'Auto (use browser theme)', 'Theme customizer', 'heim' ),
								),
							)
						),
					),
				),
				'colors_light_mode' => array(
					'parent_panel' => 'colors',
					'title'        => esc_html_x( 'Light Mode', 'Theme customizer', 'heim' ),
					'priority'     => 22,
					'settings'     => array(
						// General colors - Light mode
						/*'general_colors_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_light_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),*/
						/*'general__colors_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'General', 'Theme customizer', 'heim' ),
								'section'   => 'colors_light_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),*/
						'color_body' => array( // Note: Don't use "background_color", used by standard WP setting?
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body/Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						/*'color_text_contrast' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text contrast', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),*/
						'color_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Headings', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_border' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_5'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Borders', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_highlight' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['highlight'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Highlights', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						// Header colors - Light mode
						'header_colors_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_light_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_colors_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Header', 'Theme customizer', 'heim' ),
								'section'   => 'colors_light_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_color_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'header_color_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						/*'header_color_border' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_5'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Border', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),*/
						'menus_color_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Submenu text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'menus_color_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Submenu background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						// Footer colors - Light mode
						'footer_colors_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_light_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_colors_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Footer', 'Theme customizer', 'heim' ),
								'section'   => 'colors_light_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_color_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'footer_color_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'footer_color_border' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_5'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Borders', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						// Forms colors - Light mode
						'forms_colors_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_light_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'forms_colors_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Forms & Buttons', 'Theme customizer', 'heim' ),
								'section'   => 'colors_light_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'fields_color_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Fields background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'fields_color_focus_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_3'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Fields focus background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_background' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_border' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_9'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons border', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						// Color palette - Light mode
						'color_palette_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_light_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'color_palette_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Color Palette', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Most of these colors are unused by default, but can be selected for Blocks in the Block Editor.', 'Theme customizer', 'heim' ),
								'section'   => 'colors_light_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'color_body_contrast' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Used by: Store/Info Notices', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_2' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_2'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 2', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_3' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_3'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 3', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_4' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 4', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_5' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_5'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 5', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_6' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_6'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 6', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_7' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_7'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 7', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_8' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_8'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 8', 'Theme customizer', 'heim' ),
								//'description'   => esc_html_x( 'Used by: Comment/Review Avatar Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_9' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_9'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 9', 'Theme customizer', 'heim' ),
								'section'       => 'colors_light_mode',
								'priority'      => 9,
							)
						),
					),
				),
				'colors_dark_mode' => array(
					'parent_panel' => 'colors',
					'title'        => esc_html_x( 'Dark Mode', 'Theme customizer', 'heim' ),
					'priority'     => 22,
					'settings'     => array(
						// General colors - Dark mode
						'color_body_dark' => array( // Note: Don't use "background_color", used by standard WP setting?
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body/Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_text_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						/*'color_text_contrast_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text contrast', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),*/
						'color_heading_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Headings', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_border_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Borders', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_highlight_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['highlight'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Labels/highlights', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						// Header colors - Dark mode
						'header_colors_dark_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_dark_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_colors_dark_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Header', 'Theme customizer', 'heim' ),
								'section'   => 'colors_dark_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_color_text_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'header_color_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						/*'header_color_border_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Border', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),*/
						'menus_color_text_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Submenu text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'menus_color_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Submenu background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						// Footer colors - Dark mode
						'footer_colors_dark_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_dark_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_colors_dark_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Footer', 'Theme customizer', 'heim' ),
								'section'   => 'colors_dark_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_color_text_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'footer_color_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'footer_color_border_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Borders', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						// Forms colors - Dark mode
						'forms_colors_dark_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_dark_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'forms_colors_dark_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Forms & Buttons', 'Theme customizer', 'heim' ),
								'section'   => 'colors_dark_mode',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'fields_color_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_2'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Fields background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'fields_color_focus_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Fields focus background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_text_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons text', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_background_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'buttons_color_border_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_6'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Buttons border', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						// Color palette - Dark mode
						'color_palette_dark_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'colors_dark_mode',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'color_palette_dark_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'        => 'heim_heading',
								'label'       => esc_html_x( 'Color Palette', 'Theme customizer', 'heim' ),
								'description' => esc_html_x( 'Most of these colors are unused by default, but can be selected for Blocks in the Block Editor.', 'Theme customizer', 'heim' ),
								'section'     => 'colors_dark_mode',
								'priority'    => 9,
							),
							'heim_is_placeholder' => true,
						),
						'color_body_contrast_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Used by: Store/Info Notices', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_2_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_2'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 2', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Used by: Secondary Buttons', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_3_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_3'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 3', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_4_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_4'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 4', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Used by: Secondary Buttons Contrast/Hover', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_5_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_5'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 5', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_6_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_6'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 6', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_7_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_7'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 7', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_8_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_8'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 8', 'Theme customizer', 'heim' ),
								//'description'   => esc_html_x( 'Used by: Comment/Review Avatar Background', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
						'color_body_contrast_9_dark' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['dark']['body_contrast_9'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Body contrast 9', 'Theme customizer', 'heim' ),
								'section'       => 'colors_dark_mode',
								'priority'      => 9,
							)
						),
					),
				),
				'header' => array(
					'title'     => esc_html_x( 'Header', 'Theme customizer', 'heim' ),
					'priority'  => 23,
					'settings'  => array(
						'logo_dark_mode' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_image',
							'default'           => '',
							'control_class'     => 'WP_Customize_Image_Control',
							'control'           => array(
								'type'          => 'image',
								'label'         => esc_html_x( 'Logo - Dark mode', 'Theme customizer', 'heim' ),
								'section'       => 'title_tagline',
								'priority'      => 9,
							)
						),
						'logo_height' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 30,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Logo - Height', 'Theme customizer', 'heim' ),
								'section'       => 'title_tagline',
								'priority'      => 9,
								'input_attrs'   => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'logo_mobile' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_image',
							'default'           => '',
							'control_class'     => 'WP_Customize_Image_Control',
							'control'           => array(
								'type'          => 'image',
								'label'         => esc_html_x( 'Mobile Logo', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Display an alternative logo on mobile/tablet sized screens.', 'Theme customizer', 'heim' ),
								'section'       => 'title_tagline',
								'priority'      => 9,
							)
						),
						'logo_mobile_dark_mode' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_image',
							'default'           => '',
							'control_class'     => 'WP_Customize_Image_Control',
							'control'           => array(
								'type'          => 'image',
								'label'         => esc_html_x( 'Mobile Logo - Dark mode', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Display an alternative logo on mobile/tablet sized screens.', 'Theme customizer', 'heim' ),
								'section'       => 'title_tagline',
								'priority'      => 9,
							)
						),
						'logo_mobile_height' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 26,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Mobile Logo - Height', 'Theme customizer', 'heim' ),
								'section'       => 'title_tagline',
								'priority'      => 9,
								'input_attrs'   => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'header_sticky_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Scroll behaviour', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_sticky' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Sticky - Make header "stick" to page top when scrolling up', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_height_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'header',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_height' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 94,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Height', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( '(value is in pixels/px)', 'Theme customizer', 'heim' ),
								'section'       => 'header',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'header_height_mobile' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 76,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Mobile and Sticky height', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Used for Mobile and Sticky header (value is in pixels/px)', 'Theme customizer', 'heim' ),
								'section'       => 'header',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'header_tools_menu_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'header',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_tools_menu_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Tools menu buttons', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_color_mode' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Color mode', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_search' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Search', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_myaccount' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'woocommerce',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'My account', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_wishlist' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'NM_WooCommerce_Wishlist',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Wishlist', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_cart' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'woocommerce',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Cart', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
						'header_search_suggestions_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'header',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_search_suggestions' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'wp_filter_nohtml_kses',
							'default'           => 'artwork, pillow, scented',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'text',
								'label'         => esc_html_x( 'Search suggestions', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'Enter comma separated list of search suggestions', 'Theme customizer', 'heim' ),
								'section'       => 'header',
								'priority'      => 9,
								'input_attrs'   => array(
									'placeholder'    => esc_html_x( 'e.g: artwork, pillow, scented', 'Theme customizer', 'heim' ),
									'autocorrect'    => 'off',
									'spellcheck'     => 'false',
								),
							)
						),
						'header_mini_cart_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'header',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'header_mini_cart_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Mini cart', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'mini_cart_show_added' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'woocommerce',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Show after adding to cart', 'Theme customizer', 'heim' ),
								'section'   => 'header',
								'priority'  => 9,
							),
						),
					),
				),
				'mobile_menu' => array(
					'title'     => esc_html_x( 'Mobile Menu', 'Theme customizer', 'heim' ),
					'priority'  => 24,
					'settings'  => array(
						'mobile_menu_enable_on_desktop' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Enable on desktop', 'Theme customizer', 'heim' ),
								'section'   => 'mobile_menu',
								'priority'  => 10,
							)
						),
						'mobile_menu_product_categories' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'woocommerce',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Display categories menu', 'Theme customizer', 'heim' ),
								'section'   => 'mobile_menu',
								'priority'  => 10,
							)
						),
						'mobile_menu_color_mode' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'class_required'    => 'woocommerce',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Display color mode', 'Theme customizer', 'heim' ),
								'section'   => 'mobile_menu',
								'priority'  => 10,
							)
						),
					),
				),
				'footer' => array(
					'title'     => esc_html_x( 'Footer', 'Theme customizer', 'heim' ),
					'priority'  => 25,
					'settings'  => array(
						'footer_text' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_html',
							'default'           => sprintf( '© %s Heim. All rights reserved.', gmdate( 'Y' ) ),
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'textarea',
								'label'         => esc_html_x( 'Footer text', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'HTML tags allowed: a, br, div, em, i, img, span, strong', 'Theme customizer', 'heim' ),
								'section'       => 'footer',
								'priority'      => 9,
							)
						),
						'footer_spacing_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'footer',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_spacing' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 50,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Vertical spacing', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( '(value is in pixels/px)', 'Theme customizer', 'heim' ),
								'section'       => 'footer',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'footer_spacing_mobile' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 40,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Mobile vertical spacing', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( '(value is in pixels/px)', 'Theme customizer', 'heim' ),
								'section'       => 'footer',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 0,
									'max'   => 1000,
									'step'  => 1,
								),
							)
						),
						'footer_widget_columns_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'footer',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'footer_widget_columns' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 5,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'Widget columns', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( '(1 to 5)', 'Theme customizer', 'heim' ),
								'section'       => 'footer',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 1,
									'max'   => 5,
									'step'  => 1,
								),
							)
						),
						'footer_first_widget_columns' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'absint',
							'default'           => 3,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'number',
								'label'         => esc_html_x( 'First widget columns', 'Theme customizer', 'heim' ),
								'description'   => esc_html_x( 'First widget can span across multiple columns (1 to 4)', 'Theme customizer', 'heim' ),
								'section'       => 'footer',
								'priority'      => 9,
								'input_attrs' => array(
									'min'   => 1,
									'max'   => 4,
									'step'  => 1,
								),
							)
						),
					),
				),
				'blog' => array(
					'title'     => esc_html_x( 'Blog', 'Theme customizer', 'heim' ),
					'priority'  => 27,
					'settings'  => array(
						'blog_title_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Blog heading', 'Theme customizer', 'heim' ),
								'section'   => 'blog',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'blog_title_hide_on_category_pages' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Hide on Category pages', 'Theme customizer', 'heim' ),
								'section'   => 'blog',
								'priority'  => 9,
							),
						),
						'blog_category_menu_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Category menu', 'Theme customizer', 'heim' ),
								'section'   => 'blog',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'blog_category_menu' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Enable', 'Theme customizer', 'heim' ),
								'section'   => 'blog',
								'priority'  => 9,
							),
						),
					),
				),
			);
			
			if ( heim_woocommerce_active() ) {
				$settings['shop'] = array(
					'title'     => esc_html_x( 'Shop', 'Theme customizer', 'heim' ),
					'priority'  => 26,
					'settings'  => array(
						/*'store_notice_text_color' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['font'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Store notice - Text color', 'Theme customizer', 'heim' ),
								'section'       => 'woocommerce_store_notice',
								'priority'      => 10,
							)
						),
						'store_notice_background_color' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'sanitize_hex_color',
							'default'           => self::$colors['light']['body_contrast_2'],
							'control_class'     => 'WP_Customize_Color_Control',
							'control'           => array(
								'type'          => 'color',
								'label'         => esc_html_x( 'Store notice - Background color', 'Theme customizer', 'heim' ),
								'section'       => 'woocommerce_store_notice',
								'priority'      => 10,
							)
						),*/
						'shop_filters' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_select',
							'default'           => 'aside',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'select',
								'label'         => esc_html_x( 'Filters', 'Theme customizer', 'heim' ),
								'section'       => 'shop',
								'priority'      => 9,
								'choices'       => array(
									'sidebar' => esc_html_x( 'Sidebar', 'Theme customizer', 'heim' ),
									'aside'   => esc_html_x( 'Slide-in panel', 'Theme customizer', 'heim' ),
									'none'    => esc_html_x( 'None', 'Theme customizer', 'heim' ),
								),
							)
						),
						'shop_filters_toggle_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'Filters toggle', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'shop_filters_toggle' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Enable', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
						),
						'shop_filters_buttons_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'        => 'heim_heading',
								'label'       => esc_html_x( 'Slide-in panel buttons', 'Theme customizer', 'heim' ),
								'description' => esc_html_x( 'Add button(s) for opening the filters slide-in panel.', 'Theme customizer', 'heim' ),
								'section'     => 'shop',
								'priority'    => 9,
							),
							'heim_is_placeholder' => true,
						),
						'shop_aside_panel_button' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => false,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'All filters', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
						),
						'shop_aside_panel_widget_buttons' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Individual filters (color, size etc.)', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
						),
						'shop_hover_thumbnail_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( '"Hover" thumbnail', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'shop_hover_thumbnail' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Enable', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
						),
						'shop_ajax_pagination' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_select',
							'default'           => 'standard',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'select',
								'label'         => esc_html_x( 'Pagination', 'Theme customizer', 'heim' ),
								'section'       => 'shop',
								'priority'      => 9,
								'choices'       => array(
									'standard'    => esc_html_x( 'Standard', 'Theme customizer', 'heim' ),
									'ajax-button' => esc_html_x( '"Show more" button', 'Theme customizer', 'heim' ),
								),
							)
						),
						'product_sale_flash_divider' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Divider_Control',
							'control'           => array(
								'type'     => 'heim_divider',
								'section'  => 'shop',
								'priority' => 9,
							),
							'heim_is_placeholder' => true,
						),
						'product_sale_flash' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_select',
							'default'           => 'percent',
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'          => 'select',
								'label'         => esc_html_x( 'Sale label', 'Theme customizer', 'heim' ),
								'section'       => 'shop',
								'priority'      => 9,
								'choices'       => array(
									'percent' => esc_html_x( 'Display percentage', 'Theme customizer', 'heim' ),
									'text'    => esc_html_x( 'Display text', 'Theme customizer', 'heim' ),
									'disable' => esc_html_x( 'Hide', 'Theme customizer', 'heim' ),
								),
							)
						),
						'product_new_flash_heading' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => '',
							'default'           => '',
							'control_class'     => 'Heim_Customize_Heading_Control',
							'control'           => array(
								'type'      => 'heim_heading',
								'label'     => esc_html_x( 'New label', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
							'heim_is_placeholder' => true,
						),
						'product_new_flash' => array(
							'type'              => 'theme_mod',
							'capability'        => 'edit_theme_options',
							'sanitize_callback' => 'Heim_Customize::sanitize_checkbox',
							'default'           => true,
							'control_class'     => 'WP_Customize_Control',
							'control'           => array(
								'type'      => 'checkbox',
								'label'     => esc_html_x( 'Display', 'Theme customizer', 'heim' ),
								'section'   => 'shop',
								'priority'  => 9,
							),
						),
					)
				);
			}
			
			return $settings;
		}
		
		/**
		 * Add panels, sections and settings
		 */
		public function add_settings( $wp_customize ) {
			$settings_config = self::get_settings_config();
			
			foreach ( $settings_config as $config_id => $config ) {
				if ( isset( $config['is_panel'] ) ) {
					// Add panel
					$wp_customize->add_panel(
						$config_id,
						array(
							'title'     => $config['title'],
							'priority'  => $config['priority'],
						)
					);
					
					// STOP here, only adding panel
					continue;
				}
				
				$parent_panel_id = ( isset( $config['parent_panel'] ) ) ? $config['parent_panel'] : ''; 
				
				// Add section
				$wp_customize->add_section(
					$config_id,
					array(
						'title'     => $config['title'],
						'priority'  => $config['priority'],
						'panel'     => $parent_panel_id,
					)
				);
				
				foreach ( $config['settings'] as $setting_id => $setting ) {
					// Check for required class (useful if a plugin is required)
					if ( isset( $setting['class_required'] ) && ! class_exists( $setting['class_required'] ) ) {
						continue;
					}
					
					// Add setting
					$wp_customize->add_setting(
						$setting_id,
						array(
							'type'              => $setting['type'],
							'capability'        => $setting['capability'],
							'sanitize_callback' => $setting['sanitize_callback'],
							'default'           => $setting['default'],
						)
					);
					
					// Add control
					$control_class = $setting['control_class'];
					$wp_customize->add_control(
						new $control_class(
							$wp_customize,
							$setting_id,
							$setting['control']
						)
					);
				}
			}
		}
		
		/**
		 * Sanitize: Textbox HTML
		 */
		public static function sanitize_html( $raw_text ) {
			$allows_tags = wp_kses_allowed_html();
			
			$allowed_tags = array(
				'a' => array(
					'class'     => array(),
					'data'      => array(),
					'href'      => array(),
					'rel'       => array(),
					'target'    => array(),
					'title'     => array()
				),
				'br' => array(),
				'div' => array(
					'class' => array(),
					'style' => array(),
				),
				'em' => array(),
				'i' => array(
					'class' => array(),
					'style' => array(),    
				),
				'img' => array(
					'alt'       => array(),
					'class'     => array(),
					'src'       => array(),
					'title'     => array(),
					'width'     => array(),
					'height'    => array(),
				),
				'span' => array(
					'class' => array(),
					'style' => array(),
				),
				'strong' => array(),
			);
			
			return wp_kses( $raw_text, $allowed_tags );
		}
		
		/**
		 * Sanitize: Select
		 */
		public static function sanitize_select( $input, $setting ) {
			$input   = sanitize_key( $input );
			$choices = isset( $setting->manager->get_control( $setting->id )->choices ) ? $setting->manager->get_control( $setting->id )->choices : '';

			return ( $choices && array_key_exists( $input, $choices ) ) ? $input : $setting->default;
		}
		
		/**
		 * Sanitize: Checkbox boolean
		 */
		public static function sanitize_checkbox( $checked = null ) {
			return (bool) isset( $checked ) && true === $checked;
		}
		
		/**
		 * Sanitize: Image upload
		 */
		public static function sanitize_image( $input, $default = '' ) {
			$mimes = array(
				'jpg|jpeg|jpe' => 'image/jpeg',
				'gif'          => 'image/gif',
				'png'          => 'image/png',
				'bmp'          => 'image/bmp',
				'tif|tiff'     => 'image/tiff',
				'svg'          => 'image/svg+xml',
				'ico'          => 'image/x-icon',
			);
			
			$file = wp_check_filetype( $input, $mimes );
			
			if ( isset( $file['ext'] ) ) {
				return is_int( $input ) ? $input : attachment_url_to_postid( $input );
			}
			return $default;
		}
		
		/**
		 * Render: Site title for selective refresh partial
		 */
		public function partial_blogname() {
			bloginfo( 'name' );
		}

		/**
		 * Render: Site tagline for the selective refresh partial
		 */
		public function partial_blogdescription() {
			bloginfo( 'description' );
		}
		
		
		/**
		 * Setting: Get default
		 */
		public static function get_default_setting( $requested_setting_id ) {
			// Build cache on first request
			if ( empty( self::$cache_default_settings ) ) {
				$settings_config = self::get_settings_config();
				
				foreach ( $settings_config as $config ) {
					foreach ( $config['settings'] as $setting_id => $setting ) {
						if ( ! isset( $setting['heim_is_placeholder'] ) ) { // Exclude placeholders (headings, dividers)
							self::$cache_default_settings[$setting_id] = $setting['default'];
						}
					}
				}
			}
			
			$default_setting = isset( self::$cache_default_settings[$requested_setting_id] ) ? self::$cache_default_settings[$requested_setting_id] : '';
			
			return $default_setting;
		}
		
		
		/**
		 * Setting: Get
		 */
		public static function get_setting( $setting_id ) {
			// Get from cache when available
			if ( array_key_exists( $setting_id, self::$cache_settings ) ) {
				return self::$cache_settings[$setting_id];
			}
			
			$default_setting = self::get_default_setting( $setting_id );
			
			$setting = get_theme_mod( $setting_id, $default_setting );
			
			// Cache setting
			self::$cache_settings[$setting_id] = $setting;
			
			return $setting;
		}
		
		
		/**
		 * Color: Convert hex color to rgb values
		 */
		public static function hex_to_rgb( $color ) {
			$color_hex = ltrim( $color, '#' );
			$split = str_split( $color_hex, 2 );
			
			$r = hexdec($split[0]);
			$g = hexdec($split[1]);
			$b = hexdec($split[2]);
			
			return $r . ',' . $g . ',' . $b;
		}
		
		
		/**
		 * Get styles for settings
		 */
		public static function get_styles() {
			// Content width
			if ( is_single() || ( is_admin() && get_post_type() == 'post' ) ) {
				$content_width = '775px';
				$content_width_wide = '975px';
				$content_width_force_wide_below = intval( apply_filters( 'heim_post_width_force_wide_below', 0 ) );
			} else {
				$content_width = '1180px';
				$content_width_wide = '1520px';
				$content_width_force_wide_below = intval( apply_filters( 'heim_page_width_force_wide_below', 1368 ) );
			}
			
			// WP admin bar offset/height
			//$wp_admin_bar_offset = ( is_admin_bar_showing() ) ? '32px' : '0px';
			
			// Font family fallback
			$font_family_body_fallback = apply_filters( 'heim_font_family_body_fallback', 'sans-serif' );
			$font_family_heading_fallback = apply_filters( 'heim_font_family_headings_fallback', 'sans-serif' );
			
			// Colors
			$color_text = self::get_setting( 'color_text' );
			$color_body_dark = self::get_setting( 'color_body_dark' );
			$color_rgb_transparent = self::hex_to_rgb( $color_text );
			$color_rgb_transparent_dark = self::hex_to_rgb( $color_body_dark );
			
			// Dark mode CSS variables
			$vars_dark_mode = '
                --global--color-body:' . self::get_setting( 'color_body_dark' ) . ';
                --global--color-body-opacity-25:rgba(' . $color_rgb_transparent_dark . ', 0.25);
                --global--color-body-opacity-50:rgba(' . $color_rgb_transparent_dark . ', 0.5);
                --global--color-body-contrast:' . self::get_setting( 'color_body_contrast_dark' ) . ';
                --global--color-body-contrast-2:' . self::get_setting( 'color_body_contrast_2_dark' ) . ';
                --global--color-body-contrast-3:' . self::get_setting( 'color_body_contrast_3_dark' ) . ';
                --global--color-body-contrast-4:' . self::get_setting( 'color_body_contrast_4_dark' ) . ';
                --global--color-body-contrast-5:' . self::get_setting( 'color_body_contrast_5_dark' ) . ';
                --global--color-body-contrast-6:' . self::get_setting( 'color_body_contrast_6_dark' ) . ';
                --global--color-body-contrast-7:' . self::get_setting( 'color_body_contrast_7_dark' ) . ';
                --global--color-body-contrast-8:' . self::get_setting( 'color_body_contrast_8_dark' ) . ';
                --global--color-body-contrast-9:' . self::get_setting( 'color_body_contrast_9_dark' ) . ';
                --global--color-font:' . self::get_setting( 'color_text_dark' ) . ';
                --global--color-font-contrast:' . self::get_setting( /*'color_text_contrast_dark'*/'color_body_dark' ) . ';
                --global--color-font-contrast-opacity-50:rgba(' . self::hex_to_rgb( self::get_setting( /*'color_text_contrast_dark'*/'color_body_dark' ) ) . ', 0.5);
                --global--color-border:' . self::get_setting( 'color_border_dark' ) . ';
                --global--color-highlight:' . self::get_setting( 'color_highlight_dark' ) . ';
                
                --aside--font-color:var(--global--color-font);
                --aside--border-color:var(--global--color-border);
                --aside--background-color:var(--global--color-body);
                --aside--overlay-color:rgba(0,0,0, 0.3);
                
                --heading--font-color:' . self::get_setting( 'color_heading_dark' ) . ';
                
                --header--font-color:' . self::get_setting( 'header_color_text_dark' ) . ';
                --header--background-color:' . self::get_setting( 'header_color_background_dark' ) . ';
                
                --menus--font-color:' . self::get_setting( 'menus_color_text_dark' ) . ';
                --menus--background-color:' . self::get_setting( 'menus_color_background_dark' ) . ';
                
                --footer--font-color:' . self::get_setting( 'footer_color_text_dark' ) . ';
                --footer--border-color:' . self::get_setting( 'footer_color_border_dark' ) . ';
                --footer--background-color:' . self::get_setting( 'footer_color_background_dark' ) . ';
                
                --inputs--background-color:' . self::get_setting( 'fields_color_background_dark' ) . ';
                --inputs--focus-color:' . self::get_setting( 'fields_color_focus_background_dark' ) . ';
                
                --buttons--font-color:' . self::get_setting( 'buttons_color_text_dark' ) . ';
                --buttons--border-color:' . self::get_setting( 'buttons_color_border_dark' ) . ';
                --buttons--background-color:' . self::get_setting( 'buttons_color_background_dark' ) . ';
                
                --label-buttons--border-color:var(--global--color-body-contrast-2);
                --label-buttons--border-contrast-color:var(--global--color-body-contrast-4);
                --label-buttons--background-color:var(--global--color-body-contrast-2);
                --label-buttons--background-contrast-color:var(--global--color-body-contrast-4);
                
                --spinner--border-width:2px;
                
                --product-fullscreen-gallery--arrows-color:var(--global--color-body);
            ';
			
			$styles = '
                :root {
					--global--font-family-body:' . self::get_setting( 'font_family_body' ) . ', ' . $font_family_body_fallback . ';
                    --global--font-size-body:' . self::get_setting( 'font_size_base' ) . 'px;
                    
                    --global--color-body:' . self::get_setting( 'color_body' ) . ';
                    --global--color-body-opacity-25:rgba(' . $color_rgb_transparent . ', 0.25);
                    --global--color-body-opacity-50:rgba(' . $color_rgb_transparent . ', 0.5);
                    --global--color-body-contrast:' . self::get_setting( 'color_body_contrast' ) . ';
                    --global--color-body-contrast-2:' . self::get_setting( 'color_body_contrast_2' ) . ';
                    --global--color-body-contrast-3:' . self::get_setting( 'color_body_contrast_3' ) . ';
                    --global--color-body-contrast-4:' . self::get_setting( 'color_body_contrast_4' ) . ';
                    --global--color-body-contrast-5:' . self::get_setting( 'color_body_contrast_5' ) . ';
                    --global--color-body-contrast-6:' . self::get_setting( 'color_body_contrast_6' ) . ';
                    --global--color-body-contrast-7:' . self::get_setting( 'color_body_contrast_7' ) . ';
                    --global--color-body-contrast-8:' . self::get_setting( 'color_body_contrast_8' ) . ';
                    --global--color-body-contrast-9:' . self::get_setting( 'color_body_contrast_9' ) . ';
                    --global--color-font:' . self::get_setting( 'color_text' ) . ';
                    --global--color-font-contrast:' . self::get_setting( /*'color_text_contrast'*/'color_body' ) . ';
                    --global--color-font-contrast-opacity-50:rgba(' . self::hex_to_rgb( self::get_setting( /*'color_text_contrast'*/'color_body' ) ) . ', 0.5);
                    --global--color-border:' . self::get_setting( 'color_border' ) . ';
                    --global--color-highlight:' . self::get_setting( 'color_highlight' ) . ';
                    
                    --content--max-width:' . $content_width . ';
                    --content--max-width-wide:' . $content_width_wide . ';
                    
                    --aside--font-color:var(--global--color-font);
                    --aside--border-color:var(--global--color-border);
                    --aside--background-color:var(--global--color-body);
                    --aside--overlay-color:rgba(' . $color_rgb_transparent . ', 0.3);
                    
                    --heading--font-family:' . self::get_setting( 'font_family_headings' ) . ', ' . $font_family_heading_fallback . ';
                    --heading--font-color:' . self::get_setting( 'color_heading' ) . ';
                    
                    --header--font-size:' . self::get_setting( 'font_size_header' ) . 'px;
                    --header--font-color:' . self::get_setting( 'header_color_text' ) . ';
                    --header--background-color:' . self::get_setting( 'header_color_background' ) . ';
                    --header--height:' . self::get_setting( 'header_height' ) . 'px;
                    --header--height-mobile:' . self::get_setting( 'header_height_mobile' ) . 'px;
                    
                    --logo--max-height:' . self::get_setting( 'logo_height' ) . 'px;
                    --logo-mobile--max-height:' . self::get_setting( 'logo_mobile_height' ) . 'px;
                    
                    --menus--font-size:' . self::get_setting( 'font_size_menus' ) . 'px;
                    --menus--font-color:' . self::get_setting( 'menus_color_text' ) . ';
                    --menus--background-color:' . self::get_setting( 'menus_color_background' ) . ';
                    
                    --footer--font-color:' . self::get_setting( 'footer_color_text' ) . ';
                    --footer--border-color:' . self::get_setting( 'footer_color_border' ) . ';
                    --footer--background-color:' . self::get_setting( 'footer_color_background' ) . ';
                    --footer--spacing:' . self::get_setting( 'footer_spacing' ) . 'px;
                    --footer--spacing-mobile:' . self::get_setting( 'footer_spacing_mobile' ) . 'px;
                    --footer--widget-columns:' . self::get_setting( 'footer_widget_columns' ) . ';
                    --footer--first-widget-columns:' . self::get_setting( 'footer_first_widget_columns' ) . ';
                    
                    --inputs--background-color:' . self::get_setting( 'fields_color_background' ) . ';
                    --inputs--focus-color:' . self::get_setting( 'fields_color_focus_background' ) . ';
                    
                    --buttons--font-color:' . self::get_setting( 'buttons_color_text' ) . ';
                    --buttons--border-color:' . self::get_setting( 'buttons_color_border' ) . ';
                    --buttons--background-color:' . self::get_setting( 'buttons_color_background' ) . ';
                    
                    --label-buttons--border-color:var(--buttons--border-color);
                    --label-buttons--border-contrast-color:var(--global--color-font);
                    --label-buttons--background-color:var(--global--color-body);
                    --label-buttons--background-contrast-color:var(--global--color-body);
                    
                    --spinner--border-width:1px;
                    
                    --products--ordering-label: "' . esc_html__( 'Sorting', 'woocommerce' ) . '";
                    
                    --product-fullscreen-gallery--arrows-color:var(--global--color-font);
				}
                
                @media (prefers-color-scheme: dark) {
                    :root [data-color-mode=auto] {
                        ' . $vars_dark_mode . '
                    }
                }
                
                :root [data-color-mode=dark] {
                    ' . $vars_dark_mode . '
                }
            ';
			
			// Content width: Force full/wide below specific width to avoid unnecessary spacing on smaller screens
			if ( 0 !== $content_width_force_wide_below ) {
				$styles .= '
                    @media (max-width: ' . $content_width_force_wide_below . 'px) {
                        :root {
                            --content--max-width: var(--content--max-width-wide);
                        }
                    }
                ';
			}
			
			// Minify styles: Thanks @Datayze - https://datayze.com/howto/minify-css-with-php
			$styles = preg_replace( '/\/\*((?!\*\/).)*\*\//', '', $styles );
			$styles = preg_replace( '/\s{2,}/', ' ', $styles );
			$styles = preg_replace( '/\s*([:;{}])\s*/', '$1', $styles );
			$styles = preg_replace( '/;}/', '}', $styles );
			
			return $styles;
		}
	}
	
	new Heim_Customize();
}
