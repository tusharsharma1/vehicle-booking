<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com/#
 * @since      1.0.0
 *
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Vehicles_Booking
 * @subpackage Vehicles_Booking/includes
 * @author     Tushar <webdeveloper.tushar@gmail.com>
 */
class Vehicles_Booking_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'v_booking_info';
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			f_name varchar(100)   NOT NULL, 
			l_name varchar(100)   NOT NULL, 
			email varchar(100)   NOT NULL, 
			phone varchar(100)   NOT NULL, 
			vehicle_type varchar(100)   NOT NULL, 
			vehicle varchar(100)   NOT NULL, 
			message text NULL, 
			status int(100)   NULL, 
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

	}

}
