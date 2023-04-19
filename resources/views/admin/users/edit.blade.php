@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.edit_user') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_user') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.users') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_user') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="card" action="{{ URL::to('admin/users/update-' . $user->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ trans('labels.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $user->name }}" placeholder="{{ trans('labels.name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email_address" class="form-label">{{ trans('labels.email_address') }}</label>
                                <input type="email" class="form-control" id="email_address" name="email_address"
                                    value="{{ $user->email }}" placeholder="{{ trans('labels.email_address') }}">
                                @error('email_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">{{ trans('labels.phone_number') }}</label>
                                <input type="number" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ $user->phone }}" placeholder="{{ trans('labels.phone_number') }}">
                                @error('phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="profile_image">{{ trans('labels.profile_image') }}</label>
                                <input type="file" class="form-control mt-2 mb-4" id="profile_image"
                                    name="profile_image">
                                    @error('profile_image')<span class="text-danger">{{ $message }}</span>@enderror
                                <div class="add-league-img mt-2">
                                    <img src="{{ Helper::image_path($user->image) }}" width="70" height="70"
                                        class="rounded" style="object-fit: cover; object-position:center;">
                                </div>
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
@endsection
