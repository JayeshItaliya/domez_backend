@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.edit_profile') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_profile') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.general_settings') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_profile') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="card" action="{{ URL::to('admin/settings/update-profile') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('labels.name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ Auth::user()->name }}" placeholder="{{ trans('labels.name') }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email_address" class="form-label">{{ trans('labels.email_address') }}</label>
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" id="email_address"
                                        value="{{ Auth::user()->email }}"
                                        placeholder="{{ trans('labels.email_address') }}"
                                        data-next="{{ URL::to('admin/settings/check-email-exist') }}" required>
                                    <span class="input-group-text my-spinner" id="basic-addon1">
                                        <div class="spinner-border spinner-border-sm text-dark" role="status">
                                            <span class="visually-hidden">{{ trans('labels.loading') }}</span>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ trans('labels.phone_number') }}</label>
                                <input type="number" name="phone" class="form-control" id="phone"
                                    value="{{ Auth::user()->phone }}" placeholder="{{ trans('labels.phone_number') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ trans('labels.profile_image') }}
                                    {{ trans('labels.optional') }}</label>
                                <input type="file" class="form-control mt-2" name="profile">
                                @error('profile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <img src="{{ Helper::image_path(Auth::user()->image) }}" width="100"
                                    class="object-fit-contain rounded mt-2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn_submit">{{ trans('labels.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <form class="card mt-3" action="{{ URL::to('admin/settings/change-password') }}" method="post">
                @csrf
                <div class="p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="current_password"
                                    class="form-label">{{ trans('labels.current_password') }}</label>
                                <input type="password" name="current_password" class="form-control" id="current_password"
                                    placeholder="{{ trans('labels.current_password') }}">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">{{ trans('labels.new_password') }}</label>
                                <input type="password" name="new_password" class="form-control" id="new_password"
                                    placeholder="{{ trans('labels.new_password') }}">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="confirm_password"
                                    class="form-label">{{ trans('labels.confirm_password') }}</label>
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm_password" placeholder="{{ trans('labels.confirm_password') }}">
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="verifyemailmodal" tabindex="-1" aria-labelledby="verifyemailmodalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyemailmodalLabel">{{ trans('labels.verification') }}</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <p class="text-muted fw-bold show_email"></p>
                                <input type="hidden" id="show_email">
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="{{ trans('labels.otp') }}"
                                        name="otp" id="otp">
                                    <button class="btn btn-primary btn_verify"
                                        data-next="{{ URL::to('admin/settings/verify-email') }}">{{ trans('labels.verify') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('resources/views/admin/settings/settings.js') }}"></script>
@endsection
