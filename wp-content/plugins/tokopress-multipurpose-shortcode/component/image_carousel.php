<?php
/**
 * Tokopress Image Carousel Shortcode
 *
 * @package Image Carousel Shortcode
 * @author Tokopress
 *
 * Attribute:
 * - images (ID Attachment)
 * - image_url (Insert url target for image, use | for multiple URL. e.g: http://primathemes.com/|http://tokopress.com/)
 * - image_size (thumnail, medium, full)
 * - single (yes, no)
 * - image_show (default = 5)
 * - extra_class
 */

add_shortcode( 'tokopress_image_carousel', 'tpvc_shortcode_image_carousel' );

function tpvc_shortcode_image_carousel( $atts ) {
	extract( shortcode_atts( array(
		'carousel_id'		=> '',
		'images'			=> '',
		'image_url'			=> '',
		'image_size'		=> 'medium',
		'single'			=> 'no',
		'image_show'		=> '5',
		'image_transition'	=> '',
		'extra_class'		=> ''
	), $atts ) );

	if( "" != $images ){
		if( 'yes' == $single ){
			$img_per_page = 1;
			$singleItem = "true";
			$thumb_size = 'full';
		} else {
			if( '0' == $image_show ){
				$img_per_page = "5";
			} else {
				$img_per_page = $image_show;
			}

			$singleItem = "false";
			$thumb_size = $image_size;
		}

		// effect style = 'fade, backslide, godown, fadeup'
		if( "fade" == $image_transition ) {
			$transitions = ',transitionStyle:"fade"';
		} elseif( "backslide" == $image_transition ) {
			$transitions = ',transitionStyle:"backSlide"';
		} elseif( "godown" == $image_transition ) {
			$transitions = ',transitionStyle:"goDown"';
		} elseif( "fadeup" == $image_transition ) {
			$transitions = ',transitionStyle:"fadeUp"';
		} else {
			$transitions = '';
		}

		$url_data = explode('|', $image_url);
		$url_array = array();
		foreach ($url_data as $url_item) {
			$url_array[] = $url_item;
		}

		$output = "\t" . '<div class="tpvc-image-carousel-' . $carousel_id . ' ' . $extra_class . '">' . "\n";
		$output .= "\t\t" . '<div class="tpvc-image-carousel owl-carousel">' . "\n";

			$images_data = explode( ',', $images );
			$i=0;
			foreach ( $images_data as $image_data ) {
				$link_url = ( isset( $url_array[$i] ) ) ? $url_array[$i] : "#";

				$output .= "\t\t\t" . '<div class="image-carousel">' . "\n";
				$output .= "\t\t\t\t" . '<a href="' . $link_url  . '">' . "\n";
				$output .= "\t\t\t\t\t" . wp_get_attachment_image( $image_data, $thumb_size ) . "\n";
				$output .= "\t\t\t\t" . '</a>' . "\n";
				$output .= "\t\t\t" . '</div>' . "\n";
			$i++;
			}

		$output .= "\t\t" . '</div>' . "\n";
		$output .= "\t" . '</div>' . "\n";

		$js_code = '$(".tpvc-image-carousel-' . $carousel_id . ' .tpvc-image-carousel").owlCarousel({items:' . $img_per_page . ',itemsDesktop:[1199,4],itemsDesktopSmall:[980,3],itemsTablet:[768,2],itemsTabletSmall:false,itemsMobile:[479,1],singleItem:' . $singleItem . ',autoPlay:true,stopOnHover:true,navigation:true,navigationText:[\'<i class="fa fa-chevron-left"></i>\',\'<i class="fa fa-chevron-right"></i>\'],rewindNav:true,scrollPerPage:true,lazyLoad:true' . $transitions . '});';
		
		if ( class_exists('woocommerce') ) {
			wc_enqueue_js( $js_code );
		}
		else {
			tokopress_enqueue_js( $js_code );
		}
	}

	return $output;

}

add_action( 'vc_before_init', 'tpvc_image_carousel_vcmap' );
function tpvc_image_carousel_vcmap() {

	vc_map( array(
	   'name'				=> __( 'Tokopress - Image Carousel', 'tokopress' ),
	   'base'				=> 'tokopress_image_carousel',
	   'class'				=> '',
	   'icon'				=> 'tokopress_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Image Carousel ID', 'tokopress' ),
									'description'	=> __( 'If using more than one, this ID is required.', 'tokopress' ),
									'param_name'	=> 'carousel_id'
								),

								array(
									'type'			=> 'attach_images',
									'heading'		=> __( 'Images', 'tokopress' ),
									'param_name'	=> 'images'
								),
								array(
									'type'			=> 'textarea',
									'heading'		=> __( 'Image URL', 'tokopress' ),
									'description'	=> __( 'Insert url target for image, use | for multiple URL. e.g: http://primathemes.com/|http://tokopress.com/', 'tokopress' ),
									'param_name'	=> 'image_url'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Single Image Slider', 'tokopress' ),
									'param_name'	=> 'single',
									'value'			=> array(
														'No'		=> 'no',
														'Yes'		=> 'yes',
													),
									'std'			=> 'no'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Display Image Per Page', 'tokopress' ),
									'param_name'	=> 'image_show',
									'value'			=> '5',
									'dependency' 	=> Array('element' => "single", 'value' => array('no'))
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Image Size', 'tokopress' ),
									'param_name'	=> 'image_size',
									'value'			=> array(
														'Small'		=> 'thumbnail',
														'Medium'	=> 'medium',
														'Large'		=> 'full',
													),
									'std'			=> 'medium',
									'dependency' 	=> Array('element' => "single", 'value' => array('no'))
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Effect Transition', 'tokopress' ),
									'param_name'	=> 'image_transition',
									'value'			=> array(
														'Default'		=> '',
														'Fade'			=> 'fade',
														'Back Slide'	=> 'backslide',
														'Go Down'		=> 'godown',
														'Fade Up'		=> 'fadeup',
													),
									'std'			=> '',
									'dependency' 	=> Array('element' => "single", 'value' => array('yes'))
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