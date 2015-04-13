<?php

class MewsDistributorBanner extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        parent::__construct(
            'mews_distributor_banner_widget', // Base ID
            __('Mews Distributor Banner', 'text_domain'), // Name
            array('description' => __('Mews Distributor Banner Widget', 'text_domain'),) // Args
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
        echo $args['before_widget'];
        ?>
        <!-- Distributor's banner, you can have multiple of these -->
        <div class="mews-distributor-banner"></div>
        <?php
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {}

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
    }
}


// PHP 5.3+
add_action('widgets_init', function () {
    register_widget('MewsDistributorBanner');
});