<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package AhnCommerce
 */

get_header();
?>

<section class="spad">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : ?>
				<header class="page-header col-12">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query */
						printf( esc_html__( 'Search Results for: %s', 'ahncommerce' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', 'search' );
				endwhile;

				the_posts_navigation();
				?>

			<?php else : ?>
				<div class="col-12">
					<p><?php esc_html_e( 'Sorry, no results were found. Please try a different search.', 'ahncommerce' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
