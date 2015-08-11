<?php
/**
 * Tokopress Custom Call To Action Shortcode
 *
 * @package cutom call to action
 * @author Tokopress
 */

add_shortcode( 'tokopress_call_to_action', 'tpvc_call_to_action_shortcode' );

function tpvc_call_to_action_shortcode( $atts ) {

	extract( shortcode_atts( array(
		'paragraf_title'		=> 'Custom Call To Action',
		'paragraf_title_color'	=> '#77635f',
		'paragraf_text'			=> 'Custom call to action paragraf text',
		'paragraf_text_color'	=> '#898989',
		'paragraf_align'		=> 'text-left',
		'button_text'			=> 'Button Action',
		'button_link'			=> '',
		'button_color'			=> 'button-default',
		'button_align'			=> 'text-left',
		'extra_class'			=> ''
	), $atts ) );

	$output = '<style type="text/css">.tpvc-call-to-action .call-paragraf .call-title { color: ' . $paragraf_title_color . ' !important; } .tpvc-call-to-action .call-paragraf .call-text { color: ' . $paragraf_text_color . ' !important; }</style>';
	
	$output .= "\t" . '<div class="tpvc-call-to-action ' . $extra_class . '">' . "\n";
    
    $output .= "\t\t" . '<div class="call-wrapper">' . "\n";
    
    $output .= "\t\t\t" . '<div class="call-paragraf ' . $paragraf_align . '">' . "\n";
    $output .= "\t\t\t\t" . '<h2 class="call-title">' . $paragraf_title . '</h2>' . "\n";
    $output .= "\t\t\t\t" . '<p class="call-text">' . $paragraf_text . '</p>' . "\n";
    $output .= "\t\t\t" . '</div>' . "\n";
   
    $output .= "\t\t\t" . '<div class="call-button ' . $button_align . '">' . "\n";
    $output .= "\t\t\t\t" . '<a href="' . $button_link . '" class="button ' . $button_color . '">' . $button_text . '</a>' . "\n";
    $output .= "\t\t\t" . '</div>' . "\n";
    
    $output .= "\t\t" . '</div>' . "\n";
    
    $output .= "\t" . '</div>' . "\n";

    return $output;
}

add_action( 'vc_before_init', 'tpvc_call_to_action_vcmap' );
function tpvc_call_to_action_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Custom Call To Action', 'tokopress' ),
	   'base'				=> 'tokopress_call_to_action',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Paragraf Title', 'tokopress' ),
									'param_name'	=> 'paragraf_title',
									'value'			=> 'Custom Call To Action'
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Paragraf Title Color', 'tokopress' ),
									'param_name'	=> 'paragraf_title_color',
									'value'			=> '#77635f'
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'Paragraf Text', 'tokopress' ),
									'param_name'	=> 'paragraf_text',
									'value'			=> 'Custom call to action paragraf text'
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Paragraf Text Color', 'tokopress' ),
									'param_name'	=> 'paragraf_text_color',
									'value'			=> '#898989'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Paragraf Align', 'tokopress' ),
									'param_name'	=> 'paragraf_align',
									'value'			=> array(
														'Left'		=> 'text-left',
														'Center'	=> 'text-center',
														'Right'		=> 'text-right'
													),
									'std'			=> 'text-left'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Button Text', 'tokopress' ),
									'param_name'	=> 'button_text',
									'value'			=> 'Button Action'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Button Link', 'tokopress' ),
									'param_name'	=> 'button_link',
									'value'			=> '#'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Button Color', 'tokopress' ),
									'param_name'	=> 'button_color',
									'value'			=> array(
														'Default'	=> 'button-default',
														'Orange'	=> 'button-orange',
														'Yellow'	=> 'button-yellow',
														'Red'		=> 'button-red',
														'Green'		=> 'button-green',
														'Purple'	=> 'button-purple',
														'Blue'		=> 'button-blue',
														'Black'		=> 'button-black',
														'Grey'		=> 'button-grey',
														'White'		=> 'button-white'
													),
									'std'			=> 'button-default'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Button Align', 'tokopress' ),
									'param_name'	=> 'button_align',
									'value'			=> array(
														'Left'		=> 'text-left',
														'Center'	=> 'text-center',
														'Right'		=> 'text-right'
													),
									'std'			=> 'text-left'
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'extra_class',
									'value'			=> ''
								)
							)
	   )
	);
}