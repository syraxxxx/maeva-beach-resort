<?php
/**
 * Default layouts configs
 *
 * @return array
 */

function hotello_layout_configs()
{
    $layouts = array(
		'esperanza' => array(
			'main_font' => array(
				'name' => 'Raleway',
				'color' => 'rgba(34, 34, 34, 0.7)',
				'size' => '20',
				'fw' => '400',
				'ln' => '30'
			),
			'secondary_font' => array(
				'name' => 'Questrial',
				'subsets' => 'latin,latin-ext',
				'color' => '#3a3534',
				'fw' => '400'
			),
			'main_color' => '#ffac41',
			'secondary_color' => '#ffac41',
			'third_color' => '#222222',
			'logo' => 'light'
		),
		'alpen' => array(
			'main_font' => array(
				'name' => 'Open Sans',
				'color' => 'rgba(17,17,17.6)',
				'size' => '20',
				'fw' => '400',
				'ln' => '30'
			),
			'secondary_font' => array(
				'name' => 'Rubik',
				'subsets' => 'latin,latin-ext',
				'color' => '#212a42',
				'fw' => '400'
			),
			'main_color' => '#ffac41',
			'secondary_color' => '#ffac41',
			'third_color' => '#222222',
			'logo' => 'light'
		),
        'chicago' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '600'
            ),
            'main_color' => '#ce7e21',
            'secondary_color' => '#ce7e21',
            'third_color' => '#222222',
            'logo' => 'light'
        ),
        'motel' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '600'
            ),
            'main_color' => '#ce7e21',
            'secondary_color' => '#ce7e21',
            'third_color' => '#222222',
            'logo' => 'light'
        ),
        'frankfurt' => array(
            'main_font' => array(
                'name' => 'Open Sans',
                'color' => '#777777',
                'size' => '16',
                'fw' => '400',
                'ln' => '30'
            ),
            'secondary_font' => array(
                'name' => 'Poppins',
                'subsets' => 'latin,latin-ext',
                'color' => '#333333',
                'fw' => '600'
            ),
            'main_color' => '#ce7e21',
            'secondary_color' => '#ce7e21',
            'third_color' => '#222222',
            'logo' => 'light'
        ),
    );

    return $layouts;
}

/**
 * Default layouts configs
 *
 * @return array
 */
function hotello_layout_plugins($layout = 'esperanza', $get_layouts = false)
{
    $required = array(
        'wp-hotelier',
        'stm-configurations',
        'js_composer',
        'contact-form-7'
    );
    $plugins = array(
        'chicago' => array(
            'mailchimp-for-wp',
            'revslider'
        ),
		'esperanza' => array(
			'mailchimp-for-wp',
			'revslider'
		),
		'alpen' => array(
			'mailchimp-for-wp',
			'revslider',
			'instagram-feed'
		),
        'motel' => array(
            'mailchimp-for-wp',
            'revslider'
        ),
        'frankfurt' => array(
            'mailchimp-for-wp',
            'revslider'
        ),
    );

    if ($get_layouts) return $plugins;

    return array_merge($required, $plugins[$layout]);
}