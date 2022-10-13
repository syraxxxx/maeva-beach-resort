<?php

add_action('init', 'hotello_wp_hotelier_rooms_filter');

function hotello_wp_hotelier_rooms_filter()
{
    vc_map(
        array(
            'name' => esc_html__('Stylemix Wp Hotelier rooms filter', 'hotello'),
            'base' => 'stm_wp_hotelier_rooms_filter',
            'icon' => 'icon-wpb-wp',
            'category' => esc_html__('Stylemix Widgets', 'hotello'),
            'description' => esc_html__('Wp Hotelier rooms filter widget wrapper', 'hotello'),
            'category' => array(
                esc_html__('Content', 'hotello'),
                esc_html__('hotel', 'hotello')
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'hotello'),
                    'admin_label' => true,
                    'param_name' => 'title',
                    'value' => 'Refine results'
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Max guests', 'hotello'),
                    'admin_label' => false,
                    'param_name' => 'guests',
                    'value' => 5
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Max children', 'hotello'),
                    'admin_label' => false,
                    'param_name' => 'children',
                    'value' => 5
                ),
                hotello_load_styles(1),
                hotello_vc_add_css_editor_param()
            )
        )
    );
}


class WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_Filter extends WPBakeryShortCode
{
}
