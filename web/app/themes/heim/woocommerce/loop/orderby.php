<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 Heim: Modified - 1. Added class-name, "data" attributes and icon tag -- 2. Renamed $id to $nm_id to avoid PHPCS error */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heim_default_orderby = heim_woocommerce_catalog_orderby_get_default();
$heim_select_active_class = ( $orderby !== $heim_default_orderby ) ? ' is-active' : '';
$heim_select_label = ( isset( $catalog_orderby_options[$orderby] ) ) ? $catalog_orderby_options[$orderby] : esc_html__( 'Sorting', 'woocommerce' );

?>
<form class="woocommerce-ordering<?php echo esc_attr( $heim_select_active_class ); ?>" method="get" data-select-label="<?php echo esc_attr( $heim_select_label ); ?>" data-select-default="<?php echo esc_attr( $heim_default_orderby ); ?>">
	<i class="heim-icon-angle-down"></i>
	<select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>">
		<?php foreach ( $catalog_orderby_options as $nm_id => $name ) : ?>
			<option value="<?php echo esc_attr( $nm_id ); ?>" <?php selected( $orderby, $nm_id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
</form>
