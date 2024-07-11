<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_View' ) ) {
	class Ri_WL_Label_View {

		public function get_html( $label_id ) {
			$text  = get_post_meta( $label_id, '_ri_wl_label_setting_text', true );
			$text  = $this->replace_variables_in_text( $text );
			$style = $this->get_style( $label_id );
			$html  = '<span class="" style="' . esc_attr( $style ) . '">' . $text . '</span>';
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

			$style = implode( ' ', $style );

			return $style;
		}

		public function replace_variables_in_text( $text ) {
			$var = '%%quantity%%';
			if ( strpos( $text, $var ) !== false ) {
				/*
				$product = wc_get_product( $post_id );
				$product->get_price(); */
				$text = str_replace( $var, '99', $text );
			}
			return $text;
		}
	}
}
