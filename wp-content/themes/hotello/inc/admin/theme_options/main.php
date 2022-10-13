<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
    exit('Direct script access denied.');
}
$theme_options_path = HOTELLO_ADMIN_INCLUDE_PATH . '/theme_options';

hotello_require($theme_options_path . '/main.php');
hotello_require($theme_options_path . '/includes/presets.php');
hotello_require($theme_options_path . '/includes/helpers.php');
hotello_require($theme_options_path . '/screen.php');
hotello_require($theme_options_path . '/includes/enqueue.php');

hotello_require($theme_options_path . '/sticky_header/enqueue_sh.php');