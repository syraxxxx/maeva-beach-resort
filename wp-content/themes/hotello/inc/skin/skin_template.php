<?php
/*Default layout styles*/
$default = hotello_get_layout_config();


/*Colors*/
$main_color = hotello_get_option('main_color', $default['main_color']);
$secondary_color = hotello_get_option('secondary_color', $default['secondary_color']);
$third_color = hotello_get_option('third_color', $default['third_color']);

$loader_color = hotello_get_option('preloader_color', $main_color);

$top_bar_color = hotello_get_option('top_bar_text_color');

/*Color*/
$colors = hotello_get_custom_styled_elements_array('colors', false);

/*Background color*/
$bg_colors = hotello_get_custom_styled_elements_array('bg_colors', false);

/*Border color*/
$border_colors = hotello_get_custom_styled_elements_array('border_colors', false);

foreach ($colors as $color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {color: <?php echo sanitize_text_field(${$color}); ?> !important}
<?php }

foreach ($bg_colors as $bg_color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
<?php }

foreach ($border_colors as $border_color => $elements) { ?>
    <?php echo implode(',', $elements) ?> {border-color: <?php echo sanitize_text_field(${$border_color}); ?> !important}
<?php }

$site_width = intval(hotello_get_option('site_width', '1170'));
$site_width_media_query = $site_width > 1200 ? $site_width : 1200;
?>


@media (min-width: <?php echo intval($site_width_media_query); ?>px) {
.container {
width: <?php echo intval($site_width); ?>px;
}
}

<?php $padding = hotello_get_option('site_padding', 0);
if (!empty($padding)):
    $resolution = intval(hotello_get_option('site_width', '1170')) + (intval($padding) * 2) + 100; ?>
    @media (min-width: <?php echo intval($resolution) ?>px) {
    #wrapper {
    padding-left: <?php echo intval($padding); ?>px;
    padding-right: <?php echo intval($padding); ?>px;
    }
    }
    @media (max-width: <?php echo intval($resolution) ?>px) {
    .fullwidth-header-part {
    padding-left: 15px;
    padding-right: 15px;
    }
    }
<?php endif; ?>



<?php
/*Footer styles*/
$background_color = hotello_get_option('footer_bg');
$background_image = hotello_get_image_url(hotello_get_option('footer_bg_image'));
$color = hotello_get_option('footer_color', '#fff');
$f_cols = hotello_get_option('footer_cols', 4);
?>

.stm_boxed .stm-footer,
.stm-footer {
background-color: <?php echo sanitize_text_field($background_color); ?>;
<?php if (!empty($background_image)): ?>
    background-image: url('<?php echo esc_url($background_image); ?>');
<?php endif; ?>
}


.stm-footer a,
.stm-footer .stm-socials__icon:hover,
.stm-footer aside.widget .widgettitle h4,
.stm-footer {
color: <?php echo sanitize_text_field($color); ?>;
}

@media (min-width: 1025px) {
.stm-footer .footer-widgets aside.widget {
width: <?php echo intval(100 / $f_cols); ?>%;
}
html>body .stm-navigation__hamburger ul li a:hover {
background-color: <?php echo wp_kses_post($main_color); ?>;
}

}

button[type="submit"]:not(.btn),
input[type="submit"]:not(.btn) {
background-color: <?php echo sanitize_text_field($main_color); ?>;
}

button[type="submit"]:not(.btn):hover,
input[type="submit"]:not(.btn):hover {
background-color: <?php echo sanitize_text_field($third_color); ?>;
color: #fff;
}

blockquote,
body .stm_posts_list__single:before {
border-left-color: <?php echo sanitize_text_field($main_color); ?>;
}

.stm_history__year {
border-right-color: <?php echo sanitize_text_field($main_color); ?>;
}

.vc_tta.vc_tta-accordion .vc_tta-panels-container .vc_active .vc_tta-panel-title > a {
border-color: <?php echo sanitize_text_field($main_color); ?> !important;
color: #fff !important;
}

html.stm-site-loader:before {
background-color: <?php echo sanitize_text_field(hotello_color_string_fix($loader_color)); ?>
}

.stm_iconbox.stm_iconbox_style_1 .stm_flipbox__front,
.stm_iconbox.stm_iconbox_style_1 {
border-color: rgba(<?php echo sanitize_text_field(hotello_hex2rgb($main_color, '0.5')); ?>);
}

.twentytwenty-handle {
background-color: rgba(<?php echo sanitize_text_field(hotello_hex2rgb($main_color, '0.9')); ?>);
}


.stm_gmap_wrapper.style_1 .stm_infobox:after {
border-top-color: rgba(<?php echo sanitize_text_field(hotello_hex2rgb($third_color)); ?>) !important;
}


.stm_iconbox.stm_iconbox_style_1:hover {
border-color: rgba(<?php echo sanitize_text_field(hotello_hex2rgb($main_color)); ?>);
}


<?php
$footer_color = hotello_get_option('footer_color');
$footer_bottom_color = hotello_get_option('footer_bottom_color');
if (empty($footer_bottom_color)) {
    $footer_bottom_color = $footer_color;
}
?>

.stm-footer__bottom:before {
background-color: <?php echo sanitize_text_field(hotello_color_string_fix(hotello_get_option('footer_bottom_bg'))); ?>;
}
.stm-footer__bottom {
color: <?php echo sanitize_text_field(hotello_color_string_fix($footer_bottom_color)); ?>
}

.datepicker__month-day--selected,
.datepicker__month-day--hovering
{
background-color: rgba(<?php echo sanitize_text_field(hotello_hex2rgb($main_color, .2)); ?>);
}


.mfc path {
fill: <?php echo wp_kses_post($main_color); ?>
}

.sfc path {
fill: <?php echo wp_kses_post($secondary_color); ?>
}

.tfc path {
fill: <?php echo wp_kses_post($third_color); ?>
}

.widget-booking__change-cart-link:hover {
background-color: <?php echo hotello_adjust_brightness($main_color, -20); ?> !important;
}

<?php
$stm_options = get_option('stm_theme_options');
$header_sticky_bg = $stm_options['header_sticky_bg'];
if (!empty($header_sticky_bg)): ?>
    .stm-header .hotello_sticked:before {
    background-color: <?php echo sanitize_hex_color($header_sticky_bg); ?> !important;
    }
<?php endif; ?>