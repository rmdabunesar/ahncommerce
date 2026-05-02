<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the page and all dynamic footer widget areas,
 * copyright text, and payment method image.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AhnCommerce
 */

?>

	<!-- Footer Section Begin -->
	<footer class="footer spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<?php
					if ( is_active_sidebar( 'ahncommerce-footer-widget-1' ) ) {
						dynamic_sidebar( 'ahncommerce-footer-widget-1' );
					}
					?>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-3">
					<?php
					if ( is_active_sidebar( 'ahncommerce-footer-widget-2' ) ) {
						dynamic_sidebar( 'ahncommerce-footer-widget-2' );
					}
					?>
				</div>
				<div class="col-lg-2 col-md-3 col-sm-3">
					<?php
					if ( is_active_sidebar( 'ahncommerce-footer-widget-3' ) ) {
						dynamic_sidebar( 'ahncommerce-footer-widget-3' );
					}
					?>
				</div>
				<div class="col-lg-4 col-md-12">
					<?php
					if ( is_active_sidebar( 'ahncommerce-footer-widget-4' ) ) {
						dynamic_sidebar( 'ahncommerce-footer-widget-4' );
					}
					?>
				</div>
			</div><!-- .row -->

			<div class="row">
				<div class="col-lg-12">
					<div class="footer__copyright">
						<div class="footer__copyright__text">
							<p>
								<?php
								echo esc_html(
									get_theme_mod(
										'set_footer_copiright',
										__( 'Copyright &copy; 2025 | All Rights Reserved | This theme is made by AHN Solution', 'ahncommerce' )
									)
								);
								?>
							</p>
						</div>
						<div class="footer__copyright__payment">
							<?php
							// Get footer payment image; fall back to bundled default if none is set.
							$ahncommerce_footer_image_id  = get_theme_mod( 'set_footer_image' );
							$ahncommerce_footer_image_url = $ahncommerce_footer_image_id
								? wp_get_attachment_url( $ahncommerce_footer_image_id )
								: get_template_directory_uri() . '/assets/img/payment-item.png';
							?>
							<img src="<?php echo esc_url( $ahncommerce_footer_image_url ); ?>" alt="<?php esc_attr_e( 'Payment Methods', 'ahncommerce' ); ?>">
						</div>
					</div>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</footer>
	<!-- Footer Section End -->

<?php wp_footer(); ?>
</body>
</html>
