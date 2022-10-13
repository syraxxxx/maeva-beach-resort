<?php
/**
 * Room meta.
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/meta.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $room;

?>

<div class="room__meta room__meta--single">

    <h3 class="room__meta-title room__meta-title--single"><?php esc_html_e('Room details', 'hotello'); ?></h3>

    <ul class="room__meta-list room__meta-list--single">
        <li class="room__meta-item room__meta-item--guests">
            <span><?php esc_html_e('Guests:', 'hotello'); ?></span>
            <strong><?php echo absint($room->get_max_guests()); ?></strong>
        </li>

        <?php if ($room->get_max_children()) : ?>
            <li class="room__meta-item room__meta-item--children">
                <span><?php esc_html_e('Children:', 'hotello'); ?></span>
                <strong><?php echo absint($room->get_max_children()); ?></strong>
            </li>
        <?php endif; ?>

        <?php if ($room->get_formatted_room_size()) : ?>
            <li class="room__meta-item room__meta-item--size">
                <span><?php esc_html_e('Room size:', 'hotello'); ?></span>
                <strong><?php echo esc_html($room->get_formatted_room_size()); ?></strong>
            </li>
        <?php endif; ?>

        <?php if ($room->get_bed_size()) : ?>
            <li class="room__meta-item room__meta-item--bed-size">
                <span><?php esc_html_e('Bed size(s):', 'hotello') ?></span>
                <strong><?php echo esc_html($room->get_bed_size()); ?></strong>
            </li>
        <?php endif; ?>

        <?php if ($room_categories = $room->get_categories()) : ?>
            <li class="room__meta-item room__meta-item--type">
                <span><?php echo esc_html__('Room type', 'hotello'); ?></span>
                <strong><?php echo wp_kses_post($room_categories); ?></strong>
            </li>
        <?php endif; ?>
    </ul>

</div>
