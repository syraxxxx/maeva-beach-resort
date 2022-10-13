<?php
$classes = 'stm_loop__single stm_loop__list stm_loop__single_style3 no_deco';
$classes .= (has_post_thumbnail()) ? ' stm_has_thumbnail' : ' stm_no_thumbnail';
?>
<div <?php post_class($classes); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>"
       class="inner"
       title="<?php the_title_attribute() ?>">

		<?php if(is_sticky()): ?>
            <span class="stm_sticky_post wtc no_deco mbc"><?php esc_html_e('Sticky', 'hotello'); ?></span>
		<?php endif; ?>

        <h3 class="wtc"><span><?php the_title(); ?></span></h3>

		<?php if (has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
				<?php the_post_thumbnail('hotello-img-1130-350', array('class' => 'img-responsive fullimage')); ?>
            </div>
		<?php } ?>

    </a>

    <div class="stm_post_details clearfix mbc wtc stm_mf">
        <ul class="clearfix">
            <li class="post_date">
                <div href="<?php the_permalink() ?>" class="no_deco wtc">
                    <i class="stmicon-calendar3"></i> <?php echo get_the_date(); ?>
                </div>
            </li>
            <li class="post_by">
                <i class="stmicon-user_b"></i> <?php _e( 'Posted by:', 'hotello' ); ?> <?php the_author(); ?>
            </li>
        </ul>
        <div class="comments_num">
            <a href="<?php comments_link(); ?>" class="wtc no_deco wtc_h">
                <i class="stmicon-comment3"></i> <?php comments_number(); ?>
            </a>
        </div>
    </div>
</div>
