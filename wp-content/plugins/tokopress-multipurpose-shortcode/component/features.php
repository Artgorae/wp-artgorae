<?php
/**
 * Tokopress features Shortcode
 *
 * @package features Shortcode
 * @author tokopress
 */

add_shortcode( 'tokopress_features', 'tpvc_features_shortcode' );

function tpvc_features_shortcode( $atts ) {

	extract( shortcode_atts( array(
		'tpvc_features_title'			=> '',
		'tpvc_features_icon_position'	=> 'top-icon',
		'tpvc_features_title_heading'	=> 'h3',
		'tpvc_features_icon' 			=> '',
		'tpvc_features_icon_color'		=> '#EB8E7C',
		'tpvc_features_description' 	=> '',
		'tpvc_features_url' 			=> '',
		'tpvc_features_extra_class'		=> ''
	), $atts ) );

	/* backward, we no longer allow h1 here for SEO */
	if ( $tpvc_features_title_heading == 'h1' ) {
		$tpvc_features_title_heading = 'h3';
	}

	$output = "\t" . '<div class="tpvc-feature ' . $tpvc_features_extra_class . '">' . "\n";

	$output .= "\t\t" . '<div class="feature-inner ' . $tpvc_features_icon_position . '">' . "\n";
    $output .= "\t\t\t" . '<div class="feature-content">' . "\n";
    $output .= "\t\t\t\t" . '<span class="feature-icon"><i class="' . tpvc_icon( $tpvc_features_icon ) . '" style="color:' . $tpvc_features_icon_color . '"></i></span>' . "\n";
    $output .= "\t\t\t\t" . '<' . $tpvc_features_title_heading . ' class="feature-title"><a href="' . $tpvc_features_url . '">' . $tpvc_features_title . '</a></' . $tpvc_features_title_heading . '>' . "\n";
    $output .= "\t\t\t\t" . '<p>' . $tpvc_features_description . '</p>' . "\n";
    $output .= "\t\t\t" . '</div>' . "\n";
    $output .= "\t\t" . '</div>' . "\n";
    
    $output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_features_vcmap' );
function tpvc_features_vcmap() {

	vc_map( array(
	   'name'				=> __( 'TokoPress - Features', 'tokopress' ),
	   'base'				=> 'tokopress_features',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Features Title', 'tokopress' ),
									'param_name'	=> 'tpvc_features_title',
									'value'			=> ''
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Icon Position', 'tokopress' ),
									'param_name'	=> 'tpvc_features_icon_position',
									'value'			=> array(
															'Top Icon'	=> 'top-icon',
															'Left Icon'	=> 'left-icon'
														),
									'std'			=> 'top-icon'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Heading', 'tokopress' ),
									'param_name'	=> 'tpvc_features_heading',
									'value'			=> array(
															'H2'	=> 'h2',
															'H3'	=> 'h3',
															'H4'	=> 'h4',
															'H5'	=> 'h5',
															'H6'	=> 'h6'
														),
									'std'			=> 'h3'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'URL', 'tokopress' ),
									'param_name'	=> 'tpvc_features_url',
									'value'			=> ''
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Icon', 'tokopress' ),
									'param_name' => 'tpvc_features_icon',
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
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Icon Color', 'tokopress' ),
									'param_name'	=> 'tpvc_features_icon_color',
									'value'			=> '#EB8E7C'
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'Description', 'tokopress' ),
									'param_name'	=> 'tpvc_features_description',
									'value'			=> ''
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_features_extra_class',
									'value'			=> ''
								)
							)
		)
	);
}