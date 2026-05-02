<?php
/**
 * The sidebar template containing the main widget area for blog pages.
 *
 * Displays widgets that are registered in the 'ahncommerce-blog-sidebar' area.
 * Returns early (outputs nothing) if no widgets are registered in the sidebar.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 *
 * @package AhnCommerce
 */

if ( ! is_active_sidebar( 'ahncommerce-blog-sidebar' ) ) {
	return;
}
?>

<aside class="blog__sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'ahncommerce' ); ?>">
	<?php dynamic_sidebar( 'ahncommerce-blog-sidebar' ); ?>
</aside>
