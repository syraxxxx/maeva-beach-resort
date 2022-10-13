<?php
/**
 * Enqueue scripts and styles.
 */
function hotello_scripts()
{
    $theme_info = hotello_get_theme_assets_paths();
    $upload_dir = wp_upload_dir();
    $jquery = array('jquery');
    $google_api_key = hotello_get_option('google_api_key');
    $layout = hotello_get_layout();

    //styles
    wp_enqueue_style('hotello-style', get_stylesheet_uri());
    wp_enqueue_style('hotello-app', $theme_info['css'] . 'app.css', null, $theme_info['v']);
    wp_enqueue_style('font-awesome', $theme_info['vendors'] . 'font-awesome.css', null, $theme_info['v']);
    wp_enqueue_style('material-icons', '//fonts.googleapis.com/icon?family=Material+Icons', null, $theme_info['v']);

    //scripts
    wp_enqueue_script('hotello-app', $theme_info['js'] . 'app.js', $jquery, $theme_info['v'], true);
    wp_enqueue_script('hotel_bootstrap', $theme_info['vendors'] . 'bootstrap.js', $jquery, $theme_info['v'], true);
    wp_register_script('google_map', '//maps.googleapis.com/maps/api/js?key=' . $google_api_key . '&callback=initGoogleScripts&v=weekly', array('hotello-app'), $theme_info['v'], true);
    wp_register_script('StmMarker.js', $theme_info['js'] . 'StmMarker.js', array('hotello-app'), $theme_info['v'], true);
    wp_register_script('hotello-owl-linked', $theme_info['js'] . 'owl.linked.js', array('hotello-owl-carousel'), $theme_info['v'], true);
    wp_register_script('hotello-owl-filter', $theme_info['js'] . 'owl.filter.js', array('hotello-owl-carousel'), $theme_info['v'], true);

    //vendors

    //owl
    wp_register_script('hotello-owl-carousel', $theme_info['vendors'] . 'owl.carousel.js');
    wp_register_style('hotello-owl-carousel', $theme_info['vendors'] . 'owl.carousel.css');
    //lightgallery
    wp_register_style('lightgallery', $theme_info['vendors'] . 'lightgallery.css');
    wp_register_script('lightgallery', $theme_info['vendors'] . 'lightgallery.js');
    wp_register_script('parallax', $theme_info['js'] . 'parallax.js', $jquery, $theme_info['v'], true);


    //custom skin
    wp_enqueue_style('hotello-theme-custom-styles', $upload_dir['baseurl'] . '/stm_uploads/skin-custom.css', null, get_option('stm_custom_styles_v', 1));

    /*TO Fonts*/
    wp_enqueue_style('stm_default_google_font', hotello_google_fonts(), null, $theme_info['v'], 'all');


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }


    /*VC modules*/
    $vc_modules = array(
        'wp_hotelier_rooms_carousel/carousel',
        'wp_hotelier_rooms_list/load_more',
        'posts_carousel/style_1',
        'images_gallery_with_categories/gallery',
        'wp_hotelier_selective_rooms_carousel/carousel',
        'wp_hotelier_form/form',
    );

    $vc_modules_path = $theme_info['js'] . 'vc_modules/';

    foreach ($vc_modules as $vc_module) {
        wp_register_script(
            'hotel_' . $vc_module,
            $vc_modules_path . $vc_module . '.js',
            'hotello-app',
            $theme_info['v'],
            true
        );
    }

    $post_layout_style = hotello_get_option('post_layout', '1') . '.css';
    $titlebox = hotello_get_option('page_title_box_style', 'style_1') . '.css';

    wp_enqueue_style('hotello-post-style', "{$theme_info['css']}post/style_{$post_layout_style}" , 'hotello-app', $theme_info['v']);

    wp_enqueue_style('hotello-titlebox-style', $theme_info['css'] . 'titlebox/' . $titlebox, '', $theme_info['v']);


    hotello_load_global_element_style('forms');
    hotello_load_global_element_style('buttons');


    //plugins
	wp_enqueue_style('stm_hotelier', $theme_info['css_vendors'] . 'hotelier/' . $layout . '/hotelier.css', null, $theme_info['v']);
    if (class_exists('Hotelier')) {
        wp_register_script('stm_room_availability_form', $theme_info['js_vendors'] . 'wp-hotelier/room_availability_form.js');
    }


    //to elements
    $header_style = hotello_get_option('main_header_style', 'style_1') . '.css';
    if (!hotello_stm_hb_enabled()) {
        wp_enqueue_style('hotello-header-style', $theme_info['css'] . 'header/styles/' . $header_style, 'hotello-header-styles', $theme_info['v']);
    }

    if(is_singular('room')) {
		wp_enqueue_script('hotel_wp_hotelier_rooms_list/load_more');
	}

	/*Icons*/
	wp_enqueue_style('stm-stmicons', get_template_directory_uri() . '/public/fonts/stmicons/stmicons.css', array(), $theme_info['v']);


	wp_enqueue_script( 'hotelier-init-datepicker', get_template_directory_uri() . '/public/js/vc_modules/wp_hotelier_form/datepicker.js', array('jquery', 'hotel-datepicker'), $theme_info['v'], true);
}

add_action('wp_enqueue_scripts', 'hotello_scripts', 5);

/*Get google font*/
// Default Google fonts enqueue
if (!function_exists('hotello_google_fonts')) {
    function hotello_google_fonts()
    {
        $fonts_url = '';
        $headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $headings_settings = array();
        $headings_font_families = array();

        foreach ($headings as $heading) {
            $headings_settings[] = hotello_get_option($heading . '_settings');
        }
        foreach ($headings_settings as $headings_setting) {
            if (!empty($headings_setting['name'])) {
                $ff = $headings_setting['name'];
                if (!in_array($ff, $headings_font_families)) {
                    $headings_font_families[] = $ff;
                }
            }
        }

        $main_font = _x('on', 'Main font: on or off', 'hotello');
        $sec_font = _x('on', 'Secondary font: on or off', 'hotello');

        $fonts = hotello_get_font();

        $main_font = $fonts['main'];
        $secondary_font = $fonts['secondary'];

        $l_m_font = $main_font['name'];
        $l_s_font = $secondary_font['name'];

        //TODO get subsets from theme options;
        $subsets = apply_filters('hotel_font_subset', 'latin,latin-ext');

        //TODO make font-weight custom;
        $weights = apply_filters('hotel_font_weight', '300,400,400i,500,600,700,800,900');

        if ('off' !== $main_font || 'off' !== $sec_font) {
            $font_families = array();
            $web_safe = hotello_websafe_fonts();

            if ('off' !== $main_font and empty($web_safe[$l_m_font])) {
                $font_families[] = "{$l_m_font}:{$weights}";
            }

            if ('off' !== $sec_font and empty($web_safe[$l_s_font])) {
                $font_families[] = "{$l_s_font}:{$weights}";
            }

            if (!empty($headings_font_families)) {
                foreach ($headings_font_families as $headings_font_family) {
                    $font_families[] = "{$headings_font_family}:{$weights}";
                }
            }

            $query_args = array(
                'family' => urlencode(implode('|', $font_families)),
                'subset' => urlencode($subsets)
            );

            $fonts_url = (!empty($font_families)) ? add_query_arg($query_args, 'https://fonts.googleapis.com/css') : '';
        }

        return esc_url($fonts_url);
    }
}