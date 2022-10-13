<?php get_header();
if (have_posts()): ?>
    <!--Title box-->
	<?php hotello_get_titlebox(); ?>

    <!--Breadcrumbs-->
	<?php if (hotello_check_string(get_post_meta(get_the_ID(), 'page_bc', true))):
		$fullwidth = (hotello_check_string(hotello_get_option('page_bc_fullwidth', false))) ? 'vc_container-fluid-force' : 'container'; ?>
        <div class="stm_page_bc <?php echo esc_attr($fullwidth); ?>">
			<?php get_template_part('resources/partials/global/breadcrumbs'); ?>
        </div>
	<?php endif; ?>

	<?php while (have_posts()): the_post(); ?>
        <div class="post-content">
			<?php get_template_part('resources/partials/content/page/main'); ?>
        </div>
	<?php endwhile; ?>

	<?php hotello_wp_link_pages(); ?>

<?php endif; ?>

<?php get_footer(); ?>