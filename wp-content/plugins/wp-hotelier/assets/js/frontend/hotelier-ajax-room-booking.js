jQuery(function ($) {
	'use strict';
	/* global jQuery, hotelier_ajax_room_booking_params */

	// hotelier_ajax_room_booking_params is required to continue, ensure the object exists
	if (typeof hotelier_ajax_room_booking_params === 'undefined') {
		return false;
	}

	var HTL_AJAX_ROOM_BOOKING = {
		init: function () {
			this.datepicker();
			this.ajax_form();
			this.reset_form();
		},

		datepicker: function () {
			$('form.form--widget-ajax-room-booking').find('.datepicker-input-select').on('hotelier-datepicker-dates-selected', function () {
				var form = $(this).closest('form');
				var form_button = form.find('.button--widget-ajax-room-booking');

				HTL_AJAX_ROOM_BOOKING.set_state('default', form, form_button);
			});
		},

		set_state: function (state, form, button) {
			if (state === 'can_book') {
				button.val(hotelier_ajax_room_booking_params.locale.book_button_text);
				form.attr('data-available', true);
				button.addClass('can-book');
				form.find('.reset--widget-ajax-room-booking').show();
			} else if (state === 'is_booking') {
				button.val(hotelier_ajax_room_booking_params.locale.booking_button_text);
			} else if (state === 'is_checking_availability') {
				button.val(hotelier_ajax_room_booking_params.locale.checking_button_text);
				form.find('.widget-ajax_room_booking__result').empty();
				form.find('.reset--widget-ajax-room-booking').hide();
			} else if (state === 'default') {
				form.attr('data-available', false);
				button.val(hotelier_ajax_room_booking_params.locale.default_button_text);
				button.removeClass('can-book');
				form.find('.reset--widget-ajax-room-booking').hide();
				form.find('.widget-ajax-room-booking__row--pre').show();
				form.find('.widget-ajax_room_booking__result').empty();
			}
		},

		reset_form: function () {
			$('form.form--widget-ajax-room-booking').on('click', '.reset--widget-ajax-room-booking', function () {
				var _this = $(this);
				var form = _this.closest('form');
				var submit_button = form.find('.button--widget-ajax-room-booking');

				HTL_AJAX_ROOM_BOOKING.reset(form, submit_button);
			});
		},

		reset: function (form, button) {
			HTL_AJAX_ROOM_BOOKING.set_state('default', form, button);
			form.find('.widget-ajax_room_booking__result').empty();

			var form_inputs = form.find('.form-row__input');

			form_inputs.each(function () {
				var _this = $(this);
				var default_value = _this.attr('data-default');
				_this.val(default_value);
			});
		},

		init_rates: function (form) {
			var rates_select = form.find('.widget-ajax-room-booking__row--rates').find('select');

			rates_select.on('change', function () {
				HTL_AJAX_ROOM_BOOKING.show_single_rate(form, $(this).val());
			});
		},

		show_single_rate: function (form, index) {
			var rates_data = form.find('.widget-ajax-room-booking__data--rate');

			rates_data.hide();
			rates_data.filter('[data-rate-id="' + index + '"]').show();
		},

		ajax_form: function () {
			$('form.form--widget-ajax-room-booking').on('click', '.button--widget-ajax-room-booking', function (e) {
				e.preventDefault();

				var _this = $(this);
				var form = _this.closest('form');
				var form_data = form.serialize();
				var is_available = form.attr('data-available');
				var room_id = form.attr('data-room-id');
				var is_doing_booking = Boolean(_this.hasClass('can-book'));
				var result_wrapper = form.find('.widget-ajax_room_booking__result');
				var ajax_data = {
					form_data: form_data,
					room_id: room_id,
					is_available: is_available,
					ajax_room_booking_nonce: hotelier_ajax_room_booking_params.nonce,
					action: 'hotelier_ajax_room_booking'
				};

				form.removeClass('loading');
				form.addClass('loading');
				form.find('.hotelier-notice').remove();

				if (is_doing_booking) {
					HTL_AJAX_ROOM_BOOKING.set_state('is_booking', form, _this);
				} else {
					HTL_AJAX_ROOM_BOOKING.set_state('is_checking_availability', form, _this);
				}

				$.ajax({
					method: 'POST',
					url: hotelier_ajax_room_booking_params.ajax_url.toString(),
					data: ajax_data
				})
				.done(function (response) {
					if (response.success === true) {
						if (response.data.is_doing_booking === true) {
							if (response.data.redirect_url) {
								window.location = response.data.redirect_url;
							}
						} else if (response.data.available === true) {
							HTL_AJAX_ROOM_BOOKING.set_state('can_book', form, _this);
							if (response.data.html) {
								result_wrapper.append($(response.data.html));
								HTL_AJAX_ROOM_BOOKING.show_single_rate(form, 1);
								HTL_AJAX_ROOM_BOOKING.init_rates(form);
								form.find('.widget-ajax-room-booking__row--pre').hide();
							}
						} else {
							HTL_AJAX_ROOM_BOOKING.set_state('default', form, _this);
						}
					} else {
						form.append('<div class="hotelier-notice hotelier-notice--error">' + response.data.message + '</div>');
						HTL_AJAX_ROOM_BOOKING.set_state('default', form, _this);
					}
				})
				.fail(function (response) {
					if (hotelier_ajax_room_booking_params.enable_debug) {
						console.log(response);
					}
					HTL_AJAX_ROOM_BOOKING.set_state('default', form, _this);
				}).always(function () {
					form.removeClass('loading');
				});
			});
		}
	};

	$(document).ready(function () {
		HTL_AJAX_ROOM_BOOKING.init();
	});
});
