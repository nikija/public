<?php

class MewsDistributor extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct(
            'mews_distributor_widget', // Base ID
            __('Mews Distributor', 'text_domain'), // Name
            array('description' => __('Mews Distributor Widget', 'text_domain'),) // Args
        );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        $hotelId = !empty($instance['hotelId']) ? $instance['hotelId'] : null;
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        ?>
        <!-- Distributor's element, insert anywhere in website -->
        <div id="mews-distributor"></div>

        <!-- Distributor's banner, you can have multiple of these -->
        <div class="mews-distributor-banner"></div>

        <script>
            new Mews.Distributor({
                hotelId: '<?php echo $hotelId; ?>'
            });
        </script>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $hotelId = !empty($instance['hotelId']) ? $instance['hotelId'] : null;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('hotelId'); ?>"><?php _e('Hotel ID:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('hotelId'); ?>"
                   name="<?php echo $this->get_field_name('hotelId'); ?>" type="text"
                   value="<?php echo esc_attr($hotelId); ?>">
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['hotelId'] = (!empty($new_instance['hotelId'])) ? strip_tags($new_instance['hotelId']) : '';

        return $instance;
    }
}


// PHP 5.3+
add_action('widgets_init', function () {
    register_widget('MewsDistributor');
});