<?php
/**
 * AhnCommerce Theme Customizer.
 *
 * Registers all theme Customizer settings, sections, panels, and controls
 * for the AhnCommerce theme.
 *
 * @link https://developer.wordpress.org/themes/customize-api/
 *
 * @package AhnCommerce
 */

/**
 * Adds the theme's Customizer settings.
 *
 * Registers panels, sections, settings, and controls for managing the top bar,
 * social links, header, hero section, and footer via the WordPress Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer manager instance.
 */
function ahncommerce_customize_register( $wp_customize ) {

	// =========================================================================
	// Top Bar Panel
	// =========================================================================
	$wp_customize->add_panel(
		'panel_topbar',
		array(
			'title'    => __( 'Top Bar', 'ahncommerce' ),
			'priority' => 30,
		)
	);

	// --- Top Bar General Settings Section ---
	$wp_customize->add_section(
		'sec_topbar',
		array(
			'title'    => __( 'General Settings', 'ahncommerce' ),
			'panel'    => 'panel_topbar',
			'priority' => 10,
		)
	);

	// Topbar Email.
	$wp_customize->add_setting(
		'set_topbar_email',
		array(
			'type'              => 'theme_mod',
			'default'           => 'info@ahnsolution.com',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_topbar_email',
		array(
			'label'       => __( 'Email', 'ahncommerce' ),
			'description' => __( 'Add your email address.', 'ahncommerce' ),
			'section'     => 'sec_topbar',
			'type'        => 'text',
		)
	);

	// Topbar Message.
	$wp_customize->add_setting(
		'set_topbar_message',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'Free Shipping for all Order of $99', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_topbar_message',
		array(
			'label'       => __( 'Message', 'ahncommerce' ),
			'description' => __( 'Add your promotional message.', 'ahncommerce' ),
			'section'     => 'sec_topbar',
			'type'        => 'text',
		)
	);

	// =========================================================================
	// Social Media Section (inside Top Bar Panel)
	// =========================================================================
	$wp_customize->add_section(
		'sec_social_media',
		array(
			'title'    => __( 'Social Media Links', 'ahncommerce' ),
			'panel'    => 'panel_topbar',
			'priority' => 20,
		)
	);

	$ahncommerce_social_platforms = array( 'facebook', 'twitter', 'linkedin', 'instagram' );

	foreach ( $ahncommerce_social_platforms as $ahncommerce_platform ) {
		$wp_customize->add_setting(
			'set_' . $ahncommerce_platform . '_link',
			array(
				'type'              => 'theme_mod',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			'set_' . $ahncommerce_platform . '_link',
			array(
				/* translators: %s: Social media platform name (e.g. Facebook, Twitter). */
				'label'       => sprintf( __( '%s URL', 'ahncommerce' ), ucfirst( $ahncommerce_platform ) ),
				/* translators: %s: Social media platform name. */
				'description' => sprintf( __( 'Enter your %s profile link.', 'ahncommerce' ), ucfirst( $ahncommerce_platform ) ),
				'section'     => 'sec_social_media',
				'type'        => 'url',
			)
		);
	}

	// =========================================================================
	// Header Panel
	// =========================================================================
	$wp_customize->add_panel(
		'panel_header',
		array(
			'title'    => __( 'Header', 'ahncommerce' ),
			'priority' => 40,
		)
	);

	// --- Hotline Section ---
	$wp_customize->add_section(
		'sec_header',
		array(
			'title'    => __( 'Hotline', 'ahncommerce' ),
			'panel'    => 'panel_header',
			'priority' => 10,
		)
	);

	// Hotline Number.
	$wp_customize->add_setting(
		'set_header_hotline',
		array(
			'type'              => 'theme_mod',
			'default'           => '+880 1753214081',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_header_hotline',
		array(
			'label'       => __( 'Hotline Number', 'ahncommerce' ),
			'description' => __( 'Add your hotline phone number.', 'ahncommerce' ),
			'section'     => 'sec_header',
			'type'        => 'text',
		)
	);

	// Hotline Info Text.
	$wp_customize->add_setting(
		'set_header_info',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'support 24/7 time', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_header_info',
		array(
			'label'       => __( 'Hotline Info', 'ahncommerce' ),
			'description' => __( 'Add availability info below the hotline number.', 'ahncommerce' ),
			'section'     => 'sec_header',
			'type'        => 'text',
		)
	);

	// =========================================================================
	// Hero Panel
	// =========================================================================
	$wp_customize->add_panel(
		'panel_hero',
		array(
			'title'    => __( 'Hero', 'ahncommerce' ),
			'priority' => 50,
		)
	);

	// --- Hero Text Section ---
	$wp_customize->add_section(
		'sec_hero_text',
		array(
			'title'    => __( 'Text', 'ahncommerce' ),
			'panel'    => 'panel_hero',
			'priority' => 10,
		)
	);

	// Hero Subtitle.
	$wp_customize->add_setting(
		'set_hero_subtitle',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'FRUIT FRESH', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_hero_subtitle',
		array(
			'label'       => __( 'Subtitle', 'ahncommerce' ),
			'description' => __( 'Add your hero subtitle.', 'ahncommerce' ),
			'section'     => 'sec_hero_text',
			'type'        => 'text',
		)
	);

	// Hero Title.
	$wp_customize->add_setting(
		'set_hero_title',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'Vegetable 100% Organic', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_hero_title',
		array(
			'label'       => __( 'Title', 'ahncommerce' ),
			'description' => __( 'Add your hero title.', 'ahncommerce' ),
			'section'     => 'sec_hero_text',
			'type'        => 'text',
		)
	);

	// --- Hero Button Section ---
	$wp_customize->add_section(
		'sec_hero_button',
		array(
			'title'    => __( 'Button', 'ahncommerce' ),
			'panel'    => 'panel_hero',
			'priority' => 20,
		)
	);

	// Hero Button Text.
	$wp_customize->add_setting(
		'set_hero_button_text',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'SHOP NOW', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_hero_button_text',
		array(
			'label'       => __( 'Button Text', 'ahncommerce' ),
			'description' => __( 'Add your button label.', 'ahncommerce' ),
			'section'     => 'sec_hero_button',
			'type'        => 'text',
		)
	);

	// Hero Button URL.
	$wp_customize->add_setting(
		'set_hero_button_url',
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'set_hero_button_url',
		array(
			'label'       => __( 'Button URL', 'ahncommerce' ),
			'description' => __( 'Add your button link.', 'ahncommerce' ),
			'section'     => 'sec_hero_button',
			'type'        => 'url',
		)
	);

	// --- Hero Image Section ---
	$wp_customize->add_section(
		'sec_hero_image',
		array(
			'title'    => __( 'Image', 'ahncommerce' ),
			'panel'    => 'panel_hero',
			'priority' => 30,
		)
	);

	// Hero Background Image.
	$wp_customize->add_setting(
		'set_hero_image',
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'set_hero_image',
			array(
				'label'       => __( 'Hero Image', 'ahncommerce' ),
				'description' => __( 'Select the hero background image.', 'ahncommerce' ),
				'section'     => 'sec_hero_image',
				'mime_type'   => 'image',
			)
		)
	);

	// =========================================================================
	// Footer Section
	// =========================================================================
	$wp_customize->add_section(
		'sec_footer_bottom',
		array(
			'title'    => __( 'Footer', 'ahncommerce' ),
			'priority' => 60,
		)
	);

	// Footer Copyright Text.
	$wp_customize->add_setting(
		'set_footer_copiright',
		array(
			'type'              => 'theme_mod',
			'default'           => __( 'Copyright &copy; 2025 | All Rights Reserved | This theme is made by AHN Solution', 'ahncommerce' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'set_footer_copiright',
		array(
			'label'       => __( 'Copyright Text', 'ahncommerce' ),
			'description' => __( 'Add your copyright text.', 'ahncommerce' ),
			'section'     => 'sec_footer_bottom',
			'type'        => 'textarea',
		)
	);

	// Footer Payment Method Image.
	$wp_customize->add_setting(
		'set_footer_image',
		array(
			'type'              => 'theme_mod',
			'default'           => '',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'set_footer_image',
			array(
				'label'       => __( 'Payment Method Image', 'ahncommerce' ),
				'description' => __( 'Select your payment method image.', 'ahncommerce' ),
				'section'     => 'sec_footer_bottom',
				'mime_type'   => 'image',
			)
		)
	);
}
add_action( 'customize_register', 'ahncommerce_customize_register' );
