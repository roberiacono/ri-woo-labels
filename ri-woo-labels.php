<?php
/*
Plugin Name: RI Woo Labels
Description: Add custom labels to WooCommerce products
Version: 1.0.0
Author: Roberto Iacono
Text Domain: ri-woo-labels
Domain Path: /languages
*/

defined( 'ABSPATH' ) || exit;


if ( ! defined( 'RI_WOO_LABELS_PLUGIN_VERSION' ) ) {
	define( 'RI_WOO_LABELS_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'RI_WOO_LABELS_PLUGIN_FILE' ) ) {
	define( 'RI_WOO_LABELS_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'Ri_Woo_Labels', false ) ) {
	include_once dirname( RI_WOO_LABELS_PLUGIN_FILE ) . '/includes/class-ri-woo-labels.php';
}

/**
 * Returns the main instance of RI_WOO_LABELS_PLUGIN.
 *
 * @since  1.5
 * @return Ri_Woo_Labels
 */
if ( ! function_exists( 'ri_woo_labels' ) ) {
	function ri_woo_labels() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
		return Ri_Woo_Labels::get_instance();
	}

	ri_woo_labels();
}
