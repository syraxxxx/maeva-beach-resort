<?php
/**
 * Room gallery.
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/gallery.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * @var $room HTL_Room
 */
global $room;

wp_enqueue_script('stm_rooms_slider');
wp_enqueue_style('hotello-owl-carousel');

$gallery_images = array();

$attachment_ids = $room->get_gallery_attachment_ids();

if ($attachment_ids) :
    $i = 0; ?>

    <div class="stm-rooms-slider owl-carousel">
        <?php foreach ($attachment_ids as $attachment_id) :
            $image = hotello_get_VC_attachment_img_safe($attachment_id, '770x430');
            ?>
            <div class="stm-rooms-slider__image">
                <?php echo hotello_sanitize_image($image); ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

