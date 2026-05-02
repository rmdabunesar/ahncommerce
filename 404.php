<?php
/**
 * The template for displaying 404 pages (page not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AhnCommerce
 */

get_header();
?>

<section class="error-404 not-found spad">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-content-404">
					<h1><?php esc_html_e( 'Page not found', 'ahncommerce' ); ?></h1>
					<p><?php esc_html_e( 'Unfortunately, the page you tried to reach does not exist on this site. You can use the search form or go back to the home page.', 'ahncommerce' ); ?></p>
					<?php get_search_form(); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="primary-btn">
						<?php esc_html_e( 'Go to Home Page', 'ahncommerce' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
