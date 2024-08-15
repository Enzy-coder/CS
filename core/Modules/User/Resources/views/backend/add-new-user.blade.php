@extends('backend.admin-master')
@section('site-title')
    {{ __('Add New User') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        @include('backend/partials/message')
        @include('backend/partials/error')
        <div class="row">
            <!-- basic form start -->
            <div class="col-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('New User') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('admin.frontend.new.user') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Enter name') }}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{ __('Username') }}</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="{{ __('Username') }}">
                                <small
                                    class="text text-danger">{{ __('Remember this username, user will login using this username') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="{{ __('Email') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="{{ __('Phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="country">{{ __('Country') }}</label>
                                {{-- {!! get_country_field('country', 'country', 'form-control') !!} --}}
                                <select id="country" name="country">
                                    <option value="">{{ __("Select Country") }}</option>
                                    @foreach ($country as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="state">{{ __('State') }}</label>
                                <select id="state_id" name="state">
                                    <option value="">{{ __("Select State") }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">{{ __('City') }}</label>
                                <select id="city_id" name="city" >
                                    <option value="">{{ __("Select City") }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">{{ __('Zipcode') }}</label>
                                <input type="text" class="form-control" id="zipcode" name="zipcode"
                                    placeholder="{{ __('Zipcode') }}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="{{ __('Address') }}">
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="{{ __('Password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Password Confirm') }}</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="{{ __('Password Confirmation') }}">
                            </div>
                            <button type="submit" class="cmn_btn btn_bg_profile mt-4">{{ __('Add New User') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
<script>
    $(document).on("change", "#country", function() {
            let data = new FormData();

            data.append("country_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('admin.vendor.get.state') }}", function() {}, (data) => {
                $("#state_id").html("<option value=''>{{ __("Select an state") }}</option>" + data.option);
                $(".state_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("change", "#state_id", function() {
            let data = new FormData();

            data.append("country_id", $("#country").val());
            data.append("state_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('admin.vendor.get.city') }}", function() {}, (data) => {
                $("#city_id").html("<option value=''>{{ __("Select an city") }}</option>" + data.option);
                $(".city_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });
</script>
@endsection