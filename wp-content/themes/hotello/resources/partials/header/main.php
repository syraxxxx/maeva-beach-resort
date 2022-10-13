<?php
$elements = apply_filters('hotel_builder_elements', hotello_get_option('header_builder'));
$parts = hotello_header_parts();
$rows = $parts['rows'];
$cells = $parts['cells'];

$row_wrapper = 'stm-header__row_color stm-header__row_color_';
$row_base = 'stm-header__row stm-header__row_';
$cell_base = 'stm-header__cell stm-header__cell_';
$element_base = 'stm-header__element';
$theme_info = hotello_get_theme_assets_paths();
wp_add_inline_style('hotello-row_style_1', '.kokoko {text-align: center;}');

?>

    <div class="stm-header">
        <?php foreach ($rows as $row): ?>
            <?php if (!empty($elements[$row])): ?>
                <div class="<?php echo sanitize_text_field($row_wrapper . $row) ?>">
                    <?php
                    $fullwidth = hotello_get_option($row . '_header_fullwidth', false);
                    $fullwidth = hotello_check_string($fullwidth) ? 'fullwidth-header-part' : 'container';
                    ?>
                    <div class="<?php echo esc_attr($fullwidth); ?>">
                        <div class="<?php echo sanitize_text_field($row_base . $row) ?>">
                            <?php foreach ($cells as $cell):
                                if (!empty($elements[$row][$cell])): ?>
                                    <div class="<?php echo sanitize_text_field($cell_base . $cell) ?>">
                                        <?php if (!empty($elements[$row][$cell])):
                                            foreach ($elements[$row][$cell] as $key => $element):
                                                $custom_css = '';
                                                if (!empty($element['uniqueId'])) {
                                                    $custom_css = sanitize_title($element['uniqueId']);
                                                }
                                                $custom_css .= hotello_element_style($element);
                                                if (!empty($element['disabled'])) {
                                                    if (!empty($element['disabled']['mobile'])) {
                                                        $custom_css .= ' hidden-mobile';
                                                    }
                                                    if (!empty($element['disabled']['tablet'])) {
                                                        $custom_css .= ' hidden-tablet';
                                                    }
                                                }
                                                ?>
                                                <div class="<?php echo sanitize_text_field($element_base . ' ' . $custom_css); ?>">
                                                    <?php
                                                    hotello_load_element($element['type'], array('element' => $element, 'theme_info' => $theme_info));
                                                    ?>
                                                </div>
                                            <?php endforeach;
                                        endif; ?>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif;
        endforeach; ?>
    </div>

<?php
/*Mobile Page*/
get_template_part('resources/partials/header/mobile'); ?>