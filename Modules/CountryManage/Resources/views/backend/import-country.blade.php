@extends('backend.admin-master')
@section('site-title')
    {{__('Import Countries')}}
@endsection
@section('style')
    <style>
        .form-control[type=file]:not(:disabled):not([readonly]) {
            padding-top: 12px!important;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <x-msg.error />
        <x-msg.flash />
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Import Country (only csv file)') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(empty($import_data))
                            <form action="{{route('admin.country.import.csv.update.settings')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="#" class="label-title">{{__('File')}}</label>
                                    <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                                    <small class="text-info">{{__('only csv file are allowed with separate by (,) comma.')}}</small>
                                </div>
                                <button type="submit" class="cmn_btn btn_bg_profile mt-4 loading-btn">{{__('Submit')}}</button>
                            </form>
                        @else
                            @php
                                $option_markup = '';
                                    foreach(current($import_data) as $map_item ){
                                        $option_markup .= '<option value="'.trim($map_item).'">'.$map_item.'</option>';
                                    }
                            @endphp
                            <form action="{{route('admin.country.import.database')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table class="table table-striped">
                                    <thead>
                                    <th style="width: 200px">{{{__('Field Name')}}}</th>
                                    <th>{{{__('Set Field')}}}</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><h6>{{__('Title')}}</h6></td>
                                        <td>
                                            <div class="form__input__single">
                                                <select class="form-control select2_activation mapping_select">
                                                    <option value="">{{__('Select Field')}}</option>
                                                    {!! $option_markup !!}
                                                </select>
                                                <input type="hidden" name="country">
                                            </div>
                                            <p class="text-info">{{ __('Select country and only unique countries added automatically') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h6>{{__('Status')}}</h6></td>
                                        <td>
                                            <div class="form__input__single">
                                                <select class="form-control">
                                                    <option value="publish">{{__('Publish')}}</option>
                                                    <option value="draft">{{__('Draft')}}</option>
                                                </select>
                                                <input type="hidden" name="status" value="publish">
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="cmn_btn btn_bg_profile mt-4 loading-btn">{{__('Import')}}</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                $(document).on('click','.loading-btn',function (){
                    $(this).append('<i class="ml-2 fas fa-spinner fa-spin"></i>')
                });

                $(document).on('change','.mapping_select',function (){
                    $('.mapping_select option').attr('disabled',false);
                    $(this).next('input').val($(this).val());
                    let allValue = $('.mapping_select');
                    $.each(allValue,function (index,item){
                        $('.mapping_select option[value="'+$(this).val()+'"]').attr('disabled',true);
                    });

                })
            });
        }(jQuery));
    </script>
@endsection
