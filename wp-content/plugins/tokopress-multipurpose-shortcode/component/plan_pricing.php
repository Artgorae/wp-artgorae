<?php
/**
 * Tokopress Plan & Pricing Shortcode
 *
 * @package Plan & Pricing Shortcode
 * @author tokopress
 */

add_shortcode( 'tokopress_pricing', 'tpvc_pricing_shortcode' );

function tpvc_pricing_shortcode( $atts ) {

	extract( shortcode_atts( array (
		'tpvc_plantable_title'			=> __( 'FREE', 'tokopress' ),
		'tpvc_plantable_currencies'		=> '$',
		'tpvc_plantable_value'			=> '0',
		'tpvc_plantable_info'			=> __( 'per month', 'tokopress' ),
		'tpvc_plantable_items'			=> '',
		'tpvc_plantable_featured'		=> '',
		'tpvc_plantable_featured_bg'	=> '',
		'tpvc_plantable_btn_text'		=> __( 'CHOOSE PACKAGE', 'tokopress' ),
		'tpvc_plantable_btn_url'		=> '',
		'tpvc_plantable_extra_class'	=> ''
		), $atts ) );

	$plan_items = explode(';', $tpvc_plantable_items);
	
	$output = "\t" . '<div class="tpvc-plan-pricing ' . $tpvc_plantable_featured . '" ' . ( $tpvc_plantable_featured && $tpvc_plantable_featured_bg ? 'style="background:'.$tpvc_plantable_featured_bg.'"' : '' ). '>' . "\n";
    
    $output .= "\t\t" . '<div class="plan-head">' . "\n";
    $output .= "\t\t\t" . '<span class="plan-type">' . $tpvc_plantable_title . '</span>' . "\n";
    $output .= "\t\t\t" . '<span class="plan-price">' . $tpvc_plantable_currencies . $tpvc_plantable_value . '</span>' . "\n";
    $output .= "\t\t\t" . '<span class="plan-time">' . $tpvc_plantable_info . '</span>' . "\n";
    $output .= "\t\t" . '</div>' . "\n";
    
    $output .= "\t\t" . '<div class="plan-content">' . "\n";
    $output .= "\t\t\t" . '<ul>' . "\n";

    	foreach ($plan_items as $plan_item) {
			$output .= "\t\t\t\t" . '<li>' . strip_tags( $plan_item ) . '</li>' . "\n";
		}

    $output .= "\t\t\t" . '</ul>' . "\n";
    $output .= "\t\t\t" . '<a href="' . $tpvc_plantable_btn_url . '" class="button alt">' . $tpvc_plantable_btn_text . '</a>' . "\n";
    $output .= "\t\t" . '</div>' . "\n";
    
    $output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_pricing_vcmap' );
function tpvc_pricing_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Plan & Pricing', 'tokopress' ),
	   'base'				=> 'tokopress_pricing',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'checkbox',
									'heading'		=> __( 'Featured Plan', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_featured',
									'value'			=> array( __( "Make it featured plan", "tokopress" ) => 'featured' )
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Title', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_title',
									'value'			=> __( 'FREE', 'tokopress' )
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Currencies', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_currencies',
									'value'			=> '$'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Value', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_value',
									'value'			=> '0'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Information', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_info',
									'value'			=> __( 'per month', 'tokopress' )
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'Plan Items', 'tokopress' ),
									'description'	=> __( 'Insert Plan Items in here, use semicolon (;) for separated value. This Item will be displayed as list.', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_items',
									'value'			=> ''
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Button Text', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_btn_text',
									'value'			=> __( 'CHOOSE PACKAGE', 'tokopress' )
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Plan Button URL', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_btn_url',
									'value'			=> ''
								),

								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Featured Plan Background Color', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_featured_bg'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_plantable_extra_class',
									'value'			=> ''
								)
							)
		)
	);
}