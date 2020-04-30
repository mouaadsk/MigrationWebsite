jQuery(document).ready(function ($) {
	"use strict";

	function togglerAppend(el) {
		$(el).each(function () {
			var menu_container = $(this);
			if(menu_container.attr('ekit-dom-added') == 'yes'){
				return;
			}
			menu_container
			.before(
				'<button class="elementskit-menu-hamburger elementskit-menu-toggler">'
				+ '<span class="elementskit-menu-hamburger-icon"></span>'
				+ '<span class="elementskit-menu-hamburger-icon"></span>'
				+ '<span class="elementskit-menu-hamburger-icon"></span>'
				+ '</button>'
			)
			.after('<div class="elementskit-menu-overlay elementskit-menu-offcanvas-elements elementskit-menu-toggler"></div>')
			.attr('ekit-dom-added', 'yes');
		})
	}

	togglerAppend($('.elementskit-menu-container'));

	function elementskit_event_manager(_event, _selector, _fn) {
		$(document).on(_event, _selector, _fn);
	}

	elementskit_event_manager('click', '.elementskit-dropdown-has > a', function (e) {
		if(e.target.className === 'elementskit-submenu-indicator') {
			e.preventDefault();
			
			var winW = jQuery(window).width();
			
			var menu = $(this).parents('.elementskit-navbar-nav');
			var li = $(this).parent();
			var dropdown = li.find('>.elementskit-dropdown, >.elementskit-megamenu-panel');

			dropdown.find('.elementskit-dropdown-open').removeClass('elementskit-dropdown-open');

			if (dropdown.hasClass('elementskit-dropdown-open')) {
				dropdown.removeClass('elementskit-dropdown-open');
			} else {
				dropdown.addClass('elementskit-dropdown-open');
			}
		}

	});

	elementskit_event_manager('click', '.elementskit-menu-toggler', function (e) {
		e.preventDefault();
		var parent_conatiner = $(this).parents('.elementskit-menu-container').parent();
		if (parent_conatiner.length < 1) {
			parent_conatiner = $(this).parent();
		}
		var off_canvas_class = parent_conatiner.find('.elementskit-menu-offcanvas-elements');

		if (off_canvas_class.hasClass('active')) {
			off_canvas_class.removeClass('active');
		} else {
			off_canvas_class.addClass('active');
		}

	});

	
	// hash menu click to hide menu sidebar
	elementskit_event_manager('click', '.elementskit-navbar-nav li a', function(e){
		if($(this).attr('href') && e.target.className !== 'elementskit-submenu-indicator'){
			var self = $(this),
				el = self.get(0),
				href =  el.href,
				hasHash = href.indexOf('#'),
				enable = self.parents('.elementskit-menu-container').hasClass('ekit-nav-menu-one-page-yes');
				

				if(hasHash !== -1 && (href.length > 1) && enable && (el.pathname == window.location.pathname)){
					e.preventDefault();
					self.parents('.ekit-wid-con').find('.elementskit-menu-close').trigger('click');
				}
		}
	});


}); // end ready function