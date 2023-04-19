@extends('admin.layout.default')
@section('title')
    {{ trans('labels.add_field') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_field') }}</p>
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
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/fields') }}">{{ trans('labels.fields') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_field') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/fields/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" for="dome">{{ trans('labels.select_dome') }}</label>
                            <select class="form-select" name="dome" id="dome"
                                data-next="{{ URL::to('/admin/fields/getsports') }}">
                                @foreach ($dome as $data)
                                    <option value="{{ $data->id }}" class="text-capitalize">{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dome')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="sport_id">{{ trans('labels.select_sport') }}</label>
                            <select class="form-select" name="sport_id" id="sport_id">
                                {{-- @foreach ($getsportslist as $data)
                                    <option value="{{ $data->id }}" class="text-capitalize">{{ $data->name }}
                                    </option>
                                @endforeach --}}
                            </select>
                            @error('sport_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-sm-4">
                    <label class="form-label" for="field_name">{{ trans('labels.field_name') }}</label>
                    <input type="number" id="field_name" name="field_name" value="{{ old('field_name') }}"
                        class="form-control" placeholder="{{ trans('labels.field_name') }}">
                    @error('field_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label">{{ trans('labels.players') }}</label>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select" name="min_person" id="min_person">
                                <option value="" class="text-capitalize" disabled selected>
                                    {{ trans('labels.min_player') }}</option>
                                @for ($i = 1; $i < 100; $i++)
                                    <option value="{{ $i }}" class="text-capitalize">{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('min_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="max_person" id="max_person">
                                <option value="" class="text-capitalize" disabled selected>
                                    {{ trans('labels.max_player') }}
                                </option>
                                @for ($i = 1; $i < 100; $i++)
                                    <option value="{{ $i }}" class="text-capitalize">{{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('max_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-4">
                        <label class="form-label" for="field_area">{{ trans('labels.field_area') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="field_area" name="field_area"
                                placeholder="{{ trans('labels.field_area') }}">
                            <span class="input-group-text">{{ trans('labels.sqft') }}</span>
                        </div>
                        @error('field_area')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-4">
                        <label class="form-label" for="field_image">{{ trans('labels.field_image') }}</label>
                        <input type="file" class="form-control" id="field_image" name="field_image">
                        @error('field_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                    <a href="{{ URL::to('admin/fields') }}"
                        class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('resources/views/admin/field/field.js') }}"></script>
@endsection
