<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
tokopress_require_file( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'tokopress_register_required_plugins' );
function tokopress_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(

		/* Required Plugin */
		array(
			'name'		=> 'WooCommerce',
			'slug'		=> 'woocommerce',
			'required'	=> true,
		),

		array(
			'name'     	=> 'TokoPress - Marketica VC & Shortcodes',
			'slug'     	=> 'tokopress-multipurpose-shortcode',
			'source'   	=> get_template_directory() . '/inc/plugins/tokopress-multipurpose-shortcode-v2.5.1.zip',
			'version' 	=> '2.5.1',
			'required' 	=> true,
		),

		array(
			'name'     	=> 'Visual Composer',
			'slug'     	=> 'js_composer',
			'source'   	=> get_template_directory() . '/inc/plugins/js_composer-v4.6.2.zip',
			'version' 	=> '4.6.2',
			'required' 	=> true,
		),

		array(
			'name'		=> 'MailChimp for WordPress',
			'slug'		=> 'mailchimp-for-wp',
			'required'	=> true,
		),

		/* Recommended Plugin */

		array(
			'name'     => 'Revolution Slider',
			'slug'     => 'revslider',
			'source'   => get_template_directory() .'/inc/plugins/revslider-v4.6.93.zip',
			'version' 	=> '4.6.93',
			'required' => false
		),

		array(
			'name'		=> 'WordPress Importer',
			'slug'		=> 'wordpress-importer',
			'source'   	=> get_template_directory() . '/inc/plugins/wordpress-importer-v2.0.zip',
			'version' 	=> '2.0',
			'required' 	=> false,
		),

		array(
			'name'		=> 'Widget Importer Exporter',
			'slug'		=> 'widget-importer-exporter',
			'required'	=> false,
		),

		array(
			'name'		=> 'Regenerate Thumbnails',
			'slug'		=> 'regenerate-thumbnails',
			'required'	=> false,
		),

		// array(
		// 	'name'		=> 'YITH WooCommerce Wishlist',
		// 	'slug'		=> 'yith-woocommerce-wishlist',
		// 	'required'	=> false,
		// ),

	);

	if ( class_exists('WooCommerce_Product_Vendors') ) {
		$show_wcvendors = false;
	}
	elseif ( class_exists('FPMultiVendor') ) {
		$show_wcvendors = false;
	}
	elseif ( class_exists('WeDevs_Dokan') ) {
		$show_wcvendors = false;
	}
	else {
		$show_wcvendors = true;
	}
	if ( $show_wcvendors ) {
		$plugins[] = array(
				'name'		=> 'WC Vendors',
				'slug'		=> 'wc-vendors',
				'required'	=> false,
			);

	}

	if ( class_exists('woocommerce') ) {
		$plugins[] = array(
			'name'     	=> 'WooCommerce - Frontend Submission',
			'slug'     	=> 'wcxt-frontend-submission',
			'source'   	=> get_template_directory() . '/inc/plugins/wcxt-frontend-submission-v1.1.zip',
			'version' 	=> '1.1',
			'required' 	=> false,
		);
		if ( function_exists( 'xt_wc_frontend_submission_shortcode' ) ) {
			$plugins[] = array(
				'name'		=> 'CMB2 - Metabox',
				'slug'		=> 'cmb2',
				'required'	=> true,
			);
		}
	}

	// Text Domain
	$theme_text_domain = 'tokopress';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'tokopress' ),
			'menu_title'                       			=> __( 'Install Plugins', 'tokopress' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'tokopress' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'tokopress' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tokopress' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tokopress' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tokopress' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'tokopress' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'tokopress' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'tokopress' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'tokopress' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/* Set Visual Composer as Theme part and disable Visual Composer Updater */
if ( function_exists( 'vc_set_as_theme' ) )
	vc_set_as_theme( true );

/* Set Revolution Slider as Theme part and disable Revolution Slider Updater */
if ( function_exists( 'set_revslider_as_theme' ) )
	set_revslider_as_theme();

/**
 * Enqueue & Dequeue Plugin Scripts
 */
add_action( 'wp_enqueue_scripts', 'tokopress_plugin_scripts', 999 );
add_action( 'wp_footer', 'tokopress_plugin_scripts' );
function tokopress_plugin_scripts() {
	wp_dequeue_style( 'fontawesome' );
	wp_dequeue_style( 'font-awesome' );
	wp_dequeue_style( 'mailchimp-for-wp-checkbox' );
	wp_dequeue_style( 'mailchimp-for-wp-form' );
	wp_dequeue_style( 'yith-wcwl-main' );
	wp_dequeue_style( 'yith-wcwl-font-awesome' );
	wp_dequeue_style( 'yith-wcwl-font-awesome-ie7' );
}

add_filter('vc_load_default_templates','tokopress_load_vc_templates');
function tokopress_load_vc_templates( $args ) {
	$args2 = array (
		array(
			'name'=> '1. '.__('Marketica - Home','tokopress'),
			'image_path'=> THEME_URI . '/img/vc-homepage.png',
			'content'=>'[vc_row el_class="tpvc_row_full"][vc_column width="1/1"][rev_slider_vc alias="homePage" el_class="tpvc_row_full"][/vc_column][/vc_row][vc_row el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_product_search tpvc_wc_search_title="Find your product now, type here and hit enter"][/vc_column][/vc_row][vc_row css=".vc_custom_1423033468018{margin-right: 0px !important;margin-bottom: 0px !important;margin-left: 0px !important;}" el_class="tpvc_row_full"][vc_column width="1/1" offset="vc_col-md-6"][tokopress_featured_product tpvc_wc_featured_title="Featured Product" tpvc_wc_featured_number="6" tpvc_wc_featured_columns="1" tpvc_wc_featured_order="desc" tpvc_wc_featured_orderby="title" tpvc_wc_featured_title_icon="fa fa-bullhorn" tpvc_wc_featured_hide_title=""][/vc_column][vc_column width="1/1" offset="vc_col-md-6"][tokopress_product tpvc_wc_product_title="Latest Products" tpvc_wc_product_title_icon="fa fa-thumbs-o-up" tpvc_wc_product_per_page="6" tpvc_wc_product_columns="2" tpvc_wc_product_order="desc" tpvc_wc_product_orderby="date" tpvc_wc_product_hide_title=""][/vc_column][/vc_row][vc_row css=".vc_custom_1423034234355{padding-top: 50px !important;padding-right: 50px !important;padding-left: 50px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_divider tpvc_divider_icon_option="no" tpvc_divider_heading="h2" tpvc_divider_title_option="no"][/vc_column][/vc_row][vc_row css=".vc_custom_1423098767434{padding-top: 30px !important;padding-right: 50px !important;padding-bottom: 0px !important;padding-left: 30px !important;}"][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="Single Click Easy Shop" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="#" tpvc_features_icon="fa fa-shopping-cart" tpvc_features_description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin libero ante, pharetra a nibh at, commodo eleifend est. Nullam eget adipiscing lacus. Suspendisse sed ante sed elit porta auctor non vel ante. Nullam vel tempus risus. Donec non posuere justo. Nam vestibulum" tpvc_features_icon_color="#a5d383"][/vc_column][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="24-hour Active Support" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="#" tpvc_features_icon="fa fa-phone" tpvc_features_description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin libero ante, pharetra a nibh at, commodo eleifend est. Nullam eget adipiscing lacus. Suspendisse sed ante sed elit porta auctor non vel ante. Nullam vel tempus risus. Donec non posuere justo. Nam vestibulum" tpvc_features_icon_color="#718aac"][/vc_column][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="Hight Quality Items" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="3" tpvc_features_icon="fa fa-thumbs-o-up" tpvc_features_description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin libero ante, pharetra a nibh at, commodo eleifend est. Nullam eget adipiscing lacus. Suspendisse sed ante sed elit porta auctor non vel ante. Nullam vel tempus risus. Donec non posuere justo. Nam vestibulum" tpvc_features_icon_color="#41bcc3"][/vc_column][/vc_row][vc_row css=".vc_custom_1423033570729{margin-top: 30px !important;margin-bottom: 0px !important;padding-right: 50px !important;padding-left: 50px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_divider tpvc_divider_icon_option="no" tpvc_divider_heading="h2" tpvc_divider_title_option="no"][/vc_column][/vc_row][vc_row css=".vc_custom_1423033611014{margin-bottom: 0px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_mini_product tpvc_wc_product_title="New Items" tpvc_wc_product_title_icon="fa fa-fire" tpvc_wc_product_order="desc" tpvc_wc_product_orderby="date" tpvc_wc_product_hide_title=""][/vc_column][/vc_row][vc_row css=".vc_custom_1423091292191{padding-top: 50px !important;padding-right: 50px !important;padding-bottom: 50px !important;padding-left: 50px !important;}" el_class="tpvc_row_full"][vc_column width="1/2" css=".vc_custom_1423091235132{padding-bottom: 30px !important;}"][tokopress_testimonial name="John Doe" image_size="thumbnail" excerpt="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin libero ante, pharetra a nibh at, commodo eleifend est. Nullam eget adipiscing lacus. Suspendisse sed ante sed elit porta auctor non vel ante. Nullam vel tempus risus. Donec non posuere justo. Nam vestibulum" role="Web Designer" link_url="#" box_border="border-none" image=""][/vc_column][vc_column width="1/2" css=".vc_custom_1423091246591{padding-bottom: 30px !important;}"][tokopress_testimonial name="Rachel Davis" image_size="thumbnail" excerpt="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin libero ante, pharetra a nibh at, commodo eleifend est. Nullam eget adipiscing lacus. Suspendisse sed ante sed elit porta auctor non vel ante. Nullam vel tempus risus. Donec non posuere justo. Nam vestibulum" role="Women Fashion" link_url="#" box_border="border-none" image=""][/vc_column][/vc_row][vc_row el_class="tpvc_row_full"][vc_column width="1/2" css=".vc_custom_1423411660325{background-image: url(http://demo.toko.press/marketica2-standard/wp-content/uploads/2015/02/marketica-background-dummy-01.png?id=2407) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][tokopress_call_to_action paragraf_title="Start Shopping Now" paragraf_title_color="#ffffff" paragraf_text="We Offer You a Very Good Deals that you will newer regret." paragraf_text_color="#ffffff" paragraf_align="text-left" button_text="Shop Now" button_link="#" button_color="button-white" button_align="text-right"][/vc_column][vc_column width="1/2" css=".vc_custom_1423411677938{background-image: url(http://demo.toko.press/marketica2-standard/wp-content/uploads/2015/02/marketica-background-dummy-02.png?id=2406) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][tokopress_call_to_action paragraf_title="Partner With Us" paragraf_title_color="#ffffff" paragraf_text="Sign and Start Selling With Us. We Share The Highest Rate." paragraf_text_color="#ffffff" paragraf_align="text-left" button_text="Start Selling" button_link="#" button_color="button-white" button_align="text-right"][/vc_column][/vc_row][vc_row css=".vc_custom_1423033662935{padding-top: 20px !important;padding-bottom: 20px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_heading text="Some Companies Used Our Service" heading="h2" text_align="text-center" heading_icon="fa fa-users"][/vc_column][/vc_row][vc_row css=".vc_custom_1423034152072{padding-bottom: 50px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][tokopress_image_carousel single="no" image_show="6" image_size="full" carousel_id="home-carousel" images=""][/vc_column][/vc_row]',
		),
		array(
			'name'=> '2. '.__('Marketica - Plan &amp; Pricing','tokopress'),
			'image_path'=> THEME_URI . '/img/vc-planpricing.png',
			'content'=>'[vc_row el_class="tpvc_row_full"][vc_column width="1/2" offset="vc_col-md-3"][tokopress_pricing tpvc_plantable_title="FREE" tpvc_plantable_currencies="$" tpvc_plantable_value="0" tpvc_plantable_info="per month" tpvc_plantable_items="1 User;
Unlimited Page Views;
Standart Feature;
Lorem Ipsum Dolor Sit.;
Consectetur Adipisicing" tpvc_plantable_btn_text="CHOOSE PLAN"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_pricing tpvc_plantable_title="REGULAR" tpvc_plantable_currencies="$" tpvc_plantable_value="20" tpvc_plantable_info="per month" tpvc_plantable_items="10 Users;
Unlimited Page Views;
Standart Feature;
Lorem Ipsum Dolor Sit.;
Consectetur Adipisicing" tpvc_plantable_btn_text="CHOOSE PLAN" tpvc_plantable_btn_url="#"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_pricing tpvc_plantable_featured="featured" tpvc_plantable_title="PRO" tpvc_plantable_currencies="$" tpvc_plantable_value="40" tpvc_plantable_info="per month" tpvc_plantable_items="100 User;
Unlimited Page Views;
Standart Feature;
Lorem Ipsum Dolor Sit.;
Consectetur Adipisicing" tpvc_plantable_btn_text="CHOOSE PLAN" tpvc_plantable_btn_url="#"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_pricing tpvc_plantable_title="PLATINUM" tpvc_plantable_currencies="$" tpvc_plantable_value="75" tpvc_plantable_info="per month" tpvc_plantable_items="Unlimited Users;
Unlimited Page Views;
Standart Feature;
Lorem Ipsum Dolor Sit.;
Consectetur Adipisicing" tpvc_plantable_btn_text="CHOOSE PLAN" tpvc_plantable_btn_url="#"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][tokopress_divider tpvc_divider_title_option="yes" tpvc_divider_icon_option="yes" tpvc_divider_heading="h1" tpvc_divider_icon="fa-check-circle-o"][/vc_column][/vc_row][vc_row css=".vc_custom_1408532563379{padding: 50px !important;}"][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="Single Click Easy Shop" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="#" tpvc_features_icon="fa fa-shopping-cart" tpvc_features_description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." tpvc_features_icon_color="#a5d383"][/vc_column][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="24-Hours Active Support" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="#" tpvc_features_icon="fa fa-phone" tpvc_features_description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." tpvc_features_icon_color="#718aac"][/vc_column][vc_column width="2/3" offset="vc_col-md-offset-0 vc_col-md-4 vc_col-sm-offset-2"][tokopress_features tpvc_features_title="Hight Quality Items" tpvc_features_icon_position="left-icon" tpvc_features_heading="h2" tpvc_features_url="#" tpvc_features_icon="fa fa-thumbs-o-up" tpvc_features_description="Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." tpvc_features_icon_color="#41bcc3"][/vc_column][/vc_row]',
		),
		array(
			'name'=> '3. '.__('Marketica - Team Members','tokopress'),
			'image_path'=> THEME_URI . '/img/vc-teammembers.png',
			'content'=>'[vc_row css=".vc_custom_1423034465179{padding-top: 50px !important;padding-right: 50px !important;padding-bottom: 50px !important;padding-left: 50px !important;}" el_class="tpvc_row_full"][vc_column width="1/1"][vc_column_text el_class="text-center text-large"]Meet The Team That Built Marketica[/vc_column_text][vc_column_text el_class="text-center"]Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit, optio voluptate obcaecati veritatis exercitationem. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit.[/vc_column_text][/vc_column][/vc_row][vc_row el_class="tpvc_row_full"][vc_column width="1/2" offset="vc_col-md-3"][tokopress_team name="JHON WILLIAM DOE" image_size="full" skill="CEO/Co-Founder" excerpt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit, optio voluptate obcaecati veritatis exercitationem." link_url="#" image="1941"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_team name="JANE ROE" image_size="full" skill="CTO/Co-Founder" excerpt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit, optio voluptate obcaecati veritatis exercitationem." link_url="#" image="1937"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_team name="WILLIAM SMITH" image_size="full" skill="Developer" excerpt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit, optio voluptate obcaecati veritatis exercitationem." link_url="#" image="1938"][/vc_column][vc_column width="1/2" offset="vc_col-md-3"][tokopress_team name="CINDY DAVIS" image_size="full" skill="Designer" excerpt="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, in, neque, dolor voluptatibus quidem id impedit, optio voluptate obcaecati veritatis exercitationem." link_url="#" image="1939"][/vc_column][/vc_row]',
		),
	);
	return array_merge( $args, $args2 );
}

if ( shortcode_exists( 'wcxt-frontend-submission' ) ) {
	add_action( 'vc_before_init', 'tokopress_wc_frontend_submission_vcmap' );
	function tokopress_wc_frontend_submission_vcmap() {

		if ( ! class_exists('woocommerce') )
			return;

		vc_map( array(
		   'name'				=> __( 'WooCommerce - Frontend Submission', 'tokopress' ),
		   'base'				=> 'wcxt-frontend-submission',
		   'class'				=> '',
		   'icon'				=> 'tokopress_icon',
		   'category'			=> 'Tokopress - Marketica',
		   // 'admin_enqueue_css' 	=> array( SHORTCODE_URL . '/css/component.css' ),
		   'params'				=> array(
		   							array(
										'type'			=> 'dropdown',
										'heading'		=> __( 'Visibility', 'tokopress' ),
										'description'	=> __( 'Vendor: only vendor can see frontend submission form', 'tokopress' ).'<br/>'.__( 'User: all logged-in users can see frontend submission form', 'tokopress' ).'<br/>'.__( 'All: everyone can see frontend submission form', 'tokopress' ),
										'param_name'	=> 'show_on',
										'value'			=> array(
															''			=> '',
															'Vendor'	=> 'vendor',
															'User'		=> 'user',
															'All'		=> 'all',
														),
										'std'			=> ''
									),

		   							array(
										'type'			=> 'dropdown',
										'heading'		=> __( 'Product Type', 'tokopress' ),
										'param_name'	=> 'product_type',
										'value'			=> array(
															''							=> '',
															'Physical'					=> 'physical',
															'Virtual (Service)'			=> 'virtual',
															'Digital (Downloadable)'	=> 'digital',
															'External/Affiliate'		=> 'external',
														),
										'std'			=> ''
									),

									array(
										'type'			=> 'dropdown',
										'heading'		=> __( 'Product SKU', 'tokopress' ),
										'param_name'	=> 'product_sku',
										'value'			=> array(
															'No'		=> 'no',
															'Yes'		=> 'yes',
														),
										'std'			=> 'no'
									),

									array(
										'type'			=> 'dropdown',
										'heading'		=> __( 'Product Status', 'tokopress' ),
										'param_name'	=> 'product_sku',
										'value'			=> array(
															'Pending Review'	=> 'pending',
															'Published'			=> 'publish',
															'Draft'				=> 'draft',
														),
										'std'			=> 'pending'
									),

								)
		   )
		);
	}
}