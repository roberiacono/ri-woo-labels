<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Meta_Box' ) ) {
	class Ri_WL_CPT_Meta_Box {
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		public function register_meta_boxes() {
			add_meta_box(
				'ri-woo-labels-cpt-metabox',
				__( 'Woo Labels', 'ri-woo-labels' ),
				array( $this, 'meta_box' ),
				'woo-label'
			);
		}

		public function meta_box() {
			echo 'Foo';
		}
	}
}
