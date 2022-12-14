'use strict';

(function ($) {
    var image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==',

    _after = '<div class="wp-picker-holder" />',
        _wrap = '<div class="wp-picker-container" />',
        _button = '<input type="button" class="button button-small" />',

    _deprecated = wpColorPickerL10n.current !== undefined;
    if (_deprecated) {
        var _before = '<a tabindex="0" class="wp-color-result" />';
    } else {
        var _before = '<button type="button" class="button wp-color-result" aria-expanded="false"><span class="wp-color-result-text"></span></button>',
            _wrappingLabel = '<label></label>',
            _wrappingLabelText = '<span class="screen-reader-text"></span>';
    }
    Color.fn.toString = function () {
        if (this._alpha < 1) return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');

        var hex = parseInt(this._color, 10).toString(16);

        if (this.error) return '';

        if (hex.length < 6) hex = ('00000' + hex).substr(-6);

        return '#' + hex;
    };

    $.widget('wp.wpColorPicker', $.wp.wpColorPicker, {
        _create: function _create() {
            if (!$.support.iris) {
                return;
            }

            var self = this,
                el = self.element;

            $.extend(self.options, el.data());

            if (self.options.type === 'hue') {
                return self._createHueOnly();
            }

            self.close = $.proxy(self.close, self);

            self.initialValue = el.val();

            el.addClass('wp-color-picker');

            if (_deprecated) {
                el.hide().wrap(_wrap);
                self.wrap = el.parent();
                self.toggler = $(_before).insertBefore(el).css({ backgroundColor: self.initialValue }).attr('title', wpColorPickerL10n.pick).attr('data-current', wpColorPickerL10n.current);
                self.pickerContainer = $(_after).insertAfter(el);
                self.button = $(_button).addClass('hidden');
            } else {
                if (!el.parent('label').length) {
                    el.wrap(_wrappingLabel);
                    self.wrappingLabelText = $(_wrappingLabelText).insertBefore(el).text(wpColorPickerL10n.defaultLabel);
                }

                self.wrappingLabel = el.parent();

                self.wrappingLabel.wrap(_wrap);
                self.wrap = self.wrappingLabel.parent();
                self.toggler = $(_before).insertBefore(self.wrappingLabel).css({ backgroundColor: self.initialValue });
                self.toggler.find('.wp-color-result-text').text(wpColorPickerL10n.pick);
                self.pickerContainer = $(_after).insertAfter(self.wrappingLabel);
                self.button = $(_button);
            }

            if (self.options.defaultColor) {
                self.button.addClass('wp-picker-default').val(wpColorPickerL10n.defaultString);
                if (!_deprecated) {
                    self.button.attr('aria-label', wpColorPickerL10n.defaultAriaLabel);
                }
            } else {
                self.button.addClass('wp-picker-clear').val(wpColorPickerL10n.clear);
                if (!_deprecated) {
                    self.button.attr('aria-label', wpColorPickerL10n.clearAriaLabel);
                }
            }

            if (_deprecated) {
                el.wrap('<span class="wp-picker-input-wrap" />').after(self.button);
            } else {
                self.wrappingLabel.wrap('<span class="wp-picker-input-wrap hidden" />').after(self.button);

                self.inputWrapper = el.closest('.wp-picker-input-wrap');
            }

            el.iris({
                target: self.pickerContainer,
                hide: self.options.hide,
                width: self.options.width,
                mode: self.options.mode,
                palettes: self.options.palettes,
                change: function change(event, ui) {
                    if (self.options.alpha) {
                        self.toggler.css({ 'background-image': 'url(' + image + ')' });
                        if (_deprecated) {
                            self.toggler.html('<span class="color-alpha" />');
                        } else {
                            self.toggler.css({
                                'position': 'relative'
                            });
                            if (self.toggler.find('span.color-alpha').length == 0) {
                                self.toggler.append('<span class="color-alpha" />');
                            }
                        }

                        self.toggler.find('span.color-alpha').css({
                            'width': '30px',
                            'height': '24px',
                            'position': 'absolute',
                            'top': 0,
                            'left': 0,
                            'border-top-left-radius': '2px',
                            'border-bottom-left-radius': '2px',
                            'background': ui.color.toString()
                        });
                    } else {
                        self.toggler.css({ backgroundColor: ui.color.toString() });
                    }

                    if ($.isFunction(self.options.change)) {
                        self.options.change.call(this, event, ui);
                    }
                }
            });

            el.val(self.initialValue);
            self._addListeners();

            if (!self.options.hide) {
                self.toggler.trigger('click');
            }
        },
        _addListeners: function _addListeners() {
            var self = this;

            self.wrap.on('click.wpcolorpicker', function (event) {
                event.stopPropagation();
            });

            self.toggler.on('click', function () {
                if (self.toggler.hasClass('wp-picker-open')) {
                    self.close();
                } else {
                    self.open();
                }
            });

            self.element.on('change', function (event) {
                if ($(this).val() === '' || self.element.hasClass('iris-error')) {
                    if (self.options.alpha) {
                        if (_deprecated) {
                            self.toggler.removeAttr('style');
                        }
                        self.toggler.find('span.color-alpha').css('backgroundColor', '');
                    } else {
                        self.toggler.css('backgroundColor', '');
                    }

                    if ($.isFunction(self.options.clear)) self.options.clear.call(this, event);
                }
            });

            self.button.on('click', function (event) {
                if ($(this).hasClass('wp-picker-clear')) {
                    self.element.val('');
                    if (self.options.alpha) {
                        if (_deprecated) {
                            self.toggler.removeAttr('style');
                        }
                        self.toggler.find('span.color-alpha').css('backgroundColor', '');
                    } else {
                        self.toggler.css('backgroundColor', '');
                    }

                    if ($.isFunction(self.options.clear)) self.options.clear.call(this, event);
                } else if ($(this).hasClass('wp-picker-default')) {
                    self.element.val(self.options.defaultColor).change();
                }
            });
        }
    });

    $.widget('a8c.iris', $.a8c.iris, {
        _create: function _create() {
            this._super();

            this.options.alpha = this.element.data('alpha') || false;

            if (!this.element.is(':input')) this.options.alpha = false;

            if (typeof this.options.alpha !== 'undefined' && this.options.alpha) {
                var self = this,
                    el = self.element,
                    _html = '<div class="iris-strip iris-slider iris-alpha-slider"><div class="iris-slider-offset iris-slider-offset-alpha"></div></div>',
                    aContainer = $(_html).appendTo(self.picker.find('.iris-picker-inner')),
                    aSlider = aContainer.find('.iris-slider-offset-alpha'),
                    controls = {
                    aContainer: aContainer,
                    aSlider: aSlider
                };

                if (typeof el.data('custom-width') !== 'undefined') {
                    self.options.customWidth = parseInt(el.data('custom-width')) || 0;
                } else {
                    self.options.customWidth = 100;
                }

                self.options.defaultWidth = el.width();

                if (self._color._alpha < 1 || self._color.toString().indexOf('rgb') != -1) el.width(parseInt(self.options.defaultWidth + self.options.customWidth));

                $.each(controls, function (k, v) {
                    self.controls[k] = v;
                });

                self.controls.square.css({ 'margin-right': '0' });
                var emptyWidth = self.picker.width() - self.controls.square.width() - 20,
                    stripsMargin = emptyWidth / 6,
                    stripsWidth = emptyWidth / 2 - stripsMargin;

                $.each(['aContainer', 'strip'], function (k, v) {
                    self.controls[v].width(stripsWidth).css({ 'margin-left': stripsMargin + 'px' });
                });

                self._initControls();

                self._change();
            }
        },
        _initControls: function _initControls() {
            this._super();

            if (this.options.alpha) {
                var self = this,
                    controls = self.controls;

                controls.aSlider.slider({
                    orientation: 'vertical',
                    min: 0,
                    max: 100,
                    step: 1,
                    value: parseInt(self._color._alpha * 100),
                    slide: function slide(event, ui) {
                        self._color._alpha = parseFloat(ui.value / 100);
                        self._change.apply(self, arguments);
                    }
                });
            }
        },
        _change: function _change() {
            this._super();

            var self = this,
                el = self.element;

            if (this.options.alpha) {
                var controls = self.controls,
                    alpha = parseInt(self._color._alpha * 100),
                    color = self._color.toRgb(),
                    gradient = ['rgb(' + color.r + ',' + color.g + ',' + color.b + ') 0%', 'rgba(' + color.r + ',' + color.g + ',' + color.b + ', 0) 100%'],
                    defaultWidth = self.options.defaultWidth,
                    customWidth = self.options.customWidth,
                    target = self.picker.closest('.wp-picker-container').find('.wp-color-result');

                controls.aContainer.css({ 'background': 'linear-gradient(to bottom, ' + gradient.join(', ') + '), url(' + image + ')' });

                if (target.hasClass('wp-picker-open')) {
                    controls.aSlider.slider('value', alpha);

                    if (self._color._alpha < 1) {
                        controls.strip.attr('style', controls.strip.attr('style').replace(/rgba\(([0-9]+,)(\s+)?([0-9]+,)(\s+)?([0-9]+)(,(\s+)?[0-9\.]+)\)/g, 'rgb($1$3$5)'));
                        el.width(parseInt(defaultWidth + customWidth));
                    } else {
                        el.width(defaultWidth);
                    }
                }
            }

            var reset = el.data('reset-alpha') || false;

            if (reset) {
                self.picker.find('.iris-palette-container').on('click.palette', '.iris-palette', function () {
                    self._color._alpha = 1;
                    self.active = 'external';
                    self._change();
                });
            }
        },
        _addInputListeners: function _addInputListeners(input) {
            var self = this,
                debounceTimeout = 100,
                callback = function callback(event) {
                var color = new Color(input.val()),
                    val = input.val();

                input.removeClass('iris-error');
                if (color.error) {
                    if (val !== '') input.addClass('iris-error');
                } else {
                    if (color.toString() !== self._color.toString()) {
                        if (!(event.type === 'keyup' && val.match(/^[0-9a-fA-F]{3}$/))) self._setOption('color', color.toString());
                    }
                }
            };

            input.on('change', callback).on('keyup', self._debounce(callback, debounceTimeout));

            if (self.options.hide) {
                input.on('focus', function () {
                    self.show();
                });
            }
        }
    });
})(jQuery);

jQuery(document).ready(function ($) {
    $('.color-picker').wpColorPicker();
});