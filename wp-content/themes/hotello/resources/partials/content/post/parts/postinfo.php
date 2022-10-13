<div class="stm_post_details clearfix">
    <ul class="clearfix">
        <li class="post_date">
            <i class="stmicon-event_note"></i><span><?php echo get_the_date(); ?></span>
        </li>
        <li class="post_by">
            <i class="stmicon-person_outline"></i><span><?php esc_html_e('Posted by:', 'hotello'); ?><?php the_author(); ?></span>
        </li>
        <li class="post_comments">
            <a href="<?php comments_link(); ?>" class="no_deco">
                <i class="stmicon-insert_comment"></i><span><?php comments_number(); ?></span>
            </a>
        </li>
    </ul>

</div>