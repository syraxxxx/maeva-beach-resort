<?php
/**
 * The template for displaying room content in the single-room.php template
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/content-single-room.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
hotello_get_titlebox();

?>

<?php
/**
 * hotelier_before_single_room hook.
 *
 * @hooked htl_print_notices - 10
 */
do_action('hotelier_before_single_room');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>

<div id="room-<?php echo absint(get_the_ID()); ?>" <?php post_class(); ?>>

    <div class="stm-single-room__content">

        <div class="stm-single-room__intro">
            <?php
            /**
             * hotelier_single_room_title hook.
             *
             * @hooked hotelier_template_single_room_title - 10
             */
            //do_action('hotelier_single_room_title');
            ?>

            <?php // htl_get_template_part('single-room/room-icon-info'); ?>

            <?php
            /**
             * hotelier_single_room_images hook.
             *
             * @hooked hotelier_template_single_room_image - 10
             * @hooked hotelier_template_single_room_gallery - 20
             */
            do_action('hotelier_single_room_images');
            ?>

        </div>

        <div class="entry-content room__content room__content--single">

            <div class="room__details room__details--single">
                <?php
                /**
                 * hotelier_single_room_details hook.
                 *
                 * @hooked hotelier_template_single_room_non_cancellable_info - 15
                 * @hooked hotelier_template_single_room_deposit - 20
                 * @hooked hotelier_template_single_room_min_max_info - 25
                 * @hooked hotelier_template_single_room_facilities - 30
                 * @hooked hotelier_template_single_room_description - 35
                 * @hooked hotelier_template_single_room_meta - 40
                 * @hooked hotelier_template_single_room_conditions - 50
                 * @hooked hotelier_template_single_room_sharing - 60
                 */
                do_action('hotelier_single_room_details');
                ?>

            </div>

            <?php
            /**
             * hotelier_single_room_rates hook.
             *
             * @hooked hotelier_template_single_room_rates - 10
             */
            do_action('hotelier_single_room_rates');
            ?>
        </div>
    </div>

    <div class="stm-single-room__sidebar">

        <?php
        /**
         * hotelier_sidebar hook.
         *
         * @hooked hotel_hotelier_room_sidebar - 10
         */
        do_action('hotelier_sidebar');
        ?>
    </div>


</div>