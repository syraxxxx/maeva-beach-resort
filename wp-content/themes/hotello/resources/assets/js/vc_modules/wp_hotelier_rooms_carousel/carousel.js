(function ($) {
  let rooms = $('.stm_wp_hotelier_rooms_carousel__carousel');
  let tabButtons = $('.stm_wp_hotelier_rooms_carousel__categories li a');
  window.carousels = [];

  let initCarousel = function (el) {
    let slidesCount = el.find('.room').length;

    let navEnabled = {
      desktop: slidesCount > 3
    };
    el.addClass('owl-carousel');
    let carousel = el.owlCarousel({
      items: 3,
      margin: 30,
      dots: false,
      nav: navEnabled.desktop,
      loop: false,
      responsive: {
        300: {
          items: 1
        },
        768: {
          items: 2
        },
        1024: {
          items: 3
        }
      }
    });

    return carousel;
  };

  $(document).ready(function () {
    rooms.each(function () {
      let room = $(this);
      initCarousel(room);
    });
  });

})(jQuery);