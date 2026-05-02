<?php
/**
 * Widget API: AhnCommerce_Widget_Recent_Posts class
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_Recent_Posts extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'ahncommerce_widget_recent_entries',
			'description'                 => __( 'Your site&#8217;s most recent posts.', 'ahncommerce' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'ahncommerce-recent-posts', __( 'AhnCommerce Recent Posts', 'ahncommerce' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title  = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Posts', 'ahncommerce' );
		$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;

		$query_args = apply_filters(
			'widget_posts_args',
			array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			),
			$instance
		);

		$r = new WP_Query( $query_args );

		if ( ! $r->have_posts() ) {
			return;
		}

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}
		?>

		<div class="blog__sidebar__recent">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
				$post_title     = get_the_title( $recent_post->ID );
				$title          = ! empty( $post_title ) ? $post_title : __( '(no title)', 'ahncommerce' );
				$thumbnail_url  = get_the_post_thumbnail_url( $recent_post->ID );
				?>
				<a href="<?php echo esc_url( get_permalink( $recent_post->ID ) ); ?>" class="blog__sidebar__recent__item">
					<div class="blog__sidebar__recent__item__pic">
                        <?php echo $thumbnail_url ? '<img src="'. $thumbnail_url .'" alt="">' : __( '(no image)', 'ahncommerce' ); ?>
					</div>
					<div class="blog__sidebar__recent__item__text">
						<h6><?php echo esc_html( $title ); ?></h6>
						<span><?php echo esc_html( get_the_date( '', $recent_post->ID ) ); ?></span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ahncommerce' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'ahncommerce' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<?php
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = isset( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 5;

		return $instance;
	}
}
