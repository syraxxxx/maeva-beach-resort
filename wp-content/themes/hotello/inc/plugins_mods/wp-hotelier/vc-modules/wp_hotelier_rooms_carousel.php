<?php
add_action('init', 'hotello_stm_wp_hotelier_fooms_carousel');

function hotello_stm_wp_hotelier_fooms_carousel()
{

    vc_map(array(
        'name' => esc_html__('WP Hotelier rooms carousel', 'hotello'),
        'base' => 'stm_wp_hotelier_rooms_carousel',
        'icon' => 'stmicon-bookmark',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello')
        ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'hotello'),
                'admin_label' => true,
                'param_name' => 'title',
                'value' => 'Rooms & suits'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Enable contrast version', 'hotello'),
                'param_name' => 'contrast',
                'value' => ''
            ),
            hotello_load_styles(1),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));

    class WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_Carousel extends WPBakeryShortCode
    {
    }
}