<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Helpers' ) ) {
	class Ri_WL_Helpers {

		public static function get_all_labels() {
			$labels = get_posts(
				array(
					'post_type'      => 'woo-label',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby'        => 'meta_value_num date',
					'order'          => 'DESC',
					'fields'         => 'ids',
					'no_found_rows'  => 1,
				)
			);
			return $labels;
		}

		public static function get_bestseller_last_n_days() {
			$all_orders = wc_get_orders(
				array(
					'limit'      => -1,
					'status'     => array( 'wc-completed' ),
					'type'       => 'shop_order',
					'date_after' => date( 'Y-m-d', strtotime( '-365 days' ) ),
					'return'     => 'ids',
				)
			);
			$trending   = array();
			foreach ( $all_orders as $all_order ) {
				$order = wc_get_order( $all_order );
				$items = $order->get_items();
				foreach ( $items as $item ) {
					$product_id = $item->get_product_id();
					if ( ! $product_id ) {
						continue;
					}
					$trending[ $product_id ] = isset( $trending[ $product_id ] ) ? (int) $trending[ $product_id ] + $item['qty'] : $item['qty'];
				}
			}

			arsort( $trending, SORT_NUMERIC );

			return array_keys( array_slice( $trending, 0, 10, true ) );
		}

		public static function is_new_page() {
			global $pagenow;
			// make sure we are on the backend
			if ( ! is_admin() ) {
				return false;
			}

			return in_array( $pagenow, array( 'post-new.php' ) );
		}
	}
}
