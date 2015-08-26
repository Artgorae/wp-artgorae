<?php
/**
 * Dokan Store Contact Form widget Template
 *
 * @since 2.4
 *
 * @package dokan
 */
?>

<form id="dokan-form-contact-seller" action="" method="post" class="seller-form clearfix">
    <div class="ajax-response"></div>
    <ul>
        <li class="form-group">
            <input type="text" name="name" value="" placeholder="<?php esc_attr_e( 'Your Name', 'dokan' ); ?>" class="form-control" minlength="5" required="required">
        </li>
        <li class="form-group">
            <input type="email" name="email" value="" placeholder="<?php esc_attr_e( 'you@example.com', 'dokan' ); ?>" class="form-control" required="required">
        </li>
        <li class="form-group">
            <textarea  name="message" maxlength="1000" cols="25" rows="6" value="" placeholder="<?php esc_attr_e( 'Type your messsage...', 'dokan' ); ?>" class="form-control" required="required"></textarea>
        </li>
    </ul>

    <?php wp_nonce_field( 'dokan_contact_seller' ); ?>
    <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
    <input type="hidden" name="action" value="dokan_contact_seller">
    <input type="submit" name="store_message_send" value="<?php esc_attr_e( 'Send Message', 'dokan' ); ?>" class="dokan-right dokan-btn dokan-btn-theme">
</form>