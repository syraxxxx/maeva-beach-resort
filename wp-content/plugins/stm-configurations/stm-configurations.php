<?php
	/*
	Plugin Name: STM Configurations
	Plugin URI: https://stylemixthemes.com/
	Description: STM Configurations
	Author: Stylemix Themes
	Author URI: https://stylemixthemes.com/
	Text Domain: stm-configurations
	Version: 1.3.3
	*/

	$is_stm_theme = !empty(get_option('stm_theme_version'));

	if (!$is_stm_theme) {
		return false;
	}

	define('STM_CONFIGURATIONS_PATH', dirname(__FILE__));
	define('STM_CONFIGURATIONS_URL', plugin_dir_url(__FILE__));
	define('STM_IMAGES', STM_CONFIGURATIONS_URL . 'post-types/metaboxes/butterbean/images/');

	if (!is_textdomain_loaded('stm-configurations')) {
		load_plugin_textdomain('stm-configurations', false, 'stm-configurations/languages');
	}

	require_once STM_CONFIGURATIONS_PATH . '/helpers/includes.php';

	/*Custom icons*/
	require_once STM_CONFIGURATIONS_PATH . '/iconloader/stm-custom-icons.php';

	/*Post types*/
	require_once STM_CONFIGURATIONS_PATH . '/post-types/post_types.php';

    /**
     * Widgets
     */
    require_once STM_CONFIGURATIONS_PATH . '/widgets/gallery.php';
    require_once STM_CONFIGURATIONS_PATH . '/widgets/contacts.php';
    require_once STM_CONFIGURATIONS_PATH . '/widgets/socials.php';
    require_once STM_CONFIGURATIONS_PATH . '/widgets/seasonal_price.php';


    add_action( 'wp_enqueue_scripts', 'enqueue_sticky_sidebar' );
    function enqueue_sticky_sidebar() {
        wp_register_script ( 'sticky-sidebar', STM_CONFIGURATIONS_URL . 'assets/js/sticky-sidebar.min.js', array('jquery'), 1, true );
        wp_register_script ( 'handle_sticky-sidebar', STM_CONFIGURATIONS_URL . 'assets/js/handle_sticky_sidebar.js', array('jquery'), 1, true );
    }


	if (is_admin()) {
        require_once  STM_CONFIGURATIONS_PATH . '/helpers/enqueue.php';


        /*Demo import*/
		require_once STM_CONFIGURATIONS_PATH . '/importer/importer.php';

		/*Extend theme options*/
		require_once STM_CONFIGURATIONS_PATH . '/helpers/extend_theme_options.php';

		/*Metaboxes*/
		require_once STM_CONFIGURATIONS_PATH . '/post-types/metaboxes/butterbean_metaboxes.php';

	}