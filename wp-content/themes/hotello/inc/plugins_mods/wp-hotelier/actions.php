<?php


function hotello_save_room_rate($term_id, $tt_id, $taxonomy)
{
    if (isset($_POST['room_rate_icon']) && $taxonomy === 'room_rate') {
        $icon = sanitize_text_field($_POST['room_rate_icon']);
        update_term_meta($term_id, 'room_rate_icon', $icon);
    }
}

add_action('edit_term', 'hotello_save_room_rate', 10, 3);
add_action('create_term', 'hotello_save_room_rate', 10, 3);

//add room facilities iconpicker
add_action('room_facilities_add_form_fields', 'hotello_room_facilities_add_page_iconpicker');
function hotello_room_facilities_add_page_iconpicker()
{
    ?>
    <div class="form-field room_facilities-iconpicker">
        <label for="room_facilities_icon"><?php _e('Room category icon', 'hotello'); ?></label>
        <?php hotello_iconpicker('room_facilities_icon', '', 'room_facilities_icon') ?>
    </div>
    <?php
}

//add room rates iconpicker
add_action('room_rate_add_form_fields', 'hotello_room_rate_add_page_iconpicker');
function hotello_room_rate_add_page_iconpicker()
{
    ?>
    <div class="form-field room_rate-iconpicker">
        <label for="room_rate_icon"><?php _e('Room category icon', 'hotello'); ?></label>
        <?php hotello_iconpicker('room_rate_icon', '', 'room_rate_icon') ?>
    </div>
    <?php
}

add_action('room_facilities_edit_form_fields', 'hotello_room_facilities_edit_page_iconpicker');
function hotello_room_facilities_edit_page_iconpicker($term)
{
    $value = get_term_meta($term->term_id, 'room_facilities_icon', true);

    if (!$value)
        $value = ""; ?>

    <tr class="form-field room_facilities-iconpicker">
        <th scope="row"><label for="room_facilities_icon"><?php _e('Room rate icon', 'hotello'); ?></label></th>
        <td>
            <?php hotello_iconpicker('room_facilities_icon', $value, 'room_facilities_icon') ?>
        </td>
    </tr>
<?php }


add_action('room_rate_edit_form_fields', 'hotello_room_rate_edit_page_iconpicker');
function hotello_room_rate_edit_page_iconpicker($term)
{
    $value = get_term_meta($term->term_id, 'room_rate_icon', true);

    if (!$value)
        $value = ""; ?>

    <tr class="form-field room_rate-iconpicker">
        <th scope="row"><label for="room_rate_icon"><?php _e('Room rate icon', 'hotello'); ?></label></th>
        <td>
            <?php hotello_iconpicker('room_rate_icon', $value, 'room_rate_icon') ?>
        </td>
    </tr>
<?php }

add_action('template_redirect', 'hotello_hotelier_add_filter_params');
function hotello_hotelier_add_filter_params()
{
    if (is_listing()) {
        if (!empty($_POST['guests'])) {
            $_GET['guests'] = sanitize_text_field($_POST['guests']);
        }
        if (!empty($_POST['children'])) {
            $_GET['children'] = sanitize_text_field($_POST['children']);
        }
    }
}

add_action('edit_term', 'hotello_save_room_facilities', 10, 3);
add_action('create_term', 'hotello_save_room_facilities', 10, 3);
function hotello_save_room_facilities($term_id, $tt_id, $taxonomy)
{
    if (isset($_POST['room_facilities_icon']) && $taxonomy === 'room_facilities') {
        $icon = sanitize_text_field($_POST['room_facilities_icon']);
        $res = update_term_meta($term_id, 'room_facilities_icon', $icon);
    }
}


remove_action('hotelier_sidebar', 'hotelier_get_sidebar', 10);
remove_action('hotelier_single_room_details', 'hotelier_template_single_room_datepicker', 5);
remove_action('hotelier_single_room_description', 'hotelier_template_single_room_description', 10);
remove_action('hotelier_single_room_description', 'hotelier_template_single_room_price', 10);
remove_action('hotelier_single_room_details', 'hotelier_template_single_room_price', 10);
remove_action('hotelier_single_room_rates', 'hotelier_template_single_room_rates', 10);

add_action('hotelier_single_room_details', 'hotelier_template_single_room_description', 35);

remove_action('hotelier_single_room_details', 'hotelier_template_single_room_facilities', 40);
remove_action('hotelier_single_room_details', 'hotelier_template_single_room_meta', 30);
add_action('hotelier_single_room_details', 'hotelier_template_single_room_facilities', 30);
add_action('hotelier_single_room_details', 'hotelier_template_single_room_meta', 40);

remove_action('hotelier_room_list_datepicker', 'hotelier_template_datepicker', 10);
add_action('hotelier_room_list_datepicker', 'hotello_rooms_list_datepicker', 10);
function hotello_rooms_list_datepicker()
{
    htl_get_template('room-list/datepicker.php');
}


//move rooms left to image
remove_action('hotelier_room_list_item_title', 'hotelier_template_rooms_left', 10);
add_action('hotelier_room_list_item_images', 'hotelier_template_rooms_left', 30, 3);

//remove room desription in rooms list
remove_action('hotelier_room_list_item_description', 'hotelier_template_loop_room_short_description', 10);

//sale badge *rooms-list
add_action('hotelier_room_list_item_images', 'hotello_sale_price_badge_template', 3, 40);
function hotello_sale_price_badge_template($is_available, $checkin, $checkout)
{
    htl_get_template('room-list/content/sale.php', array(
        'checkin' => $checkin,
        'checkout' => $checkout
    ));
}


function hotello_hotelier_room_sidebar()
{
    dynamic_sidebar('hotelier_room_sidebar');
}

function hotello_hotelier_room_availability_form()
{
    htl_get_template('single-room/availability-form.php');
}

add_action('hotelier_sidebar', 'hotello_hotelier_room_availability_form', 5);
add_action('hotelier_sidebar', 'hotello_hotelier_room_sidebar', 10);

function hotello_hotelier_room_sidebar_register()
{
    register_sidebar(array(
        'name' => esc_html__('Room sidebar', 'hotello'),
        'id' => 'hotelier_room_sidebar',
        'description' => esc_html__('Single room sidebar.', 'hotello'),
        'before_widget' => '<div id="%1$s" class="widget widget-default widget-footer %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widgettitle widget-footer-title"><h4>',
        'after_title' => '</h4></div>',
    ));
}

add_action('widgets_init', 'hotello_hotelier_room_sidebar_register');
//add_action('after_setup_theme', 'hotello_hotelier_room_sidebar_register');

//move rate deposit info before description *room-list
remove_action('hotelier_room_list_item_rate_content', 'hotelier_template_loop_room_rate_description', 15);
remove_action('hotelier_room_list_item_rate_content', 'hotelier_template_loop_room_rate_deposit', 25);

add_action('hotelier_room_list_item_rate_content', 'hotelier_template_loop_room_rate_deposit', 15);
add_action('hotelier_room_list_item_rate_content', 'hotelier_template_loop_room_rate_description', 19); //insert before conditions

//remove min max from rate *room-list
remove_action('hotelier_template_loop_room_rate_min_max_info', 'hotelier_template_loop_room_rate_min_max_info');

//remove guests select from checkout
remove_action('hotelier_reservation_table_guests', 'hotelier_reservation_table_guests', 10);


add_action('hotel_hotelier_booking_cards', 'hotello_hotelier_booking_cards', 10);
function hotello_hotelier_booking_cards()
{
    htl_get_template('booking/reservation-cards.php', array(
        'cards' => HTL_Info::get_hotello_accepted_credit_cards()
    ));
}


add_action('hotelier_after_widget_booking', 'hotello_hotelier_booking_widget_reservation_received_info');

function hotello_hotelier_booking_widget_reservation_received_info()
{
    global $wp;
    if (isset($wp->query_vars['reservation-received'])) {
        $reservation_id = $wp->query_vars['reservation-received'];
        $reservation = htl_get_reservation($wp->query_vars['reservation-received']);
        $htl_reservation = new HTL_Reservation($reservation_id);
        $total = $htl_reservation->get_formatted_total();
        ?>
        <div class="stm-reservation">
            <?php
            foreach ($reservation->get_items() as $item_id => $item) :
                $rate_name = (!empty($item['rate_name'])) ? $item['rate_name'] : '';
                ?>
                <div class="stm-reservation__room">
                    <div class="stm-reservation__room-name">
                        <h5>
                            <a href="<?php the_permalink($item_id); ?>" title="<?php echo esc_attr($item['name']) ?>">
                                <?php echo wp_kses_post($item['name']); ?>
                            </a>
                        </h5>
                    </div>
                    <div class="stm-reservation__room-rate">
                        <?php echo esc_html__('Rate:', 'hotello') . ' ' . $rate_name; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="stm-reservation__total">
                <div class="stm-reservation__total-label">
                    <?php echo esc_html__('Total:', 'hotello'); ?>
                </div>
                <div class="stm-reservation__total-value">
                    <?php echo wp_kses_post($total); ?>
                </div>
            </div>
        </div>
        <?php

    }
}