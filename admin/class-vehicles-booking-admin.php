<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com/#
 * @since      1.0.0
 *
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/admin
 * @author     Tushar <webdeveloper.tushar@gmail.com>
 */
class Vehicles_Booking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();
		add_action( 'admin_menu', array($this, 'mt_add_pages') );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vehicles_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vehicles_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vehicles-booking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vehicles_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vehicles_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vehicles-booking-admin.js', array( 'jquery' ), $this->version, true );
		
	}

	private function load_dependencies() {

		
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-admin-ajax.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-post-type.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-taxonomy.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-metaboxes.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-user-request-page.php';

	}

	function mt_add_pages() {
		add_submenu_page(
		    'edit.php?post_type=vehicle',
		    __( 'User Requests', 'menu-test' ),
		    __( 'User Requests', 'menu-test' ),
		    'manage_options',
		    'user_request',
		    'user_request_callback'
		);
	}

}
