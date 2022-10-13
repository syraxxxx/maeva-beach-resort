<?php
get_header();

if (have_posts()) {
	if (hotello_is_hotel_post_type()) {
		hotello_get_titlebox();
		get_template_part('resources/partials/content/single');
	} else {
		while (have_posts()) {
			the_post(); ?>
            <div class="stm_single_post stm_single_post_style_1">
				<?php the_title('<h1 class="post-title">', '</h1>');
				get_template_part("resources/partials/content/post/parts/postinfo", 2);
				if (has_post_thumbnail()) ?><p class="post-img"><?php the_post_thumbnail('full'); ?></p>
                <div class="post-content clearfix">
					<?php the_content(); ?>
                </div>
				<?php hotello_wp_link_pages();


				get_template_part("resources/partials/content/post/single/tags");
				get_template_part("resources/partials/content/post/parts/comments");

				?>
            </div>
		<?php }
	}
}

get_footer();