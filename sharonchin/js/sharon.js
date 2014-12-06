//jQuery( document ).ready(function() {
jQuery(window).load(function() {
  var $container = jQuery('#masonry').masonry({itemSelector: '.lilypad'});
//  $container.imagesLoaded( function() {
//	$container.masonry();
//  });

});

jQuery( document ).ready(function() {
	jQuery('.carousel').bind('slid', function() {
		jQuery('#slide-counter').html(jQuery('.item.active').index() + 1);
	});
	jQuery('.gallery-thumbnails li a').bind('click', function(e) {   
		e.preventDefault();
		jQuery('.carousel').carousel(jQuery(e.currentTarget).data('id')); 
	});
	jQuery('.widget > ul').addClass('nav nav-pills nav-stacked');
});



