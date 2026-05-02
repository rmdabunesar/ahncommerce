<?php
/**
 * Widget API: AhnCommerce_Widget_Post_Tags class
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Tags widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_Post_Tags extends WP_Widget {
    /**
     * Sets up a new Tags widget instance.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'ahncommerce_widget_post_tags',
            'description'                 => __( 'A list or dropdown of post tags.', 'ahncommerce' ),
            'customize_selective_refresh' => true,
            'show_instance_in_rest'       => true,
        );
        parent::__construct( 'ahncommerce-tags', esc_html__( 'AhnCommerce Post Tags', 'ahncommerce' ), $widget_ops );
    }

    /**
     * Outputs the content for the current Tags widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Tags widget instance.
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        // Display widget title if set
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', sanitize_text_field( $instance['title'] ) ) . $args['after_title'];
        }

        // Get tags with a limit if set
        $number_of_tags = ! empty( $instance['number_of_tags'] ) ? intval( $instance['number_of_tags'] ) : -1;
        $tags = get_tags( array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'number'  => $number_of_tags,
        ) );

        if ( ! empty( $tags ) ) {
            echo '<div class="blog__sidebar__item__tags">';
            foreach ( $tags as $tag ) {
                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
            }
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    /**
     * Outputs the settings form for the Tags widget.
     *
     * @since 1.0.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : __( 'Post Tags', 'ahncommerce' );
        $number_of_tags = ! empty( $instance['number_of_tags'] ) ? intval( $instance['number_of_tags'] ) : 10; 
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ahncommerce' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_of_tags' ); ?>"><?php _e( 'Maximum Number of Tags to Display:', 'ahncommerce' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number_of_tags' ); ?>" name="<?php echo $this->get_field_name( 'number_of_tags' ); ?>" type="number" value="<?php echo esc_attr( $number_of_tags ); ?>" min="1" />
        </p>
        <?php
    }

    /**
     * Handles updating settings for the current Tags widget instance.
     *
     * @since 1.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number_of_tags'] = ! empty( $new_instance['number_of_tags'] ) ? intval( $new_instance['number_of_tags'] ) : 10; // Default to 10
        return $instance;
    }
}
