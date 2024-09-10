<?php
/**
 * Displays the mobile menu
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */
?>

<div id="aside-panel-mobile-menu" class="aside-panel aside-panel-left">
	<div class="aside-panel-inner">
		
		<div class="aside-panel-close">
			<a class="heim-icon-close">
				<span class="screen-reader-text"><?php esc_html_e( 'Close', 'heim' ); ?></span>
			</a>
		</div>

		<?php
		/**
		 * Hook: heim_before_mobile_menu
		 *
		 * @hooked heim_mobile_menu_product_categories - 10
		 */
		do_action( 'heim_before_mobile_menu' );
		?>
		
		<div class="aside-mobile-menus-container">
		
			<?php
			if ( has_nav_menu( 'mobile' ) ) {
				// Menu: Mobile
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'menu_class'     => 'aside-mobile-menu-wrapper',
						'container'      => false,
						'items_wrap'     => '<ul id="aside-mobile-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'    => false,
					)
				);
			} else if ( has_nav_menu( 'primary' ) ) {
				// Menu: Primary
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'aside-mobile-menu-wrapper',
						'container'      => false,
						'items_wrap'     => '<ul id="aside-mobile-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'    => false,
					)
				);
			}

			if ( has_nav_menu( 'mobile-secondary' ) ) {
				// Menu: Mobile secondary
				wp_nav_menu(
					array(
						'theme_location' => 'mobile-secondary',
						'menu_class'     => 'aside-mobile-menu-wrapper',
						'container'      => false,
						'items_wrap'     => '<ul id="aside-mobile-secondary-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'    => false,
					)
				);
			}
			?>
		
		</div>
			
		<?php
		/**
		 * Hook: heim_after_mobile_menu
		 *
		 * @hooked heim_mobile_menu_footer - 10
		 */
		do_action( 'heim_after_mobile_menu' );
		?>
		
	</div>
</div>
