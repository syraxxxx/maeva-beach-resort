<?php

add_action('init', 'hotello_add_vc_core_params');

function hotello_add_vc_core_params()
{

	vc_add_params( 'vc_video', array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Iframe Link', 'hotello' ),
			'param_name' => 'link'
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Preview Image', 'hotello' ),
			'param_name' => 'image'
		),
	) );

    $vc_row_params = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Row divider', 'hotello'),
            'param_name' => 'stm_row_divider',
            'value' => array(
                esc_html__('None', 'hotello') => '',
                esc_html__('Top', 'hotello') => 'top',
                esc_html__('Bottom', 'hotello') => 'bottom',
                esc_html__('Both', 'hotello') => 'both',
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Row divider style', 'hotello'),
            'param_name' => 'stm_row_divider_style',
            'value' => array(
                esc_html__('Saw', 'hotello') => 'saw',
            ),
            'std' => 'saw',
            'dependency' => array(
                'element' => 'stm_row_divider',
                'not_empty' => true
            ),
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('STM Parallax', 'hotello'),
            'param_name' => 'stm_parallax',
            'value' => array(
                esc_html__('Disable', 'hotello') => 'disable',
                esc_html__('Enable', 'hotello') => 'enable',
            ),
            'std' => 'disable',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('STM Ken Burns', 'hotello'),
            'param_name' => 'stm_kenburns',
            'value' => array(
                esc_html__('Disable', 'hotello') => 'disable',
                esc_html__('Enable', 'hotello') => 'enable',
            ),
            'std' => 'disable',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__('Animated gradient background', 'hotello'),
            'param_name' => 'gradient_animation',
            'description' => esc_html__('Enter gradient colors on each line', 'hotello'),
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Row transparent first background color', 'hotello'),
            'param_name' => 'stm_transparent_bg',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Row transparent second background color', 'hotello'),
            'param_name' => 'stm_transparent_bg_2',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Background position', 'hotello'),
            'param_name' => 'bg_pos',
            'value' => '',
            'description' => esc_html__('Enter background position in px or %. Ex.: 50% 50% or 100px 50px', 'hotello'),
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show background on tablet', 'hotello'),
            'param_name' => 'show_bg_mobile',
            'value' => array(
                esc_html__('Show', 'hotello') => 'enable',
                esc_html__('Hide', 'hotello') => 'disable',
            ),
            'std' => 'enable',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Show background on mobile', 'hotello'),
            'param_name' => 'show_bg_mobile_xs',
            'value' => array(
                esc_html__('Show', 'hotello') => 'enable',
                esc_html__('Hide', 'hotello') => 'disable',
            ),
            'std' => 'enable',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Row Top Bump', 'hotello'),
            'param_name' => 'bump',
            'value' => array(
                esc_html__('Disable', 'hotello') => '',
                esc_html__('Enable', 'hotello') => 'round',
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Bump position', 'hotello'),
            'param_name' => 'bump_pos',
            'value' => array(
                esc_html__('Top', 'hotello') => '',
                esc_html__('Bottom', 'hotello') => 'bottom',
            ),
            'dependency' => array(
                'element' => 'bump',
                'value' => 'round'
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Row Background Round', 'hotello'),
            'param_name' => 'round_effect',
            'value' => array(
                esc_html__('Disable', 'hotello') => '',
                esc_html__('Enable', 'hotello') => 'round',
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Background Image', 'hotello'),
            'param_name' => 'round_effect_image',
            'dependency' => array(
                'element' => 'round_effect',
                'value' => 'round'
            ),
            'group' => esc_html__('Design Options', 'hotello')
        )
    );

    foreach (hotello_vc_add_shadow_params() as $shadow_param) {
        $vc_row_params[] = $shadow_param;
    }

    vc_add_params('vc_row', $vc_row_params);

    $vc_column_params = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Stretch column', 'hotello'),
            'param_name' => 'stretch',
            'value' => array(
                esc_html__('Default', 'hotello') => '',
                esc_html__('Stretch out to the left', 'hotello') => 'left',
                esc_html__('Stretch out to the right', 'hotello') => 'right',
            ),
            'std' => '',
            'weight' => 2
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Stretch content', 'hotello'),
            'param_name' => 'content_stretch',
            'value' => '',
            'std' => '',
            'dependency' => array(
                'element' => 'stretch',
                'not_empty' => true
            ),
            'weight' => 1
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Background position', 'hotello'),
            'param_name' => 'bg_pos',
            'value' => '',
            'description' => esc_html__('Enter background position in px or %. Ex.: 50% 50% or 100px 50px', 'hotello'),
            'group' => esc_html__('Design Options', 'hotello')
        ),
    );
    foreach (hotello_vc_add_shadow_params() as $shadow_param) {
        $vc_column_params[] = $shadow_param;
    }

    vc_add_params('vc_column', $vc_column_params);

    $vc_column_inner_params = array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Background position', 'hotello'),
            'param_name' => 'bg_pos',
            'value' => '',
            'description' => esc_html__('Enter background position (X, Y) in px or %. Ex.: 50% 50% or 100px 50px', 'hotello'),
            'group' => esc_html__('Design Options', 'hotello')
        ),
    );
    foreach (hotello_vc_add_shadow_params() as $shadow_param) {
        $vc_column_inner_params[] = $shadow_param;
    }

    vc_add_params('vc_column_inner', $vc_column_inner_params);

    vc_add_params('vc_custom_heading', array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__('Icon', 'hotello'),
            'param_name' => 'heading_icon',
            'value' => '',
            'dependency' => array(
                'element' => 'heading_line',
                'value' => 'no_line'
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Position', 'hotello'),
            'param_name' => 'heading_icon_pos',
            'value' => array(
                esc_html__('Top', 'hotello') => '',
                esc_html__('Right', 'hotello') => 'right',
                esc_html__('Bottom', 'hotello') => 'bottom',
                esc_html__('Left', 'hotello') => 'left',
            ),
            'dependency' => array(
                'element' => 'heading_line',
                'value' => 'no_line'
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Color', 'hotello'),
            'param_name' => 'heading_icon_color',
            'value' => array(
                esc_html__('Primary', 'hotello') => 'mtc',
                esc_html__('Secondary', 'hotello') => 'stc',
                esc_html__('Third', 'hotello') => 'ttc',
                esc_html__('Custom', 'hotello') => 'custom',
            ),
            'dependency' => array(
                'element' => 'heading_line',
                'value' => 'no_line'
            ),
            'std' => 'stc',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Color', 'hotello'),
            'param_name' => 'heading_icon_custom_color',
            'std' => '#909090',
            'dependency' => array(
                'element' => 'heading_icon_color',
                'value' => 'custom'
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Text transform', 'hotello'),
            'param_name' => 'text_transform',
            'value' => array(
                esc_html__('Default', 'hotello') => '',
                esc_html__('Uppercase', 'hotello') => 'text-uppercase',
                esc_html__('Lowercase', 'hotello') => 'text-lowercase',
            ),
            'std' => '',
            'group' => esc_html__('Design Options', 'hotello')
        ),
    ));

}