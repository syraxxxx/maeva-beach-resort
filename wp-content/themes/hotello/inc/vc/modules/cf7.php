<?php

add_action('init', 'hotello_cf7_VC');


function hotello_cf7_VC()
{

    $cf7_forms_ids = hotello_vc_post_type('wpcf7_contact_form');

    vc_map(array(
        'name' => esc_html__('Hotel Contact form 7', 'hotello'),
        'base' => 'stm_contact_form_7',
        'icon' => 'stmicon-bookmark',
        'description' => esc_html__('All contact forms', 'hotello'),
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('Hotel', 'hotello'),
        ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select form', 'hotello'),
                'param_name' => 'form',
                'value' => $cf7_forms_ids
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Form id', 'hotello'),
                'param_name' => 'form_id',
                'value' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Form class', 'hotello'),
                'param_name' => 'form_custom_class',
                'value' => ''
            ),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
            hotello_load_styles(3)
        )
    ));
}


if (class_exists('WPBakeryShortCode') && class_exists('WPCF7')) {
    class WPBakeryShortCode_Stm_Contact_Form_7 extends WPBakeryShortCode
    {
    }
}