'use strict';

(function ($) {
    $(document).ready(function () {
        $('.stm-rooms-types li.active').each(function () {
            var type = $(this).attr('data-type');
            var $container = $(this).closest('.stm_wp_hotelier_rooms_list');
            $container.find('.' + type).addClass('active');
        });

        $('.stm-rooms-types li').on('click', function (e) {
            e.preventDefault();
            var type = $(this).attr('data-type');
            var $container = $(this).closest('.stm_wp_hotelier_rooms_list');

            var $links = $container.find('.stm-rooms-types li');
            $links.removeClass('active');
            $(this).addClass('active');

            $container.find('.stm-rooms-list').removeClass('active');
            $container.find('.' + type).addClass('active');
        });
    });
})(jQuery);