<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Conditions' ) ) {
	class Ri_WL_CPT_Conditions {

		public static function get_default_conditions() {
			$categories = self::get_woo_categories();
			// $conditions = ri_woo_labels()->get_default_conditions();

			$equal_not_equal = array(
				'equal'     => __( 'Equal', 'ri-woo-labels' ),
				'not-equal' => __( 'Not Equal', 'ri-woo-labels' ),
			);
			$yes_no          = array(
				'yes' => __( 'Yes', 'ri-woo-labels' ),
				'no'  => __( 'No', 'ri-woo-labels' ),
			);

			$conditions = array(
				'bestseller'       => array(
					'label'   => __( 'Bestseller Product', 'ri-woo-labels' ),
					'compare' => $equal_not_equal,
					'values'  => $yes_no,
				),
				'featured'         => array(
					'label'   => __( 'Featured Product', 'ri-woo-labels' ),
					'compare' => $equal_not_equal,
					'values'  => $yes_no,
				),
				'is_on_sale'       => array(
					'label'   => __( 'Is On Sale', 'ri-woo-labels' ),
					'compare' => array(
						'equal' => __( 'Equal', 'ri-woo-labels' ),
					),
					'values'  => $yes_no,
				),
				'out-of-stock'     => array(
					'label'   => __( 'Out Of Stock Product', 'ri-woo-labels' ),
					'compare' => $equal_not_equal,
					'values'  => $yes_no,
				),
				'product_category' => array(
					'label'   => __( 'Product Category', 'ri-woo-labels' ),
					'compare' => $equal_not_equal,
					'values'  => $categories,
				),
			);

			return $conditions;
		}

		public static function get_label_conditions( $post_id ) {
			$conditions = get_post_meta( $post_id, '_ri_woo_labels_conditions', true );
			if ( ! $conditions ) {
				return false;
			}
			$conditions = maybe_unserialize( $conditions );
			return $conditions;
		}

		public function get_default_comparison() {
			$comparison = array(
				'is_on_sale' => 'on_image',
			);

			return $comparison;
		}

		public static function get_woo_categories() {
			$taxonomy     = 'product_cat';
			$orderby      = 'name';
			$show_count   = 0;      // 1 for yes, 0 for no
			$pad_counts   = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no
			$title        = '';
			$empty        = 0;

			$args           = array(
				'taxonomy'     => $taxonomy,
				'orderby'      => $orderby,
				'show_count'   => $show_count,
				'pad_counts'   => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li'     => $title,
				'hide_empty'   => $empty,
			);
			$all_categories = get_categories( $args );
			$categories     = array();

			foreach ( $all_categories as $cat ) {
				$categories[ $cat->slug ] = $cat->name;
			}

			return $categories;
			/*
			foreach ( $all_categories as $cat ) {
				if ( $cat->category_parent == 0 ) {
					$category_id = $cat->term_id;
					echo '<br /><a href="' . get_term_link( $cat->slug, 'product_cat' ) . '">' . $cat->name . '</a>';

					$args2    = array(
						'taxonomy'     => $taxonomy,
						'child_of'     => 0,
						'parent'       => $category_id,
						'orderby'      => $orderby,
						'show_count'   => $show_count,
						'pad_counts'   => $pad_counts,
						'hierarchical' => $hierarchical,
						'title_li'     => $title,
						'hide_empty'   => $empty,
					);
					$sub_cats = get_categories( $args2 );
					if ( $sub_cats ) {
						foreach ( $sub_cats as $sub_category ) {
							echo $sub_category->name;
						}
					}
				}
			} */
		}
	}
}
