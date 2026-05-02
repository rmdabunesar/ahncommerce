<?php
/**
 * One Click Demo Import (OCDI) plugin integration.
 *
 * This theme is compatible with the One Click Demo Import plugin
 * (formerly One Click Demo Import, now called Merlin WP or OCDI).
 * This file configures the demo data import sources and post-import setup.
 *
 * @link https://wordpress.org/plugins/one-click-demo-import/
 *
 * @package AhnCommerce
 */

/**
 * Registers the demo import files for the One Click Demo Import plugin.
 *
 * Defines the demo content, widget, and customizer data file locations
 * along with a preview image and import notice.
 *
 * @since 1.0.0
 *
 * @return array Array of demo import configuration arrays.
 */
function ahncommerce_import_files() {
	return array(
		array(
			'import_file_name'             => 'AhnCommerce Demo',
			'categories'                   => array( 'store' ),
			'local_import_file'            => 'https://github.com/rmdabunesar/WordPress-Theme/blob/main/ahn-commerce/inc/demo-data/demo-content.xml',
			'local_import_widget_file'     => 'https://github.com/rmdabunesar/WordPress-Theme/blob/main/ahn-commerce/inc/demo-data/widgets.wie',
			'local_import_customizer_file' => 'https://github.com/rmdabunesar/WordPress-Theme/blob/main/ahn-commerce/inc/demo-data/customizer.dat',
			'import_preview_image_url'     => get_template_directory_uri() . '/inc/demo-data/screenshot.png',
			'import_notice'                => __( 'This theme works best with WooCommerce installed and activated.', 'ahncommerce' ),
		),
	);
}
add_filter( 'ocdi/import_files', 'ahncommerce_import_files' );

/**
 * Runs setup tasks after demo data import completes.
 *
 * Assigns imported menus to their theme locations and configures
 * the front page, blog page, and privacy policy page settings.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_after_import_setup() {
	// Assign menus to their registered theme locations.
	$ahncommerce_menu_map = array(
		'ahncommerce-header-menu' => 'Main Menu',
		'ahncommerce-categories'  => 'Categories',
	);

	$ahncommerce_menu_locations = array();
	foreach ( $ahncommerce_menu_map as $ahncommerce_location => $ahncommerce_name ) {
		$ahncommerce_menu = get_term_by( 'name', $ahncommerce_name, 'nav_menu' );
		if ( $ahncommerce_menu ) {
			$ahncommerce_menu_locations[ $ahncommerce_location ] = $ahncommerce_menu->term_id;
		}
	}
	set_theme_mod( 'nav_menu_locations', $ahncommerce_menu_locations );

	// Set front page, blog page, and privacy policy page.
	$ahncommerce_front_query = new WP_Query(
		array(
			'post_type'      => 'page',
			'title'          => 'Home',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	$ahncommerce_blog_query = new WP_Query(
		array(
			'post_type'      => 'page',
			'title'          => 'Blog',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);
	$ahncommerce_privacy_query = new WP_Query(
		array(
			'post_type'      => 'page',
			'title'          => 'Privacy policy',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	update_option( 'show_on_front', 'page' );

	if ( ! empty( $ahncommerce_front_query->posts ) ) {
		update_option( 'page_on_front', $ahncommerce_front_query->posts[0] );
	}
	if ( ! empty( $ahncommerce_blog_query->posts ) ) {
		update_option( 'page_for_posts', $ahncommerce_blog_query->posts[0] );
	}
	if ( ! empty( $ahncommerce_privacy_query->posts ) ) {
		update_option( 'wp_page_for_privacy_policy', $ahncommerce_privacy_query->posts[0] );
	}

	wp_reset_postdata();
}
add_action( 'ocdi/after_import', 'ahncommerce_after_import_setup' );
