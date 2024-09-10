<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.7.0
 Heim: Modified - 1. See comments -- 2. Added escaping for PHPCS (see "NM: Escaped" comments) */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Heim: Is AJAX pagination enabled?
$heim_is_ajax_pagination = ( is_woocommerce() && 'standard' !== Heim_Customize::get_setting( 'shop_ajax_pagination' ) ) ? true : false;

?>
<p class="woocommerce-result-count">
	<?php
	// phpcs:disable WordPress.Security
	if ( 1 === intval( $total ) ) {
		esc_html_e( 'Showing the single result', 'woocommerce' ); // NM: Escaped
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		/* translators: %d: total results */
		echo esc_html( sprintf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'woocommerce' ), $total ) ); // NM: Escaped (changed to "sprintf" to allow escaping)
	} else {
		$first = ( $heim_is_ajax_pagination ) ? 1 : ( $per_page * $current ) - $per_page + 1; // Heim: Added conditional
		$last  = min( $total, $per_page * $current );
		
		// Heim: Added conditional
		if ( $total === $last ) {
			/* translators: %d: total results */
			echo esc_html( sprintf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'woocommerce' ), $total ) ); // Heim: Text to display when all pages/products are loaded with AJAX
		} else {
			/* translators: 1: first result 2: last result 3: total results */
			echo esc_html( sprintf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'woocommerce' ), $first, $last, $total ) ); // NM: Escaped (changed to "sprintf" to allow escaping)
		}
	}
	// phpcs:enable WordPress.Security
	?>
</p>
