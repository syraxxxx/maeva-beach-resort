<?php
$fonts = hotello_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];
/*Default layout styles*/
$default = hotello_get_layout_config();


/*Colors*/
$main_color = hotello_get_option('main_color', $default['main_color']);
$secondary_color = hotello_get_option('secondary_color', $default['secondary_color']);
$third_color = hotello_get_option('third_color', $default['third_color']);
?>

.stm_mobile__header {
background-color: <?php echo sanitize_text_field($secondary_color) ?> !important;
}

.stm-navigation__default > ul > li ul li:hover {
    border-bottom-color: <?php echo sanitize_text_field($main_color) ?>;
}

.stm_icon.stm_icon_styled_bg:hover i,
.widget_mc4wp_form_widget .form-group input:focus + .btn_icon .btn__icon {
    color: <?php echo sanitize_text_field($main_color) ?> !important;
}

select:focus,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
input[type="number"]:focus,
input[type="date"]:focus,
input[type="tel"]:focus,
textarea:focus,
.stm_select:focus,
.form-control:focus {
    border-color: <?php echo sanitize_text_field($main_color) ?> !important;
}

.stm-navigation__default > ul > li ul li:hover:after {
    background-color: <?php echo sanitize_text_field($main_color) ?>;
}

.stm_loop__list.stm_loop__single .stm_single-date .day,
.stm_wp_hotelier_rooms_list_style_1.white_nav .stm-rooms-types ul li a,
.stm_carousel_style_1 .stm_carousel__pagination,
.stm-icontext__text,
.room.type-room .room__meta-item,
.stm-single-room__sidebar .widget_contacts_style_1 .stm-icontext__text,
.room.type-room .stm-single-room__price {
    font-family: "<?php echo esc_attr($secondary_font['name']); ?>";
}

.stm_layout_chicago .stm-navigation__line_bottom > ul > li:before {
    bottom: 0 !important;
}

.room.type-room .stm-single-room__availability {
    margin-top: 0 !important;
}

.stm-footer .stm-socials a {
    color: #fff;
}

.form-group {
    margin-bottom: 30px;
}

.motel .btn, .vc_btn3 {
    font-family: <?php echo wp_kses_post($secondary_font['name']); ?> !important;
}

.stm-single-room__availability .stm_select:after {
    color: <?php echo sanitize_text_field($main_color) ?> !important;
}

h4 i.position_top {
    top: -50px;
}