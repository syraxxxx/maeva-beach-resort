<?php
add_action('init', 'hotello_wp_hotelier_rooms_list');


function hotello_wp_hotelier_rooms_list()
{

	$room_terms = get_terms('room_cat');
	$room_types = array();
	foreach ($room_terms as $room_term) {
		$room_types[] = array(
			'label' => $room_term->name,
			'value' => $room_term->term_id
		);
	}
	vc_map(
		array(
			'name'     => esc_html__('Wp Hotelier rooms list', 'hotello'),
			'base'     => 'stm_wp_hotelier_rooms_list',
			'icon'     => 'icon-wpb-wp',
			'category' => array(
				esc_html__('Content', 'hotello'),
				esc_html__('hotel', 'hotello')
			),
			'params'   => array(
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__('Select rooms types', 'hotello'),
					'param_name'  => 'rooms_types',
					'admin_label' => true,
					'settings'    => array(
						'multiple'       => true,
						'sortable'       => true,
						'min_length'     => 1,
						'no_hide'        => true,
						'unique_values'  => true,
						'display_inline' => true,
						'values'         => $room_types
					)
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Posts per page', 'hotello'),
					'param_name' => 'per_page',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__('Custom class', 'hotello'),
					'param_name' => 'custom_class',
				),
				hotello_load_styles(2),
				hotello_vc_add_css_editor_param(),
				vc_map_add_css_animation(),
			)
		)
	);

	class WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_List extends WPBakeryShortCode
	{

		protected $predefined_atts = array(
			'style' => 'style_1'
		);

		public function __construct($settings)
		{
			parent::__construct($settings);
			$this->enqueue();
			add_action('wp_ajax_get_rooms', array($this, 'ajax'));
			add_action('wp_ajax_nopriv_get_rooms', array($this, 'ajax'));
		}

		public function enqueue()
		{
			wp_enqueue_script('hotel_wp_hotelier_rooms_list/load_more');
		}

		public function get_rooms($set_args = array())
		{
			$types = $this->get_rooms_types();
			$args = array(
				'post_type' => 'room'
			);

			if (!empty($_GET['room_type']) or !empty($set_args['room_type'])) {
				$selected_type = (!empty($_GET['room_type'])) ? sanitize_text_field($_GET['room_type']) : $set_args['room_type'];
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'room_cat',
						'field'    => 'slug',
						'terms'    => $selected_type
					)
				);
			} else {
				if (!empty($types)) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'room_cat',
							'field'    => 'slug',
							'terms'    => $types[0]['slug']
						)
					);
				}
			}

			$args = wp_parse_args($set_args, $args);

			$q = new WP_Query($args);

			return $q;
		}

		public function single_room()
		{

            if (array_key_exists( 'seasonal_price', get_option('stm_theme_options') )) {
                $seasonal_price_option = get_option('stm_theme_options')['seasonal_price'];
            } else {
                $seasonal_price_option = false;
            }

            global $room;

            $checkin = HTL()->session->get('checkin');
            $checkout = HTL()->session->get('checkout');

			$id = get_the_ID();
			$room = new Hotel_Room($id);

            if ($seasonal_price_option === 'true') {
                $price = $room->get_min_price($checkin, $checkout);
            } else {
                $price = $room->get_final_price($checkin, $checkout);
            }
            $price = htl_price($price);

			if ($room->is_variable_room()) {
				$price = '<span>' . esc_html__('From', 'hotello') . '</span> ' . $price;
			}
			?>
            <div class="room">
                <div class="inner">
                    <div class="room__image">
                        <a href="<?php the_permalink(); ?>">
							<?php echo hotello_get_VC_post_img_safe($id, '370x210'); ?>
                            <div class="room__price mbc heading_font">
                                <?php
                                    if ($seasonal_price_option === 'true') {
                                        $night = esc_html__('/Night', 'hotello');
                                    } else {
                                        $night = '';
                                    }
                                    echo sprintf('<span>%s</span>' . $night, $price);
								?>
                            </div>
                        </a>
                    </div>

                    <div class="room__content">
                        <div class="room__title">
                            <h3>
                                <a class="ttc no_deco mtc_h" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
                                </a>
                            </h3>
                        </div>
                        <div class="room__excerpt">
							<?php echo hotello_truncate_text(get_the_excerpt(), 80); ?>
                        </div>

						<?php htl_get_template_part('single-room/room-icon-info'); ?>

                    </div>
                </div>
            </div>
			<?php
		}

		public function set_vars($atts)
		{
			$this->atts = vc_map_get_attributes($this->getShortcode(), $atts);

			hotello_add_element_style(str_replace('stm_', '', $this->getFileName()), $this->atts['style']);
		}

		public function get_module_classes()
		{
			$style = $css = $css_animation = '';
			extract($this->atts);

			$classes = array('stm_wp_hotelier_rooms_list');
			$classes[] = 'stm_wp_hotelier_rooms_list_' . $style;
			if (!empty($custom_class)) {
				$classes[] = $custom_class;
			}

			return implode(' ', $classes);
		}

		public function get_rooms_types()
		{
			$rooms_types = $this->atts['rooms_types'];
			if (empty($rooms_types)) {
				$rooms_types = array_map(function ($term) {
					return array(
						'label' => $term->name,
						'id'    => $term->term_id
					);
				}, get_terms('room_cat'));
			}
			if (is_string($rooms_types)) {
				$rooms_types = explode(', ', $rooms_types);
			}

			$rooms_types = array_map(function ($type_id) {
				if (is_array($type_id)) {
					$term = get_term($type_id['id']);
				} else {
					$term = get_term($type_id);
				}

				return array(
					'name' => $term->name,
					'slug' => $term->slug
				);
			}, $rooms_types);


			if (!empty(array_filter($rooms_types))) {
				return $rooms_types;
			}

			return false;
		}

		public function rooms_types_filter()
		{
			global $post;
			$url = get_the_permalink($post->ID);
			$types = $this->get_rooms_types();
			$current_room_type = $this->get_current_room_type();
			if (!empty($types) && !is_wp_error($types)) : ?>
                <ul class="list-unstyled">
					<?php foreach ($types as $type) :
						$url = add_query_arg('room_type', $type['slug'], $url);
						?>
                        <li<?php echo wp_kses_post($current_room_type === $type['slug'] ? ' class="active"' :
							'') ?> data-type="<?php echo esc_attr($type['slug']); ?>">
                            <a href="<?php echo esc_url($url) ?>" class="mbdc sbc_a">
								<?php echo wp_kses_post($type['name']) ?>
                            </a>
                        </li>
					<?php
					endforeach; ?>
                </ul>
			<?php endif;
		}


		public function load_more_button($rooms_query)
		{
			/**
			 * @var $rooms_query WP_Query
			 */

			if ($rooms_query->max_num_pages > 1) {
				?>
                <button class="stm-load-more btn btn_outline btn_primary">
					<?php esc_html_e('Show more rooms', 'hotello'); ?>
                </button>
				<?php
			}

		}

		public function get_current_room_type()
		{
			$room_types = $this->get_rooms_types();
			$current = !empty($room_types) ? $room_types[0]['slug'] : false;
			if (!empty($_GET['room_type'])) {
				$current = $_GET['room_type'];
			}

			return $current;
		}

		public function module_data_attributes($rooms_query)
		{
			$room_type = $this->get_current_room_type();
			$max_pages = $rooms_query->max_num_pages;
			$per_page = $this->atts['per_page'];

			return "data-room-type='${room_type}' data-max-pages='${max_pages}' data-per-page='${per_page}'";
		}
	}
}

