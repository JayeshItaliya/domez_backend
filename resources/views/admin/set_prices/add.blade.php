@extends('admin.layout.default')
@section('title')
    {{ trans('labels.set_prices') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_new_price') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item" aria-current="page">{{ trans('labels.set_prices') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_new_price') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <form id="storesetprices" action="{{ URL::to('admin/set-prices/store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.dome') }}</label>
                                    <select class="form-select" name="dome" id="dome"
                                        data-next="{{ URL::to('/admin/set-prices/getsports') }}" data-from="add">
                                        @foreach ($getdomeslist as $dome)
                                            <option value="{{ $dome->id }}" data-start-time="{{ $dome->start_time }}" data-end-time="{{ $dome->end_time }}" data-slot-duration="{{ $dome->slot_duration }}" {{ $dome->id == old('dome') ? 'selected' : '' }}>{{ $dome->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('dome')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.select_sports') }}</label>
                                    <select class="form-select" name="sport" id="sport"></select>
                                    @error('sport')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" min="{{ date('Y-m-d') }}" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" disabled>
                                    @error('end_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-3">
                            <p>{{ trans('labels.select_day_wise_price') }} </p>
                        </div>
                        @php
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                        @endphp
                        <div class="slot-days"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a class="btn btn-outline-danger me-3"
                        href="{{ URL::to('admin/set-prices') }}">{{ trans('labels.cancel') }}</a>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        let start_time_title = {{ Js::from(trans('labels.start_time')) }};
        let end_time_title = {{ Js::from(trans('labels.end_time')) }};
        let price = {{ Js::from(trans('labels.price')) }};
        var validatetimeurl = {{ Js::from(URL::to('admin/validate-time')) }};
    </script>
    <script src="{{ url('resources/views/admin/set_prices/set_prices.js') }}"></script>
@endsection
