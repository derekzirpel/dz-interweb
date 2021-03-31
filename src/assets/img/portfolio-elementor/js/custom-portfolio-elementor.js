//IMPORTANT: This need a fix on the isotope file to work in the elementor preview. See https://github.com/elementor/elementor/issues/6756
/*You need to comment the following files on the isotope file:
// check that elem is an actual element
    /*if ( !( elem instanceof HTMLElement ) ) {
      return;
}*/
function startElemenfolio(){   

    jQuery('#elementor-preview-iframe').contents().find('.elpt-portfolio-content-isotope').imagesLoaded( function() {
        var $grid = jQuery('#elementor-preview-iframe').contents().find('.elpt-portfolio-content-isotope').isotope({
            itemSelector: '.portfolio-item-wrapper',
            layoutMode: 'masonry',
            percentPosition: true,  
            masonry: {
                columnWidth: '.portfolio-item-wrapper'
            }      
        });  
    });                
}

jQuery(window).on('load', function(){
    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function($scope){
        startElemenfolio();        
    });

    setInterval(function() {	
		startElemenfolio(); 
	}, 1000);
});