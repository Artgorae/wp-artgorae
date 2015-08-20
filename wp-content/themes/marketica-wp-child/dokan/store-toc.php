<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );
$scheme       = is_ssl() ? 'https' : 'http';

get_header( 'shop' );
?>

    <?php dokan_get_template_part( 'store-header' ); ?>

    <?php do_action( 'woocommerce_before_main_content' ); ?>

    <div id="dokan-primary" class="content-area dokan-single-store dokan-w8">
        <div id="dokan-content" class="site-content store-review-wrap woocommerce" role="main">

            <div id="store-portfolio-wrapper">
                <div id="store-portfolio">
                    <?php
                    if( isset( $store_info['store_tnc'] ) ):
                    ?>
                        <h2 class="headline"><?php _e( 'Portfolio', 'artgorae' ); ?></h2>
                        <div>
                            <?php
                            echo nl2br($store_info['store_tnc']);
                            ?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div><!-- #store-portfolio -->
            </div><!-- #store-portfolio-wrap -->

            <a href=".." class="dokan-btn dokan-btn-theme" style="margin-top: 10px;"><i class="fa fa-undo">&nbsp;</i><?php _e( 'Back to store', 'artgorae' ); ?></a>
        </div><!-- #content .site-content -->
    </div><!-- #primary .content-area -->

    <?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>