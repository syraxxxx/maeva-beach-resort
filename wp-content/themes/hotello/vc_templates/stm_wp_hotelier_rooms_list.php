<?php
if (!defined('ABSPATH')) {
	die('-1');
}

/**
 * @var $this WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_List
 */

$this->set_vars($atts);
$set_args = array();


if (!empty($atts['per_page'])) $set_args['posts_per_page'] = $atts['per_page'];
$classes = $this->get_module_classes();
$types = $this->get_rooms_types(); ?>

<div <?php post_class($classes) ?>>
    <div class="stm-rooms-types">
		<?php $this->rooms_types_filter(); ?>
    </div>

    <div class="room-list-wrapper">
		<?php if (!empty($types)): ?>
			<?php foreach ($types as $type) {
				$set_args['room_type'] = $type['slug'];
				$rooms = $this->get_rooms($set_args); ?>


				<?php if ($rooms->have_posts()): ?>

                    <div class="stm-rooms-list <?php echo esc_attr($type['slug']); ?>">
						<?php while ($rooms->have_posts()) {
							$rooms->the_post();
							$this->single_room();
						} ?>
                    </div>

				<?php endif; ?>

				<?php wp_reset_postdata();
			}
		endif; ?>
    </div>
</div>


