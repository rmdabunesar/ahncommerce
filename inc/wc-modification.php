<?php
/**
 * WooCommerce template overrides and layout modifications.
 *
 * Hooks into WooCommerce actions to customise the shop and single product
 * page layouts to match the AhnCommerce theme design.
 *
 * @link https://docs.woocommerce.com/document/woocommerce-theme-developer-handbook/
 *
 * @package AhnCommerce
 */

/**
 * Modifies the WooCommerce shop page layout.
 *
 * Replaces the default WooCommerce content wrappers and sidebar with
 * custom theme markup, and adds a custom pagination output.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_wc_modify_shop() {
	if ( is_shop() && function_exists( 'WC' ) ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		add_action( 'woocommerce_before_main_content', 'ahncommerce_output_content_wrapper', 10 );

		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_action( 'woocommerce_before_main_content', 'ahncommerce_shop_sidebar' );

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

		add_action( 'woocommerce_before_shop_loop', 'ahncommerce_before_shop_loop', 40 );

		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
		add_action( 'woocommerce_after_shop_loop', 'ahncommerce_pagination', 10 );

		add_action( 'woocommerce_after_shop_loop', 'ahncommerce_after_shop_loop', 20 );

		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_after_main_content', 'ahncommerce_output_content_wrapper_end', 10 );

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
	}
}
add_action( 'wp', 'ahncommerce_wc_modify_shop' );

/**
 * Modifies the WooCommerce single product page layout.
 *
 * Replaces default content wrappers, removes the sidebar and breadcrumb,
 * and replaces the product meta section with a custom version.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_wc_modify_single_product() {
	if ( is_singular( 'product' ) && function_exists( 'WC' ) ) {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		add_action( 'woocommerce_before_main_content', 'ahncommerce_output_content_wrapper', 10 );

		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		add_action( 'woocommerce_single_product_summary', 'ahncommerce_template_single_meta', 40 );

		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_after_main_content', 'ahncommerce_output_content_wrapper_end', 10 );

		add_action( 'woocommerce_before_add_to_cart_quantity', 'ahncommerce_qty_wrapper_start', 5 );
		add_action( 'woocommerce_after_add_to_cart_quantity', 'ahncommerce_qty_wrapper_end', 20 );

		remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
	}
}
add_action( 'wp', 'ahncommerce_wc_modify_single_product' );

/**
 * Outputs the opening wrapper markup for WooCommerce shop/product pages.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_output_content_wrapper() {
	echo '<section class="product spad">
		<div class="container">
			<div class="row product__content_row">';
}

/**
 * Outputs the closing wrapper markup for WooCommerce shop/product pages.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_output_content_wrapper_end() {
	echo '</div>
		</div>
	</section>';
}

/**
 * Outputs the shop sidebar column wrapper.
 *
 * Renders the shop sidebar widget area inside a Bootstrap column.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_shop_sidebar() {
	echo '<div class="col-lg-3 col-md-5">';
	if ( is_active_sidebar( 'ahncommerce-shop-sidebar' ) ) {
		dynamic_sidebar( 'ahncommerce-shop-sidebar' );
	}
	echo '</div>';
}

/**
 * Outputs the opening markup for the shop product loop column.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_before_shop_loop() {
	echo '<div class="col-lg-9 col-md-7">
		<div class="row product__loop__row">';
}

/**
 * Outputs the closing markup for the shop product loop column.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_after_shop_loop() {
	echo '</div>
	</div>';
}

/**
 * Outputs a custom paginated navigation for the shop page.
 *
 * @since 1.0.0
 *
 * @global WP_Query $wp_query The main query object.
 *
 * @return void
 */
function ahncommerce_pagination() {
	global $wp_query;

	$pagination = paginate_links(
		array(
			'total'     => $wp_query->max_num_pages,
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'format'    => '?paged=%#%',
			'prev_text' => '<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
			'next_text' => '<i class="fa fa-long-arrow-right" aria-hidden="true"></i>',
		)
	);

	if ( $pagination ) {
		echo '<div class="product__pagination">' . wp_kses_post( $pagination ) . '</div>';
	}
}

/**
 * Outputs custom product meta for single product pages.
 *
 * Displays availability, shipping info, weight, and social share links
 * as a replacement for the default WooCommerce meta section.
 *
 * @since 1.0.0
 *
 * @global WC_Product $product The current WooCommerce product object.
 *
 * @return void
 */
function ahncommerce_template_single_meta() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}
	?>
	<div class="product__details__text">
		<ul>
			<li>
				<b><?php esc_html_e( 'Availability', 'ahncommerce' ); ?></b>
				<span>
					<?php
					echo $product->is_in_stock()
						? esc_html__( 'In Stock', 'ahncommerce' )
						: esc_html__( 'Out of Stock', 'ahncommerce' );
					?>
				</span>
			</li>

			<li>
				<b><?php esc_html_e( 'Shipping', 'ahncommerce' ); ?></b>
				<span>
					<?php esc_html_e( '01 day shipping.', 'ahncommerce' ); ?>
					<samp><?php esc_html_e( 'Free pickup today', 'ahncommerce' ); ?></samp>
				</span>
			</li>

			<li>
				<b><?php esc_html_e( 'Weight', 'ahncommerce' ); ?></b>
				<span>
					<?php
					$ahncommerce_weight = $product->get_weight();
					if ( $ahncommerce_weight ) {
						/* translators: %s: product weight value */
						echo esc_html( sprintf( __( '%s kg', 'ahncommerce' ), $ahncommerce_weight ) );
					} else {
						esc_html_e( 'N/A', 'ahncommerce' );
					}
					?>
				</span>
			</li>

			<li>
				<b><?php esc_html_e( 'Share on', 'ahncommerce' ); ?></b>
				<div class="share">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Facebook', 'ahncommerce' ); ?>">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
					<a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on Twitter', 'ahncommerce' ); ?>">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
					<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Share on LinkedIn', 'ahncommerce' ); ?>">
						<i class="fa fa-linkedin" aria-hidden="true"></i>
					</a>
				</div>
			</li>
		</ul>
	</div>
	<?php
}

/**
 * Outputs the quantity input buttons for the add to cart form.
 *
 * @since 1.0.0
 *
 * @global WC_Product $product The current WooCommerce product object.
 *
 * @return void
 */
function ahncommerce_qty_wrapper_start() {
	echo '<div class="qty-wrapper">';
	echo '<button type="button" class="qty-minus" aria-label="Decrease quantity">−</button>';
}

function ahncommerce_qty_wrapper_end() {
	echo '<button type="button" class="qty-plus" aria-label="Increase quantity">+</button>';
	echo '</div>';
}

/**
 * Outputs the product data tabs section for single product pages.
 *
 * Renders Description, Information, and Reviews tabs using Bootstrap tab markup.
 *
 * @since 1.0.0
 *
 * @global WC_Product $product The current WooCommerce product object.
 *
 * @return void
 */
function ahncommerce_output_product_data_tabs() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}
	?>
	<div class="col-lg-12">
		<div class="product__details__tab">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" data-bs-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">
						<?php esc_html_e( 'Description', 'ahncommerce' ); ?>
					</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" data-bs-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">
						<?php esc_html_e( 'Information', 'ahncommerce' ); ?>
					</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" data-bs-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">
						<?php esc_html_e( 'Reviews', 'ahncommerce' ); ?>
						<span>(<?php echo esc_html( $product->get_review_count() ? $product->get_review_count() : '0' ); ?>)</span>
					</a>
				</li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tabs-1" role="tabpanel">
					<div class="product__details__tab__desc">
						<h6><?php esc_html_e( 'Product Description', 'ahncommerce' ); ?></h6>
						<p><?php echo wp_kses_post( $product->get_description() ); ?></p>
					</div>
				</div>

				<div class="tab-pane" id="tabs-2" role="tabpanel">
					<div class="product__details__tab__desc">
						<h6><?php esc_html_e( 'Product Information', 'ahncommerce' ); ?></h6>
						<ul>
							<li>
								<b><?php esc_html_e( 'SKU:', 'ahncommerce' ); ?></b>
								<?php
								$ahncommerce_sku = $product->get_sku();
								echo $ahncommerce_sku ? esc_html( $ahncommerce_sku ) : esc_html__( 'N/A', 'ahncommerce' );
								?>
							</li>
							<li>
								<b><?php esc_html_e( 'Category:', 'ahncommerce' ); ?></b>
								<?php echo wp_kses_post( wc_get_product_category_list( $product->get_id() ) ); ?>
							</li>
							<li>
								<b><?php esc_html_e( 'Weight:', 'ahncommerce' ); ?></b>
								<?php
								$ahncommerce_weight = $product->get_weight();
								if ( $ahncommerce_weight ) {
									/* translators: %s: product weight value */
									echo esc_html( sprintf( __( '%s kg', 'ahncommerce' ), $ahncommerce_weight ) );
								} else {
									esc_html_e( 'N/A', 'ahncommerce' );
								}
								?>
							</li>
							<li>
								<b><?php esc_html_e( 'Dimensions:', 'ahncommerce' ); ?></b>
								<?php
								$ahncommerce_dimensions = $product->get_dimensions();
								echo $ahncommerce_dimensions ? esc_html( $ahncommerce_dimensions ) : esc_html__( 'N/A', 'ahncommerce' );
								?>
							</li>
						</ul>
					</div>
				</div>
			</div><!-- .tab-content -->
		</div><!-- .product__details__tab -->
	</div><!-- .col-lg-12 -->
	<?php
}
