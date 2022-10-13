(function ($) {
    class STM_hotelier_availability_form_controller {
        constructor(formSelector) {
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

        init() {
            this.submitListener();
            this.dateChange();
            this.setPrice();
            this.events();
            if (this.variations && typeof this.variations[0].deposit !== 'undefined') {
                this.setDeposit(this.variations[0].deposit);
            }
        }

        events() {
            this.variationsSelect.change((e) => {
                this.setPrice();
            });
            this.variationsSelect.on('stmSelected', e => {
                let index = e.index;
                if (this.variations) {
                    let deposit = this.variations[index].deposit;
                    this.rateId = typeof this.variations[index].id !== 'undefined' ? this.variations[index].id : 0;
                    this.setDeposit(deposit);
                }
            })
        }

        getPrice() {
            return this.variationsSelect.find('option').val()
        }

        setPrice() {
            let price = this.getPrice();
            this.priceDom.text(price);
        }

        setDeposit(deposit) {
            if (typeof deposit !== 'undefined') {
                this.depositDom.text(`${this.translates.deposit_required} ${deposit}`).fadeIn(300);
            } else {
                this.depositDom.hide();
            }
        }

        dateChange() {
            this.datepicker.on('afterClose', () => {
                this.button.find('span').text(this.translates.check_availability);
                this.hideMessage();
                this.form.data('available', false);
            })
        }

        checkAvailability() {
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
                    security: window.wp_data.hotello_ajax_check_room_availability,
                }
            }).then(res => {
                if (res) {
                    if (!res.error) {
                        this.showMessage(res.message, 'success');
                        this.form.data('available', true);
                        this.button.find('span').text(this.translates.book_now);
                    } else {
                        this.showMessage(res.message, 'warning');
                        this.form.data('available', false);
                    }
                } else {
                    this.showMessage(this.translates.room_not_available, 'warning');
                    this.form.data('available', false);
                }
            })
        }

        book() {
            let data = {
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
            }).then(res => {
                console.log(res);
                if (res) {
                    window.location.href = hotelier_booking_url;
                }
            })
        }

        submitListener() {
            this.form.on('submit', (e) => {
                e.preventDefault();
                if (!this.form.data('available')) {
                    this.checkAvailability();
                } else {
                    this.book();
                }

            })
        }

        showMessage(text, type) {
            if (this.messageTimeout !== null) {
                clearTimeout(this.messageTimeout);
            }

            this.message.text(text);
            this.message.addClass(`stm-single-room__availability-message alert alert-${type}`);
            this.message.fadeIn(300, () => {
                this.messageTimeout = setTimeout(() => {
                    this.hideMessage()
                }, 3000)
            });
        }

        hideMessage() {
            this.message.fadeOut(300, () => {
                this.message.attr('class', '');
            });
        }
    }

    $(document).ready(function () {
        let formController = new STM_hotelier_availability_form_controller('#stm-single-room-availability');
    });


})(jQuery);