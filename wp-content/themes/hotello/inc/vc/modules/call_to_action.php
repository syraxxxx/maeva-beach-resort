<?php

vc_map(array(
    'name' => esc_html__('Stylemix Call to action', 'hotello'),
    'base' => 'stm_cta',
    'icon' => 'hotel-call2action',
    'category' => array(
        esc_html__('Content', 'hotello'),
        esc_html__('hotel', 'hotello'),
    ),
    'description' => esc_html__('Text and button', 'hotello'),
    'params' => array(
        array(
            'type' => 'textarea_html',
            'heading' => esc_html__('Text', 'hotello'),
            'holder' => 'div',
            'param_name' => 'content'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Phone', 'hotello'),
            'param_name' => 'phone',
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Email', 'hotello'),
            'param_name' => 'email',
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__('Button link', 'hotello'),
            'param_name' => 'link',
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button color scheme', 'hotello'),
            'param_name' => 'button_color',
            'value' => array(
                esc_html__('Primary', 'hotello') => 'primary',
                esc_html__('Secondary', 'hotello') => 'secondary',
                esc_html__('White', 'hotello') => 'white',
                esc_html__('Custom', 'hotello') => 'custom',
            ),
            'std' => 'primary',
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button size', 'hotello'),
            'param_name' => 'button_size',
            'value' => array(
                esc_html__('Normal', 'hotello') => '',
                esc_html__('Small', 'hotello') => 'btn_sm',
                esc_html__('Large', 'hotello') => 'btn_lg',
            ),
            'std' => '',
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        /*Choose button custom color*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Color', 'hotello'),
            'param_name' => 'button_custom_color',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        /*Choose button custom color hover*/
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Color on hover', 'hotello'),
            'param_name' => 'button_custom_color_hover',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Border Color', 'hotello'),
            'param_name' => 'button_custom_border_color',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Border Color on hover', 'hotello'),
            'param_name' => 'button_custom_border_color_hover',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Text Color', 'hotello'),
            'param_name' => 'button_custom_text_color',
            'value' => '#ffffff',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Button Custom Text Color on hover', 'hotello'),
            'param_name' => 'button_custom_text_color_hover',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')

        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Custom Color', 'hotello'),
            'param_name' => 'icon_custom_color',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Custom Color on hover', 'hotello'),
            'param_name' => 'icon_custom_color_hover',
            'value' => '',
            'dependency' => array(
                'element' => 'button_color',
                'value' => 'custom'
            ),
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button style', 'hotello'),
            'param_name' => 'button_style',
            'value' => array(
                esc_html__('Solid', 'hotello') => 'solid',
                esc_html__('Outline', 'hotello') => 'outline'
            ),
            'std' => 'solid',
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button icon position', 'hotello'),
            'param_name' => 'button_icon_pos',
            'value' => array(
                esc_html__('None', 'hotello') => '',
                esc_html__('Left', 'hotello') => 'left',
                esc_html__('Right', 'hotello') => 'right',
            ),
            'std' => 'none',
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Button icon', 'hotello'),
            'param_name' => 'button_icon',
            'value' => '',
            'dependency' => array(
                'element' => 'button_icon_pos',
                'not_empty' => true
            ),
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Icon size', 'hotello'),
            'param_name' => 'button_icon_size',
            'value' => '20',
            'std' => '20',
            'dependency' => array(
                'element' => 'button_icon_pos',
                'not_empty' => true
            ),
            'group' => esc_html__('CTA Button', 'hotello')
        ),
        vc_map_add_css_animation(),
        hotello_vc_add_css_editor_param(),
        hotello_load_styles(1)
    )
));

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Cta extends WPBakeryShortCode
    {
    }
}