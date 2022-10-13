<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hotel
 */

get_header();
$error_page_bg_id = get_option('stm_theme_options')['error_page_bg'];

?>

    <div class="page-404" style="<?php if ($error_page_bg_id) {echo 'background: rgba(0,0,0,0.5) url('. wp_get_attachment_image_src($error_page_bg_id, 'original')[0] .') 0 0 no-repeat!important; ';}?>">
        <h1><?php esc_html_e('404', 'hotello'); ?></h1>
        <h4><?php esc_html_e('THE PAGE YOU ARE LOOKING FOR DOES NOT EXIST.', 'hotello'); ?></h4>
        <a class="btn btn_primary btn_solid" href="<?php echo esc_url(home_url('/')); ?>">
            <?php esc_html_e('Back to Homepage', 'hotello'); ?>
        </a>
    </div>

<?php
get_footer();
