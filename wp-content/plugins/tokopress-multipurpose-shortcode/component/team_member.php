<?php
/**
 * Tokopress Team Memeber Shortcode
 *
 * @package Team Member Shortcode
 * @author Tokopress
 *
 * Attribute:
 * - image
 * - name
 * - skill
 * - excerpt
 * - link_url
 * - extra_class
 */

add_shortcode( 'tokopress_team', 'tpvc_shortcode_team_member' );

function tpvc_shortcode_team_member( $atts ) {
	extract( shortcode_atts( array(
		'image'			=> '',
		'image_size'	=> 'thumbnail',
		'name'			=> 'John Doe',
		'skill'			=> 'Web Design',
		'link_url'		=> '#',
		'excerpt'		=> '',
		'extra_class'	=> ''
	), $atts ) );

	$output = "\t" . '<div class="tpvc-team-members ' . $extra_class . '">' . "\n";
	$output .= "\t\t" . '<div class="team-member">' . "\n";
	
	$output .= "\t\t\t" . '<div class="member-image">' . "\n";
	if( "" != $image ){
		$output .= "\t\t\t\t" . wp_get_attachment_image( $image, $image_size ) . "\n";
	}
	$output .= "\t\t\t" . '</div>' . "\n";

	$output .= "\t\t\t" . '<div class="member-info">' . "\n";
	$output .= "\t\t\t\t" . '<h5 class="member-title"><a href="' . $link_url . '">' . $name . '</a></h5>' . "\n";
	$output .= "\t\t\t\t" . '<span class="member-skills">' . $skill . '</span>' . "\n";
	
	if( "" != $excerpt )
		$output .= "\t\t\t\t" . '<p>' . $excerpt . '</p>' . "\n";
	
	$output .= "\t\t\t" . '</div>' . "\n";
	
	$output .= "\t\t" . '</div>' . "\n";
	$output .= "\t" . '</div>' . "\n";

	return $output;
}

add_action( 'vc_before_init', 'tpvc_team_member_vcmap' );
function tpvc_team_member_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Team Members', 'tokopress' ),
	   'base'				=> 'tokopress_team',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Team Member Name', 'tokopress' ),
									'param_name'	=> 'name',
									'value'			=> 'Tilvar Claudiu'
								),
								array(
									'type'			=> 'attach_image',
									'heading'		=> __( 'Team Members Image', 'tokopress' ),
									'param_name'	=> 'image'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Image Size', 'tokopress' ),
									'param_name'	=> 'image_size',
									'value'			=> array(
														'Small'		=> 'thumbnail',
														'Medium'	=> 'medium',
														'Large'		=> 'full'
													),
									'std'			=> 'thumbnail'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Skill', 'tokopress' ),
									'param_name'	=> 'skill',
									'value'			=> 'Graphic web-designer'
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'excerpt', 'tokopress' ),
									'param_name'	=> 'excerpt',
									'value'			=> ''
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Link URL', 'tokopress' ),
									'param_name'	=> 'link_url',
									'value'			=> '#'
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