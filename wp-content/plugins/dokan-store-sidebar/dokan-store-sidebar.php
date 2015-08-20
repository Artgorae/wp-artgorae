<?php
/*
	Plugin Name: Dokan Store Sidebar
	Description: Add store sidebar to Dokan.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: dokan-store-sidebar
*/

if ( ! class_exists( 'Dokan_Store_Sidebar' ) ) {

	class Dokan_Store_Sidebar {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'dokan_sidebar_store_after', array( $this, 'sidebar_store_button' ), 10, 2 );
		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'dokan-store-sidebar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		function sidebar_store_button( $store_user, $store_info  ) {
			$store_intro = $store_info['phone'];
			?>
			<aside class="widget" style="width: 100%; margin-top: 50px;">
				<h3 class="widget-title"><?php _e( 'About this seller', 'dokan-store-sidebar' ); ?></h3>
				<div><?php echo $store_intro; ?></div>
				<div class="widget-button-area" style="margin-top: 10px;">
					<?php $this->sidebar_store_button_area( $store_user, $store_info ); ?>
				</div>
			</aside>
			<?php
		}

		function sidebar_store_button_area( $store_user, $store_info ) {
			get_follow_button();
			$this->get_message_button( $store_user, $store_info );
			$this->get_portfolio_button();
			echo $this->sidebar_store_button_style();
		}

		function sidebar_store_button_style() {
			?>
			<style>
			.widget-button-area .button {
				margin-top: 5px !important;
				text-align: center;
				width: 100%;
				box-sizing: border-box;
			}
			</style>
			<?php
		}
		
		function get_anchor_button( $link, $class, $text ) {
			return sprintf( '<a href="%s" class="%s">%s</a>', $link, $class, $text );
		}

		function get_text_with_icon( $text, $icon_class ) {
			return sprintf( '<i class="%s"></i> %s', $icon_class, $text );
		}

		function get_portfolio_button() {
			$button_text = __( 'View Portfolio', 'dokan-store-sidebar' );
			$button_icon = 'fa fa-pencil-square-o';
			$button_text_html = $this->get_text_with_icon( $button_text, $button_icon );
			$button_class = 'button';
			$button_link = './toc';
			echo $this->get_anchor_button( $button_link, $button_class, $button_text_html );
		}

		function get_message_button( $store_user, $store_info ) {
		    $store_user_id = $store_user->ID;
		    echo $this->message_button( $store_user_id );
		}

		function message_button( $store_user_id ) {
			$button_text = __( 'Ask to Seller', 'dokan-store-sidebar' );
			$button_icon = 'fa fa-envelope-o';
			$button_text_html = $this->get_text_with_icon( $button_text, $button_icon );
			$subject = __( 'You have new message!', 'dokan-store-sidebar' );
			$message_link = do_shortcode("[pm_user user_id=$store_user_id text='$button_text_html' class='button alt' subject='$subject']");

			return $message_link;
		}

	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Dokan_Store_Sidebar'] = new Dokan_Store_Sidebar();
}