<?php
/**
 * Room facilities
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/facilities.php.
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

<?php if ($facilities = $room->get_facilities()) : ?>

    <div class="room__meta room__meta--listing">

        <p class="room__facilities room__facilities--listing">
            <strong><?php esc_html_e('Room facilities:', 'hotello'); ?></strong> <?php echo wp_kses_post($facilities); ?>
        </p>

    </div>

<?php endif; ?>
