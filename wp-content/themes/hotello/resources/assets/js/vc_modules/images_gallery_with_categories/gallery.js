(function ($) {
    $(document).ready(function () {
        let module = $('.stm_images_gallery_with_categories');
        let tabsLinks = module.find('.stm-images__categories li a');
        let items = module.data('number');
        let images = {};

        function loadImages(ids, page, tab) {
            let start = (page - 1) * items;
            let end = start + items;
            let totalPages = Math.ceil(ids.length / items);
            let imagesContainer = tab.find('.stm-images__container');

            let chunk = ids.slice(start, end);

            if (page === totalPages) {
                tab.addClass('no-images');
            }

            chunk.forEach(id => {
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
                        error: error => console.log(error)
                    }).then(
                        image => {
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
                            image.load(function () {

                            });

                            tab.removeClass('images-loading');
                            tab.addClass('images-loaded')
                        })
                }

            });
        }

        tabsLinks.on('shown.bs.tab', function () {
            let tab = $($(this).attr('href'));
            let imageIds = tab.data('images').split(',');


            if (!tab.hasClass('seen')) {
                tab.addClass('images-loading');
                loadImages(imageIds, 1, tab);
            }
            tab.addClass('seen');
        });

        $(tabsLinks[0]).trigger('click');

        tabsLinks.each(function () {
            let tab = $($(this).attr('href'));
            let button = tab.find('.stm-load-more');
            let imageIds = tab.data('images').split(',');
            let loadMore = tab.data('load-more');
            let loaded = tab.data('loaded');
            let page = tab.data('page');


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
                })
            }
        });
    })
})(jQuery);