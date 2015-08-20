<?php
/*
	Plugin Name: Dokan Shipment Tracking
	Description: Add shipment tracking to Dokan.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: dokan-shipment-tracking
*/

if ( ! class_exists( 'Dokan_Shipment_Tracking' ) ) {

	class Dokan_Shipment_Tracking {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'dokan_order_detail_after_order_items', array( $this, 'order_detail' ), 10, 1 );
			add_action( 'init', array( $this, 'edit_shipment_tracking' ) );
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'dokan-shipment-tracking', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		public function order_detail( $order ) {
			include( 'templates/order-shipment-tracking-html.php' );
		}

		public function edit_shipment_tracking() {
			if ( isset( $_POST['edit_shipment_tracking'] ) && $_POST['action'] == 'edit_shipment_tracking' ) {
				if ( !wp_verify_nonce( $_POST['security'], 'edit-shipment-tracking' ) ) {
					die(-1);
				}

				$post_id = absint( $_POST['post_id'] );

				if ( $post_id > 0 ) {
					update_post_meta( $post_id, '_custom_tracking_provider', $_POST['tracking_provider'] );
					update_post_meta( $post_id, '_tracking_number', $_POST['tracking_number'] );
				}
			}
		}
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Dokan_Shipment_Tracking'] = new Dokan_Shipment_Tracking();
}