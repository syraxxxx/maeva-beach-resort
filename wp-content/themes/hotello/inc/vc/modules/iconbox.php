<?php
add_action('init', 'hotello_moduleVC_iconbox');

function hotello_moduleVC_iconbox()
{
    vc_map(array(
        'name' => esc_html__('Icon Box', 'hotello'),
        'base' => 'stm_icon_box',
        'icon' => 'stmicon-box2',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Icon and text inside the box', 'hotello'),
        'params' => array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                'heading' => esc_html__('Title', 'hotello'),
                'param_name' => 'title'
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Title tag', 'hotello'),
				'param_name' => 'title_tag',
				'value' => array(
					esc_html__('H1', 'hotello') => 'H1',
					esc_html__('H2', 'hotello') => 'H2',
					esc_html__('H3', 'hotello') => 'H3',
					esc_html__('H4', 'hotello') => 'H4',
					esc_html__('H5', 'hotello') => 'H5',
					esc_html__('H6', 'hotello') => 'H6',
				),
				'std' => 'H5',
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title font size', 'hotello'),
                'param_name' => 'title_fsz'
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Custom Color', 'hotello'),
                'param_name' => 'title_custom_color',
                'value' => '',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Enable heading divider', 'hotello'),
                'param_name' => 'h_divider'
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'hotello'),
                'param_name' => 'icon',
                'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Content align', 'hotello'),
                'param_name' => 'content_pos',
                'value' => array(
                    esc_html__('Left', 'hotello') => 'left',
                    esc_html__('Center', 'hotello') => 'center',
                    esc_html__('Right', 'hotello') => 'right',
                ),
                'std' => 'left'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon position', 'hotello'),
                'param_name' => 'icon_pos',
                'value' => array(
                    esc_html__('Left', 'hotello') => 'left',
                    esc_html__('Center', 'hotello') => 'center',
                    esc_html__('Right', 'hotello') => 'right',
                ),
                'std' => 'left',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Color', 'hotello'),
                'param_name' => 'icon_class',
                'value' => array(
                    esc_html__('Main color', 'hotello') => 'mtc',
                    esc_html__('Secondary color', 'hotello') => 'stc',
                    esc_html__('Third color', 'hotello') => 'ttc',
                    esc_html__('Custom', 'hotello') => 'custom'
                ),
                'description' => esc_html__('Select icon color', 'hotello')
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Custom Color', 'hotello'),
                'param_name' => 'icon_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'icon_class',
                    'value' => 'custom'
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Size', 'hotello'),
                'param_name' => 'icon_size',
                'value' => '65',
                'description' => esc_html__('Enter icon size in px', 'hotello')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Height', 'hotello'),
                'param_name' => 'icon_height',
                'value' => '65',
                'description' => esc_html__('Enter icon height in px', 'hotello'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Width', 'hotello'),
                'param_name' => 'icon_width',
                'value' => '50',
                'description' => esc_html__('Enter icon width in px', 'hotello'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Weight', 'hotello'),
                'param_name' => 'icon_weight',
                'value' => array(
                    esc_html__('Normal', 'hotello') => 'normal',
                    esc_html__('Bold', 'hotello') => 'bold',
                ),
                'std' => 'normal',
            ),
            array(
                'type' => 'textarea_html',
                'heading' => esc_html__('Text', 'hotello'),
                'param_name' => 'content'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Link IconBox', 'hotello'),
                'param_name' => 'box_link',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable',
                ),
                'std' => 'disable',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__('Link url', 'hotello'),
                'param_name' => 'box_link_url',
                'value' => '',
                'description' => esc_html__('Enter url for box', 'hotello'),
                'dependency' => array(
                    'element' => 'box_link',
                    'value' => 'enable'
                )
            ),
            hotello_load_styles(1, 'style', true),
			hotello_vc_add_css_editor_param('iconbox_css', array(
				'heading' => 'Icon CSS',
				'group' => esc_html__('Icon Design options', 'hotello')
			)),
            hotello_vc_add_css_editor_param(),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Icon_Box extends WPBakeryShortCode
    {
    }
}