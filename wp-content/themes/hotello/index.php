<?php get_header(); ?>

<?php if (have_posts()): ?>
	<?php hotello_get_titlebox(); ?>
    <?php get_template_part('resources/partials/content/archive'); ?>
<?php else: ?>
    <?php get_template_part('resources/partials/content/none'); ?>
<?php endif; ?>

<?php get_footer(); ?>