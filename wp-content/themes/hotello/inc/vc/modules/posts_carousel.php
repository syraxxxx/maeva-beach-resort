<?php
add_action('init', 'hotello_init_posts_carousel');

function hotello_init_posts_carousel()
{

    $pages_data = array();
    if (is_admin()) {
        $pages = get_posts();
        foreach ($pages as $page) {
            $pages_data[] = array(
                'label' => $page->post_title,
                'value' => $page->ID
            );
        }
    }

    $post_formats = array(
        esc_html__('All', 'hotello') => 'all'
    );
    $available_post_formats = get_terms(array('taxonomy' => 'post_format'));
    if (!empty($available_post_formats)) {
        foreach ($available_post_formats as $post_format) {
            $post_formats[$post_format->name] = $post_format->slug;
        }
    }


    vc_map(array(
        'name' => esc_html__('Stylemix Posts Carousel', 'hotello'),
        'base' => 'stm_posts_carousel',
        'icon' => 'stmicon-bookmark',
        'description' => esc_html__('Widget with carousel of posts', 'hotello'),
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello')
        ),
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image size', 'hotello'),
                'param_name' => 'img_size',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Title', 'hotello'),
                'param_name' => 'show_title',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Post format', 'hotello'),
                'param_name' => 'post_format',
                'value' => $post_formats,
                'std' => 'all',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select order', 'hotello'),
                'param_name' => 'order',
                'value' => array(
                    esc_html__('Last', 'hotello') => 'date',
                    esc_html__('Random', 'hotello') => 'rand',
                    esc_html__('Custom select', 'hotello') => 'custom',
                ),
                'std' => 'last',
            ),
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__('Include', 'hotello'),
                'param_name' => 'include',
                'description' => esc_html__('Type post titles to select', 'hotello'),
                'admin_label' => true,
                'settings' => array(
                    'multiple' => true,
                    'sortable' => true,
                    'min_length' => 1,
                    'no_hide' => true,
                    'unique_values' => true,
                    'display_inline' => true,
                    'values' => $pages_data
                ),
                'dependency' => array(
                    'element' => 'order',
                    'value' => 'custom'
                )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Category', 'hotello'),
                'param_name' => 'show_category',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Excerpt', 'hotello'),
                'param_name' => 'show_excerpt',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Views', 'hotello'),
                'param_name' => 'show_views',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Comments', 'hotello'),
                'param_name' => 'show_comments',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show Date', 'hotello'),
                'param_name' => 'show_date',
                'std' => 'true',
                'group' => esc_html__('Content options', 'hotello'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Colums number in Desktop', 'hotello'),
                'param_name' => 'number_row_desktop',
                'std' => 4,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Columns number in Laptop', 'hotello'),
                'param_name' => 'number_row_laptop',
                'std' => 3,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Columns number in Tablet', 'hotello'),
                'param_name' => 'number_row_tablet',
                'std' => 2,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Arrows', 'hotello'),
                'param_name' => 'arrows',
                'value' => array(
                    esc_html__('Yes', 'hotello') => 'true',
                    esc_html__('No', 'hotello') => 'false',
                ),
                'std' => 'false',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_5')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Bullets', 'hotello'),
                'param_name' => 'bullets',
                'value' => array(
                    esc_html__('Yes', 'hotello') => 'true',
                    esc_html__('No', 'hotello') => 'false',
                ),
                'std' => 'true',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Autoplay', 'hotello'),
                'param_name' => 'autoscroll',
                'value' => array(
                    esc_html__('Yes', 'hotello') => 'true',
                    esc_html__('No', 'hotello') => 'false',
                ),
                'std' => 'true',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Loop', 'hotello'),
                'param_name' => 'loop',
                'value' => array(
                    esc_html__('Yes', 'hotello') => 'true',
                    esc_html__('No', 'hotello') => 'false',
                ),
                'std' => 'true',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array('style_1')
                ),
                'group' => esc_html__('Carousel Settings', 'hotello')
            ),
            hotello_load_styles(1),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Stm_Posts_Carousel extends WPBakeryShortCode
        {
        }
    }
}