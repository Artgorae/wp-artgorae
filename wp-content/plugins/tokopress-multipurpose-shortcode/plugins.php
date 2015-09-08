<?php
/*
Plugin Name: TokoPress - Marketica VC & Shortcodes
Plugin URI: http://toko.press
Description: TokoPress - Visual Composer Addons and Shortcodes For Marketica WordPress Theme
Version: 2.5.1
Author: TokoPress
Author URI: http://tokopress.com/
Text Domain: tokopress
Domain Path: /languages/

	Copyright: © 2014 TokoPress.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Credits:
	TokoPress Multipurpose Shortcode http://tokopress.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Load Languages
 **/
load_plugin_textdomain( 'tokopress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

require_once( 'component/plan_pricing.php' );
require_once( 'component/features.php' );
require_once( 'component/image_carousel.php' );
require_once( 'component/heading.php' );
require_once( 'component/testimonial.php' );
require_once( 'component/call-to-action.php' );
require_once( 'component/team_member.php' );
require_once( 'component/divider.php' );

require_once( 'component/wc_product.php' );
require_once( 'component/wc_featured.php' );
require_once( 'component/wc_search.php' );
require_once( 'component/wc_mini_product.php' );

require_once( 'component/wc_product_categories.php' );
require_once( 'component/wc_mini_vendors_wcvendors.php' );
require_once( 'component/wc_mini_vendors_dokan.php' );

function tpvc_icon( $icon ) {
	if ( false !== strpos($icon,'fa-') && false === strpos($icon,'fa fa-') ) {
		$icon = str_replace('fa-', 'fa fa-',$icon);
	}
	elseif ( false !== strpos($icon,'sli-') && false === strpos($icon,'sli sli-') ) {
		$icon = str_replace('sli-', 'sli sli-',$icon);
	}
	elseif ( false !== strpos($icon,'icon-') ) {
		$icon = str_replace('icon-', 'sli sli-',$icon);
	}
	return $icon;
}

function tpvc_vc_getCategoryChilds( $param = 'slug', $parent_id, $pos, $array, $level, &$dropdown ) {
	for ( $i = $pos; $i < count( $array ); $i ++ ) {
		if ( $array[ $i ]->category_parent == $parent_id ) {
			if ( $param == 'slug' ) {
				$data = array(
						str_repeat( "- ", $level ) . $array[ $i ]->name => $array[ $i ]->slug,
				);
			}
			else {
				$data = array(
						str_repeat( "- ", $level ) . $array[ $i ]->name => $array[ $i ]->term_id,
				);
			}
			$dropdown = array_merge( $dropdown, $data );
			tpvc_vc_getCategoryChilds( $param, $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
		}
	}
}
