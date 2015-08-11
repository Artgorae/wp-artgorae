<?php
/**
 * Woocommerce Customizer
 */

/**
 * Panel WooCommerce
 */
add_filter( 'tokopress_customizer_panels', 'tokopress_customize_woo_panel' );
function tokopress_customize_woo_panel( $tk_panels ) {
	$tk_panels[] = array(
			'ID'			=> 'tokopress_woo_panel',
			'priority'		=> 160,
			'title'			=> __( 'WooCommerce', 'tokopress' ),
			'description'	=> __( 'Customize your woocommerce sections', 'tokopress' )
		);

	return $tk_panels;
}

/**
 * Shop Page
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_wc_product_section' );
function tokopress_wc_product_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_wc_product_section',
			'label'		=> __( 'WC - Shop', 'tokopress' ),
			'priority'	=> 1,
			'panel_id'	=> 'tokopress_woo_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_catalog_order_color' );
function tokopress_wc_catalog_order_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_catalog_order_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Catalog Ordering Background', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.shop-content-top .container',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_catalog_order_color',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Catalog Ordering Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.catalog-order-wrap .section-title',
		'property'	=> 'color'
	);

	return $tk_colors;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_product_sale_flash' );
function tokopress_wc_product_sale_flash( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_sale_flash_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Sale Flash Background', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product span.onsale, .woocommerce-page ul.products li.product span.onsale, .woocommerce #content div.product span.onsale, .woocommerce div.product span.onsale, .woocommerce-page #content div.product span.onsale, .woocommerce-page div.product span.onsale',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_sale_flash_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Sale Flash Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product span.onsale, .woocommerce-page ul.products li.product span.onsale, .woocommerce #content div.product span.onsale, .woocommerce div.product span.onsale, .woocommerce-page #content div.product span.onsale, .woocommerce-page div.product span.onsale',
		'property'	=> 'color'
	);

	return $tk_colors;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_product_general' );
function tokopress_wc_product_general( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_bg_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Product Background', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_sep',
		'default'	=> '',
		'priority'	=> 4,
		'label'		=> __( 'Product Separator', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product .title-rating-loop-wrap, .woocommerce-page ul.products li.product .title-rating-loop-wrap',
		'property'	=> 'border-left-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_color',
		'default'	=> '',
		'priority'	=> 5,
		'label'		=> __( 'Product Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product p, .woocommerce-page ul.products li.product p',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_title_color',
		'default'	=> '',
		'priority'	=> 6,
		'label'		=> __( 'Product Title Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product h3, .woocommerce ul.products li.product h3 a, .woocommerce-page ul.products li.product h3, .woocommerce-page ul.products li.product h3 a, .woocommerce ul.products li.product-hover-caption .product-title, .woocommerce-page ul.products li.product-hover-caption .product-title',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_price_color',
		'default'	=> '',
		'priority'	=> 7,
		'label'		=> __( 'Product Price Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product .price-loop-wrap .price, .woocommerce-page ul.products li.product .price-loop-wrap .price, .woocommerce ul.products li.product-hover-caption span.price, .woocommerce-page ul.products li.product-hover-caption span.price, .tpvc-featured-product.woocommerce ul.products li.product .featured-price .price',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_old_price_color',
		'default'	=> '',
		'priority'	=> 8,
		'label'		=> __( 'Product Old Price Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product .price del, .woocommerce-page ul.products li.product .price del, .woocommerce ul.products li.product-hover-caption span.price del, .woocommerce-page ul.products li.product-hover-caption span.price del, .tpvc-featured-product.woocommerce ul.products li.product .featured-price .price del',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_border_price_color',
		'default'	=> '',
		'priority'	=> 9,
		'label'		=> __( 'Product Border Price Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price',
		'property'	=> 'border-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_caption',
		'default'	=> '',
		'priority'	=> 10,
		'label'		=> __( 'Product Caption Background', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce ul.products li.product .add-to-cart-loop-wrap, .woocommerce-page ul.products li.product .add-to-cart-loop-wrap, .woocommerce ul.products li.product-hover-caption figure figcaption, .woocommerce-page ul.products li.product-hover-caption figure figcaption',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_rating',
		'default'	=> '',
		'priority'	=> 11,
		'label'		=> __( 'Product Rating Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce .star-rating:before',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_product_rating_active',
		'default'	=> '',
		'priority'	=> 12,
		'label'		=> __( 'Product Rating Color (active)', 'tokopress' ),
		'section'	=> 'tokopress_wc_product_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce .star-rating span',
		'property'	=> 'color'
	);

	return $tk_colors;
}

/**
 * Single Product
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_wc_single_prod_section' );
function tokopress_wc_single_prod_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_wc_single_prod_section',
			'label'		=> __( 'WC - Single Product Page', 'tokopress' ),
			'priority'	=> 5,
			'panel_id'	=> 'tokopress_woo_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_single_prod_color' );
function tokopress_wc_single_prod_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_star',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Product Rating', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce .star-rating:before, .woocommerce-page .star-rating:before',
		'property'	=> 'color',
		'propertyadd'	=> '!important'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_star_active',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Product Rating Active', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce .star-rating span, .woocommerce-page .star-rating span',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_price',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Product Price', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_old_price',
		'default'	=> '',
		'priority'	=> 4,
		'label'		=> __( 'Product Old Price', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce div.product span.price del, .woocommerce div.product p.price del, .woocommerce #content div.product span.price del, .woocommerce #content div.product p.price del, .woocommerce-page div.product span.price del, .woocommerce-page div.product p.price del, .woocommerce-page #content div.product span.price del, .woocommerce-page #content div.product p.price del',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_arrow_slider_bg',
		'default'	=> '',
		'priority'	=> 5,
		'label'		=> __( 'Gallery Arrow Background Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce-page div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce-page div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce-page #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce-page #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next',
		'property'	=> 'background-color'
	);
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_single_prod_arrow_slider_color',
		'default'	=> '',
		'priority'	=> 6,
		'label'		=> __( 'Gallery Arrow Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_single_prod_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.woocommerce div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce-page div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce-page div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next, .woocommerce-page #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-prev, .woocommerce-page #content div.product .product-thumbnail.product-images .owl-controls .owl-buttons .owl-next',
		'property'	=> 'color'
	);

	return $tk_colors;
}

/**
 * Related Products
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_wc_related_section' );
function tokopress_wc_related_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_wc_related_section',
			'label'		=> __( 'WC - Related Products', 'tokopress' ),
			'priority'	=> 10,
			'panel_id'	=> 'tokopress_woo_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_related_color' );
function tokopress_wc_related_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_related_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Title Background Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_related_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.related.products h2',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_related_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Title Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_related_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.related.products h2',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_related_border_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Title Border Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_related_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.related.products h2',
		'property'	=> 'border-color'
	);

	return $tk_colors;
}

/**
 * Upsells Product
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_wc_upsells_section' );
function tokopress_wc_upsells_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_wc_upsells_section',
			'label'		=> __( 'WC - Up-Sells Products', 'tokopress' ),
			'priority'	=> 15,
			'panel_id'	=> 'tokopress_woo_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_upsells_color' );
function tokopress_wc_upsells_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_upsells_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Title Background Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_upsells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.upsells.products h2',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_upsells_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Title Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_upsells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.upsells.products h2',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_upsells_border_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Title Border Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_upsells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.upsells.products h2',
		'property'	=> 'border-color'
	);

	return $tk_colors;
}

/**
 * Cross Sells Product
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_wc_crosssells_section' );
function tokopress_wc_crosssells_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_wc_crosssells_section',
			'label'		=> __( 'WC - Cross-Sells Products', 'tokopress' ),
			'priority'	=> 20,
			'panel_id'	=> 'tokopress_woo_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_wc_crosssells_color' );
function tokopress_wc_crosssells_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_crosssells_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Title Background Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_crosssells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.cross-sells h2',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_crosssells_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Title Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_crosssells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.cross-sells h2',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_wc_crosssells_border_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Title Border Color', 'tokopress' ),
		'section'	=> 'tokopress_wc_crosssells_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.cross-sells h2',
		'property'	=> 'border-color'
	);

	return $tk_colors;
}
