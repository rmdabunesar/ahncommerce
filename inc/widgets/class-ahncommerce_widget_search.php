<?php
/**
 * Widget API: AhnCommerce_Widget_Search class
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Search widget.
 *
 * @since 1.0.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_Search extends WP_Widget {

	/**
	 * Sets up a new Search widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'ahncommerce_widget_search',
			'description'                 => __( 'A search form for your site.', 'ahncommerce' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'ahncommerce-search', _x( 'AhnCommerce Search', 'Widget title', 'ahncommerce' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Search widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Search widget instance.
	 */
	public function widget( $args, $instance ) {

		echo '<div class="' . esc_attr( 'blog__sidebar__search' ) . '">';
		?>
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<input type="text" name="s" placeholder="<?php esc_attr_e( 'Search...', 'ahncommerce' ); ?>" />
			<button type="submit">
				<span class="icon_search"></span>
			</button>
		</form>
		<?php
		echo '</div>';

	}

	/**
	 * Outputs the settings form for the Search widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title    = $instance['title'];
		?>
		<p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	/**
	 * Handles updating settings for the current Search widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$new_instance      = wp_parse_args( (array) $new_instance, array( 'title' => '' ) );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}
}
