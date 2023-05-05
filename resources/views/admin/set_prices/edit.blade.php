@extends('admin.layout.default')
@section('title')
    {{ trans('labels.set_prices') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.set_prices') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item " aria-current="page">{{ trans('labels.set_prices') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_set_price') }}</li>
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
                                        data-next="{{ URL::to('/admin/set-prices/getsports') }}" data-from="edit">
                                        @foreach ($getdomeslist as $dome)
                                            <option value="{{ $dome->id }}"
                                                {{ $getslotpricedata->dome_id == $dome->id ? 'selected' : '' }}>
                                                {{ $dome->name }}</option>
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
                                    <select class="form-select" name="sport" id="sport"
                                        data-sport-selected="{{ $getslotpricedata->sport_id }}">
                                    </select>
                                    @error('sport')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                    <input type="date" class="form-control" name="start_date"
                                        value="{{ $getslotpricedata->start_date }}" id="start_date"
                                        min="{{ date('Y-m-d') }}" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                    <input type="date" class="form-control" name="end_date"
                                        value="{{ $getslotpricedata->end_date }}" id="end_date">
                                    @error('end_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($getdata as $data)
                                <div class="col-md-4">
                                    <h2>{{ Helper::date_format($data->date) }}</h2>
                                    <h4>{{ date('l', strtotime($data->date)) }}</h4>
                                    @php
                                        // $getslots = App\Models\SetPricesDaysSlots::where('set_prices_id', $data->id)->where('dome_id', $data->dome_id)->where('sport_id', $data->sport_id)->whereDate('date', strtotime($data->date))->get();
                                        $getslots = App\Models\SetPricesDaysSlots::where('dome_id', $data->dome_id)
                                            ->where('sport_id', $data->sport_id)
                                            ->whereDate('date', date('Y-m-d', strtotime($data->date)))
                                            ->get();
                                    @endphp
                                    @foreach ($getslots as $slot)
                                        <p> {{ date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time)) }}
                                        </p>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>


                        {{-- <div class="col-md-12 my-3">
                            <p>{{ trans('labels.select_day_wise_price') }}</p>
                        </div>
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="{{ $getslotpricedata->id }}">
                            @foreach ($getdaysslots as $dayname)
                                <div class="col-md-6">
                                    <input type="hidden" name="daynames[]" value="{{ $dayname['day'] }}">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col-md-11">
                                                    <h6>{{ ucfirst($dayname['day']) }}</h6>
                                                </div>
                                                <div class="col-md-1">
                                                    <a class="btn-custom-primary cursor-pointer appendbtn"
                                                        data-day-name="{{ $dayname['day'] }}">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($dayname['slots'] as $slot)
                                                <div class="row my-2">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control start time_picker border-end-0"
                                                                    name="start_time[{{ $dayname['day'] }}][]"
                                                                    value="{{ date('h:i A', strtotime($slot->start_time)) }}"
                                                                    placeholder="{{ trans('labels.start_time') }}" />
                                                                <span
                                                                    class="input-group-text bg-transparent border-start-0"><i
                                                                        class="fa-regular fa-clock"></i> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control end time_picker border-end-0"
                                                                    name="end_time[{{ $dayname['day'] }}][]"
                                                                    value="{{ date('h:i A', strtotime($slot->end_time)) }}"
                                                                    placeholder="{{ trans('labels.end_time') }}" />
                                                                <span
                                                                    class="input-group-text bg-transparent border-start-0"><i
                                                                        class="fa-regular fa-clock"></i> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control border-end-0"
                                                                    name="price[{{ $dayname['day'] }}][]"
                                                                    value="{{ $slot->price }}"
                                                                    placeholder="{{ trans('labels.price') }}">
                                                                <span
                                                                    class="input-group-text bg-transparent border-start-0">
                                                                    <i class="fa-solid fa-dollar-sign"></i> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <a class="btn-custom-danger cursor-pointer"
                                                                @if (count($dayname['slots']) > 1) onclick="deletedata({{ $slot->id }},'{{ URL::to('admin/set-prices/delete-slot') }}')" @else disabled @endif>
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="{{ $dayname['day'] }} extra_fields"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> --}}
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a class="btn btn-outline-danger me-3"
                        href="{{ URL::to('admin/set-prices') }}">{{ trans('labels.cancel') }}</a>
                    <button type="button" class="btn btn-primary">{{ trans('labels.submit') }}</button>
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
