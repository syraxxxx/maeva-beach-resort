<?php

    function hotello_sticky_enqueue_script() {
        $stm_options = get_option('stm_theme_options');
        $path = '/inc/admin/theme_options/sticky_header/assets/';
        if (!empty( $stm_options['header_sticky'])) {
            wp_enqueue_script('sticky-script', get_template_directory_uri() . $path . 'sticky.js', array('jquery'), 1.1, true);

            wp_enqueue_style('sticky-style', get_template_directory_uri() . $path . 'sticky.css');
        }
    }
    add_action('wp_enqueue_scripts', 'hotello_sticky_enqueue_script');