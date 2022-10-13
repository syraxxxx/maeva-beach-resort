<?php

/*Default layout styles*/
$default = hotello_get_layout_config();


$form_style = hotello_get_option('forms_global_style', 'style_1');

/*Colors*/
$main_color = hotello_get_option('main_color', $default['main_color']);
$secondary_color = hotello_get_option('secondary_color', $default['secondary_color']);
$third_color = hotello_get_option('third_color', $default['third_color']);

$loader_color = hotello_get_option('preloader_color', $main_color);

$breakpoints = array(480, 768, 1024, 1200);


$colors = array(
    'main_color' => array(),
    'secondary_color' => array(),
    'third_color' => array()
);

$bg_colors = array(
    1024 => array(
        'main_color' => array(),
        'secondary_color' => array(),
        'third_color' => array(
            '.stm_header_style_1 .stm-header',
        )
    )
);

$border_colors = array(
    'main_color' => array(),
    'secondary_color' => array(),
    'third_color' => array()
);


foreach ($breakpoints as $breakpoint) {
    if (empty($bg_colors[$breakpoint])) continue;
    echo sanitize_text_field("@media (max-width: {$breakpoint}px) {");

    foreach ($bg_colors[$breakpoint] as $bg_color => $elements) { ?>
        <?php
        echo implode(',', $elements) ?> {background-color: <?php echo sanitize_text_field(${$bg_color}); ?> !important}
    <?php }
    echo sanitize_text_field('}');
}

