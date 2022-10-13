<?php
/*Redirect to theme Welcome screen*/
global $pagenow;

if (is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) && !defined('ENVATO_HOSTED_SITE')) {
	hotello_update_custom_styles();
	wp_redirect(admin_url("admin.php?page=my-hotel"));
}


function stm_get_creds() {

	/*If envato hosted*/
	if ( !defined('ENVATO_HOSTED_SITE') && !defined('SUBSCRIPTION_CODE') ){
		$t = get_option('envato_market', array());
		if( !empty($t['token']) ) {
			$creds['t'] = $t['token'];
		}else{
			$creds['t'] = '';
		}
		$creds['host'] = false;
	}else{
		$creds['t'] = SUBSCRIPTION_CODE;
		$creds['host'] = true;
	}

	return $creds;
}

function stm_check_auth() {

	$creds = stm_get_creds();
	$has_t = get_site_transient('stm_theme_auth');

	if( false === $has_t ) {

		$api_args = array(
			'theme' => STM_ITEM_NAME,
			't' => $creds['t'],
			'host' => $creds['host'],
		);
		$url = add_query_arg( $api_args, STM_API_URL . 'registration/');
		$response = wp_remote_get( $url, array( 'timeout' => 20 ) );

		// Check the response code.
		$response_code = wp_remote_retrieve_response_code( $response );
		$return = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( $response_code == '200' ) {
			set_site_transient('stm_theme_auth', $return['confirm_code'] );
			delete_site_transient('stm_auth_notice');
			return $return['confirm_code'];
		}else{
			set_site_transient('stm_auth_notice', $return['message'] );
			delete_site_transient('stm_theme_auth');
			return false;
		}
	}

	return $has_t;
}

function get_package( $item, $ftype ){

	$packages = array();

	$src = get_transient( 'stm_installer_package' );
	if ( false !== $src ) {
		if ( !empty($src[$item]) ) return $src[$item];
		$packages = $src;
	}

	$creds = stm_get_creds();
	$api_args = array(
		'theme' => STM_ITEM_NAME,
		't' => $creds['t'],
		'item' => $item,
		'ftype' => $ftype,
		'host' => $creds['host'],
	);

	$src = add_query_arg( $api_args, STM_API_URL . 'getpackage/');
	$packages[$item] = $src;
	set_transient( 'stm_installer_package', $packages, 300 );

	return $src;
}


function stm_set_creds() {
	if(isset($_POST['stm_registration'])) {
		if(isset($_POST['stm_registration']['token'])) {
			delete_site_transient('stm_theme_auth');
			delete_transient( 'stm_installer_package' );

			$token = array();
			$token['token'] = sanitize_text_field($_POST['stm_registration']['token']);

			update_option('envato_market', $token);

			$check_auth = stm_check_auth();
			if( !empty($check_auth) ){
				$envato_market = Envato_Market::instance();
				$envato_market->items()->set_themes(true);
			}
		}
	}
}

add_action('init', 'stm_set_creds');

function hotello_convert_memory($size)
{
	$l = substr($size, -1);
	$ret = substr($size, 0, -1);
	switch (strtoupper($l)) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}
	return $ret;
}

function hotello_theme_support_url()
{
	return esc_url('https://stylemixthemes.com/');
}

function hotello_get_admin_images_url($image) {
	return esc_url(get_template_directory_uri() . '/inc/admin/product_registration/assets/img/' . $image);
}

/*Plugin installer via tgmpa*/
add_action('wp_ajax_hotel_install_plugin', 'hotello_install_plugin');
function hotello_install_plugin()
{
    check_ajax_referer('hotello_install_plugin', 'security');
	$r = array();
	$plugins = hotello_require_plugins(true);
	$layout = sanitize_text_field($_GET['layout']);
	$layout_plugins_config = hotello_layout_plugins($layout);
	$layout_plugins = array();

	foreach($plugins as $plugin_name => $plugin_info) {
		if(in_array($plugin_name, $layout_plugins_config)) {
			$layout_plugins[$plugin_name] = $plugin_info;
		}
	}

	$plugins = $layout_plugins;

	$plugin_slug = sanitize_text_field($_GET['plugin']);

	if (!current_user_can('install_plugins')) {
		return;
	}

	/*if install demo*/
	if($plugin_slug === 'import_demo') {
		$r['import_demo'] = true;
		wp_send_json($r);
	}

	/*No plugin*/
	if (empty($plugin_slug) and !empty($plugins[$plugin_slug])) {
		wp_send_json(array('error' => esc_html__('Error occured', 'hotello')));
		exit;
	}

	require_once ABSPATH . 'wp-load.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/class-plugin-upgrader.php';
	require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader-skin.php';
	require_once get_template_directory() . '/inc/admin/product_registration/includes/stm_upgrader_skin.php';


	$plugin_upgrader = new Plugin_Upgrader(new STM_Plugin_Upgrader_Skin(array('plugin' => $plugin_slug)));
	$plugin_info = $plugins[$plugin_slug];
	$next = hotello_get_next($plugins, $plugin_slug);


	if (!empty($plugin_info['source'])) {
		$source = $plugin_info['source'];
	} else {
		$response = plugins_api('plugin_information', array('slug' => $plugin_slug));
		if(!is_wp_error($response) and !empty($response->download_link)) {
			$source = $response->download_link;
		}
	};

	$r['source'] = $source;

	if(!empty($source)) {
		$installed = (hotello_check_plugin_active($plugin_slug)) ? true : $plugin_upgrader->install($source);
		if(is_wp_error($installed)) {
			$r['error'] = $installed->get_error_message();
		} else {
			if(!empty($next)) {
				$r['next'] = $next['slug'];
			}
			hotello_activate_plugin($plugin_slug);
			$r['installed'] = true;
			$r['activated'] = true;
			$r['plugin_slug'] = $plugin_slug;
			if ($plugin_slug === 'hotello') {
                $r['reload'] = true;
            }
		}
	}

	/*Check if last*/
	if(end($plugins) === $plugin_info) $r['import_demo'] = true;

	wp_send_json($r);
	exit;
}

function hotello_check_plugin_active($slug) {
	return hotello_is_active_plugin(hotello_get_plugin_main_path($slug));
}

function hotello_activate_plugin($slug) {
	activate_plugin(hotello_get_plugin_main_path($slug));
}

function hotello_get_plugin_main_path($slug) {
	$plugin_data = get_plugins('/' . $slug);
	if(!empty($plugin_data)) {
		$plugin_file = array_keys($plugin_data);
		$plugin_path = $slug . '/' . $plugin_file[0];
	} else {
		$plugin_path = false;
	}
	return $plugin_path;
}

function hotello_get_next($array, $key)
{
	$currentKey = key($array);
	while ($currentKey !== null && $currentKey != $key) {
		next($array);
		$currentKey = key($array);
	}
	return next($array);
}