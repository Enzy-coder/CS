@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-datatable.css />
@endsection
@section('site-title')
    {{ __('My Orders') }}
@endsection
@section('section')
    <div class="dashboard__card__refund">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('My Refund Request') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap table-responsive all-user-campaign-table">
                <div class="order-history-inner text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('SL NO') }}</th>
                                <th>{{ __('Order Info') }}</th>
                                <th>{{ __('Refund Info') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($refundRequests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="user-info text-center">
                                            <b>#{{ $request->order?->id }}</b><br>
                                            {{ __('Status') }} {{ $request->order?->order_status }}<br>
                                            {{ __('Amount') }}
                                            {{ float_amount_with_currency_symbol($request->order?->paymentMeta?->total_amount) }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        <span class="user-info text-center">
                                            <b>#{{ $request->id }}</b><br>
                                            {{ __('Status') }}:
                                            {{ __(ucwords(str_replace('_', ' ', $request->currentTrackStatus?->name))) }}<br>
                                            {{ __('Total Product:') }} {{ $request->request_product_count }}<br>
                                        </span>
                                    </td>

                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm"
                                            href="{{ route('user.product.refund-request.view', $request->id) }}">{{ __('View') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {!! $refundRequests->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '{{ __('Are you sure?') }}',
                        text: '{{ __('You would not be able to revert this item!') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });
            })
        })(jQuery)
    </script>

    <x-datatable.js />
@endsection
