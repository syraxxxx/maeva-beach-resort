<?php

function hotello_ajax_get_image_by_id()
{
    if (empty($_GET['image_id'])) exit;
    $id = intval($_GET['image_id']);
    $image_size = (!empty($_GET['imageSize'])) ? sanitize_text_field($_GET['imageSize']) : '370x250';
	$full_image_url = wp_get_attachment_image_src($id, 'full')[0];
	$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    ob_start(); ?>
	<a href="<?php echo esc_url($full_image_url); ?>" title="<?php echo esc_attr($alt); ?>" class="stm-image stm_lightgallery__selector">
		<?php echo wp_kses_post(hotello_get_VC_img($id, $image_size)); ?>
	</a>
	<?php $image = ob_get_clean();
	
    wp_send_json($image);
}

add_action('wp_ajax_get_image_by_id', 'hotello_ajax_get_image_by_id');
add_action('wp_ajax_nopriv_get_image_by_id', 'hotello_ajax_get_image_by_id');


function hotello_update_custom_styles_admin()
{
    hotello_update_custom_styles();
}

add_action('wp_ajax_hotel_update_custom_styles_admin', 'hotello_update_custom_styles_admin');