<?php
$logo = intval(hotello_get_option('logo'));

$wrapper_classes = array('stm_mobile__header');

if (!empty($logo)) {
    $logo = hotello_get_image_url($logo);
}

if(empty($logo)) $logo = get_template_directory_uri() . '/public/images/logos/esperanza.svg';

?>

<div class="stm-header__overlay"></div>

<div class="<?php echo esc_attr(implode(' ', $wrapper_classes)) ?>">
    <div class="container">
        <div class="stm_flex stm_flex_center stm_flex_last stm_flex_nowrap">
            <?php if (!empty($logo)): ?>
                <div class="stm_mobile__logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>"
                       title="<?php esc_attr_e('Home', 'hotello'); ?>">
                        <img src="<?php echo esc_url($logo); ?>"
                             alt="<?php esc_attr_e('Site Logo', 'hotello'); ?>"/>
                    </a>
                </div>
            <?php endif; ?>
            <div class="stm_mobile__switcher stm_flex_last js_trigger__click"
                 data-element=".stm-header, .stm-header__overlay"
                 data-toggle="false">
                <span class="mbc"></span>
                <span class="mbc"></span>
                <span class="mbc"></span>
            </div>
        </div>
    </div>
</div>