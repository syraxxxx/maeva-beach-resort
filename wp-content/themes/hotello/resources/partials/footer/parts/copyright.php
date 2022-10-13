<?php
$copyright = hotello_get_option('copyright');
$copyright_text_align_class = '';

if ($copyright):
    $year = hotello_check_string(hotello_get_option('copyright_year'));
    $co = hotello_check_string(hotello_get_option('copyright_co'));

    $co = ($co) ? esc_html__('Copyright &copy;', 'hotello') : '';
    $year = ($year) ? date('Y') : ''; ?>
    <div itemscope
         itemtype="http://schema.org/Organization"
         class="stm_markup__content stm_mf stm_bottom_copyright <?php echo esc_attr($copyright_text_align_class) ?>">
        <span><?php echo sanitize_text_field($co); ?></span>
        <span><?php echo sanitize_text_field($year); ?></span>
        <span itemprop="copyrightHolder"><?php echo wp_kses_post($copyright); ?></span>
    </div>
<?php endif; ?>