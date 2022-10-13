<?php

vc_map(array(
    'name' => esc_html__('Stylemix Icon', 'hotello'),
    'description' => esc_html__('Shows single icon', 'hotello'),
    'base' => 'stm_icon',
    'icon' => 'hotel-hotel_icon',
    'category' => array(
        esc_html__('Content', 'hotello'),
        esc_html__('hotel', 'hotello'),
    ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon link', 'hotello'),
            'param_name' => 'link',
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'hotello'),
            'param_name' => 'icon',
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon color', 'hotello'),
            'param_name' => 'icon_color',
            'value' => hotello_vc_colors_param(),
            'std' => 'mtc',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Enable icon gradient', 'hotello'),
            'param_name' => 'icon_gradient',
            'value' => array(
                esc_html__('Enable', 'hotello') => 'enable',
                esc_html__('Disable', 'hotello') => 'disable'
            ),
            'dependency' => array(
                'element' => 'icon_color',
                'value' => array('custom')
            ),
            'std' => 'disable',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon gradient first color', 'hotello'),
            'param_name' => 'icon_gradient_first_color',
            'dependency' => array(
                'element' => 'icon_gradient',
                'value' => array('enable')
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon gradient second color', 'hotello'),
            'param_name' => 'icon_gradient_second_color',
            'dependency' => array(
                'element' => 'icon_gradient',
                'value' => array('enable')
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon custom color', 'hotello'),
            'param_name' => 'icon_custom_color',
            'dependency' => array(
                'element' => 'icon_gradient',
                'value' => array('disable')
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon color on hover', 'hotello'),
            'param_name' => 'icon_custom_color_hover',
            'dependency' => array(
                'element' => 'icon_gradient',
                'value' => array('disable')
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon align', 'hotello'),
            'param_name' => 'icon_align',
            'value' => hotello_vc_align_param(),
            'std' => 'left',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon size(px)', 'hotello'),
            'param_name' => 'height',
            'std' => '40'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Enable styled background', 'hotello'),
            'param_name' => 'icon_styled_bg',
            'value' => array(
                esc_html__('Disable', 'hotello') => 'disable',
                esc_html__('Rounded shadow', 'hotello') => 'enable',
                esc_html__('Icon Round Background', 'hotello') => 'icon_round_bg',
            ),
            'std' => 'disable',
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Background color', 'hotello'),
            'param_name' => 'icon_round_bg',
            'dependency' => array(
                'element' => 'icon_styled_bg',
                'value' => array('icon_round_bg')
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Rounded background size(px)', 'hotello'),
            'param_name' => 'circle_height',
            'std' => '100',
            'dependency' => array(
                'element' => 'icon_styled_bg',
                'value' => 'icon_round_bg'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon background border width(px)', 'hotello'),
            'param_name' => 'circle_border_width',
            'std' => '0',
            'dependency' => array(
                'element' => 'icon_styled_bg',
                'value' => 'icon_round_bg'
            )
        ),
        vc_map_add_css_animation(),
        hotello_vc_add_css_editor_param(),
    )
));

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Icon extends WPBakeryShortCode
    {
    }
}