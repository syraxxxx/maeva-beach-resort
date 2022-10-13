<?php
/**
 * The template for displaying room content within loops
 *
 * This template can be overridden by copying it to yourtheme/hotelier/archive/content-room.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $room, $hotelier_loop;

$room_id = get_the_ID();
$room_data = new Hotel_Room($room_id);
$max_guests = $room_data->get_max_guests();
$max_children = $room_data->get_max_children();
$price = $room_data->get_min_price();
if ($room_data->is_variable_room()) {
    $btn_output = sprintf(esc_html__('Book now from %s', 'hotello'), htl_price($price));
} else {
    $btn_output = sprintf(esc_html__('Book now %s', 'hotello'), htl_price($price));
}
?>
<li class="stm-room__container">
    <div class="stm-room">
        <div class="stm-room__image">
            <?php echo hotello_get_VC_post_img_safe($room_id, '370x200'); ?>
            <div class="stm-room__price mbc heading_font">
                <?php
                $night = esc_html__('/Night', 'hotello');
                $price = htl_price($price);
                echo sprintf('<span>%s</span>' . $night, $price);
                ?>
            </div>
            <div class="stm-room__link">
                <a href="<?php the_permalink(); ?>"
                   class="btn btn_white btn_outline btn_icon btn_icon-right">
                    <?php _e('Check details', 'hotello') ?>
                    <i class="btn__icon stmicon-keyboard_arrow_right"></i>
                </a>
            </div>
        </div>
        <div class="stm-room__content">
            <div class="stm-room__title">
                <h4>
                    <a class="ttc no_deco mtc_h" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h4>
            </div>
            <div class="stm-room__occupancy">
                <i class="stmicon-hotel-peoples"></i>
                <span>
                                <?php
                                echo sprintf(__('%1s adult(s)', 'hotello'), $max_guests);
                                if (!empty($max_children)) {
                                    echo ' ' . __('and', 'hotello') . ' ' . sprintf(__('%1s child(ren)', 'hotello'), $max_children);
                                }
                                ?>
                            </span>
            </div>
            <div class="stm-room__excerpt ttc">
                <?php echo hotello_truncate_text(get_the_excerpt($room_id), 80); ?>
            </div>
            <div class="stm-room__link">
                <a class="btn btn_third btn_outline btn_full-width" href="<?php the_permalink(); ?>">
                    <?php echo wp_kses_post($btn_output); ?>
                </a>
            </div>
        </div>
    </div>
</li>