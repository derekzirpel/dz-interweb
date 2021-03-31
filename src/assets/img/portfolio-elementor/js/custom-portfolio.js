//Use Strict Mode
(function ($) {
    "use strict";

    $(window).load(function () {
        if ( $( ".elpt-portfolio-content-isotope" ).length ) {
            //Project Filter
            var $container = $('.elpt-portfolio-content-isotope');
            var $grid = $('.elpt-portfolio-content-isotope').isotope({
                itemSelector: '.portfolio-item-wrapper'
            });

            $('.elpt-portfolio-filter').on('click', 'button', function () {   
                $('.elpt-portfolio-filter button').removeClass('item-active');
                $(this).addClass('item-active');
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });

            //Lightbox
            $('.elpt-portfolio-lightbox').each(function(){
                $(this).simpleLightbox({
                    captions: true,
                    disableScroll: false
                }); 
            });
        }

    });
    //End - Use Strict mode
})(jQuery);