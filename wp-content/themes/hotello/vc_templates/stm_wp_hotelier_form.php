<?php

if (!defined('ABSPATH')) {
	exit;
}

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$classes = array('stm_wp_hotelier_form stm_wp_hotelier_form_' . $style);
$classes[] = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '));
$classes[] = $this->getCSSAnimation($css_animation);

hotello_add_element_style('wp_hotelier_form', $style);
$hotelier_scripts = new HTL_Frontend_Scripts();
$hotelier_scripts->frontend_scripts();
wp_enqueue_script('hotelier-init-datepicker');


// extensions can hook into here to add their own pages
$datepicker_form_url = HTL()->cart->get_room_list_form_url();
$checkin = HTL()->session->get('checkin');
$checkout = HTL()->session->get('checkout');

?>

<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

	<?php if (!empty($title)) : ?>
        <h2><?php echo wp_kses_post($title); ?></h2>
	<?php endif; ?>

    <form name="hotelier_datepicker" method="post" id="hotelier-datepicker" class="datepicker-form"
          action="<?php echo esc_url($datepicker_form_url); ?>" enctype="multipart/form-data">

        <div class="form-group" data-title="<?php esc_attr_e('Arrival:', 'hotello'); ?>">
            <span class="hidden form-group-label checkin">&nbsp;</span>
            <span class="datepicker-input-select-wrapper mtc_a"><input class="datepicker-input-select" type="text"
                                                                       id="hotelier-datepicker-select" value=""
                                                                       readonly></span>
            <input type="text" id="hotelier-datepicker-checkin" class="datepicker-input datepicker-input--checkin"
                   name="checkin" value="<?php echo esc_attr($checkin); ?>">
            <input type="text" id="hotelier-datepicker-checkout" class="datepicker-input datepicker-input--checkout"
                   name="checkout" value="<?php echo esc_attr($checkout); ?>">
        </div>

        <div class="form-group hidden" data-title="<?php esc_attr_e('Departure:', 'hotello'); ?>">
            <span class="hidden form-group-label checkout">&nbsp;</span>
        </div>

        <div class="form-group guest_count" data-title="<?php esc_attr_e('Guests:', 'hotello'); ?>">
            <select name="guests" id="guests_count">
                <option value="" disabled selected>
					<?php if ($style == 'style_3'): ?>
						<?php echo esc_html__('0', 'hotello'); ?>
					<?php else: ?>
						<?php echo esc_html__('Guests', 'hotello'); ?>
					<?php endif; ?>
                </option>
				<?php foreach (range(1, $atts['guests']) as $guests_count) : ?>
                    <option value="<?php echo intval($guests_count); ?>">
						<?php echo intval($guests_count); ?>
                    </option>
				<?php endforeach; ?>
            </select>
        </div>

        <div class="form-group guest_count" data-title="<?php esc_attr_e('Children:', 'hotello'); ?>">
            <select name="children" id="children_count">
                <option value="">
					<?php if ($style == 'style_3'): ?>
						<?php echo esc_html__('0', 'hotello'); ?>
					<?php else: ?>
						<?php echo esc_html__('Children', 'hotello'); ?>
					<?php endif; ?>
                </option>
				<?php foreach (range(1, $atts['children']) as $children_count) : ?>
                    <option value="<?php echo intval($children_count); ?>">
						<?php echo intval($children_count); ?>
                    </option>
				<?php endforeach; ?>
            </select>
        </div>


        <div class="form-group">
<!--            <button type="submit"-->
<!--                    class="btn btn_third btn_solid btn_shadow btn_icon-right">--><?php //esc_html_e('Check rates', 'hotello'); ?>
<!--                <i class="btn__icon stmicon-keyboard_arrow_right"></i>-->
<!--            </button>-->
            <?php echo apply_filters('hotelier_datepicker_button_html', '<button type="submit" class="btn btn_third btn_solid btn_shadow btn_icon-right button button--datepicker" name="hotelier_datepicker_button" id="datepicker-button" ><i class="btn__icon stmicon-keyboard_arrow_right"></i>' . esc_html__('Check Rates', 'hotello') . '</button>'); ?>
        </div>
    </form>
</div>
