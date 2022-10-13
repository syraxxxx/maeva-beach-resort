<?php
add_action('init', 'hotello_moduleVC_google_map');

function hotello_moduleVC_google_map()
{
    /*Stm google maps*/
    vc_map(array(
        'name' => esc_html__('Hotel Google maps', 'hotello'),
        'base' => 'stm_google_map',
        'as_parent' => array('only' => 'stm_google_map_address'),
        'is_container' => true,
        'content_element' => true,
        'icon' => 'hotel-google-maps',
        'js_view' => 'VcColumnView',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Office location with pin on map', 'hotello'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Map Height', 'hotello'),
                'param_name' => 'map_height',
                'value' => '688px',
                'description' => esc_html__('Enter map height in px', 'hotello')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Map Zoom', 'hotello'),
                'param_name' => 'map_zoom',
                'value' => 18
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Marker Image', 'hotello'),
                'param_name' => 'marker'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Marker size', 'hotello'),
                'param_name' => 'img_size',
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'hotello'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Disable carousel', 'hotello'),
                'param_name' => 'disable_carousel',
                'value' => array(
                    esc_html__('Disable carousel', 'hotello') => 'disable',
                    esc_html__('Enable carousel', 'hotello') => 'enable',
                ),
                'std' => 'enable'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Visible items', 'hotello'),
                'param_name' => 'images_qty',
                'dependency' => array(
                    'element' => 'disable_carousel',
                    'value' => 'enable'
                ),
                'std' => '3'
            ),
            array(
                'type' => 'checkbox',
                'param_name' => 'disable_mouse_whell',
                'value' => array(
                    esc_html__('Disable map zoom on mouse wheel scroll', 'hotello') => 'disable'
                )
            ),
            array(
                'type' => 'textarea_raw_html',
                'heading' => esc_html__('Map style', 'hotello'),
                'param_name' => 'map_custom_style',
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra class name', 'hotello'),
                'param_name' => 'el_class',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'hotello')
            ),
            hotello_load_styles(1),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param(),
        )
    ));


    vc_map(array(
        'name' => esc_html__('Address', 'hotello'),
        'base' => 'stm_google_map_address',
        'icon' => 'stmicon_map',
        'content_element' => true,
        'as_child' => array('only' => 'stm_google_map'),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'hotello'),
                'admin_label' => true,
                'param_name' => 'title'
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Address', 'hotello'),
                'param_name' => 'address'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Phone', 'hotello'),
                'param_name' => 'phone'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Email', 'hotello'),
                'param_name' => 'email'
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Open Hours', 'hotello'),
                'param_name' => 'open_hours'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Latitude', 'hotello'),
                'param_name' => 'lat',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Longitude', 'hotello'),
                'param_name' => 'lng',
            ),
        )
    ));
}

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Stm_Google_Map extends WPBakeryShortCodesContainer
    {
    }
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Google_Map_Address extends WPBakeryShortCode
    {
    }
}