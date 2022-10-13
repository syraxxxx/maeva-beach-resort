<?php
add_action('butterbean_register', 'stm_page_register_manager', 10, 2);

function stm_page_register_manager($butterbean, $post_type)
{
    $default = array(
        'page',
        'post',
        'stm_testimonials',
        'stm_vacancies',
        'stm_projects',
        'stm_services',
        'stm_events',
        'stm_stories',
		'stm_albums',
		'stm_video',
		'stm_donations',
		'stm_media_events',
		'stm_staff',
		'stm_products',
		'product',
		'room'
    );

    if(!in_array($post_type, $default)) return;

    $butterbean->register_manager(
        'stm_default_fields',
        array(
            'label' => esc_html__('STM View settings', 'stm_domain'),
            'post_type' => $default,
            'context' => 'normal',
            'priority' => 'high'
        )
    );

    $manager = $butterbean->get_manager('stm_default_fields');

    /*Register tabs for different post types*/
    /*Some of tabs are global for all post types like title box*/

    if($post_type == 'stm_projects') {
        hotello_register_projects_box($manager);
    }

    if($post_type == 'stm_vacancies') {
        hotello_register_vacancies_metabox($manager);
    }

    if($post_type == 'stm_testimonials') {
        hotello_register_testimonials_metabox($manager);
    }

    if($post_type == 'stm_services') {
        hotello_register_services_metabox($manager);
    }

    if($post_type == 'stm_stories') {
        hotello_register_stories_metabox($manager);
    }

	if($post_type == 'stm_albums') {
        hotello_register_music_metabox($manager);
	}

	if($post_type == 'stm_video') {
        hotello_register_video_metabox($manager);
	}

    if($post_type == 'stm_events') {
        hotello_register_events_metabox($manager);
    }

    if($post_type == 'stm_donations') {
        hotello_register_donations_metabox($manager);
	}

	if($post_type == 'stm_media_events') {
        hotello_register_media_event_metabox($manager);
	}

	if($post_type == 'stm_staff') {
        hotello_register_staff_metabox($manager);
	}

	if($post_type == 'stm_products') {
        hotello_register_products_info_metabox($manager);
        hotello_register_products_metabox($manager);
	}

    if($post_type == 'product') {
        hotello_register_product_metabox($manager);
    }

    hotello_register_title_box_metabox($manager, $post_type);
    hotello_register_page_options_metabox($manager);

	if($post_type == 'post') {
        hotello_register_post_box($manager);
        hotello_register_stats_metabox($manager);
	}

	if($post_type == 'page') {
        hotello_register_page_sidebar_metabox($manager);
    }
}