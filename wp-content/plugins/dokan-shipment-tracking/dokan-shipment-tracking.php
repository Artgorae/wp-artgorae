<?php
/*
	Plugin Name: Dokan Shipment Tracking
	Description: Add shipment tracking to Dokan.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
	Text Domain: dokan-shipment-tracking
*/

if ( ! class_exists( 'Dokan_Shipment_Tracking' ) ) {

	class Dokan_Shipment_Tracking {

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			add_action( 'dokan_order_detail_after_order_items', array( $this, 'order_detail' ), 10, 1 );
			add_action( 'init', array( $this, 'edit_shipment_tracking' ) );
			add_action( 'woocommerce_admin_order_actions_end', array( $this, 'shipment_tracking_action' ), 2 );
			add_action( 'wp_ajax_dokan-mark-order-shipping', array( $this, 'shipping_order' ) );

		}

		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'dokan-shipment-tracking', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		public function order_detail( $order ) {
			include( 'templates/order-shipment-tracking-html.php' );
		}

		public function edit_shipment_tracking() {
			if ( isset( $_POST['edit_shipment_tracking'] ) && $_POST['action'] == 'edit_shipment_tracking' ) {
				if ( !wp_verify_nonce( $_POST['security'], 'edit-shipment-tracking' ) ) {
					die(-1);
				}

				$post_id = absint( $_POST['post_id'] );

				if ( $post_id > 0 ) {
					update_post_meta( $post_id, '_custom_tracking_provider', $_POST['tracking_provider'] );
					update_post_meta( $post_id, '_tracking_number', $_POST['tracking_number'] );
				}
			}
		}

		public function get_shipment_tracking_modal() {
		    echo $this->shipment_tracking_modal();
		}

		public function shipment_tracking_modal() {
		    ?>
		    <div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title" id="trackingModalLabel"><?php _e( 'Shipment Tracking', 'dokan-shipment-tracking' ); ?></h4>
		                </div>
		                <div class="modal-body">
		                    <h4><?php _e( 'Enter a shipment tracking information.', 'dokan-shipment-tracking' ) ?></h4>
		                    <form name="trackingModalForm" id="trackingModalForm" method="post">
		                        <p class="form-row form-row-wide">
		                            <label for="shipment-tracking-provider"><?php _e( 'Provider Name:', 'dokan-shipment-tracking' ) ?></label>
		                            <input type="text" name="tracking_provider" id="shipment-tracking-provider" class="input-text" value="" size="20" required />
		                        </p>
		                        <p class="form-row form-row-wide">
		                            <label for="shipment-tracking-number"><?php _e( 'Tracking Number:', 'dokan-shipment-tracking' ) ?></label>
		                            <input type="text" name="tracking_number" id="shipment-tracking-number" class="input-text" value="" size="20" required />
		                        </p>
		                        <p class="tracking-submit">
		                            <input type="submit" class="submit-button" style="display: none;" />
		                            <!-- <input type="hidden" name="redirect_to" value="<?php esc_url( $redirect ) ?>" /> -->
		                        </p>
		                    </form>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e( 'Cancel', 'dokan-shipment-tracking' ); ?></button>
		                    <button type="button" class="btn btn-primary" id="trackingModalSubmit"><?php esc_attr_e( 'Save Changes', 'dokan-shipment-tracking' ) ?></button>
		                </div>
		            </div>
		        </div>
		    </div>

		    <script>
		    $("#trackingModalSubmit").click( function() {
		        $('#trackingModalForm .submit-button').click();
		    });
		    </script>
		    <?php
		}

		public function shipment_tracking_action( $the_order ) {
			if ( in_array( $the_order->post_status, array('wc-processing') ) ) {
			    $url = wp_nonce_url( admin_url( 'admin-ajax.php?action=dokan-mark-order-shipping&order_id=' . $the_order->id ), 'dokan-mark-order-shipping' );
			    $name = __( 'Shipping', 'dokan-shipment-tracking' );
			    $action = "shipping";
			    $icon = '<i class="fa fa-truck">&nbsp;</i>';
			    printf( '<button class="dokan-btn dokan-btn-default dokan-btn-sm tips" data-href="%s" data-toggle="modal" data-target="#trackingModal" rel="tooltip" data-placement="top" title="%s" data-title="%s">%s</button> ', esc_url( $url ), esc_attr( $name ), esc_attr( $name ), $icon );
			}
			$this->shipment_tracking_action_modal();
		}

		public function shipment_tracking_action_modal() {
			add_action( 'wp_footer', array( $this, 'get_shipment_tracking_modal' ) );
			echo $this->shipment_tracking_modal_script();
		}

		public function shipment_tracking_modal_script() {
		    ?>
		    <script>
		        (function($){
		            $(document).ready(function(){
		                $('#trackingModal').on('show.bs.modal', function (event) {
		                    var button = $(event.relatedTarget);
		                    var modal = $(this);
		                    var href = button.data('href');
		                    modal.find('#trackingModalForm').attr('action', href);
		                });
		            });
		        })(jQuery);
		    </script>
		    <?php
		}

		public function shipping_order() {
		    if ( !is_admin() ) {
		        die();
		    }

		    if ( !current_user_can( 'dokandar' ) || dokan_get_option( 'order_status_change', 'dokan_selling', 'on' ) != 'on' ) {
		        wp_die( __( 'You do not have sufficient permissions to access this page.', 'dokan' ) );
		    }

		    if ( !check_admin_referer( 'dokan-mark-order-shipping' ) ) {
		        wp_die( __( 'You have taken too long. Please go back and retry.', 'dokan' ) );
		    }

		    $order_id = isset($_GET['order_id']) && (int) $_GET['order_id'] ? (int) $_GET['order_id'] : '';
		    if ( !$order_id ) {
		        die();
		    }

		    if ( !dokan_is_seller_has_order( get_current_user_id(), $order_id ) ) {
		        wp_die( __( 'You do not have permission to change this order', 'dokan' ) );
		    }


		    update_post_meta( $order_id, '_custom_tracking_provider', $_POST['tracking_provider'] );
		    update_post_meta( $order_id, '_tracking_number', $_POST['tracking_number'] );

		    wp_safe_redirect( wp_get_referer() );
		    die();
		}
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Dokan_Shipment_Tracking'] = new Dokan_Shipment_Tracking();
}