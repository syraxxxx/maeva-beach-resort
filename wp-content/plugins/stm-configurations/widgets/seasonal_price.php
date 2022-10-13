<?php

require_once STM_CONFIGURATIONS_PATH . '/widgets/ArrayHelper.php';

class Hotel_SeasonalPrice_Widget extends WP_Widget
{

    /**
     * Register widget with WordPress
     */
    function __construct()
    {
        parent::__construct(
            'seasonal_price', // Base ID
            esc_html__('STM Seasonal Price', 'hotello'), // Name
            array('description' => esc_html__('STM Seasonal Price widget', 'hotello'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

        if (!empty($args['before_widget'])) {
            $args['before_widget'] = str_replace('widget_seasonal_price', 'widget_seasonal_price widget_seasonal_price_' . esc_attr('seasonal_price_style'), $args['before_widget']);
        }


        echo html_entity_decode($args['before_widget']);
        if (!empty($title)) {
            echo html_entity_decode($args['before_title'] . esc_html($title) . $args['after_title']);
        } ?>

        <?php

        $months = (int) $instance['months'];
        $today = date("Y-m-d");
        $date = date_create(date("Y-m-d"));
        $period = $months * 30 . " days";
        date_add($date,date_interval_create_from_date_string($period));
        $todate = date_format($date,"Y-m-d");


        if (function_exists('htl_get_room_price_breakdown')) {
            $breakdown = htl_get_room_price_breakdown($today, $todate, get_the_ID(), 1, 1);


            $array = [];
            foreach ($breakdown as $key => $val) {
                $array[] = array(
                    "date" => $key,
                    "price" => $val,
                );
            }

            $mapped_array = ArrayHelper::map($array, 'date', 'date', 'price');


            if ((is_array($mapped_array) && count($mapped_array) > 1)) {

                    echo '<table class="seasonal_price_table">';
                    echo '<tr>';
                    echo '<th>' . esc_html__('From', 'hotello') . '</th>';
                    echo '<th>' . esc_html__('To', 'hotello') . '</th>';
                    echo '<th>' . esc_html__('Price', 'hotello') . '</th>';
                    echo '</tr>';
                foreach ($mapped_array as $key => $val) {
                    //echo current($val).' - '.end($val). ' $ ' . $key * 0.01 . '<br>';
                    echo '<tr>';
                    echo '<td>' . date('M j, Y', strtotime(current($val))) . '</td>';
                    echo '<td>' . date('M j, Y', strtotime(end($val))) . '</td>';
                    echo '<td>' . htl_get_currency_symbol($currency) . $key * 0.01 . '</td>';
                    echo '</tr>';
                }
                echo '</table>';

            } else {
                echo '<h5 style="color: grey">' . esc_html__('No seasonal prices', 'hotello') . '</h5>';
            }

        }

        ?>

        <?php echo html_entity_decode($args['after_widget']);
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance)
    {
        $title = '';
        $months = '';

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('Seasonal Price', 'hotello');
        }

        if (isset($instance['months'])) {
            $months = $instance['months'];
        } else {
            $months = esc_html__('6', 'hotello');
        }


        $months = $instance['months'];
        $today = date("Y-m-d");
        $date = date_create(date("Y-m-d"));
        $period = $months * 30 . " days";
        date_add($date,date_interval_create_from_date_string($period));
        $todate = date_format($date,"Y-m-d");


?>
         <p>
            <label
                    for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'hotello'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label
                    for="<?php echo esc_attr($this->get_field_id('months')); ?>"><?php _e('Period of months:', 'hotello'); ?></label>
            <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('months')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('months')); ?>" type="text"
                   value="<?php echo esc_attr($months); ?>" >
        </p>

        <p>
            <label for="from">From</label>
            <input class="widefat" type="text" name="from" value="<?php echo $today; ?>" readonly>
        </p>
        <p>
            <label for="to">To</label>
            <input class="widefat" type="text" name="to" value="<?php echo $todate; ?>" readonly>
        </p>

<?php
}

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? esc_attr($new_instance['title']) : '';
        $instance['months'] = (!empty($new_instance['months'])) ? esc_attr($new_instance['months']) : '';
        return $instance;
    }

}

function hotello_register_SeasonalPrice_widget()
{
    register_widget('Hotel_SeasonalPrice_Widget');
}

add_action('widgets_init', 'hotello_register_SeasonalPrice_widget');