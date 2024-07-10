<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Values' ) ) {
	class Ri_WL_CPT_Values {

		public static function get_meta_box_settings_values() {
			$values = array(
				'ri_wl_label_setting_text'     => array(
					'type'  => 'text',
					'label' => __( 'Text', 'ri-woo-labels' ),
				),
				'ri_wl_label_setting_template' => array(
					'type'    => 'radio',
					'label'   => __( 'Template', 'ri-woo-labels' ),
					'options' => array(
						'template-1' => array(
							'label' => __( 'Template 1', 'ri-woo-labels' ),
							'style' => 'background-color: blue;	color: white; clip-path: polygon(10% 0%, 90% 0%, 100% 100%, 0% 100%); padding: 5px 20px;',
						),
						'template-2' => array(
							'label' => __( 'Template 2', 'ri-woo-labels' ),
							'style' => 'background-color: yellow; border-radius: 15px; padding: 5px 20px;',
						),
					),
				),
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
