<?php
/**
 * Room desposit
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/deposit.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $room; ?>
<div class="room__deposit room__deposit--listing">
    <?php

    if (!$room->is_variable_room()) : ?>

        <?php if ($room->needs_deposit()) : ?>
            <span class="room__deposit-label room__deposit-label--listing"><?php esc_html_e('Deposit required', 'hotello'); ?></span>
            <span class="room__deposit-amount room__deposit-amount--listing"><?php echo wp_kses($room->get_formatted_deposit(), array('span' => array('class' => array()))); ?></span>
        <?php else : ?>
            <span class="room__deposit-label room__deposit-label--listing"><?php esc_html_e('Deposit not required', 'hotello'); ?></span>
        <?php endif; ?>
    <?php else :
        $need_deposit = false;
        $variations = $room->get_room_variations();
        foreach ($variations as $variation) {
            $variation = new HTL_Room_Variation($variation, $room);
            if ($variation->needs_deposit()) {
                $need_deposit = true;
            }
        }
        if ($need_deposit) :
            ?>
            <span class="room__deposit-label room__deposit-label--listing"><?php esc_html_e('Deposit may be required', 'hotello'); ?></span>
        <?php else : ?>

            <span class="room__deposit-label room__deposit-label--listing"><?php esc_html_e('Deposit not required', 'hotello'); ?></span>
        <?php
        endif;
    endif; ?>
</div>
