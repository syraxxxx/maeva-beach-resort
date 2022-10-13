<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Hotel
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hotello_body_classes($classes)
{
	$disable_transparent_header = $title_box = $breadcrumbs = false;
	$obj = get_queried_object();
	if (!is_wp_error($obj) and !empty($obj->ID)) $id = $obj->ID;

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	/*Transparent header*/
	if (!empty($id)) {
		$disable_transparent_header = get_post_meta($id, 'header_transparent', true);

	}

	$classes[] = 'stm_hotel_theme';


	$transparent = 'stm_transparent_header_disabled';
	if (!empty($disable_transparent_header)) {
		if ($disable_transparent_header == 'force') $transparent = 'stm_header_transparent';
	} else {
		$transparent = hotello_check_string(hotello_get_option('main_header_transparent')) ? 'stm_header_transparent' : '';
	}

	if(is_404() or is_search() or is_post_type_archive( 'room' )) $transparent = 'stm_transparent_header_disabled';

	$classes[] = $transparent;

	$classes[] = 'stm_layout_' . get_option('stm_layout', 'chicago');
	$classes[] = 'stm_header_' . hotello_get_option('main_header_style', 'style_1');
	$classes[] = 'stm_post_style_' . hotello_get_option('post_layout', 'style_1');
	$classes[] = 'stm_buttons_' . hotello_get_option('buttons_global_style', 'style_1');

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter('body_class', 'hotello_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hotello_pingback_header()
{
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
	}
}

add_action('wp_head', 'hotello_pingback_header');


function hotello_get_theme_assets_paths()
{
	$paths = array(
		'v'           => hotello_get_version(),
		'css'         => HOTELLO_PUBLIC_URL . '/css/',
		'js'          => HOTELLO_PUBLIC_URL . '/js/',
		'vendors'     => HOTELLO_PUBLIC_URL . '/vendors/',
		'css_vendors' => HOTELLO_PUBLIC_URL . '/css/vendors/',
		'js_vendors'  => HOTELLO_PUBLIC_URL . '/js/vendors/',
		'admin_css'   => HOTELLO_PUBLIC_URL . '/css/admin/',
		'admin_js'    => HOTELLO_PUBLIC_URL . '/js/admin/',
		'to_css'      => HOTELLO_ADMIN_INCLUDE_URL . '/theme_options/assets/css/',
		'to_js'       => HOTELLO_ADMIN_INCLUDE_URL . '/theme_options/assets/js/',
		'to_vendor'   => HOTELLO_ADMIN_INCLUDE_URL . '/theme_options/assets/vendor/',

	);
	return $paths;
}

function hotello_get_version()
{
	$theme_info = wp_get_theme();
	$v = (WP_DEBUG) ? time() : $theme_info->get('Version');
	return apply_filters('hotel_version', $v);
}

function hotello_element_style_path($type)
{
	$template_uri = get_template_directory_uri();

	return apply_filters('hotel_element_style_path', $template_uri . '/public/css/' . $type . '/');
}

function hotello_add_element_style($name, $style = 'style_1', $inline_styles = '')
{
	$v = hotello_get_version();
	$src = esc_url(hotello_element_style_path('vc_elements') . $name . '/' . $style . '.css');
	$handle = "hotello-{$name}_{$style}";

	wp_enqueue_style($handle, $src, array('hotello-style'), $v);

	if (!empty($inline_styles)) {
		wp_add_inline_style($handle, $inline_styles);
	}
}

function hotello_get_VC_img($img_id, $img_size, $url = false)
{
	$image = '';
	if (!empty($img_id) and !empty($img_size)) {

	    if(function_exists('wpb_getImageBySize')) {
			$img = wpb_getImageBySize(array(
				'attach_id'  => $img_id,
				'thumb_size' => $img_size,
			));
		}

		if (!empty($img['thumbnail'])) {
			$image = $img['thumbnail'];

			if ($url) {
				$datas = array();
				preg_match('/src="([^"]*)"/i', $image, $datas);
				if (!empty($datas[1])) {
					$image = $datas[1];
				} else {
					$image = '';
				}
			}
		}
	}

	return apply_filters('hotel_get_VC_img', $image);
}

add_filter('vc_wpb_getimagesize', 'hotello_vc_wpb_getimagesize', 100, 3);


function hotello_get_VC_post_img_safe($post_id, $size_1, $size_2 = 'large', $url = false, $retina = true)
{
	if (function_exists('hotello_get_VC_img') && !empty($size_1)) {
		$post_id = get_post_thumbnail_id($post_id);
		$image = hotello_get_VC_img($post_id, $size_1, $url);
	} else {
		if ($url) {
			$image = hotello_get_image_url($post_id, $size_2);
		} else {
			$image = get_the_post_thumbnail($post_id, $size_2);
		}
	}

	if ($retina === false && strpos($image, 'srcset') !== false) {
		$image = str_replace('srcset', 'data-retina', $image);
	}


	return $image;
}

/**
 * Hook in VC function and crop retina image then add it to the original img tag with retina data param
 *
 * @param $attachment
 * @param $id
 * @param $params
 * @return mixed
 */
function hotello_vc_wpb_getimagesize($attachment, $id, $params)
{
	/*Already cropped*/
	if (!empty($params['retined']) and $params['retined']) return $attachment;
	/*Empty thumbnail*/
	if (empty($attachment['thumbnail']) or empty($params['thumb_size'])) return $attachment;

	/*Get size as array width - height*/
	$img_size = $params['thumb_size'];
	$retina_size = explode('x', $img_size);
	if (empty($retina_size[0]) || empty($retina_size[1])) {
		return $attachment;
	}

	/*If size is in wrong format*/
	if (!is_array($retina_size) or count($retina_size) != 2) return $attachment;
	$retina_width = $retina_size[0] * 2;
	$retina_height = $retina_size[1] * 2;

	$image_matadata = wp_get_attachment_metadata($id);
	if (empty($image_matadata)) {
		return $attachment;
	}


	if (empty($image_matadata['width']) or empty($image_matadata['height'])) return $attachment;

	$original_image_width = $image_matadata['width'];
	$original_image_height = $image_matadata['height'];


	$retina_size_available = $original_image_width > $retina_width && $original_image_height > $retina_height;

	$retina_size = $retina_width . 'x' . $retina_height;

	if(function_exists('wpb_getImageBySize')) {
		$retina_img = wpb_getImageBySize(array(
			'attach_id'  => $id,
			'thumb_size' => $retina_size,
			'retined'    => true
		));
	}

	if (!empty($retina_img['thumbnail']) && $retina_size_available) {
		$retina = explode(" ", $retina_img['thumbnail']);
		$retina = (is_array($retina) and !empty($retina[2])) ? str_replace('src', 'srcset', $retina[2]) : '';
	}

	if (!empty($retina) && $retina_size_available) {
		$retina = substr($retina, 0, -1) . ' 2x"';
		$attachment['thumbnail'] = str_replace('<img', '<img ' . $retina, $attachment['thumbnail']);
	}

	return $attachment;
}

/**
 * get image url by id
 *
 * @param $id
 * @param string $size
 * @return string
 */
function hotello_get_image_url($id, $size = 'full')
{
	$url = '';
	if (!empty($id)) {
		$image = wp_get_attachment_image_src($id, $size, false);
		if (!empty($image[0])) {
			$url = $image[0];
		}
	}

	return $url;
}


function hotello_truncate_text($text, $length = '40', $affix = '...', $tooltip = false)
{
	$full_text = $text;

	if (!empty(intval($length))) {
		$w_length = mb_strlen($text);
		if ($w_length > $length) {
			$text = mb_strimwidth($text, 0, $length, $affix);
			if ($tooltip) {
				$text = '<span data-toggle="tooltip" title="' . esc_attr($full_text) . '">' . $text . '</span>';
			}
		}
	}

	return $text;
}

/**
 * Convert hex code to rgb
 *
 * @param $colour
 * @param $opacity
 * @return bool|string
 */
function hotello_hex2rgb($colour, $opacity = '1')
{
	if ($colour[0] == '#') {
		$colour = substr($colour, 1);
	}
	if (strlen($colour) == 6) {
		list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
	} elseif (strlen($colour) == 3) {
		list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
	} else {
		return false;
	}
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);

	return $r . ',' . $g . ',' . $b . ',' . $opacity;
}

function hotello_array_to_style_string($arr, $important = false, $add_style_tag = false)
{
	if (empty($arr)) {
		return '';
	}
	$important = $important ? '!important' : '';
	$r = array_map(
		function ($v, $k) {
			return $k . ':' . $v;
		},
		$arr,
		array_keys($arr)
	);


	$r = implode($important . '; ', $r) . $important . ';';

	if ($add_style_tag) {
		$r = 'style="' . $r . '"';
	}

	return $r;
}

/**
 * Check if string is bool
 *
 * @param $string
 * @return bool
 */
function hotello_check_string($string)
{
	return $string === 'true';
}

function hotello_get_VC_attachment_img_safe($attachment_id, $size_1, $size_2 = 'large', $url = false, $retina = true)
{
	if (function_exists('hotello_get_VC_img') && !empty($size_1)) {
		$image = hotello_get_VC_img($attachment_id, $size_1, $url);
	} else {
		if ($url) {
			$image = hotello_get_image_url($attachment_id, $size_2);
		} else {
			$image = get_the_post_thumbnail($attachment_id, $size_2);
		}
	}

	if ($retina === false && strpos($image, 'srcset') !== false) {
		$image = str_replace('srcset', 'data-retina', $image);
	}


	return $image;
}

function hotello_get_theme_info()
{
	$theme = wp_get_theme();
	$theme_name = $theme->get('Name');
	$theme_v = $theme->get('Version');

	$theme_info = array(
		'name' => $theme_name,
		'slug' => sanitize_file_name(strtolower($theme_name)),
		'v'    => $theme_v,
	);

	return $theme_info;
}

/**
 * Get list of options
 *
 * @return mixed|false
 */
function hotello_stored_theme_options()
{
	$options = get_option('stm_theme_options', array());
	return apply_filters('hotel_stored_theme_options', $options);
}

/**
 * Get single theme option
 *
 * @param $option_name
 * @param $default
 * @return null
 */
function hotello_get_option($option_name, $default = false)
{
	$options = hotello_stored_theme_options();
	$option = false;

	if (!empty($options[$option_name])) {
		$option = $options[$option_name];
	} elseif (isset($default)) {
		$option = $default;
	}

	return $option;
}


/**
 * Set # before the string if it has only 6 symbols. Simple hack for wp colorpicker alpha addon
 *
 * @param $color
 * @return mixed
 */
function hotello_color_string_fix($color)
{
	$color = (strlen($color) == 6 || strlen($color) == 3) ? "#{$color}" : $color;
	return apply_filters('hotel_color_treads', $color);
}


function hotello_websafe_fonts()
{
	$websafe = array(
		''                    => array(
			'label' => 'Default',
		),
		'Arial'               => array(
			'label' => 'Arial',
		),
		'Arial Black'         => array(
			'label' => 'Arial Black',
		),
		'Comic Sans MS'       => array(
			'label' => 'Comic Sans MS',
		),
		'Courier New'         => array(
			'label' => 'Courier New',
		),
		'Times'               => array(
			'label' => 'Times',
		),
		'Impact'              => array(
			'label' => 'Impact',
		),
		'Lucida Console'      => array(
			'label' => 'Lucida Console',
		),
		'Lucida Sans Unicode' => array(
			'label' => 'Lucida Sans Unicode',
		),
		'Palatino Linotype'   => array(
			'label' => 'Palatino Linotype',
		),
		'Tahoma'              => array(
			'label' => 'Tahoma',
		),
		'Times New Roman'     => array(
			'label' => 'Times New Roman',
		),
		'Trebuchet MS'        => array(
			'label' => 'Trebuchet MS',
		),
		'Verdana'             => array(
			'label' => 'Verdana',
		),
	);

	return apply_filters('hotel_websafe_fonts', $websafe);
}

function hotello_stm_hb_enabled()
{
	return (class_exists('Stm_Header_Builder')) ? true : false;
}


if (!function_exists('hotello_array_has')) {
	/**
	 * Check if an item exists in an array using "dot" notation.
	 *
	 * @param  array $array
	 * @param  string $key
	 *
	 * @return bool
	 */
	function hotello_array_has(array $array, $key)
	{
		if (empty($array) || $key === null) {
			return false;
		}

		if (array_key_exists($key, $array)) {
			return true;
		}

		foreach (explode('.', $key) as $segment) {
			if (!is_array($array) || !array_key_exists($segment, $array)) {
				return false;
			}

			$array = $array[$segment];
		}

		return true;
	}
}

/**
 * Get layout configs
 *
 * @param string $layout
 * @return mixed
 */
function hotello_get_layout_config($layout = 'chicago')
{
	$layout = hotello_get_layout();
	$layouts = hotello_layout_configs();

	return $layouts[$layout];
}

/**
 * Get theme current layout
 *
 * @return mixed
 */
function hotello_get_layout()
{
	return (apply_filters('stm_layout', get_option('stm_layout', 'chicago')));
}

function hotello_adjust_brightness($hex, $steps)
{
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color = hexdec($color); // Convert to decimal
		$color = max(0, min(255, $color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

add_action('init', 'hotello_reset_custom_styles', 100);

function hotello_reset_custom_styles()
{
	if (!empty($_GET['rcs'])) {
		hotello_update_custom_styles();
	}
}


function hotello_vc_get_element_css_value($vc_css_string, $css_rule_name)
{
	$css_array = strstr($vc_css_string, '{');
	$css_array = str_replace('{', '', $css_array);
	$css_array = str_replace('}', '', $css_array);
	$css_array = explode(';', $css_array);
	$css_array = array_filter($css_array);
	foreach ($css_array as $key => $css_string) {
		$css_single_val = explode(':', $css_string);
		unset($css_array[$key]);
		$css_array[$css_single_val[0]] = $css_single_val[1];
	}

	if (isset($css_array[$css_rule_name])) {
		return str_replace(' !important', '', $css_array[$css_rule_name]);
	}

	return false;
}


function hotello_pa($array)
{
	echo wp_kses_post('<pre>');
	print_r($array);
	echo wp_kses_post('</pre>');
}


/**
 * Function returns current theme fonts
 *
 * @return mixed
 */
function hotello_get_font()
{
	$defaults = hotello_get_layout_config();

	$fonts = array(
		'main'      => $defaults['main_font'],
		'secondary' => $defaults['secondary_font']
	);

	if (!empty(hotello_get_option('body_font'))) {
		$fonts['main'] = wp_parse_args(array_filter(hotello_get_option('body_font')), $fonts['main']);
	}

	if (!empty(hotello_get_option('secondary_font'))) {
		$fonts['secondary'] = wp_parse_args(array_filter(hotello_get_option('secondary_font')), $fonts['secondary']);
	}

	return apply_filters('hotel_get_fonts', $fonts);
}

/**
 * @return int|false
 */

function hotello_get_sidebars_cols_count()
{
	$count = hotello_get_option('footer_cols');
	if ($count !== false) {
		$count = intval($count);
	}
	return $count;
}


function hotello_add_widget_style($name, $style = 'style_1')
{
	$v = hotello_get_version();
	$src = esc_url(hotello_element_style_path('widgets') . $name . '/' . $style . '.css');
	$handle = "hotello-{$name}_{$style}";
	wp_enqueue_style($handle, $src, array('hotello-app'), $v);
}

function hotello_wp_link_pages()
{
	$defaults = array(
		'before'           => '<div class="page-numbers hotel_wp_link_pages">',
		'after'            => '</div>',
		'link_before'      => '<div class="stm_page_num">',
		'link_after'       => '</div>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => esc_html__('Next page', 'hotello'),
		'previouspagelink' => esc_html__('Previous page', 'hotello'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	wp_link_pages($defaults);
}

function hotello_get_sidebar_option($post_type, $archive)
{
	$sidebar = array(
		'name'     => "{$post_type}_sidebar",
		'position' => "{$post_type}_sidebar_position"
	);

	if (!$archive) {
		$sidebar['name'] = "{$post_type}_sidebar_single";
		$sidebar['position'] = "{$post_type}_sidebar_single_position";
	}

	return apply_filters('hotel_get_sidebar_option', $sidebar);
}

function hotello_sidebar($archive = true, $sidebar_setting = '')
{
	$r = '';
	$post_type = get_post_type();

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) $post_type = 'post';

	$sidebar = hotello_get_sidebar_option($post_type, $archive);
	$sidebar_name = $sidebar['name'];

	$sidebar_id = hotello_get_option($sidebar_name, '');
	$sidebar_id = (!empty($_GET['sidebar'])) ? intval($_GET['sidebar']) : $sidebar_id;


	if (has_filter('wpml_object_id')) {
		$sidebar_id = apply_filters('wpml_object_id', $sidebar_id, 'stm_sidebars');
	}


	if (!empty($sidebar_setting)) $sidebar_id = $sidebar_setting;


	if (!empty(intval($sidebar_id))) {
		$sidebar = get_post($sidebar_id);
		if (!empty($sidebar)) {
			$r = apply_filters('the_content', $sidebar->post_content);
		}
	} elseif (is_active_sidebar($sidebar_id) && !empty($sidebar_id) && $sidebar_id !== 'false') {
		dynamic_sidebar($sidebar_id);
	}
	$sidebar_css = sanitize_text_field(get_post_meta($sidebar_id, '_wpb_shortcodes_custom_css', true));

	wp_add_inline_style('hotello-row_style_1', $sidebar_css);

    if (get_post_meta($sidebar_id, 'sticky_sidebar')[0]) {
        wp_enqueue_script ( 'sticky-sidebar' );
        wp_enqueue_script ( 'handle_sticky-sidebar' );
    }

	?>


	<?php echo apply_filters('hotel_sidebar', $r);
}


function hotello_sanitize_image($image)
{
	$allowed = array(
		'img' => array(
			'srcset' => array(),
			'src'    => array(),
			'class'  => array(),
			'width'  => array(),
			'height' => array(),
			'alt'    => array()
		)
	);
	return wp_kses($image, $allowed);
}

function hotello_is_hotel_post_type()
{
	if (function_exists('stm_post_types')) {
		$hotel_post_types = stm_post_types();
		$hotel_post_types = array_keys($hotel_post_types);
		$hotel_post_types[] = 'post';
		$hotel_post_types[] = 'room';

		$object = get_queried_object();
		$post_type = (!empty($object->post_type)) ? $object->post_type : '';

		return in_array($post_type, $hotel_post_types);
	}

	return false;
}

function hotello_body_bg()
{
	$post_id = false;
	if (is_singular()) {
		global $post;
		$post_id = $post->ID;
	}
	if (is_home()) {
		$post_id = get_option('page_for_posts');
	}
	$styles = array();
	$bg = get_post_meta($post_id, 'page_bg_color', true);

	if (!empty($bg)) {
		$styles['background-color'] = $bg;
	}

	if (!empty($styles)) {
		echo html_entity_decode('style="' . hotello_array_to_style_string($styles) . '"');
	}
}

/**
 * Declare WP admin ajax url in head
 */
function hotello_wp_head()
{
    $variables = array (
        'hotello_ajax_check_room_availability' => wp_create_nonce('hotello_ajax_check_room_availability'),
        'hotello_ajax_book_room' => wp_create_nonce('hotello_ajax_book_room'),
        'hotello_install_plugin' => wp_create_nonce('hotello_install_plugin'),
        'hotello_get_thumbnail' => wp_create_nonce('hotello_get_thumbnail'),
        'hotello_save_settings' => wp_create_nonce('hotello_save_settings'),
        'hotello_ajax_get_image_by_id' => wp_create_nonce('hotello_ajax_get_image_by_id'),
        'hotello_update_custom_styles_admin' => wp_create_nonce('hotello_update_custom_styles_admin'),
    );
	?>
    <script>
        var stm_ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
        var stm_site_paddings = <?php echo intval(hotello_get_option('site_padding', 0)); ?>;
        if (window.innerWidth < 1300) stm_site_paddings = 0;
        var stm_sticky = '<?php echo esc_js(hotello_get_option('header_sticky', '')); ?>';
        window.wp_data = <?php echo json_encode( $variables ); ?>;
    </script>
	<?php
}

add_action('wp_head', 'hotello_wp_head');
add_action('admin_head', 'hotello_wp_head');


function hotello_iconpicker($input_name = 'hotello_icon_picker', $input_value = '', $input_id = '')
{
	wp_enqueue_script('fontIconPicker');
	wp_enqueue_style('fontIconPicker');
	wp_enqueue_style('fontIconPicker-grey-theme');
	wp_enqueue_style('font-awesome');
	if (empty($input_id)) $input_id = uniqid('hotel_iconpicker_');
	?>
    <script>
		<?php hotello_icons_set(); ?>
    </script>
    <script>
        (function ($) {
            $(document).ready(function () {
                $('#<?php echo esc_js($input_id) ?>').fontIconPicker({
                    source: stm_icons
                })
            });
        })(jQuery)
    </script>
    <input type="text" name="<?php echo esc_attr($input_name); ?>" id="<?php echo esc_attr($input_id); ?>"
           value="<?php echo esc_attr($input_value); ?>">
	<?php
}

/**
 * Add file types support
 *
 * @param $mimes
 * @return mixed
 */
function hotello_svg_mime($mimes)
{
	$mimes['ico'] = 'image/icon';
	$mimes['svg'] = 'image/svg+xml';
	$mimes['xml'] = 'application/xml';
	$mimes['zip'] = 'application/zip';

	return $mimes;
}

add_filter('upload_mimes', 'hotello_svg_mime', 100);

function hotello_load_element_style($path, $name, $style = 'style_1')
{

	$v = hotello_get_version();

	if (!empty($name)) $name .= '/';
	$src = hotello_element_style_path($path) . $name . $style . '.css';
	$handle = "hotello-{$name}_{$style}";

	wp_enqueue_style($handle, $src, array('hotello-theme-styles'), $v);

}

function hotello_get_sidebar_mobile($post_type = 'post', $page_type = 'single')
{
	$setting = "{$post_type}_sidebar_{$page_type}_mobile";
	$setting = hotello_get_option($setting, 'hidden');

	return apply_filters('hotel_get_sidebar_mobile', $setting);
}

function hotello_get_sidebar_setting($post_type = 'post', $archive = true)
{

	$is_post_type = hotello_is_hotel_post_type();
	if(!$is_post_type and !is_active_sidebar('default')) return 'full';

	$sidebar = hotello_get_sidebar_option($post_type, $archive);
	$sidebar_name = $sidebar['name'];
	$sidebar_name_pos = $sidebar['position'];

	$s = hotello_get_option($sidebar_name_pos, 'left');

	$sidebar = hotello_get_option($sidebar_name, '');

	if (($sidebar === 'false' and empty($_GET['sidebar'])) || empty($sidebar)) {
		$s = 'full';
	}

	if (!empty($_GET['position'])) {
		$s = sanitize_title($_GET['position']);
	}

	return apply_filters('hotel_get_sidebar_setting', $s);
}

/**
 * Get post settings
 *
 * @return mixed
 */
function hotello_get_post_settings($post_type = 'post', $archive = true)
{

	$settings = array();
	$settings['post_type'] = $post_type;

	$settings['style'] = 'style_' . hotello_get_option($post_type . '_layout', '1');

	$settings['view_type'] = hotello_get_option("{$settings['post_type']}_view", 'list');
	if (!empty($_GET['view'])) $settings['view_type'] = sanitize_title($_GET['view']);

	if ($post_type == 'post') {
		$settings['tpl'] = "/resources/partials/content/{$settings['post_type']}/archive_layouts/{$settings['view_type']}/{$settings['style']}";
	} else {
		$settings['tpl'] = "/resources/partials/content/{$settings['post_type']}/{$settings['view_type']}_{$settings['style']}";
	}
	$settings['breadcrumbs'] = hotello_get_option('page_bc', 'false');

	return apply_filters('hotel_get_post_settings', $settings);
}

function hotello_vc_post_type($post_type)
{
	$choices = array(
		esc_html__('Select', 'hotello') => 0
	);
	if (is_admin()) {
		$posts = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1));
		if ($posts) {
			foreach ($posts as $val) {
				$choices[get_the_title($val)] = $val->ID;
			}
		}
	}

	return apply_filters('hotel_vc_post_type', $choices);
}

function hotello_get_post_types()
{
	$post_types = array();


	if (is_admin()) {
		$av_post_types = get_post_types();
		foreach ($av_post_types as $av_post) {
			$post_type_info = get_post_type_object($av_post);
			$post_types[$post_type_info->labels->name] = $av_post;
		}
	}

	return $post_types;
}

function hotello_base64($data)
{
	$first_part = 'base64';
	$second_part = '_encode';
	$fn = $first_part . $second_part;
	return $fn($data);
}

function hotello_get_temp_by_city_name($city, $units = 'metric')
{
	$api_url = 'http://api.openweathermap.org/data/2.5/weather?q=';
	$app_id = '726d77feab5c453c37f3f57a7ef10177';

	$response = wp_remote_get($api_url . $city . '&APPID=' . $app_id . '&units=' . $units);

	if (!is_wp_error($response) && $response['response']['code'] === 200) {
		$response = json_decode($response['body']);
		$weather = $response->main->temp;
		$icon = $response->weather[0]->icon;

		$response = array(
			'temp' => $weather,
			'icon' => $icon
		);
		return $response;
	}

	return false;
}

function hotello_get_terms_array($id, $taxonomy, $filter, $link = false, $args = '')
{
	$terms = wp_get_post_terms($id, $taxonomy);
	if (!is_wp_error($terms) and !empty($terms)) {
		if ($link) {
			$links = array();
			if (!empty($args)) $args = hotello_array_as_string($args);
			foreach ($terms as $term) {
				$url = get_term_link($term);
				$links[] = "<a {$args} href='{$url}' title='{$term->name}'>{$term->name}</a>";
			}
			$terms = $links;
		} else {
			$terms = wp_list_pluck($terms, $filter);
		}
	} else {
		$terms = array();
	}

	return apply_filters('hotel_get_terms_array', $terms);
}

function hotello_pagination($pagination = array(), $defaults = array())
{
	$style = hotello_get_option('pagination_style', 'style_1');

	$pagination['prev_text'] = '<i class="fa fa-chevron-left"></i>';
	$pagination['next_text'] = '<i class="fa fa-chevron-right"></i>';

	$pagination['type'] = 'array';

	$pagination = wp_parse_args($pagination, $defaults);

	$pagination = paginate_links($pagination);
	if (!empty($pagination)):
		$has_prev = '';
		$has_next = '';
		foreach ($pagination as $page) {
			if (strpos($page, 'prev page-numbers') !== false) $has_prev = 'stm_has_prev';
			if (strpos($page, 'next page-numbers') !== false) $has_next = 'stm_has_next';
		}


		ob_start();

		?>
        <ul class="page-numbers clearfix <?php echo esc_attr($has_prev . ' ' . $has_next) ?>">
			<?php foreach ($pagination as $key => $page):
				$class = 'stm_page_num';
				if (strpos($page, 'prev') !== false) $class = 'stm_prev';
				if (strpos($page, 'next') !== false) $class = 'stm_next';
				?>
                <li class="<?php echo esc_attr($class); ?>">
					<?php echo wp_kses_post($page); ?>
                </li>
			<?php endforeach; ?>
        </ul>

		<?php $pagination = ob_get_clean();
	endif;

	return $pagination;
}

function hotello_get_post_type_by_taxonomy($tax = 'category')
{
	global $wp_taxonomies;
	return (isset($wp_taxonomies[$tax])) ? $wp_taxonomies[$tax]->object_type : array();
}


add_filter('get_search_form', 'hotello_get_search_form');

function hotello_get_search_form()
{
	ob_start();
	get_template_part('resources/partials/global/searchform');
	return ob_get_clean();
}

function hotello_is_shop()
{
	return function_exists('is_shop') ? is_shop() : false;
}


function hotello_array_as_string($arr)
{
	$r = implode(' ', array_map(function ($v, $k) {
		return $k . '="' . $v . '"';
	}, $arr, array_keys($arr)));

	return $r;
}

if (is_super_admin()) {
	add_action('init', 'hotello_update_layout');

	function hotello_update_layout()
	{
		if (isset($_GET['stm_update_layout'])) {
			$layout = $_GET['stm_update_layout'];
			update_option('stm_layout', $layout);
			echo 'layout updated';
			die;
		}
	}
}


function hotello_is_shop_category()
{
	return function_exists('is_product_category') ? is_product_category() : false;
}

function hotello_shop_page_id()
{
	return false;
}

function hotello_is_account_page()
{
	return function_exists('is_account_page') ? is_account_page() : false;
}


function hotello_my_account_page_id()
{
	return false;
}

function hotello_is_active_plugin($slug) {
    $is_active = call_user_func('is_plugin' . '_active', $slug);
    return $is_active;
}


function hotello_get_titlebox()
{
	$titlebox_style = hotello_get_option('page_title_box_style');
	$tpl = 'resources/partials/global/titlebox/' . $titlebox_style;

	if (empty(locate_template($tpl . '.php'))) {
		$titlebox_style = 'style_1';
	}
	get_template_part('resources/partials/global/titlebox/' . $titlebox_style);
}


/**
 * Title box settings (Global or page settings)
 *
 * @param string $id
 * @return mixed
 */
function hotello_title_box_settings($id = '')
{
	$r = array();

	$settings = array(
		'page_title_box',
		'page_title_box_align',
		'page_title_box_title',
		'page_title_box_category',
		'page_title_box_author',
		'page_title_box_title_line',
		'page_title_box_title_size',
		'page_title_box_subtitle',
		'page_title_box_bg_color',
		'page_title_box_bg_image',
		'page_title_box_bg_pos',
		'page_title_box_text_color',
		'page_title_box_line_color',
		'page_title_box_subtitle_color',
		'page_title_box_style',
		'page_title_breadcrumbs',
		'page_title_button',
		'page_title_button_text',
		'page_title_button_url',
		'page_title_prev_next'
	);

	$general_settings = array(
		'page_title_box',
		'page_title_box_bg_image',
		'page_title_box_bg_pos',
	);

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) $id = hotello_get_blog_page();
	if (hotello_is_shop_category()) $id = hotello_shop_page_id();


	$override = hotello_check_string(hotello_get_option('page_title_box_override', 'false'));
	foreach ($settings as $setting) {

		if (!empty($id) and !$override) {
			$post_meta = get_post_meta($id, $setting, true);
		} else {
			$post_meta = hotello_get_option($setting);
		}

		if (in_array($setting, $general_settings) and $override) {
			$post_meta = get_post_meta($id, $setting, true);
			if (empty($post_meta) and $setting !== 'page_title_box') {
				$post_meta = hotello_get_option($setting);
			}
		}

		if ($setting == 'page_title_box') {
			$post_meta = (hotello_check_string($post_meta)) ? 'true' : 'false';
		}

		$r[$setting] = $post_meta;
	}

	if (hotello_is_shop()) {
		$r['page_title_box_title'] = get_the_title($id);
	} else if (hotello_is_account_page()) {
		$r['page_title_box_title'] = get_the_title(hotello_my_account_page_id());
	}

	return apply_filters('hotel_title_box_settings', $r);
}

add_filter('hotel_site_container', 'hotello_site_container');

function hotello_site_container($container)
{
	$vc_status = get_post_meta(get_the_ID(), '_wpb_vc_js_status', true);

	if (empty($vc_status) or !hotello_check_string($vc_status)) return ('container no_vc_container');

	$page_for_posts = get_option('page_for_posts');
	$current_page = get_queried_object();
	if (!is_wp_error($current_page) and !empty($current_page) and !empty($current_page->ID)) {
		$current_page_id = $current_page->ID;
		if ($current_page_id == $page_for_posts) return ('container');
	}

	if (!is_wp_error($current_page) and !empty($current_page->labels)) {
		return ('container');
	}

	if (is_tag() or is_tax() or is_date() or is_category() or is_search()) return ('container');

	return $container;
}

function hotello_preloader_html_class($output)
{
	$enable_loader = hotello_get_option('preloader', false);
	if (hotello_check_string($enable_loader)) {
		if (strpos($output, 'class="') !== false) {
			$loader_class = str_replace('class="', 'class="stm-site-loader ', $output);
		} else {
			$loader_class = ' class="stm-site-loader"';
		}
	} else {
		$loader_class = '';
	}
	$loader_class = apply_filters('stm_preloader_html_class', $loader_class);

	return $output . $loader_class;
}

if (!is_admin()) {
	add_filter('language_attributes', 'hotello_preloader_html_class', 100);
}

function hotello_get_blog_page()
{
	$page_for_posts = get_option('page_for_posts');
	return intval($page_for_posts);
}

function hotello_load_global_element_style($element)
{
	$layout = hotello_get_layout();
	$theme_info = hotello_get_theme_assets_paths();
	$file = HOTELLO_PUBLIC_PATH . '/css/' . $element . '/' . $layout . '.css';

	if (!file_exists($file)) {
		$layout = 'frankfurt';
	}

	$file_src = $theme_info['css'] . $element . '/' . $layout . '.css';

	wp_enqueue_style('hotello-' . $element . '-style', $file_src, 'hotello-app', $theme_info['v']);
}


add_action('init', 'hotello_repair_theme_options');

function hotello_repair_theme_options() {
    if(!empty($_GET['rto'])) {
        $options = hotello_get_option('header_builder');

        die;
    }
}