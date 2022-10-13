(function ($) {
    let carousel = $('.stm_selective_rooms_carousel_style_1');
    let per_row = carousel.attr('data-per-row');
    let per_row_sm = carousel.attr('data-per-row-sm');
    console.log(per_row_sm);

    let params = {
        items: per_row,
        margin: 30,
        dots: false,
        loop: true,
        nav: true,
        responsive: {
            300: {
                items: 1
            },
            650: {
                items: per_row_sm
            },
            1024: {
                items: per_row
            },
            1440: {
                items: per_row
            }
        }
    };

    $(document).ready(function () {
        carousel.each(function () {
            let carousel = $(this);
            carousel.addClass('owl-carousel');
            carousel.owlCarousel(params);
        });
    });
})(jQuery);