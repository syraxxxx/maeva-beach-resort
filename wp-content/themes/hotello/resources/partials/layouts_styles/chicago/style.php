<?php
$fonts = hotello_get_font();
$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

/*Default layout styles*/
$default = hotello_get_layout_config();

$main_color = hotello_get_option('main_color', $default['main_color']);
$secondary_color = hotello_get_option('secondary_color', $default['secondary_color']);
$third_color = hotello_get_option('third_color', $default['third_color']);
?>

.stm_loop__single_grid_style_1 .stm_read_more_link.btn:before {
    background-color: <?php echo esc_attr($main_color) ?> !important;
}

.stm_single_post_style_1 .stm_read_more_link.btn,
.stm_loop__single_grid_style_1 .stm_read_more_link.btn {
    color: <?php echo esc_attr($main_color) ?> !important;
}

.stm_header_style_1 .stm-dropdown .dropdown-menu li a {
    color: <?php echo esc_attr($third_color) ?> !important;
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

.stm_layout_chicago .btn, .vc_btn3 {
    font-family: <?php echo wp_kses_post($secondary_font['name']); ?> !important;
}

.datepicker-form .datepicker-input-select-wrapper table th, .datepicker-form .datepicker-input-select-wrapper table td {
    font-size: 11px;
}

.hotelier-listing .listing__list .room__max-guests .room__max-guests-label {
    margin-right: 4px;
}

.widget-booking.widget--hotelier .widget-booking__room-item {
    border: 0 !important;
}

.stm-single-room__sidebar .datepicker{
    right: 0;
}

.widget-booking.widget--hotelier .widget-booking__date {
    white-space: nowrap;
}

.widget-booking.widget--hotelier .widget-booking__cart-total strong {
    opacity: 0.8;
}

.widget-booking.widget--hotelier .widget-booking__wrapper .widget-booking__change-cart {
    left: 30px;
    transform: none;
}

.widget-booking.widget--hotelier .widget-booking__change-cart>a {
    color: #fff !important;
}

@media (max-width: 768px) {
    .stm-room__container .stm-room {
        margin-bottom: 0;
    }

    .stm-room__container .stm-room__content {
        padding: 28px 20px 35px;
    }

    .stm_iconbox_style_1 .stm_iconbox__icon {
        position: relative;
        top: 5px;
    }
}

@media (max-width: 550px) {
    .datepicker__topbar {
        margin-bottom: 20px;
        text-align: center;
    }
    .datepicker__topbar .datepicker__info--selected {
        margin-bottom: 15px;
    }
    .stm-single-room__sidebar .datepicker{
        right: -15px;
        left: -15px;
        width: auto;
    }
    .hotelier .guest-details-fields .form-row {
        width: 100% !important;
    }

    .booking__section--guest-additional-information {
        margin-top: 30px;
    }

    .room__non-cancellable-info {
        text-align: left !important;
    }

    .hotelier-listing .listing__list .room__max-guests-recommendation {
        margin-top: 8px !important;
    }

    .hotelier-listing .listing__list .room__info {
        padding-bottom: 20px;
    }

    .hotelier-listing .listing__list .room__name a {
        margin-bottom: 15px !important;
    }
}