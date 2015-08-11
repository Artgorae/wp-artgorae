<?php
$store_user = get_userdata( get_query_var( 'author' ) );
$store_info = dokan_get_store_info( $store_user->ID );

$store_banner = isset( $store_info['banner'] ) && !empty( $store_info['banner'] ) ? $store_info['banner'] : '';
?>

<?php if ( $store_banner ) { ?>
<style type="text/css">
    .profile-frame {
        background-image: url('<?php echo wp_get_attachment_url( $store_banner ); ?>');
    }
</style>
<?php } ?>

<div class="profile-frame custom-store-header <?php if ( $store_banner ) echo 'store-banner-yes'; ?>">

    <div class="profile-info-box">
        <div class="profile-img">
            <?php echo get_avatar( $store_user->ID, 80 ); ?>
        </div>

        <div class="profile-info">
            <ul class="store-info dokan-store-info">

                <?php if ( isset( $store_info['store_name'] ) ) { ?>
                    <li class="store-name"><?php echo esc_html( $store_info['store_name'] ); ?></li>
                <?php } ?>

                <?php if ( isset( $store_info['address'] ) && !empty( $store_info['address'] ) ) { ?>
                    <li class="dokan-store-address"><i class="fa fa-map-marker"></i> 
                        <?php echo dokan_get_seller_address( $store_user->ID ); ?>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
                    <li class="dokan-store-phone">
                        <i class="fa fa-mobile"></i>
                        <a href="tel:<?php echo esc_html( $store_info['phone'] ); ?>"><?php echo esc_html( $store_info['phone'] ); ?></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['show_email'] ) && $store_info['show_email'] == 'yes' ) { ?>
                    <li class="dokan-store-email">
                        <i class="fa fa-envelope-o"></i>
                        <a href="mailto:<?php echo antispambot( $store_user->user_email ); ?>"><?php echo antispambot( $store_user->user_email ); ?></a>
                    </li>
                <?php } ?>

                <li>
                    <i class="fa fa-star"></i>
                    <?php dokan_get_readable_seller_rating( $store_user->ID ); ?>
                </li>
            </ul>

            <ul class="store-social">
                <?php if ( isset( $store_info['social']['fb'] ) && !empty( $store_info['social']['fb'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['fb'] ); ?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['gplus'] ) && !empty( $store_info['social']['gplus'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['gplus'] ); ?>" target="_blank"><i class="fa fa-google-plus-square"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['twitter'] ) && !empty( $store_info['social']['twitter'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter-square"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['linkedin'] ) && !empty( $store_info['social']['linkedin'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin-square"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['youtube'] ) && !empty( $store_info['social']['youtube'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['youtube'] ); ?>" target="_blank"><i class="fa fa-youtube-square"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['flickr'] ) && !empty( $store_info['social']['flickr'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['flickr'] ); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
                    </li>
                <?php } ?>

                <?php if ( isset( $store_info['social']['instagram'] ) && !empty( $store_info['social']['instagram'] ) ) { ?>
                    <li>
                        <a href="<?php echo esc_url( $store_info['social']['instagram'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                <?php } ?>

            </ul>
        </div> <!-- .profile-info -->
    </div> <!-- .profile-info-box -->
</div> <!-- .profile-frame -->