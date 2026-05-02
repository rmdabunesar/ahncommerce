<?php
/**
 * AhnCommerce functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used by
 * the theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AhnCommerce
 */

if ( ! defined( 'AHNCOMMERCE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'AHNCOMMERCE_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'ahncommerce', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 85,
			'width'       => 160,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * This theme uses wp_nav_menu() in two locations.
	 * Register navigation menus for header and product categories.
	 */
	register_nav_menus(
		array(
			'ahncommerce-header-menu' => esc_html__( 'Header', 'ahncommerce' ),
			'ahncommerce-categories'  => esc_html__( 'Categories', 'ahncommerce' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Adds theme support for post formats.
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'audio',
			'chat',
			'gallery',
			'image',
			'link',
			'quote',
			'status',
			'video',
		)
	);

	// Add WooCommerce support.
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);

	// Enable WooCommerce product gallery features.
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Restore the classic widget editor.
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'ahncommerce_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since 1.0.0
 *
 * @global int $content_width
 */
function ahncommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ahncommerce_content_width', 1170 );
}
add_action( 'after_setup_theme', 'ahncommerce_content_width', 0 );

/**
 * Registers widget areas.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function ahncommerce_widgets_init() {
	// Register custom widget classes.
	register_widget( 'AhnCommerce_Widget_Search' );
	register_widget( 'AhnCommerce_Widget_Post_Categories' );
	register_widget( 'AhnCommerce_Widget_Recent_Posts' );
	register_widget( 'AhnCommerce_Widget_Post_Tags' );
	register_widget( 'AhnCommerce_Widget_Newsletter' );
	register_widget( 'AhnCommerce_Widget_About_Us' );

	// Register Blog Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Sidebar', 'ahncommerce' ),
			'id'            => 'ahncommerce-blog-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in the blog sidebar.', 'ahncommerce' ),
			'before_widget' => '<div class="blog__sidebar__item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	// Register Shop Sidebar.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Sidebar', 'ahncommerce' ),
			'id'            => 'ahncommerce-shop-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in the shop sidebar.', 'ahncommerce' ),
			'before_widget' => '<div class="sidebar__item">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	// Register Footer Widget Areas.
	$footer_areas = array(
		'ahncommerce-footer-widget-1' => esc_html__( 'Footer Area 1', 'ahncommerce' ),
		'ahncommerce-footer-widget-2' => esc_html__( 'Footer Area 2', 'ahncommerce' ),
		'ahncommerce-footer-widget-3' => esc_html__( 'Footer Area 3', 'ahncommerce' ),
		'ahncommerce-footer-widget-4' => esc_html__( 'Footer Area 4', 'ahncommerce' ),
	);

	foreach ( $footer_areas as $id => $name ) {
		register_sidebar(
			array(
				'name'          => $name,
				'id'            => $id,
				'description'   => esc_html__( 'Add widgets here to appear in this footer area.', 'ahncommerce' ),
				'before_widget' => '<div class="footer__widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h6>',
				'after_title'   => '</h6>',
			)
		);
	}
}
add_action( 'widgets_init', 'ahncommerce_widgets_init' );

/**
 * Enqueues theme scripts and styles.
 *
 * @since 1.0.0
 *
 * @return void
 */
function ahncommerce_enqueue_scripts() {
	// Google Fonts - Cairo.
	wp_enqueue_style(
		'ahncommerce-google-fonts',
		'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap',
		array(),
		null
	);

	// Bootstrap CSS.
	wp_enqueue_style(
		'ahncommerce-bootstrap',
		get_template_directory_uri() . '/assets/css/bootstrap.min.css',
		array(),
		'4.4.1'
	);

	// Font Awesome icons.
	wp_enqueue_style(
		'ahncommerce-font-awesome',
		get_template_directory_uri() . '/assets/css/font-awesome.min.css',
		array(),
		'4.7.0'
	);

	// Elegant Icons.
	wp_enqueue_style(
		'ahncommerce-elegant-icons',
		get_template_directory_uri() . '/assets/css/elegant-icons.css',
		array(),
		AHNCOMMERCE_VERSION
	);

	// jQuery Nice Select CSS.
	wp_enqueue_style(
		'ahncommerce-nice-select',
		get_template_directory_uri() . '/assets/css/nice-select.css',
		array(),
		AHNCOMMERCE_VERSION
	);

	// jQuery UI CSS.
	wp_enqueue_style(
		'ahncommerce-jquery-ui',
		get_template_directory_uri() . '/assets/css/jquery-ui.min.css',
		array(),
		'1.12.1'
	);

	// Owl Carousel CSS.
	wp_enqueue_style(
		'ahncommerce-owl-carousel',
		get_template_directory_uri() . '/assets/css/owl.carousel.min.css',
		array(),
		'2.3.4'
	);

	// SlickNav CSS.
	wp_enqueue_style(
		'ahncommerce-slicknav',
		get_template_directory_uri() . '/assets/css/slicknav.min.css',
		array(),
		'1.0.10'
	);

	// Main theme stylesheet.
	wp_enqueue_style(
		'ahncommerce-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		AHNCOMMERCE_VERSION
	);

	// WooCommerce-specific stylesheet.
	wp_enqueue_style(
		'ahncommerce-wc-style',
		get_template_directory_uri() . '/assets/css/wc-style.css',
		array(),
		AHNCOMMERCE_VERSION
	);

	// Theme's main style.css (contains theme header and base styles).
	wp_enqueue_style(
		'ahncommerce-stylesheet',
		get_stylesheet_uri(),
		array( 'ahncommerce-style' ),
		AHNCOMMERCE_VERSION
	);

	// Bootstrap JS.
	wp_enqueue_script(
		'ahncommerce-bootstrap',
		get_template_directory_uri() . '/assets/js/bootstrap.min.js',
		array( 'jquery' ),
		'4.4.1',
		true
	);

	// jQuery Nice Select JS.
	wp_enqueue_script(
		'ahncommerce-nice-select',
		get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js',
		array( 'jquery' ),
		AHNCOMMERCE_VERSION,
		true
	);

	// jQuery UI JS.
	wp_enqueue_script(
		'ahncommerce-jquery-ui',
		get_template_directory_uri() . '/assets/js/jquery-ui.min.js',
		array( 'jquery' ),
		'1.12.1',
		true
	);

	// SlickNav mobile menu JS.
	wp_enqueue_script(
		'ahncommerce-slicknav',
		get_template_directory_uri() . '/assets/js/jquery.slicknav.js',
		array( 'jquery' ),
		AHNCOMMERCE_VERSION,
		true
	);

	// MixItUp filtering JS.
	wp_enqueue_script(
		'ahncommerce-mixitup',
		get_template_directory_uri() . '/assets/js/mixitup.min.js',
		array( 'jquery' ),
		'3.3.1',
		true
	);

	// Owl Carousel JS.
	wp_enqueue_script(
		'ahncommerce-owl-carousel',
		get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
		array( 'jquery' ),
		'2.3.4',
		true
	);

	// WooCommerce custom script.
	wp_enqueue_script(
		'ahncommerce-wc-script',
		get_template_directory_uri() . '/assets/js/wc-script.js',
		array( 'jquery' ),
		AHNCOMMERCE_VERSION,
		true
	);

	// Main theme JS file.
	wp_enqueue_script(
		'ahncommerce-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		AHNCOMMERCE_VERSION,
		true
	);

	// Enqueue comment reply script for threaded comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ahncommerce_enqueue_scripts' );

/**
 * Updates the cart fragment in the header via AJAX.
 *
 * This function is hooked into the woocommerce_add_to_cart_fragments filter
 * to update the cart count and total in the header without a page reload.
 *
 * @since 1.0.0
 *
 * @param array $fragments Associative array of DOM selectors and their HTML content.
 * @return array Updated fragments array with the header cart HTML.
 */
function ahncommerce_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="header__cart">
		<ul>
			<li>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'View Cart', 'ahncommerce' ); ?>">
					<i class="fa fa-shopping-bag" aria-hidden="true"></i>
					<span><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
				</a>
			</li>
		</ul>
		<div class="header__cart__price">
			<?php esc_html_e( 'Total:', 'ahncommerce' ); ?>
			<span><?php echo wp_kses_post( WC()->cart->get_total() ); ?></span>
		</div>
	</div>
	<?php
	$fragments['div.header__cart'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ahncommerce_woocommerce_header_add_to_cart_fragment' );

/**
 * Loads the Customizer options file.
 *
 * @since 1.0.0
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Loads the WooCommerce template modification file when WooCommerce is active.
 *
 * @since 1.0.0
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/wc-modification.php';
}

/**
 * Loads the demo data import setup file.
 *
 * @since 1.0.0
 */
if ( file_exists( get_template_directory() . '/inc/demo-data/ocdi.php' ) ) {
	require_once get_template_directory() . '/inc/demo-data/ocdi.php';
}

/**
 * Loads custom widget class files.
 *
 * @since 1.0.0
 */
$ahncommerce_widget_files = array(
	'class-ahncommerce_widget_search.php',
	'class-ahncommerce-widget-post-categories.php',
	'class-ahncommerce-widget-recent-posts.php',
	'class-ahncommerce-widget-post-tags.php',
	'class-ahncommerce_widget_newsletter.php',
	'class-ahncommerce-widget-about-us.php',
);

foreach ( $ahncommerce_widget_files as $ahncommerce_file ) {
	$ahncommerce_path = get_template_directory() . '/inc/widgets/' . $ahncommerce_file;
	if ( file_exists( $ahncommerce_path ) ) {
		require_once $ahncommerce_path;
	}
}
