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
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('admin/dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="var(--bs-secondary)" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </a>
                        </li>
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
                                            <span class="visually-hidden">Loading...</span>
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

    {{-- OTP/Email Verification Modal -- START --}}
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
    {{-- OTP/Email Verification Modal -- END --}}
@endsection
@section('scripts')
    <script>
        $('.my-spinner').hide();
        $('#email_address').on('blur', function() {
            "use strict";
            var email = $(this).val();
            // if ($.trim(email) == '') {
            //     return false;
            // }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                url: $(this).attr('data-next'),
                data: {
                    email: email,
                },
                method: 'POST',
                beforeSend: function() {
                    $('.my-spinner').show();
                    $('.btn_submit').attr('disabled', true);
                },
                success: function(response) {
                    $('.my-spinner').hide();
                    $('.btn_submit').attr('disabled', false);
                    if (response.status == 1) {
                        $('#email_address').removeClass('is-invalid')
                        $('#verifyemailmodal .show_email').text(email);
                        $('#verifyemailmodal #show_email').val(email);
                        $('#verifyemailmodal').modal('show');
                    } else {
                        $('#email_address').addClass('is-invalid')
                        toastr.error(response.message);
                        return false;
                    }
                },
                error: function(e) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });
        $('.btn_verify').on('click', function() {
            "use strict";
            $('#otp').removeClass('is-invalid');
            if ($.trim($('#otp').val()) == '') {
                $('#otp').addClass('is-invalid').focus();
                return false;
            }
            var btntext = $(this).html();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                url: $(this).attr('data-next'),
                data: {
                    otp: $('#otp').val(),
                    email: $('#show_email').val(),
                },
                method: 'POST',
                beforeSend: function() {
                    $('.btn_verify').html($('.my-spinner').html());
                },
                success: function(response) {
                    $('.btn_verify').html(btntext);
                    if (response.status == 1) {
                        toastr.error(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                        return false;
                    }
                },
                error: function(e) {
                    $('.btn_verify').html(btntext);
                    toastr.error(wrong);
                    return false;
                }
            });
        });
    </script>
@endsection
