<?php

class Hotel_Room_Vartiation extends HTL_Room_Variation
{
    public function get_final_price($checkin, $checkout)
    {
        if ($get_price = $this->get_price($checkin, $checkout)) {

            if ($this->is_on_sale($checkin, $checkout)) {

                $from = $this->get_regular_price($checkin, $checkout) / 100; // (prices are stored as integers)
                $to = $this->get_sale_price($checkin, $checkout) / 100; // (prices are stored as integers)
                $price = $this->get_price_html_from_to($from, $to) . '<span>/' . esc_html__('Night', 'hotello') . '</span>';


            } else {

                $price = htl_price($get_price / 100); // (prices are stored as integers)
                $price = $price . '<span>/' . esc_html__('Night', 'hotello') . '</span>';
            }

        } else {

            $price = '';

        }

        return $price;
    }

    public function get_min_price()
    {
        $min_price = 0;

        if ($this->has_seasonal_price()) {
            $prices = array();

            // seasonal price schema
            $rules = htl_get_seasonal_prices_schema();

            if (is_array($rules)) {
                // get variation seasonal prices
                $seasonal_prices = $this->variation['seasonal_price'];

                // check only the rules stored in the schema
                // we don't allow 'orphan' rules
                foreach ($rules as $key => $value) {

                    // check if this rule has a price
                    if (isset($this->variation['seasonal_price'][$key]) && $this->variation['seasonal_price'][$key] > 0) {
                        $prices[] = $this->variation['seasonal_price'][$key];
                    }
                }

                // get also the default price
                $prices[] = $this->variation['seasonal_base_price'];
            }

            $min_price = min($prices) / 100; // (prices are stored as integers)

            if ($min_price > 0) {
                $min_price = $min_price;
            }

        } else if ($this->is_price_per_day()) {
            if ($this->variation['sale_price_day']) {
                $min_price = min($this->variation['sale_price_day']) / 100; // (prices are stored as integers)

            } elseif ($this->variation['price_day']) {
                $min_price = min($this->variation['price_day']) / 100; // (prices are stored as integers)
            }


        } else {

            if ($this->variation['sale_price']) {
                $min_price = $this->variation['sale_price'] / 100; // (prices are stored as integers)

            } elseif ($this->variation['regular_price']) {
                $min_price = $this->variation['regular_price'] / 100; // (prices are stored as integers)
            }

        }

        return $min_price;
    }

}