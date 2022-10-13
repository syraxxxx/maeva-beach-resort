<?php

if (!defined('ABSPATH')) {
    exit;
}


if (class_exists('Hotelier')) {
    require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/class-hotel-room.php';
    require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/class-hotel-room-variation.php';
}


require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/filters.php';
require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/actions.php';
require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/enqueue.php';
require_once HOTELLO_INCLUDE_PATH . '/plugins_mods/wp-hotelier/ajax.php';


function hotello_room_occupancy($id)
{
    $room_htl_data = htl_get_room($id);
    $max_guests = $room_htl_data->get_max_guests();
    $max_children = $room_htl_data->get_max_children();

    echo esc_html__('Occupancy', 'hotello');
    echo sprintf(__('%1s adult(s)', 'hotello'), $max_guests);
    if (!empty($max_children)) {
        echo ' ' . __('and', 'hotello') . ' ' . sprintf(__('%1s child(ren)', 'hotello'), $max_children);
    }
}


if (class_exists('WPBakeryShortCode')) {
    $modules_path = get_template_directory() . '/inc/plugins_mods/wp-hotelier/vc-modules';
    $modules = array(
        'wp_hotelier_form',
        'wp_hotelier_rooms_filter',
        'wp_hotelier_rooms_carousel',
        'wp_hotelier_rooms_list',
        'wp_hotelier_widget_booking',
        'wp_hotelier_selective_rooms_carousel',
    );
    foreach ($modules as $module) {
        hotello_require($modules_path . '/' . $module . '.php');
    }
}


function hotello_get_room($room)
{
    return new Hotel_Room($room);
}










