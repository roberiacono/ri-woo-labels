<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_Display' ) ) {
	class Ri_WL_Label_Display {

		public function __construct() {
			// add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'display_label_before_title' ) );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'display_label_on_image' ) );
		}

		public function get_product_labels( $product_id ) {
			global $product;
			$view       = new Ri_WL_Label_View();
			$labels_ids = Ri_WL_Helpers::get_all_labels();

			$pruduct_labels = array();

			foreach ( $labels_ids as $label_id ) {
				print_r( $label_id );
				$type = get_post_meta( $label_id, '_type_meta_key', true );
				// echo $type;

				if ( $product->is_on_sale() && $type === 'sale' ) {
					array_push( $pruduct_labels, $view->get_html( $label_id ) );
				}
				return $pruduct_labels;
			}
		}


		public function display_label_on_image() {
			global $product;
			$product_id = $product->get_id();

			$labels = $this->get_product_labels( $product_id );

			if ( empty( $labels ) ) {
				return;
			}

			foreach ( $labels as $label ) {
				echo $label;
			}
		}
	}
}
