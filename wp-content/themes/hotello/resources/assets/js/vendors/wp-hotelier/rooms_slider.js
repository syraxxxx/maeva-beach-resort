(function ($) {
  let slider = $('.stm-rooms-slider');

  $(document).ready(function () {
    slider
      .owlCarousel({
        dots: false,
        items: 1,
        loop: true,
        nav: true
      })
      .trigger('refresh.owl.carousel');

  });
})(jQuery);