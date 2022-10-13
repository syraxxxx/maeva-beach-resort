<div class="stm_post__actions stm_flex stm_flex_center stm_mgb_40 stm_flex_last">

    <?php
    if (hotello_check_string(hotello_get_option('post_tags'))) {
        get_template_part('resources/partials/content/post/single/tags');
    }

    if (hotello_check_string(hotello_get_option('post_share'))) {
        get_template_part('resources/partials/content/post/single/share');
    }
    ?>
</div>