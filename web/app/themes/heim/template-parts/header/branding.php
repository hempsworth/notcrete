<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage Heim
 * @since 1.0
 */

?>

<div class="site-branding">
	
	<?php
	/**
	 * Hook: heim_before_header
	 *
	 * @hooked heim_header_logo - 5
	 * @hooked heim_header_mobile_logo - 10
	 */
	do_action( 'heim_header_branding' );
	?>

</div><!-- .site-branding -->
