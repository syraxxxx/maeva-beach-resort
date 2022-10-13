<?php
/*Register fields for vacancies*/
function hotello_register_page_options_metabox($manager) {
    /*Register sections*/
    $section = 'stm_page_options_section';

	/**
	 * @var $manager ButterBean_Manager
	 */

    $manager->register_section(
        $section,
        array(
            'label' => esc_html__('Page options', 'stm_domain'),
            'icon' => 'fa fa-gear'
        )
    );

    /*Register controls*/
	$manager->register_control(
		'page_bg_color',
		array(
			'type' => 'color',
			'section' => $section,
			'label' => esc_html__('Page background color', 'stm_domain'),
			'default_option' => true,
			'attr' => array(
				'class' => 'color-picker'
			)
		)
	);

    $manager->register_control(
        'page_bc',
        array(
            'type' => 'checkbox',
            'section' => $section,
            'label' => esc_html__('Breadcrumbs', 'stm_domain'),
            'default_option' => true,
        )
    );

	$manager->register_control(
		'page_bc_fullwidth',
		array(
			'type' => 'checkbox',
			'section' => $section,
			'label' => __('Fullwidth breadcrumbs', 'stm_domain'),
			'default_option' => false,
			'attr' => array(
				'class' => 'widefat',
				'data-dep' => 'page_bc',
				'data-value' => 'true'
			)
		)
	);

    $manager->register_control(
        'header_transparent',
        array(
            'type' => 'select',
            'section' => $section,
            'label' => esc_html__('Transparent Header', 'stm_domain'),
            'choices' => array(
                '' => esc_html__('Global Settings', 'stm_domain'),
                'force' => esc_html__('Enable', 'stm_domain'),
                'true' => esc_html__('Disable', 'stm_domain'),
            ),
            'attr' => array(
                'class' => 'widefat',
            )
        )
    );


    /*Register settings*/
	$manager->register_setting(
		'page_bg_color',
		array(
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'page_bc',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );

	$manager->register_setting(
		'page_bc_fullwidth',
		array (
			'sanitize_callback' => 'stm_listings_no_validate',
		)
	);

    $manager->register_setting(
        'header_transparent',
        array (
            'sanitize_callback' => 'stm_listings_no_validate',
        )
    );
}