(function ($) {
    "use strict";
    String.prototype.capitalize = String.prototype.capitalize || function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    }

    $(document).ready(function () {

        /*
        ========================================
            Notification icon js
        ========================================
        */
        $(document).on('mouseup', function (e) {
            if ($(e.target).closest('.notifications-parent').find('.notification-list-wrapper').length === 0) {
                $('.notification-list-wrapper').removeClass('active');
            }
        });
        $(document).on('click', '#top-bar-notification-icon', function () {
            $('.notification-list-wrapper').toggleClass('active');
        });

        /*
        ========================================================
            Sidebar search menu item js
        ========================================================
        */
        $(document).on('keyup', '#search_sidebarList', function () {
            let searchValues = $(this).val().toLowerCase();
            let allList = $('.dashboard-list li');
            let activeValue = [];
            allList.find("> a").removeAttr("style");

            if ($(this).val().length > 0) {
                $.each(allList, function (index, value) {
                    let currentEl = $(this);
                    let textValue = currentEl.text();
                    let searchValue = searchValues.toLowerCase().trim(); currentEl.show();
                    let foundText = textValue.toLowerCase().includes(searchValue);
                    currentEl.find("> a").attr("style", "font-weight: bold");

                    if (!foundText) {
                        currentEl.find("> a").removeAttr("style");
                        currentEl.hide();
                    }
                    else {
                        if (currentEl.find('.collapse').length > 0) {
                            activeValue.push({ value: searchValue, el: currentEl })
                        }
                    }
                });
                $('.dashboard-list li').each(function () {
                    if ($(this).hasClass("main_dropdown")) {
                        $(this).removeClass("active open");
                    }
                });
                activeValue.forEach(function (value, index) {
                    value.el.find(".collapse li").each(function () {
                        let item = $(this).text(); let foundText = item.toLowerCase().includes(value.value);
                        if (foundText) {
                            $(this).show(); $(this).closest('.collapse').parent().addClass("active open");
                        } else {
                            $(this).hide();
                        }
                    });
                });
            } else {
                $('.dashboard-list li').each(function () {
                    if ($(this).hasClass("main_dropdown")) {
                        $(this).removeClass("active open");
                    }
                    $(this).show();
                });
                $('.dashboard-list li.active').addClass("active open");
            }
        });

        /*
        ========================================
            Category Nav list class add remove js
        ========================================
        */
        $(document).on('click', '.categoryNav__list li.menu-item-has-children', function () {
            $(this).toggleClass('show').siblings().removeClass('show');
        })

        /*
        ========================================
            Click add Value text
        ========================================
        */

        $(document).on('click', '.status-dropdown .single-item', function (event) {
            let el = $(this);
            let value = el.data('value');
            let parentWrap = el.parent().parent();
            parentWrap.find('.add-dropdown-text').text(value);
            parentWrap.find('.add-dropdown-text').attr('value', value);
            return false;
        });

        /*
        ========================================
            Row Check All Add on Click
        ========================================
        */

        if ($('.check-all-row').length) {
            $(document).on("click", ".check-all-row", function () {
                if ($(".check-all-row").is(':checked')) {
                    $('.row-check').prop('checked', true);
                } else {
                    $('.row-check').prop('checked', false);
                }
            });
        }

        /*
        ========================================
            Row Remove Click Delete
        ========================================
        */

        $(document).on("click", ".delete-row", function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    send_ajax_request("GET", null, $(this).data("vendor-url"), () => {
                        // before send request
                        toastr.warning("Request send please wait while");
                    }, (data) => {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );

                        $(this).parent().parent().parent().remove();
                    }, (data) => {
                        prepare_errors(data);
                    })
                }
            });
        });

        /*
        ========================================
            Row Remove Click Delete
        ========================================
        */

        $(document).on("click", ".add-money-close", function (e) {
            e.preventDefault();
            $(".add-money").removeClass("add-wallet");
        })
        $(document).on("click", ".add-money .icon", function (e) {
            e.preventDefault();
            $(".add-money").toggleClass("add-wallet");
        })

        /*
        ========================================
            wow js init
        ========================================
        */

        new WOW().init();

        /*
        ========================================
            Global Slider Init
        ========================================
        */
        var globalSlickInit = $('.global-slick-init');
        if (globalSlickInit.length > 0) {
            //todo have to check slider item 
            $.each(globalSlickInit, function (index, value) {
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
                    let className = "append_arrows_" + Math.round(Math.random() * 9999999999);
                    $(this).closest('.container').find(appendArrows).addClass(className)
                    className = '.' + className;

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
                        sliderSettings.appendArrows = $(className);
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

        /* 
        ========================================
            CountDown Timer
        ========================================
        */

        $('.global-timer').syotimer({
            year: 2022,
            month: 4,
            day: 20,
            hour: 10,
            minute: 20,
        });



        /*
        ========================================
            Faq Accordion
        ========================================
        */

        $(document).on('click', '.faq-contents .faq-title', function (e) {
            let element = $(this).parent('.faq-item');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('.faq-panel').removeClass('open');
                element.find('.faq-panel').slideUp(300, "swing");
            } else {
                element.addClass('open');
                element.children('.faq-panel').slideDown(300, "swing");
                element.siblings('.faq-item').children('.faq-panel').slideUp(300, "swing");
                element.siblings('.faq-item').removeClass('open');
                element.siblings('.faq-item').find('.faq-title').removeClass('open');
                element.siblings('.faq-item').find('.faq-panel').slideUp(300, "swing");
            }
        });
        /* 
        ========================================
            Side Shop Menu
        ========================================
        */

        $(document).on('click', '.shop-lists .menu-item-has-children a', function (e) {
            var sh = $(this).parent('.menu-item-has-children');
            if (sh.hasClass('open')) {
                sh.removeClass('open');
                sh.find('.submenu').children('.menu-item-has-children').removeClass("open"); //2nd children remove 
                sh.find('.submenu').removeClass('open');
                sh.find('.submenu').slideUp(300, "swing");
            } else {
                sh.addClass('open');
                sh.children('.submenu').slideDown(300, "swing");
                sh.siblings('.menu-item-has-children').children('.submenu').slideUp(300, "swing");
                sh.siblings('.menu-item-has-children').removeClass('open');
                sh.siblings().find('.submenu').children('.menu-item-has-children').removeClass('open'); //2nd Submenu children remove 
                sh.siblings().find('.submenu').slideUp(300, "swing"); //2nd Submenu children Slide Up Down 
            }
        });

        /* 
        ========================================
            Side Open Close Shop Top
        ========================================
        */

        $(document).on('click', '.shop-left-title .title', function (e) {
            var st = $(this).parent('.shop-left-title');
            if (st.hasClass('open')) {
                st.removeClass('open');
                st.find('.shop-left-list').removeClass('open');
                st.find('.shop-left-list').slideUp(300, "swing");
            } else {
                st.addClass('open');
                st.children('.shop-left-list').slideDown(300, "swing");
                st.siblings('.shop-left-title').children('.shop-left-list').slideUp(300, "swing");
                st.siblings('.shop-left-title').removeClass('open');
            }
        });

        /* 
        ========================================
            Dashboard Dropdown Side Menu
        ========================================
        */

        $(document).on('click', '.dashboard-list .has-children a , .dashboard-list .main_dropdown a, .single-product-add .product-left-info .title', function (e) {
            var db = $(this).parent('.has-children');
            if (db.hasClass('open')) {
                db.removeClass('open');
                db.find('.submenu').children('.has-children').removeClass("open"); //2nd children remove 
                db.find('.submenu').removeClass('open');
                db.find('.submenu').slideUp(300, "swing");
            } else {
                db.addClass('open');
                db.children('.submenu').slideDown(300, "swing");
                db.siblings('.has-children').children('.submenu').slideUp(300, "swing");
                db.siblings('.has-children').removeClass('open');
            }
        });

        $(document).on("click", ".dashboard-list .main_dropdown a", function (e) {
            var db = $(this).parent('.main_dropdown');
            if (db.hasClass('open')) {
                db.removeClass('open');
                db.find('.collapse').children('.main_dropdown').removeClass("open"); //2nd children remove
                db.find('.collapse').removeClass('open');
                db.find('.collapse').slideUp(300, "swing");
            } else {
                db.addClass('open');
                db.children('.collapse').slideDown(300, "swing");
                db.siblings('.main_dropdown').children('.collapse').slideUp(300, "swing");
                db.siblings('.main_dropdown').removeClass('open');
            }
        });

        /* 
        ========================================
            Dashboard Responsive Sidebar
        ========================================
        */

        $(document).on('click', '.close-bars, .body-overlay', function () {
            $('.dashboard-close, .dashboard-left-content, .body-overlay').removeClass('active');
        });
        $(document).on('click', '.sidebar-icon', function () {
            $('.dashboard-close, .dashboard-left-content, .body-overlay').addClass('active');
        });

        /* 
        ========================================
            Navbar Toggler
        ========================================
        */
        $(document).on('click', '.navbar-toggler', function () {
            $(".navbar-toggler").toggleClass("active");
        });

        $(document).on('click', '.show-nav-right-contents', function () {
            $(".navbar-right-content").toggleClass("show");
        });

        /* 
        ========================================
            Category Toggle Class
        ========================================
        */

        $(document).on('click', '.top-menu-toggle', function () {
            $(".navbar-area-side").toggleClass("active");
        });

        /*--------------------------------
           Testimonial slider js
        --------------------------------*/
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

        /* 
        ========================================
            Tab
        ========================================
        */

        $(document).on('click', 'ul.tabs li', function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('active');
            $('.tab-content-item').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });

        /* 
        ========================================
            Pagination 
        ========================================
        */

        $(document).on('click', '.pagination-list li', function () {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        });

        /* 
        ========================================
            Lazy Load Js
        ========================================
        */
        $('.lazyloads').Lazy();

        /* 
        ========================================
            Tags Input
        ========================================
        */
        $('.tags_input').tagsinput({
            allowDuplicates: true,
        });

        /* 
        ========================================
            Flat picker
        ========================================
        */
        $(".flat_picker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        /* 
        ========================================
            SearchBar
        ========================================
        */
        $(document).on('click', '.search-close', function () {
            $('.search-bar').removeClass('active');
        });
        $(document).on('click', '.search-open', function () {
            $('.search-bar').toggleClass('active');
        });

        /* 
        ========================================
            Isotope
        ========================================
        */
        $('.imageloaded').imagesLoaded(function () {
            var $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                percentPosition: true,
                masonry: {
                    columnWidth: '.grid-item',
                }
            });
            $('.isootope-button').on('click', '.list', function () {
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({ filter: filterValue });
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            });
        });

        /* 
        ========================================
            Product Quantity js
        ========================================
        */
        $(document).on('click', '.plus', function () {
            var selectedInput = $(this).prev('.quantity-input');
            selectedInput[0] !== undefined ? selectedInput[0].stepUp(1) : null;
        });
        $(document).on('click', '.substract', function () {
            var selectedInput = $(this).next('.quantity-input');
            if (selectedInput.val() > 1) {
                selectedInput[0] !== undefined ? selectedInput[0].stepDown(1) : null;
            }
        });

        // /*
        // ========================================
        //     Click Value Add
        // ========================================
        // */
        // $(document).on('click', '.size-lists li', function(event) {
        //     var el = $(this);
        //     var value = el.data('value');
        //     var parentWrap = el.parent().parent();
        //     el.addClass('active');
        //     el.siblings().removeClass('active');
        //     parentWrap.find('.value-size').val(value);
        //
        // });

        /* 
        ========================================
            Click Clear Attribute
        ========================================
        */
        $(document).on('click', '.delete-item', function () {
            $(this).parent().parent().parent().hide(100);
        });

        /* 
        ========================================
            Click Add Attribute Item
        ========================================
        */
        $(document).on('click', '.add-new-attr', function () {
            let add = $(this).prev().find('.dashboard-attr-inner:last-child').clone();
            add.find('.bootstrap-tagsinput').remove()
            $(".dashboard-attr-add-wrapper").append(add);
            $('.tags_input').tagsinput({
                allowDuplicates: true,
            });
        });

        /* 
        ========================================
            Click Clear Contents
        ========================================
        */

        /* 
        ========================================
            top-menu-category Click
        ========================================
        */

        $(document).on('click', '.navbar-area-side .cate-list', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        /* 
        ========================================
            Shop Responsive Sidebar
        ========================================
        */
        $(document).on('click', '.close-bars, .body-overlay', function () {
            $('.shop-close, .shop-close-main, .body-overlay').removeClass('active');
        });
        $(document).on('click', '.sidebar-icon', function () {
            $('.shop-close, .shop-close-main, .body-overlay').addClass('active');
        });

        /* 
        ========================================
            Discount Popup Click
        ========================================
        */

        $(document).on('click', '.discount-overlays, .close-icon', function () {
            $('.discount-overlays, .discount-popup-area').hide();
        });

        $('.discount-popup-area').hide();
        setTimeout(function () {
            $('.discount-popup-area').show();
        }, 3000);

        /* 
        ========================================
            Cart Click Loading
        ========================================
        */

        $(document).on('click', '.cart-loading', function () {
            $(this).addClass('active-loading')
            setTimeout(function () {
                $('.cart-loading').removeClass('active-loading');
            }, 1500);
        });

        /* 
        ========================================
            Cart Click Close
        ========================================
        */

        $(document).on('click', '.close-table-cart', function () {
            $(this).parent().parent().hide(100);
        });

        $(document).on('click', '.btn-clear', function () {
            $('.table-cart-clear').hide(500);
        });
        $(document).on('click', '.btn-update', function () {
            $('.table-cart-clear').show(1000);
            $('.close-table-cart').parent().parent().show(500);
        });

        /* 
        ========================================
            Remove Compare Click Close
        ========================================
        */

        $(document).on('click', '.btn-remove', function () {
            $(this).parent().parent().parent().parent().hide(200);
        });

        /* 
        ========================================
            Profile Upload thumb Close
        ========================================
        */

        $(document).on('click', '.close-thumb', function () {
            let el = $(this);
            let inputValue = el.parent().parent().parent().parent().find('input[type="hidden"]').val();
            console.log(inputValue)
            // make an array
            if (inputValue.includes("|")) {
                let inputArray = inputValue.split("|");
                let val = el.attr("data-media-id");

                let finalValue = removeArray(inputArray, val).join("|");
                el.parent().parent().parent().parent().find('input[type="hidden"]').val(finalValue)
                $(this).parent().hide(200);
                return true;
            }
            el.parent().parent().parent().parent().find('input[type="hidden"]').val('')
            $(this).parent().hide(200);
        });

        /* 
        ========================================
            Payment Card Delivery 
        ========================================
        */

        $(document).on('click', '.payment-card .single-card', function () {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        });
        /* 
        ========================================
            Click Open SignIn SignUp
        ========================================
        */

        $(document).on('click', '.click-open-form', function () {
            $('.checkout-form-open').toggleClass('active');
        });

        $(document).on('click', '.click-open-form2', function () {
            $(this).toggleClass('active');
            $('.checkout-signup-form-wrapper').toggleClass('active');
        });

        $(document).on('click', '.click-open-form3', function () {
            $(this).toggleClass('active');
            $('.checkout-address-form-wrapper').toggleClass('active');
        });

        /* 
        ========================================
            Popup Modal Cart
        ========================================
        */

        $(document).on('click', '.popup-modal', function () {
            $('.shop-detail-cart-content, .body-overlay-desktop').addClass('active');
        });

        /* 
        ========================================
            Payment check
        ========================================
        */
        $(document).on('click', '.payment-list .payments', function () {
            $(this).siblings().removeClass('selected');
            $(this).addClass('selected');
        });

        /* 
        ========================================
            Password Show Hide On Click
        ========================================
        */

        $(document).on("click", ".toggle-password", function (e) {
            e.preventDefault();
            $(this).toggleClass("show-pass");
            let input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        /*
        ========================================
            media upload btn click
        ========================================
        */

        $(document).on("click", ".media_upload_form_btn", function () {
            // now let's find modal
            let prevModal = $(this).closest(".modal");

            if (prevModal.length > 0) {
                $(document).on("click", ".media_upload_modal_submit_btn , .modal-wrapper .close-select-button", function () {
                    $(".media_upload_modal_submit_btn").closest('.modal-wrapper').hide();
                    prevModal.modal("show");
                })
            }
        });

        /* 
        ========================================
            Range Slider
        ========================================
        */

        var i = document.querySelector(".ui-range-slider");
        if (void 0 !== i && null !== i) {
            var j = parseInt(i.parentNode.getAttribute("data-start-min"), 10),
                k = parseInt(i.parentNode.getAttribute("data-start-max"), 10),
                l = parseInt(i.parentNode.getAttribute("data-min"), 10),
                m = parseInt(i.parentNode.getAttribute("data-max"), 10),
                n = parseInt(i.parentNode.getAttribute("data-step"), 10),
                o = document.querySelector(".ui-range-value-min span"),
                p = document.querySelector(".ui-range-value-max span"),
                q = document.querySelector(".ui-range-value-min input"),
                r = document.querySelector(".ui-range-value-max input");
            noUiSlider.create(i, {
                start: [j, k],
                connect: !0,
                step: n,
                range: {
                    min: l,
                    max: m
                }
            }), i.noUiSlider.on("change", function (a, b) {
                var c = a[b];

                $("#min_price").val(a[0]);
                $("#max_price").val(a[1]);

                b ? (p.innerHTML = Math.round(c), r.value = Math.round(c)) : (o.innerHTML = Math.round(c), q.value = Math.round(c))

                $("#search_product").trigger("submit");
            })
        }

        /* 
        ========================================
            back to top
        ========================================
        */

        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 700);
        });
    });



    /* 
    ========================================
        back to top
    ========================================
    */

    $(window).on('scroll', function () {
        //back to top show/hide
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 200) {
            ScrollTop.fadeIn(10);
        } else {
            ScrollTop.fadeOut(10);
        }
    });

    /* 
    ========================================
        Row Check All Add on Click
    ========================================
    */

    $(window).on('resize', function () {
        if ($(window).width() < 991) {
            rowCheckAll();
        }
    });

    function rowCheckAll() {
        $(document).on("click", ".responsive-check-all-row", function () {
            $(".row-check:checkbox").prop('checked', $(this).prop("checked"));
        });
    }
})(jQuery);

function greetings() {
    let current_time = new Date();
    let get_hours = current_time.getHours();
    let string_return = "";

    switch (true) {
        case get_hours >= 5 && get_hours < 12:
            string_return = "Good Morning";
            break;
        case get_hours >= 12 && get_hours < 17:
            string_return = "Good Afternoon";
            break;
        case get_hours >= 17 && get_hours <= 24 || (get_hours < 5):
            string_return = "Good Evening";
            break;
        default:
            return null;
    }

    return string_return;
}

function removeArray(arr, value) {
    let i = 0;
    while (i < arr.length) {
        if (arr[i] === value) {
            arr.splice(i, 1);
        } else {
            ++i;
        }
    }
    return arr;
}

$(document).ready(function () {
    let dates = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    let full_date = dates.toLocaleDateString('en-US', options);
    let hour = dates.getHours();
    let full_time = (hour > 12 ? hour - 12 : hour) + ":" + dates.getMinutes() + ":" + dates.getSeconds() + (hour > 12 ? " PM" : " AM");

    $(".dashboard-left-flex .heading-two").text(greetings());
    $(".dashboard-left-flex .date-text").text(full_date + " " + full_time);

    setInterval(function () {
        let dates = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        let full_date = dates.toLocaleDateString('en-US', options);
        let hour = dates.getHours();
        let full_time = (hour > 12 ? hour - 12 : hour) + ":" + dates.getMinutes() + ":" + dates.getSeconds() + (hour > 12 ? " PM" : " AM");
        $(".dashboard-left-flex .date-text").text(full_date + " " + full_time);
    }, 1000);
})

