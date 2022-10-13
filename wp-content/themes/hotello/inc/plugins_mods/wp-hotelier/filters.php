<?php


add_filter('hotelier_price', 'hotello_hotelier_price', 100, 2);
function hotello_hotelier_price($return, $price)
{
    return $price;
}


add_filter('hotelier_booking_fields', 'hotello_hotelier_booking_fields');
function hotello_hotelier_booking_fields($fields)
{
    $fields_to_unset = array(
        'country', 'address1', 'address2', 'city', 'state', 'postcode'
    );
    foreach ($fields_to_unset as $field) {
        unset($fields['address_fields'][$field]);
    }
    $fields['additional_information_fields']['arrival_time']['label'] = esc_html__('Time of arrival', 'hotello');
    return $fields;
}

//modify booking widgets dates to be dependent on wp date format
add_filter('hotelier_widget_booking_dates', 'hotello_hotelier_widget_booking_dates', 30, 3);
function hotello_hotelier_widget_booking_dates($html, $checkin, $checkout)
{
    $checkin = HTL()->session->get('checkin');
    $checkout = HTL()->session->get('checkout');
    $dateformat = get_option('date_format');

    ob_start(); ?>

    <div class="widget-booking__dates">
        <div class="widget-booking__date-block widget-booking__date-block--checkin">
            <span class="widget-booking__date-label"><?php esc_html_e('Check-in', 'hotello'); ?></span>

            <div class="widget-booking__date">
                <?php echo date_i18n($dateformat, strtotime($checkin)); ?>
            </div>
        </div>

        <div class="widget-booking__date-block widget-booking__date-block--checkout">
            <span class="widget-booking__date-label"><?php esc_html_e('Check-out', 'hotello'); ?></span>

            <div class="widget-booking__date">
                <?php echo date_i18n($dateformat, strtotime($checkout)); ?>
            </div>
        </div>
    </div>

    <?php

    $html = ob_get_clean();
    return $html;
}

//templates hooks
add_filter('hotelier_template_path', 'hotello_hotelier_template_path');
function hotello_hotelier_template_path()
{
    $layout = get_option('stm_layout', 'chicago');

    return 'inc/plugins_mods/wp-hotelier/templates/' . $layout . '/';
}