<?php
/**
 * Displays the footer widget area
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
	
	<aside class="site-footer-widgets">
		<div class="widget-area page-max-width">
			<?php dynamic_sidebar( 'footer-widgets' ); ?>
		</div>
	</aside><!-- .widget-area -->

<?php endif; ?>
