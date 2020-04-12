(function($) {
$(document).ready( function() {
	var site_init = function() {
		$('div.gallery .gallery-item').each( function() {
			var photo = $(this).find('img').attr('src');
			if( photo ) {
				$(this).find('img').remove();
				$(this).find('.gallery-icon').attr('style', 'background-image:url(' +photo+ ')');
			}
		});

		$('div.gallery').each( function() {
			$(this).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true
				},
				image: {
					titleSrc: function(item) {
						return item.el.parents('.gallery-item').find('.gallery-caption').text();
					}
				}
			});
		});

		$('#site-menu ul.menu li.menu-item-has-children > a').on('click', function(e) {
			e.preventDefault();
			
			if( $(window).width() <= 992 ) {
				$(this).toggleClass('active').next('div.megamenu').toggle();
			}
		});

		$('#site-menu ul.menu > li.menu-item-has-children').hover( function(e) {
			if( $(window).width() > 992 ) {
				$(this).find('div.container > ul.sub-menu').masonry();
			}
		});

		// $('#site-menu div.megamenu .container > ul.sub-menu').masonry();
	}

	function sidebar_init() {
		var height_1 = $('.content-sidebar .sidebar').outerHeight();
		$('.content-sidebar .content').css('min-height', height_1);
	}

	function header_photo() {
		var width_1 = $(window).width();
		var width_2 = $('div.page-header .container').outerWidth();
		var width_3 = ((width_1 - width_2)/2) + 330;

		$('.page-header #breadcrumbs').css('width', width_3);
		$('div.page-header__photo').css('width', width_3);


	}

	header_photo();
	sidebar_init();
		
	$(window).resize( function() {
		header_photo();
		sidebar_init();
	});

	site_init();
});
})(jQuery);
