<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package AhnCommerce
 */

get_header();
?>

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-5 order-md-1 order-2">
				<?php get_sidebar(); ?>
			</div>
			<div class="col-lg-8 col-md-7 order-md-2 order-1">
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						// Include the template part for single post content.
						get_template_part( 'template-parts/content', 'single' );

						// Display comments section if comments are open or post has comments.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
</section>
<!-- Blog Details Section End -->

<!-- Related Posts Section Begin -->
<section class="related-blog spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title related-blog-title">
					<h2><?php esc_html_e( 'Post You May Like', 'ahncommerce' ); ?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<?php
			// Get the current post's ID and its categories for related posts query.
			$ahncommerce_current_id         = get_the_ID();
			$ahncommerce_current_categories = wp_get_post_categories( $ahncommerce_current_id );

			$ahncommerce_related_args = array(
				'category__in'   => $ahncommerce_current_categories,
				'post__not_in'   => array( $ahncommerce_current_id ),
				'posts_per_page' => 3,
				'orderby'        => 'rand',
			);

			$ahncommerce_related_query = new WP_Query( $ahncommerce_related_args );

			if ( $ahncommerce_related_query->have_posts() ) :
				while ( $ahncommerce_related_query->have_posts() ) :
					$ahncommerce_related_query->the_post();
					?>
					<div class="col-lg-4 col-md-6 col-sm-12">
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
					<?php
				endwhile;
			else :
				echo '<p>' . esc_html__( 'No related posts found.', 'ahncommerce' ) . '</p>';
			endif;

			// Reset post data after custom query.
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<!-- Related Posts Section End -->

<?php get_footer(); ?>
