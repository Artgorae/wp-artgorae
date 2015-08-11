<?php
/**
 * Frontend Control
 */

/**
 * WooCommerce Theme Support
 */
add_theme_support( 'woocommerce' );

// breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_breadcrumb_defaults', 'tokopress_breadcrumb_filter' );
function tokopress_breadcrumb_filter( $args ) {
	return array(
		'delimiter'   => ' <i class="fa fa-angle-right"></i> ',
		'wrap_before' => '<div class="breadcrumb-trail breadcrumbs">',
		'wrap_after'  => '</div>',
		'before'      => '',
		'after'       => '',
		'home'        => __( 'Home', 'tokopress' ),
	);
}

/* TODO: remove it because we use new page header style */
// add_action( 'woocommerce_before_main_content', 'tokopress_shop_description', 20 );
function tokopress_shop_description() {
	$output = '';
	ob_start();
    if ( of_get_option( 'tokopress_wc_hide_products_header' ) ) {
		echo '<h1 class="page-title">';
		woocommerce_page_title();
		echo '</h1>';
    }
	do_action( 'woocommerce_archive_description' );
	$output .= ob_get_clean();
	if ( $output ) {
		echo '<div class="shop_description">'.$output.'</div>';
	}
}

// remove result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
// remove catalog ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// placement pagination and product ordering
add_action( 'tokopress_before_inner_content', 'tokopress_top_content_product' );
function tokopress_top_content_product() {
	if( is_woocommerce() && ! is_product() ) {
		get_template_part( 'woocommerce/block-top-content' );
	}
}

// Remove first
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_thumbnail_product_loop_wrap_start', 		1 );

add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_thumbnail_link_loop_wrap_start', 			2 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 		3 );
add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_thumbnail_link_loop_wrap_end', 			4 );

/* Add To Cart Wrapper */
add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_add_to_cart_product_loop_wrap_start', 	5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_add_btn_detail_product_loop', 			6 );
if( ! of_get_option( 'tokopress_wc_hide_products_cart_button' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 		7 );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_add_to_cart_product_loop_wrap_end', 		8 );

add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_thumbnail_product_loop_wrap_end', 		9 );

if( ! of_get_option( 'tokopress_wc_hide_products_sale_flash' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 		10 );
}

if( ! of_get_option( 'tokopress_wc_hide_products_price' ) ) {
	/* Product Price Wrapper : Upper */
	add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_price_product_loop_wrap_start', 		79 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 				80 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_price_product_loop_wrap_end', 		81 );
}

/* Product Title&Rating Wrapper */
if( ! of_get_option( 'tokopress_wc_hide_products_title' ) || ! of_get_option( 'tokopress_wc_hide_products_rating' )  || ! of_get_option( 'tokopress_wc_hide_products_price' ) ) {
	add_action( 'woocommerce_before_shop_loop_item_title', 'tokopress_title_rating_product_loop_wrap_start', 	99 );
	if( ! of_get_option( 'tokopress_wc_hide_products_rating' ) ) {
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 				5 );
	}
	add_action( 'woocommerce_after_shop_loop_item_title', 'tokopress_title_rating_product_loop_wrap_end', 		6 );
}

/* Product Price Wrapper : Below */
// add_action( 'woocommerce_after_shop_loop_item_title', 'tokopress_price_product_loop_wrap_start', 			9 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 					10 );
// add_action( 'woocommerce_after_shop_loop_item_title', 'tokopress_price_product_loop_wrap_end', 				11 );

function tokopress_add_btn_detail_product_loop() {
	echo '<a href="' . get_permalink() . '" rel="nofollow" class="button detail_button_loop">' . __( 'detail', 'tokopress' ) . '</a>';
}
function tokopress_thumbnail_product_loop_wrap_start() {
	echo '<div class="thumbnail-loop-wrap">';
}
function tokopress_thumbnail_product_loop_wrap_end() {
	echo '</div>';
}
function tokopress_thumbnail_link_loop_wrap_start() {
	echo '<a href="' . get_permalink() . '">';
}
function tokopress_thumbnail_link_loop_wrap_end() {
	echo '</a>';
}
function tokopress_add_to_cart_product_loop_wrap_start() {
	echo '<div class="add-to-cart-loop-wrap">';
}
function tokopress_add_to_cart_product_loop_wrap_end() {
	echo '</div>';
}
function tokopress_title_rating_product_loop_wrap_start() {
	echo '<div class="title-rating-loop-wrap">';
}
function tokopress_title_rating_product_loop_wrap_end() {
	echo '</div>';
}
function tokopress_price_product_loop_wrap_start() {
	echo '<div class="price-loop-wrap">';
}
function tokopress_price_product_loop_wrap_end() {
	echo '</div>';
}

/**
 * Hide products title
 */
// if( of_get_option( 'tokopress_wc_hide_products_title' ) )
	// add_action( 'tokopress_custom_styles', 'tokopress_wc_hide_shop_title' );

// function tokopress_wc_hide_shop_title() {
	// echo '.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3{ display:none; }';

	// echo '.woocommerce ul.products li.product .title-rating-loop-wrap, .woocommerce-page ul.products li.product .title-rating-loop-wrap{ display:none; }';
	// echo '.woocommerce ul.products li.product .price-loop-wrap, .woocommerce-page ul.products li.product .price-loop-wrap{ width: 80%; float: none; margin: 0 auto; text-align: center; }';

	// echo '.woocommerce ul.products li.product .detail-product .product-title {display:none;}';
	// echo '.woocommerce ul.products li.product .detail-product .product-category {display:none;}';
	// echo '.woocommerce ul.products li.product .detail-product .publisher {display:none;}';
// }

/**
 * Hide products price
 */
// if( of_get_option( 'tokopress_wc_hide_products_price' ) )
// 	add_action( 'tokopress_custom_styles', 'tokopress_wc_hide_shop_price' );

// function tokopress_wc_hide_shop_price() {
// 	echo '.woocommerce ul.products li.product .price-loop-wrap, .woocommerce-page ul.products li.product .price-loop-wrap{ display: none; }';
// 	echo '.woocommerce ul.products li.product .title-rating-loop-wrap, .woocommerce-page ul.products li.product .title-rating-loop-wrap{ width: 100% !important; max-width: 100%; padding-left: 0; float: none; margin-left: -1px; text-align: center; }';
// 	echo '.woocommerce ul.products li.product .content-detail span.price {display:none !important;}';
// }

/**
 * Add Class Woocommerce in body class if woocommerce class not exist
 */
function tokopress_wc_add_class( $classes ) {

	global $woocommerce_loop;

	// if ( is_shop() || is_product_category() || is_product_tag() ){

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) )
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

	$classes[] = 'woocommerce-product-col-' . $woocommerce_loop['columns'];

	// }

	if( !is_woocommerce() ){
		$classes[] = 'woocommerce';
	}

	return $classes;
}
add_filter( 'body_class', 'tokopress_wc_add_class' );

// placement sale flash
if( of_get_option( 'tokopress_wc_hide_product_sale_flash' ) ) {
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
}

// placement product image
if( !of_get_option( 'tokopress_wc_product_image_style' ) == 'default' ){
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	add_action( 'woocommerce_before_single_product_summary', 'tokopress_wc_single_product_image_slider', 10 );
}
function tokopress_wc_single_product_image_slider() {
	echo '<div class="product-thumbnail product-images">';
	wc_get_template_part( 'single-product/product-image', 'slider' );
	echo '</div>';
}

/* prefer to hide single title using meta to make it compatible with Schema.org */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// placement rating
if( of_get_option( 'tokopress_wc_hide_product_rating' ) ){
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
}

// placement price
if( of_get_option( 'tokopress_wc_hide_product_price' ) ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}
else {
	add_action( 'tokopress_wc_product_calltoaction', 'woocommerce_template_single_price', 10 );
}

// placement summary
if( of_get_option( 'tokopress_wc_hide_product_summary' ) ){
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
}

// placement add to cart
if( of_get_option( 'tokopress_wc_hide_product_cart_button' ) ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}
else {
	add_action( 'tokopress_wc_product_calltoaction', 'woocommerce_template_single_add_to_cart', 30 );
}

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// legal information
if( of_get_option( 'tokopress_wc_license_show' ) ) {
	add_action( 'tokopress_wc_main_content_right', 'tokopress_custom_legal_information', 12 );
}
function tokopress_custom_legal_information() {
	if( of_get_option( 'tokopress_wc_license_info' ) ){
		echo '<div class="legal-info">';
		echo '<p>' . of_get_option( 'tokopress_wc_license_info' ) . '</p>';
		echo '</div>';
	}

	if( of_get_option( 'tokopress_wc_license_text1' ) && of_get_option( 'tokopress_wc_license_url1' ) ){
		echo '<div class="legal-link license">';
		echo '<a href="' . of_get_option( 'tokopress_wc_license_url1' ) . '">' . of_get_option( 'tokopress_wc_license_text1' )  . '</a>';
		echo '</div>';
	}

	if( of_get_option( 'tokopress_wc_license_text2' ) && of_get_option( 'tokopress_wc_license_url2' ) ){
		echo '<div class="legal-link">';
		echo '<a href="' . of_get_option( 'tokopress_wc_license_url2' ) . '">' . of_get_option( 'tokopress_wc_license_text2' )  . '</a>';
		echo '</div>';
	}
}

// display meta item details
add_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_title', 20 );
function tokopress_product_details_title() {
	?>
	<h3 class="title-item-details"><?php _e( 'Item Details', 'tokopress' ); ?></h3>
	<?php
}

if( !of_get_option( 'tokopress_wc_hide_product_sku' ) ) {
	add_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_sku', 30 );
}
function tokopress_product_details_sku() {
	wc_get_template_part( 'single-product/product-details-sku' );
}

if( !of_get_option( 'tokopress_wc_hide_product_attributes' ) ) {
	add_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_attributes', 40 );
}
add_filter( 'woocommerce_product_tabs', 'tokopress_remove_product_attributes_tab', 98 );
function tokopress_remove_product_attributes_tab( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}
function tokopress_product_details_attributes() {
	wc_get_template_part( 'single-product/product-details-attributes' );
}

if ( of_get_option( 'tokopress_wc_product_details' ) )
	add_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_global', 50 );
function tokopress_product_details_global() {
	wc_get_template_part( 'single-product/product-details-global' );
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
if( !of_get_option( 'tokopress_wc_hide_product_meta_tags' ) )
	add_action( 'tokopress_wc_main_content_right', 'tokopress_product_details_meta', 60 );
function tokopress_product_details_meta() {
	wc_get_template_part( 'single-product/product-details-meta' );
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	$fragments['.site-header .quicknav-cart .cart-subtotal'] = '<span class="cart-subtotal">'. WC()->cart->get_cart_subtotal() .'</span>';
	return $fragments;
}
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

/**
 * Custom product per page
 */
function tokopress_custom_loop_shop_per_page( $cols ) {

	$shop_per_page = of_get_option( 'tokopress_wc_products_per_page' );
	return $shop_per_page;

}
add_filter( 'loop_shop_per_page', 'tokopress_custom_loop_shop_per_page', 20 );

/**
 * Change product column per row
 */
function wc_loop_shop_columns( $number_columns ) {

	$count_column = of_get_option( 'tokopress_wc_products_column_per_row' );
	$number_columns = $count_column;
	return $number_columns;

}
add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );

// placement related and upsells product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
function tokopress_related_upsells_placement() {
	if( is_product() ) {
		if( !of_get_option( 'tokopress_wc_hide_upsells_products' ) )
			woocommerce_upsell_display();

		if( !of_get_option( 'tokopress_wc_hide_related_products' ) )
			woocommerce_output_related_products();
	}
}
add_action( 'tokopress_wc_after_single_product', 'tokopress_related_upsells_placement', 10 );

/**
 * SET related product limit number
 */
function tokopress_related_product_number() {

	if( "" == of_get_option( 'tokopress_wc_products_related_number' ) ) :
		$posts_per_page = 4;
	else :
		$posts_per_page = of_get_option( 'tokopress_wc_products_related_number' );
	endif;

	$args = array(
			'post_type' => 'product',
			'posts_per_page' => $posts_per_page
		);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'tokopress_related_product_number' );

/**
 * SET per-page and column up-sells product
 */
function woocommerce_upsell_display( $posts_per_page = 4, $columns = 4, $orderby = 'rand' ) {
	$posts_per_page = of_get_option('tokopress_wc_products_upsells_number');
	if ( !$posts_per_page ) $posts_per_page = 4;
	woocommerce_get_template( 'single-product/up-sells.php', array(
			'posts_per_page'  => $posts_per_page,
			'orderby'    => $orderby,
			'columns'    => $columns
		) );
}

/**
 * DISABLE cross-sells product on cart page
 */
if( of_get_option( 'tokopress_wc_hide_crosssells_products' ) )
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


/**
 * Add Button Wishlist in single Product
 */
function enollo_move_wc_wishlist_button($product) {
	if ( shortcode_exists('yith_wcwl_add_to_wishlist') ) {
		echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}
}
add_action( 'tokopress_wc_main_content_right', 'enollo_move_wc_wishlist_button', 11 );

add_filter( 'tokopress_header_searchform', 'tokopress_header_seachform_product' );
function tokopress_header_seachform_product( $form ) {
	return 'block-search-product';
}
