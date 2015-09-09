<?php
/**
 * Dokan Seller Single product tab Template
 *
 * @since 2.4
 *
 * @package dokan
 */

global $product;
$post_id = $product->post->ID;
?>

<h2><?php _e( 'Seller Policies', 'artgorae' ); ?></h2>

<ul class="list-unstyled">

    <li class="store-name">
        <span><b><?php _e( 'Delivery Policy:', 'artgorae' ); ?></b></span>
        <span class="details">
            <?php echo esc_html( get_post_meta( $post_id, '_delivery_policy', true ) ); ?>
        </span>
    </li>

    <li class="store-name">
        <span><b><?php _e( 'Return Policy:', 'artgorae' ); ?></b></span>
        <span class="details">
            <?php echo esc_html( get_post_meta( $post_id, '_return_policy', true ) ); ?>
        </span>
    </li>

    <li class="store-name">
        <span><b><?php _e( 'Warranty Policy:', 'artgorae' ); ?></b></span>
        <span class="details">
            <?php echo esc_html( get_post_meta( $post_id, '_warranty_policy', true ) ); ?>
        </span>
    </li>

    <li class="store-name">
        <span><b><?php _e( 'Seller Policy:', 'artgorae' ); ?></b></span>
        <span class="details">
            <?php echo esc_html( get_post_meta( $post_id, '_seller_policy', true ) ); ?>
        </span>
    </li>

</ul>
