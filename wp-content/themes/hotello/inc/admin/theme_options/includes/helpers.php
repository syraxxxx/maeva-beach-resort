<?php

/**
 * Get saved image for image control
 */
function hotello_get_thumbnail()
{
    check_ajax_referer('hotello_get_thumbnail', 'security');
    $url = '';
    if (!empty($_GET) and !empty($_GET['image_id'])) {
        $id = intval($_GET['image_id']);
        $url = wp_get_attachment_image_url($id);
    }

    echo esc_url($url);

    exit;
}

add_action('wp_ajax_hotel_get_thumbnail', 'hotello_get_thumbnail');

/**
 * Ajax action to save theme options
 *
 * Response in json format
 */
function hotello_save_settings()
{
    check_ajax_referer('hotello_save_settings', 'security');
    $res = array(
        'message' => ''
    );
    if (current_user_can('edit_theme_options')) {
        if (!empty($_POST)) {
            $updated = hotello_update_theme_options($_POST);
            if ($updated) {
                $res['message'] = esc_html__('Settings Saved', 'hotello');
            } else {
                $res['message'] = esc_html__('Nothing to save', 'hotello');
            }
        } else {
            $res['message'] = esc_html__('Error occured', 'hotello');
        }
    }

    echo json_encode($res);
    exit;
}

add_action('wp_ajax_hotel_save_settings', 'hotello_save_settings');

/**
 * Outputs js variables for angular.js
 */
function hotello_output_vars()
{
    global $wp_filesystem;

    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }
    $stored_theme_options = get_option('stm_theme_options', array());
    $theme_options = hotello_theme_options_array();

    $theme_options = hotello_set_theme_options_pairs($theme_options, $stored_theme_options);
    ?>
    <script>
      var ngAppPath = "<?php echo esc_url(HOTELLO_ADMIN_INCLUDE_URL . '/theme_options/includes/angular_app/'); ?>";
      var builderElements = <?php echo wp_json_encode(hotello_builder_elements()); ?>;
      var ngDefaultOptions = <?php echo wp_json_encode($theme_options); ?>;
      var ngGoogleFonts = <?php echo wp_json_encode(hotello_google_fonts_array()); ?>;
      var stmMenus = <?php echo wp_json_encode(hotello_get_menus()); ?>;
      var stmPages = <?php echo wp_json_encode(hotello_get_pages()); ?>;
      var themePath = <?php echo wp_json_encode(get_template_directory()); ?>;
      var customStyledElements = <?php echo wp_json_encode(hotello_get_custom_styled_elements_array());  ?>;
      <?php hotello_icons_set() ?>
    </script>
<?php }

/**
 * @param $to : theme options array
 * @param $sto :stored theme options array
 * @return mixed
 */
function hotello_set_theme_options_pairs($to, $sto)
{
    foreach ($to as $mt_key => $mt) {
        foreach ($mt['options'] as $st_key => $st) {
            foreach ($st['options'] as $ctrl_key => $ctrl) {
                $to[$mt_key]['options'][$st_key]['options'][$ctrl_key] = hotello_parse_control($ctrl);
                if (!empty($sto[$ctrl_key]) && $sto[$ctrl_key] !== null) {
                    $to[$mt_key]['options'][$st_key]['options'][$ctrl_key]['data']['value'] = $sto[$ctrl_key];
                } else {
                    if (isset($ctrl['data']['value'])) {
                        $to[$mt_key]['options'][$st_key]['options'][$ctrl_key]['data']['value'] = $ctrl['data']['value'];
                    }
                }
            }
        }
    }

    return $to;
}

/**
 * @param $to :theme options array
 * @return array
 */
function hotello_get_theme_options_pairs($to)
{
    $sto = array();
    $strip = array(
        'copyright',
        'right_text'
    );
    foreach ($to as $mt_key => $mt) {
        foreach ($mt['options'] as $st_key => $st) {
            foreach ($st['options'] as $ctrl_key => $ctrl) {
                $value = (in_array($ctrl_key, $strip)) ? stripslashes($ctrl['data']['value']) : $ctrl['data']['value'];
                $sto[$ctrl_key] = $value;
            }
        }
    }

    return $sto;
}

/**
 * @param $to :theme options array
 * @return bool
 */
function hotello_update_theme_options($to)
{
    $theme_options = hotello_get_theme_options_pairs($to);
    $builder_data = $theme_options['header_builder'];
    foreach ($builder_data as $row => $cols) {
        foreach ($cols as $col => $elements) {
            foreach ($elements as $element_key => $element) {
                if (empty($element['uniqueId'])) {
                    $theme_options['header_builder'][$row][$col][$element_key]['uniqueId'] = uniqid('stm_header_element_');
                }
            }
        }
    }
    hotello_update_custom_styles();
    flush_rewrite_rules();
    return (update_option('stm_theme_options', $theme_options));
}

/**
 * Reset Theme options to defaults
 */
function hotello_set_default_to()
{
    $default = hotello_theme_options_array();
    hotello_update_theme_options($default);
}

/**
 * Hook into theme options and replace any control type with something else
 *
 * @param $control
 * @return mixed|void
 */
function hotello_parse_control($control)
{
    $control_type = $control['type'];
    if ($control_type == 'select' and !empty($control['data']['post_type'])) {
        $post_type = $control['data']['post_type'];
        $choices = array('false' => esc_html__('None', 'hotello'));

        $wp_qargs = array(
            'post_type' => sanitize_text_field($post_type),
            'posts_per_page' => '-1',
            'post_status' => 'publish'
        );

        $q = new WP_Query($wp_qargs);

        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();
                $choices[get_the_ID()] = get_the_title();
            }
        }

        if (!empty($control['data']['choices'])) {
            $choices = $control['data']['choices'] + $choices;
        };

        $control['data']['choices'] = $choices;
    } else if ($control_type == 'font') {
        /*Font weight*/
        $fw = hotello_get_fw();
        $control['data']['fw'] = $fw;
    }

    /*Get Export options*/
    if (!empty($control['source']) and $control['source'] == 'theme_options') {
        $control['data']['value'] = json_encode(get_option('stm_theme_options'));
    }

    return apply_filters('hotel_parse_control', $control);
}

function hotello_icons_set()
{
    global $wp_filesystem;

    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }

    $icons = array();

    /*Fontawesome*/
    $fa = hotello_fontawesome_list();
    $fa_tmp = array();
    foreach ($fa as $key => $value) {
        $fa_tmp[] = $key;
    }
    $icons['FontAwesome'] = $fa_tmp;

    $custom_fonts = get_option('stm_fonts');
    $wp_uploads = wp_upload_dir();
    $base_url = $wp_uploads['baseurl'];
    $base_path = $wp_uploads['basedir'];

    if (!empty($custom_fonts)) {
        foreach ($custom_fonts as $font_name => $custom_font) {
            $json_file_url = $base_url . '/' . $custom_font['folder'] . '/selection.json';
            $json_file = $base_path . '/' . $custom_font['folder'] . '/selection.json';
            if (!file_exists($json_file)) continue;
            $custom_icons_json = json_decode($wp_filesystem->get_contents($json_file), true);
            $custom_icons = array();

            if (!empty($custom_icons_json)) {
                $set_name = $custom_icons_json['metadata']['name'];
                $set_prefix = $custom_icons_json['preferences']['fontPref']['prefix'];

                if (strpos($custom_font['include'], 'stm_fonts/stmicons/') !== false) {
                    $set_name = str_replace('stm_fonts/stmicons/', '', $custom_font['include']);
                }

                foreach ($custom_icons_json['icons'] as $icon) {
                    $custom_icons[] = $set_prefix . $icon['properties']['name'];
                }

                if ($set_name == 'stmicons') {
                    $layout_fonts = get_option('stm_fonts_layout');
                    if (!empty($layout_fonts)) {
                        foreach ($layout_fonts as $layout_font) {
                            if (!empty($layout_font['enabled'])) {
                                $json_file = $base_path . '/' . $layout_font['folder'] . '/selection.json';
                                if (!file_exists($json_file)) continue;
                                $custom_icons_json = json_decode($wp_filesystem->get_contents($json_file), true);
                                if (!empty($custom_icons_json)) {
                                    foreach ($custom_icons_json['icons'] as $icon) {
                                        $custom_icons[] = $set_prefix . $icon['properties']['name'];
                                    }
                                }
                            }
                        }
                    }
                }

                if (!empty($custom_icons)) {
                    $icons[$set_name] = $custom_icons;
                }
            }
        }
    }

    echo 'var stm_icons = ' . wp_json_encode($icons) . ';';
}