<?php
/**
 * Room short description
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/short-description.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $post;

if (!$post->post_excerpt) {
    return;
}

?>

<div class="room__description room__description--listing">
    <?php echo apply_filters('hotelier_short_description', $post->post_excerpt) ?>
</div>

