(function ($) {
    window.initGoogleScripts = function () {
        $('body').trigger('stm_gmap_api_loaded');
        let stm_gmap_api_loaded = new Event('stm_gmap_api_loaded');
        document.body.dispatchEvent(stm_gmap_api_loaded)
    };

    $(document).ready(function () {
        stm_select_style();
        stm_light_gallery();
        js_active_trigger();
        stm_header_dropdown_mobile();
        stm_kenburns();
        stm_site_preloader();
        stm_switcher();
        stm_stretch_column();
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(window).load(function(){
        stm_stretch_column();
    });


    window.stm_select_style = () => {
        let select = $('select').not('.no_wrap');

        $('body').on('click', function () {
            select.parents('.stm_select').removeClass('open');
        });

        select.each(function () {
            let select = $(this);

            let options = select.find('option');
            let values = [];
            options.each((v, k) => {
                let option = $(k);
                values.push({
                    text: option.text(),
                    value: option.val()
                });
            });
            let choicesList = '<ul class="stm_select__dropdown">';
            let choicesListHeight = 0;
            values.forEach((v) => {
                choicesList += `<li data-value="${v.value}"><span>${v.text}</span></li>`
            });
            choicesList += '<ul>';
            let wrapperStructure = '<div class="stm_select"></div>';
            let wrapper = select.wrap(wrapperStructure).parent();
            let selectVal = $('<span class="stm-select__val"></span>').appendTo(wrapper);
            choicesList = $(choicesList).appendTo(wrapper);
            choicesList.find('li').each(function () {
                    choicesListHeight += $(this).height();
                })
                .on('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    let text = $(this).text();
                    let value = $(this).data('value');
                    selectVal.text(text);
                    select.val(value);
                    select.find('option').remove();
                    select.append(`<option value="${value}" selected>${text}</option>`);

                    let selectEvent = $.Event('stmSelected');
                    selectEvent.value = value;
                    selectEvent.index = $(this).index();
                    select.trigger('change', e).trigger(selectEvent);
                    wrapper.removeClass('open');
                });

            if (choicesListHeight > 0) {
                choicesList.css('height', choicesListHeight + 4);
            }
            wrapper.on('click', function (e) {
                e.stopPropagation();
                $('.stm_select').removeClass('open');
                $(this).toggleClass('open');
            });

            selectVal.text(select.find('option:selected').text());
            options.not(':selected').remove();
        });

    };
    window.stm_light_gallery = (reinit = false) => {
        if (typeof $.fn.lightGallery === 'function') {

            let galleries = $('.stm_lightgallery');

            galleries.each(function () {
                let gallery = $(this);

                if (reinit) {
                    try {
                        gallery.data('lightGallery').destroy(true);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
                gallery.lightGallery({
                    'selector': '.stm_lightgallery__selector'
                });
            });


            $('.stm_lightgallery__iframe').lightGallery({
                selector: 'this',
                iframeMaxWidth: '70%'
            })
        }
    }
    window.js_active_trigger = () => {
        let opened = false;
        let dataToggle = '';
        let $element = '';
        let $this = '';
        $('.js_trigger__click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            $this = $(this);

            dataToggle = $(this).attr('data-toggle');
            if (typeof dataToggle == 'undefined') dataToggle = true;

            $element = $(this).closest('.js_trigger').find('.js_trigger__unit');
            let element = $(this).attr('data-element');
            if (typeof element !== 'undefined') $element = $(element);

            if (dataToggle && dataToggle !== 'false') {
                $element.slideToggle('fast');
            } else {
                $element.toggleClass('active');
            }

            $(this).toggleClass('active');
            opened = $(this).hasClass('active') ? true : false;
        });
    }
    window.stm_header_dropdown_mobile = () => {
        let windowW = $(window).width();

        $('.stm_mobile__switcher').on('each', function (e) {
            if ($(this).hasClass('active')) {
                $(this).parent().addClass('href_empty');
            }
        });

        $('.stm-header .stm-navigation__default li:not(.menu-item-has-children) a').on('click', function (e) {
            $('.stm-header__overlay').removeClass('active');
            $('.stm_mobile__header').removeClass('active');
            $('.stm_mobile__switcher').removeClass('active');
            $('.stm-header').removeClass('active');
            $('body').removeClass('active');
        });

        $('.stm-navigation li.menu-item-has-children > a').each(function () {
            var href = $(this).attr("href");
            if (href == "#") {
                $(this).parent().addClass('href_empty');
            }

            $(this).append('<span class="stm_mobile__dropdown"></span>');
        });

        $('body').find('.stm_mobile__dropdown').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            let dd = $(this);
            dd.closest('li').toggleClass(function () {
                if (dd.parents('.stm-navigation__hamburger').length === 0 || window.innerWidth < 1024) {
                    let subMenu = dd.closest('li').children('.sub-menu');
                    subMenu.toggle();
                }

                return 'active';
            });

        });

        if (typeof $.fn.swipe === 'function' && windowW < 992) {
            $(".stm-header").swipe({
                swipe: function (event, direction, distance, duration, fingerCount, fingerData) {
                    /*Close on swipe*/
                    if (direction == 'left' && distance > 50) {
                        $('.stm-header').removeClass('active');
                        $('.stm-header__overlay').removeClass('active');
                        $('.stm_mobile__header').removeClass('active');
                        $('.stm_mobile__switcher').removeClass('active');
                    }
                },
                allowPageScroll: "vertical",
            });
        }

        // Close on click anywhere except menu
        $('.stm-header__overlay').on('click', function () {
            $(this).removeClass('active');
            $('.stm_mobile__header').removeClass('active');
            $('.stm_mobile__switcher').removeClass('active');
            $('.stm-header').removeClass('active');
            $('body').removeClass('active');
        });

    }
    window.stm_kenburns = function () {
        let rows = $('[data-stm-kenburns]');

        rows.each(function () {
            let el = $(this);
            let kenBurnsHtml = '<div class="stm_kenburns"><div class="stm_kenburns__image"></div></div>';
            if (el.data('stm-kenburns') === 'enable') {
                let parentContainer = el.parents('[class*="vc_container"]');
                let bgi = parentContainer.css('background-image');
                parentContainer.attr('style', parentContainer.attr('style') + ';' + 'background-image: none !important');
                let kenBurnsEl = $(kenBurnsHtml).appendTo(parentContainer);
                let kenBurnsImage = kenBurnsEl.find('.stm_kenburns__image');
                kenBurnsImage.css('background-image', bgi);
            }
        })
    };
    window.stm_site_preloader = function () {
        if ($('html').hasClass('stm-site-loader')) {
            $('html').addClass('loaded');

            var prevent = false;
            $('a[href^=mailto], a[href^=skype], a[href^=tel]').on('click', function (e) {
                prevent = true;
                $('html').addClass('loaded');
            });

            $(window).on('beforeunload', function (e, k) {
                if (!prevent) {
                    $('html').removeClass('loaded');
                } else {
                    prevent = false;
                }
            });
        }
    }
    window.stm_switcher = function () {
        $('.stm-switcher__trigger').on('click', function () {
            $(this).closest('.stm-switcher').find('.stm-switcher__list').toggleClass('active');
            $(this).toggleClass('active');
        });

        $('.stm-switcher__option').on('click', function () {
            var stm_switch = $(this).data('switch');

            /*Change in list*/
            $(this).closest('.stm-switcher').parent().find('.js-switcher').addClass('js-switcher__hidden');
            $(this).closest('.stm-switcher').parent().find('.js-switcher_' + stm_switch).removeClass('js-switcher__hidden');

            /*Change trigger text*/
            $(this).closest('.stm-switcher').find('.stm-switcher__text').text($(this).text());

            /*Close dropdown*/
            $(this).closest('.stm-switcher__list').removeClass('active');
            $(this).closest('.stm-switcher').find('.stm-switcher__trigger').removeClass('active');
        });
    }

    window.stm_stretch_column = function() {
        $('.wpb_column[data-stretch]').each(function () {
            let el = $(this);
            let stretch = el.data('stretch');
            let stretchContent = el.data('stretch-content');
            let wrapper = el.find('.wpb_wrapper').first();
            let col = el.find('.vc_column-inner').first();
            let colLeftOffset = el.offset().left;
            if (stretch === 'left') {
                wrapper.css({
                    'margin-left': 'auto'
                });
                col.css({
                    'width': el.width() + colLeftOffset + 'px',
                    'margin-left': '-' + colLeftOffset + 'px'
                });
            } else {
                let margin = window.innerWidth - colLeftOffset - el.width();
                col.css({
                    'width': window.innerWidth - colLeftOffset + 'px',
                    'margin-right': '-' + margin + 'px'
                });
            }

            if (stretchContent !== true) {
                //wrapper.css('width', el.width() - 30 + 'px');
            }

            if (stm_check_mobile() || window.innerWidth <= 1024) {
                col.css({
                    'width': window.innerWidth + 'px',
                    'margin-left': '-' + (window.innerWidth - col.outerWidth()) + 'px'
                });
            }
        });
    }


})(jQuery);


class StmInfoBox {
    constructor(options, container) {
        let $ = jQuery;

        this.container = $(container);
        this.box = '.stm_infobox';

        this.init(options);
        this.parseStyle();
    }

    init(options) {
        this.content = options.content || '';
        this.maxWidth = options.maxWidth || 200;
        this.pixelOffset = options.pixelOffset || [0, 0];
        this.zIndex = options.zIndex || 0;
        this.boxStyle = options.boxStyle || {};
        this.style = '';
    }

    parseStyle() {
        let $ = jQuery;
        let style = '';
        style += `zindex: ${this.zIndex};`;
        style += `left: ${this.pixelOffset[0]};`;
        style += `top: ${this.pixelOffset[1]};`;
        style += `maxWidth: ${this.maxWidth}px;`;

        if (Object.keys(this.boxStyle).length > 0) {
            for (let rule in this.boxStyle) {
                style += `${rule} : ${this.boxStyle[rule]};`
            }
        }

        this.style = style;
    }

    open() {
        let html =
            '<div class="stm_infobox">' +
            '<div class="stm_infobox__content">' + this.content + '</div>' +
            '</div>';
        if (this.container.find('.stm_infobox').length === 0 && this.content.length !== 0) {
            this.container.append(html);
        }
    }

    close() {
        if (this.container.find('.stm_infobox').length > 0) {
            this.container.find('.stm_infobox').remove();
        }
    }
}

window.StmInfoBox = StmInfoBox;

function stm_check_mobile() {
    "use strict";

    var isMobile = false;
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) isMobile = true;
    return isMobile;
}