<?php
add_action('init', 'hotello_wp_hotelier_widget_booking');
function hotello_wp_hotelier_widget_booking()
{
    vc_map(array(
        'name' => esc_html__('Hotel Booking Widget', 'hotello'),
        'base' => 'stm_wp_hotelier_widget_booking',
        'icon' => 'icon-wpb-wp',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('Hotel', 'hotello'),
        ),
        'description' => esc_html__('Booking info', 'hotello'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'hotello'),
                'param_name' => 'title'
            ),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
            hotello_load_styles(1)
        )
    ));
}


if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Wp_Hotelier_Widget_Booking extends WPBakeryShortCode
    {
    }
}