<?php
/**
 * Tokopress WooCommerce Featured Product Shortcode
 *
 * @package WooCommerce Featured Product Shortcode
 * @author Tokopress
 */

add_shortcode( 'tokopress_featured_product', 'tpvc_wc_product_featured_shortcode' );

function tpvc_wc_product_featured_shortcode( $atts ) {

	if ( ! class_exists('woocommerce') )
		return;

	global $woocommerce_loop;

	extract( shortcode_atts( array(
		'tpvc_wc_featured_title'			=> __( 'Featured Product', 'tokopress' ),
		'tpvc_wc_featured_title_color'		=> '',
		'tpvc_wc_featured_title_bg'			=> '',
		'tpvc_wc_featured_title_icon'		=> '',
		'tpvc_wc_featured_title_icon_color'	=> '',
		'tpvc_wc_featured_link'				=> __( 'see all', 'tokopress' ),
		'tpvc_wc_featured_link_color'		=> '',
		'tpvc_wc_featured_number' 			=> '6',
		// 'tpvc_wc_featured_columns' 		=> '1',
		'tpvc_wc_featured_orderby' 			=> 'date',
		'tpvc_wc_featured_order' 			=> 'desc',
		'tpvc_wc_featured_hide_title'		=> '',
		'tpvc_wc_featured_hide_prodprice'	=> '',
		'tpvc_wc_featured_hide_prodtitle'	=> '',
		'tpvc_wc_featured_hide_prodlink'	=> '',
		'tpvc_wc_featured_hide_prodcart'	=> '',
		'tpvc_wc_featured_hide_prodlink_text'	=> __( 'detail', 'tokopress' ),
		'tpvc_wc_featured_class'				=> ''
	), $atts ) );

	$tpvc_wc_featured_columns = 1;

	$args = array(
		'post_type'				=> 'product',
		'post_status' 			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> $tpvc_wc_featured_number,
		'orderby' 				=> $tpvc_wc_featured_orderby,
		'order' 				=> $tpvc_wc_featured_order,
		'meta_query'			=> array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare'	=> 'IN'
			),
			array(
				'key' 		=> '_featured',
				'value' 	=> 'yes'
			)
		)
	);

	ob_start();

	$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

	$woocommerce_loop['columns'] = $tpvc_wc_featured_columns;

	if ( $products->have_posts() ) : ?>
	<div class="tpvc-featured-product woocommerce woocommerce-product-col-<?php echo $tpvc_wc_featured_columns; ?> <?php echo $tpvc_wc_featured_class; ?>">

		<?php if( "hide" != $tpvc_wc_featured_hide_title ) : ?>
			<?php 
			if ( $tpvc_wc_featured_link_color ) {
				echo '<style>';
				echo '.tpvc-featured-product.woocommerce .tpvc-title a.button.alt { color:'.$tpvc_wc_featured_link_color.'; box-shadow: '.$tpvc_wc_featured_link_color.' 0 0px 0px 2px inset; }';
				echo '.tpvc-featured-product.woocommerce .tpvc-title a.button.alt:hover { color: #fff; box-shadow: '.$tpvc_wc_featured_link_color.' 0 0px 0px 40px inset; }';
				echo '</style>';
			}
			?>

			<div class="tpvc-title" <?php if( "" != $tpvc_wc_featured_title_bg ) echo 'style="background-color:' . $tpvc_wc_featured_title_bg . '"'; ?>>
				<h2 <?php if( "" != $tpvc_wc_featured_title_color ) echo 'style="color:' . $tpvc_wc_featured_title_color . '"'; ?>>
					<?php if( "" != $tpvc_wc_featured_title_icon ) echo '<i class="' . tpvc_icon( $tpvc_wc_featured_title_icon ) . '" ' . ( $tpvc_wc_featured_title_icon_color ? 'style="color:'.$tpvc_wc_featured_title_icon_color.'"' : '' ). '></i>'; ?>
					<?php echo $tpvc_wc_featured_title; ?>
				</h2>
				<a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="button alt">
					<?php 
					if ( ! $tpvc_wc_featured_link ) $tpvc_wc_featured_link = __( 'see all', 'tokopress' ); 
					echo $tpvc_wc_featured_link;
					?>
				</a>
			</div>
		<?php endif; ?>

		<ul class="products owl-carousel">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<li <?php post_class(); ?>>
					<div class="featured-top">
						<?php the_post_thumbnail( 'custom-woo-thumbnail' ); ?>
					</div>
					<?php if( 
						"yes" != $tpvc_wc_featured_hide_prodprice || 
						"yes" != $tpvc_wc_featured_hide_prodtitle || 
						"yes" != $tpvc_wc_featured_hide_prodlink || 
						"yes" != $tpvc_wc_featured_hide_prodcart 
						) : ?>
						<div class="featured-bottom">
							<?php if( "yes" != $tpvc_wc_featured_hide_prodprice ) : ?>
								<div class="featured-price">
									<?php woocommerce_template_loop_price(); ?>
								</div>
							<?php endif; ?>
							<?php if( "yes" != $tpvc_wc_featured_hide_prodlink || 
								"yes" != $tpvc_wc_featured_hide_prodcart ) : ?>
								<div class="featured-action">
									<?php if( "yes" != $tpvc_wc_featured_hide_prodlink ) : ?>
										<a href="<?php echo get_permalink(); ?>" class="button detail_button_loop">
											<?php 
											if ( ! $tpvc_wc_featured_hide_prodlink_text ) $tpvc_wc_featured_hide_prodlink_text = __( 'detail', 'tokopress' ); 
											echo $tpvc_wc_featured_hide_prodlink_text;
											?>
										</a>
									<?php endif; ?>
									<?php if( "yes" != $tpvc_wc_featured_hide_prodcart ) : ?>
										<?php woocommerce_template_loop_add_to_cart(); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if( "yes" != $tpvc_wc_featured_hide_prodtitle ) : ?>
								<div class="featured-title">
									<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</li>

			<?php endwhile; ?>

		</ul>

	</div>
	<?php endif;

	wp_reset_postdata();

	$js_code = '$(\'.tpvc-featured-product ul.owl-carousel\').owlCarousel({
            items:1,
            autoPlay:true,
            stopOnHover:true,
            navigation:true,
            navigationText:[\'<span><i class="icon-left fa fa-chevron-left"></i></span>\', \'<span><i class="icon-right fa fa-chevron-right"></i></span>\'],
            rewindNav:true,
            scrollPerPage:false,
            singleItem:true
        });';
	
	wc_enqueue_js( $js_code );

	return ob_get_clean();
}

add_action( 'vc_before_init', 'tpvc_wc_product_featured_vcmap' );
function tpvc_wc_product_featured_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Featured Products', 'tokopress' ),
	   'base'				=> 'tokopress_featured_product',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Title', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_title',
									'value'			=> __( 'Featured Product', 'tokopress' )
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Title Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_title_color'
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Title Background Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_title_bg',
								),
								array(
									'type' 			=> 'iconpicker',
									'heading' 		=> __( 'Title Icon', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_title_icon',
									'settings' 		=> array(
										'emptyIcon' 	=> false, 
										'iconsPerPage' 	=> 100, 
									),
									'dependency' 	=> array(
										'element' 		=> 'type',
										'value' 		=> 'fontawesome',
									),
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Title Icon Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_title_icon_color',
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Link Text', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_link',
									'value'			=> __( 'see all', 'tokopress' )
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Link Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_link_color',
								),
								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Title', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_hide_title',
									'value' 		=> array( __( 'Hide Title', 'tokopress' ) => 'hide' )
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Count', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_number',
									'value'			=> array(
															'1' => '1',
															'2' => '2',
															'3' => '3',
															'4' => '4',
															'5' => '5',
															'6' => '6',
															'7' => '7',
															'8' => '8',
															'9' => '9',
															'10' => '10',
															'11' => '11',
															'12' => '12'
														),
									'std'			=> '6'
								),
								// array(
								// 	'type'			=> 'dropdown',
								// 	'heading'		=> __( 'Product Column', 'tokopress' ),
								// 	'param_name'	=> 'tpvc_wc_featured_columns',
								// 	'value'			=> array(
								// 							'1' => '1',
								// 							'2' => '2',
								// 							'3' => '3',
								// 							'4' => '4',
								// 							'5' => '5',
								// 							'6' => '6'
								// 						),
								// 	'std'			=> '1',
								// ),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Order Type', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_order',
									'value'			=> array(
															'Ascending' 	=> 'asc',
															'Descending' 	=> 'desc'
														),
									'std'			=> 'desc'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Order By', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_orderby',
									'value'			=> array(
															'ID'				=> 'ID',
															'Title'				=> 'title',
															'Date'				=> 'date',
															'Random'			=> 'rand',
															'Popular Product'	=> 'commernt_count'
														),
									'std'			=> 'date'

								),

								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Product Price', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_hide_prodprice',
									'value' 		=> array( __( 'Hide Product Price', 'tokopress' ) => 'yes' )
								),

								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Product Title', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_hide_prodtitle',
									'value' 		=> array( __( 'Hide Product Title', 'tokopress' ) => 'yes' )
								),

								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Product Detail Link', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_hide_prodlink',
									'value' 		=> array( __( 'Hide Product Detail Link', 'tokopress' ) => 'yes' )
								),

								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Product Addtocart Button', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_featured_hide_prodcart',
									'value' 		=> array( __( 'Hide Product Addtocart Button', 'tokopress' ) => 'yes' )
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Product Detail Link Text', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_hide_prodlink_text',
									'value'			=> __( 'detail', 'tokopress' )
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_featured_class',
									'value'			=> '',
								)
							)
	   	)
	);
}