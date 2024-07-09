<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Values' ) ) {
	class Ri_WL_CPT_Values {

		public function get_default_values() {
			$values = array(
				'position' => 'on_image',
			);

			return $values;
		}
	}
}
