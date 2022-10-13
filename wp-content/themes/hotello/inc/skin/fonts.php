<?php
/*Fonts*/
$fonts = hotello_get_font();

$main_font = $fonts['main'];
$secondary_font = $fonts['secondary'];

$headings = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
$headings_big = array('h1', 'h2', 'h3');
?>


    body,
    .main_font
    {
<?php
$lh = round($main_font['ln'] / $main_font['size'], 3);
hotello_css_styles($main_font);
?>
    }

    .main_font,
    .stm-navigation__default.main_font a
    {
<?php hotello_css_styles($main_font, true) ?>
    }

<?php echo esc_attr(implode(', ', $headings)) ?>,
    .<?php echo esc_attr(implode(', .', $headings)) ?>,
    .heading_font {
<?php hotello_css_styles($secondary_font); ?>;
    letter-spacing: <?php echo floatval(hotello_get_option('headings_letter_spacing', 0)); ?>px;
    }
<?php

if (!empty($secondary_font['name'])): ?>
    .widget.widget_pages ul > li,
    .widget.widget_nav_menu ul > li,
    .widget.widget_categories ul > li,
    .form-group-label,
    .stm_wp_hotelier_rooms_list_style_2 .stm-rooms-types ul li a,
    .stm_loop__list.stm_loop__single .stm_single-date .day,
    .widget.widget_meta ul li, .widget.widget_archive ul li,
    .widget-rooms__list .widget-rooms__item .widget-rooms__price,
    .stm_single_post table thead tr th,
    .widget.widget_rss ul li cite,
    .widget.widget_rss ul li .rss-date,
    .widget_recent_comments ul li .comment-author-link,
    .widget.widget_calendar .calendar_wrap table td, .widget.widget_calendar .calendar_wrap table th,
    .stm_wp_hotelier_rooms_filter .widget-rooms-filter__group-label,
    .selected-nights,
    .stm_demo_sidebar__url,
    .stm_demo_sidebar__buy,
    ul.page-numbers li.stm_page_num span, ul.page-numbers li.stm_page_num a,
    .stm_single_post table thead tr th,
    .widget_calendar caption,
    .stm_titlebox_style_8,
    .ui-timepicker-container .ui-timepicker li a,
    .vc_tta-title-text,
    body.hotelier-booking .form-row__label,
    .heading_font_family
    {
    font-family: "<?php echo esc_attr($secondary_font['name']); ?>";
    }

<?php endif;

if (hotello_check_string(hotello_get_option('headings_line'))) {
	echo esc_attr(implode(':before,', $headings)) . ':before,';
	echo esc_attr(implode(':after,', $headings)) . ':after,';
	echo esc_attr(implode(':before,.', $headings)) . ':before,';
	echo esc_attr(implode(':after,.', $headings)) . ':before';
	$heading_width = hotello_get_option('headings_line_width', 46);
	$heading_height = hotello_get_option('headings_line_height', 5); ?>
    {
    width: <?php echo esc_attr($heading_width) ?>px !important;
    height: <?php echo esc_attr($heading_height) ?>px !important;
    }
<?php } ?>

    .widget-booking__room-link
    {
<?php hotello_css_styles($secondary_font, true); ?>
    }

<?php
/*Heading sizes*/
foreach ($headings as $heading) {
	$settings = array_filter(hotello_get_option("{$heading}_settings", array()));
	$settings = wp_parse_args($settings, $secondary_font);
	echo sanitize_text_field(".{$heading}, {$heading} {" . hotello_css_styles($settings, false, true) . "}");

	if (!empty($settings['size'])) {
		$position = intval(round(intval($settings['size']) * 0.7 + 15));
		echo sanitize_text_field($heading) ?> i.position_top {
        top: -<?php echo esc_attr($position); ?>px;
        }
		<?php echo sanitize_text_field($heading) ?> i.position_bottom {
        bottom: -<?php echo esc_attr($position); ?>px;
        }
	<?php }
} ?>

    @media (max-width:550px) { <?php
foreach ($headings_big as $heading) :
	echo sanitize_text_field(".{$heading}, {$heading} {");
	$settings = array_filter(hotello_get_option("{$heading}_settings", array()));
	$settings = wp_parse_args($settings, $secondary_font);

	if (!empty($settings['size'])):
		$font_size = intval($settings['size'] * 0.85); ?>
        font-size: <?php echo sanitize_text_field($font_size); ?>px !important;
	<?php endif; ?>
    line-height: 1.2 !important;
	<?php echo sanitize_text_field("}");
endforeach; ?>
    }


<?php //Booked
if (class_exists('booked_plugin')):
	$default = hotello_get_layout_config();
	$main_color = hotello_get_option('main_color', $default['main_color']);
	$secondary_color = hotello_get_option('secondary_color', $default['secondary_color']);
	$third_color = hotello_get_option('third_color', $default['third_color']);
	?>
    body .booked-modal .bm-window p.booked-title-bar small,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-title,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-range,
    .booked-list-view-nav {
	<?php hotello_css_styles($secondary_font, true); ?>
    }
    body #booked-profile-page input[type=submit].button-primary,
    body table.booked-calendar input[type=submit].button-primary,
    body .booked-list-view input[type=submit].button-primary,
    body .booked-modal input[type=submit].button-primary,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button span {
    color: <?php echo esc_attr(hotello_color_treads($third_color)); ?>
    }

    body .booked-list-view .booked-appt-list h2 strong,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time i.fa,
    body .booked-list-view.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time .timeslot-range {
    color: <?php echo esc_attr(hotello_color_treads($main_color)); ?> !important;
    }
<?php endif;

