<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));

$type = 'HTL_Widget_Booking';
$args = array(
    'before_widget' => '<aside class="widget widget--hotelier widget-booking stm_wp_hotelier_widget_booking stm_wp_hotelier_widget_booking_' . $style . ' wpb_content_element vc_widgets' . $css_class . '">',
    'after_widget' => '</aside>',
    'before_title' => '<div class="widgettitle"><h5 class="no_line">',
    'after_title' => '</h5></div>'
);
$instance = $atts;

the_widget($type, $instance, $args);