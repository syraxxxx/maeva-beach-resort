

<div id="post-<?php the_ID(); ?>"
	<?php post_class('stm_loop__single stm_loop__list no_deco post_thumbnail-' . get_post_thumbnail_id()); ?>>

    <div class="stm_loop__container">

        <a href="<?php the_permalink() ?>" class="stm_loop__post_image">
            <div class="stm_single-date stm_loop__date mbc">
                <span class="day"><?php echo esc_attr(get_the_date()); ?></span>
            </div>
			<?php
			if (function_exists('wpb_getImageBySize')) {
				echo hotello_get_VC_post_img_safe(get_the_ID(), '350x240');
			} else {
				the_post_thumbnail('full', array('class' => 'stm_mgb_28 img-responsive'));
			};
			?>
        </a>

        <div class="stm_loop__content">
            <?php if(is_sticky()): ?>
                <div class="stm_sticky_post"><?php esc_html_e('Sticky', 'hotello'); ?></div>
            <?php endif; ?>
            <a href="<?php the_permalink() ?>"
               class="h3 no_deco no_line mtc_h stm_mgb_31 stm_dpb stm_lh_24"
               title="<?php the_title_attribute() ?>">
                <span><?php the_title(); ?></span>
            </a>
            <div class="stm_post_details">
                <i class="fa fa-tag"></i>
				<?php _e('Category: ', 'hotello'); ?>
				<?php $terms = hotello_get_terms_array(get_the_id(), 'category', 'name', true);
				echo ' ' . wp_kses_post(implode(' ', $terms));
				?>
            </div>
            <div class="post_excerpt stm_mgb_34">
				<?php echo hotello_truncate_text(get_the_excerpt(), 140); ?>
            </div>
        </div>
    </div>
</div>