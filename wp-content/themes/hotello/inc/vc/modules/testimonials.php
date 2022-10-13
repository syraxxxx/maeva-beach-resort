<?php

add_action('init', 'hotello_testimonials_VC');

function hotello_testimonials_VC()
{
    vc_map(array(
        'name' => esc_html__('Testimonials', 'hotello'),
        'base' => 'stm_testimonials',
        'description' => esc_html__('Reviews from customers', 'hotello'),
        'icon' => 'hotel-testimonials',
        'category' => esc_html__('Carousels', 'hotello'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'hotello'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number', 'hotello'),
                'param_name' => 'number'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Carousel', 'hotello'),
                'param_name' => 'carousel',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'true',
                    esc_html__('Disable', 'hotello') => 'false',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show number in row', 'hotello'),
                'param_name' => 'number_row',
                'std' => 1,
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show number in row', 'hotello'),
                'param_name' => 'list_number_row',
                'value' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '6' => 6,
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'false'
                ),
                'std' => 'false',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Image', 'hotello'),
                'param_name' => 'show_image',
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Autoscroll', 'hotello'),
                'param_name' => 'autoscroll',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'true',
                    esc_html__('Disable', 'hotello') => 'false',
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'std' => 'false',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Show review text symbols', 'hotello'),
                'param_name' => 'crop',
                'std' => '',
                'description' => esc_html__('You can set number of symbols to crop review text', 'hotello'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Margins', 'hotello'),
                'param_name' => 'margin',
                'std' => '30',
                'description' => esc_html__('Set margins between slides', 'hotello'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable center mode', 'hotello'),
                'param_name' => 'center_mode',
                'value' => array(
                    esc_html__('Enabled', 'hotello') => 'true',
                    esc_html__('Disabled', 'hotello') => 'false',
                ),
                'std' => 'false',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show bullets', 'hotello'),
                'param_name' => 'bullets',
                'value' => array(
                    esc_html__('Show', 'hotello') => 'true',
                    esc_html__('Hide', 'hotello') => 'false',
                ),
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'std' => 'true',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show arows', 'hotello'),
                'param_name' => 'arrows',
                'dependency' => array(
                    'element' => 'carousel',
                    'value' => 'true'
                ),
                'value' => array(
                    esc_html__('Show', 'hotello') => 'true',
                    esc_html__('Hide', 'hotello') => 'false',
                ),
                'std' => 'false',
            ),

            array(
                'type' => 'textfield',
                'heading' => esc_html__('Avatar size', 'hotello'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'hotello'),
                'param_name' => 'img_size',
                'value' => '100x100'
            ),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
            hotello_load_styles(4, 'style', true)
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Testimonials extends WPBakeryShortCode
    {
    }
}