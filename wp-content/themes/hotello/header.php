<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hotel
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php do_action('hotello_head_start'); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <?php do_action('hotello_head_end'); ?>
</head>

<body <?php body_class(); ?> <?php hotello_body_bg(); ?>>

<?php do_action('hotello_body_start'); ?>

<div class="stm-site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'hotello'); ?></a>

    <header class="site-header">
        <?php get_template_part('resources/partials/header/main'); ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <div class="<?php echo esc_attr(apply_filters('hotel_site_container', '')); ?>">

