<?php
add_action('init', 'hotello_stm_sidebar_vc');

function hotello_stm_sidebar_vc()
{
    $sidebars = hotello_vc_post_type('stm_sidebars');
    vc_map(array(
        'name' => esc_html__('Hotel Sidebar', 'hotello'),
        'base' => 'stm_sidebar',
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select sidebar', 'hotello'),
                'param_name' => 'sidebar',
                'value' => $sidebars
            ),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));
}

class WPBakeryShortCode_Stm_Sidebar extends WPBakeryShortCode
{
}