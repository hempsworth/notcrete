<?php
/**
 * WooCommerce setup
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

// Hook: Setup wizard - Prevent automatic redirect
//add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

/**
 * Hook: WooCommerce styles - Remove "woocommerce-smallscreen.css" stylesheet (breaks various styles when combining/minifying stylesheets)
 */
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
	unset( $styles['woocommerce-smallscreen'] );
	return $styles;
} );

// Hooks: Store notice
remove_action( 'wp_footer', 'woocommerce_demo_store' );
add_action( 'heim_before_header', 'woocommerce_demo_store', 10 );

// Hook: Breadcrumb menu
add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1 );
add_filter( 'woocommerce_breadcrumb_defaults', 'heim_woocommerce_breacrumb_defaults' );

// Hooks: Default wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Hooks: Archive toolbar
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'heim_woocommerce_shop_toolbar', 20 );
add_action( 'heim_woocommerce_shop_toolbar', 'heim_woocommerce_catalog_ordering', 10 );
add_action( 'heim_woocommerce_shop_toolbar', 'heim_woocommerce_shop_widget_buttons', 20 );
add_action( 'heim_woocommerce_after_shop_toolbar', 'heim_woocommerce_result_count', 10 );

// Hooks: Archive thumbnails
add_action( 'woocommerce_before_shop_loop_item_title', 'heim_woocommerce_shop_thumbnail_wrapper_open', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'heim_woocommerce_shop_thumbnail_wrapper_close', 11 );
if ( ! is_admin() && ! wp_is_mobile() ) {
	add_filter( 'woocommerce_product_get_image', 'heim_woocommerce_shop_add_hover_thumbnail', 10, 6 );
}
	
// Hooks: Archive sidebar
add_action( 'woocommerce_before_shop_loop', 'heim_woocommerce_sidebar_open', 40 );
add_action( 'woocommerce_after_shop_loop', 'heim_woocommerce_sidebar_close', /*10*/100 );

// Hooks: Archive AJAX pagination
add_action( 'woocommerce_after_shop_loop', 'heim_woocommerce_shop_ajax_pagination', 15 );

// Hook: Single search result
add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

// Hooks: Quantity
add_action( 'woocommerce_before_quantity_input_field', 'heim_woocommerce_quantity_minus_button', 10 );
add_action( 'woocommerce_after_quantity_input_field', 'heim_woocommerce_quantity_plus_button', 10 );

// Hooks: New flash
add_action( 'woocommerce_shop_loop_item_title', 'heim_woocommerce_new_flash', 1 );

// Hooks: Sale flash
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_filter( 'woocommerce_get_price_html', 'heim_woocommerce_get_price_html', 2, 99 );

// Hooks: Product page
add_filter( 'woocommerce_single_product_carousel_options', 'heim_woocomerce_product_gallery_options' );
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'heim_woocommerce_product_gallery_thumbnail_size' );
add_filter( 'woocommerce_single_product_photoswipe_options', 'heim_woocommerce_product_fullscreen_gallery_options' );
add_action( 'woocommerce_after_single_product_summary', 'heim_woocommerce_product_summary_clear', 1 );

// Hooks: Cart page
add_action( 'woocommerce_after_cart_item_name', 'heim_woocommerce_cart_include_item_price', 2, 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display', 100 );
add_filter( 'woocommerce_cross_sells_total', 'heim_woocommerce_cross_sells_config' );
add_filter( 'woocommerce_cross_sells_columns', 'heim_woocommerce_cross_sells_config' );

// Hook: Cart fragments
add_filter( 'woocommerce_add_to_cart_fragments', 'heim_woocommerce_add_to_cart_fragments' );

// Hooks: Checkout
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'woocommerce_checkout_before_customer_details', 'heim_woocommerce_checkout_customer_details_wrapper_open', 1 );
add_action( 'woocommerce_review_order_before_payment', 'heim_woocommerce_checkout_payments_heading', 1 );
add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 5 );
add_action( 'woocommerce_checkout_after_customer_details', 'heim_woocommerce_checkout_customer_details_wrapper_close', 100 );
add_action( 'woocommerce_review_order_before_order_total', 'heim_woocommerce_checkout_coupon_form', 100 );
add_filter( 'woocommerce_paypal_icon', 'heim_woocommerce_checkout_replace_paypal_icon' );

// Hooks: My account
add_action( 'woocommerce_before_customer_login_form', 'heim_woocommerce_customer_login_toggle', 10 );

// Hook: Products block
add_filter( 'woocommerce_blocks_product_grid_item_html', 'heim_woocommerce_blocks_product_grid_item_html', 10, 3 );

/*
 * New flash - Get
 */
function heim_woocommerce_get_new_flash( $product ) {
	$new_label = '<span class="heim-label-itsnew">' . esc_html__( 'New', 'heim' ) . '</span>';
	
	// Add label to default products added via hook
	$default_new_products = apply_filters( 'heim_new_flash_default_products', array() );
	if ( ! empty( $default_new_products ) ) {
		$product_title = strtolower( $product->get_title() );
		
		if ( in_array( $product_title, $default_new_products ) ) {
			return $new_label;
		}
	}
	
	// Add label if products is within timeframe
	$newness_days = apply_filters( 'heim_new_flash_days', 14 );
	$created = strtotime( $product->get_date_created() );
	if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
		return $new_label;
	}
	
	return '';
}

/**
 * Shop: Active filters
 */
function heim_woocommerce_shop_get_active_filters() {
	$show_active_filters = apply_filters( 'heim_shop_show_active_filters', true );
	
	if ( $show_active_filters ) :

		$active_filters_block = '<!-- wp:woocommerce/active-filters {"displayStyle":"chips","heading":"","lock":{"remove":true}} -->
        <div class="wp-block-woocommerce-active-filters is-loading" data-display-style="chips" data-heading="" data-heading-level="3"><span aria-hidden="true" class="wc-block-active-product-filters__placeholder"></span></div>
        <!-- /wp:woocommerce/active-filters -->';
	
		?>
		<div id="heim-shop-active-filters">
			<?php echo wp_kses_post( do_blocks( $active_filters_block ) ); ?>
		</div>
		<?php
	
	endif;
}

/**
 * Shop: Sidebar
 */
function heim_woocommerce_shop_get_sidebar() {
	$filters_toggle_class = ( Heim_Customize::get_setting( 'shop_filters_toggle' ) ) ? ' has-toggle' : '';
	
	?>
	<div id="heim-shop-filters" class="shop-filters<?php echo esc_attr( $filters_toggle_class ); ?>">
		<?php dynamic_sidebar( 'shop-filters-widgets' ); ?>
	</div>
	<?php
}

/**
 * Shop: Toolbar - Output
 */
function heim_woocommerce_shop_toolbar() {
	$toolbar_classes = array();
	$toolbar_classes[] = ( Heim_Customize::get_setting( 'shop_filters_toggle' ) ) ? 'has-filters-toggle' : 'no-filters-toggle';
	$toolbar_classes[] = 'has-filters-' . Heim_Customize::get_setting( 'shop_filters' );
	$toolbar_classes[] = ( 'aside' === Heim_Customize::get_setting( 'shop_filters' ) && Heim_Customize::get_setting( 'shop_aside_panel_button' ) ) ? 'desktop-aside-panel-button' : '';
	
	?>
	<div class="heim-shop-toolbar <?php echo esc_attr( implode( ' ', $toolbar_classes ) ); ?>">
		
		<?php
		/**
		 * Hook: heim_woocommerce_before_shop_toolbar
		 */
		do_action( 'heim_woocommerce_before_shop_toolbar' );
		?>
		
		<ul id="heim-shop-toolbar-buttons">
			<?php
			/**
			 * Hook: heim_woocommerce_shop_toolbar
			 *
			 * @hooked heim_woocommerce_catalog_ordering - 10
			 * @hooked heim_woocommerce_shop_widget_buttons - 20
			 */
			do_action( 'heim_woocommerce_shop_toolbar' );
			?>
		</ul>
		
		<?php
		/**
		 * Hook: heim_woocommerce_after_shop_toolbar
		 *
		 * @hooked woocommerce_result_count - 10
		 */
		do_action( 'heim_woocommerce_after_shop_toolbar' );
		?>
		
	</div>

	<?php if ( 'aside' === Heim_Customize::get_setting( 'shop_filters' ) && is_active_sidebar( 'shop-filters-widgets' ) ) : ?>
	
	<?php heim_woocommerce_shop_get_active_filters(); ?>
		
	<div id="aside-panel-shop-filters" class="aside-panel aside-panel-left">
		<div class="aside-panel-inner">
			
			<div class="aside-panel-close">
				<a class="heim-icon-close">
					<span class="screen-reader-text"><?php esc_html_e( 'Close', 'heim' ); ?></span>
				</a>
			</div>
			
			<?php heim_woocommerce_shop_get_sidebar(); ?>
			
		</div>
	</div>
	<?php
	endif;
}

/**
 * Shop: Toolbar - Output catalog ordering
 */
function heim_woocommerce_catalog_ordering() {
	echo '<li class="heim-shop-toolbar-button-ordering">';
		woocommerce_catalog_ordering();
	echo '</li>';
}

/**
 * Shop: Toolbar - Output widget buttons
 */
function heim_woocommerce_shop_widget_buttons() {
	if ( ! is_active_sidebar( 'shop-filters-widgets' ) ) {
		return;
	}
	
	if ( 'aside' === Heim_Customize::get_setting( 'shop_filters' ) ) {
		
		// Widget buttons
		if ( Heim_Customize::get_setting( 'shop_aside_panel_widget_buttons' ) ) {
			$sidebars_widgets = wp_get_sidebars_widgets();
			$shop_widget_ids = $sidebars_widgets['shop-filters-widgets'];

			if ( ! $shop_widget_ids ) {
				return;
			}
			
			foreach ( $shop_widget_ids as $id ) {
				echo '<li class="heim-shop-toolbar-button-widget is-placeholder"><a id="heim-shop-filter-button-' . esc_attr( $id ) . '" class="heim-shop-toolbar-button heim-shop-filter-button" data-widget-id="' . esc_attr( $id ) . '">&hellip;</a></li>';
			}
		}
		
		// "All widgets" button
		$button_title = ( Heim_Customize::get_setting( 'shop_aside_panel_widget_buttons' ) && Heim_Customize::get_setting( 'shop_aside_panel_button' ) ) ? __( 'All filters', 'heim' ) : __( 'Filters', 'woocommerce' );
		
		echo '<li class="heim-shop-toolbar-button-aside-panel"><a id="heim-shop-aside-panel-button" class="heim-shop-toolbar-button">' . esc_html( $button_title ) . '</a></li>';
						
	} else if ( 'sidebar' === Heim_Customize::get_setting( 'shop_filters' ) ) {
		echo '<li class="heim-shop-toolbar-button-sidebar"><a id="heim-shop-sidebar-button" class="heim-shop-toolbar-button">' . esc_html__( 'Filters', 'woocommerce' ) . '</a></li>';
		
	}
}

/**
 * Shop: Orderby select - Get default value
 */
function heim_woocommerce_catalog_orderby_get_default() {
	// From "woocommerce_catalog_ordering()" function in "../woocommerce/includes/wc-template-functions.php"
	$default_orderby = wc_get_loop_prop( 'is_search' ) ? 'relevance' : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'menu_order' ) );
	
	return $default_orderby;
}

/**
 * Shop: Result count text - Output
 * 
 * Based on "woocommerce_result_count()" function
 */
function heim_woocommerce_result_count() {
	if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
		return;
	}
	$args = array(
		'total'    => wc_get_loop_prop( 'total' ),
	);
	
	get_template_part( 'template-parts/woocommerce/result-count', null, $args );
}

/**
 * Shop: Sidebar open
 */
function heim_woocommerce_sidebar_open() {
	if ( Heim_Customize::get_setting( 'shop_filters' ) !== 'sidebar' || ! is_active_sidebar( 'shop-filters-widgets' ) ) {
		return;
	}
	
	?>
	<div class="heim-shop-wrapper">
		<div class="heim-shop-sidebar-wrapper">
			
			<?php heim_woocommerce_shop_get_active_filters(); ?>
			
			<div class="heim-shop-sidebar sidebar">
				<div class="heim-shop-sidebar-inner">

					<div class="aside-panel-close">
						<a class="heim-icon-close">
							<span class="screen-reader-text"><?php esc_html_e( 'Close', 'heim' ); ?></span>
						</a>
					</div>

					<?php heim_woocommerce_shop_get_sidebar(); ?>

				</div>
			</div>
			
		</div>
			
		<div class="heim-shop-catalog">
	<?php
}

/**
 * Shop: Sidebar close
 */
function heim_woocommerce_sidebar_close() {
	if ( Heim_Customize::get_setting( 'shop_filters' ) !== 'sidebar' || ! is_active_sidebar( 'shop-filters-widgets' ) ) {
		return;
	}
	
	?>
	   </div>
	</div>
	<?php
}

/**
 * Shop: Thumbnail wrapper open
 */
function heim_woocommerce_shop_thumbnail_wrapper_open() {
	echo '<div class="heim-woocommerce-loop-product-thumbnail">';
}

/**
 * Shop: Thumbnail wrapper close
 */
function heim_woocommerce_shop_thumbnail_wrapper_close() {
	echo '</div>';
}

/**
 * Shop: Get "hover" thumbnail
 */
function heim_woocommerce_shop_add_hover_thumbnail( $image, $product, $size, $attr, $placeholder/*, $image_duplicate*/ ) {
	if ( Heim_Customize::get_setting( 'shop_hover_thumbnail' ) && is_woocommerce() ) {
		$hover_thumbnail = heim_woocommerce_product_get_hover_thumbnail( $product );
		if ( $hover_thumbnail ) {
			return $image . $hover_thumbnail;
		}
	}

	return $image;
}

/**
 * Shop: New flash - Output
 */
function heim_woocommerce_new_flash() {
	if ( ! Heim_Customize::get_setting( 'product_new_flash' ) ) {
		return;
	}
	
	global $product;
	
	$new_flash = heim_woocommerce_get_new_flash( $product );
	
	$allowed_tags = heim_get_allowed_html_tags();
	echo wp_kses( $new_flash, $allowed_tags );
}

/**
 * Shop: Price - Include Sale flash
 */
function heim_woocommerce_get_price_html( $price, $product ) {
	if ( ! is_admin() && $product->is_on_sale() ) {
		$sale_flash = heim_woocommerce_get_sale_flash( $product );

		return $price . $sale_flash;
	}
	
	return $price;
}

/**
 * Shop: Sale flash - Get
 */
function heim_woocommerce_get_sale_flash( $product ) {
	if ( 'disable' === Heim_Customize::get_setting( 'product_sale_flash' ) ) {
		return;
	}
	
	global $post;
	
	// Display percent
	if ( 'percent' === Heim_Customize::get_setting( 'product_sale_flash' ) ) {
		$sale_percent = heim_woocommerce_get_sale_percent( $product );
		
		if ( $sale_percent > 0 ) {
			return apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="heim-onsale-before">-</span>' . esc_html( $sale_percent ) . '<span class="heim-onsale-after">%</span></span>', $post, $product );
		}
	} else {
		return apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>', $post, $product );
	}
}

/**
 * Shop: AJAX pagination
 */
function heim_woocommerce_shop_ajax_pagination() {
	if ( 'standard' === Heim_Customize::get_setting( 'shop_ajax_pagination' ) ) {
		return;
	}
	
	$total    = wc_get_loop_prop( 'total' );
	$per_page = wc_get_loop_prop( 'per_page' );
	$current  = wc_get_loop_prop( 'current_page' );
	$current_total = min( $total, $per_page * $current );
	
	$last_page_class = ( $current_total >= $total ) ? 'is-last-page' : '';
	
	?>
	<div id="heim-woocommerce-ajax-pagination" class="<?php echo esc_attr( $last_page_class ); ?>">
		<?php woocommerce_result_count(); ?>
		
		<button id="heim-woocommerce-ajax-pagination-button" class="label-button"><?php echo esc_html_e( 'Show more', 'heim' ); ?></button>
	</div>
	<?php
}

/**
 * Quantity: Output minus button
 */
function heim_woocommerce_quantity_minus_button() {
	echo '<button class="heim-qty heim-qty-minus">-</button>';
}

/**
 * Quantity: Output plus button
 */
function heim_woocommerce_quantity_plus_button() {
	echo '<button class="heim-qty heim-qty-plus">+</button>';
}

/**
 * Product: Hover thumbnail - Get
 */
function heim_woocommerce_product_get_hover_thumbnail( $product ) {
	$product_gallery_image_ids = $product->get_gallery_image_ids();

	if ( ! empty( $product_gallery_image_ids ) ) {
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
		$image_class = sprintf( 'attachment-%1$s size-%1$s heim-product-hover-thumbnail', $image_size );
		$hover_image = wp_get_attachment_image( $product_gallery_image_ids[0], $image_size, false, array( 'class' => $image_class ) );

		return $hover_image;
	}

	return null;
}

/**
 * Product: Sale percent - Get
 */
function heim_woocommerce_get_sale_percent( $product ) {
	if ( 'variable' === $product->get_type() ) {
		// Get product variation prices (regular and sale)
		$product_variation_prices = $product->get_variation_prices();

		$highest_sale_percent = 0;

		foreach ( $product_variation_prices['regular_price'] as $key => $regular_price ) {
			// Get sale price for current variation
			$sale_price = $product_variation_prices['sale_price'][$key];

			// Is product variation on sale?
			if ( $sale_price < $regular_price ) {
				$sale_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

				// Is current sale percent highest?
				if ( $sale_percent > $highest_sale_percent ) {
					$highest_sale_percent = $sale_percent;
				}
			}
		}

		// Return the highest product variation sale percent
		return $highest_sale_percent;
	} else {
		$regular_price = $product->get_regular_price();
		$sale_percent = 0;
		
		// Make sure the percentage value can be calculated
		if ( intval( $regular_price ) > 0 ) {
			$sale_percent = round( ( ( $regular_price - $product->get_sale_price() ) / $regular_price ) * 100 );
		}

		return $sale_percent;
	}
}

/**
 * Product page: Gallery options (Flexslider)
 */
function heim_woocomerce_product_gallery_options( $options ) {
	$options['animationLoop'] = true;
	$options['directionNav'] = true;
	$options['prevText'] = '<i class="heim-icon-angle-thin-left"></i>';
	$options['nextText'] = '<i class="heim-icon-angle-thin-right"></i>';

	return $options;
}

/**
 * Product page: Gallery thumbnails size
 */
function heim_woocommerce_product_gallery_thumbnail_size( $size ) {
	return array(
		'width'  => 150,
		'height' => 0,
		'crop'   => 0,
	);
}

/**
 * Product page: Fullscreen gallery options (PhotoSwipe)
 */
function heim_woocommerce_product_fullscreen_gallery_options( $options ) {
	$options['barsSize']     = array(
		'top'    => 0,
		'bottom' => 'auto',
	);
	$options['captionEl']    = false;
	$options['fullscreenEl'] = false;
	$options['galleryPIDs']  = true;
	$options['shareEl']      = false;
	$options['zoomEl']       = false;
	
	return $options;
}

/**
 * Product page: Breadcrumb menu
 */
function heim_woocommerce_breacrumb_defaults( $defaults ) {
	$defaults['delimiter'] = '<em>&nbsp;&#47;&nbsp;</em>';
	$defaults['before'] = '<span>';
	$defaults['after'] = '</span>';
	
	return $defaults;
}

/**
 * Product page: Clear content after floated summary container with "clearfix" HTML tag
 */
function heim_woocommerce_product_summary_clear() {
	echo '<div class="heim-woocommerce-product-summary-clear clear"></div>';
}

/**
 * Cart: Include item-price below name
 */
function heim_woocommerce_cart_include_item_price( $cart_item, $cart_item_key ) {
	// Code from "../plugins/woocommerce/templates/cart.php" template
	$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	echo wp_kses_post( apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ) );
}

/**
 * Cart: Cross sells - Set total and columns
 */
function heim_woocommerce_cross_sells_config() {
	if ( wp_is_mobile() ) {
		return 2;
	}
	return 3;
}

/**
 * Cart: Add page elements/fragments that should refresh after adding-to/updating cart via AJAX
 */
function heim_woocommerce_add_to_cart_fragments( $fragments ) {
	// Cart block count isn't updated on Cart page
	$cart_count = is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : null;
	if ( null !== $cart_count ) {
		// Note: Make sure to include ".woocommerce-cart" in selector so the cart-count is only updated on the Cart page
		$fragments['.woocommerce-cart #site-header-cart .wc-block-mini-cart__badge'] = '<span class="wc-block-mini-cart__badge">' . esc_html( $cart_count ) . '</span>';
	}
		
	return $fragments;
}

/**
 * Checkout: Customer details - Wrapper tag open
 */
function heim_woocommerce_checkout_customer_details_wrapper_open() {
	echo '<div class="heim-woocommerce-checkout-customer-details-wrapper">';
}

/**
 * Checkout: Customer details - Wrapper tag close
 */
function heim_woocommerce_checkout_customer_details_wrapper_close() {
	echo '</div>';
}

/**
 * Checkout: Payment options - Include heading
 */
function heim_woocommerce_checkout_payments_heading() {
	echo '<h3 class="heim-woocommerce-checkout-payment-heading">' . esc_html_x( 'Payment Options', 'block title', 'woocommerce' ) . '</h3>';
}

/**
 * Checkout: Payment options - Replace PayPal icon
 */
function heim_woocommerce_checkout_replace_paypal_icon() {
	return get_template_directory_uri() . '/assets/images/paypal-icon.png';
}

/**
 * Checkout: Order summary - Include coupon form
 */
function heim_woocommerce_checkout_coupon_form() {
	if ( ! wc_coupons_enabled() ) {
	   return;
	}
	
	// Note: Removed "name" attribute and added "form=none" attribute from coupon input-field (#coupon_code) so it won't be submitted with the checkout form
	?>
	<tr class="heim-woocommerce-checkout-coupon">
		<td>
			<div class="heim-woocommerce-checkout-coupon-form">
				<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label>
				<input type="text" form="none" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" />

				<a class="heim-woocommerce-checkout-coupon-form-button button" href="#"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></a>
			</div>
		</td>
	</tr>
	<?php
}

/**
 * My account: Login/register - Include toggle buttons
 */
function heim_woocommerce_customer_login_toggle() {
	if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) :
		?>
	<ul id="heim-woocommerce-customer-login-toggle">
		<li class="active"><a class="label-button"><?php esc_html_e( 'Login', 'woocommerce' ); ?></a></li>
		<li><a class="label-button"><?php esc_html_e( 'Register', 'woocommerce' ); ?></a></li>
	</ul>
		<?php
	endif;
}

/**
 * Block: Products - Add custom content
 */
function heim_woocommerce_blocks_product_grid_item_html( $html, $data, $product ) {
	// Add "hover" thumbnail
	if ( Heim_Customize::get_setting( 'shop_hover_thumbnail' ) && ! wp_is_mobile() ) {
		$hover_thumbnail = heim_woocommerce_product_get_hover_thumbnail( $product );
		if ( $hover_thumbnail ) {
			$thumbnail_wrapper_tag = '<div class="wc-block-grid__product-image">';
			$thumbnail_output = $thumbnail_wrapper_tag . $hover_thumbnail;

			$html = str_replace( $thumbnail_wrapper_tag, $thumbnail_output, $html );
		}
	}
	
	// Add "New" flash before product title
	if ( Heim_Customize::get_setting( 'product_new_flash' ) ) {
		$new_flash = heim_woocommerce_get_new_flash( $product );
		if ( strlen( $new_flash ) > 0 ) {
			$title_wrapper_tag = '<div class="wc-block-grid__product-title">';
			$title_output = $new_flash . $title_wrapper_tag;
			
			$html = str_replace( $title_wrapper_tag, $title_output, $html );
		}
	}
	
	return $html;
}
