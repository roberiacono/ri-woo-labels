<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_View' ) ) {
	class Ri_WL_Label_View {

		public function get_html( $label_id ) {
			$text     = get_post_meta( $label_id, '_ri_wl_label_setting_text', true );
			$text     = $this->replace_variables_in_text( $text );
			$template = get_post_meta( $label_id, '_ri_wl_label_setting_template', true );
			$style    = $this->get_style( $label_id );

			$inline_css = '.ri-wl_span-container.' . $template . '.' . $template . '-' . $label_id . ':before {
				border-color: ' . get_post_meta( $label_id, '_ri_wl_label_setting_background_color', true ) . ';
			}';
			echo '<style>' . esc_html( $inline_css ) . '</style>';

			$html = '<div class="ri-wl_span-container ' . $template . ' ' . $template . '-' . $label_id . '" style="' . $style . '"><span>' . $text . '</span></div>';
			return $html;
		}

		public function get_style( $label_id ) {

			$where_to_display = get_post_meta( $label_id, '_ri_wl_label_setting_where', true );

			$style = array();

			$background_color = get_post_meta( $label_id, '_ri_wl_label_setting_background_color', true );
			if ( $background_color ) {
				$style[] = 'background-color: ' . $background_color . ';';
			}

			$text_color = get_post_meta( $label_id, '_ri_wl_label_setting_text_color', true );
			if ( $text_color ) {
				$style[] = 'color: ' . $text_color . ';';
			}

			$padding = get_post_meta( $label_id, '_ri_wl_label_setting_padding', true );
			if ( $padding ) {
				$padding = maybe_unserialize( $padding );
				$style[] = 'padding: ' . $padding[0] . 'px ' . $padding[1] . 'px ' . $padding[2] . 'px ' . $padding[3] . 'px;';
			}

			$border_radius = get_post_meta( $label_id, '_ri_wl_label_setting_border_radius', true );
			if ( $border_radius ) {
				$border_radius = maybe_unserialize( $border_radius );
				$style[]       = 'border-radius: ' . $border_radius[0] . 'px ' . $border_radius[1] . 'px ' . $border_radius[2] . 'px ' . $border_radius[3] . 'px;';
			}

			$margin = get_post_meta( $label_id, '_ri_wl_label_setting_margin', true );
			if ( $margin ) {
				$margin  = maybe_unserialize( $margin );
				$style[] = 'margin: ' . $margin[0] . 'px ' . $margin[1] . 'px ' . $margin[2] . 'px ' . $margin[3] . 'px;';
			}

			$style = implode( ' ', $style );

			return $style;
		}

		public function replace_variables_in_text( $text ) {
			global $product;
			$variables = Ri_WL_CPT_Values::get_label_variables();
			if ( strpos( $text, '%%' ) !== false ) {
				foreach ( $variables as $key => $value ) {
					if ( strpos( $text, $key ) !== false ) {
						switch ( $key ) {
							case '%%quantity%%':
								$text = str_replace( $key, $product->get_stock_quantity(), $text );
								break;
							case '%%price%%':
									$text = str_replace( $key, $product->get_price(), $text );
								break;
							case '%%regular_price%%':
									$text = str_replace( $key, $product->get_regular_price(), $text );
								break;
							case '%%sale_price%%':
									$text = str_replace( $key, $product->get_sale_price(), $text );
								break;
							case '%%save_amount%%':
								if ( $product->is_type( 'grouped' ) ) {

									$children = $product->get_children();
									$prices   = array();
									foreach ( $children as $key => $value ) {
											$_product = wc_get_product( $value );
										if ( $_product->is_on_sale() ) {
											$sale_price    = $_product->get_sale_price() ? $_product->get_sale_price() : $_product->get_variation_sale_price( 'min' );
											$regular_price = $_product->get_regular_price() ? $_product->get_regular_price() : $_product->get_variation_regular_price( 'min' );
											if ( ( isset( $prices['sale_price'] ) && $sale_price < $prices['sale_price'] ) || ! isset( $prices['sale_price'] ) ) {
												$prices['sale_price']    = $sale_price;
												$prices['regular_price'] = $regular_price;
											}
										}
									}
									$regular_price = $prices['regular_price'];
									$sale_price    = $prices['sale_price'];

								} else {
									$regular_price = $product->get_regular_price() ? $product->get_regular_price() : $product->get_variation_regular_price( 'min' );
									$sale_price    = $product->get_sale_price() ? $product->get_sale_price() : $product->get_variation_sale_price( 'min' );
								}
								$save_amount = $regular_price - $sale_price;
									$text    = str_replace( $key, $save_amount, $text );
								break;
							case '%%discount%%':
								if ( $product->is_type( 'grouped' ) ) {

									$children = $product->get_children();
									$prices   = array();
									foreach ( $children as $key2 => $value2 ) {
											$_product = wc_get_product( $value2 );
										if ( $_product->is_on_sale() ) {
											$sale_price    = $_product->get_sale_price() ? $_product->get_sale_price() : $_product->get_variation_sale_price( 'min' );
											$regular_price = $_product->get_regular_price() ? $_product->get_regular_price() : $_product->get_variation_regular_price( 'min' );
											if ( ( isset( $prices['sale_price'] ) && $sale_price < $prices['sale_price'] ) || ! isset( $prices['sale_price'] ) ) {
												$prices['sale_price']    = $sale_price;
												$prices['regular_price'] = $regular_price;
											}
										}
									}
									$regular_price = $prices['regular_price'];
									$sale_price    = $prices['sale_price'];

								} else {
									$regular_price = $product->get_regular_price() ? $product->get_regular_price() : $product->get_variation_regular_price( 'min' );
									$sale_price    = $product->get_sale_price() ? $product->get_sale_price() : $product->get_variation_sale_price( 'min' );
								}
									$discount = 100 - ceil( $sale_price / $regular_price * 100 );
									$text     = str_replace( $key, $discount, $text );
								break;
							case '%%total_sales%%':
									$text = str_replace( $key, $product->get_total_sales(), $text );
								break;
							case '%%date_on_sale_to%%':
									$text = str_replace( $key, $product->get_date_on_sale_to(), $text );
								break;
							case '%%rating%%':
									$text = str_replace( $key, $product->get_average_rating(), $text );
								break;
							case '%%reviews_count%%':
									$text = str_replace( $key, $product->get_review_count(), $text );
								break;
						}
					}
				}
			}
			return $text;
		}
	}
}
