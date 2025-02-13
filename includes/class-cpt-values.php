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
						'template-1'      => array(
							'label' => __( 'Template 1', 'ri-woo-labels' ),
							'style' => array(
								'padding'       => '1.2px 12px 1.2px 12px',
								'border-radius' => '15px 15px 15px 15px',
							),
						),
						'template-2'      => array(
							'label' => __( 'Template 2', 'ri-woo-labels' ),
							'style' => array(
								'padding'   => '1.2px 12px 1.2px 12px',
								'clip-path' => 'polygon(10% 0%, 90% 0%, 100% 100%, 0% 100%)',
							),
						),
						'template-3'      => array(
							'label' => __( 'Template 3', 'ri-woo-labels' ),
							'style' => array(
								'padding'       => '1.2px 12px 1.2px 12px',
								'border-radius' => '1.2px 12px 1.2px 12px',
							),
						),
						'template-4'      => array(
							'label' => __( 'Template 4', 'ri-woo-labels' ),
							'style' => array(
								'padding'       => '1.2px 12px 1.2px 12px',
								'border-radius' => '12px 1.2px 12px 1.2px',
							),
						),
						'template-5'      => array(
							'label' => __( 'Template 5', 'ri-woo-labels' ),
							'style' => array(),
						),
						'template-circle' => array(
							'label' => __( 'Circle', 'ri-woo-labels' ),
							'style' => array(
								'padding' => '5px 5px 5px 5px',
							),
						),

					),
				),
				'ri_wl_label_setting_predefined_colors' => array(
					'type'    => 'radio',
					'label'   => __( 'Predefined Colors', 'ri-woo-labels' ),
					'options' => array(
						'color-1'  => array(
							'label' => __( 'Color 1', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#edf2f7',
								'color'            => '#2d3748',
							),
						),
						'color-2'  => array(
							'label' => __( 'Color 2', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#fed7d7',
								'color'            => '#9b2c2c',
							),
						),
						'color-3'  => array(
							'label' => __( 'Color 3', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#feebc8',
								'color'            => '#9c4221',
							),
						),
						'color-4'  => array(
							'label' => __( 'Color 4', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#fefcbf',
								'color'            => '#975a16',
							),
						),
						'color-5'  => array(
							'label' => __( 'Color 5', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#c6f6d5',
								'color'            => '#276749',
							),
						),
						'color-6'  => array(
							'label' => __( 'Color 6', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#b2f5ea',
								'color'            => '#285e61',
							),
						),
						'color-7'  => array(
							'label' => __( 'Color 7', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#bee3f8',
								'color'            => '#2c5282',
							),
						),
						'color-8'  => array(
							'label' => __( 'Color 8', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#e9d8fd',
								'color'            => '#553c9a',
							),
						),
						'color-9'  => array(
							'label' => __( 'Color 9', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#c3dafe',
								'color'            => '#434190',
							),
						),
						'color-10' => array(
							'label' => __( 'Color 10', 'ri-woo-labels' ),
							'style' => array(
								'background-color' => '#fed7e2',
								'color'            => '#97266d',
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
					'default' => '#edf2f7',
				),
				'ri_wl_label_setting_text_color'       => array(
					'type'    => 'color',
					'label'   => __( 'Text Color', 'ri-woo-labels' ),
					'default' => '#2d3748',
				),
				'ri_wl_label_setting_padding'          => array(
					'type'  => 'four-numbers',
					'label' => __( 'Padding (px)', 'ri-woo-labels' ),
				),
				'ri_wl_label_setting_border_radius'    => array(
					'type'  => 'four-numbers',
					'label' => __( 'Border Radius (px)', 'ri-woo-labels' ),
				),
				'ri_wl_label_setting_margin'           => array(
					'type'  => 'four-numbers',
					'label' => __( 'Margin (px)', 'ri-woo-labels' ),
				),
			);

			return $values;
		}


		public static function get_label_variables() {
			$values = array(
				'%%quantity%%'        => __( 'Show product stock quantity.', 'ri-woo-labels' ),
				'%%price%%'           => __( 'Show product price.', 'ri-woo-labels' ),
				// '%%regular_price%%'   => __( 'Show product regular price.', 'ri-woo-labels' ),
				// '%%sale_price%%'      => __( 'Show product sale price.', 'ri-woo-labels' ),
				'%%save_amount%%'     => __( 'Show save amount on sale (regular price - sale price).', 'ri-woo-labels' ),
				'%%discount%%'        => __( 'Show discount percentage (sale price / regular price).', 'ri-woo-labels' ),
				'%%total_sales%%'     => __( 'Show product total sales.', 'ri-woo-labels' ),
				'%%date_on_sale_to%%' => __( 'Show product ending sale date.', 'ri-woo-labels' ),
				'%%rating%%'          => __( 'Show product average rating.', 'ri-woo-labels' ),
				'%%reviews_count%%'   => __( 'Show product reviews count.', 'ri-woo-labels' ),
			);

			return $values;
		}
	}
}
