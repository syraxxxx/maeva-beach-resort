<?php
if (!defined('ABSPATH')) {
	exit;
}

$id = get_the_ID();
$room = new Hotel_Room($id);

$info = array(
	'guest' => $room->get_max_guests(),
	'nipple' => $room->get_max_children(),
	'bed2' => $room->get_bed_size(),
	'ruler' => $room->get_room_size(),
);

$info_keys = array_rand($info, 3); ?>

<div class="room_info">
	<?php foreach($info_keys as $info_key): ?>
		<?php if(!empty($info[$info_key])): ?>
			<div class="room_info__single">
				<i class="mtc stmicon-<?php echo esc_attr($info_key); ?>"></i>
				<span class="ttc heading_font_family"><?php echo wp_kses_post($info[$info_key]); ?></span>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
