<?php
/**
 * Template Name: Home Page
 *
 * The custom page template for displaying the AhnCommerce home page.
 * Assign this template to any page via Page Attributes > Template.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package AhnCommerce
 */

get_header();
?>

<!-- Categories Section Begin -->
<section class="categories">
	<div class="container">
		<div class="row">
			<?php
			// Fetch WooCommerce product categories (non-empty only).
			$ahncommerce_categories = get_terms(
				array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => true,
				)
			);

			if ( ! empty( $ahncommerce_categories ) && ! is_wp_error( $ahncommerce_categories ) ) :
				?>
				<div class="categories__slider owl-carousel">
					<?php
					foreach ( $ahncommerce_categories as $ahncommerce_category ) :
						// Get the category thumbnail or use the WooCommerce placeholder.
						$ahncommerce_thumbnail_id  = get_term_meta( $ahncommerce_category->term_id, 'thumbnail_id', true );
						$ahncommerce_image_url     = $ahncommerce_thumbnail_id
							? esc_url( wp_get_attachment_url( $ahncommerce_thumbnail_id ) )
							: esc_url( wc_placeholder_img_src() );
						?>
						<div class="col-lg-3">
							<div class="categories__item set-bg" data-setbg="<?php echo esc_url( $ahncommerce_image_url ); ?>">
								<h5>
									<a href="<?php echo esc_url( get_term_link( $ahncommerce_category ) ); ?>">
										<?php echo esc_html( $ahncommerce_category->name ); ?>
									</a>
								</h5>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- Categories Section End -->

<!-- Featured Products Section Begin -->
<section class="featured spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title">
					<h2><?php esc_html_e( 'Featured Product', 'ahncommerce' ); ?></h2>
				</div>
				<div class="featured__controls">
					<?php
					// Fetch up to 5 product categories for the filter controls.
					$ahncommerce_filter_cats = get_terms(
						array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => true,
							'number'     => 5,
						)
					);

					if ( ! empty( $ahncommerce_filter_cats ) && ! is_wp_error( $ahncommerce_filter_cats ) ) :
						?>
						<ul id="category-filter">
							<li class="active" data-filter="*"><?php esc_html_e( 'All', 'ahncommerce' ); ?></li>
							<?php foreach ( $ahncommerce_filter_cats as $ahncommerce_filter_cat ) : ?>
								<li data-filter=".<?php echo esc_attr( $ahncommerce_filter_cat->slug ); ?>">
									<?php echo esc_html( $ahncommerce_filter_cat->name ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="row featured__filter" id="featured-products">
			<?php
			$ahncommerce_products = new WP_Query(
				array(
					'post_type'      => 'product',
					'posts_per_page' => 8,
				)
			);

			if ( $ahncommerce_products->have_posts() ) :
				while ( $ahncommerce_products->have_posts() ) :
					$ahncommerce_products->the_post();

					$ahncommerce_product_id    = get_the_ID();
					$ahncommerce_product       = wc_get_product( $ahncommerce_product_id );
					$ahncommerce_product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $ahncommerce_product_id ), 'full' );
					$ahncommerce_product_link  = get_permalink( $ahncommerce_product_id );
					$ahncommerce_cat_slugs     = wp_get_post_terms( $ahncommerce_product_id, 'product_cat', array( 'fields' => 'slugs' ) );

					if ( ! $ahncommerce_product instanceof WC_Product ) {
						continue;
					}
					?>
					<div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo esc_attr( implode( ' ', $ahncommerce_cat_slugs ) ); ?>">
						<div class="featured__item">
							<div class="featured__item__pic set-bg" data-setbg="<?php echo $ahncommerce_product_image ? esc_url( $ahncommerce_product_image[0] ) : ''; ?>">
								<ul class="featured__item__pic__hover">
									<li>
										<a href="#" aria-label="<?php esc_attr_e( 'Add to Wishlist', 'ahncommerce' ); ?>">
											<i class="fa fa-heart" aria-hidden="true"></i>
										</a>
									</li>
									<li>
										<?php
										// Output the WooCommerce add to cart link.
										echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
											'woocommerce_loop_add_to_cart_link',
											sprintf(
												'<a href="%s" data-quantity="1" class="product_type_%s ajax_add_to_cart" aria-label="%s" data-product_id="%d" data-product_sku="%s"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>',
												esc_url( $ahncommerce_product->add_to_cart_url() ),
												esc_attr( $ahncommerce_product->get_type() ),
												esc_attr( $ahncommerce_product->get_name() ),
												esc_attr( $ahncommerce_product_id ),
												esc_attr( $ahncommerce_product->get_sku() )
											),
											$ahncommerce_product
										);
										?>
									</li>
								</ul>
							</div>
							<div class="featured__item__text">
								<h6><a href="<?php echo esc_url( $ahncommerce_product_link ); ?>"><?php the_title(); ?></a></h6>
								<h5><?php echo wp_kses_post( $ahncommerce_product->get_price_html() ); ?></h5>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<!-- Featured Products Section End -->

<!-- Banner Section Begin -->
<div class="banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/banner/banner-1.jpg' ); ?>" alt="<?php esc_attr_e( 'Promotional Banner 1', 'ahncommerce' ); ?>">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="banner__pic">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/banner/banner-2.jpg' ); ?>" alt="<?php esc_attr_e( 'Promotional Banner 2', 'ahncommerce' ); ?>">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Banner Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title from-blog__title">
					<h2><?php esc_html_e( 'From The Blog', 'ahncommerce' ); ?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			$ahncommerce_posts = new WP_Query(
				array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
				)
			);

			if ( $ahncommerce_posts->have_posts() ) :
				while ( $ahncommerce_posts->have_posts() ) :
					$ahncommerce_posts->the_post();
					?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="blog__item">
							<div class="blog__item__pic">
								<?php if ( has_post_thumbnail() ) : ?>
									<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								<?php endif; ?>
							</div>
							<div class="blog__item__text">
								<ul>
									<li><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?></li>
									<li><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo esc_html( get_comments_number() ); ?></li>
								</ul>
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<p><?php echo esc_html( get_the_excerpt() ); ?></p>
								<a href="<?php the_permalink(); ?>" class="blog__btn">
									<?php esc_html_e( 'READ MORE', 'ahncommerce' ); ?>
									<span class="arrow_right" aria-hidden="true"></span>
								</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<p><?php esc_html_e( 'No posts found.', 'ahncommerce' ); ?></p>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<!-- Blog Section End -->

<?php get_footer(); ?>
