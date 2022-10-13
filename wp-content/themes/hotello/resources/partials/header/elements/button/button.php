<?php if (!empty($element['data'])):
    $btn_c = array(
        'btn',
        'btn_primary'
    );

    $icon_styles = array();
    if (!empty($element['data']['icon_size'])) {
        $icon_styles['font-size'] = intval($element['data']['icon_size']) . 'px';
    };

    $icon = $text = $url = '';
    if (!empty($element['data']['icon'])) {
        $icon = $element['data']['icon'];
        $btn_c[] = (empty($element['data']['icon_position'])) ? 'btn_icon-left' : $element['data']['icon_position'];
    }

    $btn_c[] = (empty($element['data']['style'])) ? 'btn_outline' : $element['data']['style'];

    $url = (!empty($element['data']['url'])) ? $element['data']['url'] : '';

    $text = (!empty($element['data']['text'])) ? $element['data']['text'] : '';
    ?>

    <a href="<?php echo esc_url($url); ?>" class="<?php echo implode(' ', $btn_c); ?>">
        <i class="btn__icon <?php echo esc_attr($icon); ?>"
           style="<?php echo esc_attr(hotello_array_to_style_string($icon_styles)); ?>"></i>
        <span class="btn__text">
            <?php echo sprintf(esc_html__('%s', 'hotello'), $text); ?>
        </span>
    </a>

<?php endif; ?>