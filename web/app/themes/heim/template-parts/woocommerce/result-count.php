<?php
/**
 * Result Count
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total = $args['total'];
?>
<p class="woocommerce-result-count">
	<?php
	/* translators: %s: total results */
	printf( esc_html( _n( '%s product', '%s products', $total, 'woocommerce' ) ), intval( $total ) );
	?>
</p>
