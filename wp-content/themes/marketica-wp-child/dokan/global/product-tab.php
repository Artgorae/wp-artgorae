<?php
/**
 * Dokan Seller Single product tab Template
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<h2><?php _e( 'Seller Information', 'dokan' ); ?><span style="float:right;"><?php get_follow_button(); ?></span></h2>

<ul class="list-unstyled">

    <?php if ( !empty( $store_info['store_name'] ) ) { ?>
        <li class="store-name">
            <span><b><?php _e( 'Store Name:', 'dokan' ); ?></b></span>
            <span class="details">
                <?php echo esc_html( $store_info['store_name'] ); ?>
            </span>
        </li>
    <?php } ?>

    <li class="seller-name">
        <span><b><?php _e( 'Seller:', 'dokan' ); ?></b></span>
        <span class="details">
            <?php printf( '<a href="%s">%s</a>', dokan_get_store_url( $author->ID ), $author->display_name ); ?>
        </span>
    </li>
    <?php if ( !empty( $store_info['phone'] ) ) { ?>
        <li class="store-address">
            <span><b><?php _e( 'Store Introduction:', 'artgorae' ); ?></b></span>
            <span class="details">
                <?php echo esc_html( $store_info['phone'] ); ?>
            </span>
        </li>
    <?php } ?>

    <li class="clearfix">
        <?php dokan_get_readable_seller_rating( $author->ID ); ?>
    </li>
</ul>
