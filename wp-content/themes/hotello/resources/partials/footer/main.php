<?php
$total_widgets = wp_get_sidebars_widgets();
$sidebars_count = hotello_get_sidebars_cols_count();
if ($sidebars_count > 0) {
	$col_class = 'col-md-' . (12 / $sidebars_count);
}

$copyright = hotello_get_option('copyright');
$right_text = hotello_get_option('right_text');
$footer_socials = hotello_get_option('footer_socials');
$show_footer_socials = hotello_check_string(hotello_get_option('copyright_socials', 'false'));


$copyright_markup = 50;
if (empty($footer_socials) && empty($right_text)) {
	$copyright_text_align_class = 'text-center';
	$copyright_markup = 'full';
}

?>

<div class="container">
    <div class="row stm-footer__widgets">
		<?php if ($sidebars_count > 0) :
			foreach (range(1, $sidebars_count) as $sidebar_number) :
				$footer_widgets = !empty($total_widgets['footer_' . $sidebar_number]) ? count($total_widgets['footer_' . $sidebar_number]) : 0;
				$sidebar_id = 'footer_' . $sidebar_number;
				if (is_active_sidebar($sidebar_id) && $footer_widgets):
					?>
                    <div class="<?php echo esc_attr($col_class); ?>">
						<?php dynamic_sidebar($sidebar_id); ?>
                    </div>
				<?php
				endif;
			endforeach;
			?>
		<?php endif; ?>
    </div>


	<?php if (!empty($copyright) or !empty($right_text) or !empty($footer_socials) and $show_footer_socials): ?>

        <div class="stm-footer__bottom">
            <div class="stm_markup stm_markup_right stm_markup_<?php echo esc_attr($copyright_markup) ?>">
				<?php get_template_part("resources/partials/footer/parts/copyright"); ?>

				<?php if (!empty($right_text) || !empty($footer_socials) && $show_footer_socials) : ?>

                    <div class="stm_markup__sidebar text-right">
						<?php get_template_part("resources/partials/footer/parts/right_text"); ?>
						<?php get_template_part("resources/partials/footer/parts/socials"); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>

	<?php endif; ?>
</div>
