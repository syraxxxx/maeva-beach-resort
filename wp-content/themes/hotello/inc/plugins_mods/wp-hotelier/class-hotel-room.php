<?php

class Hotel_Room extends HTL_Room
{
    public function get_min_price()
    {
        $min_price = 0;

        if ($this->is_variable_room()) {
            $variations = $this->get_room_variations();
            $count_variations = count($variations);
            $prices = array();

            for ($i = 1; $i <= $count_variations; $i++) {
                $variation = $this->get_room_variation($i);

                if ($variation->has_seasonal_price()) {
                    // seasonal price schema
                    $rules = htl_get_seasonal_prices_schema();

                    // check only the rules stored in the schema
                    // we don't allow 'orphan' rules
                    foreach ($rules as $key => $value) {

                        // check if this rule has a price
                        if (isset($variation->variation['seasonal_price'][$key]) && $variation->variation['seasonal_price'][$key] > 0) {
                            $prices[] = $variation->variation['seasonal_price'][$key];
                        }
                    }

                    // get also the default price
                    $prices[] = $variation->variation['seasonal_base_price'];

                } else if ($variation->is_price_per_day()) {
                    if ($variation->variation['sale_price_day']) {
                        $variation_min_price = min($variation->variation['sale_price_day']);
                        $prices[] = $variation_min_price;

                    } elseif ($variation->variation['price_day']) {
                        $variation_min_price = min($variation->variation['price_day']);
                        $prices[] = $variation_min_price;
                    }

                } else {

                    if ($variation->variation['sale_price']) {
                        $variation_min_price = $variation->variation['sale_price'];
                        $prices[] = $variation_min_price;

                    } elseif ($variation->variation['regular_price']) {
                        $variation_min_price = $variation->variation['regular_price'];
                        $prices[] = $variation_min_price;
                    }
                }
            }

            $min_price = $prices ? min($prices) / 100 : 0; // (prices are stored as integers)

            if ($min_price <= 0) {
                $min_price = false;
            }

        } else {

            if ($this->has_seasonal_price()) {
                $prices = array();

                // seasonal price schema
                $rules = htl_get_seasonal_prices_schema();

                if (is_array($rules)) {
                    // get room seasonal prices
                    $seasonal_prices = $this->seasonal_price;

                    // check only the rules stored in the schema
                    // we don't allow 'orphan' rules
                    foreach ($rules as $key => $value) {

                        // check if this rule has a price
                        if (isset($seasonal_prices[$key]) && $seasonal_prices[$key] > 0) {
                            $prices[] = $seasonal_prices[$key];
                        }

                    }

                    // get also the default price
                    $prices[] = $this->seasonal_base_price;
                }

                $min_price = $prices ? min($prices) / 100 : 0; // (prices are stored as integers)

                if ($min_price <= 0) {
                    $min_price = false;
                }

            } else if ($this->is_price_per_day()) {

                if ($this->sale_price_day) {
                    $min_price = min($this->sale_price_day) / 100; // (prices are stored as integers)

                } elseif ($this->regular_price_day) {
                    $min_price = min($this->regular_price_day) / 100; // (prices are stored as integers)
                }

                if ($min_price <= 0) {
                    $min_price = false;
                }

            } else {

                if ($this->sale_price) {
                    $min_price = $this->sale_price / 100; // (prices are stored as integers)

                } elseif ($this->regular_price) {
                    $min_price = $this->regular_price / 100; // (prices are stored as integers)
                }

                if ($min_price <= 0) {
                    $min_price = false;
                }
            }

        }

        $min_price = apply_filters('hotel_hotelier_min_price', $min_price, $this);

        return $min_price;
    }

    public function get_rooms($page = 1, $room_type = false, $args = array())
    {
        /**
         * @var $rooms_types WP_Term
         */
        $rooms_types = $this->get_rooms_types();
        $default_args = array(
            'post_type' => 'room',
        );
        if (!empty($this->atts['per_page'])) {
            $default_args['posts_per_page'] = $this->atts['per_page'];
            $default_args['paged'] = $page;
        }
        if (!empty($rooms_types) && !is_wp_error($rooms_types)) {
            $default_args['tax_query'] = array(
                array(
                    'taxonomy' => 'room_cat',
                    'field' => 'slug',
                    'terms' => $rooms_types[0]['slug']
                )
            );
            if (!empty($_GET['room_type'])) {
                $default_args['tax_query'][0]['terms'] = $_GET['room_type'];
            }
            if (!empty($room_type)) {
                $default_args['tax_query'][0]['terms'] = $room_type;
            }
        }
        $args = wp_parse_args($args, $default_args);
        $rooms = new WP_Query($args);

        return $rooms;
    }

    public function single_room($room_id)
    {
        $room_data = new Hotel_Room($room_id);
        $price = $room_data->get_min_price();
        $max_guests = $room_data->get_max_guests();
        $max_children = $room_data->get_max_children();
        ?>
        <li class="stm-room__container">
            <div class="stm-room">
                <div class="stm-room__image">
                    <?php echo hotello_get_VC_post_img_safe($room_id, '370x200'); ?>
                    <div class="stm-room__price mbc heading_font">
                        <?php
                        $night = esc_html__('/Night', 'hotello');
                        echo sprintf('<span>%s</span>' . $night, $price);
                        ?>
                    </div>
                    <div class="stm-room__link">
                        <a href="<?php the_permalink(); ?>"
                           class="btn btn_white btn_outline btn_icon btn_icon-right">
                            <?php _e('Check details', 'hotello') ?>
                            <i class="btn__icon stmicon-keyboard_arrow_right"></i>
                        </a>
                    </div>
                </div>
                <div class="stm-room__content">
                    <div class="stm-room__title">
                        <h4>
                            <a class="ttc no_deco mtc_h" href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>
                    </div>
                    <div class="stm-room__excerpt ttc">
                        <?php echo hotello_truncate_text(get_the_excerpt($room_id), 80); ?>
                    </div>
                    <div class="stm-room__occupancy">
                        <span><i class="stmicon-hotel-peoples mtc"></i><?php echo esc_html__('Occupancy', 'hotello') . ':'; ?></span>
                        <span>
                                <?php
                                echo sprintf(__('%1s adult(s)', 'hotello'), $max_guests);
                                if (!empty($max_children)) {
                                    echo ' ' . __('and', 'hotello') . ' ' . sprintf(__('%1s child(ren)', 'hotello'), $max_children);
                                }
                                ?>
                            </span>
                    </div>
                </div>
            </div>
        </li>
        <?php
    }

    public function get_final_price($checkin, $checkout)
    {
        if ($this->is_variable_room()) {
            $variations = $this->get_room_variations();
            $count_variations = count($variations);
            $prices = array();

            for ($i = 1; $i <= $count_variations; $i++) {
                $variation = $this->get_room_variation($i);

                if ($variation->get_price($checkin, $checkout)) {
                    $prices[] = $variation->get_price($checkin, $checkout);
                }
            }

            $min_price = false;

            if (!empty($prices)) {
                // Get min price of rates
                $min_price = min($prices) / 100; // (prices are stored as integers)
            }

            if ($min_price && $min_price > 0) {

                $price = $min_price;

            } else {

                $price = false;

            }

        } elseif ($get_price = $this->get_price($checkin, $checkout)) {

            if ($this->is_on_sale($checkin, $checkout)) {
                $price = $this->get_sale_price($checkin, $checkout) / 100;

            } else {

                $price = $get_price / 100;

            }

        } else {

            $price = false;

        }

        return $price;
    }

}