<?php

/*Require TGM CLASS*/
require_once HOTELLO_ADMIN_INCLUDE_PATH . '/tgm/class-tgm-plugin-activation.php';

/*Register plugins to activate*/
add_action('tgmpa_register', 'hotello_require_plugins');

function hotello_require_plugins($return = false)
{
    $plugins_path = get_template_directory() . '/inc/admin/tgm/plugins';

    $plugins = array(
        'stm-configurations' => array(
            'name' => 'STM Configurations',
            'slug' => 'stm-configurations',
			'source' => get_package( 'stm-configurations', 'zip' ),
            'required' => true,
            'version' => '1.3.1',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'wp-hotelier' => array(
            'name' => 'Easy WP Hotelier',
            'slug' => 'wp-hotelier',
            'required' => true,
            'external_url' => 'https://wphotelier.com'
        ),
        'stm-gdpr-compliance' => array(
            'name' => 'GDPR Compliance & Cookie Consent',
            'slug' => 'stm-gdpr-compliance',
            'source' => get_package( 'stm-gdpr-compliance', 'zip' ),
            'required' => false,
            'version' => '1.1',
            'external_url' => 'https://stylemixthemes.com/'
        ),
        'js_composer' => array(
            'name' => 'WPBakery Page Builder',
            'slug' => 'js_composer',
            'source' => get_package( 'js_composer', 'zip' ),
            'required' => true,
            'version' => '6.0.5',
            'external_url' => 'http://vc.wpbakery.com'
        ),
        'contact-form-7' => array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
            'force_activation' => false,
        ),
        /*Not required for all layouts*/
        'mailchimp-for-wp' => array(
            'name' => 'MailChimp for WordPress',
            'slug' => 'mailchimp-for-wp',
            'required' => false,
            'external_url' => 'https://mc4wp.com/'
        ),
        'revslider' => array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => get_package('revslider', 'zip'),
            'required' => false,
            'version' => '6.1.5',
            'external_url' => 'http://www.themepunch.com/revolution/'
        ),
		'instagram-feed' => array(
			'name' => 'Instagram Feed',
			'slug' => 'instagram-feed',
			'required' => false,
			'external_url' => 'https://smashballoon.com/'
		),
    );


    if ($return) {
        return $plugins;
    } else {
        $config = array(
            'id' => 'hotel_id23432432432',
            'is_automatic' => false
        );

        tgmpa($plugins, $config);
    }
}