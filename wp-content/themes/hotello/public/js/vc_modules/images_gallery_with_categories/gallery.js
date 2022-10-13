'use strict';

(function ($) {
    $(document).ready(function () {
        var module = $('.stm_images_gallery_with_categories');
        var tabsLinks = module.find('.stm-images__categories li a');
        var items = module.data('number');
        var images = {};

        function loadImages(ids, page, tab) {
            var start = (page - 1) * items;
            var end = start + items;
            var totalPages = Math.ceil(ids.length / items);
            var imagesContainer = tab.find('.stm-images__container');

            var chunk = ids.slice(start, end);

            if (page === totalPages) {
                tab.addClass('no-images');
            }

            chunk.forEach(function (id) {
                if (id in images) {
                    images[id].appendTo(imagesContainer).fadeIn(300);
                    tab.removeClass('images-loading');
                    tab.addClass('images-loaded');
                    stm_light_gallery(true);
                } else {
                    $.ajax({
                        url: stm_ajaxurl,
                        data: {
                            image_id: id,
                            action: 'get_image_by_id'
                        },
                        error: function error(_error) {
                            return console.log(_error);
                        }
                    }).then(function (image) {
                        image = $(image).wrap('<a href=""></a>');
                        image = $(image).appendTo(imagesContainer).fadeOut(0, function () {
                            $(this).fadeIn(300);
                            images[id] = $(this).clone();
                        });
                        stm_light_gallery(true);

                        tab.trigger('image-loaded');
                        if (id === chunk[chunk.length - 1]) {
                            tab.trigger('images-loaded');
                        }
                        image.load(function () {});

                        tab.removeClass('images-loading');
                        tab.addClass('images-loaded');
                    });
                }
            });
        }

        tabsLinks.on('shown.bs.tab', function () {
            var tab = $($(this).attr('href'));
            var imageIds = tab.data('images').split(',');

            if (!tab.hasClass('seen')) {
                tab.addClass('images-loading');
                loadImages(imageIds, 1, tab);
            }
            tab.addClass('seen');
        });

        $(tabsLinks[0]).trigger('click');

        tabsLinks.each(function () {
            var tab = $($(this).attr('href'));
            var button = tab.find('.stm-load-more');
            var imageIds = tab.data('images').split(',');
            var loadMore = tab.data('load-more');
            var loaded = tab.data('loaded');
            var page = tab.data('page');

            if (items === -1 || !loadMore) {
                items = imageIds.length;
            }

            if (loadMore && !loaded) {
                button.on('click', function () {
                    tab.addClass('images-loading');
                    tab.removeClass('images-loaded');
                    page = tab.data('page') + 1;
                    tab.data('page', page);
                    loadImages(imageIds, page, tab);
                });
            }
        });
    });
})(jQuery);