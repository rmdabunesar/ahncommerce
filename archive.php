<?php
/**
 * The template for displaying archive pages (category, tag, author, date, etc.).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AhnCommerce
 */

get_header();
?>

<!-- Blog Archive Section Begin -->
<section class="blog-archive spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-5">
				<?php get_sidebar(); ?>
			</div>
			<div class="col-lg-8 col-md-7">
				<div class="row">
					<?php
					if ( have_posts() ) :
						// Start the Loop.
						while ( have_posts() ) : the_post();
							// Include the Post-Type-specific template for the content.
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;

						wp_link_pages(
							array(
								'before'      => '<div class="page-links">',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							)
						);

					else :
						echo '<p>' . esc_html__( 'No posts found.', 'ahncommerce' ) . '</p>';
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Blog Archive Section End -->

<?php get_footer(); ?>
