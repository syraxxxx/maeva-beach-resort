<?php

require_once get_template_directory() . '/resources/partials/skin/titlebox.php';


/**
 * @param bool|string $type colors, bg_colors, border_colors
 * @param bool|string $color m_color, secondary_color, third_color, false for full array
 * @return array
 */
function hotello_get_custom_styled_elements_array($type = false, $color = false)
{
    $elements_list = array(
        'colors' => array(
            'main_color' => array(
                '.mtc',
                '.mtc_h:hover',
                '.mtc_b:before',
                '.mtc_b_h:hover:before',
                '.mtc_a:after',
                '.mtc_a_h:hover:after',
                '.mtc_a_h.active',
                '.stm_header_style_1 li ul li.current_page_item > a',
                '.stm_header_style_1 .stm-navigation ul>li.stm_megamenu ul li.current_page_item>a',
                '.stm_header_style_1 .stm-navigation ul > li > ul > li > a',
                '.stm-single-room__sidebar .widget_contacts .stm-icontext__icon:before',
                '.stm_buttons_style_2 .btn.btn_outline.btn_third:hover',
                '.stm-posts-list_style_3 .stm-post__posts-list .stm-post__title h4 a',

                '.btn:hover',
                '.btn:hover .btn__icon',
                '.btn.btn_white.btn_icon.btn_outline:hover .btn__icon',
                '.btn.btn_outline.btn_primary',
            ),
            'secondary_color' => array(
                '.stc',
                '.stc_h:hover',
                '.stc_a:after',
                '.stc_a_h:hover:after',
                '.stc_b:before',
                '.stc_b_h:hover:before',

            ),
            'third_color' => array(
                '.ttc',
                '.ttc_h:hover',
                '.ttc_a:after',
                '.ttc_a_h:hover:after',
                '.ttc_b:before',
                '.ttc_b_h:hover:before',
                '.datepicker__month-day--selected',
                '.datepicker__month-day--hovering',
                '.stm_header_style_1 .stm-navigation ul > li > ul > li > a',
				'.datepicker-input-select-wrapper:after',
				'.stm_select:after',
                '.stm_testimonials_style_2 .owl-nav button.owl-prev:before, .stm_testimonials_style_2 .owl-nav button.owl-next:before',

                '.btn.btn_outline',
                '.btn.btn_outline.btn_primary.btn_load span',
                '.btn.btn_outline.btn_primary.btn_load:before',
                '.btn_primary.btn_outline .btn__icon,.btn_secondary.btn_outline .btn__icon',
                '.btn.btn_outline.btn_white:hover',
                '.btn .btn__icon',
                '.btn_white.btn_solid:not(:hover)'
            )
        ),
        'bg_colors' => array(
            'main_color' => array(
                '.mbc',
                '.mbc_h:hover',
                '.mbc_b:before',
                '.mbc_b_h:hover:before',
                '.mbc_a:after',
                '.mbc_a_h:hover:after',
                '.mbc_h.active',
                'mark',
                '.stm_titlebox',
                '.owl-carousel .owl-dots .owl-dot.active span',
                '.vc_images_carousel .vc_carousel-indicators li.vc_active',
                '.datepicker__month-day--first-day-selected',
                '.datepicker__month-day--last-day-selected',
                '.datepicker__close-button',
                '.owl-nav .owl-prev:hover',
                '.owl-nav .owl-next:hover',
                '.widget-rooms-filter__group-item--chosen a:before',
                '.stm-dropdown .dropdown-menu li a:hover',
                '.wpb-js-composer .vc_tta.vc_general .vc_active .vc_tta-panel-title',

                '.stm_header_style_1 .stm-navigation ul > li > ul > li:hover > a',
                '.stm_header_style_1 .stm-navigation ul > li > ul > li.current-menu-item > a',
                '.stm_wp_hotelier_rooms_carousel_style_1 .stm_wp_hotelier_rooms_carousel__categories li.active a',
                '.widget-booking__change-cart-link',

                'ul.page-numbers .page-numbers.current',
                'ul.page-numbers .page-numbers:hover',


                /*Buttons*/
                /*SOLID*/
                /*Primary*/
                '.btn_primary.btn_solid',
                '.btn_primary.btn_divider .btn__icon:after',
                '.btn_third.btn_solid:hover',
                '.btn_primary.btn_solid:hover .btn__icon:after',

                '.btn_primary.btn_outline .btn__icon:after',

                '.btn_primary.btn_outline:hover',

                '.stm_slider_style_2.stm_slider .stm_slide__button a:hover',
                'body .btn_solid.btn_primary_hover:hover',
            ),
            'secondary_color' => array(
                '.sbc',
                '.sbc_h:hover',
                '.sbc_a:after',
                '.sbc_a_h:hover:after',
                '.sbc_b:before',
                '.sbc_b_h:hover:before',


                /*Buttons*/
                '.btn_secondary.btn_solid',
                '.btn_secondary.btn_outline:hover',
                '.btn_secondary.btn_outline .btn__icon:after',
                '.stm_slider_style_3.stm_slider .stm_slide__button a',
                '.stm_slider_style_4 .stm_slide__button a',
            ),
            'third_color' => array(
                '.tbc',
                '.tbc_h:hover',
                '.tbc_h.active',
                '.tbc_a:after',
                '.tbc_a_h:hover:after',
                '.tbc_b:before',
                '.tbc_b_h:hover:before',
                '.datepicker__close-button:hover',
                '.stm_wp_hotelier_rooms_filter .widget-rooms-filter__group-label',
                '.stm_mobile__header',
                '.widget-booking__wrapper',
                '.widget-booking.widget--hotelier .stm-reservation',
				'.owl-nav .owl-prev',
				'.owl-nav .owl-next',

                '.stm_testimonials_style_2 .owl-nav button.owl-prev:hover, .stm_testimonials_style_2 .owl-nav button.owl-next:hover',


                /*Buttons*/
                '.btn_primary.btn_solid:hover',
                '.btn_primary.btn_solid.active',
                '.btn_secondary.btn_solid:hover',
                '.btn_third.btn_solid',

                '.btn_third.btn_outline:hover',
                '.btn_primary.btn_outline:hover .btn__icon:after',
                '.btn_primary.btn_solid .btn__icon:after',
                '.btn_third.btn_outline .btn__icon:after',
                '.btn_white.btn_solid:hover',
            )
        ),
        'border_colors' => array(
            'main_color' => array(
                '.mbdc',
                '.mbdc_h:hover',
                '.mbdc_b:before',
                '.mbdc_b_h:hover:before',
                '.mbdc_a:after',
                '.mbdc_a_h:hover:after',
                '.owl-nav .owl-prev:hover',
                '.owl-nav .owl-next:hover',
                '.stm_select.open',
                '.stm_select.open .stm_select__dropdown',
                '.datepicker-input-select:focus',
                '.datepicker__close-button',
                '.hotelier-listing form.datepicker-form',
                '.form-control:focus',
                '.stm_buttons_style_2 .btn.btn_outline.btn_third:hover',
                '.icon-list-1 li:before',
                '.icon-list-1 li:after',

                /*Buttons*/
                '.btn_primary.btn_solid',
                '.btn_primary.btn_outline',
                '.tbc .btn_primary.btn_solid:hover',
                '.btn_third.btn_solid:hover'
            ),
            'secondary_color' => array(
                '.sbdc',
                '.sbdc_h:hover',
                '.sbdc_a:after',
                '.sbdc_a_h:hover:after',
                '.sbdc_b:before',
                '.sbdc_b_h:hover:before',
                'ul.page-numbers .page-numbers.current, ul.page-numbers .page-numbers:hover',


                /*Buttons*/
                '.stm_widget_search.style_2 button',
                '.stm_events_list_style_4 .stm_events_list.not-inverted .btn',
                '.store_newsletter .mc4wp-form-fields .btn:hover',

            ),
            'third_color' => array(
                '.tbdc',
                '.tbdc_h:hover',
                '.tbdc_a:after',
                '.tbdc_a_h:hover:after',
                '.tbdc_b:before',
                '.tbdc_b_h:hover:before',
                '.datepicker__close-button:hover',

				'.stm_testimonials_style_2 .owl-nav button.owl-prev:hover, .stm_testimonials_style_2 .owl-nav button.owl-next:hover',

                /*Buttons*/
                '.btn_primary.btn_solid:hover',
                '.btn_primary.btn_solid.active',
                '.btn_third'
            )
        )
    );

    $res = $elements_list;


    if (!empty($type)) {
        $res = $elements_list[$type];
        if (!empty($color)) {
            $res = $elements_list[$type][$color];
        }
    }


    return apply_filters('hotel_get_custom_styled_elements_array', $res);

}

function hotello_update_custom_styles()
{

    global $wp_filesystem;

    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }

    /*Generate custom css*/
    $custom_css = '';
    //Disable theme HB styles if HB plugin enabled
    if (!hotello_stm_hb_enabled()) {
        $custom_css .= hotello_header_elements_styles();
        $custom_css .= hotello_header_element_custom_styles();
    }
    $custom_css .= preg_replace('/\s+/', ' ', hotello_custom_styles());

    /*Create dir or update*/
    $upload_dir = wp_upload_dir();

    if (!$wp_filesystem->is_dir($upload_dir['basedir'] . '/stm_uploads')) {
		wp_mkdir_p($upload_dir['basedir'] . '/stm_uploads');
    }

    $custom_style_file = $upload_dir['basedir'] . '/stm_uploads/skin-custom.css';

    /*Update V*/
    $current_v = get_option('stm_custom_styles_v', 1) + 1;
    update_option('stm_custom_styles_v', $current_v);

    $wp_filesystem->put_contents($custom_style_file, $custom_css, FS_CHMOD_FILE);

}

function hotello_custom_inline_styles($handle = 'hotello-theme-styles')
{
    $custom_css = '';
    wp_add_inline_style($handle, apply_filters('hotel_custom_inline_styles', $custom_css));
}

function hotello_header_elements_styles()
{
    $custom_css = '';
    $top_bar_bg = hotello_get_image_url(hotello_get_option('top_bar_bg'));
    $header_bg = hotello_get_image_url(hotello_get_option('header_bg'));
    $bottom_bar_bg = hotello_get_image_url(hotello_get_option('bottom_bar_bg'));
    $header_bgi = hotello_get_image_url(hotello_get_option('header_bgi'));


    $styles = array(
        '.stm-header' => array(
            'background-image' => esc_url($header_bgi),
        ),
        '.stm-header__row_color_top' => array(
            'padding-top' => hotello_get_option('top_bar_top'),
            'padding-bottom' => hotello_get_option('top_bar_bottom'),
            'background-image' => esc_url($top_bar_bg),
            'color' => hotello_get_option('top_bar_text_color'),
            '.stm-icontext__text' => array(
                'color' => hotello_get_option('top_bar_text_color')
            ),
            'a' => array(
                'color' => hotello_get_option('top_bar_text_color')
            ),
            'a:hover' => array(
                'color' => hotello_get_option('top_bar_link_color_hover')
            ),
            'li:hover a' => array(
                'color' => hotello_get_option('top_bar_link_color_hover')
            ),
        ),
        '.stm-header__row_color_top:before' => array(
            'background-color' => hotello_get_option('top_bar_color'),
        ),
        '.stm-header__row_color_center' => array(
            'padding-top' => hotello_get_option('header_top'),
            'padding-bottom' => hotello_get_option('header_bottom'),
            'background-image' => esc_url($header_bg),
            'color' => hotello_get_option('header_text_color'),
            '.stm-icontext__text' => array(
                'color' => hotello_get_option('header_text_color')
            ),
            'a' => array(
                'color' => hotello_get_option('header_text_color')
            ),
            'li:hover > a' => array(
                'color' => hotello_get_option('header_text_color_hover') . '!important'
            ),
            'a:hover' => array(
                'color' => hotello_get_option('header_text_color_hover') . '!important'
            ),
            'a > .divider' => array(
                'color' => hotello_get_option('header_text_color') . '!important'
            ),
            'a:hover > .divider' => array(
                'color' => hotello_get_option('header_text_color') . '!important'
            ),
            'li:hover > a > .divider' => array(
                'color' => hotello_get_option('header_text_color') . '!important'
            )
        ),
        '.stm-header__row_color_center:before' => array(
            'background-color' => hotello_get_option('header_bg_fill') === 'full' ? hotello_get_option('header_color') : '',
        ),
        '.stm-header__row_color_center > .container > .stm-header__row_center' => array(
            'background-color' => hotello_get_option('header_bg_fill') === 'container' ? hotello_get_option('header_color') : '',
        ),
        '.stm-header__row_color_bottom' => array(
            'padding-top' => hotello_get_option('bottom_bar_top'),
            'padding-bottom' => hotello_get_option('bottom_bar_bottom'),
            'background-image' => esc_url($bottom_bar_bg),
            'color' => hotello_get_option('bottom_bar_text_color'),
            '.stm-icontext__text' => array(
                'color' => hotello_get_option('bottom_bar_text_color')
            ),
            'a' => array(
                'color' => hotello_get_option('bottom_bar_text_color')
            ),
            'a:hover' => array(
                'color' => hotello_get_option('bottom_bar_link_color_hover')
            ),
            'li:hover a' => array(
                'color' => hotello_get_option('bottom_bar_link_color_hover')
            )
        ),
        '.stm-header__row_color_bottom:before' => array(
            'background-color' => hotello_get_option('bottom_bar_color'),
        ),
        'a' => array(
            'color' => hotello_color_string_fix(hotello_get_option('link_color'))
        ),
        'a:hover' => array(
            'color' => hotello_color_string_fix(hotello_get_option('link_hover_color'))
        ),
        'p' => array(
            'margin-bottom' => hotello_get_option('p_margin_bottom'),
            'line-height' => hotello_get_option('p_line_height')
        )
    );

    foreach ($styles as $element => $element_styles) {
        $custom_css .= "{$element}{";
        foreach ($element_styles as $parent_prop => $parent_value) {
            if (!empty($parent_value)) {
                $helpers = hotello_get_style($parent_prop);
                $prefix = $helpers['prefix'];
                $affix = $helpers['affix'];

                /*Second lvl*/
                if (is_array($parent_value)) {
                    $custom_css .= "} {$element} {$parent_prop} {";
                    foreach ($parent_value as $prop => $value) {
                        $helpers = hotello_get_style($parent_prop);
                        $prefix = $helpers['prefix'];
                        $affix = $helpers['affix'];

                        $custom_css .= "{$prop}:{$prefix}{$value}{$affix};";
                    }
                } else {
                    /*First lvl*/
                    $custom_css .= "{$parent_prop}:{$prefix}{$parent_value}{$affix};";
                }
            }
        }
        $custom_css .= '}';
    }

    return $custom_css;
}

function hotello_header_element_custom_styles()
{
    $custom_css = '';
    $data = apply_filters('hotel_builder_elements', hotello_get_option('header_builder'));
    if (empty($data)) return null;

    foreach ($data as $row => $columns) {
        foreach ($columns as $column => $elements) {
            foreach ($elements as $data) {
                $element = sanitize_title($data['$$hashKey']);
                if (!empty($data['uniqueId'])) {
                    $element = sanitize_title($data['uniqueId']);
                }
                if (!empty($element)) {

                    $element = ".stm-header__element.{$element}";
                    $media = array(
                        'default' => '(min-width:1023px)',
                        'tablet' => '(max-width:1023px) and (min-width:425px)',
                        'mobile' => '(max-width:425px)'
                    );


                    /*Generate margins*/
                    if (!empty($data['margins'])) {
                        foreach ($data['margins'] as $display => $margins) {
                            if (!empty($margins)) {
                                $custom_css .= "@media {$media[$display]}{{$element}{";
                                foreach ($margins as $prop => $value) {
                                    if (isset($prop) && !empty($value)) {
                                        $custom_css .= "margin-{$prop}:{$value}px !important;";
                                    }
                                }
                                $custom_css .= "}}";
                            }
                        }
                    }

                    /*Generate paddings*/
                    if (!empty($data['paddings'])) {
                        foreach ($data['paddings'] as $display => $margins) {
                            if (!empty($margins)) {
                                $custom_css .= "@media {$media[$display]}{{$element}{";
                                foreach ($margins as $prop => $value) {
                                    if (isset($prop) && !empty($value)) {
                                        $custom_css .= "padding-{$prop}:{$value}px !important;";
                                    }
                                }
                                $custom_css .= "}}";
                            }
                        }
                    }

                    /*Generate text color*/
                    if (hotello_array_has($data, 'data.textColor.name') && $data['data']['textColor']['name'] === 'Custom') {
                        $custom_css .= $element . "{color: " . $data['data']['textColor']['value'] . "}";
                    }

                    /*Generate icon color*/
                    if (hotello_array_has($data, 'data.iconColor.name') && $data['data']['iconColor']['name'] === 'Custom') {
                        $custom_css .= $element . " [class*='_icon'] {color: " . $data['data']['iconColor']['value'] . "}";
                    }


                    /*Menu item hover line*/
                    if (hotello_array_has($data, 'data.lineColor') && !empty($data['data']['lineColor']) &&
                        hotello_array_has($data, 'data.line') && !empty($data['data']['line'])
                    ) {
                        $custom_css .= $element . " li:before {background-color: {$data['data']['lineColor']} !important;}";
                    }

                    /*Menu font size*/
                    if (hotello_array_has($data, 'data.fsz') && !empty($data['data']['fsz'])) {
                        $custom_css .= $element . " li a {font-size: {$data['data']['fsz']}px !important;}";
                    }

                    /*Menu item a color*/
                    if (hotello_array_has($data, 'data.menuLinkColor') && !empty($data['data']['menuLinkColor'])) {
                        $custom_css .= $element . " li a {color: {$data['data']['menuLinkColor']} !important;}";
                    }
                    /*Menu item a color on hover*/
                    if (hotello_array_has($data, 'data.menuLinkColorOnHover') && !empty($data['data']['menuLinkColorOnHover'])) {
                        $custom_css .= $element . " li a:hover {color: {$data['data']['menuLinkColorOnHover']} !important;}";
                        $custom_css .= $element . " li:hover > a {color: {$data['data']['menuLinkColorOnHover']} !important;}";
                    }

                    if (!empty($data['order'])) {
                        foreach ($media as $device => $breakpoint) {
                            if (!empty($data['order'][$device])) {
                                $custom_css .= "@media {$breakpoint} {";
                                $custom_css .= $element . "{order: -{$data['order'][$device]}}";
                                $custom_css .= "}";
                            }
                        }
                        $custom_css .= $element . "{}";
                    }

                    $disabled_devices = (!empty($data['disabled'])) ? array_keys(array_filter($data['disabled'])) : array();
                    if (!empty($disabled_devices)) {
                        foreach ($media as $device => $breakpoint) {
                            if (in_array($device, $disabled_devices)) {
                                $custom_css .= "@media {$breakpoint} {";
                                $custom_css .= $element . "{display: none!important};";
                                $custom_css .= "}";
                            }
                        }
                    }

//					Full height
                    if (!empty($data['fullHeight']) && $data['fullHeight'] === 'true') {
                        $custom_css .= $element . '{height: 100%;}';
                    }
                }
            }
        }
    }

    return $custom_css;
}

function hotello_custom_styles()
{
    ob_start();
    get_template_part('inc/skin/skin_template');
    get_template_part('inc/skin/fonts');
    get_template_part('inc/skin/responsive');
    get_template_part('resources/partials/layouts_styles/' . get_option('stm_layout', 'chicago') . '/style');

    return apply_filters('hotel_custom_styles', ob_get_clean());
}

function hotello_get_style($key = '')
{
    $r = array(
        'prefix' => '',
        'affix' => ''
    );

    $metrix = array(
        'padding-top',
        'padding-bottom',
        'margin-bottom',
        'line-height',
        'border-width'
    );

    $src = array(
        'background-image'
    );

    /*Set px*/
    if (in_array($key, $metrix)) {
        $r['affix'] = 'px';
    }

    /*Set url*/
    if (in_array($key, $src)) {
        $r['prefix'] = 'url("';
        $r['affix'] = '")';
    }

    return apply_filters('hotel_get_style', $r);
}

function hotello_css_styles($font, $ff_only = false, $result = false)
{
    $style = "";
    if (!empty($font['name'])) $style .= "font-family:'{$font['name']}';";
    if (!$ff_only) {
        if (!empty($font['color'])) $style .= "color:{$font['color']};";
        if (!empty($font['size'])) $style .= "font-size:{$font['size']}px;";
        if (!empty($font['fw'])) $style .= "font-weight:{$font['fw']};";
        if (!empty($font['ln'])) $style .= "line-height:{$font['ln']}px;";
        if (!empty($font['ls'])) $style .= "letter-spacing:{$font['ls']}px;";
        if (!empty($font['mgb'])) $style .= "margin-bottom:{$font['mgb']}px;";
    }

    $style = apply_filters('hotel_font_styles', $style);

    if ($result) return $style;

    echo sanitize_text_field($style);
}


