<?php $c_id = uniqid(); ?>
<div class="ig-container">
    <div class="mmessage-container">
        <div class="modal" id="reply-form-c">
            <div class="modal-dialog">
                <div class="modal-content" id="reply-compose">
                    <?php $model = new MM_Message_Model() ?>
                    <?php $form = new IG_Active_Form($model);	   	   	  			 				  
                    ?>
                    <div class="modal-header">
                        <h4 class="modal-title"><?php _e("Reply", mmg()->domain) ?></h4>
                    </div>
                    <?php $form->open(array(
                        "attributes" => array(
                            "class" => "form-horizontal compose-form",
                            "id" => "reply-form"
                        )
                    )); ?>
                    <div class="modal-body">
                        <div style="margin-bottom: 0"
                             class="form-group <?php echo $model->has_error("subject") ? "has-error" : null ?>">
                            <?php $form->label("subject", array(
                                "text" => "Subject",
                                "attributes" => array("class" => "control-label col-sm-2 hidden-xs hidden-sm")
                            )) ?>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <?php $form->text("subject", array("attributes" => array("class" => "form-control", "placeholder" => "Subject"))) ?>
                                <span
                                    class="help-block m-b-none error-subject"><?php $form->error("subject") ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group <?php echo $model->has_error("content") ? "has-error" : null ?>">
                            <?php /*$form->label("content", array("text" => "Content", "attributes" => array("class" => "col-lg-2 control-label"))) */ ?>
                            <div class="col-lg-12">
                                <?php $form->text_area("content", array(
                                    "attributes" => array(
                                        "class" => "form-control mm_wsysiwyg",
                                        "id" => "mm_reply_content",
                                        "style" => "height:100px"
                                    )
                                )) ?>
                                <span
                                    class="help-block m-b-none error-content"><?php $form->error("content") ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php wp_nonce_field('compose_message') ?>
                        <input type="hidden" name="is_reply" value="1">
                        <input type="hidden" name="action" value="mm_send_message">
                        <input type="hidden" name="parent_id"
                               value="<?php echo mmg()->encrypt($message->conversation_id) ?>">
                        <input type="hidden" name="id" value="<?php echo mmg()->encrypt($message->id) ?>">
                        <?php $form->hidden('attachment');
                        ?>

                        <?php if (mmg()->can_upload() == true) {
                            ig_uploader()->show_upload_control($model, 'attachment', false, array(
                                'title' => __("Attach media or other files.", mmg()->domain),
                                'c_id' => 'mm_reply_compose_container'
                            ));
                        } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default compose-close"><?php _e("Close", mmg()->domain) ?></button>
                        <button type="submit"
                                class="btn btn-primary reply-submit"><?php _e("Send", mmg()->domain) ?></button>
                    </div>
                    <?php $form->close(); ?>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
</div>
<div class="ig-container">
    <div class="mmessage-container">
        <div class="modal" id="estimates-form-c">
            <div class="modal-dialog">
                <div class="modal-content" id="estimates-compose">
                    <?php $model = new MM_Message_Model() ?>
                    <?php $form = new IG_Active_Form($model);                                         
                    ?>
                    <div class="modal-header">
                        <h4 class="modal-title"><?php _e( 'Estimates', 'artgorae' ) ?></h4>
                    </div>
                    <?php $form->open(array(
                        "attributes" => array(
                            "class" => "form-horizontal compose-form",
                            "id" => "estimates-form"
                        )
                    )); ?>
                    <div class="modal-body">
                        <div style="margin-bottom: 0"
                             class="form-group <?php echo $model->has_error("reply_to") ? "has-error" : null ?>">
                            <?php $form->label("reply_to", array(
                                "text" => __( 'Price', 'artgorae' ),
                                "attributes" => array("class" => "control-label col-sm-2 hidden-xs hidden-sm")
                            )) ?>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <?php $form->number("reply_to", array("attributes" => array("class" => "form-control", "placeholder" => __( '10,000', 'artgorae' ), "required" => "required"))) ?>
                                <?php do_action('mm_compose_form_after_reply_to', $form, $model) ?>
                                <span class="help-block m-b-none error-reply_to"><?php $form->error("reply_to") ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div style="margin-bottom: 0"
                             class="form-group <?php echo $model->has_error("subject") ? "has-error" : null ?>">
                            <?php $form->label("subject", array(
                                "text" => __( 'Title', 'artgorae' ),
                                "attributes" => array("class" => "control-label col-sm-2 hidden-xs hidden-sm")
                            )) ?>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <?php $form->text("subject", array("attributes" => array("class" => "form-control", "placeholder" => __( 'Custom-order product', 'artgorae' )))) ?>
                                <?php do_action('mm_compose_form_after_subject', $form, $model) ?>
                                <span class="help-block m-b-none error-subject"><?php $form->error("subject") ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div style="margin-bottom: 0"
                             class="form-group <?php echo $model->has_error("content") ? "has-error" : null ?>">
                            <?php $form->label("content", array(
                                "text" => __( 'Description', 'artgorae' ),
                                "attributes" => array("class" => "control-label col-sm-2 hidden-xs hidden-sm")
                            )) ?>
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <?php $form->text_area("content", array(
                                    "attributes" => array(
                                        "class" => "form-control mm_wsysiwyg",
                                        "placeholder" => __( 'This is a custom-order product.', 'artgorae' ),
                                        "style" => "height:100px",
                                        "id" => "mm_estimates_content"
                                    )
                                )) ?>
                                <?php do_action('mm_compose_form_after_content', $form, $model) ?>
                                <span
                                    class="help-block m-b-none error-content"><?php $form->error("content") ?></span>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <?php wp_nonce_field('compose_message') ?>
                        <input type="hidden" name="is_reply" value="1">
                        <input type="hidden" name="action" value="mm_send_message">
                        <input type="hidden" name="parent_id"
                               value="<?php echo mmg()->encrypt($message->conversation_id) ?>">
                        <input type="hidden" name="id" value="<?php echo mmg()->encrypt($message->id) ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-default compose-close"><?php _e("Close", mmg()->domain) ?></button>
                        <button type="submit"
                                class="btn btn-primary reply-submit"><?php _e("Send", mmg()->domain) ?></button>
                    </div>
                    <?php $form->close(); ?>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
</div>