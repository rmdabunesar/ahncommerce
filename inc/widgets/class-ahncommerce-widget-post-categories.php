<?php
/**
 * Widget API: AhnCommerce_Widget_Post_Categories class
 *
 * @package AhnCommerce
 * @subpackage Widgets
 * @since 1.0.0
 */

/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class AhnCommerce_Widget_Post_Categories extends WP_Widget {
    /**
     * Sets up a new Categories widget instance.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $widget_ops = array(
            'classname'                   => 'ahncommerce_widget_post_categories',
            'description'                 => __( 'A list or dropdown of post categories.', 'ahncommerce' ),
            'customize_selective_refresh' => true,
            'show_instance_in_rest'       => true,
        );
        parent::__construct( 'ahncommerce-categories', esc_html__( 'AhnCommerce Post Categories', 'ahncommerce' ), $widget_ops );
    }

    /**
     * Outputs the content for the current Categories widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Categories widget instance.
     */
    public function widget( $args, $instance ) {

        echo $args['before_widget'];

        // Display widget title if set
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', sanitize_text_field( $instance['title'] ) ) . $args['after_title'];
        }

        // Get categories with a limit if set
        $number_of_categories = ! empty( $instance['number_of_categories'] ) ? intval( $instance['number_of_categories'] ) : -1;
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'number'  => $number_of_categories,
        ) );

        if ( ! empty( $categories ) ) {
            echo '<ul>';
            foreach ( $categories as $category ) {
                echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . ' (' . esc_html( $category->count ) . ')</a></li>';
            }
            echo '</ul>';
        }

        echo $args['after_widget'];
    }

    /**
     * Outputs the settings form for the Categories widget.
     *
     * @since 1.0.0
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : __( 'Post Categories', 'ahncommerce' );
        $number_of_categories = ! empty( $instance['number_of_categories'] ) ? intval( $instance['number_of_categories'] ) : 10; 
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'ahncommerce' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number_of_categories' ); ?>"><?php _e( 'Maximum Number of Categories to Display:', 'ahncommerce' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number_of_categories' ); ?>" name="<?php echo $this->get_field_name( 'number_of_categories' ); ?>" type="number" value="<?php echo esc_attr( $number_of_categories ); ?>" min="1" />
        </p>
        <?php
    }

    /**
     * Handles updating settings for the current Categories widget instance.
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
        $instance['number_of_categories'] = ! empty( $new_instance['number_of_categories'] ) ? intval( $new_instance['number_of_categories'] ) : 10; // Default to 10
        return $instance;
    }
}
