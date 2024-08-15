<div class="dashboard-top-contents mb-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="top-inner-contents search-area top-searchbar-wrapper">
                <div class="dashboard-flex-contetns">
                    <div class="dashboard-left-flex">
                        <span class="date-text"> 20 Jan, 2022 07:20pm </span>
                        <div class="d-flex align-items-center">
                            <h2 class="heading-two fw-500 mt-2"> Welcome, Happy Hour </h2>
                            <h2 class="mt-2 fw-500">&nbsp;- {{ auth('vendor')->user()->owner_name }}</h2>
                        </div>
                    </div>
                    <div class="dashboard-right-flex">
                        <div class="author-flex-contents">
                            <div class="author-icon">
                                <div class="single-icon-flex">
                                    <div class="single-icon notifications-parent">
                                        <x-notification.header type="vendor" />
                                    </div>
                                </div>
                            </div>
                            <div class="author-thumb-contents">
                                <div class="author-thumb">
                                    @php
                                        $vendor = auth()
                                            ->guard('vendor')
                                            ->user();
                                        $profile_img = get_attachment_image_by_id($vendor->image, null, true);
                                    @endphp
                                    @if (!empty($profile_img))
                                        <img src="{{ $profile_img['img_url'] }}" alt="{{ $vendor->owner_name }}">
                                    @else
                                        <i class="las la-user"></i>
                                    @endif
                                </div>

                                <ul class="author-account-list">
                                    <li class="list"><a
                                            href="{{ route('vendor.profile.update') }}">{{ __('Edit Profile') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('vendor.password.change') }}">{{ __('Password Change') }}</a>
                                    </li>
                                    <li class="list"><a href="{{ route('vendor.logout') }}">{{ __('Logout') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
