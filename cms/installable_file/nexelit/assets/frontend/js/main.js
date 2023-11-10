!function (a) {
    "use strict";
    
    a(document).ready(function () {
        if ($(".bgvdoplayer").length > 0) {
            $(".bgvdoplayer").YTPlayer();
        }

       /*
        ========================================
            Navbar Toggler
        ========================================
        */
        $(document).on('click', '.sidebars-close', function() {
            $(".bar-line").removeClass("active");
            $(".sidebars-wrappers").removeClass("active");
        });
        $(document).on('click', '.side-bars', function() {
            $(".sidebars-wrappers").toggleClass("active");
            $(".bar-line").toggleClass("active");
        });
        // Show nav right content
        $(document).on('click', '.click-content-show', function() {
            $(".right-contents-show").toggleClass("show");
        });



        /*
        ========================================
            Category Toggle Class
        ========================================
        */

        $(document).on('click', '.top-menu-toggle', function() {
            $(".navbar-area-side").toggleClass("active");
        });

        /*
        ========================================
            top-menu-category Click
        ========================================
        */

        $(document).on('click', '.navbar-area-side .cate-list', function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });


        /* ========================================
              Global Slider Init
          ========================================
          */
        var globalSlickInit = $('.global-slick-init');
        if (globalSlickInit.length > 0) {
            //todo have to check slider item
            $.each(globalSlickInit, function(index, value) {
                if ($(this).children('div').length > 1) {
                    //todo configure slider settings object
                    var sliderSettings = {};
                    var allData = $(this).data();
                    var infinite = typeof allData.infinite == 'undefined' ? false : allData.infinite;
                    var arrows = typeof allData.arrows == 'undefined' ? false : allData.arrows;
                    var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                    var focusOnSelect = typeof allData.focusonselect == 'undefined' ? false : allData.focusonselect;
                    var swipeToSlide = typeof allData.swipetoslide == 'undefined' ? false : allData.swipetoslide;
                    var slidesToShow = typeof allData.slidestoshow == 'undefined' ? 1 : allData.slidestoshow;
                    var slidesToScroll = typeof allData.slidestoscroll == 'undefined' ? 1 : allData.slidestoscroll;
                    var speed = typeof allData.speed == 'undefined' ? '500' : allData.speed;
                    var dots = typeof allData.dots == 'undefined' ? false : allData.dots;
                    var cssEase = typeof allData.cssease == 'undefined' ? 'linear' : allData.cssease;
                    var prevArrow = typeof allData.prevarrow == 'undefined' ? '' : allData.prevarrow;
                    var nextArrow = typeof allData.nextarrow == 'undefined' ? '' : allData.nextarrow;
                    var centerMode = typeof allData.centermode == 'undefined' ? false : allData.centermode;
                    var centerPadding = typeof allData.centerpadding == 'undefined' ? false : allData.centerpadding;
                    var rows = typeof allData.rows == 'undefined' ? 1 : parseInt(allData.rows);
                    var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                    var autoplaySpeed = typeof allData.autoplayspeed == 'undefined' ? 2000 : parseInt(allData.autoplayspeed);
                    var lazyLoad = typeof allData.lazyload == 'undefined' ? false : allData.lazyload; // have to remove it from settings object if it undefined
                    var appendDots = typeof allData.appenddots == 'undefined' ? false : allData.appenddots;
                    var appendArrows = typeof allData.appendarrows == 'undefined' ? false : allData.appendarrows;
                    var asNavFor = typeof allData.asnavfor == 'undefined' ? false : allData.asnavfor;
                    var verticalSwiping = typeof allData.verticalswiping == 'undefined' ? false : allData.verticalswiping;
                    var vertical = typeof allData.vertical == 'undefined' ? false : allData.vertical;
                    var fade = typeof allData.fade == 'undefined' ? false : allData.fade;
                    var rtl = typeof allData.rtl == 'undefined' ? false : allData.rtl;
                    var responsive = typeof $(this).data('responsive') == 'undefined' ? false : $(this).data('responsive');
                    //slider settings object setup
                    sliderSettings.infinite = infinite;
                    sliderSettings.arrows = arrows;
                    sliderSettings.autoplay = autoplay;
                    sliderSettings.focusOnSelect = focusOnSelect;
                    sliderSettings.swipeToSlide = swipeToSlide;
                    sliderSettings.slidesToShow = slidesToShow;
                    sliderSettings.slidesToScroll = slidesToScroll;
                    sliderSettings.speed = speed;
                    sliderSettings.dots = dots;
                    sliderSettings.cssEase = cssEase;
                    sliderSettings.prevArrow = prevArrow;
                    sliderSettings.nextArrow = nextArrow;
                    sliderSettings.rows = rows;
                    sliderSettings.autoplaySpeed = autoplaySpeed;
                    sliderSettings.autoplay = autoplay;
                    sliderSettings.verticalSwiping = verticalSwiping;
                    sliderSettings.vertical = vertical;
                    sliderSettings.rtl = rtl;
                    if (centerMode != false) {
                        sliderSettings.centerMode = centerMode;
                    }
                    if (centerPadding != false) {
                        sliderSettings.centerPadding = centerPadding;
                    }
                    if (lazyLoad != false) {
                        sliderSettings.lazyLoad = lazyLoad;
                    }
                    if (appendDots != false) {
                        sliderSettings.appendDots = appendDots;
                    }
                    if (appendArrows != false) {
                        sliderSettings.appendArrows = appendArrows;
                    }
                    if (asNavFor != false) {
                        sliderSettings.asNavFor = asNavFor;
                    }
                    if (fade != false) {
                        sliderSettings.fade = fade;
                    }
                    if (responsive != false) {
                        sliderSettings.responsive = responsive;
                    }
                    $(this).slick(sliderSettings);
                }
            });
        }


        var t = a("html").attr("dir"), e = void 0 !== t && "ltr" !== t;
        a(window).width() < 992 && (a(document).on("click", ".navbar-area .navbar-nav li.menu-item-has-mega-menu>a", function (a) {
            a.preventDefault()
        }), a(document).on("click", ".navbar-area .navbar-nav li.menu-item-has-children>a", function (a) {
            a.preventDefault()
        })), (new WOW).init(), a(".video-play-btn,.video-popup,.small-vide-play-btn,.video-play,.mfp-video-init,.videos-play").magnificPopup({type: "video"}), a(".image-popup").magnificPopup({
            type: "image",
            gallery: {enabled: !0}
        }), a(document).on("click", ".back-to-top", function () {
            a("html,body").animate({scrollTop: 0}, 2e3)
        });
        var n = a(".count-num");
        n.length > 1 && n.rCounter();
        var i = a(".case-studies-masonry");
        i.length > 0 && (a(".case-studies-masonry").imagesLoaded(function () {
            var t = i.isotope({itemSelector: ".masonry-item", masonry: {gutter: 0}});
            a(document).on("click", ".case-studies-menu li", function () {
                var e = a(this).attr("data-filter");
                t.isotope({filter: e})
            })
        }), a(document).on("click", ".case-studies-menu li", function () {
            a(this).siblings().removeClass("active"), a(this).addClass("active")
        }));
        var o = a(".global-carousel-init");
        o.length > 0 && a.each(o, function () {
            var t = a(this), n = t.children("div"), i = !!t.data("loop") && t.data("loop"),
                o = !!t.data("center") && t.data("center"), d = t.data("desktopitem") ? t.data("desktopitem") : 1,
                s = t.data("mobileitem") ? t.data("mobileitem") : 1,
                l = t.data("tabletitem") ? t.data("tabletitem") : 1, c = !!t.data("nav") && t.data("nav"),
                r = !!t.data("dots") && t.data("dots"), u = !!t.data("autoplay") && t.data("autoplay"),
                m = t.data("navcontainer") ? t.data("navcontainer") : "",
                v = t.data("stagepadding") ? t.data("stagepadding") : 0, p = t.data("margin") ? t.data("margin") : 0;
            n.length < 2 || t.owlCarousel({
                loop: i,
                autoplay: u,
                autoPlayTimeout: 5000,
                smartSpeed: 2000,
                margin: p,
                dots: r,
                center: o,
                nav: c,
                rtl: e,
                navContainer: m,
                stagePadding: v,
                navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
                responsive: {
                    0: {items: 1, nav: !1, stagePadding: 0},
                    460: {items: s, nav: !1, stagePadding: 0},
                    599: {items: s, nav: !1, stagePadding: 0},
                    768: {items: l, nav: !1, stagePadding: 0},
                    960: {items: l, nav: !1, stagePadding: 0},
                    1200: {items: d},
                    1920: {items: d}
                }
            })
        });
        $(document).on('click','.user-dashboard-wrapper > ul .mobile_nav',function(e){
            $(this).parent().toggleClass('show');
        });
        var d = a("#body-overlay"), s = a("#search-popup");
        a(document).on("click", "#body-overlay,.search-popup-close-btn", function (a) {
            a.preventDefault(), d.removeClass("active"), s.removeClass("show")
        }), a(document).on("click", "#search", function (a) {
            a.preventDefault(), s.addClass("show"), d.addClass("active")
        }),
        // }), a(document).on('click', '.home-21 .sidebars-close', function() {
        //     a(".header-variant-21 .bar-line").removeClass("active");
        //     a(".home-21.sidebars-wrappers").removeClass("active");
        // }),a(document).on('click', '.header-variant-21 .side-bars', function() {
        //     a(".home-21.sidebars-wrappers").toggleClass("active");
        //     a(".header-variant-21 .bar-line").toggleClass("active");
        // }),a(document).on('click', '.home-21 .click-content-show', function() {
        //     a(".home-21 .right-contents-show").toggleClass("show");
        // });
        a(".contents-wrapper").niceScroll({});

    }), a(window).on("scroll", function () {
        var t = a(".back-to-top");
        a(window).scrollTop() > 1e3 ? t.fadeIn(1e3) : t.fadeOut(1e3)
    }), a(window).on("load", function () {
        a("#preloader").fadeOut(1e3), a(".back-to-top").fadeOut();
    })
}(jQuery);