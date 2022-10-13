<?php
add_action('wp_enqueue_scripts', 'hotello_titlebox_styles', 5);
function hotello_titlebox_styles()
{
	$post = get_queried_object();
	$id = (!empty($post->ID)) ? $post->ID : '';
	/*If is shop*/
	$id = (hotello_is_shop() or hotello_is_account_page()) ? hotello_shop_page_id() : $id;

	$settings = hotello_title_box_settings($id);
	$title_box_css = '';

	if (!empty($settings["page_title_box_bg_image"])):
		$title_box_css .= '.stm_titlebox {
				background-image: url(' . esc_url(hotello_get_image_url($settings["page_title_box_bg_image"])) . ');
		}';
	endif;

	if (!empty($settings["page_title_box_bg_color"])) :
		$title_box_css .= '.stm_titlebox:after {
            background-color: ' . hotello_color_string_fix(esc_attr($settings["page_title_box_bg_color"])) . ';
        }';
	endif;

	if (!empty($settings["page_title_box_text_color"])):
		$title_box_css .=
			'.stm_titlebox .stm_titlebox__title,
        .stm_titlebox .stm_titlebox__author,
        .stm_titlebox .stm_titlebox__categories
        {
            color:  ' . hotello_color_string_fix($settings["page_title_box_text_color"]) . ' !important;
        }';
	endif;

	if (!empty($settings["page_title_box_subtitle_color"])):
		$title_box_css .= '.stm_titlebox .stm_titlebox__subtitle {
            color: ' . hotello_color_string_fix($settings["page_title_box_subtitle_color"]) . ';
        }';
	endif;

	if (!empty($settings["page_title_box_line_color"])):
		$title_box_css .= '.stm_titlebox .stm_titlebox__inner .stm_separator {
            background-color: ' . hotello_color_string_fix($settings['page_title_box_line_color']) . ' !important;
        }';
	endif;

	if (!empty($settings['page_title_box_bg_pos'])) {
		$title_box_css .= '.stm_titlebox {
	        background-position: ' . $settings['page_title_box_bg_pos'] . ';
	    }';
	}

	if (!empty($title_box_css)) wp_add_inline_style('hotello-app', $title_box_css);
}