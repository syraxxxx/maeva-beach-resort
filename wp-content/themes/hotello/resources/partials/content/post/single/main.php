<?php

$theme_info = hotello_get_theme_assets_paths();
wp_enqueue_style('hotello-post-style-1', $theme_info['css'] . 'post/style_1.css', 'hotello-theme-styles', $theme_info['v']);
?>
<div class="stm_single_post stm_single_post_style_1">
    <?php get_template_part("resources/partials/content/post/layouts/layout_1"); ?>
</div>