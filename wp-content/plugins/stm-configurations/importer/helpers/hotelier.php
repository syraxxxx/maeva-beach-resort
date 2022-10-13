<?php

function stm_update_hotelier_options($layout)
{
	$rooms_page = array(
		'Rooms',
		'Rooms list'
	);

	foreach($rooms_page as $room_page) {
		$room_page = get_page_by_title($room_page);
		if (isset($room_page->ID)) {
			$settings = get_option('hotelier_settings', array());
			$settings['listing_page'] = $room_page->ID;

			update_option('hotelier_listing_page_id', $room_page->ID);

			$booking_page = get_page_by_title('Booking');
			if (isset($booking_page->ID)) {
				$settings['booking_page'] = $booking_page->ID;
				update_option('hotelier_booking_page_id', $room_page->ID);
			}

			update_option('hotelier_settings', $settings);
		}
	}
}