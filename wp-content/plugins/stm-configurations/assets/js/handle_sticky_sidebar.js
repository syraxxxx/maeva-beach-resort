(function ($) {
    $(window).on('load', function () {
        if ($(window).width() >= 1200) {
            $('.stm_markup__sidebar').stickySidebar({
                bottomSpacing: 40,
                containerSelector: '.stm_markup'
            });
        }
    });
    $(window).resize(function () {
        if ($(window).width() >= 1200) {
            $('.stm_markup__sidebar').stickySidebar({
                bottomSpacing: 40,
                containerSelector: '.stm_markup'
            });
        } else {
            $('.stm_markup__sidebar').stickySidebar('destroy');
        }
    });
})(jQuery);