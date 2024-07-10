<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Values' ) ) {
	class Ri_WL_CPT_Values {

		public static function get_meta_box_settings_values() {
			$values = array(
				'ri_wl_label_setting_where'    => array(
					'type'        => 'select',
					'label'       => __( 'Where?', 'ri-woo-labels' ),
					'description' => __( 'Where do you want to display the label?', 'ri-woo-labels' ),
					'options'     => array(
						'on_image'     => __( 'On Image', 'ri-woo-labels' ),
						'before_title' => __( 'Before Title', 'ri-woo-labels' ),
					),
				),
				'ri_wl_label_setting_position' => array(
					'type'    => 'select',
					'label'   => __( 'Position', 'ri-woo-labels' ),
					'options' => array(
						'top-left'     => __( 'Top-Left', 'ri-woo-labels' ),
						'top-right'    => __( 'Top-Right', 'ri-woo-labels' ),
						'bottom-right' => __( 'Bottom-Right', 'ri-woo-labels' ),
						'bottom-left'  => __( 'Bottom-Left', 'ri-woo-labels' ),
					),
				),
			);

			return $values;
		}
	}
}
