<?php
/**
 * Room name
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/title.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_the_title();
$title_max_length = 25;
$title_length = mb_strlen($title);
$long_title = $title_length > $title_max_length;

?>

<h3 class="room__name room__name--listing">
    <a
        <?php if ($long_title) : ?>
            data-toggle="tooltip"
        <?php endif; ?>
            title="<?php the_title_attribute() ?>"
            class="room__link room__link--listing"
            href="<?php the_permalink(); ?>"
            rel="bookmark">
        <?php echo hotello_truncate_text($title, $title_max_length); ?>
    </a>
</h3>
