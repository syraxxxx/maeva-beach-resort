<?php
/**
 * Room facilities.
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/facilities.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $room;
$facilities_terms = get_the_terms($room->id, 'room_facilities');
?>

<?php if ($facilities_terms && !is_wp_error($facilities_terms)) :
    ?>

    <ul class="room__facilities room__facilities--single">

        <?php foreach ($facilities_terms as $facility_term) :
            $icon = get_term_meta($facility_term->term_id, 'room_facilities_icon', true);
            ?>
            <li class="room__facilities-content room__facilities-content--single mtc_b">
                <?php if ($icon) : ?>
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php endif; ?>
                <span><?php echo wp_kses_post($facility_term->name); ?></span>
            </li>
        <?php endforeach; ?>

    </ul>

<?php endif; ?>
