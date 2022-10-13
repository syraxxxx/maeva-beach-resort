<?php
if (!defined('ABSPATH')) {
    exit;
}


wp_enqueue_script('hotello-owl-carousel');
wp_enqueue_script('hotel_wp_hotelier_rooms_carousel/carousel');
wp_enqueue_style('hotello-owl-carousel');

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_wp_hotelier_rooms_carousel stm_wp_hotelier_rooms_carousel_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

hotello_add_element_style('wp_hotelier_rooms_carousel');

$classes[] = !empty($contrast) ? 'stm_contrast' : '';

$rooms = new WP_Query(
    array(
        'post_type' => 'room',
        'posts_per_page' => -1
    )
);
$rooms_categories = array();
$rooms_by_categories = array();
/**
 * @var $room WP_Post
 */
foreach ($rooms->posts as $room) {
    $room_categories = wp_get_post_terms(
        $room->ID, 'room_cat'
    );

    /**
     * @var $room_category WP_Term
     */
    foreach ($room_categories as $room_category) {
        $category_data = array(
            'name' => $room_category->name,
            'slug' => $room_category->slug
        );
        if (!in_array($category_data, $rooms_categories)) {
            $rooms_categories[] = $category_data;
        }
        $rooms_by_categories[$room_category->slug][] = $room;
    }
}


if ($rooms->have_posts()) :
    ?>
    <div class="<?php echo implode(' ', $classes); ?>">
        <div class="stm_wp_hotelier_rooms_carousel__head">
            <?php if (!empty($title)) : ?>
                <div class="stm_wp_hotelier_rooms_carousel__title">
                    <h2>
                        <?php echo wp_kses_post($title); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <ul class="stm_wp_hotelier_rooms_carousel__categories" role="tablist">
                <?php foreach ($rooms_categories as $rooms_category) : ?>
                    <li role="presentation"
                        class="stm_wp_hotelier_rooms_carousel__category<?php echo esc_attr($rooms_categories[0] === $rooms_category ? ' active' : ''); ?>">
                        <a href="#room_cat_<?php echo wp_kses_post($rooms_category['slug']); ?>"
                           class="ttc no_deco mbc_a no_scroll"
                           aria-controls="room_cat_<?php echo wp_kses_post($rooms_category['slug']); ?>"
                           role="tab"
                           data-toggle="tab">
                            <?php echo wp_kses_post($rooms_category['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="tab-content stm_wp_hotelier_rooms_carousel__rooms">
            <?php
            $counter = 0;
            foreach ($rooms_by_categories as $category => $rooms) : ?>

                <div role="tabpanel"
                     class="stm_wp_hotelier_rooms_carousel__tab fade tab-pane<?php echo esc_attr($counter === 0 ? ' active in' : ''); ?>"
                     id="room_cat_<?php echo esc_attr($category); ?>">
                    <div class="stm_wp_hotelier_rooms_carousel__carousel">
                        <?php
                        foreach ($rooms as $room) :
                            /**
                             * @var $room HTL_Room
                             */
                            $room_htl_data = hotello_get_room($room->ID);
                            $max_guests = $room_htl_data->get_max_guests();
                            $max_children = $room_htl_data->get_max_children();
                            $price = htl_price($room_htl_data->get_min_price());
                            if ($room_htl_data->is_variable_room()) {
                                $price = sprintf(__('<span>From</span> %s', 'hotello'), $price);
                            }
                            ?>
                            <div class="room">
                                <div class="room__image">
                                    <?php echo hotello_get_VC_post_img_safe($room->ID, '370x200'); ?>
                                    <div class="room__price mbc heading_font">
                                        <?php
                                            $night = esc_html__('/Night', 'hotello');
                                            echo sprintf('<span>%s</span>' . $night, $price);
                                        ?>
                                    </div>
                                    <div class="room__link">
                                        <a href="<?php the_permalink($room->ID); ?>"
                                           class="btn btn_white btn_outline btn_icon btn_icon-right">
                                            <?php _e('Check details', 'hotello') ?>
                                            <i class="btn__icon stmicon-keyboard_arrow_right"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="room__content">
                                    <div class="room__title">
                                        <h4>
                                            <a class="ttc no_deco mtc_h" href="<?php the_permalink($room->ID); ?>">
                                                <?php echo wp_kses_post($room->post_title); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="room__excerpt ttc">
                                        <?php echo hotello_truncate_text(get_the_excerpt($room->ID), 80); ?>
                                    </div>
                                    <div class="room__occupancy">
                                        <span><i class="stmicon-hotel-peoples mtc"></i><?php echo esc_html__('Occupancy', 'hotello') . ':'; ?></span>
                                        <span>
                                <?php
                                echo sprintf(__('%1s adult(s)', 'hotello'), $max_guests);
                                if (!empty($max_children)) {
                                    echo ' ' . __('and', 'hotello') . ' ' . sprintf(__('%1s child(ren)', 'hotello'), $max_children);
                                }
                                ?>
                            </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                $counter++;
            endforeach;
            ?>
        </div>
    </div>
<?php
endif;
wp_reset_postdata();
