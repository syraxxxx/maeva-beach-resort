<?php
if (!function_exists('hotel_setup')) :

	function hotello_setup()
	{
		load_theme_textdomain('hotello', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');

		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');

		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'hotello'),
		));


		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('hotel_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		$sidebars_count = hotello_get_sidebars_cols_count();

		foreach (range(1, $sidebars_count) as $sidebar) {
			register_sidebar(array(
				'name'          => sprintf(esc_html__('Footer Col %s', 'hotello'), $sidebar),
				'id'            => 'footer_' . $sidebar,
				'description'   => esc_html__('Footer Column that appears at the bottom of the page.', 'hotello'),
				'before_widget' => '<aside id="%1$s" class="widget widget-default widget-footer %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="widgettitle widget-footer-title"><h4>',
				'after_title'   => '</h4></div>',
			));
		}

		register_sidebar(array(
			'name'          => esc_html__('Primary Sidebar', 'hotello'),
			'id'            => 'default',
			'description'   => esc_html__('Main sidebar that appears on the right or left.', 'hotello'),
			'before_widget' => '<aside id="%1$s" class="widget widget-default %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="widgettitle"><h5 class="no_line">',
			'after_title'   => '</h5></div>',
		));


		/*Sizes*/
		add_image_size('hotello-img-335-170', 335, 170, true);
		add_image_size('hotello-img-450-300', 450, 300, true);
		add_image_size('hotello-img-350-300', 350, 300, true);
		add_image_size('hotello-img-1130-350', 1130, 350, true);
	}
endif;
add_action('after_setup_theme', 'hotello_setup');