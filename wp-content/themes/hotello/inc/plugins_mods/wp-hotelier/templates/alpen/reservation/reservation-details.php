<?php
/**
 * Reservation details
 *
 * This template can be overridden by copying it to yourtheme/hotelier/reservation/reservation-details.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<header class="section-header">
    <h3 class="section-header__title"><?php esc_html_e('Booking details', 'hotello'); ?></h3>
</header>

<ul class="reservation-details__list">
    <li class="reservation-details__item reservation-details__item--number">
        <span class="reservation-details__label reservation-details__label--number"><?php esc_html_e('Reservation number:', 'hotello'); ?></span>
        <strong class="reservation-details__data reservation-details__data--number"><?php echo esc_attr($reservation->get_reservation_number()); ?></strong>
    </li>
    <li class="reservation-details__item reservation-details__item--date">
        <span class="reservation-details__label reservation-details__label--date"><?php esc_html_e('Date:', 'hotello'); ?></span>
        <strong class="reservation-details__data reservation-details__data--date"><?php echo esc_attr(date_i18n(get_option('date_format'), strtotime($reservation->reservation_date))); ?></strong>
    </li>
    <li class="reservation-details__item reservation-details__item--checkin">
        <span class="reservation-details__label reservation-details__label--checkin"><?php esc_html_e('Check-in:', 'hotello'); ?></span>
        <strong class="reservation-details__data reservation-details__data--checkin"><?php echo esc_html($reservation->get_formatted_checkin()); ?>
            <span>(<?php echo esc_html(HTL_Info::get_hotel_checkin()); ?>)</span></strong>
    </li>
    <li class="reservation-details__item reservation-details__item--checkout">
        <span class="reservation-details__label reservation-details__label--checkout"><?php esc_html_e('Check-out:', 'hotello'); ?></span>
        <strong class="reservation-details__data reservation-details__data--checkout"><?php echo esc_html($reservation->get_formatted_checkout()); ?>
            <span>(<?php echo esc_html(HTL_Info::get_hotel_checkout()); ?>)</span></strong>
    </li>
    <li class="reservation-details__item reservation-details__item--nights">
        <span class="reservation-details__label reservation-details__label--nights"><?php esc_html_e('Nights:', 'hotello'); ?></span>
        <strong class="reservation-details__data reservation-details__data--nights"><?php echo esc_html($reservation->get_nights()); ?></strong>
    </li>
    <li class="reservation-details__item reservation-details__item--special-requests">
        <strong class="reservation-details__label reservation-details__label--special-requests"><?php esc_html_e('Special requests:', 'hotello'); ?></strong>
        <span class="reservation-details__data reservation-details__data--special-requests"><?php echo esc_html($reservation->get_guest_special_requests() ? $reservation->get_guest_special_requests() : esc_html__('None', 'hotello')); ?></span>
    </li>
</ul>
