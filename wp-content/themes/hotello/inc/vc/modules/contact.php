<?php
add_action('init', 'hotello_moduleVC_contact');

function hotello_moduleVC_contact()
{
    vc_map(array(
        'name'   => esc_html__('Hotello Contact', 'hotello'),
        'base'   => 'stm_contact',
        'icon'   => 'hotello-contact',
		'category' => array(
			esc_html__('Content', 'hotello'),
			esc_html__('hotello', 'hotello'),
		),
		'description' => esc_html__('Custom contact block', 'hotello'),
		'params' => array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Name', 'hotello'),
                'param_name' => 'name'
            ),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Image', 'hotello'),
                'param_name' => 'image'
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Size', 'hotello'),
                'param_name'  => 'image_size',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'hotello')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Job', 'hotello'),
                'param_name' => 'job'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Phone', 'hotello'),
                'param_name' => 'phone'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Email', 'hotello'),
                'param_name' => 'email'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Skype', 'hotello'),
                'param_name' => 'skype'
            ),
            hotello_load_styles(1, 'style', true),
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Contact extends WPBakeryShortCode
    {
    }
}
