<?php
vc_map(array(
    'name' => esc_html__('Hotel Contacts', 'hotello'),
    'base' => 'stm_contacts_widget',
    'icon' => 'icon-wpb-wp',
    'category' => array(
        esc_html__('Content', 'hotello'),
        esc_html__('Hotel', 'hotello'),
    ),
    'description' => esc_html__('Contact info in footer area', 'hotello'),
    'params' => array(
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__('Title', 'hotello'),
            'param_name' => 'title'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Address', 'hotello'),
            'param_name' => 'address'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Phone', 'hotello'),
            'param_name' => 'phone'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Fax', 'hotello'),
            'param_name' => 'fax'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Email', 'hotello'),
            'param_name' => 'email'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Open hours', 'hotello'),
            'param_name' => 'open_hours'
        ),
        vc_map_add_css_animation(),
        hotello_vc_add_css_editor_param(),
        hotello_load_styles(2, 'style', true)
    )
));


if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Contacts_Widget extends WPBakeryShortCode
    {
    }
}