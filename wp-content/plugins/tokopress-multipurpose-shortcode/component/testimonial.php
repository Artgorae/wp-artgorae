<?php
/**
 * Tokopress Testimonial Shortcode
 *
 * @package Testimonial Shortcode
 * @author Tokopress
 *
 * Attribute:
 * - image
 * - name
 * - excerpt
 * - role
 * - link_url
 * - box_border (border-right, border-left, border-top, border-bottom, border-right-top, border-top-right, border-right-bottom, border-bottom-right, border-left-top, border-top-left border-left-bottom, border-bottom-left, border-top-bottom, border-bottom-top, border-left-right, border-right-left)
 */

add_shortcode( 'tokopress_testimonial', 'tpvc_testimonial_shortcode' );

function tpvc_testimonial_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'image'			=> '',
		'image_size'	=> 'thumbnail',
		'name'			=> 'John Doe',
		'excerpt'		=> '',
		'role'			=> 'Web Designer',
		'link_url'		=> '#',
		'box_border'	=> 'border-none',
		'extra_class'	=> ''
	), $atts ) );

	$output = "\t" . '<div class="tpvc-testimonial ' . $box_border . ' ' . $extra_class . '">' . "\n";
	$output .= "\t\t" . '<div class="testimonial-box">' . "\n";

	if( "" != $excerpt )
		$output .= "\t\t\t" . '<p>' . $excerpt . '</p>' . "\n";

	$output .= "\t\t" . '</div>' . "\n";
	$output .= "\t\t" . '<div class="testimonial-body">' . "\n";
	
	if( "" != $image ) {
		$output .= "\t\t\t" . '<div class="testimonial-left">' . "\n";
		$output .= "\t\t\t\t" . wp_get_attachment_image( $image, $image_size ) . "\n";
		$output .= "\t\t\t" . '</div>' . "\n";
	}
	
	$output .= "\t\t\t" . '<div class="testimonial-right">' . "\n";
	$output .= "\t\t\t\t" . '<h5 class="testimonial-heading"><a href="' . $link_url . '">' . $name . '</a></h5>' . "\n";
	$output .= "\t\t\t\t" . '<p>' . $role . '</p>' . "\n";
	$output .= "\t\t\t" . '</div>' . "\n";

	$output .= "\t\t" . '</div>' . "\n";
	$output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_testimonial_vcmap' );
function tpvc_testimonial_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Testimonial', 'tokopress' ),
	   'base'				=> 'tokopress_testimonial',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Name', 'tokopress' ),
									'param_name'	=> 'name',
									'value'			=> 'Tilvar Claudiu'
								),
								array(
									'type'			=> 'attach_image',
									'heading'		=> __( 'Avatar', 'tokopress' ),
									'param_name'	=> 'image'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Image Size', 'tokopress' ),
									'param_name'	=> 'image_size',
									'value'			=> array(
														'Small'		=> 'thumbnail',
														'Medium'	=> 'medium',
														'Full'		=> 'full'
													),
									'std'			=> 'thumbnail'
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'Excerpt', 'tokopress' ),
									'param_name'	=> 'excerpt',
									'value'			=> ''
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Skill', 'tokopress' ),
									'param_name'	=> 'role',
									'value'			=> 'Web Designer'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'URL', 'tokopress' ),
									'param_name'	=> 'link_url',
									'value'			=> '#'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Border', 'tokopress' ),
									'param_name'	=> 'box_border',
									'value'			=> array(
														'Border None'			=> 'border-none',
														'Border All'			=> 'border-all',
														'Border Right'			=> 'border-right',
														'Border Left'			=> 'border-left',
														'Border Top'			=> 'border-top',
														'Border Bottom'			=> 'border-bottom',
														'Border Top-Right'		=> 'border-right-top',
														'Border Bottom-Right'	=> 'border-right-bottom',
														'Border Top-Left'		=> 'border-left-top',
														'Border Bottom-Left'	=> 'border-left-bottom',
														'Border Top-Bottom'		=> 'border-top-bottom',
														'Border Left-Right'		=> 'border-left-right',
													),
									'std'			=> 'border-none'
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