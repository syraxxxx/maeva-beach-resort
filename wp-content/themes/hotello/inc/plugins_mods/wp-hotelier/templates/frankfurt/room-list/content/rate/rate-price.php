<?php
/**
 * Room rate price
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/rate/rate-price.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @var $variation Hotel_Room_Vartiation
 */
global $room;
$variation = new Hotel_Room_Vartiation($variation->variation, $room);
if (($price_html = $variation->get_final_price($checkin, $checkout)) && apply_filters('hotelier_show_rate_price', true, $checkin, $checkout, $variation)) : ?>

    <div class="rate__price rate__price--listing">
        <span class="rate__price rate__price--listing heading_font"><?php echo wp_kses_post($price_html); ?></span>
    </div>

<?php endif; ?>
