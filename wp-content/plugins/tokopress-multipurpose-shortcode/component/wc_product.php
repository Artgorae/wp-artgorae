<?php
/**
 * Tokopress WooCommerce Product
 *
 * @package WooCommerce Product
 * @author Tokopress
 */

add_shortcode( 'tokopress_product', 'tpvc_wc_product_shortcode' );

function tpvc_wc_product_shortcode( $atts ) {
	if ( ! class_exists('woocommerce') )
		return;

	global $woocommerce_loop;

	extract( shortcode_atts( array(
		'tpvc_wc_product_style'				=> 'alt',
		'tpvc_wc_product_title'				=> __( 'Product', 'tokopress' ),
		'tpvc_wc_product_title_color'		=> '',
		'tpvc_wc_product_title_bg'			=> '',
		'tpvc_wc_product_title_icon'		=> '',
		'tpvc_wc_product_title_icon_color'	=> '',
		'tpvc_wc_product_link'			=> __( 'see all', 'tokopress' ),
		'tpvc_wc_product_link_color'	=> '',
		'tpvc_wc_product_per_page' 		=> '6',
		'tpvc_wc_product_columns' 		=> '2',
		'tpvc_wc_product_orderby' 		=> 'date',
		'tpvc_wc_product_order' 		=> 'desc',
		'tpvc_wc_product_hide_title'	=> '',
		'tpvc_wc_product_play'			=> 'false',
		'tpvc_wc_product_class'			=> ''
	), $atts ) );

	if ( $tpvc_wc_product_style == 'style-2' ) {
		$tpvc_wc_product_style = '';
	}
	elseif ( $tpvc_wc_product_style == 'style-1' ) {
		$tpvc_wc_product_style = 'default';
	}

	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'				=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> $tpvc_wc_product_per_page,
		'orderby' 				=> $tpvc_wc_product_orderby,
		'order' 				=> $tpvc_wc_product_order,
		'meta_query' 			=> $meta_query
	);

	ob_start();

	$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

	$woocommerce_loop['columns'] = $tpvc_wc_product_columns;

	if ( $products->have_posts() ) : ?>

	<div class="tpvc-product woocommerce woocommerce-product-col-<?php echo $tpvc_wc_product_columns; ?> <?php echo $tpvc_wc_product_class; ?>">

		<?php if( "hide" != $tpvc_wc_product_hide_title ) : ?>
			<?php 
			if ( $tpvc_wc_product_link_color ) {
				echo '<style>';
				echo '.tpvc-product.woocommerce .tpvc-title a.button { color:'.$tpvc_wc_product_link_color.'; box-shadow: '.$tpvc_wc_product_link_color.' 0 0px 0px 2px inset; }';
				echo '.tpvc-product.woocommerce .tpvc-title a.button:hover { color: #fff; box-shadow: '.$tpvc_wc_product_link_color.' 0 0px 0px 40px inset; }';
				echo '</style>';
			}
			?>

			<?php
			if ( ! $tpvc_wc_product_link ) $tpvc_wc_product_link = __( 'see all', 'tokopress' );
			$shop = get_permalink( wc_get_page_id( 'shop' ) );
			if( "date" == $tpvc_wc_product_orderby ) {
				$see_all = '<a href="' . add_query_arg( 'orderby', 'date', $shop ) . '" class="button">' . $tpvc_wc_product_link . '</a>';
			} elseif ( "price" == $tpvc_wc_product_orderby ) {
				$see_all = '<a href="' . add_query_arg( 'orderby', 'price', $shop ) . '" class="button">' . $tpvc_wc_product_link . '</a>';
			} elseif ( "sales" == $tpvc_wc_product_orderby ) {
				$see_all = '<a href="' . add_query_arg( 'orderby', 'popularity', $shop ) . '" class="button">' . $tpvc_wc_product_link . '</a>';
			} else {
				$see_all = '<a href="' . $shop . '" class="button">' . $tpvc_wc_product_link . '</a>';
			}

			?>
			<div class="tpvc-title" <?php if( "" !== $tpvc_wc_product_title_bg ) echo 'style="background-color:' . $tpvc_wc_product_title_bg . '"'; ?>>
				<h2 <?php if( "" !== $tpvc_wc_product_title_color ) echo 'style="color:' . $tpvc_wc_product_title_color . '"'; ?>>
					<?php if( "" != $tpvc_wc_product_title_icon ) echo '<i class="' . tpvc_icon( $tpvc_wc_product_title_icon ) . '" ' . ( $tpvc_wc_product_title_icon_color ? 'style="color:'.$tpvc_wc_product_title_icon_color.'"' : '' ). '></i>'; ?>
					<?php echo $tpvc_wc_product_title; ?>
				</h2>
				<?php echo $see_all; ?>
			</div>
		<?php endif; ?>

		<ul class="products">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php if( "default" == $tpvc_wc_product_style ) : ?>
					<?php wc_get_template_part( 'content-product' ); ?>
				<?php else : ?>
					<?php wc_get_template_part( 'content-product', 'alt' ); ?>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</ul>

	</div>

	<?php endif;

	wp_reset_postdata();

	return ob_get_clean();
}

add_action( 'vc_before_init', 'tpvc_wc_product_vcmap' );
function tpvc_wc_product_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Product', 'tokopress' ),
	   'base'				=> 'tokopress_product',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
	   							array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Catalog Style', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_style',
									'value'			=> array(
														__( 'Alternate Style', 'tokopress' ) => '',
														__( 'Default Style', 'tokopress' ) => 'default',
														),
									'std'			=> 'default'
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Title', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_title',
									'value'			=> __( 'Product', 'tokopress' )
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Title Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_title_color'
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Title Background Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_title_bg',
								),
								array(
									'type' 			=> 'iconpicker',
									'heading' 		=> __( 'Title Icon', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_product_title_icon',
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
									'param_name'	=> 'tpvc_wc_product_title_icon_color',
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Link Text', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_link',
									'value'			=> __( 'see all', 'tokopress' )
								),
								array(
									'type'			=> 'colorpicker',
									'heading'		=> __( 'Link Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_link_color',
								),
								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Title', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_product_hide_title',
									'value' 		=> array( __( 'Hide Title', 'tokopress' ) => 'hide' )
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Count', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_per_page',
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
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Column', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_columns',
									'value'			=> array(
															'1' => '1',
															'2' => '2',
															'3' => '3',
															'4' => '4',
														),
									'std'			=> '2',
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Order Type', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_order',
									'value'			=> array(
															'Ascending'		=> 'asc',
															'Descending' 	=> 'desc'
														),
									'std'			=> 'desc'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Product Order By', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_orderby',
									'value'			=> array(
															'ID'				=> 'ID',
															'Title'				=> 'title',
															'Most Recent'		=> 'date',
															'Price'				=> 'price',
															'Sales'				=> 'sales',
															'Popular Product'	=> 'comment_count',
															'Random'			=> 'rand'
														),
									'std'			=> 'date'

								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_class',
									'value'			=> '',
								)
							)
		)
	);
}