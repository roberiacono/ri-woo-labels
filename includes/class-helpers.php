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
	}
}
