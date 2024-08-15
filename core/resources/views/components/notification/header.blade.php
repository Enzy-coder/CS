@php
    $type = $type ?? 'admin';
@endphp

<div class="single-icon-flex">
    @if(auth('vendor')->check())
        <div class="single-icon notifications-parent">
            <a class="btn btn-outline-danger site-health-btn btn-icon-text" href="{{ route('frontend.vendors.single', auth('vendor')->user()->username ?? "") }}">
                <i class="las la-eye"></i> <span class="d-none d-sm-inline-block">{{ __("Visit Store") }}</span>
            </a>
        </div>
    @elseif(auth('admin')->check())
        <div class="single-icon notifications-parent">
            <a class="btn btn-outline-danger site-health-btn btn-icon-text" href="{{ route('homepage') }}">
                <i class="las la-eye"></i> <span class="d-none d-sm-inline-block">{{ __("Visit Site") }}</span>
            </a>
        </div>
    @endif
  
    @if(auth('admin')->check())
        <div class="single-icon notifications-parent">
            <a class="btn btn-danger site-health-btn btn-icon-text" href="{{ route('admin.health') }}">
                <i class="las la-stethoscope"></i> <span class="d-none d-sm-inline-block">{{ __("Health") }}</span>
            </a>
        </div>
    @endif

    @if (auth('admin')->check())
        @if (auth('admin')->user()->hasRole('Super Admin'))
            @php
                $isDummy=\Modules\Product\Http\Services\Admin\DummyProductDeleteServices::isDummyProduct();
            @endphp
            @if($isDummy)
                <div class="single-icon notifications-parent">
                    <a class="btn btn-danger site-health-btn btn-icon-text" id="remove-dummy-data" href="{{ route('admin.products.delete_dummy_product') }}">
                        <i class="las la-stethoscope"></i> <span class="d-none d-sm-inline-block">{{ __("Remove Dummy Data") }}</span>
                    </a>
                </div>
            @endif
        @endif
    @endif
    <div class="single-icon notifications-parent">
        <span class="notification-icon" id="top-bar-notification-icon"> <i class="las la-bell"></i> </span>
        <div class="notification-list-wrapper">
            <h6 class="notification-title"> {{ __('Notifications') }} </h6>
            <ul class="notification-list">
                @foreach (xgNotifications() as $notification)
                    @php
                        // get model namespace and make a class
                        $namespace = new $notification->model();
                        $productName = '';

                        // this line will be executed when a notification type is product
                        if ($notification->type == 'product') {
                            $productName = $namespace->select('id', 'name')->find($notification->model_id)?->name;
                        }

                        // this method will generate
                        $href = \App\Http\Services\NotificationService::generateUrl($type, $notification);
                    @endphp

                    <li class="list {{ $notification->type == 'stock_out' ? 'bg bg-warning' : '' }}">
                        <div class="notification-list-flex">
                            <div class="notification-icon">
                                <i class="las la-bell"></i>
                            </div>

                            <div class="notification-contents">
                                <a class="list-title" href="{{ $href }}">
                                    {!! str_replace(
                                        ['{product_name}', '{vendor_text}'],
                                        ["<b>$productName</b>", ''],
                                        formatNotificationText(strip_tags($notification->message)),
                                    ) !!} </a>
                                <span class="list-sub"> {{ $notification->created_at->diffForHumans() }} </span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            @if($type == 'vendor')
                <a href="{{ route("vendor.notifications") }}" class="all-notification"> {{ __('See All Notification') }} </a>
            @else
                <a href="{{ route("admin.notifications") }}" class="all-notification"> {{ __('See All Notification') }} </a>
            @endif
        </div>
        <span class="badge-icon" id="top-bar-notification-count"> {{ xgUnReadNotifications() }} </span>
    </div>
</div>
