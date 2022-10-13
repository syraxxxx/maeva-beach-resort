<div class="stm_post_details clearfix">
    <div class="post_date mbc">
        <span class="day"><?php echo esc_attr(get_the_date()); ?></span>
    </div>
    <div class="post_details">
        <div class="post_by">
            <?php _e('Posted by:', 'hotello'); ?> <span><?php the_author(); ?></span>
        </div>
        <div class="post_cat">
            <?php _e('Category:', 'hotello'); ?>
            <span>
                <?php $terms = hotello_get_terms_array(get_the_id(), 'category', 'name', true);
				echo ' ' . wp_kses_post(implode(' ', $terms)); ?>
            </span>
        </div>
        <div class="comments_num">
            <a href="<?php comments_link(); ?>" class="mtc no_deco ttc_h">
                <i class="fa fa-comments"></i> <?php comments_number(); ?>
            </a>
        </div>
    </div>

</div>