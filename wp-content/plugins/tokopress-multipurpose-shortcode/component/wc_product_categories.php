<?php
/**
 * Tokopress WooCommerce Product
 *
 * @package WooCommerce Product
 * @author Tokopress
 */

add_shortcode( 'tokopress_product_categories', 'tpvc_wc_cat_categories_shortcode' );

function tpvc_wc_cat_categories_shortcode( $atts ) {
	if ( ! class_exists('woocommerce') )
		return;

	global $woocommerce_loop;

	extract( shortcode_atts( array(
		'tpvc_wc_cat_style'		=> 'alt',
		'tpvc_wc_cat_title'		=> __( 'Product Category', 'tokopress' ),
		'tpvc_wc_cat_title_icon'=> '',
		'tpvc_wc_cat_parent' 	=> '',
		'tpvc_wc_cat_hide_empty'=> 1,
		'tpvc_wc_cat_numbers' 	=> '6',
		'tpvc_wc_cat_columns' 	=> '3',
		'tpvc_wc_cat_orderby' 	=> 'none',
		'tpvc_wc_cat_order' 	=> 'asc',
		'tpvc_wc_cat_hide_title'=> '',
		'tpvc_wc_cat_class'		=> ''
	), $atts ) );

	if ( isset( $atts[ 'tpvc_wc_cat_ids' ] ) ) {
		$tpvc_wc_cat_ids = explode( ',', $atts[ 'tpvc_wc_cat_ids' ] );
		$tpvc_wc_cat_ids = array_map( 'trim', $ids );
	} else {
		$tpvc_wc_cat_ids = array();
	}

	$tpvc_wc_cat_hide_empty = ( $tpvc_wc_cat_hide_empty == true || $tpvc_wc_cat_hide_empty == 1 ) ? 1 : 0;

	// get terms and workaround WP bug with parents/pad counts
	$args = array(
		'orderby'    => $tpvc_wc_cat_orderby,
		'order'      => $tpvc_wc_cat_order,
		'hide_empty' => $tpvc_wc_cat_hide_empty,
		'include'    => $tpvc_wc_cat_ids,
		'pad_counts' => true,
		'child_of'   => $tpvc_wc_cat_parent
	);

	$product_categories = get_terms( 'product_cat', $args );

	if ( $tpvc_wc_cat_parent !== "" ) {
		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $tpvc_wc_cat_parent ) );
	}

	if ( $tpvc_wc_cat_hide_empty ) {
		foreach ( $product_categories as $key => $category ) {
			if ( $category->count == 0 ) {
				unset( $product_categories[ $key ] );
			}
		}
	}

	if ( $tpvc_wc_cat_numbers ) {
		$product_categories = array_slice( $product_categories, 0, $tpvc_wc_cat_numbers );
	}

	ob_start();

	$woocommerce_loop['columns'] = $tpvc_wc_cat_columns;

	if ( $product_categories ) : ?>

	<div class="tpvc-product woocommerce woocommerce-product-col-<?php echo $tpvc_wc_cat_columns; ?> <?php echo $tpvc_wc_cat_class; ?>">

		<?php if( "hide" != $tpvc_wc_cat_hide_title ) : ?>
			<div class="tpvc-title">
				<h2>
					<?php if( "" != $tpvc_wc_cat_title_icon ) echo '<i class="' . tpvc_icon( $tpvc_wc_cat_title_icon ) . '"></i>'; ?>
					<?php echo $tpvc_wc_cat_title; ?>
				</h2>
			</div>
		<?php endif; ?>

		<ul class="products product-category">

			<?php
			foreach ( $product_categories as $category ) {

				wc_get_template( 'content-product_cat.php', array(
					'category' => $category
				) );

			} ?>

		</ul>

	</div>

	<?php endif;

	return ob_get_clean();
}

add_action( 'vc_before_init', 'tpvc_wc_cat_categories_vcmap' );
function tpvc_wc_cat_categories_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	$args = array(
		'type' => 'post',
		'child_of' => 0,
		'parent' => '',
		'orderby' => 'name',
		'order' => 'ASC',
		'hide_empty' => false,
		'hierarchical' => 1,
		'exclude' => '',
		'include' => '',
		'number' => '',
		'taxonomy' => 'product_cat',
		'pad_counts' => false,

	);
	$categories = get_categories( $args );

	$product_categories_dropdown = array();
	tpvc_vc_getCategoryChilds( 'id', 0, 0, $categories, 0, $product_categories_dropdown );

	$product_categories_dropdown_begin = array(
									__( '[Top Level Only]', 'tokopress' )	=> '0',
									__( '[All Categories]', 'tokopress' )	=> '',
								);
	$product_categories_dropdown = array_merge( $product_categories_dropdown_begin, $product_categories_dropdown );

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Product Categories', 'tokopress' ),
	   'base'				=> 'tokopress_product_categories',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Title', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_title',
									'value'			=> __( 'Product Categories', 'tokopress' )
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Title Icon', 'tokopress' ),
									'param_name' => 'tpvc_wc_cat_title_icon',
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
									'type' 			=> 'checkbox',
									'heading' 		=> __( 'Hide Title', 'tokopress' ),
									'param_name' 	=> 'tpvc_wc_cat_hide_title',
									'value' 		=> array( __( 'Hide Title', 'tokopress' ) => 'hide' )
								),
								array(
									'type' 			=> 'dropdown',
									'heading' 		=> __( 'Parent Category', 'tokopress' ),
									'value' 		=> $product_categories_dropdown,
									'param_name' 	=> 'parent',
									'description' 	=> __( 'Useful to show subcategories', 'tokopress' ),
								),
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Numbers', 'tokopress' ),
									'description'	=> __( 'How many categories to show', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_numbers',
									'value'			=> "8",
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Columns', 'tokopress' ),
									'description'	=> __( 'How many columns per row', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_columns',
									'value'			=> array(
															'1' => '1',
															'2' => '2',
															'3' => '3',
															'4' => '4',
														),
									'std'			=> '3',
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Order By', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_orderby',
									'value'			=> array(
														__( 'None', 'tokopress' )		=> 'none',
														__( 'Name', 'tokopress' )		=> 'name',
														__( 'Count', 'tokopress' )		=> 'count',
														__( 'Slug', 'tokopress' )		=> 'slug',
														__( 'ID', 'tokopress' )			=> 'id'
													),
									'std'			=> 'none'

								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Order Type', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_order',
									'value'			=> array(
															'Ascending'		=> 'asc',
															'Descending' 	=> 'desc'
														),
									'std'			=> 'asc'
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_cat_class',
									'value'			=> '',
								)
							)
		)
	);
}