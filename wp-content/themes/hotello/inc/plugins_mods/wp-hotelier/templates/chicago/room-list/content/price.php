<?php
/**
 * Room price
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/price.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (array_key_exists( 'seasonal_price', get_option('stm_theme_options') )) {
    $seasonal_price_option = get_option('stm_theme_options')['seasonal_price'];
} else {
    $seasonal_price_option = false;
}

global $room;

$checkin_date = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$nights = $checkin_date->diff($checkout_date)->days;
$room = new Hotel_Room($room->id);

if ($price = $room->get_min_price($checkin, $checkout)) :

    if ($seasonal_price_option === 'true') {
        $price = $room->get_min_price($checkin, $checkout);
    } else {
        $price = $room->get_final_price($checkin, $checkout);
    }
    $price = htl_price($price);

    ?>

    <div class="room__price-wrapper room__price-wrapper--listing">
        <span class="room__price-nights">
            <?php
                if ($seasonal_price_option === 'false') {
                    echo sprintf(esc_html__('Price for %s night(s)', 'hotello'), $nights);
                } else {
                    echo esc_html__('Price per night', 'hotello');
                }
            ?>
        </span>

        <span class="room__price room__price--listing heading_font">
            <?php if ($room->is_variable_room()) : ?>
                <small><?php echo esc_html__('From', 'hotello'); ?></small>
            <?php endif; ?>
            <?php echo wp_kses_post($price); ?>
        </span>

        <?php
        /**
         * hotelier_room_list_item_before_add_to_cart hook
         *
         * @hooked hotelier_template_loop_room_non_cancellable_info - 10
         */
        do_action('hotelier_room_list_item_before_add_to_cart');
        ?>
    </div>

<?php endif; ?>
