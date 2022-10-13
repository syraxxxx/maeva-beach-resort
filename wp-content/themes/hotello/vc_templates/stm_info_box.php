<?php
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$uniq_class = 'infobox_' . md5(serialize($atts));

$icon_size = (!empty($icon_size)) ? $icon_size : 60;

$inline_styles = '';
$inline_styles .= ".{$uniq_class} .stm_infobox__icon {font-size: {$icon_size}px} ";

if(!empty($image)) $image = hotello_get_VC_attachment_img_safe($image, '480x650', 'full', true);
if(!empty($image)) $inline_styles .= ".{$uniq_class} .stm_infobox_bg {background-image: url('{$image}')} ";

$style = (isset($style)) ? $style : 'style_1';
hotello_add_element_style('infobox', $style, $inline_styles);

?>

<div class="stm_infobox stm_infobox_<?php echo esc_attr($style); ?> <?php echo esc_attr($uniq_class); ?>">

    <div class="stm_infobox_bg"></div>

    <div class="inner">

        <div class="stm_infobox_front">

            <?php if (!empty($icon)): ?>
                <i class="stm_infobox__icon mtc <?php echo esc_attr($icon) ?>"></i>
            <?php endif; ?>

            <?php if (!empty($title)): ?>
                <h4><?php echo wp_kses_post($title); ?></h4>
            <?php endif; ?>

        </div>

        <div class="stm_infobox_back">

            <?php if (!empty($title)): ?>
                <h2><?php echo wp_kses_post($title); ?></h2>
            <?php endif; ?>

            <?php if(!empty($content)): ?>
                <p><?php echo wp_kses_post($content); ?></p>
            <?php endif; ?>

        </div>
    </div>

</div>