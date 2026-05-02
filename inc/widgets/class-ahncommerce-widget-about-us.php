<?php
/**
 * Widget API: AhnCommerce_Widget_About_Us class.
 *
 * Registers and implements the About Us footer widget that displays
 * the site logo, address, phone number, and email contact details.
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement an About Us widget.
 *
 * Displays the site logo along with address, phone, and email contact
 * information. Designed for use in footer widget areas.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_About_Us extends WP_Widget {

	/**
	 * Sets up a new About Us widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'ahncommerce_widget_about_us',
			'description'                 => __( 'An About Us widget for your site.', 'ahncommerce' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct(
			'ahncommerce-about-us',
			_x( 'AhnCommerce About Us', 'Widget title', 'ahncommerce' ),
			$widget_ops
		);
	}

	/**
	 * Outputs the content for the current About Us widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current About Us widget instance.
	 */
	public function widget( $args, $instance ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['before_widget'];
		?>
		<div class="footer__about__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<h2><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
			<?php endif; ?>
		</div>
		<ul>
			<?php if ( ! empty( $instance['address'] ) ) : ?>
				<li><?php esc_html_e( 'Address:', 'ahncommerce' ); ?> <?php echo esc_html( $instance['address'] ); ?></li>
			<?php endif; ?>
			<?php if ( ! empty( $instance['phone'] ) ) : ?>
				<li><?php esc_html_e( 'Phone:', 'ahncommerce' ); ?> <?php echo esc_html( $instance['phone'] ); ?></li>
			<?php endif; ?>
			<?php if ( ! empty( $instance['email'] ) ) : ?>
				<li><?php esc_html_e( 'Email:', 'ahncommerce' ); ?> <?php echo esc_html( $instance['email'] ); ?></li>
			<?php endif; ?>
		</ul>
		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the About Us widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings for this widget instance.
	 */
	public function form( $instance ) {
		$address = ! empty( $instance['address'] ) ? $instance['address'] : 'Mirpur-10, Dhaka, Bangladesh';
		$phone   = ! empty( $instance['phone'] ) ? $instance['phone'] : '+880 1753214081';
		$email   = ! empty( $instance['email'] ) ? $instance['email'] : 'info@ahnsolution.com';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>">
				<?php esc_html_e( 'Address:', 'ahncommerce' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $address ); ?>"
			>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>">
				<?php esc_html_e( 'Phone:', 'ahncommerce' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $phone ); ?>"
			>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>">
				<?php esc_html_e( 'Email:', 'ahncommerce' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $email ); ?>"
			>
		</p>
		<?php
	}

	/**
	 * Handles updating the settings for the current About Us widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance            = array();
		$instance['address'] = ! empty( $new_instance['address'] ) ? sanitize_text_field( $new_instance['address'] ) : '';
		$instance['phone']   = ! empty( $new_instance['phone'] ) ? sanitize_text_field( $new_instance['phone'] ) : '';
		$instance['email']   = ! empty( $new_instance['email'] ) ? sanitize_email( $new_instance['email'] ) : '';
		return $instance;
	}
}
