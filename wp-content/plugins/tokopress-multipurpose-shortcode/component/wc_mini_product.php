<?php
/**
 * Tokopress WooCommerce Mini Product
 *
 * @package WooCommerce Mini Product
 * @author Tokopress
 */

add_shortcode( 'tokopress_mini_product', 'tpvc_wc_mini_product_shortcode' );

function tpvc_wc_mini_product_shortcode( $atts ) {
	if ( ! class_exists('woocommerce') )
		return;

	extract( shortcode_atts( array(
		'tpvc_wc_product_title'		=> 'Product',
		'tpvc_wc_product_title_color'		=> '',
		'tpvc_wc_product_title_bg'			=> '',
		'tpvc_wc_product_title_icon'		=> '',
		'tpvc_wc_product_title_icon_color'	=> '',
		'tpvc_wc_product_numbers' 	=> 36,
		'tpvc_wc_product_columns' 	=> 12,
		'tpvc_wc_product_columns_tablet' 		=> 9,
		'tpvc_wc_product_columns_mobile' 		=> 4,
		'tpvc_wc_product_orderby' 	=> 'date',
		'tpvc_wc_product_order' 	=> 'desc',
		'tpvc_wc_product_hide_title'=> '',
		'tpvc_wc_product_class'		=> ''
	), $atts ) );

	$meta_query = WC()->query->get_meta_query();

	if ( intval( $tpvc_wc_product_numbers ) < 1 ) {
		$tpvc_wc_product_numbers = 36;
	}
	if ( intval( $tpvc_wc_product_columns ) < 1 ) {
		$tpvc_wc_product_columns = 12;
	}
	if ( intval( $tpvc_wc_product_columns_tablet ) < 1 ) {
		$tpvc_wc_product_columns_tablet = 9;
	}
	if ( intval( $tpvc_wc_product_columns_mobile ) < 1 ) {
		$tpvc_wc_product_columns_mobile = 4;
	}

	$tpvc_wc_product_class .= ' tpvc-mini-product-col-md-'.$tpvc_wc_product_columns;
	$tpvc_wc_product_class .= ' tpvc-mini-product-col-sm-'.$tpvc_wc_product_columns_tablet;
	$tpvc_wc_product_class .= ' tpvc-mini-product-col-xs-'.$tpvc_wc_product_columns_mobile;

	$args = array(
		'post_type'				=> 'product',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> $tpvc_wc_product_numbers,
		'orderby' 				=> $tpvc_wc_product_orderby,
		'order' 				=> $tpvc_wc_product_order,
		'meta_query' 			=> $meta_query
	);

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

	<div class="tpvc-mini-product woocommerce <?php echo $tpvc_wc_product_class; ?>">

		<?php if( "hide" != $tpvc_wc_product_hide_title ) : ?>
			<div class="tpvc-title" <?php if( "" !== $tpvc_wc_product_title_bg ) echo 'style="background-color:' . $tpvc_wc_product_title_bg . '"'; ?>>
				<h2 <?php if( "" !== $tpvc_wc_product_title_color ) echo 'style="color:' . $tpvc_wc_product_title_color . '"'; ?>>
					<?php if( "" != $tpvc_wc_product_title_icon ) echo '<i class="' . tpvc_icon( $tpvc_wc_product_title_icon ) . '" ' . ( $tpvc_wc_product_title_icon_color ? 'style="color:'.$tpvc_wc_product_title_icon_color.'"' : '' ). '></i>'; ?>
					<?php echo $tpvc_wc_product_title; ?>
				</h2>
			</div>
		<?php endif; ?>

		<ul class="products">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<li <?php post_class(); ?>>

					<?php the_post_thumbnail( 'shop_thumbnail' ); ?>

					<div class="mini-icon-view">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<i class="fa fa-search"></i>
						</a>
					</div>

				</li>

			<?php endwhile; // end of the loop. ?>

		</ul>

	</div>

	<?php endif;

	wp_reset_postdata();

	return ob_get_clean();
}

add_action( 'vc_before_init', 'tpvc_wc_mini_product_vcmap' );
function tpvc_wc_mini_product_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Mini Products Thumbnail', 'tokopress' ),
	   'base'				=> 'tokopress_mini_product',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
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
									'type' => 'iconpicker',
									'heading' => __( 'Title Icon', 'tokopress' ),
									'param_name' => 'tpvc_wc_product_title_icon',
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
									'heading'		=> __( 'Title Icon Color', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_title_icon_color',
								),
								array(
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Title', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_product_hide_title',
									'value' 		=> array( __( 'Hide Title', 'tokopress' ) => 'hide' )
								),

								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Number of Products To Show', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_numbers',
									'value'			=> array(
															'' => '',
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
															'12' => '12',
															'13' => '13',
															'14' => '14',
															'15' => '15',
															'16' => '16',
															'17' => '17',
															'18' => '18',
															'19' => '19',
															'20' => '20',
															'21' => '21',
															'22' => '22',
															'23' => '23',
															'24' => '24',
															'25' => '25',
															'26' => '26',
															'27' => '27',
															'28' => '28',
															'29' => '29',
															'30' => '30',
															'31' => '31',
															'32' => '32',
															'33' => '33',
															'34' => '34',
															'35' => '35',
															'36' => '36',
														),
									'std'			=> ''
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Number of Columns Per Row (Desktop)', 'tokopress' ),
									'description'	=> __( 'For device width > 992px', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_columns',
									'value'			=> array(
															'' => '',
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
									'std'			=> ''
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Number of Columns Per Row (Tablet)', 'tokopress' ),
									'description'	=> __( 'For device width > 768px and <= 992px', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_columns_tablet',
									'value'			=> array(
															'' => '',
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
									'std'			=> ''
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Number of Columns Per Row (Mobile)', 'tokopress' ),
									'description'	=> __( 'For device width <= 768px', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_product_columns_mobile',
									'value'			=> array(
															'' => '',
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
									'std'			=> ''
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
