<?php

if (!defined('ABSPATH')) {
    exit;
}

global $room;
$room = new Hotel_Room($room->id);
if (!$room->is_variable_room()) :
    if ($room->is_on_sale($checkin, $checkout)) :
        $sale_price = $room->get_sale_price($checkin, $checkout);
        $regular_price = $room->get_regular_price($checkin, $checkout);
        $percent = absint(100 - ($sale_price / $regular_price) * 100);

        ?>
        <div class="room__sale-price-badge">
        <span>
        -%<?php echo wp_kses_post($percent); ?>
        </span>
        </div>

    <?php
    endif;
else:
    $variations_sale = false;
    $variations = $room->get_room_variations();
    foreach ($variations as $variation) {
        $variation = new HTL_Room_Variation($variation, $room);
        if ($variation->is_on_sale($checkin, $checkout)) {
            $variations_sale = true;
        }
    }
    if ($variations_sale) : ?>
        <div class="room__sale-price-badge">
            <span><?php echo esc_html__('Sale', 'hotello'); ?></span>
        </div>
    <?php endif;

endif;
?>
