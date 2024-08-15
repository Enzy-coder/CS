@extends('backend.admin-master')
@section('style')
    <x-media.css/>
    <x-datatable.css/>
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
@endsection
@section('site-title')
    {{__('All Users')}}
@endsection
@section('content')
    <x-msg.error/>
    <x-msg.success/>

    <div class="col-12">
        <div class="dashboard__card">
                <div class="dashboard__card__header">
                    <h4 class="dashboard__card__title">{{__('All Users')}}</h4>
                    @can('frontend-all-user-bulk-action')
                        <div class="bulk-delete-wrapper">
                            <div class="select-box-wrap">
                                <select name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="dashboard__card__body mt-4">
                    <div class="data-tables datatable-primary">
                        <table id="all_user_table" class="text-center">
                            <thead class="text-capitalize">
                            <tr>
                                @can("frontend-all-bulk-action")
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                @endcan
                                <x-bulk-action.th />
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all_user as $data)
                                <tr>
                                    @can('units-bulk-action')
                                        <td>
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                    @endcan

                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}} ({{$data->username}})</td>
                                    <td>{{$data->email}} @if($data->email_verified == 1) <i class="las la-check-circle text-success"></i> @endif</td>

                                    <td>
                                        @can('frontend-delete-user')
                                            <x-delete-popover :url="route('admin.frontend.delete.user',$data->id)"/>
                                        @endcan
                                        @can('frontend-user-update')
                                            <a href="#1"
                                            data-id="{{$data->id}}"
                                            data-username="{{$data->username}}"
                                            data-name="{{$data->name}}"
                                            data-email="{{$data->email}}"
                                            data-phone="{{$data->phone}}"
                                            data-address="{{$data->address}}"
                                            data-state="{{$data->state}}"
                                            data-city="{{$data->city}}"
                                            data-zipcode="{{$data->zipcode}}"
                                            data-country="{{$data->country}}"
                                            data-email_verified="{{$data->email_verified}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#user_edit_modal"
                                            class="btn btn-primary btn-sm mb-2 me-1 user_edit_btn">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        @endcan

                                        @can("frontend-user-password-change")
                                            <a href="#1"
                                            data-id="{{$data->id}}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#user_change_password_modal"
                                            class="btn btn-secondary btn-sm mb-2 me-1 user_change_password_btn"
                                            >
                                                {{__("Change Password")}}
                                            </a>
                                        @endcan
                                        @can("frontend-all-user-email-status")
                                            <form action="{{route('admin.all.frontend.user.email.status')}}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$data->id}}" name="user_id">
                                                <input type="hidden" value="{{$data->email_verified}}" name="email_verified">
                                                <button type="submit" class="btn btn-sm @if($data->email_verified == 1)  btn-dark @else btn-warning @endif">
                                                    @if($data->email_verified == 1) {{__('Enable Email Verify')}} @else {{__('Disable Email Verify')}} @endif
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    @can("frontend-user-update")
        <div class="modal fade" id="user_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('User Details Edit')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{route('admin.frontend.user.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="user_id">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{__('Phone')}}</label>
                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="{{__('Phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="country">{{__('Country')}}</label>
                                {{-- {!! get_country_field('country','country','form-control') !!} --}}
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
                                <label for="state">{{__('State')}}</label>
                                <select id="state_id" name="state">
                                    <option value="">{{ __("Select State") }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">{{__('City')}}</label>
                                <select id="city_id" name="city" >
                                    <option value="">{{ __("Select City") }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="zipcode">{{__('Zipcode')}}</label>
                                <input type="text" class="form-control"  id="zipcode" name="zipcode" placeholder="{{__('Zipcode')}}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('Address')}}</label>
                                <input type="text" class="form-control"  id="address" name="address" placeholder="{{__('Address')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button id="update" type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can("frontend-user-password-change")
        <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.frontend.user.password.change')}}" id="user_password_change_modal_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="ch_user_id" id="ch_user_id">
                            <div class="form-group">
                                <label for="password">{{__('Password')}}</label>
                                <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{__('Confirm Password')}}</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button id="update" type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
    <x-media.markup/>
@endsection

@section('script')
    <x-datatable.js/>
    <script>
        (function($){
            "use strict";
            $(document).ready(function() {
                <x-btn.submit/>
                <x-btn.update/>
                $(document).on('click','#bulk_delete_btn',function (e) {
                    e.preventDefault();

                    var bulkOption = $('#bulk_option').val();
                    var allCheckbox =  $('.bulk-checkbox:checked');
                    var allIds = [];
                    allCheckbox.each(function(index,value){
                        allIds.push($(this).val());
                    });
                    if(allIds != '' && bulkOption == 'delete'){
                        $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i>{{__("Deleting")}}');
                        $.ajax({
                            'type' : "POST",
                            'url' : "{{route('admin.all.frontend.user.bulk.action')}}",
                            'data' : {
                                _token: "{{csrf_token()}}",
                                ids: allIds
                            },
                            success:function (data) {
                                location.reload();
                            }
                        });
                    }

                });

                $('.all-checkbox').on('change',function (e) {
                    e.preventDefault();
                    var value = $('.all-checkbox').is(':checked');
                    var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                    //have write code here fr
                    if( value == true){
                        allChek.prop('checked',true);
                    }else{
                        allChek.prop('checked',false);
                    }
                });

                $(document).on('click','.user_change_password_btn',function(e){
                    e.preventDefault();
                    var el = $(this);
                    var form = $('#user_password_change_modal_form');
                    form.find('#ch_user_id').val(el.data('id'));
                });
                $('#all_user_table').DataTable( {
                    "order": [[ 1, "desc" ]],
                    'columnDefs' : [{
                        'targets' : 'no-sort',
                        'orderable' : false
                    }]
                } );
            } );

            $(document).on('click','.user_edit_btn',function(e){
                    e.preventDefault();
                    const form = $('#user_edit_modal_form');
                    const el = $(this);

                    form.find('#user_id').val(el.data('id'));
                    form.find('#name').val(el.data('name'));
                    form.find('#username').val(el.data('username'));
                    form.find('#email').val(el.data('email'));
                    form.find('#phone').val(el.data('phone'));
                    form.find('#state_id').attr("data-state-id", el.data('state'));
                    form.find('#city_id').attr("data-city-id",el.data('city'));
                    form.find('#zipcode').val(el.data('zipcode'));
                    form.find('#address').val(el.data('address'));
                    form.find('#country option[value="'+el.data('country')+'"]').attr('selected',true).trigger('change');
            });

            $(document).on("change", "#country", function() {
                let data = new FormData();
                data.append("country_id", $(this).val());
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", data, "{{ route('admin.vendor.get.state') }}", function() {}, (data) => {
                    $("#state_id").html("<option value=''>{{ __("Select an state") }}</option>" + data.option);
                    $("#state_id").val($("#state_id").attr('data-state-id')).trigger('change');
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
                    $("#city_id").val($("#city_id").attr('data-city-id')).trigger('change');
                    $(".city_wrapper .list").html(data.li);
                }, (data) => {
                    prepare_errors(data);
                })
            });
        })(jQuery)
    </script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <x-media.js/>
@endsection
