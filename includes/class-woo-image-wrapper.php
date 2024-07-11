<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Woo_Image_Wrapper' ) ) {
	class Ri_WL_Woo_Image_Wrapper {

		public function __construct() {
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'action_woocommerce_before_shop_loop_item' ), 9 );
			add_action( 'woocommerce_shop_loop_item_title', array( $this, 'action_woocommerce_after_shop_loop_item' ), 8 );
		}
		// Add DIV start element before shop loop item
		public function action_woocommerce_before_shop_loop_item() {
			$thumbnail_size = wc_get_image_size( 'woocommerce_thumbnail' );
			echo "<div class='ri_wl_div_wrapper' style='position: relative; max-width: " . $thumbnail_size['width'] . "px; margin: 0 auto;'>";
		}

		// Add DIV end element after shop loop item
		public function action_woocommerce_after_shop_loop_item() {
			echo '</div>';
		}
	}
}
