<?php
add_action('init', 'hotello_stm_wp_hotelier_selective_rooms_carousel');

function hotello_stm_wp_hotelier_selective_rooms_carousel()
{

    $rooms = array();
    if (is_admin()) {
        $args = array(
            'post_type' => 'room',
            'posts_per_page' => -1
        );
        $query = get_posts($args);
        if (!empty($query)) {
            foreach ($query as $room_post) {
                $rooms[] = array(
                    'label' => $room_post->post_title,
                    'value' => $room_post->ID
                );
            }
        }
    }


    vc_map(array(
        'name' => esc_html__('WP Hotelier rooms carousel', 'hotello'),
        'base' => 'stm_wp_hotelier_selective_rooms_carousel',
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
                'type' => 'dropdown',
                'heading' => esc_html__('Items per row', 'hotello'),
                'param_name' => 'per_row',
                'value' => array(
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '6' => 6,
                ),
                'std' => '4'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image size', 'hotello'),
                'description' => esc_html__('Enter image size. Example 100x100, will crop image with 100px width and 100px height', 'hotello'),
                'param_name' => 'img_size',
                'value' => '350x250',
                'std' => '350x250'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items per row on Tablet', 'hotello'),
                'param_name' => 'per_row_sm',
                'value' => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '6' => 6,
                ),
                'std' => '2'
            ),
            array(
                'type' => 'autocomplete',
                'heading' => esc_html__('Select rooms', 'hotello'),
                'param_name' => 'rooms_ids',
                'description' => esc_html__('Type rooms titles to select', 'hotello'),
                'admin_label' => true,
                'settings' => array(
                    'multiple' => true,
                    'sortable' => true,
                    'min_length' => 1,
                    'no_hide' => true,
                    'unique_values' => true,
                    'display_inline' => true,
                    'values' => $rooms
                ),
                'dependency' => array(
                    'element' => 'order',
                    'value' => 'custom'
                )
            ),
            hotello_load_styles(1),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));

    class WPBakeryShortCode_Stm_Wp_Hotelier_Selective_Rooms_Carousel extends WPBakeryShortCode
    {

        public $atts;
        public $style;
        public $rooms_ids;
        public $css;


        public function __construct($settings)
        {
            parent::__construct($settings);
        }

        protected function enqueue()
        {
//            wp_enqueue_script('hotel_wp_hotelier_rooms_list/load_more');
//            wp_enqueue_style();
            wp_enqueue_script('hotello-owl-carousel');
            wp_enqueue_style('hotello-owl-carousel');
            wp_enqueue_script('hotel_wp_hotelier_selective_rooms_carousel/carousel');
            hotello_add_element_style('wp_hotelier_selective_rooms_carousel', $this->style);
        }

        protected function set_vars()
        {
            $atts = vc_map_get_attributes($this->getShortcode(), $this->atts);
            $this->style = $atts['style'];
            $this->rooms_ids = $atts['rooms_ids'];
            $this->css = $atts['css'];
        }

        public function get_classes()
        {
            $classes = array('stm_selective_rooms_carousel stm_selective_rooms_carousel_' . $this->style);
            $classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($this->css, ' '));;

            return $classes;
        }

        public function get_occupancy_html($room_id)
        {
            $room = new Hotel_Room($room_id);
            $max_guests = $room->get_max_guests();
            $max_children = $room->get_max_children();
            $output = sprintf(__('%1s adult(s)', 'hotello'), $max_guests);
            if (!empty($max_children)) {
                $output .= ' ' . __('and', 'hotello') . ' ' . sprintf(__('%1s child(ren)', 'hotello'), $max_children);
            }

            return '<span>' . $output . '</span>';
        }

		public function get_rooms()
		{
			$this->set_vars();
			$this->enqueue();

			$args = array(
				'post_type' => 'room',
			);

			if (!empty($this->rooms_ids)) {
			    $args['post__in'] = explode(',', $this->rooms_ids);
			    $args['posts_per_page'] = count(explode(',', $this->rooms_ids));
            }


			$rooms = new WP_Query($args);
			return $rooms;
		}

        public function get_room_link_with_price($room_id)
        {
            $room = new Hotel_Room($room_id);
            $price = $room->get_min_price();
            if ($room->is_variable_room()) {
                $output = sprintf(esc_html__('Book now from %s', 'hotello'), htl_price($price));
            } else {
                $output = sprintf(esc_html__('Book now %s', 'hotello'), htl_price($price));
            }

            if ($output) {
                $output = '<a class="btn btn_primary btn_outline" href="' . get_the_permalink($room_id) . '" title="' . esc_attr(get_the_title($room_id)) . '">' . $output . '</a>';
            }

            return $output;
        }
    }
}