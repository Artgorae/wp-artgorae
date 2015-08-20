<?php
/*
	Plugin Name: Artgorae Functions
	Description: Additional functions for Artgorae site.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: artgorae
*/

if ( ! class_exists( 'Artgorae_Functions' ) ) {

	class Artgorae_Functions {

		public function __construct() {
        	$this->includes();
		}

	    function includes() {
	        $inc_dir     = __DIR__ . '/includes/';
	        require_once $inc_dir . 'functions.php';
	    }
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Artgorae_Functions'] = new Artgorae_Functions();
}