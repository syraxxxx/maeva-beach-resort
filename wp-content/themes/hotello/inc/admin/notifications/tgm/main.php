<?php
function hotello_admin_notice__install()
{
    $install_class = $activate_class = $update_class = 'stm_update_notice stm_needs_install';
    $layout = get_option('stm_layout', 'chicago');
    $plugins = hotello_require_plugins(true);
    $layout_plugins = hotello_layout_plugins($layout);

    $plugins_to_activate = array();
    $plugins_to_install = array();
    $plugins_to_update = array();

    foreach ($layout_plugins as $layout_plugin) {
        $plugin_path = hotello_get_plugin_main_path($layout_plugin);
        $plugin_abs_path = WP_PLUGIN_DIR . '/' . $plugin_path;

        if (is_plugin_inactive($plugin_path)) {

            if (!empty($plugin_path) && file_exists($plugin_abs_path)) {
                $action = 'activate';
            } else {
                $action = 'install';
            };
            if ($action == 'install') {
                $plugins_to_install[$layout_plugin] = '<a title="' . sprintf(__('Click to %s', 'hotello'), $action) . '" href="' . hotello_admin_tgmpa_url($layout_plugin, $action) . '">' . $plugins[$layout_plugin]['name'] . '</a>';
            } else {
                $plugins_to_activate[$layout_plugin] = '<a title="' . sprintf(__('Click to %s', 'hotello'), $action) . '" href="' . hotello_admin_tgmpa_url($layout_plugin, $action) . '">' . $plugins[$layout_plugin]['name'] . '</a>';
            }
        } else {
            $action = 'update';

            $plugin_data = get_plugin_data($plugin_abs_path);
            $current_version = $plugin_data['Version'];

            if (!empty($plugins[$layout_plugin]['version'])) {
                $new_version = $plugins[$layout_plugin]['version'];
                if (version_compare($current_version, $new_version, '<')) {
                    $plugins_to_update[$layout_plugin] = '<a title="' . sprintf(__('Click to %s', 'hotello'), $action) . '" href="' . hotello_admin_tgmpa_url($layout_plugin, $action) . '">' . $plugins[$layout_plugin]['name'] . '</a>';
                }
            }
        }
    }

    if (!empty($plugins_to_install)) {
        $install_class .= ' notice-visible stm_update_notice__install';
    }

    if (!empty($plugins_to_activate)) {
        $activate_class .= ' notice-visible stm_update_notice__activate';
    }

    if (!empty($plugins_to_update)) {
        $update_class .= ' notice-visible stm_update_notice__update';
        if (count($plugins_to_update) > 0) {
            $upd_all = '<a class="button button-primary" href="' . hotello_build_tgmpa_url(array('plugin_status' => 'update')) . '">' . __('Update all', 'hotello') . '</a>';
        }
    }

    ?>

    <div class="<?php echo esc_attr($install_class); ?>">
        <?php _e('Hotel WP recommends to install following plugins:', 'hotello'); ?>
        <?php echo implode(', ', $plugins_to_install); ?>
    </div>

    <div class="<?php echo esc_attr($activate_class); ?>">
        <?php _e('Hotel WP recommends to activate following plugins:', 'hotello'); ?>
        <?php echo implode(', ', $plugins_to_activate); ?>
    </div>

    <div class="<?php echo esc_attr($update_class); ?>">
        <?php _e('Hotel WP recommends to update following plugins:', 'hotello'); ?>
        <?php echo implode(', ', $plugins_to_update); ?>
        <?php if (!empty($upd_all)) echo esc_attr($upd_all); ?>
    </div>

    <?php
}

function hotello_admin_tgmpa_url($plugin, $action)
{
    $url = wp_nonce_url(
        add_query_arg(
            array(
                'plugin' => urlencode($plugin),
                'tgmpa-' . $action => $action . '-plugin',
            ),
            hotello_tgmpa_url()
        ),
        'tgmpa-' . $action,
        'tgmpa-nonce'
    );

    return $url;
}

function hotello_build_tgmpa_url($query_args)
{
    return add_query_arg($query_args, hotello_tgmpa_url());
}


function hotello_tgmpa_url()
{
    return get_admin_url() . 'themes.php?page=tgmpa-install-plugins';
}
