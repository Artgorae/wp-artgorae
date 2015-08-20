<?php
/**
 * Marketica Child Theme functions and definitions.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'after_setup_theme', 'tokopress_load_childtheme_languages', 5 );
function tokopress_load_childtheme_languages() {
	/* this theme supports localization */
	load_child_theme_textdomain( 'tokopress', get_stylesheet_directory() . '/languages' );
		
}

/* Please add your custom functions code below this line. */

add_action( 'tokopress_quicknav_account', 'tokopress_messages_quicknav_account' );
function tokopress_messages_quicknav_account() {
	if ( ! is_user_logged_in() )
		return;

    $url = get_permalink( get_page_by_path( 'inbox' )->ID );
    $title = __( 'Messages', 'dokan' );
    $icon = '<i class="fa fa-envelope"></i>';
    printf( '<li><a href="%s">%s %s</a></li>', $url, $title, $icon );
}
