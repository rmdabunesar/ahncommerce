<?php
/**
 * The template for displaying all pages.
 *
 * This is the default template that WordPress uses when displaying static pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AhnCommerce
 */

get_header();

while ( have_posts() ) : the_post();

	// Include the page content template.
	get_template_part( 'template-parts/content', 'page' );

	// Load comments template if comments are open or there are existing comments.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile;

get_footer();
?>
