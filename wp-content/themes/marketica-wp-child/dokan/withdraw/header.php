<?php
/**
 * Dokan Dahsboard Withdra Header Template
 *
 * @since 2.4
 *
 * @package dokan
 */
?>
<header class="dokan-dashboard-header">
    <h1 class="entry-title"><?php _e( 'Withdraw', 'dokan' ); ?></h1>
</header><!-- .entry-header -->

<?php
$help_text = __( 'These are the withdraw methods available for you. Please update your payment information below to submit withdraw requests and get your store payments seamlessly.', 'dokan' );

dokan_get_template_part( 'global/dokan-help', '', array(
    'help_text' => $help_text
));

$methods = dokan_withdraw_get_active_methods();
$currentuser = get_current_user_id();
$profile_info = dokan_get_store_info( get_current_user_id() );

dokan_get_template_part( 'settings/payment', '', array(
    'methods'      => $methods,
    'current_user' => $currentuser,
    'profile_info' => $profile_info,
) );
?>

<hr>