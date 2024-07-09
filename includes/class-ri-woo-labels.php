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
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-custom-post-type.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-cpt-meta-box.php';
			require_once RI_WOO_LABELS_PLUGIN_DIRNAME . 'includes/class-admin-menu.php';
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
			new Ri_WL_CPT_Meta_Box();

			if ( current_user_can( 'manage_options' ) ) {
				new Ri_WL_Admin_Menu();
			}

			/*
			$user_role = new RI_WTH_User_Role();
			new RI_WTH_Settings();
			new RI_WTH_Box();
			new RI_WTH_Functions();
			new RI_WTH_Shortcode();
			new RI_WTH_Ajax();
			new RI_WTH_Block();

			if ( $user_role->can_user_see_stats() ) {
				new RI_WTH_Admin_Columns();
				new RI_WTH_Admin_Bar();
				new RI_WTH_Metabox();
				new RI_WTH_Metabox_Stats();
			} */
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

		public function admin_enqueue_scripts() {
			/*
			if ( is_admin() && isset( $_GET['page'] ) && $_GET['page'] === 'ri-wth-settings' ) {
				wp_enqueue_style( 'ri-wth-admin-style', RI_WOO_LABELS_PLUGIN_URL . 'admin/css/style.css', RI_WTH_PLUGIN_VERSION );
			} */
		}

		public function maybe_enqueue_scripts() {
			/*
			if ( get_option( 'ri_wth_load_styles' ) ) {
				wp_register_style( 'ri-wth-style', RI_WOO_LABELS_PLUGIN_URL . 'public/css/style.css', array(), RI_WTH_PLUGIN_VERSION );
			}
			if ( get_option( 'ri_wth_load_scripts' ) ) {
				wp_register_script( 'ri-wth-script', RI_WOO_LABELS_PLUGIN_URL . 'public/js/script.js', array( 'jquery' ), RI_WTH_PLUGIN_VERSION, true );
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
