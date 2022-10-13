<?php
add_action('init', 'hotello_moduleVC_infobox');

function hotello_moduleVC_infobox()
{
    vc_map(array(
        'name' => esc_html__('Info Box', 'hotello'),
        'base' => 'stm_info_box',
        'icon' => 'stmicon-box2',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Icon and text inside the box with image', 'hotello'),
        'params' => array(
			array(
				'type'       => 'attach_image',
				'heading'    => esc_html__('Image', 'hotello'),
				'param_name' => 'image'
			),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => esc_html__('Title', 'hotello'),
                'param_name' => 'title'
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'hotello'),
                'param_name' => 'icon',
                'value' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Size', 'hotello'),
                'param_name' => 'icon_size',
                'value' => '65',
                'description' => esc_html__('Enter icon size in px', 'hotello')
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Text', 'hotello'),
                'param_name' => 'content'
            ),
            hotello_load_styles(2, 'style', true),
            hotello_vc_add_css_editor_param(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Info_Box extends WPBakeryShortCode
    {
    }
}