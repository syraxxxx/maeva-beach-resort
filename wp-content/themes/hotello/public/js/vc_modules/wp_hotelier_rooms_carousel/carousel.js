'use strict';

(function ($) {
  var rooms = $('.stm_wp_hotelier_rooms_carousel__carousel');
  var tabButtons = $('.stm_wp_hotelier_rooms_carousel__categories li a');
  window.carousels = [];

  var initCarousel = function initCarousel(el) {
    var slidesCount = el.find('.room').length;

    var navEnabled = {
      desktop: slidesCount > 3
    };
    el.addClass('owl-carousel');
    var carousel = el.owlCarousel({
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
      var room = $(this);
      initCarousel(room);
    });
  });
})(jQuery);