<?php
/**
 * Reservation item details
 *
 * This template can be overridden by copying it to yourtheme/hotelier/reservation/item.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

?>

<tr class="reservation-table__row reservation-table__row--body">
    <td class="reservation-table__room-name reservation-table__room-name--body"><?php
        $is_visible = $room && $room->is_visible(true);

        echo esc_attr($is_visible) ? sprintf('<a class="reservation-table__room-link" href="%s">%s</a>', esc_url(get_permalink($item['room_id'])), $item['name']) : $item['name'];

        if (isset($item['rate_name'])) : ?>
            <small class="reservation-table__room-rate"><?php printf(esc_html__('Rate: %s', 'hotello'), htl_get_formatted_room_rate($item['rate_name'])); ?></small>
        <?php endif;

        if (!$item['is_cancellable']) : ?>
            <span class="reservation-table__room-non-cancellable"><?php esc_html_e('Non-refundable', 'hotello'); ?></span>
        <?php endif;

        // Show adults/children guests
        htl_get_template('reservation/item-guests.php', array(
            'quantity' => $item['qty'],
            'adults' => maybe_unserialize($item['adults']),
            'children' => maybe_unserialize($item['children']),
        ));

        // Allow other plugins to add additional room information here
        do_action('hotelier_reservation_item_meta', $item_id, $item, $reservation);
        ?>
    </td>
    <td class="reservation-table__room-qty reservation-table__room-qty--body"><?php echo esc_html($item['qty']); ?></td>
    <td class="reservation-table__room-cost reservation-table__room-cost--body"><?php echo esc_attr($reservation->get_formatted_line_total($item)); ?></td>
</tr>
