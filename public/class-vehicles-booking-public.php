<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com/#
 * @since      1.0.0
 *
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/public
 * @author     Tushar <webdeveloper.tushar@gmail.com>
 */
class Vehicles_Booking_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();

		add_action("wp_ajax_my_user_vote", "my_user_vote");
		add_action("wp_ajax_nopriv_my_user_vote", "my_must_login");

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vehicles-booking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vehicles-booking-public.js', array( 'jquery' ), $this->version, false );

		wp_register_script( "my_voter_script",plugin_dir_url( __FILE__ ) . 'js/my_voter_script.js', array('jquery') );
		wp_localize_script( 'my_voter_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        
		wp_enqueue_script( 'jquery' );
   		wp_enqueue_script( 'my_voter_script' );

	}

	private function load_dependencies() {

		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-shortcode.php';
		require_once plugin_dir_path( __FILE__ ) . 'partials/vb-ajax.php';

	}

}
