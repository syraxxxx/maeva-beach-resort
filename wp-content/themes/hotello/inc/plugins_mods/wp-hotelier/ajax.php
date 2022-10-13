<?php

function hotello_ajax_get_rooms()
{
    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $room_type = !empty($_GET['room_type']) ? $_GET['room_type'] : false;
    $per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : false;
    $rooms_data = new Hotel_Room(false);
    $rooms = $rooms_data->get_rooms($page, $room_type, array(
        'posts_per_page' => $per_page
    ));
    ob_start();
    if ($rooms->have_posts()) {
        while ($rooms->have_posts()) {
            $rooms->the_post();
            $rooms_data->single_room(get_the_ID());
        }
        wp_reset_postdata();
    }

    $response = ob_get_clean();

    wp_send_json($response);
}

add_action('wp_ajax_get_rooms', 'hotello_ajax_get_rooms');
add_action('wp_ajax_nopriv_get_rooms', 'hotello_ajax_get_rooms');

function hotello_ajax_check_room_availability()
{
    check_ajax_referer('hotello_ajax_check_room_availability', 'security');
    $res = esc_html__('Room is not available', 'hotello');
    $error = true;
    if (!empty($_GET['room_id']) && !empty($_GET['check_in'] && !empty($_GET['check_out']))) {
        $room_id = intval($_GET['room_id']);
        $checkin = sanitize_text_field($_GET['check_in']);
        $checkout = sanitize_text_field($_GET['check_out']);
        $quantity = 1;
        $room = htl_get_room($room_id);
        $cart = new HTL_Cart();


        $room_data = new Hotel_Room($room_id);
        $available = $room_data->is_available($checkin, $checkout);
        if ($available) {
            $res = esc_html__('Room is available', 'hotello');
            $error = false;
        }
        if (isset($cart->cart_contents_quantity[$room_id])) {
            $real_qty = $cart->cart_contents_quantity[$room_id] + $quantity;
        } else {
            $real_qty = $quantity;
        }
        if ($room->get_stock_rooms() < $real_qty) {
            $res = esc_html__('Already booked. Check your cart - ', 'hotello') . htl_get_page_permalink('booking');
            $error = true;
        }

    }

    wp_send_json(array(
        'error' => $error,
        'message' => $res
    ));
}

add_action('wp_ajax_check_room_availability', 'hotello_ajax_check_room_availability');
add_action('wp_ajax_nopriv_check_room_availability', 'hotello_ajax_check_room_availability');


function hotello_ajax_book_room()
{
    check_ajax_referer('hotello_ajax_book_room', 'security');
    $response = false;
    if (!empty($_GET['room_id']) && !empty($_GET['check_in']) && !empty($_GET['check_out'])) {

        $room_id = sanitize_text_field($_GET['room_id']);
        $rate_id = 0;
        $checkin = sanitize_text_field($_GET['check_in']);
        $checkout = sanitize_text_field($_GET['check_out']);

        do_action('hotelier_set_cookies', true);

        if (HTL_Formatting_Helper::is_valid_checkin_checkout($checkin, $checkout)) {

            HTL()->session->set('checkin', $checkin);
            HTL()->session->set('checkout', $checkout);

        } else {

            $dates = htl_get_default_dates();

            HTL()->session->set('checkin', $dates['checkin']);
            HTL()->session->set('checkout', $dates['checkout']);
        }


        if (!empty($_GET['rate_id'])) {
            $rate_id = $_GET['rate_id'];
        }

        $htl_cart = new HTL_Cart();
        $htl_cart->init();
        $response = $htl_cart->add_to_cart($room_id, 1, $rate_id);
        HTL()->session->set('htl_notices', false);
    }

    wp_send_json($response);
}

add_action('wp_ajax_book_room', 'hotello_ajax_book_room');
add_action('wp_ajax_nopriv_book_room', 'hotello_ajax_book_room');
