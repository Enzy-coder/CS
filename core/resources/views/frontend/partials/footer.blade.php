        @php
            $page_details = $page_details ?? ($page_post ?? '');
            $navbar_type = $page_details->navbar_variant ?? (get_static_option('global_navbar_variant') ?? 1);
        @endphp

        <!-- footer area start -->
        <footer data-footer-variant="{{ $navbar_type }}" @class([
            'footer-area',
            'white-color footer-four homeFour-bg' => $navbar_type == 2 || $navbar_type == 3,
            'footer-bg footer-color-two margin-top-50' => $navbar_type == 1,
        ])>
            <div @class([
                'container' => $navbar_type == 3,
                'container-one' => $navbar_type == 1,
                'container container_1608' => $navbar_type == 2,
            ])>
                <div @class([
                    'footer-middle padding-top-80 padding-bottom-80' => $navbar_type == 3,
                    'footer-top-contents footer-top-border padding-top-55 padding-bottom-80' =>
                        $navbar_type == 2 || $navbar_type == 1,
                ])>
                    <div class="row g-4">
                        {!! render_frontend_sidebar('footer', ['column' => true]) !!}
                    </div>
                </div>
                <div class="copyright-area copyright-border">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="copyright-contents">
                                <span> {!! render_footer_copyright_text() !!} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer area end -->

        {{-- new product modal - start --}}
        <div class="modal product-quick-view-bg-color" id="product_quick_view" tabindex="-1" role="dialog"
            aria-labelledby="productModal" aria-hidden="true">

        </div>

        <div class="scroll-to-top d-none">
            <i class="las la-angle-up"></i>
        </div>

        @if (preg_match('/(xgenious)/', url('/')))
            <script type="text/javascript">
                adroll_adv_id = "GXM5SRU2XZE7JOKGHSZPSZ";
                adroll_pix_id = "WP43YTLBS5BQXDP6XUEIC7";
                adroll_version = "2.0";
                (function(w, d, e, o, a) {
                    w.__adroll_loaded = true;
                    w.adroll = w.adroll || [];
                    w.adroll.f = ['setProperties', 'identify', 'track'];
                    var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id + "/roundtrip.js";
                    for (a = 0; a < w.adroll.f.length; a++) {
                        w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
                            return function() {
                                w.adroll.push([n, arguments])
                            }
                        })(w.adroll.f[a])
                    }
                    e = d.createElement('script');
                    o = d.getElementsByTagName('script')[0];
                    e.async = 1;
                    e.src = roundtripUrl;
                    o.parentNode.insertBefore(e, o);
                })(window, document);
                adroll.track("pageView");
            </script>
            <div class="buy-now-wrap">
                <ul class="buy-list">
                    <li><a target="_blank" href="https://xgenious.com/docs/grenmart-organic-grocery-laravel-ecommerce/"
                            data-container="body" data-bs-toggle="popover" data-placement="left"
                            data-content="{{ __('Documentation') }}"><i class="lar la-file-alt"></i></a></li>
                    <li><a target="_blank" href="https://1.envato.market/kj2GdL"><i class="las la-shopping-cart"></i></a></li>
                    <li><a target="_blank" href="https://xgenious51.freshdesk.com/"><i class="las la-headset"></i></a></li>
                </ul>
            </div>
        @endif
        <!-- jquery -->
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <!-- jquery Migrate -->
        <script src="{{ asset('assets/js/jquery-migrate.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('assets/js/bootstrap5.bundle.min.js') }}"></script>
        <!-- Lazy Load Js -->
        <script src="{{ asset('assets/js/jquery.lazy.min.js') }}"></script>
        <!-- Slick Slider -->
        <script src="{{ asset('assets/js/slick.js') }}"></script>
        <!-- All Plugins js -->
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <!-- Range Slider -->
        <script src="{{ asset('assets/js/nouislider-8.5.1.min.js') }}"></script>
        <!-- All Plugins two js -->
        <script src="{{ asset('assets/js/plugin-two.js') }}"></script>
        <!-- Nice Scroll -->
        <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/loopcounter.js') }}"></script>
        <!-- main js -->
        <script src="{{ asset('assets/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/helpers.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>


        @include('frontend.partials.google-captcha')
        @include('frontend.partials.gdpr-cookie')
        @include('frontend.partials.inline-script')
        @include('frontend.partials.twakto')

        <script src="{{ asset('assets/common/js/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('assets/frontend/js/md5.js') }}"></script>

        <x-sweet-alert-msg />

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function (){
                // make hide all logo available
                $(".footer-logo-wrapper").addClass('d-none');
                // first need to get footer
                let footer = $('.footer-area');
                // now get footer variant
                let variant = footer.attr('data-footer-variant');
                // check variant and enable logo
                if(variant == 3 || variant == 2){
                    $('.logo-style-two').removeClass("d-none");
                }else{
                    $('.logo-style-one').removeClass("d-none");
                }
            });
        </script>

        @yield('scripts')
        @yield('script')

        <script>
            $(document).ready(function() {
                /*
                ========================================
                    Countdown js
                ========================================
                */
                // check this class is exist or not if exist then run this code
                if ($('.flashCountdown').length > 0) {
                    loopcounter('flashCountdown');
                }
            });

            $(document).on('submit', '.subscribe-form form', function (e) {
                e.preventDefault();

                const email = $(this).find('input[type="email"]');
                const errrContaner = $(this).parent().parent().parent().find('.form-message-show');
                const paperIcon = 'la-paper-plane';
                const spinnerIcon = 'la-spinner la-spin';
                const el = $(this);

                $(this).find("button").attr('disabled', true);

                errrContaner.html('');

                el.find('i').removeClass(paperIcon).removeClass('lar').addClass(spinnerIcon).addClass('las');

                $.ajax({
                    url: "{{ route('frontend.subscribe.newsletter') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email.val()
                    },
                    success: function (data) {
                        email.val('')
                        errrContaner.html('<div class="alert alert-' + data.type + '">' + data.msg + '</div>');
                        el.find('i').addClass(paperIcon).addClass('lar').removeClass(spinnerIcon).removeClass('las');
                        $(this).find("button").removeAttr('disabled');
                    },
                    error: function (data) {
                        email.val('')
                        el.find('i').addClass(paperIcon).addClass('lar').removeClass(spinnerIcon).removeClass('las');
                        const errors = data.responseJSON.errors;
                        errrContaner.html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                        $(this).find("button").removeAttr('disabled');
                    }
                });
            });

            $(document).on('submit', '.custom-form-builder-form', function (e) {
                e.preventDefault();
                const btn = $(this).find('button[type="submit"]');
                let btnOldText = btn.text();
                const form = $(this);
                const formID = form.attr('id');
                const msgContainer = form.find('.error-message');
                const formSelector = document.getElementById(formID);
                const formData = new FormData(formSelector);
                msgContainer.html('');

                $.ajax({
                    url: "{{ route("frontend.form.builder.custom.submit") }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    beforeSend:function (){
                        btn.html(`<i class="las la-spinner la-spin mr-1"></i> {{__('Submitting..')}}`);
                    },
                    processData: false,
                    contentType: false,
                    data:formData,
                    success: function (data) {
                        form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        msgContainer.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                        btn.text(btnOldText);
                        form.trigger("reset");

                    },
                    error: function (data) {
                        form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        var errors = data.responseJSON.errors;
                        var markup = '<ul class="alert alert-danger">';
                        $.each(errors,function (index,value){
                            markup += '<li>'+value+'</li>';
                        })
                        markup += '</ul>';
                        msgContainer.html(markup);
                        btn.text(btnOldText);
                        form.trigger("reset");
                    }
                });
            });

            /**
             * Cart script
             * */

            $(document).on('click', '.ff-jost[data-label=Close]', function(e) {
                let el = $(this);
                let product_hash_id = el.data('product_hash_id');

                let data = new FormData();
                data.append("product_hash_id", product_hash_id);
                data.append("rowId", product_hash_id);
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request('POST', data, '{{ route('frontend.products.cart.ajax.remove') }}', () => {
                    if ($(this).data('type') === 'tr') {
                        $(this).closest("tr").addClass("disabled");
                    }

                    $(this).find('.icon-close i').removeClass("la-times").addClass("la-spinner");
                    $('.cart-item-count-amount').html("<i class='las la-spinner'></i>");
                }, (data) => {
                    if (data.msg) {
                        toastr.success(data.msg);
                        $('.coupon-contents').parent().load(location.href + " .coupon-contents");
                        $('.navbar-right-flex .cart-shopping').load(location.href + " .cart-shopping");

                        if ($(this).data('type') === 'tr') {
                            $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                        }
                    }

                    $('.loader').hide();
                    loadHeaderCardAndWishlistArea(data)
                }, (err) => {
                    if ($(this).data('type') === 'tr') {
                        $(this).closest("tr").removeClass("disabled");
                    }

                    $(this).find('.icon-close i').removeClass("la-spinner").addClass("la-times");
                    prepare_errors(err)
                })
            });

            $(document).on('click', '.vendor_search_tab', function() {
                let url = '{{ route('frontend.vendor-search') }}';
                let limit = 12;

                if ($(this).attr("data-tab-two") ?? false) {
                    url += "?type=" + $(this).attr('data-tab-two') + '&limit=' + limit;
                }

                loadFilterData(url, '#all_vendor_list');
            });

            $(document).on('click', '#product_filter_featured_products', function(e) {
                let url = '{{ route('frontend.products.filter.top.rated') }}';

                if ($(this).attr('data-card-style') == 2) {
                    url += "?card_style=2";
                }

                if ($(this).attr("data-item-limit")) {
                    if (url.indexOf("?")) {
                        url += "&limit=" + $(this).attr("data-item-limit");
                    } else {
                        url += "?limit=" + $(this).attr("data-item-limit");
                    }
                }

                loadFilterData(url);
            });

            $(document).on('click', '#product_filter_top_selling', function(e) {
                let url = '{{ route('frontend.products.filter.top.selling') }}';

                if ($(this).attr('data-card-style') == 2) {
                    url += "?card_style=2";
                }

                if ($(this).attr("data-item-limit")) {
                    if (url.indexOf("?")) {
                        url += "&limit=" + $(this).attr("data-item-limit");
                    } else {
                        url += "?limit=" + $(this).attr("data-item-limit");
                    }
                }

                loadFilterData(url);
            });

            $(document).on('click', '#product_filter_new_products', function(e) {
                let url = '{{ route('frontend.products.filter.new') }}';

                if ($(this).attr('data-card-style') == 2) {
                    url += "?card_style=2";
                }

                if ($(this).attr("data-item-limit")) {
                    if (url.indexOf("?")) {
                        url += "&limit=" + $(this).attr("data-item-limit");
                    } else {
                        url += "?limit=" + $(this).attr("data-item-limit");
                    }
                }

                loadFilterData(url);
            });

            function loadFilterData(url, selector = '#product_filter_section') {
                $('.lds-ellipsis').show();
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        if (data) {
                            $(selector).html(data);
                            $('.lds-ellipsis').hide();
                        }
                    },
                    erorr: function(err) {
                        toastr.error('{{ __('Something went wrong') }}');
                        $('.lds-ellipsis').hide();
                    }
                });
            }

            function amount_with_currency_symbol(amount) {
                let symbol = "{{ site_currency_symbol() }}";
                let position = "{{ get_static_option('site_currency_symbol_position') }}";

                let return_val = symbol + amount;

                if (position == 'right') {
                    return_val = amount + symbol;
                }

                return return_val;
            }

            /*
             *
             * todo:: Those line of code is only for without variant product
             *
             * */
            $(document).on('click', '.add_to_cart_ajax', function(e) {
                e.preventDefault();
                let pid_id = ''; //getQuickViewAttributesForCart();

                let currentEl = $(this)
                let product_id = $(this).data('id');
                let quantity = 1;
                let attributes = {};
                let product_variant = null;

                let icon = currentEl.find("i");
                let oldIconClass = icon.attr("class");

                const condition = (currentEl.attr('data-type') ?? false) === 'text';

                if (condition) {
                    currentEl.text('{{ __('Adding to cart') }}...').append(
                        `<i class='las la-spinner icon la-spin'></i>`);
                } else {
                    icon.attr("class", "las la-spinner icon la-spin");
                }

                attributes['price'] = null;

                $.ajax({
                    url: '{{ route('frontend.products.add.to.cart.ajax') }}',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        attributes: attributes,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if(data.type ?? false){
                            toastr[data.type](data.msg);
                        }else{
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        if (condition) {
                            currentEl.text(currentEl.attr('data-old-text'))
                        } else {
                            icon.attr("class", oldIconClass);
                        }

                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        if (condition) {
                            currentEl.text(currentEl.attr('data-old-text'))
                        } else {
                            icon.attr("class", oldIconClass);
                        }

                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            $(document).on('click', '.add_to_wishlist_ajax', function(e) {
                e.preventDefault();
                let pid_id = ''; //getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = 1;
                let attributes = {};
                let product_variant = null;

                attributes['price'] = null;

                $.ajax({
                    url: '{{ route('frontend.products.add.to.wishlist.ajax') }}',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        attributes: attributes,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if(data.type ?? false){
                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                                return;
                            }else{
                                toastr[data.type](data.msg);
                            }
                        }else{
                            toastr.success(data.msg);
                        }

                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            $(document).on('click', '.add_to_compare_ajax', function(e) {
                e.preventDefault();
                let pid_id = ''; //getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = 1;
                let attributes = {};
                let product_variant = null;

                attributes['price'] = null;

                $.ajax({
                    url: '{{ route('frontend.products.add.to.compare') }}',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        attributes: attributes,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if(data.type ?? false){
                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                                return;
                            }else{
                                toastr[data.type](data.msg);
                            }
                        }else{
                            toastr.success(data.msg);
                        }


                        loadHeaderCardAndWishlistArea(data);
                    },
                    erorr: function(err) {
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            /* end hare without variant product js code */
            $(document).on("click", ".product-quick-view-ajax", function(e) {
                e.preventDefault();

                let currentEl = $(this)
                let action_route = currentEl.data('action-route');
                let icon = currentEl.find("i");
                let oldIconClass = icon.attr("class");
                const condition = (currentEl.attr('data-type') ?? false) === 'text';

                if (condition) {
                    currentEl.text('Opening...').append(`<i class='las la-spinner icon la-spin'></i>`);
                } else {
                    icon.attr("class", "las la-spinner icon la-spin");
                }


                $.ajax({
                    url: action_route,
                    type: 'GET',
                    success: function(data) {
                        if (condition) {
                            currentEl.text(currentEl.attr('data-old-text'))
                        } else {
                            icon.attr("class", oldIconClass);
                        }

                        $("#product_quick_view").html(data);
                        $("#product_quick_view").modal("show");

                        // write slider code here

                        /*
                        ========================================
                            Global Slider Init
                        ========================================
                        */
                        let globalSlickInit = $('.global-slick-quick-view-init');
                        if (globalSlickInit.length > 0) {
                            //todo have to check slider item
                            $.each(globalSlickInit, function(index, value) {
                                if ($(this).children('div').length > 1) {
                                    //todo configure slider settings object
                                    let sliderSettings = {};
                                    let allData = $(this).data();
                                    let infinite = typeof allData.infinite == 'undefined' ? false :
                                        allData.infinite;
                                    let arrows = typeof allData.arrows == 'undefined' ? false :
                                        allData.arrows;
                                    let focusOnSelect = typeof allData.focusonselect ==
                                        'undefined' ? false : allData.focusonselect;
                                    let swipeToSlide = typeof allData.swipetoslide == 'undefined' ?
                                        false : allData.swipetoslide;
                                    let slidesToShow = typeof allData.slidestoshow == 'undefined' ?
                                        1 : allData.slidestoshow;
                                    let slidesToScroll = typeof allData.slidestoscroll ==
                                        'undefined' ? 1 : allData.slidestoscroll;
                                    let speed = typeof allData.speed == 'undefined' ? '500' :
                                        allData.speed;
                                    let dots = typeof allData.dots == 'undefined' ? false : allData
                                        .dots;
                                    let cssEase = typeof allData.cssease == 'undefined' ? 'linear' :
                                        allData.cssease;
                                    let prevArrow = typeof allData.prevarrow == 'undefined' ? '' :
                                        allData.prevarrow;
                                    let nextArrow = typeof allData.nextarrow == 'undefined' ? '' :
                                        allData.nextarrow;
                                    let centerMode = typeof allData.centermode == 'undefined' ?
                                        false : allData.centermode;
                                    let centerPadding = typeof allData.centerpadding ==
                                        'undefined' ? false : allData.centerpadding;
                                    let rows = typeof allData.rows == 'undefined' ? 1 : parseInt(
                                        allData.rows);
                                    let autoplay = typeof allData.autoplay == 'undefined' ? false :
                                        allData.autoplay;
                                    let autoplaySpeed = typeof allData.autoplayspeed ==
                                        'undefined' ? 2000 : parseInt(allData.autoplayspeed);
                                    let lazyLoad = typeof allData.lazyload == 'undefined' ? false :
                                        allData
                                        .lazyload; // have to remove it from settings object if it undefined
                                    let appendDots = typeof allData.appenddots == 'undefined' ?
                                        false : allData.appenddots;
                                    let appendArrows = typeof allData.appendarrows == 'undefined' ?
                                        false : allData.appendarrows;
                                    let asNavFor = typeof allData.asnavfor == 'undefined' ? false :
                                        allData.asnavfor;
                                    let verticalSwiping = typeof allData.verticalswiping ==
                                        'undefined' ? false : allData.verticalswiping;
                                    let vertical = typeof allData.vertical == 'undefined' ? false :
                                        allData.vertical;
                                    let fade = typeof allData.fade == 'undefined' ? false : allData
                                        .fade;
                                    let rtl = typeof allData.rtl == 'undefined' ? false : allData
                                        .rtl;
                                    let responsive = typeof $(this).data('responsive') ==
                                        'undefined' ? false : $(this).data('responsive');
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
                    },
                    erorr: function(err) {
                        if (condition) {
                            currentEl.text(currentEl.attr('data-old-text'))
                        } else {
                            icon.attr("class", oldIconClass);
                        }
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            // close quick view details model and make empty
            $(document).on("click", "#product_quick_view .quick-view-close-btn", function() {
                $("#product_quick_view").modal("hide");

                setTimeout(function() {
                    $("#product_quick_view").empty();
                }, 200);
            });

            $(document).on("click", "#quick_view .quick-view-close-btn", function() {
                $("#quick_view").fadeOut();
                $("#quick_view").removeClass('show');
                $(".modal-backdrop").fadeOut();
            });

            $(document).on('click', '.quick-view-size-lists li', function(event) {
                let el = $(this);
                let value = el.data('displayValue');
                let parentWrap = el.parent().parent();
                el.addClass('active');
                el.siblings().removeClass('active');
                parentWrap.find('input[type=text]').val(value);
                parentWrap.find('input[type=hidden]').val(el.data('value'));

                // selected attributes
                selectedAttributeSearch(this);
            });

            $(document).on('click', '.add_to_cart_single_page_quick_view', function(e) {
                e.preventDefault();
                let selected_size = $('#quick_view_selected_size').val();
                let selected_color = $('#quick_view_selected_color').val();
                let site_currency_symbol = "{{ site_currency_symbol() }}";

                $(".quick-view-size-lists.active")

                let pid_id = getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = Number($('#quick-view-quantity').val().trim());
                let price = $('#quick-view-price').text().split(site_currency_symbol)[1];
                let attributes = {};
                let product_variant = pid_id;

                attributes['price'] = price;

                // if selected attribute is a valid product item
                if (quickViewValidateSelectedAttributes()) {
                    $.ajax({
                        url: '{{ route('frontend.products.add.to.cart.ajax') }}',
                        type: 'POST',
                        data: {
                            product_id: product_id,
                            quantity: quantity,
                            pid_id: pid_id,
                            product_variant: product_variant,
                            selected_size: selected_size,
                            selected_color: selected_color,
                            attributes: attributes,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if(data.type ?? false){
                                toastr[data.type](data.msg);
                            }else{
                                toastr.success(data.msg);
                            }

                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                            }

                            loadHeaderCardAndWishlistArea(data);
                        },
                        erorr: function(err) {
                            toastr.error('{{ __('An error occurred') }}');
                        }
                    });
                } else {
                    toastr.error('{{ __('Select all attribute to proceed') }}');
                }
            });

            $(document).on('click', '.buy_now_single_page_quick_view', function(e) {
                e.preventDefault();
                let selected_size = $('#quick_view_selected_size').val();
                let selected_color = $('#quick_view_selected_color').val();
                let site_currency_symbol = "{{ site_currency_symbol() }}";

                $(".quick-view-size-lists.active")

                let pid_id = getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = Number($('#quick-view-quantity').val().trim());
                let price = $('#quick-view-price').text().split(site_currency_symbol)[1];
                let attributes = {};
                let product_variant = pid_id;

                attributes['price'] = price;

                // if selected attribute is a valid product item
                if (quickViewValidateSelectedAttributes()) {
                    $.ajax({
                        url: '{{ route('frontend.products.add.to.cart.ajax') }}',
                        type: 'POST',
                        data: {
                            product_id: product_id,
                            quantity: quantity,
                            pid_id: pid_id,
                            product_variant: product_variant,
                            selected_size: selected_size,
                            selected_color: selected_color,
                            attributes: attributes,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if(data.type ?? false){
                                toastr[data.type](data.msg);
                            }else{
                                toastr.success(data.msg);
                            }

                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                            }

                            setTimeout(function() {
                                window.location.href = "{{ route('frontend.checkout') }}";
                            }, 1500);
                        },
                        erorr: function(err) {
                            toastr.error('{{ __('An error occurred') }}');
                        }
                    });
                } else {
                    toastr.error('{{ __('Select all attribute to proceed') }}');
                }
            });

            $(document).on('click', '.add_to_buy_now_ajax', function(e) {
                e.preventDefault();
                let pid_id = ''; //getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = 1;
                let attributes = {};
                let product_variant = null;

                attributes['price'] = null;

                $.ajax({
                    url: '{{ route('frontend.products.add.to.cart.ajax') }}',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        quantity: quantity,
                        pid_id: pid_id,
                        product_variant: product_variant,
                        attributes: attributes,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if(data.type ?? false){
                            toastr[data.type](data.msg);
                        }else{
                            toastr.success(data.msg);
                        }

                        if (data.quantity_msg) {
                            toastr.warning(data.quantity_msg)
                        }

                        loadHeaderCardAndWishlistArea(data);

                        setTimeout(function() {
                            window.location.href = "{{ route('frontend.checkout') }}";
                        }, 1500);
                    },
                    erorr: function(err) {
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            });

            $(document).on('click', '.add_to_wishlist_single_page_quick_view', function(e) {
                e.preventDefault();
                let selected_size = $('#quick_view_selected_size').val();
                let selected_color = $('#quick_view_selected_color').val();
                let site_currency_symbol = "{{ site_currency_symbol() }}";

                $(".quick-view-size-lists.active")

                let pid_id = getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = Number($('#quick-view-quantity').val().trim());
                let price = $('#quick-view-price').text().split(site_currency_symbol)[1];
                let attributes = {};
                let product_variant = pid_id;

                attributes['price'] = price;

                // if selected attribute is a valid product item
                if (quickViewValidateSelectedAttributes()) {
                    $.ajax({
                        url: '{{ route('frontend.products.add.to.wishlist.ajax') }}',
                        type: 'POST',
                        data: {
                            product_id: product_id,
                            quantity: quantity,
                            pid_id: pid_id,
                            product_variant: product_variant,
                            selected_size: selected_size,
                            selected_color: selected_color,
                            attributes: attributes,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if(data.type ?? false){
                                toastr[data.type](data.msg);
                            }else{
                                toastr.success(data.msg);
                            }

                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                            }

                            loadHeaderCardAndWishlistArea(data);
                        },
                        erorr: function(err) {
                            toastr.error('{{ __('An error occurred') }}');
                        }
                    });
                } else {
                    toastr.error('{{ __('Select all attribute to proceed') }}');
                }
            });

            $(document).on('click', '.add_to_compare_single_page_quick_view', function(e) {
                e.preventDefault();
                let selected_size = $('#quick_view_selected_size').val();
                let selected_color = $('#quick_view_selected_color').val();
                let site_currency_symbol = "{{ site_currency_symbol() }}";

                $(".quick-view-size-lists.active")

                let pid_id = getQuickViewAttributesForCart();

                let product_id = $(this).data('id');
                let quantity = Number($('#quick-view-quantity').val().trim());
                let price = $('#quick-view-price').text().split(site_currency_symbol)[1];
                let attributes = {};
                let product_variant = pid_id;

                attributes['price'] = price;

                // if selected attribute is a valid product item
                if (quickViewValidateSelectedAttributes()) {
                    $.ajax({
                        url: '{{ route('frontend.products.add.to.compare') }}',
                        type: 'POST',
                        data: {
                            product_id: product_id,
                            quantity: quantity,
                            pid_id: pid_id,
                            product_variant: product_variant,
                            selected_size: selected_size,
                            selected_color: selected_color,
                            attributes: attributes,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if(data.type ?? false){
                                toastr[data.type](data.msg);
                            }else{
                                toastr.success(data.msg);
                            }

                            if (data.quantity_msg) {
                                toastr.warning(data.quantity_msg)
                            }

                            loadHeaderCardAndWishlistArea(data);
                        },
                        erorr: function(err) {
                            toastr.error('{{ __('An error occurred') }}');
                        }
                    });
                } else {
                    toastr.error('{{ __('Select all attribute to proceed') }}');
                }
            });

            function selectedAttributeSearch(selected_item) {
                /*
                 * search based on all selected attributes
                 *
                 * 1. get all selected attributes in {key:value} format
                 * 2. search in attribute_store for all available matches
                 * 3. display available matches (keep available matches selectable, and rest as disabled)
                 * */

                let available_variant_types = [];
                let selected_options = {};

                // get all selected attributes in {key:value} format
                quick_view_available_options.map(function(k, option) {
                    let selected_option = $(option).find('li.active');
                    let type = selected_option.closest('.quick-view-size-lists').data('type');
                    let value = selected_option.data('displayValue');

                    if (type) {
                        available_variant_types.push(type);
                    }

                    if (type && value) {
                        selected_options[type] = value;
                    }
                });

                quickViewSyncImage(get_quick_view_selected_options());
                quickViewSyncPrice(get_quick_view_selected_options());
                quickViewSyncStock(get_quick_view_selected_options());

                // search in attribute_store for all available matches
                let available_variants_selection = [];
                let selected_attributes_by_type = {};
                quick_view_attribute_store.map(function(arr) {
                    let matched = true;

                    Object.keys(selected_options).map(function(type) {

                        if (arr[type] != selected_options[type]) {
                            matched = false;
                        }
                    })

                    if (matched) {
                        available_variants_selection.push(arr);

                        // insert as {key: [value, value...]}
                        Object.keys(arr).map(function(type) {
                            // not array available for the given key
                            if (!selected_attributes_by_type[type]) {
                                selected_attributes_by_type[type] = []
                            }

                            // insert value if not inserted yet
                            if (selected_attributes_by_type[type].indexOf(arr[type]) <= -1) {
                                selected_attributes_by_type[type].push(arr[type]);
                            }
                        })
                    }
                });

                // selected item not contain product then de-select all selected option hare
                if (Object.keys(selected_attributes_by_type).length == 0) {
                    $('.quick-view-size-lists li.active').each(function() {
                        let sizeItem = $(this).parent().parent();

                        sizeItem.find('input[type=hidden]').val('');
                        sizeItem.find('input[type=text]').val('');
                    });

                    $('.quick-view-size-lists li.active').removeClass("active");
                    $('.quick-view-size-lists li.disabled-option').removeClass("disabled-option");

                    let el = $(selected_item);
                    let value = el.data('displayValue');

                    el.addClass("active");
                    $(this).find('input[type=hidden]').val(value);
                    $(this).find('input[type=text]').val(el.data('value'));

                    selectedAttributeSearch();
                }

                // keep only available matches selectable
                Object.keys(selected_attributes_by_type).map(function(type) {
                    // initially, disable all buttons
                    $('.quick-view-size-lists[data-type="' + type + '"] li').addClass('disabled-option');

                    // make buttons selectable for the available options
                    selected_attributes_by_type[type].map(function(value) {
                        let available_buttons = $('.quick-view-size-lists[data-type="' + type +
                            '"] li[data-display-value="' + value + '"]');
                        available_buttons.map(function(key, el) {
                            $(el).removeClass('disabled-option');
                        })
                    });
                });
                //  check is empty object
                // selected_attributes_by_type
            }

            function quickViewSyncImage(selected_options) {
                //todo fire when attribute changed
                let hashed_key = getQuickViewSelectionHash(selected_options);
                let product_image_el = $('.quick-view-shop-details-thumb-wrapper.quick-view-product-image img');

                let img_original_src = product_image_el.parent().data('src');

                // if selection has any image to it
                if (quick_view_additional_info_store[hashed_key]) {
                    let attribute_image = quick_view_additional_info_store[hashed_key].image;
                    if (attribute_image) {
                        product_image_el.attr('src', attribute_image);
                    } else {
                        product_image_el.attr('src', img_original_src);
                    }
                } else {
                    product_image_el.attr('src', img_original_src);
                }
            }

            function quickViewSyncPrice(selected_options) {
                let hashed_key = getQuickViewSelectionHash(selected_options);

                let product_price_el = $('#quick-view-price');
                let product_main_price = Number(String(product_price_el.data('mainPrice'))).toFixed(0);
                let tax_percentage = Number(String(product_price_el.data('price-percentage'))).toFixed(0);
                let site_currency_symbol = product_price_el.data('currencySymbol');

                // if selection has any additional price to it
                if (quick_view_additional_info_store[hashed_key]) {
                    let attribute_price = quick_view_additional_info_store[hashed_key]['additional_price'];
                    if (attribute_price) {
                        product_main_price = Number(product_main_price) + Number(attribute_price);
                        let price = calculatePercentage(product_main_price, Number(tax_percentage));

                        product_price_el.text(site_currency_symbol + (Number(price) + Number(product_main_price)));
                    } else {
                        product_price_el.text(site_currency_symbol + (calculatePercentage(Number(product_main_price), Number(
                            tax_percentage)) + Number(product_main_price)));
                    }
                } else {
                    product_price_el.text(site_currency_symbol + (calculatePercentage(Number(product_main_price), Number(
                        tax_percentage)) + Number(product_main_price)));
                }
            }

            function quickViewSyncStock(selected_options) {
                let hashed_key = getQuickViewSelectionHash(selected_options);
                let product_stock_el = $('.quick-view-availability');
                let product_item_left_el = $('.quick-view-stock-available');

                // if selection has any size and color to it

                if (quick_view_additional_info_store[hashed_key]) {
                    let stock_count = quick_view_additional_info_store[hashed_key]['stock_count'];

                    let stock_message = '';
                    if (Number(stock_count) > 0) {
                        stock_message = `<span class="text-success">{{ __('In Stock') }}</span>`;
                        product_item_left_el.text(`Only! ${stock_count} Item Left!`);
                        product_item_left_el.addClass('text-success');
                        product_item_left_el.removeClass('text-danger');
                    } else {
                        stock_message = `<span class="text-danger">{{ __('Our fo Stock') }}</span>`;
                        product_item_left_el.text(`No Item Left!`);
                        product_item_left_el.addClass('text-danger');
                        product_item_left_el.removeClass('text-success');
                    }

                    product_stock_el.html(stock_message);

                } else {
                    product_stock_el.html(product_stock_el.data("stock-text"))
                    product_item_left_el.html(product_item_left_el.data("stock-text"))
                }
            }

            function attributeSelected() {
                let total_options_count = $('.quick-view-size-lists').length;
                let selected_options_count = $('.quick-view-size-lists li.active').length;
                return total_options_count === selected_options_count;
            }

            function addslashes(str) {
                return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
            }

            function getQuickViewSelectionHash(selected_options) {
                return MD5(JSON.stringify(selected_options));
            }

            function get_quick_view_selected_options() {
                let selected_options = {};
                let quick_view_available_options = $('.quick-view-value-input-area');
                // get all selected attributes in {key:value} format
                quick_view_available_options.map(function(k, option) {
                    let selected_option = $(option).find('li.active');
                    let type = selected_option.closest('.quick-view-size-lists').data('type');
                    let value = selected_option.data('displayValue');

                    if (type && value) {
                        selected_options[type] = value;
                    }
                });

                let ordered_data = {};
                let selected_options_keys = Object.keys(selected_options).sort();
                selected_options_keys.map(function(e) {
                    ordered_data[e] = String(selected_options[e]);
                });

                return ordered_data;
            }

            function getQuickViewAttributesForCart() {
                let selected_options = get_quick_view_selected_options();
                let cart_selected_options = selected_options;
                let hashed_key = getQuickViewSelectionHash(selected_options);

                // if selected attribute set is available
                if (quick_view_additional_info_store[hashed_key]) {
                    return quick_view_additional_info_store[hashed_key]['pid_id'];
                }

                // if selected attribute set is not available
                if (Object.keys(selected_options).length) {
                    toastr.error('{{ __('Attribute not available') }}')
                }

                return '';
            }

            function send_ajax_response_get_response(type, url) {
                $.ajax({
                    url: url,
                    type: type,
                    data: {
                        style: "two",
                        limit: $(".product-filter-two-wrapper").data("item-limit")
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    beforeSend: function() {
                        $(".product-filter-two-wrapper").attr("style", "height:912px");
                        $(".filter-style-block-preloader.lds-ellipsis").show();
                    },
                    success: function(data) {
                        $(".filter-style-block-preloader.lds-ellipsis").hide(300);
                        $(".product-filter-two-wrapper").removeAttr("style");
                        $(".product-filter-two-wrapper").html(data).removeAttr("style");

                        if (data.success == false) {
                            toastr.warning('There something is wrong please try again');
                        }
                    },
                    erorr: function(err) {
                        $(".product-filter-two-wrapper").removeAttr("style");
                        $(".filter-style-block-preloader.lds-ellipsis").hide(300);
                        toastr.error('{{ __('An error occurred') }}');
                    }
                });
            }

            function quickViewValidateSelectedAttributes() {
                let selected_options = get_quick_view_selected_options();
                let hashed_key = getQuickViewSelectionHash(selected_options);

                // validate if product has any attribute
                if (quick_view_attribute_store.length) {
                    if (!Object.keys(selected_options).length) {
                        return false;
                    }

                    if (!quick_view_additional_info_store[hashed_key]) {
                        return false;
                    }

                    return !!quick_view_additional_info_store[hashed_key]['pid_id'];
                }

                return true;
            }

            function loadHeaderCardAndWishlistArea(data) {
                if (data.header_area != undefined) {
                    $(".header-card-area-content-wrapper").html(data.header_area);
                }

                return '';
            }


            $(document).ready(function() {
                loopcounter("loopCounter_global")
            });
            @if ($navbar_type == 3 || $navbar_type == 2)
                /*
                    ========================================
                        Nav Category js
                    ========================================
                */
                $(document).on('click', '.categoryNav__close, .categoryNav_overlay', function() {
                    $('.categoryNav, .categoryNav_overlay').removeClass('show');
                });
                $(document).on('click', '.category_bars', function() {
                    $('.categoryNav, .categoryNav_overlay').toggleClass('show');
                });
                /* Category submenu  */
                $(document).on('click', '.parent_menu a.menu-link', function() {
                    let dataMenu = $(this).data('menu');
                    $('.parent_menu').addClass('translate-left').removeClass('menu_visible');
                    $(this).closest('.categoryNav__inner').find('.submenu[data-menu="' + dataMenu + '"]').addClass(
                        'menu_visible');
                });
                /* back to main menu */
                $(document).on('click', '.back_mainMenu', function() {
                    $('.parent_menu').addClass('menu_visible').removeClass('translate-left');
                    $(this).closest('.categoryNav__inner').find('.submenu').removeClass('menu_visible');
                });
            @endif

            $(document).on('keyup', '#search_form_input', function(e) {
                let input_values = $(this).val();
                let category_id = $('#search_selected_category').val();
                let search_result_category = $('#search_result_categories');
                let search_result_products = $('#search_result_products');
                let sppinnerHtml = '<i class="las la-spinner la-spin"></i>';
                let btnIns = $(this).parent().find('button');
                let btnOldText = `<i class="las la-search"></i>`;
                let site_currency_symbol = "{{ site_currency_symbol() }}";

                if (!input_values.length) {
                    search_result_category.html('');
                    search_result_products.html('');
                    $('#search_suggestions_wrap').hide();
                } else {
                    //enable preloader
                    btnIns.html(sppinnerHtml)
                    $.get('{{ route('frontend.products.search') }}', {
                        name: input_values,
                        category: category_id
                    }).then(function(data) {
                        $('#search_suggestions_wrap').show();
                        search_result_category.html('');
                        if (data['product_url']) {
                            $('#search_result_all').attr('href', data['product_url']);
                        }
                        let fetchedCategory = data['categories'];
                        if (data['categories']) {
                            search_result_category.parent().show();
                            $('#no_product_found_div').hide();
                            //check it ther category avialble or not
                            Object.values(data['categories']).forEach(function(category) {
                                search_result_category.append(`<li class="list">
                                    <a href="${category['url']}" class="item">${category['title']}</a>
                                </li>`);
                            });
                        }

                        if (fetchedCategory.length === 0) {
                            $('#search_result_categories').parent().hide();
                        }

                        let fetchedProdcuts = data['products'];
                        search_result_products.html('');
                        if (data['products']) {
                            $('#search_result_products').parent().show();
                            $('#no_product_found_div').hide();
                            let searchResultForProducts = "";
                            Object.values(data['products']).forEach(function(product) {
                                searchResultForProducts += `
                                    <li class="list">
                                        <a href="${product['url']}" class="item">
                                            <div class="product-image"><img src="${product['img_url']}" alt="img"></div>
                                            <div class="product-info">
                                                <div class="product-info-top">
                                                    <h6 class="product-name">${product['title']}</h6>
                                                </div>
                                                <div class="product-price mt-2">
                                                    <div class="price-update-through">
                                                        <span class="flash-price fw-500">${site_currency_symbol + product['discount_price']}</span>
                                                        <span class="flash-old-prices">${site_currency_symbol + product['price']}</span>
                                                    </div>
                                                    <span class="stock-out">${product['stock_count'] > 0 ? '{{ __('In Stock') }}' : '{{ __('Stock Out') }}'}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                `
                            });

                            $("#search_result_products").html(searchResultForProducts);
                        }

                        if (fetchedProdcuts.length === 0 && fetchedCategory.length === 0) {
                            $('#no_product_found_div').show();
                        }

                        //  disable preloader
                        btnIns.html(btnOldText);

                        $('.category-searchbar').show();
                        $('#search_suggestions_wrap').addClass("show");
                    });
                }
            });
        </script>
        <script src="{{ asset("assets/frontend/js/dynamic-script.js") }}"></script>
    </body>
</html>
