<?php
/**
 * Room max guests
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/max-guests.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $room;

$max_guests = $room->get_max_guests();
$max_children = $room->get_max_children();

?>

<div class="room__max-guests">
    <i class="stmicon-hotel-peoples mtc"></i>
    <span class="room__max-guests-label"><?php esc_html_e('Occupancy:', 'hotello'); ?></span>
    <div class="room__max-guests-recommendation">

        <?php printf(esc_html__('%s adult(s)', 'hotello'), absint($max_guests)); ?>
        <?php if ($max_children > 0) {
            printf(esc_html__('and %s child(ren)', 'hotello'), absint($max_children));
        }
        ?>
    </div>
</div>
