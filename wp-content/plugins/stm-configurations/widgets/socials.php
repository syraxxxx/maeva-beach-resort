<?php

class Hotel_Socials_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'socials', // Base ID
            esc_html__('Socials', 'hotello'), // Name
            array('description' => esc_html__('Socials widget', 'hotello'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {

        if (!empty($instance['socials'])) :
            $socials = $instance['socials'];

            $style = !empty($instance['style']) ? $instance['style'] : 'style_1';

            hotello_add_widget_style('socials', $style);

            if (!empty($args['before_widget'])) {
                $args['before_widget'] = str_replace('widget_socials', 'widget_socials widget_socials_' . esc_attr($style), $args['before_widget']);
            }


            echo html_entity_decode($args['before_widget']); ?>

            <div class="widget_contacts_inner" itemscope itemtype="http://schema.org/Organization">
                <ul class="stm-socials">
                    <?php foreach ($socials as $social) : ?>
                        <li>
                            <a href="<?php echo esc_url($social['url']) ?>" class="mtc_h">
                                <i class="<?php echo esc_attr($social['social']); ?>"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php echo html_entity_decode($args['after_widget']);
        endif;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $to_link = admin_url('admin.php?page=hotel-theme-options');
        ?>
        <div style="margin: 25px 0">
            <?php echo sprintf(__('Please add socials links in <a href="%s" target="_blank">Theme Options</a> -> Footer -> Socials', 'hotello'), $to_link); ?>
        </div>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['socials'] = hotello_get_option('footer_socials');
        return $instance;
    }

}

function hotello_register_socials_widget()
{
    register_widget('Hotel_Socials_Widget');
}

add_action('widgets_init', 'hotello_register_socials_widget');