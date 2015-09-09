<?php
/*
	Plugin Name: Bootstrap Modals
	Description: Add seller info to Marketica.
	Version: 3.3.5
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
*/

if ( ! class_exists( 'Bootstrap_Modals' ) ) {

	class Bootstrap_Modals {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'bootstrap_modals_enqueue_style' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'bootstrap_enqueue_script' ) );
		}

		function bootstrap_modals_enqueue_style() {
			wp_register_style ( 'bootstrap-modals', plugins_url( '/css/bootstrap.min.css',  __FILE__ ), '', '3.3.5', 'all' );
			wp_enqueue_style( 'bootstrap-modals' );
		}

		function bootstrap_enqueue_script() {
			wp_register_script( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), '3.3.5' );
			wp_enqueue_script( 'bootstrap' );
		}
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Bootstrap_Modals'] = new Bootstrap_Modals();
}