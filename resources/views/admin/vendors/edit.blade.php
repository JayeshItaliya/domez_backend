@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_owners') }} | {{ trans('labels.edit') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>{{ trans('labels.edit') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ URL::to('admin/vendors') }}"
                                class="text-dark">{{ trans('labels.dome_owners') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/vendors/update-') . $user->id }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ trans('labels.name') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{ trans('labels.name') }}"
                            class="form-control" value="{{ !empty(old('name')) ? old('name') : $user->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">{{ trans('labels.email') }}</label>
                        <input type="text" id="email" name="email" placeholder="{{ trans('labels.email') }}"
                            class="form-control" value="{{ !empty(old('email')) ? old('email') : $user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="form-label">{{ trans('labels.phone_number') }}</label>
                        <div class="input-group">
                            <input type="hidden" name="country" id="country" value="91">
                            <input type="tel" id="phone" name="phone"
                                class="form-control custom-input rounded mb-3"
                                placeholder="{{ trans('labels.phone_number') }}" value="{{ !empty(old('country')) ? old('country') : $user->phone }}">
                        </div>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="profile" class="form-label"> {{ trans('labels.profile_image') }} <span
                                class="fs-8 text-muted">{{ trans('labels.optional') }}</span></label>
                        <input type="file" name="profile" id="profile" class="form-control">
                        @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-auto me-2">{{ trans('labels.submit') }}</button>
            <a href="{{ URL::to('admin/vendors') }}"
                class="btn btn-outline-danger w-auto">{{ trans('labels.cancel') }}</a>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/intelTelInput/intlTelInput.min.js') }}"></script>
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/js/intelTelInput/intlTelInput.min.css') }}">
    <script src="{{ url('storage/app/public/admin/js/intelTelInput/utils.js') }}"></script>
    <script>
        var input = $('#phone');
        var iti = intlTelInput(input.get(0))
        iti.setCountry("ca");
        input.on('countrychange', function(e) {
            $('#country').val(iti.getSelectedCountryData().dialCode);
        });
        $('.iti--allow-dropdown').addClass('w-100');
    </script>
@endsection
