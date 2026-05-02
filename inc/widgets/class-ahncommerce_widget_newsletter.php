<?php
/**
 * Widget API: AhnCommerce_Widget_Newsletter class.
 *
 * Registers and implements a Newsletter subscription widget displaying
 * a title, description, email input form, and optional social links.
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Newsletter widget.
 *
 * Renders a newsletter subscription form in the selected widget area.
 * Optionally displays social media links from the Customizer settings.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_Newsletter extends WP_Widget {

	/**
	 * Sets up a new Newsletter widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'ahncommerce_widget_newsletter',
			'description'                 => __( 'A newsletter subscription widget for your site.', 'ahncommerce' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct(
			'ahncommerce-newsletter',
			_x( 'AhnCommerce Newsletter', 'Widget title', 'ahncommerce' ),
			$widget_ops
		);
	}

	/**
	 * Outputs the content for the current Newsletter widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Newsletter widget instance.
	 */
	public function widget( $args, $instance ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['before_widget'];

		// Display widget title if set.
		if ( ! empty( $instance['title'] ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $args['before_title'] . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . $args['after_title'];
		}

		$description = ! empty( $instance['description'] ) ? esc_html( $instance['description'] ) : '';
		?>

		<?php if ( $description ) : ?>
			<p><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>

		<form action="#" method="POST" aria-label="<?php esc_attr_e( 'Newsletter Subscription', 'ahncommerce' ); ?>">
			<input
				type="email"
				id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"
				name="email"
				placeholder="<?php esc_attr_e( 'Enter your email', 'ahncommerce' ); ?>"
				required
			>
			<button type="submit" class="site-btn">
				<?php esc_html_e( 'Subscribe', 'ahncommerce' ); ?>
			</button>
		</form>

		<?php if ( ! empty( $instance['show_social'] ) && 'show' === $instance['show_social'] ) : ?>
			<div class="footer__widget__social">
				<?php
				$ahncommerce_platforms = array( 'facebook', 'twitter', 'linkedin', 'instagram' );
				foreach ( $ahncommerce_platforms as $ahncommerce_platform ) :
					$ahncommerce_url = get_theme_mod( 'set_' . $ahncommerce_platform . '_link', '' );
					if ( ! empty( $ahncommerce_url ) ) :
						?>
						<a href="<?php echo esc_url( $ahncommerce_url ); ?>" target="_blank" rel="noopener noreferrer" class="<?php echo esc_attr( $ahncommerce_platform ); ?>-link" aria-label="<?php echo esc_attr( ucfirst( $ahncommerce_platform ) ); ?>">
							<i class="fa fa-<?php echo esc_attr( $ahncommerce_platform ); ?>" aria-hidden="true"></i>
						</a>
						<?php
					endif;
				endforeach;
				?>
			</div>
		<?php endif; ?>

		<?php
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Newsletter widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings for this widget instance.
	 */
	public function form( $instance ) {
		$title       = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Join Our Newsletter Now', 'ahncommerce' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : __( 'Get E-mail updates about our latest shop and special offers.', 'ahncommerce' );
		$show_social = ! empty( $instance['show_social'] ) ? $instance['show_social'] : 'show';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'ahncommerce' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $title ); ?>"
			>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
				<?php esc_html_e( 'Description:', 'ahncommerce' ); ?>
			</label>
			<textarea
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"
				rows="3"
			><?php echo esc_textarea( $description ); ?></textarea>
		</p>
		<p>
			<label><?php esc_html_e( 'Show Social Links:', 'ahncommerce' ); ?></label><br>
			<input
				type="radio"
				id="<?php echo esc_attr( $this->get_field_id( 'show_social_show' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'show_social' ) ); ?>"
				value="show"
				<?php checked( $show_social, 'show' ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_social_show' ) ); ?>">
				<?php esc_html_e( 'Show', 'ahncommerce' ); ?>
			</label>
			<input
				type="radio"
				id="<?php echo esc_attr( $this->get_field_id( 'show_social_hide' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'show_social' ) ); ?>"
				value="hide"
				<?php checked( $show_social, 'hide' ); ?>
			>
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_social_hide' ) ); ?>">
				<?php esc_html_e( 'Hide', 'ahncommerce' ); ?>
			</label>
		</p>
		<?php
	}

	/**
	 * Handles updating the settings for the current Newsletter widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                = array();
		$instance['title']       = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description'] = ! empty( $new_instance['description'] ) ? sanitize_textarea_field( $new_instance['description'] ) : '';
		$instance['show_social'] = ! empty( $new_instance['show_social'] ) ? sanitize_text_field( $new_instance['show_social'] ) : 'show';
		return $instance;
	}
}
