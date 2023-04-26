@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/timepicker/jquery.timepicker.min.css') }}">
@endsection
@section('title')
    {{ trans('labels.add_dome') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.domes') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/domes') }}">{{ trans('labels.domes') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_dome') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/domes/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_name">{{ trans('labels.dome_name') }}</label>
                                <input type="text" id="dome_name" name="dome_name" value="{{ old('dome_name') }}"
                                    class="form-control" placeholder="Please Enter Dome Name">
                                @error('dome_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_hst">{{ trans('labels.hst') }}</label>
                                <div class="input-group">
                                    <input type="number" id="dome_hst" name="dome_hst" class="form-control"
                                        value="{{ old('dome_hst') }}" placeholder="{{ trans('labels.hst') }}">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_time" class="form-label">{{ trans('labels.start_time') }}</label>
                                <input type="text" class="form-control time_picker" name="start_time"
                                    value="{{ old('start_time') }}" id="start_time"
                                    placeholder="{{ trans('labels.start_time') }}" autocomplete="off">
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_time" class="form-label">{{ trans('labels.end_time') }}</label>
                                <input type="text" class="form-control time_picker" name="end_time"
                                    value="{{ old('end_time') }}" id="end_time"
                                    placeholder="{{ trans('labels.end_time') }}" autocomplete="off">
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slot_duration" class="form-label">{{ trans('labels.slot_duration') }}</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="1"
                                            id="slot_duration1" checked>
                                        <label class="form-check-label" for="slot_duration1">
                                            {{ trans('labels.60_minutes') }} </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="2"
                                            id="slot_duration2">
                                        <label class="form-check-label" for="slot_duration2">
                                            {{ trans('labels.90_minutes') }} </label>
                                    </div>
                                </div>
                                @error('slot_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label mb-2">{{ trans('labels.amenities') }}<span
                                        class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="free_wifi" name="benefits[]" value="Free Wifi"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="free_wifi">{{ trans('labels.free_wifi') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="changing_room" name="benefits[]"
                                                value="Changing Room" class="form-check-input">
                                            <label class="form-check-label"
                                                for="changing_room">{{ trans('labels.changing_room') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="parking" name="benefits[]" value="Parking"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="parking">{{ trans('labels.parking') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="pool" name="benefits[]" value="Pool"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="pool">{{ trans('labels.pool') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="others" name="benefits[]" value="Others"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="others">{{ trans('labels.others') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label"
                                    for="benefits_description">{{ trans('labels.amenities_description') }}<span
                                        class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <textarea class="form-control" name="benefits_description" value="{{ old('benefits_description') }}"
                                    id="benefits_description" rows="4" placeholder="Please Enter Benefits Description">{{ old('benefits_description') }}</textarea>
                                @error('benefits_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="address">{{ trans('labels.dome_address') }}</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                    id="address" placeholder="{{ trans('labels.dome_address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pin_code" class="form-label">{{ trans('labels.pincode') }}</label>
                                <input type="text" class="form-control" name="pin_code" id="pin_code"
                                    value="{{ old('pin_code') }}" placeholder="{{ trans('labels.pincode') }}" readonly>
                                @error('pin_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city" class="form-label">{{ trans('labels.city') }}</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    value="{{ old('city') }}" placeholder="{{ trans('labels.city') }}" readonly>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state" class="form-label">{{ trans('labels.state') }}</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    value="{{ old('state') }}" placeholder="{{ trans('labels.state') }}" readonly>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country" class="form-label">{{ trans('labels.country') }}</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="{{ old('country') }}" placeholder="{{ trans('labels.country') }}" readonly>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="textLat" value="">
                    <input type="hidden" name="lng" id="textLng" value="">
                    @error('lat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('lng')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div id="map_canvas" class="w-auto" style="height: 250px;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_images">{{ trans('labels.dome_images') }}</label>
                                <input type="file" class="form-control" id="dome_images" name="dome_images[]"
                                    multiple>
                                @error('dome_images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">{{ trans('labels.select_sports') }}</label>
                            <div class="row">
                                @foreach ($getsportslist as $data)
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="{{ $data->name }}" name="sport_id[]"
                                                class="form-check-input" value="{{ $data->id }}"
                                                data-sport-name="{{ $data->name }}">
                                            <label class="form-check-label"
                                                for="{{ $data->name }}">{{ $data->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('sport_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for=""
                                class="form-label default-price-title">{{ trans('labels.sport_default_price') }}</label>
                            <div class="row row-cols-md-4" id="sport_prices_input"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label"
                                    for="description">{{ trans('labels.dome_description') }}</label>
                                <textarea class="form-control" name="description" value="{{ old('description') }}" id="description" rows="5"
                                    placeholder="{{ trans('labels.dome_description') }}" maxlength="100"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                    <a href="{{ URL::to('admin/domes') }}"
                        class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/timepicker/jquery.timepicker.min.js') }}" defer=""></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCvlZaKvRSMouyH9pDgGC6pMGADfytOrsA">
    </script>
    <script type="text/javascript">
        $('input[data-sport-name]').click(function() {
            if ($('input[data-sport-name]:checked').length > 0) {
                $('.default-price-title').show();
            } else {
                $('.default-price-title').hide();
            }
            if (this.checked) {
                let html = '<div class="col mb-2" id="' + $(this).attr("data-sport-name") + '' + $(this).val() +
                    '"><label class="form-label" for="dome_price' + $(this).val() + '">' + $(this).attr(
                        "data-sport-name") +
                    '</label><div class="input-group"><span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar"></i></span><input type="number" class="form-control" id="dome_price' +
                    $(this).val() +
                    '" name="dome_price[]" placeholder="Price" value="0" required></div></div>';
                $('#sport_prices_input').append(html);
            } else {
                $('#' + $(this).attr("data-sport-name") + '' + $(this).val()).remove();
            }
        });
    </script>
    <script src="{{ url('resources/views/admin/domes/domes.js') }}"></script>
@endsection
