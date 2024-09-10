<?php
/**
 * Displays the primary header menu
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<nav class="site-menu-primary" aria-label="<?php esc_attr_e( 'Primary menu', 'heim' ); ?>">
	
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
	<?php endif; ?>
	
</nav><!-- .site-menu-primary -->
