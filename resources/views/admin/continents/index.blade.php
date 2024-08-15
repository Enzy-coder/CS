@extends('backend.admin-master')
@section('site-title')
    {{ __('Continent') }}
@endsection
@section('style')
    <x-datatable.css />
    <x-bulk-action.css />
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <x-msg.error />
        <x-msg.flash />
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('All Continents') }}</h4>
                        <div class="dashboard__card__header__right">
                                <x-bulk-action.dropdown />
                                <div class="btn-wrapper">
                                    <button class="cmn_btn btn_bg_profile" data-bs-toggle="modal"
                                        data-bs-target="#continent_new_modal">{{ __('Add Continent') }}</button>
                                </div>
                        </div>
                    </div>
                    <div class="dashboard__card__body mt-4">
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                        <x-bulk-action.th />
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Header Image') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($all_continents as $continent)
                                        <tr>
                                                <x-bulk-action.td :id="$continent->id" />
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $continent->name }}</td>
                                            <td>{{ $continent->description }}</td>
                                            <td><x-status-span :status="$continent->status" /></td>
                                            <td><img src="{{ asset('storage/' . $continent->header_image) }}" width="50" /></td>
                                            <td>
                                                    <x-table.btn.swal.delete :route="route('admin.continent.delete', $continent->id)" />
                                                    <a href="#1" data-bs-toggle="modal"
                                                        data-bs-target="#continent_edit_modal"
                                                        class="btn btn-primary btn-sm btn-xs mb-2 me-1 continent_edit_btn"
                                                        data-id="{{ $continent->id }}" data-name="{{ $continent->name }}"
                                                        data-description="{{ $continent->description }}"
                                                        data-status="{{ $continent->status }}"
                                                        data-header_image="{{ asset('storage/' . $continent->header_image) }}">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="continent_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Update Continent') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{ route('admin.continent.update') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="continent_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="edit_name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    placeholder="{{ __('Name') }}">
                            </div>
                            <div class="form-group">
                                <label for="edit_description">{{ __('Description') }}</label>
                                <textarea class="form-control" id="edit_description" name="description"
                                    placeholder="{{ __('Description') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_status">{{ __('Status') }}</label>
                                <select name="status" class="form-control" id="edit_status">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_header_image">{{ __('Header Image') }}</label>
                                <input type="file" class="form-control" id="edit_header_image" name="header_image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Save Change') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="continent_new_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content custom__form">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add New Continent') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="{{ route('admin.continent.new') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Name') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description"
                                    placeholder="{{ __('Description') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="publish">{{ __('Publish') }}</option>
                                    <option value="draft">{{ __('Draft') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="header_image">{{ __('Header Image') }}</label>
                                <input type="file" class="form-control" id="header_image" name="header_image">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Add New') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
    <x-datatable.js />
    <x-table.btn.swal.js />

    <script>
        $(document).ready(function() {
            $(document).on('click', '.continent_edit_btn', function() {
                let el = $(this);
                let id = el.data('id');
                let name = el.data('name');
                let description = el.data('description');
                let status = el.data('status');
                let modal = $('#continent_edit_modal');

                modal.find('#continent_id').val(id);
                modal.find('#edit_status option[value="' + status + '"]').attr('selected', true);
                modal.find('#edit_name').val(name);
                modal.find('#edit_description').val(description);
            });
        });
    </script>
@endsection
