'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function ($) {
    var STM_hotelier_availability_form_controller = function () {
        function STM_hotelier_availability_form_controller(formSelector) {
            _classCallCheck(this, STM_hotelier_availability_form_controller);

            this.form = $(formSelector);
            this.roomId = this.form.data('room');
            this.rateId = this.form.data('rate-id') ? this.form.data('rate-id') : 0;
            this.button = this.form.find('[type=submit]');
            this.message = this.form.find('.availability-message');
            this.translates = window.stm_hotelier_translations;
            this.datepicker = this.form.find('.datepicker-input-select');
            this.checkIn = this.form.find('#hotelier-datepicker-checkin');
            this.checkOut = this.form.find('#hotelier-datepicker-checkout');
            this.priceDom = this.form.find('.stm-single-room__price-val');
            this.variationsSelect = this.form.find('.stm-single-room-availability__room-rates');
            this.variations = this.form.data('variations');
            this.depositDom = $('<div class="stm-single-room__deposit"></div>').insertBefore(this.button).hide();
            this.messageTimeout = null;
            this.init();
        }

        _createClass(STM_hotelier_availability_form_controller, [{
            key: 'init',
            value: function init() {
                this.submitListener();
                this.dateChange();
                this.setPrice();
                this.events();
                if (this.variations && typeof this.variations[0].deposit !== 'undefined') {
                    this.setDeposit(this.variations[0].deposit);
                }
            }
        }, {
            key: 'events',
            value: function events() {
                var _this = this;

                this.variationsSelect.change(function (e) {
                    _this.setPrice();
                });
                this.variationsSelect.on('stmSelected', function (e) {
                    var index = e.index;
                    if (_this.variations) {
                        var deposit = _this.variations[index].deposit;
                        _this.rateId = typeof _this.variations[index].id !== 'undefined' ? _this.variations[index].id : 0;
                        _this.setDeposit(deposit);
                    }
                });
            }
        }, {
            key: 'getPrice',
            value: function getPrice() {
                return this.variationsSelect.find('option').val();
            }
        }, {
            key: 'setPrice',
            value: function setPrice() {
                var price = this.getPrice();
                this.priceDom.text(price);
            }
        }, {
            key: 'setDeposit',
            value: function setDeposit(deposit) {
                if (typeof deposit !== 'undefined') {
                    this.depositDom.text(this.translates.deposit_required + ' ' + deposit).fadeIn(300);
                } else {
                    this.depositDom.hide();
                }
            }
        }, {
            key: 'dateChange',
            value: function dateChange() {
                var _this2 = this;

                this.datepicker.on('afterClose', function () {
                    _this2.button.find('span').text(_this2.translates.check_availability);
                    _this2.hideMessage();
                    _this2.form.data('available', false);
                });
            }
        }, {
            key: 'checkAvailability',
            value: function checkAvailability() {
                var _this3 = this;

                this.hideMessage();
                this.checkIn = this.form.find('#hotelier-datepicker-checkin');
                this.checkOut = this.form.find('#hotelier-datepicker-checkout');

                $.ajax({
                    url: stm_ajaxurl,
                    data: {
                        action: 'check_room_availability',
                        check_in: this.checkIn.val(),
                        check_out: this.checkOut.val(),
                        room_id: this.roomId,
                        security: window.wp_data.hotello_ajax_check_room_availability
                    }
                }).then(function (res) {
                    if (res) {
                        if (!res.error) {
                            _this3.showMessage(res.message, 'success');
                            _this3.form.data('available', true);
                            _this3.button.find('span').text(_this3.translates.book_now);
                        } else {
                            _this3.showMessage(res.message, 'warning');
                            _this3.form.data('available', false);
                        }
                    } else {
                        _this3.showMessage(_this3.translates.room_not_available, 'warning');
                        _this3.form.data('available', false);
                    }
                });
            }
        }, {
            key: 'book',
            value: function book() {
                var data = {
                    action: 'book_room',
                    room_id: this.roomId,
                    rate_id: this.rateId,
                    check_in: this.checkIn.val(),
                    check_out: this.checkOut.val(),
                    security: window.wp_data.hotello_ajax_book_room
                };
                console.log(data);
                $.ajax({
                    url: stm_ajaxurl,
                    data: {
                        action: 'book_room',
                        room_id: this.roomId,
                        rate_id: this.rateId,
                        check_in: this.checkIn.val(),
                        check_out: this.checkOut.val(),
                        security: window.wp_data.hotello_ajax_book_room
                    }
                }).then(function (res) {
                    console.log(res);
                    if (res) {
                        window.location.href = hotelier_booking_url;
                    }
                });
            }
        }, {
            key: 'submitListener',
            value: function submitListener() {
                var _this4 = this;

                this.form.on('submit', function (e) {
                    e.preventDefault();
                    if (!_this4.form.data('available')) {
                        _this4.checkAvailability();
                    } else {
                        _this4.book();
                    }
                });
            }
        }, {
            key: 'showMessage',
            value: function showMessage(text, type) {
                var _this5 = this;

                if (this.messageTimeout !== null) {
                    clearTimeout(this.messageTimeout);
                }

                this.message.text(text);
                this.message.addClass('stm-single-room__availability-message alert alert-' + type);
                this.message.fadeIn(300, function () {
                    _this5.messageTimeout = setTimeout(function () {
                        _this5.hideMessage();
                    }, 3000);
                });
            }
        }, {
            key: 'hideMessage',
            value: function hideMessage() {
                var _this6 = this;

                this.message.fadeOut(300, function () {
                    _this6.message.attr('class', '');
                });
            }
        }]);

        return STM_hotelier_availability_form_controller;
    }();

    $(document).ready(function () {
        var formController = new STM_hotelier_availability_form_controller('#stm-single-room-availability');
    });
})(jQuery);