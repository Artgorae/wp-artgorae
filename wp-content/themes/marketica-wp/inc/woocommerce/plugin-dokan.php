<?php

add_filter( 'tokopress_layout_class', 'tokopress_dokan_layout_class' );
function tokopress_dokan_layout_class( $layout ) {
    if ( dokan_is_store_page () ) {
    	if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) {
			$layout = 'layout-2c-l';
    	}
    	else {
        	if ( ! of_get_option( 'tokopress_wc_hide_products_sidebar' ) ) {
				$layout = 'layout-2c-l';
        	}
        	else {
				$layout = 'layout-1c-full';
        	}
    	}
    }
	return $layout;
}

add_action( 'tokopress_quicknav_account', 'tokopress_dokan_quicknav_account' );
function tokopress_dokan_quicknav_account() {
	if ( ! is_user_logged_in() )
		return;

    global $current_user;

    $user_id = $current_user->ID;
    if ( ! dokan_is_user_seller( $user_id ) )
		return;

    $nav_urls = dokan_get_dashboard_nav();

    foreach ($nav_urls as $key => $item) {
        printf( '<li><a href="%s">%s %s</a></li>', $item['url'], $item['title'], $item['icon'] );
    }
}
