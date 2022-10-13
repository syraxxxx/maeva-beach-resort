<?php
//Register scripts and styles for admin pages
function hotello_startup_styles()
{
    wp_enqueue_style('stm-startup_css', get_template_directory_uri() . '/inc/admin/product_registration/assets/css/style.css', null, 1.6, 'all');
}

add_action('admin_enqueue_scripts', 'hotello_startup_styles');

//Register Startup page in admin menu
function hotello_register_startup_screen()
{
    $theme = hotello_get_theme_info();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'my-hotel';

    // Work around for theme check.
    $stm_admin_menu_page_creation_method = 'add' . '_menu_page';
    $stm_admin_submenu_page_creation_method = 'add' . '_submenu_page';

    if (!defined('ENVATO_HOSTED_SITE')) {
        /*Item Registration*/
        $stm_admin_menu_page_creation_method(
            $theme_name,
            esc_html__('Hotello', 'hotello'),
            'manage_options',
            $theme_name_sanitized,
            'hotello_theme_admin_page_functions',
            get_template_directory_uri() . '/public/images/admin/icon.png',
            '2.1111111111'
        );

        /*My hotel*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('My Hotel', 'hotello'),
            esc_html__('My Hotel', 'hotello'),
            'manage_options',
            'my-hotel',
            'hotello_theme_admin_page_functions'
        );

        /*Theme options*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Theme options', 'hotello'),
            esc_html__('Theme options', 'hotello'),
            'manage_options',
            'hotel-theme-options',
            'hotello_theme_options'
        );
        /*Demo Import*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Demo import', 'hotello'),
            esc_html__('Demo import', 'hotello'),
            'manage_options',
            $theme_name_sanitized . '-demos',
            'hotello_theme_admin_install_demo_page'
        );

        /*System status*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('System status', 'hotello'),
            esc_html__('System status', 'hotello'),
            'manage_options',
            $theme_name_sanitized . '-system-status',
            'hotello_theme_admin_system_status_page'
        );

        /*Support page*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Support', 'hotello'),
            esc_html__('Support', 'hotello'),
            'manage_options',
            $theme_name_sanitized . '-support',
            'hotello_theme_admin_support_page'
        );
    } else {
        /*Demo Import*/
        $stm_admin_menu_page_creation_method(
            $theme_name,
            esc_html__('hotel', 'hotello'),
            'manage_options',
            $theme_name_sanitized,
            'hotello_theme_admin_install_demo_page',
            get_template_directory_uri() . '/inc/admin/product_registration/assets/img/icon.png',
            '2.1111111111'
        );

        /*Theme options*/
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Theme options', 'hotello'),
            esc_html__('Theme options', 'hotello'),
            'manage_options',
            'hotel-theme-options',
            'hotello_theme_options'
        );
    }


    /*Theme options export*/
    if (!empty($_GET['stm_get_to'])) {
        $stm_admin_submenu_page_creation_method(
            $theme_name_sanitized,
            esc_html__('Theme options export', 'hotello'),
            esc_html__('Theme options export', 'hotello'),
            'manage_options',
            'gigant-theme-options-export',
            'hotello_theme_options_export'
        );
    }
}

add_action('admin_menu', 'hotello_register_startup_screen', 20);

function hotello_startup_templates($path)
{
    $path = 'inc/admin/product_registration/screens/' . $path . '.php';

    $located = locate_template($path);

    if ($located) {
        load_template($located);
    }
}

//Startup screen menu page welcome
function hotello_theme_admin_page_functions()
{
    hotello_startup_templates('startup');
}

/*Support Screen*/
function hotello_theme_admin_support_page()
{
    hotello_startup_templates('support');
}

/*Install Plugins*/
function hotello_theme_admin_plugins_page()
{
    hotello_startup_templates('plugins');
}

/*Install Demo*/
function hotello_theme_admin_install_demo_page()
{
    hotello_startup_templates('install_demo');
}

/*System status*/
function hotello_theme_admin_system_status_page()
{
    hotello_startup_templates('system_status');
}

//Admin tabs
function hotello_get_admin_tabs($screen = 'welcome')
{
    $theme = hotello_get_theme_info();
    $creds = stm_get_creds();
    $theme_name = $theme['name'];
    $theme_name_sanitized = 'stm-admin';
    if (empty($screen)) {
        $screen = $theme_name_sanitized;
    }
    ?>
    <div class="clearfix">
        <div class="stm_theme_info">
            <div class="stm_theme_version"><?php echo substr($theme['v'], 0, 3); ?></div>
        </div>
        <div class="stm-about-text-wrap">
            <h1><?php printf(esc_html__('Welcome to %s', 'hotello'), $theme_name); ?></h1>
        </div>
    </div>
    <?php $notice = get_site_transient('stm_auth_notice');
    if (!empty($creds['t']) && !empty($notice)): ?>
        <div class="stm-admin-message"><strong>Theme Registration Error:</strong> <?php echo esc_attr($notice); ?></div>
    <?php endif; ?>
    <h2 class="nav-tab-wrapper">
        <?php if (!defined('ENVATO_HOSTED_SITE')): ?>
            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-hotel')); ?>"
               class="<?php echo ('welcome' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Product Registration', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-hotel-demos')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
               class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=hotel-theme-options')); ?>"
               class="nav-tab"><?php esc_attr_e('Theme Options', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-hotel-support')); ?>"
               class="<?php echo ('support' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Support', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-hotel-system-status')); ?>"
               class="<?php echo ('system-status' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('System Status', 'hotello'); ?></a>
        <?php else: ?>
            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=my-hotel')); ?>"
               class="<?php echo ('demos' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Install Demos', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=tgmpa-install-plugins')); ?>"
               class="<?php echo ('plugins' === $screen) ? 'nav-tab-active' : ''; ?> nav-tab"><?php esc_attr_e('Plugins', 'hotello'); ?></a>

            <a href="<?php echo esc_url_raw(admin_url('admin.php?page=hotel-theme-options')); ?>"
               class="nav-tab"><?php esc_attr_e('Theme Options', 'hotello'); ?></a>
        <?php endif; ?>
    </h2>
    <?php
}