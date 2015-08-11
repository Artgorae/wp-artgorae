<?php
/**
 * Tokopress WooCommerce Mini Vendor
 *
 * @package WooCommerce Mini Vendor
 * @author Tokopress
 */

add_shortcode( 'tokopress_mini_vendors', 'tpvc_wc_mini_vendors_dokan_shortcode' );

function tpvc_wc_mini_vendors_dokan_shortcode( $atts ) {
	if ( ! class_exists('woocommerce') )
		return;

	if ( ! class_exists('WeDevs_Dokan') )
		return;

	extract( shortcode_atts( array(
		'tpvc_wc_vendor_title'		=> 'Vendors',
		'tpvc_wc_vendor_title_icon'	=> '',
		'tpvc_wc_vendor_numbers' 	=> 36,
		'tpvc_wc_vendor_columns' 	=> 12,
		'tpvc_wc_vendor_columns_tablet' => 9,
		'tpvc_wc_vendor_columns_mobile' => 4,
		'tpvc_wc_vendor_orderby' 	=> 'registered',
		'tpvc_wc_vendor_order' 		=> 'asc',
		'tpvc_wc_vendor_hide_title'	=> '',
		'tpvc_wc_vendor_show_products' => 'no',
		'tpvc_wc_vendor_class'		=> ''
	), $atts ) );

	$meta_query = WC()->query->get_meta_query();

	if ( intval( $tpvc_wc_vendor_numbers ) < 1 ) {
		$tpvc_wc_vendor_numbers = 36;
	}
	if ( intval( $tpvc_wc_vendor_columns ) < 1 ) {
		$tpvc_wc_vendor_columns = 12;
	}
	if ( intval( $tpvc_wc_vendor_columns_tablet ) < 1 ) {
		$tpvc_wc_vendor_columns_tablet = 9;
	}
	if ( intval( $tpvc_wc_vendor_columns_mobile ) < 1 ) {
		$tpvc_wc_vendor_columns_mobile = 4;
	}

	$tpvc_wc_vendor_class .= ' tpvc-mini-product-col-md-'.$tpvc_wc_vendor_columns;
	$tpvc_wc_vendor_class .= ' tpvc-mini-product-col-sm-'.$tpvc_wc_vendor_columns_tablet;
	$tpvc_wc_vendor_class .= ' tpvc-mini-product-col-xs-'.$tpvc_wc_vendor_columns_mobile;

  	$paged = 1;
  	$offset = 0;

  	// Get the paged vendors 
  	$vendor_paged_args = array ( 
        'meta_query' => array(
            array(
                'key'     => 'dokan_enable_selling',
                'value'   => 'yes',
                'compare' => '='
            )
        ),
		'orderby' 			=> $tpvc_wc_vendor_orderby,
		'order'				=> $tpvc_wc_vendor_order,
  		'offset' 			=> $offset, 
  		'number' 			=> $tpvc_wc_vendor_numbers, 
  	);

  	$vendor_paged_query = New WP_User_Query( $vendor_paged_args ); 
  	$paged_vendors = $vendor_paged_query->get_results(); 

  	// Pagination calcs 
	// $total_vendors = count($all_vendors);  
	// $total_vendors_paged = count($paged_vendors);  
	// $total_pages = intval($total_vendors / $per_page) + 1;
	    
	ob_start();

	if ( !empty( $paged_vendors ) ) : ?>

	<div class="tpvc-mini-product woocommerce <?php echo $tpvc_wc_vendor_class; ?>">

		<?php if( "hide" != $tpvc_wc_vendor_hide_title ) : ?>
			<div class="tpvc-title"><h2><?php if( "" != $tpvc_wc_vendor_title_icon ) echo '<i class="' . tpvc_icon( $tpvc_wc_vendor_title_icon ) . '"></i>'; ?><?php echo $tpvc_wc_vendor_title; ?></h2></div>
		<?php endif; ?>

		<ul class="products">

			<?php foreach ($paged_vendors as $vendor) : ?>

                <?php 
                $store_info = dokan_get_store_info( $vendor->ID );
                $vendor_name = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : __( 'N/A', 'dokan' );
                $vendor_link  = dokan_get_store_url( $vendor->ID );
                ?>

				<li class="product">

					<?php echo get_avatar( $vendor->ID, 200 ); ?>

					<div class="mini-icon-view">
						<a href="<?php echo esc_url( $vendor_link ); ?>" title="<?php echo esc_attr( $vendor_name ); ?>">
							<i class="fa fa-search"></i>
						</a>
					</div>

				</li>

			<?php endforeach; // end of the loop. ?>

		</ul>

	</div>

	<?php endif;

	return ob_get_clean();
}

add_action( 'vc_before_init', 'tpvc_wc_mini_vendors_dokan_vcmap' );
function tpvc_wc_mini_vendors_dokan_vcmap() {
	if ( ! class_exists('woocommerce') )
		return;

	if ( ! class_exists('WeDevs_Dokan') )
		return;

	vc_map( array(
	   'name'				=> __( 'WooCommerce - Mini Vendors Thumbnail', 'tokopress' ),
	   'base'				=> 'tokopress_mini_vendors',
	   'class'				=> '',
	   'icon'				=> 'woocommerce_icon',
	   'category'			=> 'Tokopress - Marketica',
	   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
	   'params'				=> array(
								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Title', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_title',
									'value'			=> __( 'Vendors', 'tokopress' )
								),
								array(
									'type' => 'iconpicker',
									'heading' => __( 'Title Icon', 'tokopress' ),
									'param_name' => 'tpvc_wc_vendor_title_icon',
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
									'param_name' 	=> 'tpvc_wc_vendor_hide_title',
									'value' 		=> array( __( 'Hide Title', 'tokopress' ) => 'hide' )
								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Number of Products To Show', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_numbers',
									'value'			=> '36',
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Number of Columns Per Row (Desktop)', 'tokopress' ),
									'description'	=> __( 'For device width > 992px', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_columns',
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
									'param_name'	=> 'tpvc_wc_vendor_columns_tablet',
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
									'param_name'	=> 'tpvc_wc_vendor_columns_mobile',
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
									'heading'		=> __( 'Order', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_order',
									'value'			=> array(
															'Ascending'		=> 'asc',
															'Descending' 	=> 'desc'
														),
									'std'			=> 'asc'
								),
								array(
									'type'			=> 'dropdown',
									'heading'		=> __( 'Order By', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_orderby',
									'value'			=> array(
															'Registered Date'	=> 'registered',
															'Display Name'		=> 'display_name',
															'Username'			=> 'login',
															'ID'				=> 'ID',
														),
									'std'			=> 'registered'

								),

								array(
									'type'			=> 'textfield',
									'heading'		=> __( 'Extra Class', 'tokopress' ),
									'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'tokopress' ),
									'param_name'	=> 'tpvc_wc_vendor_class',
									'value'			=> '',
								)
							)
		)
	);
}
