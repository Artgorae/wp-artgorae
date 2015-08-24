<?php
/*
	Plugin Name: Marketica Seller Info
	Description: Add seller info to Marketica.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: artgorae
*/

if ( ! class_exists( 'Marketica_Seller_Info' ) ) {

	class Marketica_Seller_Info {

		public function __construct() {
			// add_action( 'after_setup_theme', 'remove_tokopress_product_details_title' );
			add_action( 'tokopress_wc_main_content_right', array( $this, 'seller_info_title' ), 70 );
			add_action( 'tokopress_wc_main_content_right', array( $this, 'seller_info_intro' ), 80 );
			add_action( 'tokopress_wc_main_content_right', array( $this, 'seller_info_button' ), 90 );
		}

		function remove_tokopress_product_details_title() {
			remove_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_title', 20 );
		}

		function seller_info_title() {
			?>
			<h3 class="title-item-details"><?php _e( 'Seller Info', 'dokan' ); ?></h3>
			<?php
		}

		function seller_info_intro() {
			$store_info = dokan_get_store_info( get_the_author_meta( 'ID' ) );
			$store_intro = $store_info['phone'];
			?>
			<div><?php echo $store_intro; ?></div>
			<?php
		}

		function seller_info_button() {
			?>
			<div class="widget-button-area" style="margin-top: 10px;">
				<?php $this->seller_info_button_area() ?>
			</div>
			<?php
		}

		function seller_info_button_area() {
			get_follow_button();
			$this->get_store_button();
			$this->get_portfolio_button();
			echo $this->sidebar_store_button_style();
		}

		function get_anchor_button( $link, $class, $text ) {
			return sprintf( '<a href="%s" class="%s">%s</a>', $link, $class, $text );
		}

		function get_text_with_icon( $text, $icon_class ) {
			return sprintf( '<i class="%s"></i> %s', $icon_class, $text );
		}

		function get_store_button() {
			$button_text = __( 'View Store', 'artgorae' );
			$button_icon = 'fa fa-university';
			$button_text_html = $this->get_text_with_icon( $button_text, $button_icon );
			$button_class = 'button alt';
			$button_link = dokan_get_store_url( get_the_author_meta( 'ID' ) );
			echo $this->get_anchor_button( $button_link, $button_class, $button_text_html );
		}

		function get_portfolio_button() {
			$button_text = __( 'View Portfolio', 'artgorae' );
			$button_icon = 'fa fa-pencil-square-o';
			$button_text_html = $this->get_text_with_icon( $button_text, $button_icon );
			$button_class = 'button';
			$button_link = dokan_get_store_url( get_the_author_meta( 'ID' ) ) . 'toc';
			echo $this->get_anchor_button( $button_link, $button_class, $button_text_html );
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
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Marketica_Seller_Info'] = new Marketica_Seller_Info();
}