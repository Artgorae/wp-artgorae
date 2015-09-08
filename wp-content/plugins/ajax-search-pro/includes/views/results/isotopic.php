<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

/**
 * This is the default template for one isotopic result
 *
 * You should rather make a copy of this in this folder and use that,
 * instead of modifying this one.
 * It's also a good idea to use the actions to insert content instead of modifications.
 *
 * You can use any WordPress function here.
 * Variables to mention:
 *      Object() $r - holding the result details
 *      Array[]  $s_options - holding the search options
 *
 * DO NOT OUTPUT ANYTHING BEFORE OR AFTER THE <div class='item'>..</div> element
 *
 * You can leave empty lines for better visibility, they are cleared before output.
 *
 * MORE INFO: https://wp-dreams.com/knowledge-base/result-templating/
 *
 * @since: 4.0
 */
?>
<li class="product type-product status-publish purchasable product-type-simple instock">

    <?php do_action('asp_res_isotopic_begin_item'); ?>

    <div class="thumbnail-loop-wrap">
        <?php if (!empty($r->image)): ?>
        <a href="http://wp-artgorae-env.elasticbeanstalk.com/product/custom-order-product-8/">
            <img src='<?php echo $r->image; ?>' alt="플레이스홀더" width="600" class="woocommerce-placeholder wp-post-image" height="420">
        </a>
        <?php endif; ?>

        <?php do_action('asp_res_isotopic_after_image'); ?>

        <div class="add-to-cart-loop-wrap">
            <a href='<?php echo $r->link; ?>' rel="nofollow" class="button detail_button_loop">
                detail
            </a>
        </div>
    </div>

    <div class="price-loop-wrap">
        <span class="price"><?php echo get_post_meta( $r->id, '_price', true ); ?></span>
    </div>

    <div class="title-rating-loop-wrap">
        <h3>
            <a href='<?php echo $r->link; ?>'><?php echo $r->title; ?></a>
        </h3>

    </div>
    <?php 
    /*
    <div class='asp_content'>

    

        <h3><a href='<?php echo $r->link; ?>'<?php echo ($s_options['results_click_blank'])?" target='_blank'":""; ?>>
                <?php echo $r->title; ?>
                <?php if ($s_options['resultareaclickable'] == 1): ?>
                    <span class='overlap'></span>
                <?php endif; ?>
            </a></h3>

        <div class='etc'>

            <?php if ($s_options['showauthor'] == 1): ?>
                <span class='asp_author'><?php echo $r->author; ?></span>
            <?php endif; ?>

            <?php if ($s_options['showdate'] == 1): ?>
                <span class='asp_date'><?php echo $r->date; ?></span>
            <?php endif; ?>

        </div>

        <?php if ($s_options['showdescription'] == 1): ?>
            <p class='desc'><?php echo $r->content; ?></p>
        <?php endif; ?>

    </div>
    */
    ?>
    <?php do_action('asp_res_isotopic_after_content'); ?>

    <div class='clear'></div>

    <?php do_action('asp_res_isotopic_end_item'); ?>
    
</li>
