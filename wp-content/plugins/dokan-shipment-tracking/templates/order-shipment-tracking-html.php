<?php
$order_id = isset( $_GET['order_id'] ) ? intval( $_GET['order_id'] ) : 0;
?>
<div class="" style="width:100%">
    <div class="dokan-panel dokan-panel-default">
        <div class="dokan-panel-heading"><strong><?php _e( 'Shipment Tracking', 'dokan-shipment-tracking' ); ?></strong></div>
        <div class="dokan-panel-body" id="dokan-shipment-tracking">
            <?php
            $args = array(
                'post_id' => $order_id,
                'approve' => 'approve',
                'type' => 'shipment_tracking'
            );
            ?>
            <form class="dokan-form-inline" id="shipment-tracking" role="form" method="post">
                <p>
                    <label for="shipment-tracking-provider"><?php _e( 'Provider Name:', 'dokan-shipment-tracking' ); ?></label>
                    <input type="text" id="shipment-tracking-provider" name="tracking_provider" class="form-control" value="<?php echo esc_html( get_post_meta( $order_id, '_custom_tracking_provider', true ) ); ?>"></input>
                </p>
                <p>
                    <label for="shipment-tracking-number"><?php _e( 'Tracking Number:', 'dokan-shipment-tracking' ); ?></label>
                    <input type="text" id="shipment-tracking-number" name="tracking_number" class="form-control" value="<?php echo esc_html( get_post_meta( $order_id, '_tracking_number', true ) ); ?>"></input>
                </p>
                <div class="clearfix">
                    <input type="hidden" name="security" value="<?php echo wp_create_nonce('edit-shipment-tracking'); ?>">
                    <input type="hidden" name="post_id" value="<?php echo $order->id; ?>">
                    <input type="hidden" name="action" value="edit_shipment_tracking">
                    <input type="submit" name="edit_shipment_tracking" class="add_note btn btn-sm btn-theme" value="<?php esc_attr_e( 'Save changes', 'dokan-shipment-tracking' ); ?>">
                </div>
            </form>
        </div> <!-- .dokan-panel-body -->
    </div> <!-- .dokan-panel -->
</div>