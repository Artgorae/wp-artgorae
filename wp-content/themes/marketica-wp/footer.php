<?php
/**
 * Footer
 */
?>

		</div>
		</div>

		<?php do_action( 'tokopress_after_wrapper' ); ?>

		<?php if( !of_get_option( 'tokopresss_disable_footer_widget' ) ) : ?>
			<?php get_template_part( 'block', 'footer-widget' ); ?>
		<?php endif; ?>

		<?php if( !of_get_option( 'tokopresss_disable_footer_credit' ) ) : ?>
			<div class="footer-credits">
				<div class="container-wrap">
	            	<div class="copyright"><?php echo of_get_option( 'tokopress_footer_text' ); ?></div>
	            </div>
	        </div>
	    <?php endif; ?>

	</div>
	<div id="back-top" style="display:block;"><i class="fa fa-angle-up"></i></div>
	<div class="sb-slidebar sb-left"></div>
    <?php wp_footer(); ?>
    </body>
</html>
