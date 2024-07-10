<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_View' ) ) {
	class Ri_WL_Label_View {

		public function get_html( $label_id ) {
			$text  = 'Label ' . $label_id;
			$style = $this->get_style( $label_id );
			$html  = '<div class=="" style="' . esc_attr( $style ) . '">' . $text . '</div>';
			return $html;
		}

		public function get_style( $label_id ) {

			$where_to_display = get_post_meta( $label_id, '_ri_wl_label_setting_where', true );

			if ( $where_to_display === 'on_image' ) {
				$style = array(
					'position: absolute;',
					'top: 0;',
					'background-color: #f00;',
				);
				$style = implode( ' ', $style );
			} elseif ( $where_to_display === 'before_title' ) {
				$style = array(
					'background-color: #0f0;',
				);
				$style = implode( ' ', $style );
			}

			return $style;
		}
	}
}
