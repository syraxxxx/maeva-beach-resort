<?php


add_action('init', 'hotello_moduleVC_carousel_gallery');


function hotello_moduleVC_carousel_gallery()
{
    vc_map(array(
        'name' => esc_html__('Stylemix Carousel Gallery', 'hotello'),
        'base' => 'stm_carousel_gallery',
        'icon' => 'stmicon-film',
        'category' => array(
            esc_html__('Content', 'hotello'),
            esc_html__('hotel', 'hotello'),
        ),
        'description' => esc_html__('Animated carousel with images', 'hotello'),
        'params' => array(
            array(
                'type' => 'attach_images',
                'heading' => esc_html__('Images', 'hotello'),
                'param_name' => 'images'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Image effect', 'hotello'),
                'param_name' => 'images_effect',
                'value' => array(
                    esc_html__('None', 'hotello') => 0,
                    esc_html__('Grayscale', 'hotello') => 'grayscale',
                    esc_html__('Opacity', 'hotello') => 'opacity',
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Size', 'hotello'),
                'param_name' => 'image_size',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'hotello')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Carousel width', 'hotello'),
                'param_name' => 'carousel_width',
                'description' => esc_html__('Enter carousel width. Ex. : 500px or 70%', 'hotello')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable LightGallery', 'hotello'),
                'param_name' => 'lightgallery',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'std' => 'enable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable Border', 'hotello'),
                'param_name' => 'bordered',
                'value' => array(
                    esc_html__('Disable', 'hotello') => 'disable',
                    esc_html__('Enable', 'hotello') => 'enable',
                ),
                'std' => 'disable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable Retina', 'hotello'),
                'param_name' => 'retina',
                'value' => array(
                    esc_html__('Disable', 'hotello') => 'disable',
                    esc_html__('Enable', 'hotello') => 'enable',
                ),
                'std' => 'disable',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Visible images', 'hotello'),
                'param_name' => 'images_qty',
                'description' => esc_html__('Images to show', 'hotello'),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => '1'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Margin between images', 'hotello'),
                'param_name' => 'images_margin',
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => '0'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable Autoscroll', 'hotello'),
                'param_name' => 'autoscroll',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'enable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable Navigation', 'hotello'),
                'param_name' => 'navigation',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'enable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Navigation style', 'hotello'),
                'param_name' => 'navigation_style',
                'value' => array(
                    esc_html__('None', 'hotello') => '',
                    esc_html__('Style 1', 'hotello') => 'style_1'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => '',
                'dependency' => array(
                    'element' => 'navigation',
                    'value' => 'enable'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable thumbnails', 'hotello'),
                'param_name' => 'thumbnails',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'enable',
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Enable Full Carousel Visibility', 'hotello'),
				'param_name' => 'visibility',
				'value' => array(
					esc_html__('Enable', 'hotello') => 'enable',
					esc_html__('Disable', 'hotello') => 'disable'
				),
				'group' => esc_html__('Carousel Settings', 'hotello'),
				'std' => 'disable',
			),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Number of thumbnail in a row', 'hotello'),
                'param_name' => 'thumbnails_num',
                'description' => esc_html__('Enter number of visible thumbnails', 'hotello'),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'dependency' => array(
                    'element' => 'thumbnails',
                    'value' => 'enable'
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Size', 'hotello'),
                'param_name' => 'image_size_small',
                'description' => esc_html__('Enter image size in pixels: 200x100 (Width x Height).', 'hotello'),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'dependency' => array(
                    'element' => 'thumbnails',
                    'value' => 'enable'
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable image description', 'hotello'),
                'param_name' => 'description',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'enable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable pagination', 'hotello'),
                'param_name' => 'pagination',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'enable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Enable dots', 'hotello'),
                'param_name' => 'dots',
                'value' => array(
                    esc_html__('Enable', 'hotello') => 'enable',
                    esc_html__('Disable', 'hotello') => 'disable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'disable',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Dots position', 'hotello'),
                'param_name' => 'dots_pos',
                'value' => array(
                    esc_html__('Bottom', 'hotello') => 'bottom',
                    esc_html__('Right', 'hotello') => 'right'
                ),
                'dependency' => array(
                    'element' => 'dots',
                    'value' => 'enable'
                ),
                'group' => esc_html__('Carousel Settings', 'hotello'),
                'std' => 'bottom',
            ),
            vc_map_add_css_animation(),
            hotello_load_styles(1),
            hotello_vc_add_css_editor_param()
        )
    ));
}

if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Stm_Carousel_Gallery extends WPBakeryShortCode
    {
    }
}

