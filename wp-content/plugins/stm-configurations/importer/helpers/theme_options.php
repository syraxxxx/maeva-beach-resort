<?php
$layouts_to_path = STM_CONFIGURATIONS_PATH . '/importer/helpers/theme_options';

function stm_get_layout_options($layout)
{
	$options = call_user_func('stm_theme_options_' . $layout);
	$options = json_decode($options, true);
	$options['show_page_title'] = 'false';
	return $options;
}

require_once $layouts_to_path . '/esperanza.php';
require_once $layouts_to_path . '/chicago.php';
require_once $layouts_to_path . '/alpen.php';
require_once $layouts_to_path . '/motel.php';
require_once $layouts_to_path . '/frankfurt.php';