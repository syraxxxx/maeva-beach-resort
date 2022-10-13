<?php

get_header();
$current_object = get_queried_object();

$post_type = 'post';

$settings = hotello_get_post_settings($post_type);

$sidebar_position = hotello_get_sidebar_setting($post_type);
$sidebar_mobile = hotello_get_sidebar_mobile($post_type, 'archive');

$wrapper_classes = array('stm_markup', 'stm_markup_' . esc_attr($sidebar_position));

if ($sidebar_mobile === 'hidden') {
	$wrapper_classes[] = 'stm_sidebar_hidden';
} ?>

    <div class="<?php echo esc_attr(implode(' ', $wrapper_classes)) ?>">

        <div class="stm_markup__content stm_markup__<?php echo esc_attr($post_type); ?>">
			<?php if (have_posts()): ?>
                <h4><?php esc_html_e('Search Results', 'hotello'); ?></h4>
                <div class="stm_loop stm_loop__<?php echo esc_attr($settings['view_type']); ?>">

					<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part($settings['tpl']); ?>
					<?php endwhile; ?>

                </div>
				<?php echo hotello_pagination(array('type' => 'list')); ?>
			<?php else: ?>
                <div class="widget widget-default widget_search">
                    <?php get_search_form(); ?>
                </div>
                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'hotello'); ?></p>
			<?php endif; ?>
        </div>

		<?php if ('full' !== $sidebar_position) : ?>
            <div class="stm_markup__sidebar stm_markup__sidebar_divider stm_markup__sidebar_archive">
                <div class="sidebar_inner">
					<?php hotello_sidebar(); ?>
                </div>
            </div>
		<?php endif; ?>

    </div>

<?php get_footer(); ?>