<?php

function hotello_wp_hotelier_scripts()
{
    $theme_info = hotello_get_theme_assets_paths();

    wp_register_script('stm_rooms_slider', $theme_info['js_vendors'] . 'wp-hotelier/rooms_slider.js', array('hotello-owl-carousel'), $theme_info['v'], true);

    wp_localize_script('hotello-app', 'stm_hotelier_translations', array(
        'check_availability' => esc_html__('Check availability', 'hotello'),
        'book_now' => esc_html__('Book now', 'hotello'),
        'room_available' => esc_html__('Room is available', 'hotello'),
        'room_not_available' => esc_html__('Room is not available', 'hotello'),
        'deposit_required' => esc_html__('Deposit required: ', 'hotello'),
    ));
}

add_action('wp_enqueue_scripts', 'hotello_wp_hotelier_scripts');

function hotello_hotelier_js_vars()
{
    ?>
    <script>
      var hotelier_booking_url = '<?php echo esc_js(htl_get_page_permalink('booking')); ?>';
    </script>
    <?php
}

add_action('wp_head', 'hotello_hotelier_js_vars');
