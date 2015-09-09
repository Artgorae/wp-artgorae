<?php
/*
    Plugin Name: Dokan Seller Policies
    Description: Add seller policies and agreements to product.
    Version: 1.0.0
    Author: Jaewon Seo
    Author URI: http://seojaewon.com
*/

if ( ! class_exists( 'Dokan_Seller_Policies' ) ) {

    class Dokan_Seller_Policies {

        public function __construct() {
            add_action( 'dokan_product_edit_after_inventory_variants', array( $this, 'seller_policies' ), 2 );
            add_action( 'dokan_product_edit_after_inventory_variants', array( $this, 'seller_agreements' ), 2 );
        }

        public function seller_policies( $post, $post_id ) {
            if ( isset( $_GET['product_id'] ) ) {
                $post_id = intval( $_GET['product_id'] );
            }

            $_delivery_policy = get_post_meta( $post_id, '_delivery_policy', true );
            $_return_policy = get_post_meta( $post_id, '_return_policy', true );
            $_warranty_policy = get_post_meta( $post_id, '_warranty_policy', true );
            $_seller_policy = get_post_meta( $post_id, '_seller_policy', true );

            ?>
            <div class="dokan-edit-row dokan-clearfix">
                <div class="dokan-side-left">
                    <h2><?php _e( 'Policies', 'artgorae' ); ?></h2>

                    <p>
                        <?php _e( 'Manage seller policies.', 'artgorae' ); ?>
                    </p>
                </div>

                <div class="dokan-side-right">
                    <div class="dokan-form-group">
                        <label for="_delivery_policy" class="form-label"><?php _e( 'Delivery Policy', 'artgorae' ); ?></label>
                        <?php dokan_post_input_box( $post_id, '_delivery_policy', array( 'value' => $_delivery_policy ) ); ?>
                    </div>
                    <div class="dokan-form-group">
                        <label for="_return_policy" class="form-label"><?php _e( 'Return Policy', 'artgorae' ); ?></label>
                        <?php dokan_post_input_box( $post_id, '_return_policy', array( 'value' => $_return_policy ) ); ?>
                    </div>
                    <div class="dokan-form-group">
                        <label for="_warranty_policy" class="form-label"><?php _e( 'Warranty Policy', 'artgorae' ); ?></label>
                        <?php dokan_post_input_box( $post_id, '_warranty_policy', array( 'value' => $_warranty_policy ) ); ?>
                    </div>
                    <div class="dokan-seller-policy">
                        <label for="_seller_policy" class="form-label"><?php _e( 'Seller Policy', 'artgorae' ); ?></label>
                        <?php wp_editor( esc_textarea( wpautop( $_seller_policy ) ), '_seller_policy', array('editor_height' => 50, 'quicktags' => false, 'media_buttons' => false, 'teeny' => true, 'editor_class' => 'post_content') ); ?>
                    </div>
                </div><!-- .dokan-side-right -->
            </div>
            <?php
        }

        public function seller_agreements( $post, $post_id ) {
            if ( isset( $_GET['product_id'] ) ) {
                $post_id = intval( $_GET['product_id'] );
            }

            $agreements = array();
            array_push( $agreements, __( 'Seller Agreement 1', 'artgorae' ) );
            array_push( $agreements, __( 'Seller Agreement 2', 'artgorae' ) );
            array_push( $agreements, __( 'Seller Agreement 3', 'artgorae' ) );

            ?>
            <?php if ( !$post_id ): ?>
                <div class="dokan-edit-row dokan-clearfix">
                    <div class="dokan-side-left">
                        <h2><?php _e( 'Agreements', 'artgorae' ); ?></h2>

                        <p>
                            <?php _e( 'Agreement to terms and conditions.', 'artgorae' ); ?>
                        </p>
                    </div>

                    <div class="dokan-side-right">
                    <?php
                        foreach ($agreements as $agreement) {
                            printf( '<input type="checkbox" required> %s</input><br/>', $agreement );
                        }
                    ?>
                        
                    </div><!-- .dokan-side-right -->
                </div>
            <?php endif; ?>
            <?php
        }
    }

    /**
     * Register this class globally
     */
    $GLOBALS['Dokan_Seller_Policies'] = new Dokan_Seller_Policies();
}