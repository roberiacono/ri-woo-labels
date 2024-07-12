<?php

defined( 'ABSPATH' ) || exit;



if ( ! class_exists( 'Ri_Woo_Labels' ) ) {
	final class Ri_Woo_Labels {

		public $version          = RI_WOO_LABELS_PLUGIN_VERSION;
		private static $instance = null;

		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			} else {
				error_log( 'Ri_Woo_Labels instance already exists.' );
			}
			return self::$instance;
		}

		/**
		 * Cloning is forbidden.
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, esc_html( 'Cloning is forbidden.' ), '1.0.0' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, esc_html( 'Unserializing instances of this class is forbidden.' ), '1.0.0' );
		}

		public function define_constants() {
			$this->define( 'RI_WOO_LABELS_DB_NAME', 'ri_woo_labels' );
			$this->define( 'RI_WOO_LABELS_PLUGIN_DIR', plugin_dir_path( RI_WOO_LABELS_PLUGIN_FILE ) );
			$this->define( 'RI_WOO_LABELS_PLUGIN_URL', plugin_dir_url( RI_WOO_LABELS_PLUGIN_FILE ) );
			$this->define( 'RI_WOO_LABELS_PLUGIN_DIRNAME', dirname( RI_WOO_LABELS_PLUGIN_FILE ) . '/' );
		}

		private function includes() {
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-helpers.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-custom-post-type.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-cpt-values.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-cpt-conditions.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-cpt-meta-box.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-admin-menu.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-label-view.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-label-display.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-woo-image-wrapper.php';
		}

		private function init_hooks() {
			register_activation_hook( RI_WOO_LABELS_PLUGIN_URL, array( $this, 'activate_plugin' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'maybe_enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ) );
			add_action( 'init', array( $this, 'load_textdomain' ) );

			add_filter( 'plugin_action_links_' . plugin_basename( RI_WOO_LABELS_PLUGIN_URL ), array( $this, 'add_settings_link' ) );
		}

		public function on_plugins_loaded() {

			new Ri_WL_Custom_Post_Type();
			new Ri_WL_Label_Display();
			new Ri_WL_Woo_Image_Wrapper();

			if ( current_user_can( 'manage_options' ) ) {
				new Ri_WL_Admin_Menu();
				new Ri_WL_CPT_Meta_Box();
			}
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function load_textdomain() {
			load_plugin_textdomain( 'ri-woo-labels', false, dirname( plugin_basename( RI_WOO_LABELS_PLUGIN_URL ) ) . '/languages' );
		}

		public function activate_plugin() {
			$this->set_initial_settings();
		}

		public function set_initial_settings() {
			/*
			$initial_settings = RI_WTH_Settings::get_intial_settings();

			// set default initial settings
			foreach ( $initial_settings as $key => $value ) {
				if ( false === get_option( $key ) ) {
					add_option( $key, $value );
				}
			} */
		}

		public function admin_enqueue_scripts( $hook_suffix ) {
			if ( is_admin() && in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) {
				$screen = get_current_screen();
				if ( is_object( $screen ) && 'woo-label' === $screen->post_type ) {

					wp_enqueue_style( 'wp-color-picker' );
					wp_register_script( 'ri-woo-labels-meta-box', RI_WOO_LABELS_PLUGIN_URL . 'assets/admin/js/meta-box.js', array( 'jquery', 'wp-color-picker' ), RI_WOO_LABELS_PLUGIN_VERSION, true );
					wp_localize_script(
						'ri-woo-labels-meta-box',
						'ri_woo_labels_meta_box_scripts',
						array(
							'conditions'       => Ri_WL_CPT_Conditions::get_default_conditions(),
							'removeButtonText' => __( 'Remove', 'ri-woo-labels' ),
						)
					);
					wp_enqueue_script( 'ri-woo-labels-meta-box' );

					// wp_enqueue_script( 'ri-woo-labels-color-picker', RI_WOO_LABELS_PLUGIN_URL . 'assets/admin/js/color-picker.js', array( 'wp-color-picker' ), RI_WOO_LABELS_PLUGIN_VERSION, true );
				}
			}
		}

		public function maybe_enqueue_scripts() {

			/*
			if ( get_option( 'ri_wth_load_styles' ) ) {
				wp_register_style( 'ri-wth-style', RI_WOO_LABELS_PLUGIN_URL . 'public/css/style.css', array(), RI_WOO_LABELS_PLUGIN_VERSION );
			}
			if ( get_option( 'ri_wth_load_scripts' ) ) {
				wp_register_script( 'ri-wth-script', RI_WOO_LABELS_PLUGIN_URL . 'public/js/script.js', array( 'jquery' ), RI_WOO_LABELS_PLUGIN_VERSION, true );
				wp_localize_script(
					'ri-wth-script',
					'ri_wth_scripts',
					array(
						'ajax_url'   => admin_url( 'admin-ajax.php' ),
						'thank_you'  => __( '✅ Thank you for your feedback!', 'ri-was-this-helpful' ),
						'submitting' => __( '⏳ Submitting...', 'ri-was-this-helpful' ),
						'postId'     => get_the_ID(),
					)
				);
			}
			if ( RI_WTH_Functions::should_display_box() ) {
				if ( get_option( 'ri_wth_load_styles' ) ) {
					wp_enqueue_style( 'ri-wth-style' );
				}
				if ( get_option( 'ri_wth_load_scripts' ) ) {
					wp_enqueue_script( 'ri-wth-script' );
				}
			} */
		}

		public function add_settings_link( $links ) {
			$url           = get_admin_url() . 'admin.php?page=ri-woo-labels-settings';
			$settings_link = array( '<a href="' . $url . '">' . esc_html( __( 'Settings', 'ri-woo-labels' ) ) . '</a>' );
			return array_merge( $settings_link, $links );
		}
	}
}
