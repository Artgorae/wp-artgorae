<?php
/*
	Plugin Name: Dokan Confirmation Dialog
	Description: Add confirmation dialog on orders dashboard.
	Version: 1.0.0
	Author: Jaewon Seo
	Author URI: http://seojaewon.com
*/

if ( ! class_exists( 'Dokan_Confirmation_Dialog' ) ) {

	class Dokan_Confirmation_Dialog {

		public function __construct() {
			add_action( 'woocommerce_admin_order_actions_end', array( $this, 'mark_order_confirm_action_modal' ) );
		}

		public function get_mark_order_confirm_modal() {
		    echo $this->mark_order_confirm_modal();
		}

		public function mark_order_confirm_modal() {
		    ?>
		    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
		        <div class="modal-dialog" role="document">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <h4 class="modal-title" id="confirmModalLabel"><?php _e( 'Confirm', 'artgorae' ); ?></h4>
		                </div>
		                <div class="modal-body">
		                    <p><?php _e( 'Order will be marked as', 'artgorae' ); ?> <span class="status-text">status</span>.</p>
		                    <p><?php _e( 'Do you want to proceed?', 'artgorae' ); ?></p>
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e( 'Cancel', 'artgorae' ); ?></button>
		                    <a href="#" class="btn btn-primary btn-ok"><?php _e( 'Confirm', 'artgorae' ); ?></a>
		                </div>
		            </div>
		        </div>
		    </div>
		    <?php
		}

		public function mark_order_confirm_action_modal() {
			add_action( 'wp_footer', array( $this, 'get_mark_order_confirm_modal' ) );
			$this->mark_order_confirm_modal_script();
		}

		public function mark_order_confirm_modal_script() {
		    ?>
			<script>
			    (function($){
			        $(document).ready(function(){
			            $('#confirmModal').on('show.bs.modal', function (event) {
			                var button = $(event.relatedTarget);
			                var modal = $(this);
			                var title = button.data('title');
			                var href = button.data('href');
			                modal.find('.status-text').text(title);
			                modal.find('.btn-ok').attr('href', href);
			            });
			        });
			    })(jQuery);
			</script>
			<?php
		}
	}

	/**
	 * Register this class globally
	 */
	$GLOBALS['Dokan_Confirmation_Dialog'] = new Dokan_Confirmation_Dialog();
}