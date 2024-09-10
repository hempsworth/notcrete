<?php
/**
 * Displays the secondary header menu
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */
?>

<nav class="site-menu-secondary" aria-label="<?php esc_attr_e( 'Secondary menu', 'heim' ); ?>">
	
	<?php if ( has_nav_menu( 'secondary' ) ) : ?>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'secondary-menu-container',
				'items_wrap'      => '<ul id="secondary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
	<?php endif; ?>
	
	<ul class="site-header-tools">
		<?php
			/**
			 * Hook: heim_before_header_tools
			 */
			do_action( 'heim_before_header_tools' );
		?>
		
		<?php
			// Tool: Color mode
		if ( Heim_Customize::get_setting( 'header_color_mode' ) ) :
			?>
		<li id="site-header-color-mode" class="menu-item">
			<?php heim_color_mode_switcher(); ?>
		</li>
		<?php endif; ?>
		
		<?php
			// Tool: Search
		if ( Heim_Customize::get_setting( 'header_search' ) ) :
		
			$search_icon_class = apply_filters( 'heim_header_search_icon', 'heim-icon-search' );
			?>
		<li id="site-header-search" class="menu-item">
			<a class="<?php echo esc_attr( $search_icon_class ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'heim' ); ?></span></a>
		<?php heim_search_form(); ?>
		</li>
		<?php endif; ?>

		<?php if ( heim_woocommerce_active() ) : ?>
		
		<?php
			// Tool: My account
			if ( Heim_Customize::get_setting( 'header_myaccount' ) ) :
		
			$myaccount_icon_class = apply_filters( 'heim_header_myaccount_icon', 'heim-icon-user' );
				?>
		<li id="site-header-myaccount" class="menu-item">
			<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="<?php echo esc_attr( $myaccount_icon_class ); ?>"><span class="screen-reader-text"><?php esc_html_e( 'My account', 'woocommerce' ); ?></span></a>
		</li>
		<?php endif; ?>
		
		<?php
			// Tool: Wishlist
			if ( class_exists( 'NM_WooCommerce_Wishlist' ) && Heim_Customize::get_setting( 'header_wishlist' ) ) :
		
			$wishlist_page_url = NM_WooCommerce_Wishlist::$wishlist_page_url;
			$wishlist_page_url = ( strlen( $wishlist_page_url ) > 0 ) ? $wishlist_page_url : '#';
			$wishlist_icon_class = apply_filters( 'heim_header_wishlist_icon', 'heim-icon-heart' );
				?>
		<li id="site-header-wishlist" class="menu-item">
			<a href="<?php echo esc_url( $wishlist_page_url ); ?>" class="nmww-wishlist-button"><i class="<?php echo esc_attr( $wishlist_icon_class ); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'Wishlist', 'heim' ); ?></span></a>
		</li>
		<?php endif; ?>
		
		<?php
			// Tool: Cart
			if ( Heim_Customize::get_setting( 'header_cart' ) ) :
				?>
		<li id="site-header-cart" class="menu-item">
			<?php
				$block_option_add_to_cart_behaviour = ( Heim_Customize::get_setting( 'mini_cart_show_added' ) ) ? ',"addToCartBehaviour":"open_drawer"' : '';
				
				echo wp_kses_post( do_blocks( '<!-- wp:woocommerce/mini-cart {"hasHiddenPrice":true' . $block_option_add_to_cart_behaviour . '} /-->' ) );
				?>
		</li>
		<?php endif; ?>
		
		<?php endif; ?>
		
		<?php
			/**
			 * Hook: heim_after_header_tools
			 */
			do_action( 'heim_after_header_tools' );
		?>
	</ul>
	
</nav><!-- .site-menu-secondary -->
