@extends('backend.admin-master')
@section('style')
    <x-datatable.css />
@endsection
@section('site-title')
    {{ __('My Orders') }}
@endsection
@section('content')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h4 class="dashboard__card__title">{{ __('My Orders') }}</h4>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="table-wrap table-responsive all-user-campaign-table">
                <div class="order-history-inner text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Order') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Order Status') }}</th>
                                <th>{{ __('Payment Status') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_orders as $order)
                                <tr class="completed">
                                    <td class="order-numb">
                                        #{{ $order->id }}
                                    </td>
                                    <td class="date">
                                        {{ $order->created_at->format('F d, Y') }}
                                    </td>
                                    <td class="status">
                                        @if ($order->order_status == 'complete' && $order->orderTrack?->first()->name == 'delivered')
                                            <span class="badge bg-success px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($order->order_status == 'canceled')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @else
                                            <span class="badge bg-secondary px-2 py-1 text-capitalize">{{ $order->orderTrack?->first()->name ?? "pending" }}</span>
                                        @endif
                                    </td>
                                    <td class="status">
                                        @if ($order->payment_status == 'complete')
                                            <span class="badge bg-success px-2 py-1">{{ __('Complete') }}</span>
                                        @elseif ($order->payment_status == 'pending')
                                            <span class="badge bg-warning px-2 py-1">{{ __('Pending') }}</span>
                                        @elseif ($order->payment_status == 'canceled')
                                            <span class="badge bg-danger px-2 py-1">{{ __('Canceled') }}</span>
                                        @endif
                                    </td>
                                    <td class="amount">
                                        {{ float_amount_with_currency_symbol($order->paymentMeta->total_amount ?? 0) }}
                                    </td>
                                    <td class="table-btn">
                                        <div class="btn-wrapper d-flex flex-wrap gap-2">
                                            @can('orders-generate-invoice')
                                                <a href="{{ route('admin.orders.generate.invoice', $order->id) }}"
                                                    class="btn btn-warning rounded-btn">
                                                    <i class="las la-file-invoice"></i>
                                                </a>
                                            @endcan
                                            @can('orders-download-invoice')
                                                <a href="{{ route('admin.orders.download.invoice', $order->id) }}"
                                                    class="btn btn-warning rounded-btn">
                                                    <i class="las la-download"></i>
                                                </a>
                                            @endcan
                                            @can('orders-update')
                                                <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                    class="btn btn-primary rounded-btn">
                                                    <i class="las la-pen-nib"></i>
                                                </a>
                                            @endcan
                                            @can('orders-details')
                                                <a href="{{ route('admin.orders.order.details', $order->id) }}"
                                                    class="btn btn-secondary rounded-btn">
                                                    {{ __('view details') }}
                                                </a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination">
                {!! $all_orders->links() !!}
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
