<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Custom_Post_Type' ) ) {
	class Ri_WL_Custom_Post_Type {
		public function __construct() {
			add_action( 'init', array( $this, 'register_ri_woo_labels_post_type' ) );
		}

		public function register_ri_woo_labels_post_type() {
			register_post_type(
				'woo-label',
				array(
					'label'        => 'Woo Labels',
					'menu_icon'    => 'dashicons-nametag',
					'show_ui'      => true,
					'show_in_menu' => true,
					'supports'     => array( 'title' ),
				)
			);
		}
	}
}
