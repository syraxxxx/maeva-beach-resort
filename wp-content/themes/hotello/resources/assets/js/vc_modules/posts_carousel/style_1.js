(function ($) {
  "use strict";
  let owl = $('.stm_posts_carousel_style_1 .owl-carousel');
  let data = owl.data();
  let number_row_laptop = data['numberRowLaptop'];
  let number_row_desktop = data['numberRowDesktop'];
  let number_row_tablet = data['numberRowTablet'];
  let loop = data['loop'];
  let dots = data['dots'];
  let autoplay = data['autoplay'];
  let nav = data['nav'];


  $(document).ready(function () {
    var owlRtl = false;
    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    owl.owlCarousel({
      rtl: owlRtl,
      items: 1,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: number_row_tablet
        },
        1025: {
          items: number_row_laptop
        },
        1367: {
          items: number_row_desktop
        }
      },
      dots: dots,
      autoplay: autoplay,
      nav: nav,
      margin: 30,
      autoplaySpeed: 1500,
      slideBy: 1,
      loop: loop,
    });
  });

})(jQuery);