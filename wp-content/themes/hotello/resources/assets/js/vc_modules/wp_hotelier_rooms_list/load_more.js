(function ($) {
    $(document).ready(function () {
        $('.stm-rooms-types li.active').each(function(){
            let type = $(this).attr('data-type');
            let $container = $(this).closest('.stm_wp_hotelier_rooms_list');
            $container.find('.' + type).addClass('active');
        });

        $('.stm-rooms-types li').on('click', function(e){
            e.preventDefault();
            let type = $(this).attr('data-type');
            let $container = $(this).closest('.stm_wp_hotelier_rooms_list');

            let $links = $container.find('.stm-rooms-types li');
            $links.removeClass('active');
            $(this).addClass('active');

            $container.find('.stm-rooms-list').removeClass('active');
            $container.find('.' + type).addClass('active');
            
        })
    });
})(jQuery);