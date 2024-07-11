<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_Display' ) ) {
	class Ri_WL_Label_Display {

		public function __construct() {
			// add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'display_label_before_title' ) );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'display_label_on_image' ) );
			add_action( 'woocommerce_shop_loop_item_title', array( $this, 'display_label_before_title' ), 9 );
		}

		public function get_product_labels( $product_id, $where_to_display ) {
			global $product;
			$view       = new Ri_WL_Label_View();
			$labels_ids = Ri_WL_Helpers::get_all_labels();

			$pruduct_labels = array();

			foreach ( $labels_ids as $label_id ) {

				if ( $where_to_display !== get_post_meta( $label_id, '_ri_wl_label_setting_where', true ) ) {
					continue;
				}

				$label_conditions = Ri_WL_CPT_Conditions::get_label_conditions( $label_id );

				if ( $this->should_display_label_for_this_product( $label_conditions, $label_id ) ) {
					if ( $where_to_display === 'on_image' ) {
						$position = get_post_meta( $label_id, '_ri_wl_label_setting_position', true );
						if ( ! isset( $pruduct_labels[ $position ] ) ) {
							$pruduct_labels[ $position ] = array();
						}
						array_push( $pruduct_labels[ $position ], $view->get_html( $label_id ) );
					} else {
						array_push( $pruduct_labels, $view->get_html( $label_id ) );
					}
				}
			}
			return $pruduct_labels;
		}

		public function should_display_label_for_this_product( $label_conditions, $label_id ) {
			global $product;
			$product_id = $product->get_id();

			if ( ! $label_conditions ) {
				return false;
			}

			$should_display_label_for_this_product = true;
			foreach ( $label_conditions as $condition ) {

				if ( ! $should_display_label_for_this_product ) {
					return $should_display_label_for_this_product;
				}

				switch ( $condition['type'] ) {
					case 'is_on_sale':
						if ( $condition['compare'] === 'equal' ) {
							if ( $condition['value'] === 'yes' && ! $product->is_on_sale() ) {
								$should_display_label_for_this_product = false;
							} elseif ( $condition['value'] === 'no' && $product->is_on_sale() ) {
								$should_display_label_for_this_product = false;
							}
						}
						break;
					case 'product_category':
						if ( $condition['compare'] === 'equal' ) {
							if ( ! has_term( $condition['value'], 'product_cat', $product_id ) ) {
								$should_display_label_for_this_product = false;
							}
						} elseif ( $condition['compare'] === 'not-equal' ) {
							if ( has_term( $condition['value'], 'product_cat', $product_id ) ) {
								$should_display_label_for_this_product = false;
							}
						}
						break;
				}
			}
			return $should_display_label_for_this_product;
		}


		public function display_label_on_image() {
			global $product;
			$product_id = $product->get_id();

			$labels = $this->get_product_labels( $product_id, 'on_image' );

			if ( empty( $labels ) || count( $labels ) === 0 ) {
				return;
			}

			foreach ( $labels as $key => $value ) {

				$style    = array();
				$position = $key;
				if ( $position === 'top-left' ) {
					$style[] = 'top: 0;';
					$style[] = 'left: 0;';
				} elseif ( $position === 'top-right' ) {
					$style[] = 'top: 0;';
					$style[] = 'right: 0;';
				} elseif ( $position === 'bottom-right' ) {
					$style[] = 'bottom: 0;';
					$style[] = 'right: 0;';
				} elseif ( $position === 'bottom-left' ) {
					$style[] = 'bottom: 0;';
					$style[] = 'left: 0;';
				}
				$style = implode( ' ', $style );

				echo '<div class="ri-woo-labels-container" style="position: absolute; display: flex; gap: 0.5rem; ' . esc_attr( $style ) . '">' . implode( ' ', $value ) . '</div>';
				error_log( print_r( wc_get_image_size( 'woocommerce_thumbnail' ), true ) );
			}
		}

		public function display_label_before_title() {
			global $product;
			$product_id = $product->get_id();

			$labels = $this->get_product_labels( $product_id, 'before_title' );

			if ( empty( $labels ) ) {
				return;
			}

			foreach ( $labels as $label ) {
				echo '<div class="ri-woo-labels-container" style="display: flex; gap: 0.5rem; justify-content: center; margin-bottom: 10px;" >' . $label . '</div>';
			}
		}
	}
}
