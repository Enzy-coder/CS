(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {

        var rtlEnabled = $('html').attr('dir');
        var rtlEnable = !(typeof rtlEnabled === 'undefined' || rtlEnabled === 'ltr');

        $(".lazy").Lazy({
            scrollDirection: 'vertical',
            effect: "fadeIn",
            effectTime: 1000,
            threshold: 0,
            visibleOnly: false,
            onError: function (element) {
                console.log('error loading ' + element.data('src'));
            }
        });

        /*--------------------------------
           All category menu control
        --------------------------------*/
        if ($(window).width() < 992) {
            $(".mobile-style").removeClass("show");
        }

        if ($(window).width() < 768) {
            $(".index-03-catg").removeClass("show");
        }

        /*--------------------------------
            Cart Quantity Control
        --------------------------------*/
        $(document).on('click', '.decrease', function (event) {
            event.preventDefault();
            let el = $(this);
            let parentWrap = el.parent();
            let qty = parentWrap.find('.qty_');
            let qtyVal = qty.val();
            if (qtyVal > 1) {
                qty.val(parseInt(qtyVal) - 1);
            }
        });

        $(document).on('click', '.increase', function (event) {
            event.preventDefault();
            let el = $(this);
            let parentWrap = el.parent();
            let qty = parentWrap.find('.qty_');
            let qtyVal = qty.val();
            if (qtyVal > 0) {
                qty.val(parseInt(qtyVal) + 1);
            }
        });

        /*------  fancybox ---*/
        /*--------------------------------*/
        $('[data-fancybox]').fancybox({
            toolbar: false,
            smallBtn: true,
            animationEffect: "zoom-in-out",
        });
        /*------------------------------
            Header Slick Slider
        -------------------------------*/
        $('.header-slider-inst-index-01')
            .on('init', function (slick) {
                console.log('init')
                $('.header-slider-inst-index-01').css("overflow", "visible");
            })
            .slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                lazyLoad: 'ondemand',
                speed: 1000,
                fade: true,
                dots: true,
                arrows: false,
                autoplay: true,
                rtl: rtlEnable,
                cssEase: 'linear',
                prevArrow: '<div class="prev-arrow"><i class="las la-angle-left"></i></div>',
                nextArrow: '<div class="next-arrow"> <i class="las la-angle-right"></i></div>',
            });

        /*------------------------------
            Category slider
        -------------------------------*/
        $('.category-slider-inst').slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            dots: false,
            rtl: rtlEnable,
            prevArrow: '<div class="prev-arrow"> <i class="las la-chevron-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-chevron-right"></i> </div>',
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }
            ]
        });

        /*------------------------------
            Deal of the week index-02
        -------------------------------*/
        $('.deal-of-the-week-slider-inst-index-02').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            speed: 800,
            rtl: rtlEnable,
            arrows: true,
            autoplay: true,
            dots: false,
            prevArrow: '<div class="prev-arrow"> <i class="las la-chevron-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-chevron-right"></i> </div>',
            responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 451,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }

            ]
        });

        /*------------------------------
            custom product slider
        -------------------------------*/
        $('.custom-product-slider-inst').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            speed: 800,
            arrows: true,
            autoplay: false,
            rtl: rtlEnable,
            dots: false,
            prevArrow: '<div class="prev-arrow"> <i class="las la-chevron-left"></i> </div>',
            nextArrow: '<div class="next-arrow"> <i class="las la-chevron-right"></i> </div>',
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }

            ]
        });

        /*------------------------------
            brand item slider
        -------------------------------*/
        $('.brand-item-slider-inst').slick({
            infinite: true,
            slidesToShow: 7,
            slidesToScroll: 1,
            speed: 800,
            arrows: false,
            autoplay: false,
            dots: false,
            rtl: rtlEnable,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 450,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            }

            ]
        });

        /*------------------------------
            Shop Details Slick Slider
        -------------------------------*/
        $('.shop-details-gallery-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            rtl: rtlEnable,
            asNavFor: '.shop-details-gallery-nav'
        });

        $('.shop-details-gallery-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.shop-details-gallery-slider',
            dots: false,
            rtl: rtlEnable,
            arrows: false,
            focusOnSelect: true,
        });

        /*------------------------------
            payment gateway selection
        -------------------------------*/
        $(".payment-gateway-list li").on('click', function () {
            $(".payment-gateway-list li").removeClass("selected");
            $(this).addClass("selected");
        });

        /*------------------------------
            Countdown
        -------------------------------*/
        loopcounter('flash-countdown-1');
        loopcounter('flash-countdown-3');
        loopcounter('flash-countdown-camp');
        loopcounter('flash-countdown-product');

        /*------------------------------
            Header Slider index-04
        -------------------------------*/

        $('.testimonial-slider-inst').slick({
            dots: false,
            infinite: true,
            speed: 500,
            arrows: false,
            autoplay: true,
            cssEase: 'linear',
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '0px',
            rtl: rtlEnable,
            responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
            ]
        });

        // JS for rtl

        var sliderRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var OwlRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var slickRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');

        /*------------------------------------
            search popup
        -----------------------------------*/
        $(document).on('click', '#search_icon', function (e) {
            e.preventDefault();
            $('#search_popup').addClass('show');
        });
        $(document).on('click', '#search-popup-close-btn', function (e) {
            e.preventDefault();
            $('#search_popup').removeClass('show');
        });

        /*------------------------------------
        user account
        -----------------------------------*/
        $(".navigation-button-x").on('click', function () {
            $(".user-account-widget").slideToggle("1000");
        });
        if ($(window).width() < 768) {
            $(".user-account-widget").hide();
        }

        /*------------------------------
       Product Filter One Button
       ------------------------------*/
        $(document).on("click", ".product_filter_style_one_btn_list li", function () {
            $(".product_filter_style_one_btn_list li").removeClass("active");
            $(this).addClass("active");
        });


    });



    /*------------------------------
           Scroll to top
    -------------------------------*/
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 800) {
            $(".scroll-to-top").fadeIn();
        } else {
            $(".scroll-to-top").fadeOut();
        }
    })

    /*------------------------------
           Resize 
    -------------------------------*/
    $(window).on('resize', function () {
        if ($(window).width() < 992) {
            $(".mobile-style").removeClass("show");
        }

        if ($(window).width() < 768) {
            $(".index-03-catg").removeClass("show");
        }
    })


}(jQuery));


/*------------------------------
       Shop View Details
-------------------------------*/

var sandwiches = document.querySelectorAll('.zoom-js-handle');

sandwiches.forEach(function (sandwich, index) {
    sandwich.addEventListener('mousemove', function (e) {
        zoomin(e)
    })
    sandwich.addEventListener('mouseleave', function (e) {
        var zoomer = e.currentTarget;
        zoomer.style.backgroundImage = '';
    })
});

function zoomin(e) {
    var zoomer = e.currentTarget;
    zoomer.style.backgroundImage = 'url(' + zoomer.getAttribute('data-src') + ')';
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
    x = offsetX / zoomer.offsetWidth * 100
    y = offsetY / zoomer.offsetHeight * 100
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}