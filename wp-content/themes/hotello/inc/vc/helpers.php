<?php

function hotello_vc_add_shadow_params($prefix = 'shadow')
{
    return array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Shadow X offset', 'hotello'),
            'param_name' => $prefix . '_x_offset',
            'group' => esc_html__('Design Options', 'hotello'),
            'std' => 0
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Shadow Y offset', 'hotello'),
            'param_name' => $prefix . '_y_offset',
            'group' => esc_html__('Design Options', 'hotello'),
            'std' => 0
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Shadow blur', 'hotello'),
            'param_name' => $prefix . '_blur',
            'group' => esc_html__('Design Options', 'hotello'),
            'std' => 0
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Shadow spread', 'hotello'),
            'param_name' => $prefix . '_spread',
            'group' => esc_html__('Design Options', 'hotello'),
            'std' => 0
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Shadow color', 'hotello'),
            'param_name' => $prefix . '_color',
            'group' => esc_html__('Design Options', 'hotello'),
            'std' => 'transparent'
        )
    );
}

function hotello_load_styles($qty = 1, $param_name = 'style', $admin_label = false)
{
    $res = array();
    for ($i = 1; $i <= $qty; $i++) {
        $res[sprintf(esc_html__("Style %s", 'hotello'), $i)] = "style_{$i}";
    }

    $arr = array(
        'type' => 'dropdown',
        'heading' => esc_html__('Style', 'hotello'),
        'param_name' => $param_name,
        'value' => $res,
        'std' => 'style_1',
        'weight' => '1'
    );

    if ($admin_label) $arr['admin_label'] = true;

    return $arr;
}

function hotello_vc_add_css_editor_param($name = 'css', $params = array())
{
    $data = array(
        'type' => 'css_editor',
        'heading' => esc_html__('Css', 'hotello'),
        'param_name' => $name,
        'group' => esc_html__('Design options', 'hotello')
    );

    $data = wp_parse_args($params, $data);

    return apply_filters('hotel_vc_add_css_editor', $data);
}

function hotello_vc_bg_colors_param()
{
    return array(
        esc_html__('Primary', 'hotello') => 'mbc',
        esc_html__('Secondary', 'hotello') => 'sbc',
        esc_html__('Third', 'hotello') => 'tbc',
        esc_html__('Custom', 'hotello') => 'custom',
    );
}

function hotello_vc_align_param()
{
    return array(
        esc_html__('Left', 'hotello') => 'left',
        esc_html__('Center', 'hotello') => 'center',
        esc_html__('Right', 'hotello') => 'right',
    );
}

function hotello_vc_colors_param()
{
    return array(
        esc_html__('Primary', 'hotello') => 'mtc',
        esc_html__('Secondary', 'hotello') => 'stc',
        esc_html__('Third', 'hotello') => 'ttc',
        esc_html__('Custom', 'hotello') => 'custom',
    );
}

/**
 * Locate template in vc styles
 *
 * @param string|array $templates Single or array of template files
 *
 * @return string
 */
function hotello_locate_vc_element($templates, $template_name = '', $custom_path)
{
    $located = false;


    foreach ((array)$templates as $template) {

        $folder = $template;

        if (!empty($template_name)) {
            $template = $template_name;
        }

        if (substr($template, -4) !== '.php') {
            $template .= '.php';
        }


        if (empty($custom_path)) {
            if (!($located = locate_template('resources/partials/vc_parts/' . $folder . '/' . $template))) {
                $located = get_template_directory() . '/resources/partials/vc_parts/' . $folder . '/' . $template;
            }
        } else {
            if (!($located = locate_template($custom_path))) {
                $located = get_template_directory() . '/' . $custom_path . '.php';
            }
        }

        if (file_exists($template_name)) {
            break;
        }
    }

    return apply_filters('hotel_locate_vc_element', $located, $templates);
}

/**
 * Load vc part
 *
 * @param $__template
 * @param array $__vars
 */
function hotello_load_vc_element($__template, $__vars = array(), $__template_name = '', $custom_path = '')
{
    extract($__vars);
    $element = hotello_locate_vc_element($__template, $__template_name, $custom_path);
    if (!file_exists($element) && strpos($__template_name, 'style_') !== false) {
        $element = str_replace($__template_name, 'style_1', $element);
    }
    if (file_exists($element)) {
        include $element;
    } else {
        echo esc_html__('Element not found in ' . $element, 'hotello');
    }
}

add_action('vc_before_init', 'hotello_vc_set_as_theme');

function hotello_vc_set_as_theme()
{
    vc_set_as_theme(true);
}

if (function_exists('vc_set_default_editor_post_types')) {
    vc_set_default_editor_post_types(array(
        'page',
        'post',
        'product',
        'stm_sidebars',
        'stm_services',
        'stm_testimonials'
    ));
}