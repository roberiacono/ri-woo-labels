<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_Admin_Menu' ) ) {
	class Ri_WL_Admin_Menu {
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_submenu_pages' ) );
		}

		public function add_submenu_pages() {

			add_submenu_page(
				'edit.php?post_type=woo-label',
				__( 'Woo Labels Settings', 'ri-woo-labels' ),
				__( 'Settings', 'ri-woo-labels' ),
				'manage_options',
				'ri-woo-labels-settings',
				array( $this, 'render_settings_page' ),
			);
		}

		public function render_settings_page() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/page-settings.php';
		}
	}
}
