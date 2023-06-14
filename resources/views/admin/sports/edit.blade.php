@extends('admin.layout.default')
@section('title')
    {{ trans('labels.edit_sports') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_sports') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/sports') }}">{{ trans('labels.sports') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_sports') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="card" action="{{ URL::to('admin/sports/update-') . $sportsdata->id }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">{{ trans('labels.sports_name') }}</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ !empty(old('name')) ? old('name') : $sportsdata->name }}" placeholder="{{ trans('labels.sports_name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">{{ trans('labels.image') }}</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span> <br>
                                    @enderror
                                    <img src="{{ Helper::image_path($sportsdata->image) }}" alt="category image" class="avatar avatar-lg my-3"><br>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                                <a href="{{ URL::to('admin/sports') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
