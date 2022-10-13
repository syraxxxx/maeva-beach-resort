'use strict';

var picker;

jQuery(function ($) {
    'use strict';


    if (typeof datepicker_params === 'undefined') {
        return false;
    }

    function get_data() {
        if (document.getElementById('hotelier-datepicker-select')) {
            var checkin_val = '';
            var checkout_val = '';

            $.ajax({
                url: datepicker_params.htl_ajax_url.toString(),
                type: 'POST',
                success: function success(response) {
                    if (response) {
                        checkin_val = response.checkin.toString();
                        checkout_val = response.checkout.toString();

                        init_datepicker(checkin_val, checkout_val);
                    }
                }
            });
        }
    }

    function init_datepicker(checkin, checkout) {
        if (document.getElementById('hotelier-datepicker-select')) {
            var date_select_input = $('#hotelier-datepicker-select');
            var checkin_input = $('#hotelier-datepicker-checkin');
            var checkout_input = $('#hotelier-datepicker-checkout');

            date_select_input.show();
            checkin_input.hide();
            checkout_input.hide();

            if (checkin && checkout) {
                checkin_input.val(checkin);
                checkout_input.val(checkout);

                var checkin_date = new Date(checkin.replace(/-/g, '\/'));
                var checkout_date = new Date(checkout.replace(/-/g, '\/'));
                var checkin_date_formatted = fecha.format(checkin_date, datepicker_params.datepicker_format);
                var checkout_date_formatted = fecha.format(checkout_date, datepicker_params.datepicker_format);

                date_select_input.val(checkin_date_formatted + ' - ' + checkout_date_formatted);
                hotello_set_checkin_values(checkin_date_formatted, checkout_date_formatted);
            }

            picker = new HotelDatepicker(document.getElementById('hotelier-datepicker-select'), {
                infoFormat: datepicker_params.datepicker_format,
                startOfWeek: datepicker_params.start_of_week,
                startDate: datepicker_params.start_date,
                endDate: datepicker_params.end_date,
                minNights: parseInt(datepicker_params.min_nights, 10),
                maxNights: parseInt(datepicker_params.max_nights, 10),
                disabledDates: datepicker_params.disabled_dates,
                enableCheckout: datepicker_params.enable_checkout,
                disabledDaysOfWeek: datepicker_params.disabled_days_of_week,
                autoClose: false,
                i18n: datepicker_params.i18n,
                getValue: function getValue() {
                    if (checkin_input.val() && checkout_input.val()) {
                        return checkin_input.val() + ' - ' + checkout_input.val();
                    }
                    return '';
                },
                setValue: function setValue(s, s1, s2) {
                    var checkin_date = new Date(s1.replace(/-/g, '\/'));
                    var checkout_date = new Date(s2.replace(/-/g, '\/'));
                    var checkin_date_formatted = fecha.format(checkin_date, datepicker_params.datepicker_format);
                    var checkout_date_formatted = fecha.format(checkout_date, datepicker_params.datepicker_format);

                    date_select_input.val(checkin_date_formatted + ' - ' + checkout_date_formatted);
                    checkin_input.val(s1);
                    checkout_input.val(s2);

                    hotello_set_checkin_values(checkin_date_formatted, checkout_date_formatted);
                }
            });

            $('.form-group-label').on('click', function () {
                setTimeout(function () {
                    picker.open();
                }, 10);
            });
        }
    }

    $(document).ready(function () {
        get_data();
    });

    $(window).on('load', function () {
        get_data();
    });
});

function hotello_set_checkin_values(checkin_date_formatted, checkout_date_formatted) {
    jQuery('.form-group-label.checkin').text(checkin_date_formatted);
    jQuery('.form-group-label.checkout').text(checkout_date_formatted);
}