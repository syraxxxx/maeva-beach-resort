<?php
/**
 * Booking details
 *
 * This template can be overridden by copying it to yourtheme/hotelier/booking/reservation-details.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

?>

<div id="reservation-details" class="booking__section booking__section--reservation-details">

    <header class="section-header">
        <h3 class="section-header__title"><?php esc_html_e('Booking details', 'hotello'); ?></h3>
    </header>

    <?php do_action('hotelier_booking_before_booking_details'); ?>

    <table class="table table--reservation-table reservation-table reservation-table--reservation-details hotelier-table">
        <tbody class="reservation-table__body">
        <tr class="reservation-table__row reservation-table__row--body">
            <th class="reservation-table__label"><?php esc_html_e('Check-in', 'hotello'); ?></th>
            <td class="reservation-table__data"><?php echo esc_html($checkin); ?></td>
        </tr>
        <tr class="reservation-table__row reservation-table__row--body">
            <th class="reservation-table__label"><?php esc_html_e('Check-out', 'hotello'); ?></th>
            <td class="reservation-table__data"><?php echo esc_html($checkout); ?></td>
        </tr>
        <?php if (apply_filters('hotelier_show_pets_message', true)) : ?>
            <tr class="reservation-table__row reservation-table__row--body">
                <th class="reservation-table__label"><?php esc_html_e('Pets', 'hotello'); ?></th>
                <td class="reservation-table__data"><?php echo esc_html($pets_message); ?></td>
            </tr>
        <?php endif; ?>


        </tbody>
    </table>

    <?php do_action('hotelier_booking_after_booking_details'); ?>

</div>
