<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Label_View' ) ) {
	class Ri_WL_Label_View {

		public function get_html( $label_id ) {
			$text  = 'Label ' . $label_id;
			$style = $this->get_style();
			$html  = '<div class=="" style="' . esc_attr( $style ) . '">' . $text . '</div>';
			return $html;
		}

		public function get_style() {
			$style = array(
				'position: absolute;',
				'top: 0;',
				'background-color: #f00;',
			);
			$style = implode( ' ', $style );
			return $style;
		}
	}
}
