<?php
wp_enqueue_script('stm_room_availability_form');
$checkin = HTL()->session->get('checkin');
$checkout = HTL()->session->get('checkout');

$room_id = get_the_ID();
$room = new Hotel_Room($room_id);


$variations_data = array();

if ($room->is_variable_room()) {
    $variations = $room->get_room_variations();
    foreach ($variations as $variation) {
        $rate_id = $variation['index'];
        $variation = new Hotel_Room_Vartiation($variation, $room_id);

        $var_price = $variation->get_min_price();


        $data = array(
            'name' => $variation->get_formatted_room_rate(),
            'price_html' => htl_price($var_price),
            'price' => $var_price,
            'id' => $rate_id
        );
        if ($variation->needs_deposit()) {
            $data['deposit'] = $variation->get_formatted_deposit();
        }
        $variations_data[] = $data;
    }
}


?>
<form
        name="hotelier_datepicker"
        method="post" id="stm-single-room-availability"
        class="datepicker-form stm-single-room__availability tbc"
    <?php if ($room->is_variable_room()) : ?>
        data-rate-id="<?php echo esc_attr($variations_data[0]['id']); ?>"
        data-variations="<?php echo esc_attr(json_encode($variations_data)); ?>"
    <?php endif; ?>
        data-room="<?php the_ID(); ?>">

    <div class="form-group">
        <span class="datepicker-input-select-wrapper"><input class="datepicker-input-select" type="text"
                                                             id="hotelier-datepicker-select" value=""></span>
        <input type="text" id="hotelier-datepicker-checkin" class="datepicker-input datepicker-input--checkin"
               name="checkin" value="<?php echo esc_attr($checkin); ?>">
        <input type="text" id="hotelier-datepicker-checkout" class="datepicker-input datepicker-input--checkout"
               name="checkout" value="<?php echo esc_attr($checkout); ?>">
    </div>

    <?php if ($room->is_variable_room()) : ?>
        <div class="form-group">
            <select name="room_rates" class="stm-single-room-availability__room-rates">
                <?php foreach ($variations_data as $variation) : ?>
                    <option value="<?php echo esc_attr($variation['price_html']); ?>"
                            data-price="<?php esc_attr($variation['price']); ?>">
                        <?php echo esc_html($variation['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <div class="stm-single-room__price">
        <span class="stm-single-room__price-val mtc">
            <?php
            if (!$room->is_variable_room()) {
                echo wp_kses_post(htl_price($room->get_min_price()));
            }
            ?>
        </span> / <?php esc_html_e('Per night', 'hotello'); ?>
    </div>

    <?php if ($room->needs_deposit() && !$room->is_variable_room()) : ?>
        <div class="stm-single-room__deposit">
            <?php echo esc_html__('Deposit required: ', 'hotello') . wp_kses_post($room->get_formatted_deposit()); ?>
        </div>
    <?php endif; ?>


    <button type="submit" class="btn btn_primary btn_solid btn_full-width">
        <span><?php echo esc_html__('Check availability', 'hotello'); ?></span>
    </button>
    <div class="availability-message"></div>
</form>