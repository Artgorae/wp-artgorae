<?php

/**
 * Save the default product data meta.
 */

add_action( 'dokan_new_product_added', 'new_process_product_meta', 10, 2 );

function new_process_product_meta( $product_id )
{
	update_post_meta( $product_id, '_visibility', 'visible' );

	wp_update_post( array(
		'ID'             => $product_id,
		'comment_status' => 'open'
	) );
}


/**
 * Follow button
 */

function get_follow_button()
{
	if ( bp_follow_is_following( array( 'leader_id' => get_the_author_meta( 'ID' ), 'follower_id' => bp_loggedin_user_id() ) ) ) {
		$link_text = __( 'Unfollow', 'artgorae' );
	} else {
		$link_text = __( 'Follow', 'artgorae' );
	}

	$args = array(
		'leader_id' => get_the_author_meta( 'ID' ),
		'follower_id' => bp_loggedin_user_id(),
		'link_text' => $link_text,
		'link_class' => 'button alt',
		'wrapper' => ''
	);
	echo bp_follow_get_add_follow_button( $args );
}

add_filter( 'bp_follow_get_add_follow_button', 'bp_follow_get_add_follow_button_add_icon', 10, 3);
function bp_follow_get_add_follow_button_add_icon( $button, $leader_id, $follower_id ) {
	if ( explode( ' ', $button['link_class'] )[0] == 'follow' ) {
		$link_icon = '<i class="fa fa-star"></i> ';
	} else {
		$link_icon = '<i class="fa fa-star-o"></i> ';
	}
	$button['link_text'] = $link_icon . $button['link_text'];
	return $button;
}


/**
 * Add contact info to purchase note
 */

add_action( 'dokan_new_product_added', 'add_contact_info_to_purchase_note', 10, 2 );

function add_contact_info_to_purchase_note( $product_id )
{
	$post_author_id = get_post_field( 'post_author', $product_id );

	$contact_name = get_the_author_meta( 'user_lastname', $post_author_id ) . get_the_author_meta( 'user_firstname', $post_author_id );
	$contact_email = get_the_author_meta( 'user_email', $post_author_id );
	$contact_info = sprintf( __( "<b>Seller Information</b>\nName: %s\nEmail: %s", 'artgorae' ), $contact_name, $contact_email );

	update_post_meta( $product_id, '_purchase_note', $contact_info );
}


/**
 * Create custom order button
 */

function create_custom_order( $title, $content, $price )
{
	$title = empty( $title ) ? __( 'Custom-order product', 'artgorae' ) : $title;
	$content = empty( $content ) ? __( 'This is a custom-order product.', 'artgorae' ) : $content;

    $post = array(
    	'post_content'  => $content,
        'post_title'    => $title,
        'post_status'	=> 'publish',
        'comment_status'=> 'close',
        'post_type'		=> 'product'
    );
    $post_id = wp_insert_post( $post );
    $custom_term = get_term_by( 'slug', 'custom-order', 'product_cat' );
    wp_set_object_terms( $post_id, $custom_term->term_id, 'product_cat' );
    update_post_meta( $post_id, '_visibility', 'hidden' );
    update_post_meta( $post_id, '_price', $price );
    return $post_id;
}

function get_custom_order_button( $title, $content, $price )
{
    $post_id = create_custom_order( $title, $content, $price );

    $button_link = esc_url( get_permalink( $post_id ) );
    $button_class = 'button alt';
    $button_text = __( 'View Product', 'artgorae' );

    $button_html = sprintf( '<a href="%s" class="%s">%s</a>', $button_link, $button_class, $button_text );
    return $button_html;
}


/**
 * Contact to seller button
 */

add_action( 'tokopress_wc_product_calltoaction', 'add_contact_seller_button', 70 );

function add_contact_seller_button()
{
	$author_username = get_the_author_meta('user_login');
	echo contact_seller_button( $author_username );
	?>
	<style>
	.single_contact_seller_button {
		text-align: center;
		width: 100%;
	}
	</style>
	<?php
}

function contact_seller_button( $author_username ) {
	$button_text = __( 'Ask to Seller', 'artgorae' );
	$subject = __( 'You have new message!', 'artgorae' );
	$button_class = 'single_contact_seller_button single_add_to_cart_button button alt';
	$message_link = do_shortcode("[pm_user user_name=$author_username text='$button_text' class='$button_class' subject='$subject' in_the_loop=true]");

	return $message_link;
}

