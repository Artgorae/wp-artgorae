<?php
/**
 * Tokopress Heading Shortcode
 *
 * @package Heading Shortcode
 * @author Tokopress
 *
 * Attribute:
 * - heading (heading tags: h1,h2,h3,h4,h5,h6)
 * - text
 * - text_align (text-left, text-center, text-right)
 * - extra_class
 */

add_shortcode( 'tokopress_heading', 'tpvc_shortcode_heading' );

function tpvc_shortcode_heading( $atts ) {
	extract( shortcode_atts( array(
		'heading'		=> 'h1',
		'text'			=> 'Heading Text',
		'text_align'	=> 'text-left',
		'heading_icon'	=> '',
		'extra_class'	=> ''
	), $atts ) );

	$output = "\t" . '<div class="tpvc-heading ' . $text_align . ' ' . $extra_class . '">' . "\n";
	$output .= "\t\t" . '<' . $heading . ' class="heading-title"><i class="' . tpvc_icon( $heading_icon ) . '"></i>' . $text . '</' . $heading . '>' . "\n";
	$output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_heading_vcmap' );
function tpvc_heading_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Heading Typography', 'tokopress' ),
	   'base'				=> 'tokopress_heading',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Heading Text', 'tokopress' ),
									'param_name'	=> 'text',
									'value'			=> 'Heading Text'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Heading Type', 'tokopress' ),
									'param_name'	=> 'heading',
									'value'			=> array(
														'H1' => 'h1',
														'H2' => 'h2',
														'H3' => 'h3',
														'H4' => 'h4',
														'H5' => 'h5',
														'H6' => 'h6'
													),
									'std'			=> 'h1'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Text Align', 'tokopress' ),
									'param_name'	=> 'text_align',
									'value'			=> array(
														'Left'		=> 'text-left',
														'Center'	=> 'text-center',
														'Right'		=> 'text-right',
													),
									'std'			=> 'text-center'
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'tokopress' ),
									'param_name' => 'heading_icon',
									'settings' => array(
										'emptyIcon' => false, 
										'iconsPerPage' => 100, 
									),
									'dependency' => array(
										'element' => 'type',
										'value' => 'fontawesome',
									),
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