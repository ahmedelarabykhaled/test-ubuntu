<?php
/*
Plugin Name: HeroZone And How To Widget
Plugin URI: 
Description: (hero zone) (how_to) widget
Version: 1.0
*/



// Creating the widget 
class Hero_Zone_And_How_To_Widget extends WP_Widget
{
    function __construct()
    {

        $widget_ops = array(
            'classname' => 'hero-zone-and-how-to',
            'description' => 'hero-zone and how-to widget'
        );
        parent::__construct(
            // Base ID of your widget
            'hero_zone_and_how_to',
            // Widget name will appear in UI
            __('HeroZone And HowTo Widget', 'wpb_widget_domain'),
            $widget_ops
        );
    }

    // Creating widget front-end
    public function widget($args, $instance)
    {


        if ($args['id'] == "how-are-we-doing") {
            $this->draw_how_are_we_doing_html($instance);
        } else if ($args['id'] == "hero-zone") {
            $this->draw_hero_zone_html($instance);
        } else { }
    }
    public function draw_hero_zone_html($instance)
    {
        $title = $instance['title'];
        $description = $instance['description'];
        $text_link = $instance['text_link'];
        $url_link = $instance['url_link'];
        $image_id = $instance['image_id'];
        include( locate_template( 'template-parts/hero_zone_and_how_to_guidelines_upcoming_widget/herozone-template.php', false, false ) ); 
    }

    public function draw_how_are_we_doing_html($instance)
    {
        $title = $instance['title'];
        $description = $instance['description'];
        $text_link = $instance['text_link'];
        $url_link = $instance['url_link'];
        $image_id = $instance['image_id'];
        include( locate_template( 'template-parts/hero_zone_and_how_to_guidelines_upcoming_widget/howarewe-template.php', false, false ) ); 
    }
    // Widget Backend 
    public function form($instance)
    {
        $title = isset($instance['title']) ?  $instance['title'] : '';
        $description = isset($instance['description']) ?  $instance['description'] : '';
        $text_link = isset($instance['text_link']) ?  $instance['text_link'] : '';
        $url_link = isset($instance['url_link']) ?  $instance['url_link'] : '';
        $image_url = isset($instance['image_url']) ?  $instance['image_url'] : '';
        $image_id = isset($instance['image_id']) ?  $instance['image_id'] : 0;

        $curr_translate = "HeroZone And HowTo Widget";
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php echo __($curr_translate . ' title', 'wpb_widget_domain'); ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text" value="<?php echo esc_attr($description); ?>" placeholder="<?php echo __($curr_translate . ' New description', 'wpb_widget_domain'); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('url_link'); ?>"><?php _e('Url Link:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('url_link'); ?>" name="<?php echo $this->get_field_name('url_link'); ?>" type="text" value="<?php echo esc_attr($url_link); ?>" placeholder="<?php echo __($curr_translate . ' New url link', 'wpb_widget_domain'); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('text_link'); ?>"><?php _e('Text Link:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('text_link'); ?>" name="<?php echo $this->get_field_name('text_link'); ?>" type="text" value="<?php echo esc_attr($text_link); ?>" placeholder="<?php echo __($curr_translate . ' New text link', 'wpb_widget_domain'); ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_id'); ?>"><?php _e('Image:'); ?></label>
        <img class="<?= $this->id ?>_img" src="<?= $image_url ?>" style="margin:0;padding:0;max-width:100%;display:block" />
        <input type="hidden" class="widefat <?= $this->id ?>_id" name="<?= $this->get_field_name('image_id'); ?>" value="<?php echo esc_attr($image_id); ?>" />
        <input type="hidden" class="widefat <?= $this->id ?>_url" name="<?= $this->get_field_name('image_url'); ?>" value="<?php echo esc_attr($image_url); ?>" />
        <input type="button" id="<?= $this->id ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>

<?php
}

// Updating widget replacing old instances with new
public function update($new_instance, $old_instance)
{
    $instance = $old_instance;
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['description'] = (!empty($new_instance['description'])) ? strip_tags($new_instance['description']) : '';
    $instance['text_link'] = (!empty($new_instance['text_link'])) ? strip_tags($new_instance['text_link']) : '';
    $instance['url_link'] = (!empty($new_instance['url_link'])) ? strip_tags($new_instance['url_link']) : '';
    $instance['image_id'] = (!empty($new_instance['image_id'])) ? strip_tags($new_instance['image_id']) : '';
    $instance['image_url'] = (!empty($new_instance['image_url'])) ? strip_tags($new_instance['image_url']) : '';

    return $instance;
}
} // Class wpb_widget ends here


// Register and load the widget
function wpb_load_widget()
{
    register_widget('Hero_Zone_And_How_To_Widget');
}
add_action('widgets_init', 'wpb_load_widget');


function my_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('ads_script', plugin_dir_url(__FILE__) . '/js/scripts.js', true, '1.0.0', true);
}
add_action('admin_enqueue_scripts', 'my_scripts');
