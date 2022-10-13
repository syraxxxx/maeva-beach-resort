<?php
vc_map(array(
    'name' => esc_html__('Spacer', 'hotello'),
    'description' => esc_html__('Empty block for paddings', 'hotello'),
    'base' => 'stm_spacer',
    'icon' => 'icon-wpb-ui-empty_space',
    'category' => esc_html__('Content', 'hotello'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Default Spacer height', 'hotello'),
            'param_name' => 'height',
            'admin_label' => true,
        ),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Laptop Spacer height', 'hotello'),
			'param_name' => 'height_laptop'
		),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Tablet Spacer height', 'hotello'),
            'param_name' => 'height_tablet'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Mobile Spacer height', 'hotello'),
            'param_name' => 'height_mobile'
        ),
        hotello_vc_add_css_editor_param()
    )
));

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Spacer extends WPBakeryShortCode
    {
    }
}