<?php
/**
 * Theme Customizer
 */

add_action( 'customize_register', 'tokopress_customize_reposition', 20 );
function tokopress_customize_reposition( $wp_customize ) {
	$wp_customize->get_section( 'background_image' )->priority = 140;
	$wp_customize->get_section( 'background_image' )->title = __( 'Background', 'tokopress' );
	$wp_customize->get_control( 'background_color' )->section = 'background_image';

	$wp_customize->get_section( 'header_image' )->priority = 2;
	$wp_customize->get_section( 'header_image' )->title = __( 'Header (Page Title)', 'tokopress' );
	$wp_customize->get_section( 'header_image' )->panel = 'tokopress_header_panel';
	$wp_customize->remove_control('header_textcolor');

}

/**
 * Panel Header
 */
add_filter( 'tokopress_customizer_panels', 'tokopress_customize_header_panel' );
function tokopress_customize_header_panel( $tk_panels ) {
	$tk_panels[] = array(
			'ID'			=> 'tokopress_header_panel',
			'priority'		=> 145,
			'title'			=> __( 'Header', 'tokopress' ),
			'description'	=> __( 'Customize your header sections', 'tokopress' )
		);

	return $tk_panels;
}

/**
 * Fonts
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_customize_fonts_section' );
function tokopress_customize_fonts_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_fonts_section',
			'label'		=> __( 'Fonts', 'tokopress' ),
			'priority'	=> 135,
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_customize_fonts_colors' );
function tokopress_customize_fonts_colors( $tk_colors ) {
	$tk_colors[] = array( 
		'slug'		=> 'tokopress_font_body', 
		'default'	=> 'Merriweather Sans', 
		'label'		=> __( 'Primary Font', 'tokopress' ),
		'section'	=> 'tokopress_fonts_section',
		'type' 		=> 'select_font',
		'transport'	=> 'refresh',
		'selector'	=> 'body,input[type=text],input[type=password],input[type=email],textarea,.blog-list .entry-content .blog-title a,.blog-single .entry-content .blog-title a,.page .entry-content .blog-title a,.widget .widget-title,.woocommerce ul.products li.product h3,.woocommerce-page ul.products li.product h3,.tpvc-feature .feature-title,.tpvc-call-to-action .call-wrapper .call-paragraf .call-title, .widget .sub-category .sub-block h3',
		'property'	=> 'font-family'
	);
	$tk_colors[] = array( 
		'slug'		=> 'tokopress_font_heading', 
		'default'	=> 'Maven Pro', 
		'label'		=> __( 'Secondary Font', 'tokopress' ),
		'section'	=> 'tokopress_fonts_section',
		'type' 		=> 'select_font',
		'transport'	=> 'refresh',
		'selector'	=> 'h1,h2,h3,h4,h5,select,input[type=submit],.button,#submit,.site-header .header-menu li a,.site-navigation ul li a,.post_tag-cloud a,.widget_tag_cloud a,.widget_product_tag_cloud a,.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button,.woocommerce-page a.button,.woocommerce-page button.button,.woocommerce-page input.button,.woocommerce-page #respond input#submit,.woocommerce-page #content input.button,.woocommerce ul.products li.product-hover-caption .product-title,.woocommerce-page ul.products li.product-hover-caption .product-title,.woocommerce div.product .wc-main-content-right ul.list-item-details, .woocommerce #content div.product .wc-main-content-right ul.list-item-details,.woocommerce-page div.product .wc-main-content-right ul.list-item-details,.woocommerce-page #content div.product .wc-main-content-right ul.list-item-details,.woocommerce div.product .wc-main-content-right .product_meta, .woocommerce #content div.product .wc-main-content-right .product_meta,.woocommerce-page div.product .wc-main-content-right .product_meta,.woocommerce-page #content div.product .wc-main-content-right .product_meta,.woocommerce div.product div.woocommerce-tabs ul.tabs li, .woocommerce #content div.product div.woocommerce-tabs ul.tabs li,.woocommerce-page div.product div.woocommerce-tabs ul.tabs li,.woocommerce-page #content div.product div.woocommerce-tabs ul.tabs li,.mv_submit,.mv_delete_app',
		'property'	=> 'font-family'
	);

	return $tk_colors;
}

/**
 * Header (Top)
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_header_top_section' );
function tokopress_header_top_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_header_top_section',
			'label'		=> __( 'Header (Top)', 'tokopress' ),
			'priority'	=> 1,
			'panel_id'	=> 'tokopress_header_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_header_top_color' );
function tokopress_header_top_color( $tk_colors ) {
	$tk_colors[] = array( 
		'slug'		=> 'tokopress_head_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Header Background', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header, .site-header .header-menu li .sub-menu, .site-header .quicknav-account .account-menu',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_logo_bg',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Logo Background', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .site-logo',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_primary_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Primary Menu (Header Menu) Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .header-menu li a, .site-header .header-right a, .site-header .header-right-search a, .site-header .search-form .search-field',
		'property'	=> 'color',
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_primary_color_hover',
		'default'	=> '',
		'priority'	=> 4,
		'label'		=> __( 'Primary Menu (Header Menu) Hover Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .header-menu li a:hover, .site-header .header-right a:hover, .site-header .header-right-search a:hover, .site-header .quicknav-account .account-menu li a:hover',
		'property'	=> 'color',
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_cart_bg',
		'default'	=> '',
		'priority'	=> 5,
		'label'		=> __( 'Cart Link - Background', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .quicknav-cart',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_cart_color_icon',
		'default'	=> '',
		'priority'	=> 6,
		'label'		=> __( 'Cart Link - Icon Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .quicknav-cart .quicknav-icon',
		'property'	=> 'color',
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_cart_color_text',
		'default'	=> '',
		'priority'	=> 7,
		'label'		=> __( 'Cart Link - Text Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-header .quicknav-cart .cart-subtotal',
		'property'	=> 'color',
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_secondary_bg',
		'default'	=> '',
		'priority'	=> 11,
		'label'		=> __( 'Secondary Menu (Below Header) Background', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-navigation-wrap, .site-navigation-megamenu-wrap, .site-navigation, .site-navigation ul li .sub-menu li a, .hideshow ul',
		'property'	=> 'background-color',
		'selector2'	=> '.site-navigation .site-navigation-menu > li, .hideshow ul',
		'property2'	=> 'border-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_secondary_color',
		'default'	=> '',
		'priority'	=> 12,
		'label'		=> __( 'Secondary Menu (Below Header) Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-navigation ul li a',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_secondary_border',
		'default'	=> '',
		'priority'	=> 13,
		'label'		=> __( 'Secondary Menu (Below Header) Border Color', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-navigation ul li .sub-menu, .site-navigation ul li .sub-menu li ul, .site-navigation .site-navigation-menu > li:hover, .site-navigation .site-navigation-menu > li.current-menu-item ',
		'property'	=> 'border-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_head_secondary_bg_submenu_hover',
		'default'	=> '',
		'priority'	=> 14,
		'label'		=> __( 'Secondary Menu (Below Header) Hover Submenu Background', 'tokopress' ),
		'section'	=> 'tokopress_header_top_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.site-navigation ul li .sub-menu li:hover a',
		'property'	=> 'background-color'
	);

	return $tk_colors;
}

/**
 * Header (Page Title)
 */
add_filter( 'tokopress_customizer_data', 'tokopress_page_title_color' );
function tokopress_page_title_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_page_title_bg',
		'default'	=> '',
		'priority'	=> 11,
		'label'		=> __( 'Page Title Background', 'tokopress' ),
		'section'	=> 'header_image',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.page-header',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_page_title_color',
		'default'	=> '',
		'priority'	=> 12,
		'label'		=> __( 'Page Title Color', 'tokopress' ),
		'section'	=> 'header_image',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.page-header .page-title',
		'property'	=> 'color'
	);

	return $tk_colors;
}
add_filter( 'tokopress_customizer_data', 'tokopress_breadcrumb_color' );
function tokopress_breadcrumb_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_breadcrumb_color',
		'default'	=> '',
		'priority'	=> 13,
		'label'		=> __( 'Breadcrumb Color', 'tokopress' ),
		'section'	=> 'header_image',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.breadcrumbs',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_breadcrumb_link_color',
		'default'	=> '',
		'priority'	=> 14,
		'label'		=> __( 'Breadcrumb Link Color', 'tokopress' ),
		'section'	=> 'header_image',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.breadcrumbs a',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_breadcrumb_sep_color',
		'default'	=> '',
		'priority'	=> 15,
		'label'		=> __( 'Breadcrumb Separator Color', 'tokopress' ),
		'section'	=> 'header_image',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.breadcrumbs .sep .fa',
		'property'	=> 'color'
	);

	return $tk_colors;
}

/**
 * Footer Panel
 */
add_filter( 'tokopress_customizer_panels', 'tokopress_customize_footer_panel' );
function tokopress_customize_footer_panel( $tk_panels ) {
	$tk_panels[] = array(
			'ID'			=> 'tokopress_footer_panel',
			'priority'		=> 150,
			'title'			=> __( 'Footer', 'tokopress' ),
			'description'	=> __( 'Customize your footer sections', 'tokopress' )
		);

	return $tk_panels;
}

/**
 * Footer Widget
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_footer_widget_section' );
function tokopress_footer_widget_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_footer_widget_section',
			'label'		=> __( 'Footer Widget', 'tokopress' ),
			'priority'	=> 1,
			'panel_id'	=> 'tokopress_footer_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_footer_widget_color' );
function tokopress_footer_widget_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Footer Widget Background', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '#footer',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Footer Widget Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '#footer, #footer p',
		'property'	=> 'color',
		'propertyadd'	=> '!important'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_link_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Footer Widget Link Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '#footer a',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_title_color',
		'default'	=> '',
		'priority'	=> 4,
		'label'		=> __( 'Footer Widget Title Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.widget .widget-title',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_border_sep_color',
		'default'	=> '',
		'priority'	=> 5,
		'label'		=> __( 'Footer Widget Border Separator Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.footer-widgets',
		'property'	=> 'border-right-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_widget_border_top_color',
		'default'	=> '',
		'priority'	=> 6,
		'label'		=> __( 'Footer Widget Border Top Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_widget_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.footer-widgets',
		'property'	=> 'border-top-color'
	);

	return $tk_colors;
}

/**
 * Footer Credit
 */
add_filter( 'tokopress_customizer_sections', 'tokopress_footer_credit_section' );
function tokopress_footer_credit_section( $tk_sections ) {
	$tk_sections[] = array(
			'slug'		=> 'tokopress_footer_credit_section',
			'label'		=> __( 'Footer Credit', 'tokopress' ),
			'priority'	=> 2,
			'panel_id'	=> 'tokopress_footer_panel'
		);

	return $tk_sections;
}
add_filter( 'tokopress_customizer_data', 'tokopress_footer_credit_color' );
function tokopress_footer_credit_color( $tk_colors ) {
	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_credit_bg',
		'default'	=> '',
		'priority'	=> 1,
		'label'		=> __( 'Footer Credit Background', 'tokopress' ),
		'section'	=> 'tokopress_footer_credit_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.footer-credits',
		'property'	=> 'background-color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_credit_color',
		'default'	=> '',
		'priority'	=> 2,
		'label'		=> __( 'Footer Credit Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_credit_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.footer-credits .copyright',
		'property'	=> 'color'
	);

	$tk_colors[] = array(
		'slug'		=> 'tokopress_footer_credit_link_color',
		'default'	=> '',
		'priority'	=> 3,
		'label'		=> __( 'Footer Credit Link Color', 'tokopress' ),
		'section'	=> 'tokopress_footer_credit_section',
		'transport'	=> 'postMessage',
		'type' 		=> 'color',
		'selector'	=> '.footer-credits .copyright a',
		'property'	=> 'color'
	);

	return $tk_colors;
}
