<?php
$vc_includes_path = get_template_directory() . '/inc/vc/';


if (class_exists('WPBakeryShortCode')) {

    require_once $vc_includes_path . "helpers.php";
    require_once $vc_includes_path . "vc_core_params.php";

    $modules_path = $vc_includes_path . 'modules';
    $modules = array(
    	'contact',
        'images_gallery_with_categories',
        'separator',
        'iconbox',
        'infobox',
        'spacer',
        'testimonials',
        'button',
        'icon',
        'posts_carousel',
        'google_map',
        'call_to_action',
        'cf7',
        'carousel_gallery',
        'contacts_widget',
        'sidebar',
        'posts_list',
    );
    foreach ($modules as $module) {
        hotello_require($modules_path . '/' . $module . '.php');
    }
}

add_filter('vc_iconpicker-type-fontawesome', 'hotello_vc_custom_icons');

if (!function_exists('hotello_vc_custom_icons')) {
    function hotello_vc_custom_icons($fonts)
    {

        $counts = 0;
        /*Manager fonts*/
        $fonts_manager = hotello_add_fonts_pack();
        if (!empty($fonts_manager)) {
            $fonts = $fonts + $fonts_manager;
        }

        $layout_fonts = hotello_add_fonts_pack('stm_fonts_layout');
        if (!empty($layout_fonts)) {
            $fonts = $fonts + $layout_fonts;
        }

        return $fonts;
    }

    function hotello_add_fonts_pack($option = 'stm_fonts')
    {

        $fonts = array();

        $custom_fonts = get_option($option);
        global $wp_filesystem;

        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $wp_uploads = wp_upload_dir();
        $base_path = $wp_uploads['basedir'];

        if (!empty($custom_fonts)) {
            foreach ($custom_fonts as $font_name => $custom_font) {
                if ($option == 'stm_fonts_layout' && empty($custom_font['enabled'])) continue;
                $json_file = $base_path . '/' . $custom_font['folder'] . '/selection.json';
                $custom_icons_json = json_decode($wp_filesystem->get_contents($json_file), true);
                if (!empty($custom_icons_json)) {
                    if (!empty($custom_icons_json['icons'])) {
                        $set_name = str_replace('stmicons', 'Hotel icons', $custom_icons_json['metadata']['name']);
                        if ($option == 'stm_fonts_layout') {
                            $set_name = ucfirst(str_replace('stmicons_', 'Hotel - ', $font_name));
                        }
                        $set_prefix = $custom_icons_json['preferences']['fontPref']['prefix'];
                        foreach ($custom_icons_json['icons'] as $icon) {
                            $fonts[$set_name][] = array(
                                $set_prefix . $icon['properties']['name'] => $set_prefix . $icon['properties']['name']
                            );
                        }
                    }
                }
            }
        }

        return $fonts;
    }
}