<?php
$includes = get_template_directory() . '/inc/admin/product_registration/includes/';
define('STM_ITEM_NAME', 'Hotello');
define('STM_API_URL', 'https://panel.stylemixthemes.com/api/');

/*Connect Envato market plugin.*/
if (!class_exists('Envato_Market')) {
    require_once($includes . 'envato-market/envato-market.php');
}

require_once $includes . 'theme.php';
require_once $includes . 'admin_screens.php';