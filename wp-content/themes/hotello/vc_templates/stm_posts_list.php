<?php

/**
 * @var $this WPBakeryShortCode_Stm_Posts_List
 */

$posts = $this->get_posts();

if ($posts->have_posts()) : ?>

    <div class="<?php echo implode(' ', $this->get_classes()); ?>">
        <?php while ($posts->have_posts()) :
            $posts->the_post();
            $post_id = get_the_ID();
            $image = hotello_get_VC_post_img_safe($post_id, $this->img_size);
            ?>

            <div class="stm-post stm-post__card stm-post__posts-list">
                <?php if (!empty($this->show_image)) : ?>
                    <div class="stm-post__image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                            <?php echo hotello_sanitize_image($image); ?>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="stm-post__body">
                    <div class="stm-post__title">
                        <h4>
                            <a class="no_deco ttc mtc_h" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                                <?php echo hotello_truncate_text(get_the_title(), 25, '...', true); ?>
                            </a>
                        </h4>
                    </div>
		            <?php if (!empty($this->show_excerpt)) : ?>
                        <div class="stm-post__excerpt">
                            <?php the_excerpt(); ?>
                        </div>
					<?php endif; ?>
                </div>

                <div class="stm-post__footer">
                    <div class="stm-post__date">
                        <?php echo get_the_date(); ?>
                    </div>
                    <div class="stm-post__link">
                        <a class="mbc_a mbc_b mtc" href="<?php the_permalink(); ?>" title="<?php the_title_attribute() ?>">
                            <?php esc_html_e('Read more', 'hotello'); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
    </div>
    <?php
    wp_reset_postdata();
endif;