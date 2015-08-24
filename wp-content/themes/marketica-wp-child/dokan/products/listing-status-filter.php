<?php
/**
 * Dokan Dahsboard Product Listing status filter
 * Template
 *
 * @since 2.4
 *
 * @package dokan
 */

$artwork_term = get_term_by( 'slug', 'artwork', 'product_cat' );
$talent_term = get_term_by( 'slug', 'talent', 'product_cat' );
$custom_term = get_term_by( 'slug', 'custom-order', 'product_cat' );
?>
<ul class="dokan-listing-filter dokan-left subsubsub">
    <li<?php echo $status_class == 'all' ? ' class="active"' : ''; ?>>
        <a href="<?php echo $permalink; ?>"><?php _e( 'All', 'dokan' ); ?></a>
    </li>
    <li<?php echo $status_class == $artwork_term->term_id ? ' class="active"' : ''; ?>>
        <a href="<?php echo add_query_arg( array( 'product_cat' => $artwork_term->term_id ), $permalink ); ?>"><?php echo $artwork_term->name ?></a>
    </li>
    <li<?php echo $status_class == $talent_term->term_id ? ' class="active"' : ''; ?>>
        <a href="<?php echo add_query_arg( array( 'product_cat' => $talent_term->term_id ), $permalink ); ?>"><?php echo $talent_term->name ?></a>
    </li>
    <li<?php echo $status_class == $custom_term->term_id ? ' class="active"' : ''; ?>>
        <a href="<?php echo add_query_arg( array( 'product_cat' => $custom_term->term_id ), $permalink ); ?>"><?php echo $custom_term->name ?></a>
    </li>
</ul> <!-- .post-statuses-filter -->
