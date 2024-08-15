<div class="dashboard-left-content">
    <div class="dashboard-close-main">
        <div class="close-bars"> <i class="las la-times"></i> </div>
        <div class="dashboard-top">
            <div class="dashboard-logo">
                <a href="{{ route('admin.home') }}">
                    @if (get_static_option('site_admin_dark_mode') == 'off')
                        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                    @else
                        {!! render_image_markup_by_attachment_id(get_static_option('site_white_logo')) !!}
                    @endif
                </a>
            </div>
            <div class="dashboard-top-search mt-4">
                <div class="dashboard__bottom__search dashboard-input">
                    <input class="form--control  w-100" type="text" placeholder="Search here..."
                           id="search_sidebarList">
                </div>
            </div>
        </div>
        <div class="dashboard-bottom custom__form mt-4" id="sidbar-menu-wrap">
            <ul class="dashboard-list">
                <li class="{{ active_menu('admin-home') }}">
                    <a href="{{ route('admin.home') }}" aria-expanded="true">
                        <i class="ti-layout-grid2"></i>
                        <span>@lang('Dashboard')</span>
                    </a>
                </li>

                @if (auth('admin')->user()->hasRole('Super Admin'))
                    <li class="main_dropdown @if (request()->is(['admin-home/admin/*'])) active open @endif">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{ __('Admin Manage') }}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{ active_menu('admin-home/admin/all-user') }}">
                                <a href="{{ route('admin.all.user') }}">{{ __('All Admin') }}</a>
                            </li>
                            <li class="{{ active_menu('admin-home/admin/new-user') }}">
                                <a href="{{ route('admin.new.user') }}">{{ __('Add New Admin') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (auth('admin')->user()->hasRole('Super Admin'))
                    <li class="main_dropdown @if (request()->is(['admin-home/roles', 'admin-home/roles/*'])) active open @endif">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{ __('Manage Role Permission') }}</span></a>
                        <ul class="collapse">
                            <li class="{{ active_menu('admin-home/admin/roles') }}">
                                <a href="{{ route('admin.roles.index') }}">{{ __('Roles') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @canany(['frontend-all-user', 'frontend-new-user', 'frontend-user-update',
                    'frontend-user-password-change', 'frontend-delete-user', 'frontend-all-user-bulk-action',
                    'frontend-all-user-email-status'])
                    <li class="main_dropdown
                        @if (request()->is([
                                'admin-home/frontend/new-user',
                                'admin-home/frontend/all-user',
                                'admin-home/frontend/all-user/role',
                            ])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{ __('Users Manage') }}</span></a>
                        <ul class="collapse">
                            @can('frontend-all-user')
                                <li class="{{ active_menu('admin-home/frontend/all-user') }}">
                                    <a href="{{ route('admin.all.frontend.user') }}">
                                        {{ __('All Users') }}
                                    </a>
                                </li>
                            @endcan
                            @can('frontend-new-user')
                                <li class="{{ active_menu('admin-home/frontend/new-user') }}">
                                    <a href="{{ route('admin.frontend.new.user') }}">
                                        {{ __('Add New User') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['newsletter', 'newsletter-all'])
                    <li class="main_dropdown @if (request()->is(['admin-home/newsletter/*', 'admin-home/newsletter'])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-email"></i>
                            <span>{{ __('Newsletter Manage') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('newsletter')
                                <li class="{{ active_menu('admin-home/newsletter') }}">
                                    <a href="{{ route('admin.newsletter') }}">{{ __('All Subscriber') }}</a>
                                </li>
                            @endcan
                            @can('newsletter-all')
                                <li class="{{ active_menu('admin-home/newsletter/all') }}">
                                    <a href="{{ route('admin.newsletter.mail') }}">{{ __('Send Mail To All') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['support-tickets', 'support-ticket-vendor-tickets', 'support-ticket-new',
                    'support-ticket-department', 'support-ticket-page-settings'])
                    <li
                            class="main_dropdown {{ active_menu('admin-home/support-tickets') }} @if (request()->is('admin-home/support-tickets/*')) active open @endif">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-headphone-alt"></i>
                            <span>{{ __('Support Tickets') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('support-tickets')
                                <li class="{{ active_menu('admin-home/support-tickets') }}">
                                    <a href="{{ route('admin.support.ticket.all') }}">{{ __('All Tickets') }}</a>
                                </li>
                            @endcan

                            @can('support-tickets-vendor-tickets')
                                <li class="{{ active_menu('admin-home/support-tickets/vendor-tickets') }}">
                                    <a
                                            href="{{ route('admin.support.ticket.all.vendor') }}">{{ __('All Vendors Tickets') }}</a>
                                </li>
                            @endcan

                            @can('support-tickets-new')
                                <li class="{{ active_menu('admin-home/support-tickets/new') }}">
                                    <a href="{{ route('admin.support.ticket.new') }}">{{ __('Add New Ticket') }}</a>
                                </li>
                            @endcan

                            @can('support-tickets-department')
                                <li class="{{ active_menu('admin-home/support-tickets/department') }}">
                                    <a href="{{ route('admin.support.ticket.department') }}">{{ __('Departments') }}</a>
                                </li>
                            @endcan

                            @can('support-tickets-page-settings')
                                <li class="{{ active_menu('admin-home/support-tickets/page-settings') }}">
                                    <a href="{{ route('admin.support.ticket.page.settings') }}">{{ __('Page Settings') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{--        if modile app Manage exists then allow those routes        --}}
                @if (moduleExists('MobileApp'))
                    @if (auth('admin')->user()->hasRole('Super Admin'))
                        <li class="main_dropdown @if (request()->is(['admin-home/mobile-intro/*', 'admin-home/vendor-intro/*'])) active @endif">
                            <a href="#1" aria-expanded="true"><i class="ti-mobile"></i>
                                <span>{{ __('Mobile Intro Manage') }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/mobile-intro/list') }}"><a
                                            href="{{ route('admin.mobile.intro.all') }}">{{ __('Buyer Intro List') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-intro/new') }}"><a
                                            href="{{ route('admin.mobile.intro.create') }}">{{ __('Buyer Intro Create') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/vendor-intro/list') }}"><a
                                            href="{{ route('admin.mobile.vendor.intro.all') }}">{{ __('Vendor Intro List') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/vendor-intro/new') }}"><a
                                            href="{{ route('admin.mobile.vendor.intro.create') }}">{{ __('Vendor Intro Create') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (auth('admin')->user()->hasRole('Super Admin'))
                        <li class="main_dropdown @if (request()->is([
                                'admin-home/mobile-slider-two/*',
                                'admin-home/mobile-slider-three/*',
                                'admin-home/mobile-slider/*',
                                'admin-home/mobile-featured-product/*',
                                'admin-home/mobile-campaign/*',
                                'admin-home/mobile-settings/*',
                            ])) active @endif">
                            <a href="#1" aria-expanded="true"><i class="ti-mobile"></i>
                                <span>{{ __('Buyer App Manages') }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/mobile-slider/create') }}"><a
                                            href="{{ route('admin.mobile.slider.create') }}">{{ __('Slider Create') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider/list') }}"><a
                                            href="{{ route('admin.mobile.slider.all') }}">{{ __('Slider List') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-two/new') }}"><a
                                            href="{{ route('admin.mobile.slider.two.create') }}">{{ __('Slider two Create') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-two/list') }}"><a
                                            href="{{ route('admin.mobile.slider.two.all') }}">{{ __('Slider two List') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-three/new') }}"><a
                                            href="{{ route('admin.mobile.slider.three.create') }}">{{ __('Slider three Create') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-slider-three/list') }}"><a
                                            href="{{ route('admin.mobile.slider.three.all') }}">{{ __('Slider three List') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-campaign/create') }}">
                                    <a
                                            href="{{ route('admin.mobile.campaign.create') }}">{{ __('Campaign Update') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-featured-product/new') }}">
                                    <a
                                            href="{{ route('admin.featured.product.create') }}">{{ __('Featured Product Update') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-settings/terms-and-controller') }}">
                                    <a
                                            href="{{ route('admin.mobile.settings.terms_and_condition') }}">{{ __('Terms and condition page') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/mobile-settings/privacy-policy') }}">
                                    <a href="{{ route('admin.mobile.settings.privacy.policy') }}">{{ __('Privacy and policy page') }}</a>
                                </li>

                                @if(auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/mobile-settings/buyer-app-settings') }}">
                                        <a href="{{ route('admin.mobile.settings.buyer-app-settings') }}">{{ __('Buyer App Settings') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif

                @if (moduleExists('DeliveryMan'))
                    @canany(['delivery-man-zone', 'delivery-man-pickup-point', 'delivery-man-add',
                        'delivery-man-settings', 'delivery-man-wallet-gateway'])
                        {{--                Wallet Manage                 --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/delivery-man/*', 'admin-home/delivery-man/pickup-point/*', 'admin-home/delivery-man'])) active open @endif addon-module">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-truck"></i>
                                <span>{{ __('Delivery Man') }} <span class="badge bg-danger ml-5-px">{{ __("Plugin") }}</span></span>
                            </a>
                            <ul class="collapse">
                                @can('delivery-man-pickup-point')
                                    <li class="{{ active_menu('admin-home/delivery-man/pickup-point') }}">
                                        <a
                                                href="{{ route('admin.delivery-man.pickup-point.index') }}">{{ __('Pickup Point') }}</a>
                                    </li>
                                @endcan

                                @can('delivery-man-zone')
                                    <li class="{{ active_menu('admin-home/delivery-man/zone') }}">
                                        <a href="{{ route('admin.delivery-man.zone.index') }}">
                                            {{ __('Delivery Man Zone') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man')
                                    <li class="{{ active_menu('admin-home/delivery-man') }}">
                                        <a href="{{ route('admin.delivery-man.index') }}">
                                            {{ __('Delivery Man List') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-add')
                                    <li class="{{ active_menu('admin-home/delivery-man/add') }}">
                                        <a href="{{ route('admin.delivery-man.add') }}">
                                            {{ __('Create Delivery Man') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-settings')
                                    <li class="{{ active_menu('admin-home/delivery-man/settings') }}">
                                        <a href="{{ route('admin.delivery-man.settings') }}">
                                            {{ __('Delivery Man Settings') }}
                                        </a>
                                    </li>
                                @endcan

                                @can('delivery-man-wallet-gateway')
                                    <li class="{{ active_menu('admin-home/delivery-man/wallet/gateway') }}">
                                        <a href="{{ route('admin.delivery-man.wallet.withdraw.gateway') }}">
                                            {{ __('Withdraw Gateway') }}
                                        </a>
                                    </li>
                                @endcan
                                @if(auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/delivery-man/update') }}">
                                        <a href="{{ route('admin.delivery-man.license_update') }}">
                                            <span>{{ __('Update Plugin') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endcanany
                @endif

                @if (moduleExists('Wallet'))
                    @canany(['wallet-withdraw-request', 'wallet-vendor-lists', 'wallet-delivery-man-lists',
                        'wallet-customer-lists', 'wallet-history-records', 'wallet-withdraw-gateway',
                        'wallet-settings-update'])
                        {{--                Wallet Manage                 --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/wallet/*'])) active open @endif ">
                            <a href="#1" aria-expanded="true"><i class="ti-wallet"></i>
                                <span>{{ __('Wallet') }}</span></a>
                            <ul class="collapse">
                                @can('wallet-withdraw-request')
                                    <li class="{{ active_menu('admin-home/wallet/withdraw-request') }}">
                                        <a href="{{ route('admin.wallet.withdraw-request') }}">{{ __('Withdraw Request') }}</a>
                                    </li>
                                @endcan

                                @if(moduleExists("DeliveryMan"))
                                    @can('wallet-delivery-man-withdraw-request')
                                        <li class="{{ active_menu('admin-home/wallet/delivery-man-withdraw-request') }}">
                                            <a
                                                    href="{{ route('admin.wallet.delivery-man-withdraw-request') }}">{{ __('Delivery man Withdraw Request') }}</a>
                                        </li>
                                    @endcan
                                @endcan

                                @can('wallet-vendor-lists')
                                    <li class="{{ active_menu('admin-home/wallet/vendor/lists') }}">
                                        <a href="{{ route('admin.wallet.lists') }}">{{ __('Vendor Wallet List') }}</a>
                                    </li>
                                @endcan

                                @if(moduleExists("DeliveryMan"))
                                    @can('wallet-delivery-man-lists')
                                        <li class="{{ active_menu('admin-home/wallet/delivery-man/lists') }}">
                                            <a href="{{ route('admin.wallet.delivery-man.lists') }}">{{ __('Delivery man List') }}</a>
                                        </li>
                                    @endcan
                                @endif
                                @can('wallet-customer-lists')
                                    <li class="{{ active_menu('admin-home/wallet/customer/lists') }}">
                                        <a href="{{ route('admin.wallet.customer.lists') }}">{{ __('Customer Wallet List') }}</a>
                                    </li>
                                @endcan
                                @can('wallet-history-records')
                                    <li class="{{ active_menu('admin-home/wallet/history/records') }}">
                                        <a href="{{ route('admin.wallet.history') }}">{{ __('Customer Deposit History') }}</a>
                                    </li>
                                @endcan
                                @can('wallet-withdraw-gateway')
                                    <li class="{{ active_menu('admin-home/wallet/withdraw/gateway') }}">
                                        <a href="{{ route('admin.wallet.withdraw.gateway') }}">{{ __('Wallet Gateway') }}</a>
                                    </li>
                                @endcan
                                @can('wallet-settings-update')
                                    <li class="{{ active_menu('admin-home/wallet/settings/update') }}">
                                        <a href="{{ route('admin.wallet.settings') }}">{{ __('Wallet Settings') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                @endcan

                @if (moduleExists('Refund'))
                    @canany(['refund-request', 'refund-reason', 'refund-preferred-option', 'refund-settings'])
                        {{--                Wallet Manage                 --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/refund/*'])) active open @endif ">
                            <a href="#1" aria-expanded="true"><i class="ti-control-backward"></i>
                                <span>{{ __('Refund Manage') }}<span class="badge bg-danger ml-5-px">{{ __("Plugin") }}</span></span></a>
                            <ul class="collapse">
                                @can('refund-request')
                                    <li class="{{ active_menu('admin-home/refund/request') }}">
                                        <a href="{{ route('admin.refund.request') }}">{{ __('Refund Request') }}</a>
                                    </li>
                                @endcan
                                @can('refund-reason')
                                    <li class="{{ active_menu('admin-home/refund/reason') }}">
                                        <a href="{{ route('admin.refund.reason.index') }}">{{ __('Refund Reason') }}</a>
                                    </li>
                                @endcan
                                @can('refund-preferred-option')
                                    <li class="{{ active_menu('admin-home/refund/preferred-option') }}">
                                        <a
                                                href="{{ route('admin.refund.preferred-option.index') }}">{{ __('Refund preferred') }}</a>
                                    </li>
                                @endcan
                                @can('refund-settings')
                                    <li class="{{ active_menu('admin-home/refund/settings') }}">
                                        <a href="{{ route('admin.refund.settings.index') }}">{{ __('Refund Settings') }}</a>
                                    </li>
                                @endcan
                                @if(auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/refund/update-plugin') }}">
                                        <a href="{{ route('admin.refund.refund_plugin_license_update') }}">
                                            <span>{{ __('Update Plugin') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endcanany
                @endif

                @if (moduleExists('EmailTemplate'))
                    @can('email-template-all-templates')
                        {{--                Wallet Manage                 --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/email-template/*'])) active open @endif ">
                            <a href="#1" aria-expanded="true"><i class="ti-email"></i>
                                <span>{{ __('Email Template') }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/email-template/all-templates') }}">
                                    <a href="{{ route('admin.email-template.email.template.all') }}">
                                        {{ __('All Email Template') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                @endif

                @if (moduleExists('Wallet'))
                    @canany(['shop-manage', 'invoice-note'])
                        {{--                Shop Manage Manage                 --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/shop-manage/*', 'admin-home/shop-manage', 'admin-home/invoice-note'])) active open @endif ">
                            <a href="#1" aria-expanded="true"><i class="ti-shopping-cart"></i>
                                <span>{{ __('Shop Manage') }}</span></a>
                            <ul class="collapse">
                                @can('shop-manage')
                                    <li class="{{ active_menu('admin-home/shop-manage') }}">
                                        <a href="{{ route('admin.shop-manage.update') }}">{{ __('Shop Manage') }}</a>
                                    </li>
                                @endcan
                                @can('invoice-note')
                                    <li class="{{ active_menu('admin-home/invoice-note') }}">
                                        <a href="{{ route('admin.shop-manage.invoice-note') }}">{{ __('Invoice Note') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                @endif

                @if (moduleExists('Order'))
                    @canany(['assign-delivery-man-orders', 'orders-vendor-list', 'orders', 'orders-sub-order'])
                        {{-- Order Manage --}}
                        <li class="main_dropdown @if (request()->is([
                                'admin-home/orders/*',
                                'admin-home/orders',
                                'admin-home/assign-delivery-man/orders',
                                'admin-home/assign-delivery-man/orders/*',
                            ])) active open @endif ">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-view-list-alt"></i>
                                <span>{{ __('Orders') }}</span>
                            </a>

                            <ul class="collapse">
                                @if (moduleExists('DeliveryMan'))
                                    @can('assign-delivery-man-orders')
                                        <li class="{{ active_menu('admin-home/assign-delivery-man/orders') }}">
                                            <a href="{{ route('admin.assign-delivery-man.orders') }}">
                                                {{ __('Assign Delivery Man') }}
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                                @can('orders-vendor-list')
                                    <li class="{{ active_menu('admin-home/orders/vendor/list') }}">
                                        <a href="{{ route('admin.orders.vendor.list') }}">
                                            {{ __('All vendors') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('orders')
                                    <li class="{{ active_menu('admin-home/orders') }}">
                                        <a href="{{ route('admin.orders.list') }}">
                                            {{ __('All Orders') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('orders-sub-order')
                                    <li class="{{ active_menu('admin-home/orders/sub-order') }}">
                                        <a href="{{ route('admin.orders.sub_order.list') }}">{{ __('All Sub Orders') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                @endif

                @if (moduleExists('Pos'))
                    @canany(['pos-view', 'pos-payment-gateway-settings'])
                        {{-- Order Manage --}}
                        <li class="main_dropdown @if (request()->is(['admin-home/pos/*'])) active open @endif ">
                            <a href="#1" aria-expanded="true">
                                <i class="ti-layout-sidebar-2"></i>
                                <span>{{ __('Pos Manage') }} <span class="badge bg-danger ml-5-px">{{ __("Plugin") }}</span></span>
                            </a>

                            <ul class="collapse">
                                @can('pos-view')
                                    <li class="{{ active_menu('admin-home/pos/view') }}">
                                        <a href="{{ route('admin.pos.view') }}">{{ __('Pos Manage') }}</a>
                                    </li>
                                @endcan
                                @can('pos-payment-gateway-settings')
                                    <li class="{{ active_menu('admin-home/pos/payment-gateway/settings') }}">
                                        <a
                                                href="{{ route('admin.pos.payment-gateway-settings') }}">{{ __('Pos Settings') }}</a>
                                    </li>
                                @endcan
                                @if(auth('admin')->user()->hasRole('Super Admin'))
                                    <li class="{{ active_menu('admin-home/pos/update-plugin') }}">
                                        <a href="{{ route('admin.pos.pos_plugin_license_update') }}">
                                            <span>{{ __('Update Plugin') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endcanany
                @endif

                @if(moduleExists('PluginManage') && auth('admin')->user()->hasRole('Super Admin'))
                    <li class="main_dropdown
                     @if (request()->is([
                            'admin-home/plugin-manage',
                            'admin-home/plugin-manage/*',
                        ])) active @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-clipboard"></i>
                            <span>{{ __('Plugin Manage') }}</span></a>
                        <ul class="collapse">
                            @can('country')
                                <li class="{{ active_menu('admin-home/plugin-manage/all') }}">
                                    <a href="{{ route('admin.plugin.manage.all') }}">{{ __('All Plugin') }}</a>
                                </li>
                            @endcan

                            @can('state')
                                <li class="{{ active_menu('admin-home/plugin-manage/new') }}">
                                    <a href="{{ route('admin.plugin.manage.new') }}">{{ __('Add New Plugin') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @canany(['country', 'state', 'city'])
                    <li class="main_dropdown @if (request()->is([
                            'admin-home/country',
                            'admin-home/country/*',
                            'admin-home/state',
                            'admin-home/state/*',
                            'admin-home/city',
                            'admin-home/city/*',
                        ])) active @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-clipboard"></i>
                        <span>{{ __('Country Manage') }}</span></a>
                        <ul class="collapse">
                            @can('country')
                                <li class="{{ active_menu('admin-home/continent') }}">
                                    <a href="{{ route('admin.continent') }}">{{ __('Continents') }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/country') }}">
                                    <a href="{{ route('admin.country.all') }}">{{ __('Country') }}</a>
                                </li>
                            @endcan

                            @can('country')
                                <li class="{{ active_menu('admin-home/country/csv/import') }}">
                                    <a href="{{ route('admin.country.import.csv.settings') }}">{{ __('Import Country') }}</a>
                                </li>
                            @endcan

                            @can('state')
                                <li class="{{ active_menu('admin-home/state') }}">
                                    <a href="{{ route('admin.state.all') }}">{{ __('State') }}</a>
                                </li>
                            @endcan

                            @can('state')
                                <li class="{{ active_menu('admin-home/state/csv/import') }}">
                                    <a href="{{ route('admin.state.import.csv.settings') }}">{{ __('Import State') }}</a>
                                </li>
                            @endcan

                            @can('city')
                                <li class="{{ active_menu('admin-home/city') }}">
                                    <a href="{{ route('admin.city.all') }}">{{ __('City') }}</a>
                                </li>
                            @endcan

                            @can('city')
                                <li class="{{ active_menu('admin-home/city/csv/import') }}">
                                    <a href="{{ route('admin.city.import.csv.settings') }}">{{ __('Import City') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['tax-module-settings', 'tax-module-tax-class'])
                    <li class="main_dropdown @if (request()->is(['admin-home/tax/*', 'admin-home/tax-module/*'])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-money"></i>
                            <span>{{ __('Tax Settings') }}</span></a>
                        <ul class="collapse">
                            @can('tax-module-settings')
                                <li class="{{ active_menu('admin-home/tax-module/settings') }}">
                                    <a href="{{ route('admin.tax-module.settings') }}">{{ __('Tax Manage Settings') }}</a>
                                </li>
                            @endcan

                            @if (get_static_option('tax_system') == 'advance_tax_system')
                                @can('tax-module-tax-class')
                                    <li class="{{ active_menu('admin-home/tax-module/tax-class') }}">
                                        <a href="{{ route('admin.tax-module.tax-class') }}">{{ __('Tax Class') }}</a>
                                    </li>
                                @endcan
                            @endif

                            @if (get_static_option('tax_system') == 'zone_wise_tax_system')
                                @can('tax-country')
                                    <li class="{{ active_menu('admin-home/tax/country') }}">
                                        <a href="{{ route('admin.tax.country.all') }}">{{ __('Country Tax') }}</a>
                                    </li>
                                @endcan

                                @can('tax-state')
                                    <li class="{{ active_menu('admin-home/tax/state') }}">
                                        <a href="{{ route('admin.tax.state.all') }}">{{ __('State Tax') }}</a>
                                    </li>
                                @endcan
                            @endif
                        </ul>
                    </li>
                @endcanany

                @canany(['categories', 'sub-categories', 'child-categories', 'units', 'tags', 'delivery-option',
                    'brand-manage', 'colors', 'sizes', 'attributes', 'badge'])
                    {{--                  Attribute Manage menu bar                 --}}
                    <li class="main_dropdown @if (request()->is([
                                                        'admin-home/categories',
                                                        'admin-home/sub-categories',
                                                        'admin-home/child-categories',
                                                        'admin-home/units',
                                                        'admin-home/tags',
                                                        'admin-home/delivery-option',
                                                        'admin-home/brand-manage',
                                                        'admin-home/brand-manage',
                                                        'admin-home/colors',
                                                        'admin-home/sizes',
                                                        'admin-home/attributes',
                                                    ])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-panel"></i>
                            <span>{{ __('Attributes Manage') }}</span></a>
                        <ul class="collapse">
                            @can('categories')
                                <li class="{{ active_menu('admin-home/categories') }}">
                                    <a href="{{ route('admin.category.all') }}">{{ __('Category') }}</a>
                                </li>
                            @endcan

                            @can('sub-categories')
                                <li class="{{ active_menu('admin-home/sub-categories') }}">
                                    <a href="{{ route('admin.subcategory.all') }}">{{ __('Sub-Category') }}</a>
                                </li>
                            @endcan

                            @can('child-categories')
                                <li class="{{ active_menu('admin-home/child-categories') }}">
                                    <a href="{{ route('admin.child-category.all') }}">{{ __('Child-Category') }}</a>
                                </li>
                            @endcan

                            @can('units')
                                <li class="{{ active_menu('admin-home/units') }}">
                                    <a href="{{ route('admin.units.all') }}">{{ __('Units') }}</a>
                                </li>
                            @endcan

                            {{-- @can('tags')
                                <li class="{{ active_menu('admin-home/tags') }}">
                                    <a href="{{ route('admin.tag.all') }}">{{ __('Tag') }}</a>
                                </li>
                            @endcan --}}

                            @can('delivery-option')
                                <li class="{{ active_menu('admin-home/delivery-option') }}">
                                    <a href="{{ route('admin.delivery.option.all') }}">{{ __('Delivery Options') }}</a>
                                </li>
                            @endcan

                            @can('brand-manage')
                                <li class="{{ active_menu('admin-home/brand-manage') }}">
                                    <a href="{{ route('admin.brand.manage.all') }}">{{ __('Brand Manage') }}</a>
                                </li>
                            @endcan

                            @can('colors')
                                <li class="{{ active_menu('admin-home/colors') }}">
                                    <a href="{{ route('admin.product.colors.all') }}">{{ __('Color Manage') }}</a>
                                </li>
                            @endcan

                            @can('sizes')
                                <li class="{{ active_menu('admin-home/sizes') }}">
                                    <a href="{{ route('admin.product.sizes.all') }}">{{ __('Size Manage') }}</a>
                                </li>
                            @endcan

                            @can('attributes')
                                <li class="{{ active_menu('admin-home/attributes') }}">
                                    <a href="{{ route('admin.products.attributes.all') }}"> {{ __('Custom Attribute') }} </a>
                                </li>
                            @endcan

                            @can('badge')
                                <li class="{{ active_menu('admin-home/badge') }}">
                                    <a href="{{ route('admin.badge.all') }}">{{ __('Badge List') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['vendor-index', 'vendor-create', 'vendor-settings', 'vendor-commission-settings'])
                    {{--                Vendor Manage                 --}}
                    <li class="main_dropdown @if (request()->is(['admin-home/vendor/*'])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{ __('Vendor Manage') }}</span></a>
                        <ul class="collapse">
                            @can('vendor-index')
                                <li class="{{ active_menu('admin-home/vendor/index') }}">
                                    <a href="{{ route('admin.vendor.all') }}">{{ __('Vendor List') }}</a>
                                </li>
                            @endcan
                            @can('vendor-create')
                                <li class="{{ active_menu('admin-home/vendor/create') }}">
                                    <a href="{{ route('admin.vendor.create') }}">{{ __('Vendor Create') }}</a>
                                </li>
                            @endcan
                            @can('vendor-settings')
                                <li class="{{ active_menu('admin-home/vendor/settings') }}">
                                    <a href="{{ route('admin.vendor.settings') }}">{{ __('Vendor Settings') }}</a>
                                </li>
                            @endcan
                            @can('vendor-commission-settings')
                                <li class="{{ active_menu('admin-home/vendor/commission-settings') }}">
                                    <a href="{{ route('admin.vendor.commission-settings') }}"><i
                                                class="las la-cog pl-0"></i>{{ __('Vendor commission') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{--        Product Inventory manage        --}}
                @can('product-inventory')
                    <li class="{{ active_menu('admin-home/product-inventory') }}">
                        <a href="{{ route('admin.products.inventory.all') }}">
                            <i class="ti-package"></i>
                            <span>{{ __('Inventory') }}</span>
                        </a>
                    </li>
                @endcan

                {{-- Product Manage Sidebar menu list --}}
                @canany(['coupons', 'coupons-new'])
                    <li class="@if (request()->is(['admin-home/coupons', 'admin-home/coupons/*'])) active open @endif">
                        <a href="{{ route('admin.products.coupon.all') }}" aria-expanded="true">
                            <i class="ti-layout-tab"></i>
                            <span>{{ __('Coupon Manage') }}</span>
                        </a>
                    </li>
                @endcanany
                {{-- Product Manage Sidebar menu list --}}
                @canany(['product-all', 'product-create'])
                    <li class="main_dropdown @if (request()->is(['admin-home/product', 'admin-home/product/*'])) active open @endif">
                        <a href="#1" aria-expanded="true"><i
                                    class="ti-layout-tab"></i><span>{{ __('Product Manage') }}</span></a>
                        <ul class="collapse">
                            @can('product-all')
                                <li class="{{ active_menu('admin-home/product/all') }}">
                                    <a href="{{ route('admin.products.all') }}">{{ __('Product List') }}</a>
                                </li>
                            @endcan

                            @can('product-create')
                                <li class="{{ active_menu('admin-home/product/create') }}">
                                    <a href="{{ route('admin.products.create') }}">{{ __('Create Product') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                {{-- Campaign route wrapper --}}
                @can('campaigns')
                    <li class="{{ active_menu('admin-home/campaigns') }}">
                        <a href="{{ route('admin.campaigns.all') }}" aria-expanded="true"><i class="ti-announcement"></i>
                            <span>{{ __('Campaign Manage') }}</span></a>
                    </li>
                @endcan
                {{-- Shipping zone route wrapper --}}
                @canany(['shipping-zone', 'shipping-method'])
                    <li class="main_dropdown @if (request()->is([
                                                        'admin-home/shipping/*',
                                                        'admin-home/shipping-method/*',
                                                        'admin-home/shipping-method',
                                                        'admin-home/shipping',
                                                    ])) open active @endif ">
                        <a href="#1" aria-expanded="true"><i
                                    class="ti-truck"></i><span>{{ __('Shipping Manage') }}</span></a>
                        <ul class="collapse">
                            @can('shipping-zone')
                                <li class="{{ active_menu('admin-home/shipping/zone') }}">
                                    <a href="{{ route('admin.shipping.zone.all') }}">{{ __('Shipping Zones') }}</a>
                                </li>
                            @endcan
                            @can('shipping-method')
                                <li class="@if (request()->is(['admin-home/shipping-method', 'admin-home/shipping-method/*'])) open active @endif">
                                    <a href="{{ route('admin.shipping-method.index') }}">{{ __('Shipping Methods') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Blog Routes Wrapper --}}
                @canany(['blog', 'blog-category', 'blog-new', 'blog-page-settings', 'blog-single-page-settings'])
                    <li class="main_dropdown @if (request()->is(['admin-home/blog/*', 'admin-home/blog'])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{ __('Blogs') }}</span></a>
                        <ul class="collapse">
                            @can('blog')
                                <li class="{{ active_menu('admin-home/blog') }}"><a
                                            href="{{ route('admin.blog') }}">{{ __('All Blog') }}</a></li>
                            @endcan
                            @can('blog-category')
                                <li class="{{ active_menu('admin-home/blog/category') }}"><a
                                            href="{{ route('admin.blog.category') }}">{{ __('Category') }}</a></li>
                            @endcan
                            @can('blog-new')
                                <li class="{{ active_menu('admin-home/blog/new') }}">
                                    <a href="{{ route('admin.blog.new') }}">
                                        {{ __('Add New Post') }}
                                    </a>
                                </li>
                            @endcan
                            @can('blog-page-settings')
                                <li class="{{ active_menu('admin-home/blog/page-settings') }}"><a
                                            href="{{ route('admin.blog.page.settings') }}">{{ __('Blog Page Settings') }}</a>
                                </li>
                            @endcan
                            @can('blog-single-page-settings')
                                <li class="{{ active_menu('admin-home/blog/single-settings') }}"><a
                                            href="{{ route('admin.blog.single.settings') }}">{{ __('Blog Single Settings') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('faq')
                    <li class="{{ active_menu('admin-home/faq') }}">
                        <a href="{{ route('admin.faq') }}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>{{ __('FAQ') }}</span>
                        </a>
                    </li>
                @endcan

                @if(moduleExists("Chat"))
                    <li class="main_dropdown @if (request()->is(['admin-home/livechat/*'])) open active @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{ __('Livechat Module') }}</span>
                            <span class="badge bg-danger ml-5-px">
                                {{ __("Plugin") }}
                            </span>
                        </a>
                        <ul class="collapse">
                            @can('livechat-settings')
                                <li class="{{ active_menu('admin-home/livechat/settings') }}">
                                    <a href="{{ route('admin.livechat.settings') }}">
                                        <i class="ti-comment-alt"></i>
                                        <span>{{ __('Livechat Settings') }}</span>
                                    </a>
                                </li>
                            @endcan
                            @if(auth('admin')->user()->hasRole('Super Admin'))
                                <li class="{{ active_menu('admin-home/livechat/update-plugin') }}">
                                    <a href="{{ route('admin.livechat.chat_plugin_license_update') }}">
                                        <span>{{ __('Update Plugin') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @canany(['page-all', 'page-new'])
                    <li class="main_dropdown @if (request()->is(['admin-home/page-edit/*', 'admin-home/page/edit/*', 'admin-home/page/all', 'admin-home/page/new'])) open active @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{ __('Pages') }}</span>
                        </a>

                        <ul class="collapse">
                            @can('page-all')
                                <li class="{{ active_menu('admin-home/page/all') }}"><a
                                            href="{{ route('admin.page') }}">{{ __('All Pages') }}</a></li>
                            @endcan

                            @can('page-new')
                                <li class="{{ active_menu('admin-home/page/new') }}"><a
                                            href="{{ route('admin.page.new') }}">{{ __('Add New Page') }}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['appearance-settings-topbar-all', 'menu', 'category-menu', 'widgets-all',
                    'form-builder-custom-all', 'media-upload-page'])
                    <li class="main_dropdown
                        @if (request()->is([
                                'admin-home/appearance-settings/topbar/*',
                                'admin-home/category-menu/*',
                                'admin-home/category-menu',
                                'admin-home/appearance-settings/navbar/*',
                                'admin-home/appearance-settings/home-variant/*',
                                'admin-home/media-upload/page',
                                'admin-home/menu',
                                'admin-home/menu-edit/*',
                                'admin-home/widgets',
                                'admin-home/widgets/*',
                                'admin-home/popup-builder/*',
                                'admin-home/form-builder/*',
                            ])) active open @endif ">
                        <a href="#1" aria-expanded="true"><i class="ti-stamp"></i>
                            <span>{{ __('Appearance Settings') }}</span></a>
                        <ul class="collapse ">
                            @can(['appearance-settings-topbar-all'])
                                <li class="{{ active_menu('admin-home/appearance-settings/topbar/all') }}">
                                    <a href="{{ route('admin.topbar.settings') }}" aria-expanded="true">
                                        {{ __('Topbar Manage') }}
                                    </a>
                                </li>
                            @endcan

                            @can('menu')
                                <li
                                        class="main_dropdown {{ active_menu('admin-home/menu') }} @if (request()->is('admin-home/menu-edit/*')) active open @endif ">
                                    <a href="#1" aria-expanded="true">{{ __('Menus Manage') }}</a>
                                    <ul class="collapse">
                                        <li class="{{ active_menu('admin-home/menu') }}">
                                            <a href="{{ route('admin.menu') }}">{{ __('All Menus') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can('category-menu')
                                <li class="{{ active_menu('admin-home/category-menu') }}">
                                    <a href="{{ route('admin.category.menu.settings') }}" aria-expanded="true">
                                        {{ __('Category Menu Manage') }}
                                    </a>
                                </li>
                            @endcan

                            @can('widgets-all')
                                <li
                                        class="main_dropdown {{ active_menu('admin-home/widgets/all') }} @if (request()->is('admin-home/widgets/*')) active open @endif ">
                                    <a href="#1" aria-expanded="true">
                                        {{ __('Widgets Manage') }}</a>
                                    <ul class="collapse">
                                        <li class="{{ active_menu('admin-home/widgets/all') }}"><a
                                                    href="{{ route('admin.widgets') }}">{{ __('All Widgets') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can('form-builder-custom-all')
                                <li class="main_dropdown @if (request()->is('admin-home/form-builder/*')) active open @endif ">
                                    <a href="#1" aria-expanded="true">
                                        {{ __('Form Builder') }}
                                    </a>
                                    <ul class="collapse">
                                        <li class="{{ active_menu('admin-home/form-builder/custom/all') }}">
                                            <a href="{{ route('admin.form.builder.all') }}">{{ __('Custom Form') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endcan

                            @can('media-upload-page')
                                <li class="{{ active_menu('admin-home/media-upload/page') }}">
                                    <a href="{{ route('admin.upload.media.images.page') }}"
                                       class="{{ active_menu('admin-home/form-builder/custom/all') }}">
                                        {{ __('Media Upload Page') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['page-settings-wishlist', 'page-settings-cart', 'page-settings-checkout', 'page-settings-compare',
                    'page-settings-login-register', 'page-settings-shop-page', 'page-settings-product-page', 'page-all',
                    'page-new', 'page-edit', 'page-update', 'page-delete', 'page-builk-action', 'page-builder-update',
                    'page-builder-new', 'page-builder-delete', 'page-builder-dynamic-page', 'page-builder-update-order',
                    'page-builder-get-admin-markup'])
                    <li
                            class="main_dropdown
                                                @if (request()->is([
                                                        'admin-home/home-page-01/*',
                                                        'admin-home/header',
                                                        'admin-home/keyfeatures',
                                                        'admin-home/about-page/*',
                                                        'admin-home/404-page-manage',
                                                        'admin-home/maintains-page/settings',
                                                        'admin-home/page-builder/home-page',
                                                        'admin-home/page-settings/*',
                                                        'admin-home/page-settings/wishlist',
                                                        'admin-home/page-settings/cart',
                                                        'admin-home/page-settings/compare',
                                                        'admin-home/page-builder/contact-page',
                                                        'admin-home/page-builder/about-page',
                                                        'admin-home/page-builder/faq-page',
                                                    ])) active open @endif">
                        <a href="#1" aria-expanded="true"><i class="ti-settings"></i>
                            <span>{{ __('All Page Settings') }}</span>
                        </a>
                        <ul class="collapse">
                            <li
                                    class="main_dropdown
                                                            @if (request()->is([
                                                                    'admin-home/page-settings/*',
                                                                    'admin-home/page-settings/wishlist',
                                                                    'admin-home/page-settings/cart',
                                                                    'admin-home/page-settings/compare',
                                                                ])) active open @endif
                                                            ">
                                <a href="#1" aria-expanded="true">
                                    {{ __('Module Page Settings') }}
                                </a>
                                <ul class="collapse">
                                    @can('page-settings-wishlist')
                                        <li class="{{ active_menu('admin-home/page-settings/wishlist') }}">
                                            <a href="{{ route('admin.page.settings.wishlist') }}">
                                                {{ __('Wishlist Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-cart')
                                        <li class="{{ active_menu('admin-home/page-settings/cart') }}">
                                            <a href="{{ route('admin.page.settings.cart') }}">
                                                {{ __('Cart Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-checkout')
                                        <li class="{{ active_menu('admin-home/page-settings/checkout') }}">
                                            <a href="{{ route('admin.page.settings.checkout') }}">
                                                {{ __('Checkout Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-compare')
                                        <li class="{{ active_menu('admin-home/page-settings/compare') }}">
                                            <a href="{{ route('admin.page.settings.compare') }}">
                                                {{ __('Compare Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-login-register')
                                        <li class="{{ active_menu('admin-home/page-settings/login-register') }}">
                                            <a href="{{ route('admin.page.settings.user.auth') }}">
                                                {{ __('Login/Register Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-shop-page')
                                        <li class="{{ active_menu('admin-home/page-settings/shop-page') }}">
                                            <a href="{{ route('admin.page.settings.shop.page') }}">
                                                {{ __('Shop Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-product-details-page')
                                        <li class="{{ active_menu('admin-home/page-settings/product-details-page') }}">
                                            <a href="{{ route('admin.page.settings.product.detail.page') }}">
                                                {{ __('Product Details Page') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @can('page-settings-product-details-page')
                                        <li class="{{ active_menu('admin-home/page-settings/product-settings-page') }}">
                                            <a href="{{ route('admin.page.settings.product.settings.page') }}">
                                                {{ __('Product Settings') }}
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            {{--                 @endcan                --}}
                            @can('404-page-manage')
                                <li class="{{ active_menu('admin-home/404-page-manage') }}">
                                    <a href="{{ route('admin.404.page.settings') }}" aria-expanded="true">
                                        {{ __('404 Page Manage') }}</a>
                                </li>
                            @endcan
                            @can('maintains-page-settings')
                                <li class="{{ active_menu('admin-home/maintains-page/settings') }}">
                                    <a href="{{ route('admin.maintains.page.settings') }}" aria-expanded="true">
                                        {{ __('Maintain Page Manage') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['shipping-charge-settings', 'general-settings-reading', 'general-settings-global-navbar',
                    'general-settings-site-identity', 'general-settings-basic-settings', 'general-settings-color-settings',
                    'general-settings-typography-settings', 'general-settings-seo-settings', 'general-settings-scripts',
                    'general-settings-email-template', 'general-settings-smtp-settings', 'general-settings-payment-gateway',
                    'general-settings-custom-css', 'general-settings-custom-js', 'general-settings-cache-settings',
                    'general-settings-gdpr-settings', 'general-settings-sitemap-settings', 'general-settings-rss-settings',
                    'general-settings-license-setting'])
                    <li class="main_dropdown @if (request()->is('admin-home/general-settings/*')) active open @endif ">
                        <a href="#1" aria-expanded="true">
                            <i class="ti-new-window"></i>
                            <span>{{ __('General Settings') }}</span>
                        </a>
                        <ul class="collapse">
                            @can('shipping-charge-settings')
                                <li class="{{ active_menu('admin-home/shipping-charge-settings') }}"><a
                                            href="{{ route('admin.shipping-charge-settings') }}">{{ __('Shipping Charge Settings') }}</a>
                                </li>
                            @endcan

                            @can('general-settings-reading')
                                <li class="{{ active_menu('admin-home/general-settings/reading') }}"><a
                                            href="{{ route('admin.general.reading') }}">{{ __('Reading') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-global-navbar')
                                <li class="{{ active_menu('admin-home/general-settings/global-variant-navbar') }}"><a
                                            href="{{ route('admin.general.global.variant.navbar') }}">{{ __('Navbar Global Variant') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-site-identity')
                                <li class="{{ active_menu('admin-home/general-settings/site-identity') }}"><a
                                            href="{{ route('admin.general.site.identity') }}">{{ __('Site Identity') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-basic-settings')
                                <li class="{{ active_menu('admin-home/general-settings/basic-settings') }}"><a
                                            href="{{ route('admin.general.basic.settings') }}">{{ __('Basic Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-color-settings')
                                <li class="{{ active_menu('admin-home/general-settings/color-settings') }}"><a
                                            href="{{ route('admin.general.color.settings') }}">{{ __('Color Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-typography-settings')
                                <li class="{{ active_menu('admin-home/general-settings/typography-settings') }}"><a
                                            href="{{ route('admin.general.typography.settings') }}">{{ __('Typography Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-seo-settings')
                                <li class="{{ active_menu('admin-home/general-settings/seo-settings') }}"><a
                                            href="{{ route('admin.general.seo.settings') }}">{{ __('SEO Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-scripts')
                                <li class="{{ active_menu('admin-home/general-settings/scripts') }}"><a
                                            href="{{ route('admin.general.scripts.settings') }}">{{ __('Third Party Scripts') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-email-template')
                                <li class="{{ active_menu('admin-home/general-settings/email-template') }}"><a
                                            href="{{ route('admin.general.email.template') }}">{{ __('Email Template') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-smtp-settings')
                                <li class="{{ active_menu('admin-home/general-settings/smtp-settings') }}"><a
                                            href="{{ route('admin.general.smtp.settings') }}">{{ __('SMTP Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-payment-gateway')
                                @if (!empty(get_static_option('site_payment_gateway')))
                                    <li class="{{ active_menu('admin-home/general-settings/payment-settings') }}"><a
                                                href="{{ route('admin.general.payment.settings') }}">{{ __('Payment Gateway Settings') }}</a>
                                    </li>
                                @endif
                            @endcan
                            @can('general-settings-custom-css')
                                <li class="{{ active_menu('admin-home/general-settings/custom-css') }}"><a
                                            href="{{ route('admin.general.custom.css') }}">{{ __('Custom CSS') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-custom-js')
                                <li class="{{ active_menu('admin-home/general-settings/custom-js') }}"><a
                                            href="{{ route('admin.general.custom.js') }}">{{ __('Custom JS') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-cache-settings')
                                <li class="{{ active_menu('admin-home/general-settings/cache-settings') }}"><a
                                            href="{{ route('admin.general.cache.settings') }}">{{ __('Cache Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-gdpr-settings')
                                <li class="{{ active_menu('admin-home/general-settings/gdpr-settings') }}"><a
                                            href="{{ route('admin.general.gdpr.settings') }}">{{ __('GDPR Compliant Cookies Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-sitemap-settings')
                                <li class="{{ active_menu('admin-home/general-settings/sitemap-settings') }}"><a
                                            href="{{ route('admin.general.sitemap.settings') }}">{{ __('Sitemap Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-rss-settings')
                                <li class="{{ active_menu('admin-home/general-settings/rss-settings') }}"><a
                                            href="{{ route('admin.general.rss.feed.settings') }}">{{ __('RSS Feed Settings') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-license-setting')
                                <li class="{{ active_menu('admin-home/general-settings/license-setting') }}"><a
                                    href="{{ route('admin.general.license.settings') }}">{{ __('Licence Settings') }}</a>
                                </li>

                                <li class="{{ active_menu('admin-home/general-settings/software-update-setting') }}"><a
                                    href="{{ route('admin.general.software.update.settings') }}">{{ __('Check update') }}</a>
                                </li>
                            @endcan
                            @can('general-settings-license-setting')
                                <li class="{{ active_menu('admin-home/general-settings/database-upgrade') }}"><a
                                    href="{{ route('admin.general.database.upgrade') }}">{{ __('Database update') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('languages')
                    <li class="@if (request()->is('admin-home/languages/*') || request()->is('admin-home/languages')) active @endif">
                        <a href="{{ route('admin.languages') }}" aria-expanded="true"><i class="ti-signal"></i>
                            <span>{{ __('Languages') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
