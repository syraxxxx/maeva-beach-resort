<div class="postinfo">
    <span class="date"><?php echo get_the_date(); ?></span>
    <h3><span><?php the_title(); ?></span></h3>
    <?php echo hotello_truncate_text(get_the_excerpt(), 100); ?>
</div>