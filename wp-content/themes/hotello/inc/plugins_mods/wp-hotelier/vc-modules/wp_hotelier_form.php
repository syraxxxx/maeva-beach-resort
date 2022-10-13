<?php
add_action('init', 'hotello_stm_wp_hotelier_form');

function hotello_stm_wp_hotelier_form()
{

    vc_map(array(
        'name' => esc_html__('WP Hotelier Form', 'hotello'),
        'base' => 'stm_wp_hotelier_form',
        'icon' => 'stmicon-bookmark',
        'description' => esc_html__('Rooms search form', 'hotello'),
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
                'value' => 'Reserve your stay'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Max guests', 'hotello'),
                'admin_label' => false,
                'param_name' => 'guests',
                'value' => 5
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Max children', 'hotello'),
                'admin_label' => false,
                'param_name' => 'children',
                'value' => 5
            ),
            hotello_load_styles(5),
            vc_map_add_css_animation(),
            hotello_vc_add_css_editor_param()
        )
    ));

    class WPBakeryShortCode_Stm_Wp_Hotelier_Form extends WPBakeryShortCode
    {
		public function __construct($settings)
		{
			parent::__construct($settings);
			$this->enqueue();
		}

		protected function enqueue()
		{

			wp_enqueue_script('hotel_wp_hotelier_form/form');
		}
    }
}