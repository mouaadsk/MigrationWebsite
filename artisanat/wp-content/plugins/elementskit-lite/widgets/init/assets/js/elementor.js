(function ($, elementor) {
	"use strict";

	var Elementskit = {

		init: function () {

			var widgets = {
				'elementskit-countdown-timer.default': Elementskit.Countdown_Timer,
				'elementskit-client-logo.default': Elementskit.Client_Logo,
				'elementskit-testimonial.default': Elementskit.Testimonial_Slider,
				'elementskit-image-comparison.default': Elementskit.Image_Comparison,
				'elementskit-progressbar.default': Elementskit.Progressbar,
				'elementskit-piechart.default': Elementskit.Piechart,
				'elementskit-funfact.default': Elementskit.Funfact,
				'elementskit-gallery.default': Elementskit.Gallery,
				'elementskit-motion-text.default': Elementskit.MotionText,
				'elementskit-timeline.default': Elementskit.TimeLine,
				'elementskit-post-tab.default': Elementskit.PostTab,
				'elementskit-elementskit-hotspot.default': Elementskit.Hotspot,
				'elementskit-header-search.default': Elementskit.Header_Search,
				'elementskit-header-offcanvas.default': Elementskit.Header_Off_Canvas,
				'elementskit-table.default': Elementskit.Table,
				'elementskit-creative-button.default': Elementskit.Creative_Button,
				'ekit-nav-menu.default': Elementskit.Nav_Menu,
				'elementskit-woo-mini-cart.default': Elementskit.Mini_Cart,
				'elementskit-team.default': Elementskit.Team,
				'elementskit-image-accordion.default': Elementskit.Image_Accordion,
				'elementskit-woo-product-carousel.default': Elementskit.Woo_Product_slider,
			};
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			});

			elementor.hooks.addAction('frontend/element_ready/global', Elementskit.GlobalCallback);
		},

		GlobalCallback: function ($scope) {
			// $('img').imagesLoaded().done(function (instance) {
			// 	console.log('all images successfully loaded');
			// });
		},

		AnimationFix: function ($scope) {
			function init($scope) {
				$scope.find('.elementskit-invisible').each(function () {
					var el = $(this);
					var settings = JSON.parse(el.attr('data-settings'));

					var isVisible = Elementskit.IsElementInView(el, false),
						animationClass = settings._animation,
						animationDelay = settings._animation_delay || 300;

					if (isVisible == true) {
						setTimeout(function () {
							el.removeClass('elementskit-invisible').addClass('animated ' + animationClass);
						}, animationDelay);
					}
				});
			}

			init($scope);
			$(window).on('scroll', function () {
				init($scope);
			});
		},

		IsElementInView: function (element, fullyInView) {
			var pageTop = $(window).scrollTop();
			var pageBottom = pageTop + $(window).height();
			var elementTop = element.offset().top;
			var elementBottom = elementTop + element.height();

			if (fullyInView === true) {
				return ((pageTop < elementTop) && (pageBottom > elementBottom));
			} else {
				return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
			}
		},

		Nav_Menu: function ($scope) {
			var menu_container = $scope.find('.elementskit-menu-container');
			if (menu_container.attr('ekit-dom-added') == 'yes') {
				return;
			}
			menu_container
				.before(
					'<button class="elementskit-menu-hamburger elementskit-menu-toggler">' +
					'<span class="elementskit-menu-hamburger-icon"></span>' +
					'<span class="elementskit-menu-hamburger-icon"></span>' +
					'<span class="elementskit-menu-hamburger-icon"></span>' +
					'</button>'
				)
				.after('<div class="elementskit-menu-overlay elementskit-menu-offcanvas-elements elementskit-menu-toggler"></div>')
				.attr('ekit-dom-added', 'yes');
		},

		Mini_Cart: function ($scope) {
			$scope.find(".ekit-dropdown-back").on('click mouseenter mouseleave', function (e) {
				var self = $(this),
					enableClick = self.hasClass('ekit-mini-cart-visibility-click'),
					enableHover = self.hasClass('ekit-mini-cart-visibility-hover'),
					body = self.find('.ekit-mini-cart-container');


				if (e.type === 'click' && enableClick && !$(e.target).parents('div').hasClass('ekit-mini-cart-container')) {
					body.fadeToggle();
				} else if (e.type === 'mouseenter' && enableHover) {
					body.fadeIn();
				} else if (e.type === 'mouseleave' && enableHover) {
					body.fadeOut();
				}

			});
		},

		Progressbar: function ($scope) {
			var barElement = $scope.find(".single-skill-bar");
			var percentElement = $scope.find(".number-percentage");
			var value = percentElement.attr("data-value");
			var duration = percentElement.attr("data-animation-duration");
			duration = parseInt((duration != '' ? duration : 300), 10);

			barElement.elementorWaypoint({
				handler: function () {
					percentElement.animateNumbers(value, true, duration);
					barElement.find('.skill-track').animate({
						width: value + '%'
					}, 3500);
				},
				offset: '100%'
			})
		},
		Funfact: function ($scope) {
			var barElement = $scope.find(".elementskit-funfact");
			var percentElement = $scope.find(".number-percentage");
			var value = percentElement.attr("data-value");
			var duration = percentElement.attr("data-animation-duration");
			duration = parseInt((duration != '' ? duration : 300), 10);

			barElement.elementorWaypoint({
				handler: function () {
					percentElement.animateNumbers(value, true, duration);
				},
				offset: '100%'
			})
		},
		Countdown_Timer: function ($scope) {

			var $container1 = $scope.find('.elementskit-countdown-timer[data-ekit-countdown]');
			var $container2 = $scope.find('.elementskit-countdown-timer-2[data-ekit-countdown]');
			var $container3 = $scope.find('.elementskit-countdown-timer-3[data-ekit-countdown]');
			var $container4 = $scope.find('.elementskit-countdown-timer-4[data-ekit-countdown]');
			var $container5 = $scope.find('.elementskit-flip-clock');

			$container1.each(function () {
				var $this = $(this),
					finalDate = $(this).data('ekit-countdown');
				var hour = $(this).data('date-ekit-hour'),
					minute = $(this).data('date-ekit-minute'),
					second = $(this).data('date-ekit-second'),
					day = $(this).data('date-ekit-day'),
					week = $(this).data('date-ekit-week'),
					finish_title = $(this).data('finish-title'),
					finish_content = $(this).data('finish-content');

				$this.theFinalCountdown(finalDate, function (event) {
						var $this = $(this).html(event.strftime(' ' +
							'<div class="elementskit-timer-container elementskit-days"><div class="elementskit-inner-container"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + day + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-hours"><div class="elementskit-inner-container"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + hour + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-minutes"><div class="elementskit-inner-container"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + minute + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-seconds"><div class="elementskit-inner-container"><div class="elementskit-timer-content"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + second + '</span></div></div></div>'
						));
					})
					.on('finish.countdown', function () {
						$(this).html(
							finish_title + "<br/>" + finish_content
						);
					});
			});

			$container2.each(function () {
				var $this = $(this),
					finalDate = $(this).data('ekit-countdown');
				var hour = $(this).data('date-ekit-hour'),
					minute = $(this).data('date-ekit-minute'),
					second = $(this).data('date-ekit-second'),
					day = $(this).data('date-ekit-day'),
					week = $(this).data('date-ekit-week'),
					finish_title = $(this).data('finish-title'),
					finish_content = $(this).data('finish-content');

				$this.theFinalCountdown(finalDate, function (event) {

						var $this = $(this).html(event.strftime(' ' +
							'<div class="elementskit-timer-container elementskit-days"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + day + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-hours"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + hour + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-minutes"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + minute + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-seconds"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + second + '</span></div>'));
					})
					.on('finish.countdown', function () {
						$(this).html(
							finish_title + "<br/>" + finish_content
						);
					});
			});

			$container3.each(function () {
				var $this = $(this),
					finalDate = $(this).data('ekit-countdown');
				var hour = $(this).data('date-ekit-hour'),
					minute = $(this).data('date-ekit-minute'),
					second = $(this).data('date-ekit-second'),
					day = $(this).data('date-ekit-day'),
					week = $(this).data('date-ekit-week'),
					finish_title = $(this).data('finish-title'),
					finish_content = $(this).data('finish-content');

				$this.theFinalCountdown(finalDate, function (event) {
						var $this = $(this).html(event.strftime(' ' +
							'<div class="elementskit-timer-container elementskit-days"><div class="elementskit-timer-content"><div class="elementskit-inner-container"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + day + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-hours"><div class="elementskit-timer-content"><div class="elementskit-inner-container"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + hour + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-minutes"><div class="elementskit-timer-content"><div class="elementskit-inner-container"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + minute + '</span></div></div></div>' +
							'<div class="elementskit-timer-container elementskit-seconds"><div class="elementskit-timer-content"><div class="elementskit-inner-container"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + second + '</span></div></div></div>'));

					})
					.on('finish.countdown', function () {
						$(this).html(
							finish_title + "<br/>" + finish_content
						);
					});
			});

			$container4.each(function () {
				var $this = $(this),
					finalDate = $(this).data('ekit-countdown');
				var hour = $(this).data('date-ekit-hour'),
					minute = $(this).data('date-ekit-minute'),
					second = $(this).data('date-ekit-second'),
					day = $(this).data('date-ekit-day'),
					week = $(this).data('date-ekit-week'),
					finish_title = $(this).data('finish-title'),
					finish_content = $(this).data('finish-content');

				$this.theFinalCountdown(finalDate, function (event) {

						var $this = $(this).html(event.strftime(' ' +
							'<div class="elementskit-timer-container elementskit-days"><span class="elementskit-timer-count">%-D </span><span class="elementskit-timer-title">' + day + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-hours"><span class="elementskit-timer-count">%H </span><span class="elementskit-timer-title">' + hour + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-minutes"><span class="elementskit-timer-count">%M </span><span class="elementskit-timer-title">' + minute + '</span></div>' +
							'<div class="elementskit-timer-container elementskit-seconds"><span class="elementskit-timer-count">%S </span><span class="elementskit-timer-title">' + second + '</span></div>'));

					})
					.on('finish.countdown', function () {
						$(this).html(
							finish_title + "<br/>" + finish_content
						);
						$(this).addClass('elementskit-coundown-finish');
					});
			});

			$container5.each(function () {
				var hour = $(this).data('date-ekit-hour'),
					minute = $(this).data('date-ekit-minute'),
					second = $(this).data('date-ekit-second'),
					day = $(this).data('date-ekit-day'),
					week = $(this).data('date-ekit-week'),
					finalDate = $(this).data('ekit-countdown'),
					finish_title = $(this).data('finish-title'),
					finish_content = $(this).data('finish-content');

				var labelsData = {
					'elementskit-wks': week,
					'elementskit-days': day,
					'elementskit-hrs': hour,
					'elementskit-mins': minute,
					'elementskit-secs': second
				};

				var labels = ['elementskit-wks', 'elementskit-days', 'elementskit-hrs', 'elementskit-mins', 'elementskit-secs'],

					nextYear = (new Date(finalDate)),
					// template = _.template('<div class="elementskit-time <%= label %>"><span class="elementskit-count elementskit-curr elementskit-top"><%= curr %></span><span class="elementskit-count elementskit-next elementskit-top"><%= next %></span><span class="elementskit-count elementskit-next elementskit-bottom"><%= next %></span><span class="elementskit-count elementskit-curr elementskit-bottom"><%= curr %></span><span class="elementskit-label"><%= labelD.length < 6 ? labelD : labelD.substr(0, 3)  %></span></div>'),
					currDate = '00:00:00:00:00',
					nextDate = '00:00:00:00:00',
					parser = /([0-9]{2})/gi,
					$example = $container5;
				// Parse countdown string to an object
				function strfobj(str) {
					var parsed = str.match(parser),
						obj = {};
					labels.forEach(function (label, i) {
						obj[label] = parsed[i]
					});
					return obj;
				}
				// Return the time components that diffs
				function diff(obj1, obj2) {
					var diff = [];
					labels.forEach(function (key) {
						if (obj1[key] !== obj2[key]) {
							diff.push(key);
						}
					});
					return diff;
				}
				// Build the layout
				var initData = strfobj(currDate);
				labels.forEach(function (label, i) {
					// $example.append(template({
					// 	curr: initData[label],
					// 	next: initData[label],
					// 	label: label,
					// 	labelD: labelsData[label]
					// }));

					// $example.append(`<div class="elementskit-time ${label}">
					// 	<span class="elementskit-count elementskit-curr elementskit-top">${initData[label]}</span>
					// 	<span class="elementskit-count elementskit-next elementskit-top">${initData[label]}</span>
					// 	<span class="elementskit-count elementskit-next elementskit-bottom">${initData[label]}</span>
					// 	<span class="elementskit-count elementskit-curr elementskit-bottom">${initData[label]}</span>
					// 	<span class="elementskit-label">${labelsData[label].length < 6 ? labelsData[label] : labelsData[label].substr(0, 3)}</span>
					// </div>`);

					$example.append('' +
						'<span class="elementskit-count elementskit-curr elementskit-top">' + initData[label] + '</span>' +
						'<span class="elementskit-count elementskit-next elementskit-top">' + initData[label] + '</span>' +
						'<span class="elementskit-count elementskit-next elementskit-bottom">' + initData[label] + '</span>' +
						'<span class="elementskit-count elementskit-curr elementskit-bottom">' + initData[label] + '</span>' +
						'<span class="elementskit-label">' + labelsData[label].length < 6 ? labelsData[label] : labelsData[label].substr(0, 3) + ' </span>'
					);
				});
				// Starts the countdown
				$example.theFinalCountdown(nextYear, function (event) {
						var newDate = event.strftime('%w:%d:%H:%M:%S'),
							data;
						if (newDate !== nextDate) {
							currDate = nextDate;
							nextDate = newDate;
							// Setup the data
							data = {
								'curr': strfobj(currDate),
								'next': strfobj(nextDate)
							};
							// Apply the new values to each node that changed
							diff(data.curr, data.next).forEach(function (label) {
								var selector = '.%s'.replace(/%s/, label),
									$node = $example.find(selector);
								// Update the node
								$node.removeClass('elementskit-flip');
								$node.find('.elementskit-curr').text(data.curr[label]);
								$node.find('.elementskit-next').text(data.next[label]);
								// Wait for a repaint to then flip
								setTimeout(function ($node) {
									$node.addClass('elementskit-flip');
								}, 50, $node);
							});
						}
					})
					.on('finish.countdown', function () {
						$(this).html(
							finish_title + "<br/>" + finish_content
						);
					});
			});

		},

		Client_Logo: function ($scope) {
			var $log_carosel = $scope.find('.elementskit-clients-slider');
			$log_carosel.each(function () {
				// //console.log($(this).data('right_icon'));
				var leftArrow = '<button type="button" class="slick-prev"><i class="icon icon-left-arrow2"></i></button>';

				var rightArrow = '<button type="button" class="slick-next"><i class="icon icon-right-arrow2"></i></button>';

				var slidestoshowtablet = $(this).data('slidestoshowtablet');
				var slidestoscroll_tablet = $(this).data('slidestoscroll_tablet');
				var slidestoshowmobile = $(this).data('slidestoshowmobile');
				var slidestoscroll_mobile = $(this).data('slidestoscroll_mobile');
				var arrow = $(this).data('show_arrow') === 'yes' ? true : false;
				var dot = $(this).data('show_dot') === 'yes' ? true : false;
				var autoPlay = $(this).data('autoplay') === 'yes' ? true : false;
				var centerMode = $(this).data('data-center_mode') === 'yes' ? true : false;

				$(this).not('.slick-initialized').slick({
					rtl: $(this).data('rtl') ? true : false,
					slidesToShow: ($(this).data('slidestoshow') !== 'undefined') ? $(this).data('slidestoshow') : 4,
					slidesToScroll: ($(this).data('slidestoscroll') !== 'undefined') ? $(this).data('slidestoscroll') : 4,
					autoplay: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
					autoplaySpeed: ($(this).data('speed') !== 'undefined') ? $(this).data('speed') : 1000,
					arrows: ($(this).data('show_arrow') !== 'undefined') ? arrow : true,
					dots: ($(this).data('show_dot') !== 'undefined') ? dot : true,
					pauseOnHover: ($(this).data('pause_on_hover') == 'yes') ? true : false,
					prevArrow: ($(this).data('left_icon') !== 'undefined') ? '<button type="button" class="slick-prev"><i class="' + $(this).data('left_icon') + '"></i></button>' : leftArrow,
					nextArrow: ($(this).data('right_icon') !== 'undefined') ? '<button type="button" class="slick-next"><i class="' + $(this).data('right_icon') + '"></i></button>' : rightArrow,
					rows: ($(this).data('rows') !== 'undefined') ? $(this).data('rows') : 1,
					vertical: ($(this).data('vertical_style') == 'yes') ? true : false,
					infinite: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
					responsive: [{
							breakpoint: 1024,
							settings: {
								slidesToShow: slidestoshowtablet,
								slidesToScroll: slidestoscroll_tablet,
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: slidestoshowtablet,
								slidesToScroll: slidestoscroll_tablet
							}
						},
						{
							breakpoint: 480,
							settings: {
								arrows: false,
								slidesToShow: slidestoshowmobile,
								slidesToScroll: slidestoscroll_mobile
							}
						}
					]

				});

			});
		},

		Testimonial_Slider: function ($scope) {
			var $testimonial_slider = $scope.find('.elementskit-testimonial-slider');
			$testimonial_slider.each(function () {
				var leftArrow = '<button type="button" class="slick-prev"><i class="icon icon-left-arrow2"></i></button>';
				var rightArrow = '<button type="button" class="slick-next"><i class="icon icon-right-arrow2"></i></button>';

				var slidestoshowtablet = $(this).data('slidestoshowtablet');
				var slidestoscroll_tablet = $(this).data('slidestoscroll_tablet');
				var slidestoshowmobile = $(this).data('slidestoshowmobile');
				var slidestoscroll_mobile = $(this).data('slidestoscroll_mobile');
				var arrow = $(this).data('show_arrow') === 'yes' ? true : false;
				var dot = $(this).data('show_dot') === 'yes' ? true : false;
				var autoPlay = $(this).data('autoplay') === 'yes' ? true : false;
				// var centerMode = $(this).data('data-center_mode') === 'yes' ? true : false;


				$(this).not('.slick-initialized').slick({
					rtl: ($(this).data('rtl') !== 'undefined') ? $(this).data('rtl') : false,
					slidesToShow: ($(this).data('slidestoshow') !== 'undefined') ? $(this).data('slidestoshow') : 1,
					slidesToScroll: ($(this).data('slidestoscroll') !== 'undefined') ? $(this).data('slidestoscroll') : 1,
					autoplay: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
					autoplaySpeed: ($(this).data('speed') !== 'undefined') ? $(this).data('speed') : 1000,
					arrows: ($(this).data('show_arrow') !== 'undefined') ? arrow : true,
					dots: ($(this).data('show_dot') !== 'undefined') ? dot : true,
					pauseOnHover: ($(this).data('pause_on_hover') == 'yes') ? true : false,
					prevArrow: ($(this).data('left_icon') !== 'undefined') ? '<button type="button" class="slick-prev"><i class="' + $(this).data('left_icon') + '"></i></button>' : leftArrow,
					nextArrow: ($(this).data('right_icon') !== 'undefined') ? '<button type="button" class="slick-next"><i class="' + $(this).data('right_icon') + '"></i></button>' : rightArrow,
					// rows: ($(this).data('rows') !== 'undefined') ? $(this).data('rows') : 1,
					vertical: ($(this).data('vertical_style') == 'yes') ? true : false,
					infinite: ($(this).data('autoplay') !== 'undefined') ? autoPlay : true,
					responsive: [{
							breakpoint: 1024,
							settings: {
								slidesToShow: slidestoshowtablet,
								slidesToScroll: slidestoscroll_tablet,
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: slidestoshowtablet,
								slidesToScroll: slidestoscroll_tablet
							}
						},
						{
							breakpoint: 480,
							settings: {
								arrows: false,
								slidesToShow: slidestoshowmobile,
								slidesToScroll: slidestoscroll_mobile
							}
						}
					]
				});

			});
		},

		Image_Comparison: function ($scope) {
			var $ekit_img_comparison = $scope.find('.elementskit-image-comparison');

			$ekit_img_comparison.imagesLoaded(function (e) {
				var $el = $(e.elements[0]),
					config = {
						orientation: $el.hasClass('image-comparison-container-vertical') ? 'vertical' : 'horizontal',
						before_label: $el.data('label_before'),
						after_label: $el.data('label_after'),
						default_offset_pct: $el.data('offset'),
						no_overlay: $el.data('overlay'),
						move_slider_on_hover: $el.data('move_slider_on_hover'),
						click_to_move: $el.data('click_to_move')
					};

				$el.twentytwenty(config);
			});
		},
		Piechart: function ($scope) {
			var colorfulchart = $scope.find('.colorful-chart');

			//console.log(colorfulchart);

			if (colorfulchart.length > 0) {

				colorfulchart.each(function (__, e) {
					var myColors = $(e).data('color');
					var datalineWidth = $(e).data('linewidth');
					var color_type = $(e).data('pie_color_style');
					var gradentColor1 = $(e).data('gradientcolor1');
					var gradentColor2 = $(e).data('gradientcolor2');
					var barbg = $(e).data('barbg');

					var obj;

					if (color_type === 'gradient') {

						obj = {
							gradientChart: true,
							barColor: gradentColor1,
							gradientColor1: gradentColor2,
							gradientColor2: gradentColor1,
							lineWidth: datalineWidth,
							trackColor: barbg,
						};

					} else {
						obj = {
							lineWidth: datalineWidth,
							barColor: myColors,
							trackColor: barbg,
						};
					}

					$(e).myChart(obj);
				})
			}

		},
		Gallery: function ($scope) {
			var $container = $scope.find('.ekit_gallery_grid');
			var column = $container.data('gallerycol');
			// console.log((parseInt(column.tablet, 10)));
			if ($container.length > 0) {
				var colWidth = function colWidth() {
						var w = $container.width(),
							windowWidth = $(window).width(),
							columnNum,
							columnWidth = 0;
						if (windowWidth > 1024) {
							columnNum = parseInt(column.desktop, 10);
						} else if (windowWidth >= 768) {
							columnNum = parseInt(column.tablet, 10);
						}
						columnWidth = Math.floor(w / columnNum);
						$container.find('.ekit_gallery_grid_item').each(function () {
							var $item = $(this),
								multiplier_w = $item.attr('class').match(/ekit_gallery_grid_item-w(\d)/),
								width = multiplier_w ? columnWidth * multiplier_w[1] : columnWidth;
							$item.css({
								width: width,
							});
						});
						return columnWidth;
					},
					isotope = function isotope() {
						$container.isotope({
							resizable: false,
							itemSelector: '.ekit_gallery_grid_item',
							masonry: {
								columnWidth: colWidth(),
								gutterWidth: 0
							}
						});
					};
				isotope();
				$(window).on('resize load', isotope);
				var $optionSets = $scope.find('.filter-button-wraper .option-set'),
					$optionLinks = $optionSets.find('a');
				$optionLinks.on('click', function () {
					var $this = $(this);
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.selected').removeClass('selected');
					$this.addClass('selected');
					// make option object dynamically, i.e. { filter: '.my-filter-class' }
					var options = {},
						key = $optionSet.attr('data-option-key'),
						value = $this.attr('data-option-value');

					// parse 'false' as false boolean
					value = value === 'false' ? false : value;
					options[key] = value;
					if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
						// changes in layout modes need extra logic
						changeLayoutMode($this, options);
					} else {
						// creativewise, apply new options
						$container.isotope(options);
					}
					return false;
				});
			}
			// tilt
			var tiltContainer = $scope.find('.ekit-gallery-portfolio-tilt'),
				glare = $(tiltContainer).data('tilt-glare') === 'yes' ? true : false;
			$(tiltContainer).tilt({
				easing: "cubic-bezier(.03,.98,.52,.99)",
				transition: true,
				glare: glare,
			})

			$container.imagesLoaded(function () {
				$container.isotope();
			});

			$(window).on('scroll', function () {
				$container.isotope('layout');
			});
		},
		MotionText: function ($scope) {
			var texts = $scope.find('.ekit_char_based .ekit_motion_text');
			var motionTitle = $scope.find('.ekit_motion_text_title');

			// split content
			texts.each(function () {
				var text = $(this);
				for (let i = 0; i < text.length; i++) {
					var $this = text[i];
					var content = $this.innerHTML;
					content = content.trim();
					var str = '';
					var delay = parseInt(text.attr('data-ekit-animation-delay')),
						delayIncrement = delay;

					//console.log(delay);

					for (let l = 0; l < content.length; l++) {
						if (content[l] != '') {
							// str += `<span class="ekit-letter" style="animation-delay:${delay}ms; -moz-animation-delay:${delay}ms; -webkit-animation-delay:${delay}ms;">${content[l]}</span>`;
							str += '<span class="ekit-letter" style="animation-delay:' + delay + 'ms; -moz-animation-delay:' + delay + 'ms; -webkit-animation-delay:' + delay + 'ms;">' + content[l] + '</span>';
							delay += delayIncrement;
						} else {
							str += content[i];
						}
					}
					$this.innerHTML = str;
				}
			});

			// motion title on scroll
			var animationClass = motionTitle.attr("data-animate-class");
			motionTitle.elementorWaypoint({
				handler: function () {
					motionTitle.addClass(animationClass).css('opacity', 1);
				},
				offset: '100%'
			});


		},

		TimeLine: function ($scope) {

			Elementskit.AnimationFix($scope);

			var horizantalTimeline = $scope.find('.horizantal-timeline');

			if (horizantalTimeline.length > 0) {
				horizantalTimeline.find('.content-group').each(function (__, e) {
					$(e).on('mouseenter', function () {
						if ($(e).parents('.single-timeline').hasClass('hover')) {
							$(e).parents('.single-timeline').removeClass('hover')
						} else {
							$(e).parents('.single-timeline').addClass('hover')
							$(e).parents('.single-timeline').nextAll().removeClass('hover')
							$(e).parents('.single-timeline').prevAll().removeClass('hover')
						}
					})
				})
			}
		},

		PostTab: function ($scope) {
			var tab = $scope.find('.post--tab');

			if (tab.length < 1) {
				return;
			}

			var event_type = tab.attr('data-post-tab-event');

			tab.find('.tabHeader > .tab__list > .tab__list__item').on(event_type, function () {
				$(tab).find('.tabHeader > .tab__list > .tab__list__item').removeClass('active');
				$(this).addClass('active');
				$(tab).find('.tabContent > .tabItem').removeClass('active');
				$(tab).find('.tabContent > .tabItem').eq($(this).index()).addClass('active');
				$(tab).find('.tabContent > .tabItem').hide();
				$(tab).find('.tabContent > .tabItem').eq($(this).index()).show();
			});
		},
		Hotspot: function ($scope) {
			if ($scope.find('[data-toggle="tooltip"]').length > 0) {
				var event_type = $scope.find('[data-toggle="tooltip"]');
				event_type.tooltip();
			}
		},
		Header_Search: function ($scope) {
			if ($scope.find('.ekit-modal-popup').length > 0) {
				$scope.find('.ekit-modal-popup').magnificPopup({
					type: 'inline',
					fixedContentPos: true,
					fixedBgPos: true,
					overflowY: 'auto',
					closeBtnInside: false,
					prependTo: $scope.find('.ekit-wid-con'),
					callbacks: {
						beforeOpen: function () {
							this.st.mainClass = "my-mfp-slide-bottom ekit-promo-popup";
						},
						open: function() {
							jQuery('body').css('overflow', 'hidden');
						},
						close: function() {
							jQuery('body').css('overflow', 'auto');
						}
					}
				});
			}
		},
		Team: function ($scope) {
			var el = $scope.find('.ekit-team-popup');
			el.magnificPopup({
				type: 'inline',
				fixedContentPos: true,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				prependTo: $scope.find('.ekit-wid-con'),
				showCloseBtn: false,
				callbacks: {
					beforeOpen: function () {
						this.st.mainClass = "my-mfp-slide-bottom ekit-promo-popup";
					}
				}
			});

			$($scope).find('.ekit-modal-close').on('click', function () {
				el.magnificPopup('close');
			});
		},
		Table: function ($scope) {
			if ($scope.find('.ekit_table').length > 0) {
				var settings = $scope.find('.ekit_table').data('settings'),
					prevText = (settings.nav_style.trim() === 'text' || settings.nav_style.trim() === 'both') ? '<span class="ekit-tbl-pagi-nav ekit-tbl-pagi-prev">' + settings.prev_text + '</span>' : '',
					nextText = (settings.nav_style.trim() === 'text' || settings.nav_style.trim() === 'both') ? '<span class="ekit-tbl-pagi-nav ekit-tbl-pagi-next">' + settings.next_text + '</span>' : '',
					prevArrow = (settings.nav_style.trim() === 'arrow' || settings.nav_style.trim() === 'both') ? '<i class="ekit-tbl-pagi-nav-icon ekit-tbl-pagi-nav-prev-icon ' + settings.prev_arrow + '" aria-hidden="true"></i>' : '',
					nextArrow = (settings.nav_style.trim() === 'arrow' || settings.nav_style.trim() === 'both') ? '<i class="ekit-tbl-pagi-nav-icon ekit-tbl-pagi-nav-next-icon ' + settings.next_arrow + '" aria-hidden="true"></i>' : '';

				$(window).trigger('resize');

				var tableConfig = {
					buttons: settings.button === true ? ['copy', 'excel', 'csv'] : [],
					bFilter: settings.search,
					autoFill: true, //don't know
					pageLength: settings.item_per_page ? settings.item_per_page : 1,
					fixedHeader: settings.fixedHeader,
					responsive: settings.responsive,
					paging: settings.pagination,
					ordering: settings.ordering,
					info: settings.info,
					"language": {
						search: '<span class="ekit-table-search-label"><i class="fa fa-search" aria-hidden="true"></i></span>',
						searchPlaceholder: 'Type Here To Search...',
						paginate: {
							next: nextText + nextArrow,
							previous: prevArrow + prevText
						}
					}
				}

				if (settings.entries === false) {
					tableConfig.dom = 'Bfrtip';
				}

				$scope.find('.ekit_table table').DataTable(tableConfig);
			}
		},

		Header_Off_Canvas: function ($scope) {
			if ($scope.find('.ekit-sidebar-group').length > 0) {
				$scope.find('.ekit_offcanvas-sidebar').on('click', function (e) {
					e.preventDefault();
					$scope.find('.ekit-sidebar-group').addClass('ekit_isActive');
				});
				$scope.find('.ekit_close-side-widget').on('click', function (e) {
					e.preventDefault();
					$scope.find('.ekit-sidebar-group').removeClass('ekit_isActive');
				});
				$scope.find('.ekit-overlay').on('click', function (e) {
					$scope.find('.ekit-sidebar-group').removeClass('ekit_isActive');
				});
			}
		},

		Creative_Button: function ($scope) {
			if ($scope.find('.ekit_position_aware').length > 0) {
				$scope.find('.ekit_position_aware').on('mouseenter', function (e) {
					var parentOffset = $(this).offset(),
						relX = e.pageX - parentOffset.left,
						relY = e.pageY - parentOffset.top;
					$(this).find('.ekit_position_aware_bg').css({
						top: relY,
						left: relX
					});
				}).on('mouseout', function (e) {
					var parentOffset = $(this).offset(),
						relX = e.pageX - parentOffset.left,
						relY = e.pageY - parentOffset.top;
					$(this).find('.ekit_position_aware_bg').css({
						top: relY,
						left: relX
					});
				});
			}
		},

		Image_Accordion: function ($scope) {
			if ($scope.find('.elementskit-single-image-accordion').length > 0) {
				$scope.find('.elementskit-single-image-accordion').on('click', function () {
					$(this).siblings().removeClass('active').end().addClass('active');
				})
			}
		},

		Woo_Product_slider: function($scope) {
			let target = $scope.find('.ekit-swiper-container'),
				autoplay = target.data('autoplay'),
				loop = target.data('loop'),
				speed = target.data('speed'),
				spaceBetween = target.data('space-between'),
				respoonsive_seetings = target.data('responsive-settings');
			

			new Swiper(target, {
				navigation: {
					nextEl: $scope.find('.ekit-navigation-next'),
					prevEl: $scope.find('.ekit-navigation-prev'),
				},
				pagination: {
				  el        : $scope.find('.ekit-swiper-pagination'),
				  type      : 'bullets',
				  clickable : true,
				},
				"autoplay"      : autoplay && autoplay,
				"loop"          : loop && Boolean(loop),
				"speed"         : speed && Number(speed),
				"slidesPerView" : Number(respoonsive_seetings['ekit_columns_mobile']),
				"spaceBetween": spaceBetween && Number(spaceBetween),
				breakpointsInverse: true,
				"breakpoints"   : {
					640 : {
						"slidesPerView" : Number(respoonsive_seetings['ekit_columns_mobile']),
						"spaceBetween"  : spaceBetween && Number(spaceBetween),
					},
					768 : {
						"slidesPerView" : Number(respoonsive_seetings['ekit_columns_tablet']),
						"spaceBetween"  : spaceBetween && Number(spaceBetween),
					},
					1024 : {
						"slidesPerView" : Number(respoonsive_seetings['ekit_columns_desktop']),
						"spaceBetween"  : spaceBetween && Number(spaceBetween),
					},
				}
			});
		}
	};
	$(window).on('elementor/frontend/init', Elementskit.init);
}(jQuery, window.elementorFrontend));



(function ($) {
	"use strict";
	$.fn.animateNumbers = function (stop, commas, duration, ease) {
		return this.each(function () {
			var $this = $(this);
			var start = parseInt($this.text().replace(/,/g, ""), 10);
			commas = (commas === undefined) ? true : commas;
			$({
				value: start
			}).animate({
				value: stop
			}, {
				duration: duration == undefined ? 500 : duration,
				easing: ease == undefined ? "swing" : ease,
				step: function () {
					$this.text(Math.floor(this.value));
					if (commas) {
						$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
					}
				},
				complete: function () {
					if (parseInt($this.text(), 10) !== stop) {
						$this.text(stop);
						if (commas) {
							$this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
						}
					}
				}
			});
		});
	};

	$.fn.myChart = function (options) {
		var settings = $.extend({
			barColor: '#666666',
			gradientColor1: '',
			gradientColor2: '',
			scaleColor: 'transparent',
			lineWidth: 20,
			size: 150,
			trackColor: '#f7f7f7',
			lineCap: 'round',
			gradientChart: false,
		}, options);

		return this.easyPieChart({
			barColor: settings.gradientChart === true ? function (percent) {
				var ctx = this.renderer.getCtx();
				var canvas = this.renderer.getCanvas();
				var gradient = ctx.createLinearGradient(0, 0, canvas.width, 0);
				gradient.addColorStop(0, settings.gradientColor1);
				gradient.addColorStop(1, settings.gradientColor2);
				return gradient;
			} : settings.barColor,
			scaleColor: settings.scaleColor,
			trackColor: settings.trackColor,
			lineCap: settings.lineCap,
			size: settings.size,
			lineWidth: settings.lineWidth
		});
	}


	$(document).ready(function () {
		if ($('.ekit-video-popup').length > 0) {
			$('.ekit-video-popup').magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-fade',
				removalDelay: 160,
				preloader: true,
				fixedContentPos: false,
			});
		}

		if ($('#wp-admin-bar-elementor_edit_page-default').length > 0) {
			var elements = $('#wp-admin-bar-elementor_edit_page-default').children('li');
			$(elements).map(function (__, element) {
				var target = $(element).find(".elementor-edit-link-title");
				if (target.text().indexOf('dynamic-content-') !== -1) {
					target.parent().parent().remove();
				}
			});
		}

	}); // end ready function
})(jQuery);