<?php
/**
 * Tokopress WooCommerce Search Shortcode
 *
 * @package WooCommerce Search Shortcode
 * @author Tokopress
 */

add_shortcode( 'tokopress_product_search', 'tpvc_wc_product_search_shortcode' );

function tpvc_wc_product_search_shortcode( $atts ) {
	if ( ! class_exists('woocommerce') )
		return;

	extract( shortcode_atts( array(
		'tpvc_wc_search_title'	=> __( 'Find your product now, type here and hit enter', 'tokopress' )
	), $atts ) );
	
	$output = "\t" . '<div class="tpvc-product-search">' . "\n";
    $output .= "\t\t" . '<div class="container">' . "\n";

	$output .= "\t\t\t" . '<form role="search" method="get" id="custom-searchform" action="' . esc_url( home_url( '/'  ) ) . '">' . "\n";
	$output .= "\t\t\t\t" . '<div>' . "\n";
	
	$output .= "\t\t\t\t\t" . '<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . $tpvc_wc_search_title . '" />' . "\n";
	$output .= "\t\t\t\t\t" . '<button type="submit" class="search-submit"><i class="sli sli-magnifier"></i></button>' . "\n";
	$output .= "\t\t\t\t\t" . '<input type="hidden" name="post_type" value="product" />' . "\n";
	
	$output .= "\t\t\t\t" . '</div>' . "\n";
	$output .= "\t\t\t" . '</form>' . "\n";

    $output .= "\t\t" . '</div>' . "\n";
    $output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_product_search_vcmap' );
function tpvc_product_search_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Search Products', 'tokopress' ),
	   'base'				=> 'tokopress_product_search',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Search Text', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_search_title',
									'value'			=> __( 'Find your product now, type here and hit enter', 'tokopress' )
								)
							)
	   	)
	);
}