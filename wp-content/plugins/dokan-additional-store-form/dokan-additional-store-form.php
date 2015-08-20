<?php
/*
	Plugin Name: Dokan Additional Store Form
	Description: Add additional store form to Dokan.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: dokan-additional-store-form
*/

if ( ! class_exists( 'Dokan_Additional_Store_Form' ) ) {

	class Dokan_Additional_Store_Form {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'dokan_settings_form_bottom', array( $this, 'add_store_intro_form' ), 10, 2 );
			add_action( 'dokan_settings_form_bottom', array( $this, 'add_portfolio_form' ), 30, 2 );
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'dokan-additional-store-form', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
		
		public function add_store_intro_form( $current_user, $profile_info ) {
		    $store_intro = isset( $profile_info['phone'] ) ? $profile_info['phone'] : '' ;
		    echo $this->store_intro_form( $store_intro );
		}

		public function store_intro_form( $store_intro ) {
			?>
	        <div class="dokan-form-group">
	            <label class="dokan-w3 dokan-control-label" for="setting_phone"><?php _e( 'Store Introduction', 'dokan-additional-store-form' ); ?></label>

	            <div class="dokan-w5 dokan-text-left">
	                <input id="setting_phone" value="<?php echo $store_intro; ?>" name="setting_phone" placeholder="<?php _e( 'store introduction', 'dokan-additional-store-form'); ?>" class="dokan-form-control" type="text">
	            </div>
	        </div>
			<?php
		}

		public function add_portfolio_form( $current_user, $profile_info ) {
		    $portfolio = isset( $profile_info['store_tnc'] ) ? $profile_info['store_tnc'] : '' ;
		    echo $this->portfolio_form( $portfolio );
		}

		public function portfolio_form( $portfolio ) {
			?>
			<div class="dokan-form-group">
	            <label class="dokan-w3 dokan-control-label" for="dokan_store_tnc"><?php _e( 'Portfolio', 'dokan-additional-store-form' ); ?></label>
	            <div class="dokan-w8 dokan-text-left">
	                <?php
	                $settings = array(
	                    'editor_height' => 200,
	                    'media_buttons' => false,
	                    'teeny' => true,
	                    'quicktags' => false
	                );
	                wp_editor( $portfolio, 'dokan_store_tnc', $settings);
	                ?>
	            </div>
	        </div>
			<?php
		}

	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Dokan_Additional_Store_Form'] = new Dokan_Additional_Store_Form();
}