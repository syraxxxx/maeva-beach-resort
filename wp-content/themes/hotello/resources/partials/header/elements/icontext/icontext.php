<?php if (!empty($element['data'])): ?>
    <div class="stm-icontext">
        <?php if (!empty($element['data']['icon'])):
            $icon_classes = array('stm-icontext__icon mtc');
            $icon_classes[] = $element['data']['icon'];
            $icon_classes[] = (!empty($element['data']['ifsz'])) ? 'fsz_' . $element['data']['ifsz'] : '';
            ?>
            <i class="<?php echo implode(' ', $icon_classes); ?>"></i>
        <?php endif; ?>
        <?php if (!empty($element['data']['title'])):
            $classes = array();
            $classes[] = (!empty($element['data']['fsz'])) ? 'fsz_' . $element['data']['fsz'] : '';
            ?>
            <span class="stm-icontext__text <?php echo implode(',', $classes); ?>">
                <?php echo sprintf(esc_html__('%s', 'hotello'), $element['data']['title']); ?>
            </span>
        <?php endif; ?>
    </div>
<?php endif; ?>