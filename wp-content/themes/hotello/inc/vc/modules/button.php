<?php
add_action('init', 'hotello_moduleVC_button');

function hotello_moduleVC_button()
{
    vc_map(array(
        'name' => esc_html__('Stylemix Action Button', 'hotello'),
        'base' => 'stm_button',
        'icon' => 'stmicon-plus',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Button with custom styles', 'hotello'),
        'params' => array(
            /*Button Link and Label*/
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Button link', 'hotello'),
                'param_name' => 'link',
            ),
            /*Button Style*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button style', 'hotello'),
                'param_name' => 'button_style',
                'value' => array(
                    esc_html__('Solid', 'hotello') => 'solid',
                    esc_html__('Outline', 'hotello') => 'outline'
                ),
                'std' => 'solid',
            ),
            /*Button size*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button size', 'hotello'),
                'param_name' => 'button_size',
                'value' => array(
                    esc_html__('Default', 'hotello') => '',
                    esc_html__('Large', 'hotello') => 'lg',
                    esc_html__('Small', 'hotello') => 'sm',
                ),
                'std' => '',
            ),
            /*Button position in container*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button Position', 'hotello'),
                'param_name' => 'button_pos',
                'value' => array(
                    esc_html__('Left', 'hotello') => 'left',
                    esc_html__('Right', 'hotello') => 'right',
                    esc_html__('Center', 'hotello') => 'center',
                    esc_html__('Fullwidth', 'hotello') => 'fullwidth'
                ),
                'std' => '_left',
            ),
            /*Enable icon*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button icon position', 'hotello'),
                'param_name' => 'button_icon_pos',
                'value' => array(
                    esc_html__('None', 'hotello') => '',
                    esc_html__('Left', 'hotello') => 'left',
                    esc_html__('Right', 'hotello') => 'right',
                ),
                'std' => '',
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Choose icon*/
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Button icon', 'hotello'),
                'param_name' => 'button_icon',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Choose icon color*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon color', 'hotello'),
                'param_name' => 'button_icon_class',
                'value' => array(
                    esc_html__('Default', 'hotello') => 'wtc',
                    esc_html__('Custom', 'hotello') => 'custom'
                ),
                'description' => esc_html__('Select icon color', 'hotello'),
                'std' => 'wtc',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Choose icon custom color*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Custom Color', 'hotello'),
                'param_name' => 'button_icon_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_class',
                    'value' => 'custom'
                ),
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Choose icon custom color hover*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Custom Color on hover', 'hotello'),
                'param_name' => 'button_icon_color_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_class',
                    'value' => 'custom'
                ),
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Choose icon bg*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button icon background', 'hotello'),
                'param_name' => 'button_icon_bg',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'hotello'),
            ),
            /*Choose icon bg hover*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button icon background on hover', 'hotello'),
                'param_name' => 'button_icon_bg_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'group' => esc_html__('Icon', 'hotello'),
            ),
            /*Choose icon size*/
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button icon size', 'hotello'),
                'param_name' => 'button_icon_size',
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'std' => 20,
                'group' => esc_html__('Icon', 'hotello')
            ),
            /*Subtitle*/
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'hotello'),
                'param_name' => 'subtitle',
                'description' => esc_html__('Button subtitle', 'hotello'),
                'group' => esc_html__('Advanced', 'hotello'),
            ),
            /*Divider*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Divider', 'hotello'),
                'param_name' => 'button_divider',
                'value' => array(
                    esc_html__('Disable', 'hotello') => '',
                    esc_html__('Enable', 'hotello') => 'divider'
                ),
                'dependency' => array(
                    'element' => 'button_icon_pos',
                    'not_empty' => true
                ),
                'std' => '',
                'group' => esc_html__('Advanced', 'hotello'),
            ),
            /*Custom Class*/
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom class', 'hotello'),
                'param_name' => 'c_class',
                'group' => esc_html__('Advanced', 'hotello'),
            ),


            /*Custom colors*/
            /*Button color scheme*/
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Button color scheme', 'hotello'),
                'param_name' => 'button_color_scheme',
                'value' => array(
                    esc_html__('Default', 'hotello') => 'default',
                    esc_html__('With gradient', 'hotello') => 'gradient',
                ),
                'std' => 'default',
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'button_color',
                'value' => array(
                    esc_html__('Primary', 'hotello') => 'primary',
                    esc_html__('Secondary', 'hotello') => 'secondary',
                    esc_html__('Third', 'hotello') => 'third',
                    esc_html__('White', 'hotello') => 'white',
                    esc_html__('Custom', 'hotello') => 'custom',
                ),
                'std' => 'primary',
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button border color', 'hotello'),
                'param_name' => 'button_border_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'default'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button border color on hover', 'hotello'),
                'param_name' => 'button_border_color_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'default'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button background color', 'hotello'),
                'param_name' => 'button_bg_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'default'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button background color on hover', 'hotello'),
                'param_name' => 'button_bg_color_hover',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'default'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            /*Button color with gradient*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button border first color', 'hotello'),
                'param_name' => 'button_border_color_gradient_first',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'gradient'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button border second color', 'hotello'),
                'param_name' => 'button_border_color_gradient_second',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'gradient'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button background first color', 'hotello'),
                'param_name' => 'button_background_color_gradient_first',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'gradient'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button background second color', 'hotello'),
                'param_name' => 'button_background_color_gradient_second',
                'value' => '',
                'dependency' => array(
                    'element' => 'button_color_scheme',
                    'value' => 'gradient'
                ),
                'group' => esc_html__('Colors', 'hotello'),
            ),
            /*Button color with gradient end*/
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button text color', 'hotello'),
                'param_name' => 'button_text_color',
                'value' => '',
                'group' => esc_html__('Colors', 'hotello'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Button text color on hover', 'hotello'),
                'param_name' => 'button_text_color_hover',
                'value' => '',
                'group' => esc_html__('Colors', 'hotello'),
            ),
            /*Colors*/
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Button extends WPBakeryShortCode
    {
    }
}