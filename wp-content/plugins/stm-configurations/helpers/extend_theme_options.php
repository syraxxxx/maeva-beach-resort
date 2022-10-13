<?php

//hotel_theme_options

add_filter('hotel_theme_options', 'stm_hotel_theme_options');

function stm_hotel_theme_options($theme_options) {

	$theme_options['general']['options']['global']['options']['google_api_key_divider'] = array(
		'type' => 'divider',
		'data' => array(
			'title' => esc_html__('Google API settings', 'hotello'),
			'value' => ''
		)
	);

	$theme_options['general']['options']['global']['options']['google_api_key'] = array(
		'type' => 'text',
		'data' => array(
			'title' => esc_html__('Google API key', 'hotello'),
			'value' => ''
		)
	);

	$theme_options['general']['options']['global']['options']['ga'] = array(
		'type' => 'text',
		'data' => array(
			'title' => esc_html__('Google analytics ID', 'hotello'),
			'value' => ''
		)
	);

	return $theme_options;
}