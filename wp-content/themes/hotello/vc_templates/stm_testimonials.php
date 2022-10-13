<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_testimonials');
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);
$classes[] = 'stm_testimonials_' . $style;

wp_enqueue_style('hotello-owl-carousel');
wp_enqueue_script('hotello-owl-carousel');



hotello_add_element_style('testimonials', $style);

$args = array(
	'post_type'      => 'stm_testimonials',
	'posts_per_page' => intval($number),
	'post_status'    => 'publish'
);

$number_row = (empty($number_row)) ? '1' : $number_row;

$q = new WP_Query($args);

/*Carousel or not*/
$carousel = (hotello_check_string($carousel)) ? true : false;
$row_class = 'owl-carousel';
$item_classes = 'stm_testimonials__item stm_owl__glitches stc_b';
if (!$carousel) {
	$item_wrapper = 'col-md-' . intval(12 / $list_number_row) . ' col-sm-6 col-xs-12';
	$item_classes = 'stm_testimonials__item col-md-12 stm_mgb_30';
	$row_class = 'row';
	$classes[] = 'stm_testimonials_list_style';
}

$loop = 'false';

if (!empty($number)) {
	$loop = $number > 1 ? 'true' : 'false';
} else {
	$loop = $q->post_count > 1 ? 'true' : 'false';
}

if ($q->have_posts()):
	$id = uniqid('stm_testimonial__carousel_');
	?>
    <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
		<?php
		if (!empty($title)) {
			echo "<h2 class='stm_testimonials__title h1'>{$title}</h2>";
			echo "<div class='title_sep mbdc_b mbdc_a'><div class='mtc title_sep__icon'></div></div>";
		}
		?>
        <div class="stm_testimonial__carousel <?php echo esc_attr($row_class); ?>" id="<?php echo esc_attr($id) ?>">
			<?php while ($q->have_posts()): $q->the_post();
				$post_id = get_the_ID();
				$review = get_post_meta($post_id, 'review', true);
				$name = get_post_meta($post_id, 'stm_default_title', true);
				$position = get_post_meta($post_id, 'company', true);
				$image = hotello_get_VC_img(get_post_thumbnail_id($post_id), $img_size);
				if (!empty(intval($crop))) $review = hotello_truncate_text($review, intval($crop));
				?>
				<?php if (!$carousel): ?>
                    <div class="<?php echo esc_attr($item_wrapper); ?>">
				<?php endif; ?>
                <div <?php post_class($item_classes); ?>>
                    <div class="stm_testimonials__review mtc_b mtc_a"><?php echo wp_kses_post($review); ?></div>
                    <div class="stm_testimonials__meta stm_testimonials__meta_left stm_testimonials__meta_align-center">


						<?php if (!empty($image) and $show_image == 'true') : ?>
                            <div class="stm_testimonials__avatar stm_testimonials__avatar_rounded mtc_b">
                                <div class="stm_testimonials__avatar_pseudo"></div>
								<?php echo html_entity_decode($image); ?>
                            </div>
						<?php endif; ?>

                        <div class="stm_testimonials__info">
							<?php if (!empty($name)): ?>
                                <h5 class="no_line text-transform"><?php echo sanitize_text_field($name); ?></h5>
							<?php endif; ?>
							<?php if (!empty($position)): ?>
                                <h6 class="no_line text-transform"><?php echo sanitize_text_field($position); ?></h6>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
				<?php if (!$carousel): ?>
                    </div>
				<?php endif; ?>
			<?php endwhile; ?>
        </div>
    </div>

	<?php if ($carousel): ?>
    <?php
	$number_row_mobile = (esc_attr($number_row > 1)) ? 2 : $number_row;
    wp_add_inline_script('hotello-app', "
        (function ($) {
            'use strict';
            var owl = $('#{$id}');
            var loop = {$loop};

            $(document).ready(function () {
                var owlRtl = false;
                if ($('body').hasClass('rtl')) {
                    owlRtl = true;
                }

                owl.owlCarousel({
                    rtl: owlRtl,
                    items: 1,
                    responsive: {
                        0: {
                            items: 1,
                        },
                        650: {
                            items: {$number_row_mobile}
                        },
                        1200: {
                            items: {$number_row}
                        }
                    },
                    dots: {$bullets},
                    autoplay: {$autoscroll},
                    nav: {$arrows},
                    navText: [],
                    margin: {$margin},
                    slideBy: 1,
                    smartSpeed: 700,
                    loop: loop,
                    center: {$center_mode}
                });
            });
        })(jQuery);
    "); ?>
<?php endif; ?>

	<?php wp_reset_postdata(); ?>
<?php endif; ?>