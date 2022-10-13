<?php
/**
 * @var $this WPBakeryShortCode_Stm_Wp_Hotelier_Selective_Rooms_Carousel
 */
$rooms = $this->get_rooms();

$per_row = (!empty($this->atts['per_row'])) ? $this->atts['per_row'] : 4;
$per_row_sm = (!empty($this->atts['per_row_sm'])) ? $this->atts['per_row_sm'] : 2;
$img_size = '370x250';
if(!empty($this->atts['img_size'])){
    $img_size = $this->atts['img_size'];
}
if ($rooms->have_posts()) : ?>
    <div class="<?php echo implode($this->get_classes(), ' '); ?>"
         data-per-row="<?php echo esc_attr($per_row); ?>"
         data-per-row-sm="<?php echo esc_attr($per_row_sm); ?>">
        <?php while ($rooms->have_posts()) : $rooms->the_post();
            $room_id = get_the_ID();
            $image = hotello_get_VC_post_img_safe($room_id, $img_size);
            ?>
            <div class="stm-room stm-room__carousel">
                <div class="stm-room__image">
                    <?php echo hotello_sanitize_image($image); ?>
                </div>
                <div class="stm-room__content">
                    <div class="stm-room__title">
                        <h4><?php echo hotello_truncate_text(get_the_title(), 25, '...', true); ?></h4>
                    </div>
                    <div class="stm-room__occupancy">
                        <?php echo wp_kses_post($this->get_occupancy_html($room_id)) ?>
                    </div>
                    <div class="stm-room__excerpt">
                        <?php echo hotello_truncate_text(get_the_excerpt(), 90) ?>
                    </div>
                    <div class="stm-room__link">
                        <?php echo wp_kses_post($this->get_room_link_with_price($room_id)); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif;
wp_reset_postdata();
