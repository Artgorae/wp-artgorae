<?php
/**
 * Dokan Dashboard Settings Store Form Template
 *
 * @since 2.4
 */
?>
<?php

    $scheme = is_ssl() ? 'https' : 'http';
    wp_enqueue_script( 'google-maps', $scheme . '://maps.google.com/maps/api/js?sensor=true' );

    $gravatar   = isset( $profile_info['gravatar'] ) ? absint( $profile_info['gravatar'] ) : 0;
    $banner     = isset( $profile_info['banner'] ) ? absint( $profile_info['banner'] ) : 0;
    $storename  = isset( $profile_info['store_name'] ) ? esc_attr( $profile_info['store_name'] ) : '';

    if ( is_wp_error( $validate ) ) {
        $storename    = $_POST['dokan_store_name'];
    }

?>
<?php do_action( 'dokan_settings_before_form', $current_user, $profile_info ); ?>

    <form method="post" id="store-form"  action="" class="dokan-form-horizontal">

        <?php wp_nonce_field( 'dokan_store_settings_nonce' ); ?>

        <div class="dokan-banner">

            <div class="image-wrap<?php echo $banner ? '' : ' dokan-hide'; ?>">
                <?php $banner_url = $banner ? wp_get_attachment_url( $banner ) : ''; ?>
                <input type="hidden" class="dokan-file-field" value="<?php echo $banner; ?>" name="dokan_banner">
                <img class="dokan-banner-img" src="<?php echo esc_url( $banner_url ); ?>">

                <a class="close dokan-remove-banner-image">&times;</a>
            </div>

            <div class="button-area<?php echo $banner ? ' dokan-hide' : ''; ?>">
                <i class="fa fa-cloud-upload"></i>

                <a href="#" class="dokan-banner-drag dokan-btn dokan-btn-info dokan-theme"><?php _e( 'Upload banner', 'dokan' ); ?></a>
                <p class="help-block"><?php _e( '(Upload a banner for your store. Banner size is (825x300) pixels. )', 'dokan' ); ?></p>
            </div>
        </div> <!-- .dokan-banner -->

        <?php do_action( 'dokan_settings_after_banner', $current_user, $profile_info ); ?>

        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="dokan_gravatar"><?php _e( 'Profile Picture', 'dokan' ); ?></label>

            <div class="dokan-w5 dokan-gravatar">
                <div class="dokan-left gravatar-wrap<?php echo $gravatar ? '' : ' dokan-hide'; ?>">
                    <?php $gravatar_url = $gravatar ? wp_get_attachment_url( $gravatar ) : ''; ?>
                    <input type="hidden" class="dokan-file-field" value="<?php echo $gravatar; ?>" name="dokan_gravatar">
                    <img class="dokan-gravatar-img" src="<?php echo esc_url( $gravatar_url ); ?>">
                    <a class="dokan-close dokan-remove-gravatar-image">&times;</a>
                </div>
                <div class="gravatar-button-area<?php echo $gravatar ? ' dokan-hide' : ''; ?>">
                    <a href="#" class="dokan-gravatar-drag dokan-btn dokan-btn-default"><i class="fa fa-cloud-upload"></i> <?php _e( 'Upload Photo', 'dokan' ); ?></a>
                </div>
            </div>
        </div>

        <div class="dokan-form-group">
            <label class="dokan-w3 dokan-control-label" for="dokan_store_name"><?php _e( 'Store Name', 'dokan' ); ?></label>

            <div class="dokan-w5 dokan-text-left">
                <input id="dokan_store_name" required value="<?php echo $storename; ?>" name="dokan_store_name" placeholder="<?php _e( 'store name', 'dokan'); ?>" class="dokan-form-control" type="text">
            </div>
        </div>

        <?php do_action( 'dokan_settings_form_bottom', $current_user, $profile_info ); ?>

        <div class="dokan-form-group">

            <div class="dokan-w4 ajax_prev dokan-text-left" style="margin-left:24%;">
                <input type="submit" name="dokan_update_store_settings" class="dokan-btn dokan-btn-danger dokan-btn-theme" value="<?php esc_attr_e( 'Update Settings', 'dokan' ); ?>">
            </div>
        </div>
    </form>

    <?php do_action( 'dokan_settings_after_form', $current_user, $profile_info ); ?>
