<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AhnCommerce
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="spad">
		<div class="container">
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ahncommerce' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->
		</div>
	</section>
</article>
