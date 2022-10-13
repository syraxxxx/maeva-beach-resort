<?php
/**
 * Related rooms.
 *
 * This template can be overridden by copying it to yourtheme/hotelier/single-room/related.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$room = new WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_List(array('base' => 'stm_wp_hotelier_rooms_list'));

$bg_image = get_template_directory_uri() . '/resources/assets/images/pat.png?v=10';
$types = $room->get_rooms_types();
?>

    </div>
    <div class="stm_wp_hotelier_rooms_list stm_wp_hotelier_rooms_list_style_1 stm_rooms_single_page_list"
         style="background-image: url('<?php echo esc_url($bg_image); ?>')">
        <div class="container no_vc_container">
            <h2 class="text-center"><?php esc_html_e('Room & suits', 'hotello'); ?></h2>
            <div class="stm-rooms-types">
				<?php $room->rooms_types_filter(); ?>
            </div>
            <div class="room-list-wrapper">
				<?php foreach ($types as $type) {
					$set_args = array(
						'posts_per_page' => 3,
						'room_type'      => $type['slug']
					);
					$rooms = $room->get_rooms($set_args); ?>
                    <div class="stm-rooms-list <?php echo esc_attr($type['slug']); ?>">
						<?php while ($rooms->have_posts()) {
							$rooms->the_post();
							$room->single_room();
						} ?>
                    </div>
					<?php wp_reset_postdata();
				} ?>
            </div>
        </div>
    </div>

    <div class="container no_vc_container">


<?php wp_reset_postdata();