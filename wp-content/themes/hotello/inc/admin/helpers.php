<?php

if (!empty($_GET['htlo_export_options'])) {
	add_action('init', 'hotello_get_options');
}

function hotello_get_options()
{
	var_export(get_option('stm_theme_options'));
	die;
}

add_action('after_switch_theme', 'hotello_after_switch_theme');
function hotello_after_switch_theme($data)
{
	$theme = wp_get_theme();
	$theme_version = $theme->get('Version');

	update_option('stm_theme_version', $theme_version);

	/*Save Theme Options*/
	$theme_options = get_option('stm_theme_options');

	if(!$theme_options) {
		$options = hotello_default_theme_options();
		update_option('stm_theme_options', $options);
	}


	hotello_update_custom_styles();
}

function hotello_default_theme_options()
{
	$json = '{"post_layout":"1","post_sidebar":"default","post_sidebar_archive_mobile":"show","post_sidebar_position":"right","post_view":"list","post_author":"true","post_comments":"true","post_image":"true","post_info":"true","post_share":"false","post_sidebar_single":"default","post_sidebar_single_position":"right","post_tags":"true","post_title":"true","main_color":"#ffac41","secondary_color":"#ffac41","third_color":"rgb(58, 49, 56)","copyright":"Hotel Plus Theme by StylemixThemes","copyright_co":"true","copyright_image":"","copyright_socials":"false","copyright_year":"true","footer_bottom_bg":"","footer_bottom_color":"","right_text":"","stm_footer_layout":"1","footer_socials":[{"social":"fa fa-twitter","url":"#"},{"social":"fa fa-facebook","url":"#"},{"social":"fa fa-instagram","url":"#"},{"social":"fa fa-foursquare","url":"#"},{"social":"fa fa-tripadvisor","url":"#"}],"footer_bg":"rgb(58, 49, 56)","footer_bg_image":"","footer_color":"rgba(255, 255, 255, 0.5)","footer_cols":"4","scroll_top_button":"true","accordions_style":"style_1","buttons_global_style":"style_2","forms_global_style":"style_1","pagination_style":"style_1","sidebars_global_style":"style_1","tabs_style":"style_1","tour_style":"style_1","divider_api_1":"","ga":"","google_api_key":"","logo":"","preloader":"true","preloader_color":"#ffac41","site_padding":"0","site_width":"1200","page_title_box":"true","page_title_box_align":"left","page_title_box_bg_color":"rgba(0, 0, 0, 0.4)","page_title_box_bg_image":"688","page_title_box_line_color":"#ffffff","page_title_box_override":"false","page_title_box_style":"style_1","page_title_box_subtitle":"","page_title_box_subtitle_color":"#ffffff","page_title_box_text_color":"#ffffff","page_title_box_title":"","page_title_box_title_size":"h2","page_title_breadcrumbs":"false","page_title_button":"false","page_title_button_text":"Button","page_title_button_url":"#","bottom_bar_bg":"","bottom_bar_bottom":"35","bottom_bar_color":"rgb(58, 49, 56)","bottom_bar_link_colorhover":"#f00","bottom_bar_text_color":"#ffffff","bottom_bar_top":"35","header_builder":{"bottom":{"center":[{"$$hashKey":"object:934","data":{"font":"hf","fwn":"fwb","hover_line_thickness":"1","id":"176","lh":"51","line":"line_bottom","lineColor":"#ffffff","menuLinkColor":"#ffffff","menuLinkColorOnHover":"#ffffff","position":"right","style":"default","sub":{"fsz":"14"}},"disabled":{"default":"","mobile":"","tablet":""},"label":"Menu","order":{"mobile":"2310","tablet":"2310"},"position":["bottom","right","0"],"type":"menu","uniqueId":"stm_header_element_5b34c79cd2162"}]},"center":{"center":[{"$$hashKey":"object:932","data":{"url":"","uselogo":"true","width":"154"},"disabled":{"default":"","mobile":"","tablet":""},"label":"Image","margins":{"default":{"top":""},"mobile":{"top":"30"},"tablet":{"top":"30"}},"order":{"mobile":"1200","tablet":"2196"},"position":["bottom","left","0"],"type":"image","uniqueId":"stm_header_element_5b34c79cd2156","value":"6"}]}},"center_header_fullwidth":"true","header_bg":"1898","header_bg_fill":"full","header_bottom":"17","header_color":"rgb(58, 49, 56)","header_text_color":"#ffffff","header_text_color_hover":"#ffffff","header_top":"41","divider_h_socials_1":"","header_bgi":"1177","header_socials":[{"social":"fa fa-twitter","url":"Twitter.com"},{"social":"fa fa-facebook","url":"facebook.me"}],"header_sticky":"center","header_sticky_bg":"","main_header_offset":"false","main_header_sticky_mobile":"false","main_header_style":"style_1","main_header_transparent":"false","top_bar_bg":"","top_bar_bottom":"0","top_bar_color":"rgb(255, 255, 255)","top_bar_link_color_hover":"#c19b76","top_bar_text_color":"#222222","top_bar_top":"0","page_bc":"true","page_bc_fullwidth":"false","show_page_title":"true","error_page_bg":"2658","error_page_style":"style_4","divider_services_1":"","divider_services_2":"","services":{"enabled":"false","has_archive":"false","public":"true"},"stm_services_layout":"1","stm_services_sidebar":"false","stm_services_sidebar_position":"left","stm_services_sidebar_single":"false","stm_services_sidebar_single_mobile":"hidden","stm_services_sidebar_single_position":"left","testimonials":{"enabled":"true"},"blockquote_style":"style_1","body_font":{"color":"rgba(34, 34, 34, 0.7)","fw":"400","ln":"30","ls":"","mgb":"","name":"Raleway","size":"20"},"h1_settings":{"color":"","fw":"400","ln":"80","ls":"1","mgb":"35","name":"","size":"72"},"h2_settings":{"color":"","fw":"400","ln":"54","ls":"-1","mgb":"30","name":"","size":"50"},"h3_settings":{"color":"","fw":"400","ln":"36","ls":"0","mgb":"25","name":"","size":"28"},"h4_settings":{"color":"","fw":"400","ln":"30","ls":"2","mgb":"20","name":"","size":"22"},"h5_settings":{"color":"","fw":"400","ln":"28","ls":"0","mgb":"15","name":"","size":"20"},"h6_settings":{"color":"","fw":"400","ln":"20","ls":"2","mgb":"10","name":"","size":"14"},"headings_line":"false","headings_line_height":"5","headings_line_position":"top","headings_line_width":"45","secondary_font":{"color":"#3a3534","name":"Questrial","subset":""},"link_color":"#333333","link_hover_color":"#ce7e21","list_style":"style_1","p_line_height":"30","p_margin_bottom":"25"}';
	return json_decode($json, true);
}

function hotello_theme_add_editor_styles()
{
	add_editor_style('custom-editor-style.css');
}

add_action('admin_init', 'hotello_theme_add_editor_styles');