<?php
/**
 * The header for the AhnCommerce theme.
 *
 * Displays the HTML <head> section and the site header including
 * navigation, logo, search, and cart elements.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AhnCommerce
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- Page Preloader -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Hamburger Menu Begin -->
	<div class="humberger__menu__overlay"></div>
	<div class="humberger__menu__wrapper">
		<div class="humberger__menu__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
			<?php endif; ?>
		</div>

		<nav class="humberger__menu__nav mobile-menu" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'ahncommerce' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'ahncommerce-header-menu',
					'depth'          => 3,
					'menu_class'     => '',
				)
			);
			?>
		</nav>

		<div id="mobile-menu-wrap"></div>

		<div class="header__top__right__social">
			<span aria-hidden="true">.</span>
			<?php
			$ahncommerce_social_platforms = array( 'facebook', 'twitter', 'linkedin', 'instagram' );
			foreach ( $ahncommerce_social_platforms as $ahncommerce_platform ) :
				$ahncommerce_url = get_theme_mod( 'set_' . $ahncommerce_platform . '_link', '' );
				if ( ! empty( $ahncommerce_url ) ) :
					?>
					<a href="<?php echo esc_url( $ahncommerce_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $ahncommerce_platform ) ); ?>">
						<i class="fa fa-<?php echo esc_attr( $ahncommerce_platform ); ?>" aria-hidden="true"></i>
					</a>
					<?php
				endif;
			endforeach;
			?>
		</div>

		<div class="humberger__menu__contact">
			<ul>
				<li>
					<i class="fa fa-phone" aria-hidden="true"></i>
					<?php echo esc_html( get_theme_mod( 'set_header_hotline', __( '+880 1753214081', 'ahncommerce' ) ) ); ?>
				</li>
				<li>
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<?php echo esc_html( get_theme_mod( 'set_topbar_email', 'info@ahnsolution.com' ) ); ?>
				</li>
			</ul>
		</div>

		<div class="humberger__menu__widget">
			<div class="header__top__right__auth">
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wp_logout_url() ); ?>" aria-label="<?php esc_attr_e( 'Logout', 'ahncommerce' ); ?>">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<?php esc_html_e( 'Logout', 'ahncommerce' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" aria-label="<?php esc_attr_e( 'Login', 'ahncommerce' ); ?>">
						<i class="fa fa-sign-in" aria-hidden="true"></i>
						<?php esc_html_e( 'Login', 'ahncommerce' ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Hamburger Menu End -->

	<!-- Header Section Begin -->
	<header class="header">
		<div class="header__top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="header__top__left">
							<ul>
								<li>
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
									<?php echo esc_html( get_theme_mod( 'set_topbar_email', 'info@ahnsolution.com' ) ); ?>
								</li>
								<li>
									<i class="fa fa-bell-o" aria-hidden="true"></i>
									<?php echo esc_html( get_theme_mod( 'set_topbar_message', __( 'Free Shipping for all Order of $99', 'ahncommerce' ) ) ); ?>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="header__top__right">
							<div class="header__top__right__social">
								<span aria-hidden="true">.</span>
								<?php
								foreach ( $ahncommerce_social_platforms as $ahncommerce_platform ) :
									$ahncommerce_url = get_theme_mod( 'set_' . $ahncommerce_platform . '_link', '' );
									if ( ! empty( $ahncommerce_url ) ) :
										?>
										<a href="<?php echo esc_url( $ahncommerce_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $ahncommerce_platform ) ); ?>">
											<i class="fa fa-<?php echo esc_attr( $ahncommerce_platform ); ?>" aria-hidden="true"></i>
										</a>
										<?php
									endif;
								endforeach;
								?>
							</div>
							<div class="header__top__right__auth">
								<?php if ( is_user_logged_in() ) : ?>
									<a href="<?php echo esc_url( wp_logout_url() ); ?>" aria-label="<?php esc_attr_e( 'Logout', 'ahncommerce' ); ?>">
										<i class="fa fa-sign-out" aria-hidden="true"></i>
										<?php esc_html_e( 'Logout', 'ahncommerce' ); ?>
									</a>
								<?php else : ?>
									<a href="<?php echo esc_url( wp_login_url() ); ?>" aria-label="<?php esc_attr_e( 'Login', 'ahncommerce' ); ?>">
										<i class="fa fa-sign-in" aria-hidden="true"></i>
										<?php esc_html_e( 'Login', 'ahncommerce' ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .header__top -->

		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="header__logo">
						<?php if ( has_custom_logo() ) : ?>
							<?php the_custom_logo(); ?>
						<?php else : ?>
							<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
						<?php endif; ?>
					</div>
				</div>

				<div class="col-lg-7">
					<nav class="header__menu" aria-label="<?php esc_attr_e( 'Primary Navigation', 'ahncommerce' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'ahncommerce-header-menu',
								'depth'          => 2,
								'menu_class'     => '',
							)
						);
						?>
					</nav>
				</div>

				<div class="col-lg-2">
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
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
					<?php endif; ?>
				</div>
			</div>

			<div class="humberger__open" aria-label="<?php esc_attr_e( 'Open Menu', 'ahncommerce' ); ?>" role="button" tabindex="0">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>
		</div>
	</header>
	<!-- Header Section End -->

	<!-- Hero Navigation Section Begin -->
	<section class="hero hero-normal">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="hero__categories">
						<div class="hero__categories__all">
							<i class="fa fa-bars" aria-hidden="true"></i>
							<span><?php esc_html_e( 'All departments', 'ahncommerce' ); ?></span>
						</div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'ahncommerce-categories',
							)
						);
						?>
					</div>
				</div>

				<div class="col-lg-9">
					<div class="hero__search">
						<div class="hero__search__form">
							<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<label class="screen-reader-text" for="hero-search-field"><?php esc_html_e( 'Search for:', 'ahncommerce' ); ?></label>
								<input
									type="search"
									id="hero-search-field"
									name="s"
									placeholder="<?php esc_attr_e( 'Product...', 'ahncommerce' ); ?>"
									value="<?php echo esc_attr( get_search_query() ); ?>"
								/>
								<input type="hidden" name="post_type" value="product" />
								<button type="submit" class="site-btn"><?php esc_html_e( 'SEARCH', 'ahncommerce' ); ?></button>
							</form>
						</div>

						<div class="hero__search__phone">
							<div class="hero__search__phone__icon">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>
							<div class="hero__search__phone__text">
								<h5><?php echo esc_html( get_theme_mod( 'set_header_hotline', __( '+880 1753214081', 'ahncommerce' ) ) ); ?></h5>
								<span><?php echo esc_html( get_theme_mod( 'set_header_info', __( 'support 24/7 time', 'ahncommerce' ) ) ); ?></span>
							</div>
						</div>
					</div>

					<?php
					// Get hero image; fall back to bundled default if none is set.
					$ahncommerce_hero_image_id  = get_theme_mod( 'set_hero_image' );
					$ahncommerce_hero_image_url = $ahncommerce_hero_image_id
						? wp_get_attachment_url( $ahncommerce_hero_image_id )
						: get_template_directory_uri() . '/assets/img/hero/banner.jpg';
					?>
					<div class="hero__item set-bg hero__hide" data-setbg="<?php echo esc_url( $ahncommerce_hero_image_url ); ?>">
						<div class="hero__text">
							<span><?php echo esc_html( get_theme_mod( 'set_hero_subtitle', __( 'FRUIT FRESH', 'ahncommerce' ) ) ); ?></span>
							<h2><?php echo esc_html( get_theme_mod( 'set_hero_title', __( 'Vegetable 100% Organic', 'ahncommerce' ) ) ); ?></h2>
							<a href="<?php echo esc_url( get_theme_mod( 'set_hero_button_url', '#' ) ); ?>" class="primary-btn">
								<?php echo esc_html( get_theme_mod( 'set_hero_button_text', __( 'SHOP Now', 'ahncommerce' ) ) ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero Navigation Section End -->
