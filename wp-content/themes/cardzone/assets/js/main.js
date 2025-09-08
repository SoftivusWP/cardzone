(function ($) {
    "use strict";

    $(document).ready(function () {

        //--Owl Carousel--
        $(".top__ratedwrapper").owlCarousel({
            loop: true,
            margin: 0,
            smartSpeed: 500,
            autoplayTimeout: 1000,
            autoplay: false,
            nav: false,
            dots: true,
            responsiveClass: true,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                500: {
                    items: 2,
                },
                767: {
                    items: 3,
                },
                991: {
                    items: 3,
                },
                1199: {
                    items: 3,
                },
                1399: {
                    items: 4,
                },
            },
        });
        $(".testimonial__slider").owlCarousel({
            loop: true,
            margin: 10,
            smartSpeed: 2500,
            autoplayTimeout: 2500,
            autoplay: false,
            nav: true,
            dots: false,
            responsiveClass: true,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                575: {
                    items: 1,
                },
                767: {
                    items: 1,
                },
                991: {
                    items: 1,
                },
                1199: {
                    items: 1,
                },
                1499: {
                    items: 1,
                },
                1999: {
                    items: 1,
                },
            },
        });
        $(".testimonial__wraptwo").owlCarousel({
            loop: true,
            margin: 24,
            smartSpeed: 2500,
            autoplayTimeout: 2500,
            autoplay: false,
            nav: false,
            dots: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                575: {
                    items: 1,
                },
                767: {
                    items: 2,
                },
                991: {
                    items: 2,
                },
                1199: {
                    items: 3,
                },
                1499: {
                    items: 3,
                },
                1999: {
                    items: 3,
                },
            },
        });
        $(".virtual-wrap").owlCarousel({
            loop: true,
            margin: 20,
            smartSpeed: 2500,
            autoplayTimeout: 3000,
            autoplay: false,
            nav: true,
            dots: false,
            responsiveClass: true,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1,
                },
                400: {
                    items: 2,
                },
                767: {
                    items: 3,
                },
                991: {
                    items: 4,
                },
                1199: {
                    items: 3,
                },
                1399: {
                    items: 4,
                },
                1499: {
                    items: 4,
                },
                1699: {
                    items: 4,
                },
            },
        });
        $(".sponsor-wrap").owlCarousel({
            loop: true,
            margin: 20,
            smartSpeed: 2000,
            autoplayTimeout: 2000,
            autoplay: false,
            nav: false,
            dots: false,
            responsiveClass: true,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>',
            ],
            responsive: {
                0: {
                    items: 2,
                },
                400: {
                    items: 3,
                },
                575: {
                    items: 4,
                },
                767: {
                    items: 5,
                },
                991: {
                    items: 6,
                },
                1199: {
                    items: 5,
                },
                1499: {
                    items: 9,
                },
            },
        });
        //--Owl Carousel--

        // password hide--
        $(".toggle-password, .toggle-password2, .toggle-password3, .toggle-password4, .toggle-password5").click(function() {
        	$(this).toggleClass("fa-eye fa-eye-slash");
        	var input = $($(this).attr("id"));
        	if (input.attr("type") == "password") {
        		input.attr("type", "text");
        	} else {
        		input.attr("type", "password");
        	}
        });
        // password hide--

        //--Nice Select--
        $('select').niceSelect();
        //--Nice Select--

        //menu top fixed bar
        var fixed_top = $(".header-section");
        $(window).on("scroll", function () {
            if ($(this).scrollTop() > 220) {
                fixed_top.addClass("menu-fixed animated fadeInDown");
                fixed_top.removeClass("slideInUp");
                $("body").addClass("body-padding");
            } else {
                fixed_top.removeClass("menu-fixed fadeInDown");
                fixed_top.addClass("slideInUp");
                $("body").removeClass("body-padding");
            }
        });
        //menu top fixed bar

        //--Header Menu
        $(".header-bar").on("click", function () {
            $(".main-menu, .header-bar").toggleClass("active");
        });
        $(".main-menu li a").on("click", function () {
            var element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
                element.find("ul").slideUp(300, "swing");
            } else {
                element.addClass("open");
                element.children("ul").slideDown(300, "swing");
                element.siblings("li").children("ul").slideUp(300, "swing");
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
                element.siblings("li").find("ul").slideUp(300, "swing");
            }
        });
        $(".scrollToTop").on("click", function () {
            $("html, body").animate({
                scrollTop: 0,
            }, 700);
            return false;
        });
        //--Header Menu--
        
        //Menu last
        $('.main-menu > li').slice(-3).addClass('menu-last-unit');


        //--Magnifiqpopup--
        $('.video-btn').magnificPopup({
            type: 'iframe',
            callbacks: {

            }
        });
        //--Magnifiqpopup--

        //--Odometer--
        $(".odometer-item").each(function () {
            $(this).isInViewport(function (status) {
                if (status === "entered") {
                    for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
                        var el = document.querySelectorAll(".odometer")[i];
                        el.innerHTML = el.getAttribute("data-odometer-final");
                    }
                }
            });
        });
        //--Odometer--

        
        // custom filter
        $(".filter-button").click(function(){
            var value = $(this).attr('data-filter');
            
            // Remove active class from all filter buttons
            $(".filter-button").removeClass("active");
            
            // Add active class to the clicked filter button
            $(this).addClass("active");
            
            // Filter logic
            if(value == "all") {
                $('.filter').show('1000');
            } else {
                $(".filter").not('.'+value).hide('3000');
                $('.filter').filter('.'+value).show('3000');
            }
        });

 

        //--Quantity--

        var input = document.querySelector('#qty');
        var btnminus = document.querySelector('.qtyminus');
        var btnplus = document.querySelector('.qtyplus');

        if (input !== undefined && btnminus !== undefined && btnplus !== undefined && input !== null && btnminus !== null && btnplus !== null) {

        	var min = Number(input.getAttribute('min'));
        	var max = Number(input.getAttribute('max'));
        	var step = Number(input.getAttribute('step'));

        	function qtyminus(e) {
        		var current = Number(input.value);
        		var newval = (current - step);
        		if(newval < min) {
        			newval = min;
        		} else if(newval > max) {
        			newval = max;
        		} 
        		input.value = Number(newval);
        		e.preventDefault();
        	}

        	function qtyplus(e) {
        		var current = Number(input.value);
        		var newval = (current + step);
        		if(newval > max) newval = max;
        		input.value = Number(newval);
        		e.preventDefault();
        	}

        	btnminus.addEventListener('click', qtyminus);
        	btnplus.addEventListener('click', qtyplus);

        }
        //--Quantity--

        //--Wow Animation--
        new WOW().init();
        //--Wow Animation--

        //--Preloader--//
        setTimeout(function () {
            $('.preloader__wrap').fadeToggle();
        }, 1000);
        //--Preloader--//

        // --search popup--
        var openButton = document.getElementById('searchBtn');
        var popup = document.getElementById('searchPopup');
        var closeButton = document.getElementById('closeButton');

        openButton.addEventListener('click', function () {
            popup.classList.add('open');
        });

        closeButton.addEventListener('click', function () {
            popup.classList.add('close');
            setTimeout(function () {
                popup.classList.remove('open', 'close');
            }, 100);
        });
        //--search popup--//

    });
})(jQuery);
