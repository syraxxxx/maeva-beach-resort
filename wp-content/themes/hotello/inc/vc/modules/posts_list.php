<?php
add_action('init', 'hotello_init_posts_list');

function hotello_init_posts_list()
{
    vc_map(array(
        'name' => esc_html__('Hotel Posts List', 'hotello'),
        'base' => 'stm_posts_list',
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
                'type' => 'textfield',
                'heading' => esc_html__('Number of posts', 'hotello'),
                'param_name' => 'num',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Order by', 'hotello'),
                'param_name' => 'orderby',
                'std' => 'date',
                'group' => esc_html__('Content options', 'hotello'),
                'value' => array(
                    esc_html__('Date', 'hotello') => 'date',
                    esc_html__('Random', 'hotello') => 'rand',
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show image', 'hotello'),
                'param_name' => 'show_image',
                'group' => esc_html__('Content options', 'hotello'),
                'value' => 'true',
            ),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__('Show excerpt', 'hotello'),
				'param_name' => 'show_excerpt',
				'group' => esc_html__('Content options', 'hotello'),
				'std' => 'true',
				'value' => 'true',
			),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Columns', 'hotello'),
                'param_name' => 'cols',
                'value' => array(
                    esc_html__('1', 'hotello') => '1',
                    esc_html__('2', 'hotello') => '2',
                    esc_html__('3', 'hotello') => '3',
                    esc_html__('4', 'hotello') => '4'
                ),
                'std' => '3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Offset', 'hotello'),
                'param_name' => 'posts_offset',
                'value' => '',
            ),

            hotello_load_styles(3),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Stm_Posts_List extends WPBakeryShortCode
        {
            public $style;
            public $img_size;
            public $posts_number;
            public $order_by;
            public $cols;
            public $offset;
            public $css;
            public $show_image;
            public $show_excerpt;


            public function enqueue()
            {
                hotello_add_element_style('posts_list', $this->style);
            }

            public function set_vars()
            {
                $atts = vc_map_get_attributes($this->getShortcode(), $this->atts);
                $this->style = $atts['style'];
                $this->img_size = $atts['img_size'] ? $atts['img_size'] : '300x200';
                $this->posts_number = $atts['num'] ? $atts['num'] : get_option('posts_per_page');
                $this->order_by = $atts['orderby'];
                $this->cols = $atts['cols'];
                $this->offset = $atts['posts_offset'] ? $atts['posts_offset'] + 1 : 0;
                $this->css = $atts['css'];
                $this->show_image = $atts['show_image'];
                $this->show_excerpt = $atts['show_excerpt'];
            }

            public function get_classes()
            {
                $classes = array('stm-posts-list stm-posts-list_' . $this->style);
                $classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($this->css, ' '));
                $classes[] = 'stm-posts-list__cols-' . $this->cols;

                return $classes;
            }

            public function get_posts()
            {
                $this->set_vars();
                $this->enqueue();
                $args = array(
                    'posts_per_page' => $this->posts_number,
                    'paged' => $this->offset,
                    'ignore_sticky_posts' => true,
                    'orderby' => $this->order_by
                );

                $posts = new WP_Query($args);

                return $posts;
            }
        }
    }
}