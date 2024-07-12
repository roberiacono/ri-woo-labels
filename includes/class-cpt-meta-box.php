<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Ri_WL_CPT_Meta_Box' ) ) {
	class Ri_WL_CPT_Meta_Box {
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_meta_box' ) );
		}

		public function register_meta_boxes() {
			add_meta_box(
				'ri-woo-labels-cpt-settings-meta-box',
				__( 'Settings', 'ri-woo-labels' ),
				array( $this, 'render_settings_meta_box' ),
				'woo-label'
			);

			add_meta_box(
				'ri-woo-labels-cpt-custom-style-meta-box',
				__( 'Custom Style', 'ri-woo-labels' ),
				array( $this, 'render_custom_style_meta_box' ),
				'woo-label'
			);

			add_meta_box(
				'ri-woo-labels-cpt-conditions-meta-box',
				__( 'Conditions', 'ri-woo-labels' ),
				array( $this, 'render_conditions_meta_box' ),
				'woo-label'
			);

			add_meta_box(
				'ri-woo-labels-cpt-variables-meta-box',
				__( 'Variables', 'ri-woo-labels' ),
				array( $this, 'render_variables_meta_box' ),
				'woo-label'
			);

			add_meta_box(
				'ri-woo-labels-cpt-preview-meta-box',
				__( 'Preview', 'ri-woo-labels' ),
				array( $this, 'render_preview_meta_box' ),
				'woo-label',
				'side'
			);
		}

		/**
		 * Renders meta boxes.
		 */
		public function render_settings_meta_box() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/meta-box-label-settings.php';
		}

		public function render_custom_style_meta_box() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/meta-box-label-custom-style.php';
		}

		public function render_conditions_meta_box() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/meta-box-label-conditions.php';
		}

		public function render_variables_meta_box() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/meta-box-label-variables.php';
		}

		public function render_preview_meta_box() {
			require_once RI_WOO_LABELS_PLUGIN_DIR . 'templates/meta-box-label-preview.php';
		}



		/**
		 * Save meta box content.
		 *
		 * @param int $post_id Post ID
		 */
		function save_meta_box( $post_id ) {
			$nonce_name   = isset( $_POST['save_nonce'] ) ? $_POST['save_nonce'] : '';
			$nonce_action = 'ri_woo_labels_save_nonce_action';

			/*
			error_log( '$_POST' );
			error_log( print_r( $_POST, true ) );
			*/
			// Check if nonce is valid.
			if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
				return;
			}

			// Check if user has permissions to save data.
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			// Check if not an autosave.
			if ( wp_is_post_autosave( $post_id ) ) {
				return;
			}

			// Check if not a revision.
			if ( wp_is_post_revision( $post_id ) ) {
				return;
			}

			// deleted empty options
			if ( ! isset( $_POST['ri_wl_label_setting_template'] ) ) {
				delete_post_meta( $post_id, '_ri_wl_label_setting_template' );
			}

			if ( ! isset( $_POST['ri_wl_label_setting_predefined_colors'] ) ) {
				delete_post_meta( $post_id, '_ri_wl_label_setting_predefined_colors' );
			}

			// save options
			$meta_box_settings = Ri_WL_CPT_Values::get_meta_box_settings_values();
			foreach ( $meta_box_settings as $key => $value ) {
				if ( $value ['type'] === 'select' || $value ['type'] === 'radio' ) {
					if ( isset( $_POST[ $key ] ) && array_key_exists( $_POST[ $key ], $value['options'] ) ) { // validation
						update_post_meta( $post_id, '_' . $key, $_POST[ $key ] );
					}
				} elseif ( in_array( $value ['type'], array( 'text', 'color' ) ) ) {
					if ( isset( $_POST[ $key ] ) && sanitize_text_field( $_POST[ $key ] ) ) {
						update_post_meta( $post_id, '_' . $key, $_POST[ $key ] );
					}
				}
			}

			// remove unnecessary fields
			if ( isset( $_POST['ri_wl_label_setting_where'] ) && $_POST['ri_wl_label_setting_where'] !== 'on_image' ) {
				delete_post_meta( $post_id, '_ri_wl_label_setting_position' );
			}

			$meta_box_styles = Ri_WL_CPT_Values::get_meta_box_settings_style_values();
			foreach ( $meta_box_styles as $key => $value ) {
				if ( in_array( $value ['type'], array( 'color' ) ) ) {
					if ( isset( $_POST[ $key ] ) && sanitize_text_field( $_POST[ $key ] ) ) {
						update_post_meta( $post_id, '_' . $key, $_POST[ $key ] );
					}
				} elseif ( in_array( $value ['type'], array( 'four-numbers' ) ) ) {
					if ( isset( $_POST[ $key ] ) && map_deep( $_POST[ $key ], 'sanitize_text_field' ) ) {
						update_post_meta( $post_id, '_' . $key, maybe_serialize( $_POST[ $key ] ) );
					}
				}
			}

			if ( isset( $_POST['conditions'] ) ) {
				// avoid empty conditions
				foreach ( $_POST['conditions'] as $key => $value ) {
					if ( $value['type'] === 'null' ) {
						unset( $_POST['conditions'][ $key ] );
					}
				}

				update_post_meta( $post_id, '_ri_woo_labels_conditions', maybe_serialize( $_POST['conditions'] ) ); // TODO: sanitize $_POST['conditions'] checking in array of default conditions
			} else {
				delete_post_meta( $post_id, '_ri_woo_labels_conditions' );
			}
		}
	}
}
