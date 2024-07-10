<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Woo_Image_Wrapper' ) ) {
	class Ri_WL_Woo_Image_Wrapper {

		public function __construct() {
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'action_woocommerce_before_shop_loop_item' ), 5 );
			add_action( 'woocommerce_shop_loop_item_title', array( $this, 'action_woocommerce_after_shop_loop_item' ), 5 );
		}
		// Add DIV start element before shop loop item
		public function action_woocommerce_before_shop_loop_item() {
			echo "<div class='ri_wl_div_wrapper' style='position: relative;'>";
		}

		// Add DIV end element after shop loop item
		public function action_woocommerce_after_shop_loop_item() {
			echo '</div>';
		}
	}
}
