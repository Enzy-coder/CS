@extends('frontend.user.dashboard.user-master')
@section('section')
    @if ($all_shipping_address && $all_shipping_address->count())
        <div class="dashboard__card__shipping">
            <div class="dashboard__card__header">
                <h4 class="dashboard__card__title">{{ __('My Shipping Address') }}</h4>
                <div class="btn-wrapper">
                    <a href="{{ route('user.shipping.address.new') }}"
                        class="cmn_btn btn_bg_2">{{ __('Add Shipping Address') }}</a>
                </div>
            </div>
            <div class="dashboard__card__body mt-4">
                <div class="table-responsive table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_shipping_address as $address)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $address->name }}</td>
                                    <td>{{ $address->address }}</td>
                                    <td>
                                        <x-table.btn.swal.delete :route="route('shipping.address.delete', $address->id)" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {!! $all_shipping_address->links() !!}
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            {{ __('No Shipping Address Found. ') }}
            <a class="btn btn-link" href="{{ route('user.shipping.address.new') }}">{{ __('Create New?') }}</a>
        </div>
    @endif
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>
    <x-table.btn.swal.js />

    <script>
        $(document).ready(function() {
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });
            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });
        });
    </script>
@endsection
