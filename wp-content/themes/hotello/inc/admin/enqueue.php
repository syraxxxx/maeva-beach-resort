<?php

add_action('admin_enqueue_scripts', 'hotello_admin_styles');

function hotello_admin_styles($hook)
{
    $theme_info = hotello_get_theme_assets_paths();

    /* GLOBAL CSS */
    wp_enqueue_style('hotel-admin-styles', $theme_info['admin_css'] . 'style.css', null, $theme_info['v'], 'all');
//    wp_enqueue_script('hotel-admin-scripts', $theme_info['admin_js'] . 'app.js', array('vc-backend-actions-js'), $theme_info['v'], true);


    if ($hook !== 'hotel_page_hotel-theme-options') {
        wp_enqueue_script('wp-color-picker-alpha', $theme_info['admin_js'] . 'wp-color-picker-alpha.js', array('wp-color-picker'), $theme_info['v'], true);
    }


    wp_register_style('font-awesome', $theme_info['vendors'] . 'font-awesome.css');
    wp_register_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons', null, $theme_info['v']);

    //fonticonpicker
    wp_register_script('fontIconPicker', $theme_info['vendors'] . 'jquery.fonticonpicker.min.js');
    wp_register_style('fontIconPicker', $theme_info['vendors'] . 'jquery.fonticonpicker.min.css');
    wp_register_style('fontIconPicker-grey-theme', $theme_info['vendors'] . 'jquery.fonticonpicker.darkgrey.min.css');

	wp_enqueue_style('stm_default_google_font', hotello_google_fonts(), null, $theme_info['v'], 'all');
}

