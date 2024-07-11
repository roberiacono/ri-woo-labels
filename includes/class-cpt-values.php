<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Values' ) ) {
	class Ri_WL_CPT_Values {

		public static function get_meta_box_settings_values() {
			$values = array(
				'ri_wl_label_setting_text'              => array(
					'type'  => 'text',
					'label' => __( 'Text', 'ri-woo-labels' ),
				),
				'ri_wl_label_setting_template'          => array(
					'type'    => 'radio',
					'label'   => __( 'Template', 'ri-woo-labels' ),
					'options' => array(
						'template-1' => array(
							'label' => __( 'Template 1', 'ri-woo-labels' ),
							'style' => array(
								'padding'       => '3px 7px 3px 7px',
								'border-radius' => '15px 15px 15px 15px',
							),
						),
						'template-2' => array(
							'label' => __( 'Template 2', 'ri-woo-labels' ),
							'style' => array(
								'padding'   => '3px 10px 3px 10px',
								'clip-path' => 'polygon(10% 0%, 90% 0%, 100% 100%, 0% 100%)',
							),
						),
						/*
						'template-3' => array(
							'label' => __( 'Template 3', 'ri-woo-labels' ),
							'style' => '',
						), */
					),
				),
				'ri_wl_label_setting_predefined_colors' => array(
					'type'    => 'radio',
					'label'   => __( 'Predefined Colors', 'ri-woo-labels' ),
					'options' => array(
						'colors-1' => array(
							'label' => __( 'Color 1', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#fed7d7',
								'color'            => '#9b2c2c',
							),
						),
						'colors-2' => array(
							'label' => __( 'Color 2', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#fefcbf',
								'color'            => '#975a16',
							),
						),
					),
				),
				'ri_wl_label_setting_where'             => array(
					'type'        => 'select',
					'label'       => __( 'Where?', 'ri-woo-labels' ),
					'description' => __( 'Where do you want to display the label?', 'ri-woo-labels' ),
					'options'     => array(
						'on_image'     => __( 'On Image', 'ri-woo-labels' ),
						'before_title' => __( 'Before Title', 'ri-woo-labels' ),
					),
				),
				'ri_wl_label_setting_position'          => array(
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

		public static function get_meta_box_settings_style_values() {
			$values = array(
				'ri_wl_label_setting_background_color' => array(
					'type'    => 'color',
					'label'   => __( 'Background Color', 'ri-woo-labels' ),
					'default' => '#fafafa',
				),
				'ri_wl_label_setting_text_color'       => array(
					'type'    => 'color',
					'label'   => __( 'Text Color', 'ri-woo-labels' ),
					'default' => '#ffffff',
				),
				'ri_wl_label_setting_padding'          => array(
					'type'  => 'four-numbers',
					'label' => __( 'Padding (px)', 'ri-woo-labels' ),
				),
				'ri_wl_label_setting_border_radius'    => array(
					'type'  => 'four-numbers',
					'label' => __( 'Border Radius (px)', 'ri-woo-labels' ),
				),
			);

			return $values;
		}
	}
}
