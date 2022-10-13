<?php

vc_map(array(
    'name' => esc_html__('Separator', 'hotello'),
    'description' => esc_html__('Divider line', 'hotello'),
    'category' => array(
        esc_html__('Content', 'hotello'),
        esc_html__('hotel', 'hotello')
    ),
    'base' => 'stm_separator',
    'icon' => 'hotel-hotel_separator',
    'category' => esc_html__('Content', 'hotello'),
    'params' => array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Color', 'hotello'),
            'param_name' => 'color',
            'value' => hotello_vc_bg_colors_param(),
            'std' => 'mbc',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Custom color', 'hotello'),
            'param_name' => 'custom_color',
            'dependency' => array(
                'element' => 'color',
                'value' => array('custom')
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator width', 'hotello'),
            'admin_label' => false,
            'param_name' => 'sep_width',
            'dependency' => array(
                'element' => 'style',
                'value' => array_map(function ($item) {
                    return 'style_' . $item;
                }, range(1, 4))
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator height', 'hotello'),
            'admin_label' => false,
            'param_name' => 'sep_height',
            'dependency' => array(
                'element' => 'style',
                'value' => array_map(function ($item) {
                    return 'style_' . $item;
                }, range(1, 4))
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align', 'hotello'),
            'param_name' => 'align',
            'value' => hotello_vc_align_param(),
            'std' => 'left',
            'dependency' => array(
                'element' => 'style',
                'value' => array('style_1', 'style_5')
            )
        ),
        hotello_load_styles(5),
        hotello_vc_add_css_editor_param()
    )
));


if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Separator extends WPBakeryShortCode
    {
    }
}