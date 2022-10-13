<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hotel
 */

?>
</div><!-- .container -->
</div><!-- #content -->

<?php
$active_footer = false;
$sidebars_count = hotello_get_sidebars_cols_count();
$total_widgets = wp_get_sidebars_widgets();

if ($sidebars_count > 0) :
	foreach (range(1, $sidebars_count) as $sidebar_number) :
		$footer_widgets = !empty($total_widgets['footer_' . $sidebar_number]) ? count($total_widgets['footer_' . $sidebar_number]) : 0;
		$sidebar_id = 'footer_' . $sidebar_number;

		if (is_active_sidebar($sidebar_id) && $footer_widgets):
			$active_footer = true;
		endif;
	endforeach; ?>
<?php endif; ?>

<footer class="stm-footer <?php if (!$active_footer) { echo esc_attr('stm-footer__no_widgets'); } ?>">
    <?php get_template_part('resources/partials/footer/main'); ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php
get_template_part('resources/partials/modals/main');
get_template_part('resources/partials/footer/scroll_top');


wp_footer(); ?>

</body>
</html>
