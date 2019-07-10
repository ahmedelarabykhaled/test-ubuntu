
<?php
/*
Plugin Name: My Widget Plugin
Plugin URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
Description: This plugin adds a custom widget.
Version: 1.0
Author: AJ Clarke
Author URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
License: GPL2
*/
// The widget class
class My_Custom_Widget extends WP_Widget {
	// Main constructor
	public function __construct() {
		parent::__construct(
			'my_custom_widget',
			__( 'My Custom Widget', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}
	// The widget form (for the backend )
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'text'     => '',
            'textarea' => '',
            'url' => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Text Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
		</p>

		<?php // Textarea Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php _e( 'Textarea:', 'text_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo wp_kses_post( $textarea ); ?></textarea>
		</p>

		<?php // Image Link Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php _e( 'Url:', 'text_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>"><?php echo wp_kses_post( $url ); ?></textarea>
		</p>
	<?php }
	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
        $instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
        $instance['url'] = isset( $new_instance['url']) ? $new_instance['url'] : '';
		return $instance;
	}
	// Display the widget
	public function widget( $args, $instance ) {
		extract( $args );
		// Check the widget options
		$text     = isset( $instance['text'] ) ? $instance['text'] : '';
        $textarea = isset( $instance['textarea'] ) ?$instance['textarea'] : '';
        $url = isset( $instance['url'] ) ?$instance['url'] : '';
		// WordPress core before_widget hook (always include )
		echo $before_widget;
		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';
			// Display widget title if defined
			// Display text field
			if ( $text ) {
				echo '<h3>' . $text . '</h3>';
			}
			// Display textarea field
			if ( $textarea ) {
				echo '<p>' . $textarea . '</p>';
            }
            
			// Display image field
			if ( $url ) {
				echo '<img src="' . $url . '" width="100px" height="100px"/>';
            }
            ?>
            <label for="upload_image">
    <input id="upload_image" type="text" size="36" name="ad_image" value="http://" /> 
    <input id="upload_image_button" class="button" type="button" value="Upload Image" />
    <br />Enter a URL or upload an image
</label>
<?php
		echo '</div>';
		// WordPress core after_widget hook (always include )
		echo $after_widget;
	}
}
// Register the widget
function my_register_custom_widget() {
	register_widget( 'My_Custom_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );



?>
