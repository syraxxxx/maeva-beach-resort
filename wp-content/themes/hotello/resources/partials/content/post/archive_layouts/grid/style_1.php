<a href="<?php the_permalink(); ?>"
	<?php post_class('stm_loop__single stm_loop__single_grid_style_1 no_deco'); ?>
   title="<?php the_title_attribute() ?>">

    <div class="stm_loop__container">
        <div class="stm_single-date stm_loop__date mbc">
            <span class="day"><?php echo get_the_date('d'); ?></span>
            <span class="month"><?php echo get_the_date('M'); ?></span>
        </div>

        <div class="stm_single__image">
			<?php
			if(has_post_thumbnail()) {
				if (function_exists('hotello_get_VC_post_img_safe')) {
					echo hotello_get_VC_post_img_safe(get_the_ID(), '350x220');
				} else {
					the_post_thumbnail('pearl-img-335-170', array('class' => 'stm_mgb_28 img-responsive'));
				};
			} else { ?>
                <div class="stm_single__image_placeholder"></div>
			<?php }

			?>
        </div>

        <div class="stm_loop__meta">
            <h5 class="no_line mtc_h fwn stm_animated"><?php the_title(); ?></h5>
            <p class="stm_loop_excerpt ttc">
				<?php echo hotello_truncate_text(get_the_excerpt(), 130); ?>
            </p>

            <span class="btn stm_read_more_link ttc_b mtc_b_h">
            <?php esc_html_e('View more', 'hotello'); ?>
        </span>

        </div>
    </div>


</a>