<?php

function stm_theme_import_sliders($layout)
{
	$slider_names = array(
		'esperanza' => array(
			'home',
		),
		'chicago' => array(
			'home',
		),
		'alpen' => array(
			'home',
		),
        'motel' => array(
            'home',
        ),
        'frankfurt' => array(
            'home',
            'frankfurt-slider'
        )
	);

	if (!empty($slider_names[$layout])) {
		if (class_exists('RevSlider')) {
			$path = STM_CONFIGURATIONS_PATH . '/importer/demos/' . $layout . '/sliders/';
			foreach ($slider_names[$layout] as $slider_name) {
				$slider_path = $path . $slider_name . '.zip';
				if (file_exists($slider_path)) {
					$slider = new RevSlider();
					$slider->importSliderFromPost(true, true, $slider_path);
				}
			}
		}
	}
}