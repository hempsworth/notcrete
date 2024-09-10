<?php
/**
 * Set-up supported features and register defaults
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( ! function_exists( 'heim_support' ) ) {
	/**
	 * Theme support
	 */
	function heim_support() {
		// Make theme available for translation
		load_theme_textdomain( 'heim', get_template_directory() . '/languages' );
		
		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( // Switch default core markup for search form, comment form, and comments to output valid HTML5
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'responsive-embeds' );
		
		// Add theme support: WooCommerce
		add_theme_support(
			'woocommerce',
			array(
				'product_grid' => array(
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 6,
				),
			)
		);
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		
		// Register menus
		register_nav_menus(
			array(
				'primary'          => esc_html_x( 'Header Primary', 'Menu locations', 'heim' ),
				'secondary'        => esc_html_x( 'Header Secondary', 'Menu locations', 'heim' ),
				'mobile'           => esc_html_x( 'Mobile Primary', 'Menu locations', 'heim' ),
				'mobile-secondary' => esc_html_x( 'Mobile Secondary', 'Menu locations', 'heim' ),
				'footer'           => esc_html_x( 'Footer', 'Menu locations', 'heim' ),
			)
		);
		
		// Block editor styles
		add_editor_style( './assets/css/style-editor.css' );
		
		// Excerpts
		add_filter( 'excerpt_length', function() {
			return 30;
		}, 999 );
		add_filter( 'excerpt_more', function() {
			return ' ...';
		}, 21 );
	}
}
add_action( 'after_setup_theme', 'heim_support' );


/**
 * Sidebars and widgets
 */
function heim_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Shop Filters', 'Sidebar name', 'heim' ),
			'id'            => 'shop-filters-widgets',
			'description'   => esc_html_x( 'Add filter widgets for the shop catalog.', 'Sidebar description', 'heim' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html_x( 'Footer Widgets', 'Sidebar name', 'heim' ),
			'id'            => 'footer-widgets',
			'description'   => esc_html_x( 'Add widgets for the footer.', 'Sidebar description', 'heim' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'heim_widgets_init' );


/**
 * WooCommerce: Check if activated
 */
function heim_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}


/**
 * Content width
 * 
 * Set the content width in pixels, based on the theme's design and stylesheet
 *
 * Priority 0 to make it available to lower priority callbacks
 */
function heim_content_width() {
	// This variable is intended to be overruled from themes
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}
	$GLOBALS['content_width'] = apply_filters( 'heim_content_width', 760 );
}
add_action( 'after_setup_theme', 'heim_content_width', 0 );


/**
 * Body classes
 */
function heim_body_classes( $classes ) {
	// Singular pages: Add "singular" class
	$classes['heim_singular'] = ( is_singular() ) ? 'singular' : 'hfeed';
	
	// Header: Sticky class
	if ( Heim_Customize::get_setting( 'header_sticky' ) ) {
		$classes['heim_header_sticky'] = 'header-sticky';
	}
	
	// Header: Mobile-menu button class
	if ( Heim_Customize::get_setting( 'mobile_menu_enable_on_desktop' ) ) {
		$classes['heim_mobile_menu_desktop'] = 'mobile-menu-desktop';
	}
	
	// Content: Fade in animation class
	$content_fade_in = apply_filters( 'heim_content_fade_in', true );
	if ( $content_fade_in ) {
		$classes['heim_content_fade_in'] = 'has-fade-in';
	}
	
	if ( heim_woocommerce_active() ) {
		// Products: Mobile button layout
		$product_show_button_on_mobile = apply_filters( 'heim_product_button_mobile', false );
		if ( $product_show_button_on_mobile ) {
			$classes['heim_product_button_mobile'] = 'product-button-mobile';
		}
		
		// Shop archive: AJAX pagination
		if ( Heim_Customize::get_setting( 'shop_ajax_pagination' ) !== 'standard' ) {
			$classes['heim_shop_ajax_pagination'] = 'shop-ajax-pagination';
		}
	}
		
	return $classes;
}
add_filter( 'body_class', 'heim_body_classes' );


/**
 * Menus: Include "arrow" element
 */
function heim_menu_include_arrow_element( $output, $item, $depth, $args ) {
	$registered_menus = array( 'primary', 'secondary', 'mobile', 'mobile-secondary' );
	
	if (
		in_array( $args->theme_location, $registered_menus, true ) && // Limit to registered menus
		in_array( 'menu-item-has-children', $item->classes, true ) && // Must have sub-menus
		( 0 === $depth ) // Limit to top-level items
	) {
		$output .= '<span class="menu-item-toggle"><i class="heim-icon-angle-thin-down"></i><span class="screen-reader-text">' . esc_html( 'Toggle menu' ) . '</span></span>';
	}

	return $output;
}
add_filter( 'walker_nav_menu_start_el', 'heim_menu_include_arrow_element', 10, 4 );


/**
 * Search: Set searchable post types
 */
function heim_search_post_types( $query ) {
	if ( $query->is_search ) {
		if ( ! isset( $query->query_vars['post_type'] ) ) {
			$query->set( 'post_type', array( 'post', 'page' ) );
		}
	}
	return $query;
}
add_filter( 'pre_get_posts', 'heim_search_post_types' );


/**
 * Search: Halt main query in case of an empty search - https://gist.github.com/jonbrockett/00f742f1875e2a9aa7f48e94e0de0cbd
 */
function heim_posts_search_halt_empty( $search, \WP_Query $q ) {
	if ( ! is_admin() && empty( $search ) && $q->is_search() && $q->is_main_query() ) {
		$search .= ' AND 0=1 ';
	}

	return $search;
}
add_filter( 'posts_search', 'heim_posts_search_halt_empty', 10, 2 );


/**
 * Avatar (comments): Check if a block containing an avatar is added
 */
function heim_has_avatar_block() {
	$avatar_blocks = apply_filters( 'heim_avatar_blocks_lookup', array(
		//'avatar',
		//'post-author',
		'comments',
		'latest-comments',
	) );
	
	foreach ( $avatar_blocks as $avatar_block ) {
		if ( has_block( $avatar_block ) ) {
			return true;
		}
	}
	
	return false;
}


/**
 * Avatar (comments): Set "default" value - https://stackoverflow.com/questions/32494796/determine-if-gravatar-return-default-image-using-javascript
 */
function heim_avatar_data( $args, $id_or_email ) {
	if ( in_the_loop() && is_main_query() && ! heim_has_avatar_block() ) {
		$args['default'] = '404'; // Makes Gravatar return a 404 instead of the default image
		//$args['decoding'] = null;
	}
		
	return $args;
}
add_filter( 'pre_get_avatar_data', 'heim_avatar_data', 10, 2 );


/**
 * Avatar (comments): Remove width/height attributes from "img" tag
 *
 * Note: By removing these attributes, a JS width check on the "img" tag can be used to tell if it has loaded
 */
function heim_avatar_remove_size_atts( $avatar ) {
	//if ( in_the_loop() && is_main_query() && ! heim_has_avatar_block() ) {
	$avatar = preg_replace( "/(width|height)=\'\d*\'\s/", '', $avatar );
	//}
	return $avatar;
}
add_filter( 'get_avatar', 'heim_avatar_remove_size_atts', 10 );


/**
 * Output: Get allowed HTML tags for template output
 */
function heim_get_allowed_html_tags() {
	return apply_filters( 'heim_allowed_template_html_tags', array(
		'div'    => array(
			'id'     => array(),
			'class'  => array(),
			'data-*' => array(),
			'style'  => array(),
		),
		'a'      => array(
			'href'           => array(),
			'title'          => array(),
			'class'          => array(),
			'rel'            => array(),
			'target'         => array(),
			'id'             => array(),
			'referrerpolicy' => array(),
			'crossorigin'    => array(),
			'data-*'         => array(),
			'style'          => array(),
		),
		'span'   => array(
			'id'    => array(),
			'class' => array(),
			'style' => array(),
		),
		'em'     => array(),
		'strong' => array(
			'id'    => array(),
			'class' => array(),
			'style' => array(),
		),
		'i'      => array(
			'id'    => array(),
			'class' => array(),
			'style' => array(),
		),
		'br'     => array(),
		'img'    => array(
			'id'             => array(),
			'alt'            => array(),
			'class'          => array(),
			'src'            => array(),
			'title'          => array(),
			'width'          => array(),
			'height'         => array(),
			'srcset'         => array(),
			'sizes'          => array(),
			'style'          => array(),
			'decoding'       => array(),
			'loading'        => array(),
			'referrerpolicy' => array(),
			'crossorigin'    => array(),
		),
	) );
}


/**
 * Output: Get allowed HTML tags for forms
 */
/*function heim_get_allowed_form_html_tags() {
	return apply_filters( 'heim_allowed_form_html_tags', array(
		'label' => array(
			'id'    => array(),
			'class' => array(),
			'for'   => array(),
			'style' => array(),
		),
		'input' => array(
			'id'           => array(),
			'class'        => array(),
			'type'         => array(),
			'name'         => array(),
			'value'        => array(),
			'step'         => array(),
			'min'          => array(),
			'max'          => array(),
			'checked'      => array(),
			'disabled'     => array(),
			'autocomplete' => array(),
			'placeholder'  => array(),
			'aria-*'       => array(),
			'data-*'       => array(),
			'tabindex'     => array(),
			'style'        => array(),
		),
		'textarea' => array(
			'id'          => array(),
			'class'       => array(),
			'name'        => array(),
			'placeholder' => array(),
			'rows'        => array(),
			'cols'        => array(),
			'aria-*'      => array(),
			'data-*'      => array(),
			'tabindex'    => array(),
			'style'       => array(),
		),
		'select' => array(
			'id'          => array(),
			'class'       => array(),
			'name'        => array(),
			'placeholder' => array(),
			'aria-*'      => array(),
			'data-*'      => array(),
			'tabindex'    => array(),
			'style'       => array(),
		),
		'option' => array(
			'selected' => array(),
		),
		'button' => array(
			'id'       => array(),
			'class'    => array(),
			'type'     => array(),
			'value'    => array(),
			'aria-*'   => array(),
			'disabled' => array(),
			'tabindex' => array(),
			'style'    => array(),
		),
	) );
}*/


/**
 * Output: WooCommerce - Get allowed HTML tags
 */
function heim_woocommerce_get_allowed_tags( $output_type = '' ) {
	$allowed_tags = array();
	
	switch ( $output_type ) {
		case 'cart_item_data':
			$allowed_tags = array(
				'dl' => array(
					'id'     => array(),
					'class'  => array(),
					'style'  => array(),
				),
				'dt' => array(
					'class'  => array(),
				),
				'dd' => array(
					'class'  => array(),
				),
				'p' => array(
					'class'  => array(),
				),
			);
			break;
			
		case 'item_subtotal':
			$allowed_tags = array(
				'span' => array(
					'id'     => array(),
					'class'  => array(),
					'style'  => array(),
				),
				'bdi' => array(
					'class'  => array(),
				),
			);
			break;
		
		case 'product_thumbnail':
			$allowed_tags = array(
				'img' => array(
					'id'             => array(),
					'alt'            => array(),
					'class'          => array(),
					'src'            => array(),
					'title'          => array(),
					'width'          => array(),
					'height'         => array(),
					'srcset'         => array(),
					'sizes'          => array(),
					'style'          => array(),
					'decoding'       => array(),
					'loading'        => array(),
					'referrerpolicy' => array(),
					'crossorigin'    => array(),
				),
			);
			break;
	}
	
	$allowed_tags = apply_filters( 'heim_woocommerce_allowed_tags', $allowed_tags, $output_type ); 
	
	return $allowed_tags;
}
