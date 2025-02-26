@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

    <style>
        .ui-timepicker-container {
            z-index: 9999 !important;
        }
        .custom-tooltip {
            background: white;
            backdrop-filter: blur(5px);
            border-radius: 15px;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
            border: none;
        }
    </style>
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
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/domes') }}">{{ trans('labels.domes') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_dome') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/domes/store') }}" method="post" enctype="multipart/form-data"
        id="adddome">
        @csrf
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col-md-auto">
                    <div class="text-start">
                        <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#add_working_hours">{{ trans('labels.add_working_hours') }}</button>
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#dome_settings">{{ trans('labels.add_discounts') }}</button>
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#policies_rules">{{ trans('labels.policies_rules') }}</button>
                    </div>
                </div>

                {{-- <p data-bs-toggle="popover" data-bs-placement="top" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-content="Default Tooltip">{{ trans('labels.system_mode') }}<i class="fa-regular fa-circle-info fa-beat-fade ps-2"></i></p> --}}

                <div class="col-md-auto h-fit-content pe-0">
                    <p data-bs-toggle="popover" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" data-bs-trigger="hover focus" data-bs-html="true" data-bs-title="<b>Automatic Mode:</b> Customers can book automatically and directly from the app without the need to approve or decline them.<br><br> <b>Manual Mode:</b> Customers send booking requests to be approved or declined from your side before they proceed to make the payment">{{ trans('labels.system_mode') }}<i class="fa-regular fa-circle-info fa-beat-fade ps-2"></i></p>
                </div>
                <div class="col-md-auto">
                    <label class="system-mode-switch">
                        <input type="checkbox" class="d-none cursor-pointer" name="booking_mode" value="2" id="booking_mode" {{ old('booking_mode') == 2 ? 'checked' : '' }}>
                        <div class="slider round">
                            <span class="slider_text">
                                <span class="text-primary fs-7 off">{{ trans('labels.automatic') }}</span>
                                <span class="text-primary fs-7 on">{{ trans('labels.mannual') }}</span>
                            </span>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_name">{{ trans('labels.dome_name') }}</label>
                                <input type="text" id="dome_name" name="dome_name" value="{{ old('dome_name') }}"
                                    class="form-control" placeholder="{{ trans('labels.dome_name') }}">
                                @error('dome_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_hst">{{ trans('labels.hst') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control numbers_only" name="dome_hst" id="dome_hst"
                                        value="{{ old('dome_hst') }}" placeholder="{{ trans('labels.hst') }}">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('dome_hst')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slot_duration" class="form-label">{{ trans('labels.slot_duration') }}</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="1"
                                            id="slot_duration1" {{ old('slot_duration') == 1 ? 'checked' : '' }} checked>
                                        <label class="form-check-label" for="slot_duration1">
                                            {{ trans('labels.60_minutes') }} </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="2"
                                            id="slot_duration2" {{ old('slot_duration') == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slot_duration2">
                                            {{ trans('labels.90_minutes') }} </label>
                                    </div>
                                </div>
                                @error('slot_duration')
                                    <small class="text-danger">{{ $message }}</small>
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
                                                class="form-check-input"
                                                {{ !empty(old('benefits')) && in_array('Free Wifi', old('benefits')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="free_wifi">{{ trans('labels.free_wifi') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="changing_room" name="benefits[]"
                                                value="Changing Room" class="form-check-input"
                                                {{ !empty(old('benefits')) && in_array('Changing Room', old('benefits')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="changing_room">{{ trans('labels.changing_room') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="parking" name="benefits[]" value="Parking"
                                                class="form-check-input"
                                                {{ !empty(old('benefits')) && in_array('Parking', old('benefits')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="parking">{{ trans('labels.parking') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="pool" name="benefits[]" value="Pool"
                                                class="form-check-input"
                                                {{ !empty(old('benefits')) && in_array('Pool', old('benefits')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="pool">{{ trans('labels.pool') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="others" name="benefits[]" value="Others"
                                                class="form-check-input"
                                                {{ !empty(old('benefits')) && in_array('Others', old('benefits')) ? 'checked' : '' }}>
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
                                    <small class="text-danger">{{ $message }}</small>
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
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pin_code" class="form-label">{{ trans('labels.pincode') }}</label>
                                <input type="text" class="form-control" name="pin_code" id="pin_code"
                                    value="{{ old('pin_code') }}" placeholder="{{ trans('labels.pincode') }}" readonly>
                                @error('pin_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city" class="form-label">{{ trans('labels.city') }}</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    value="{{ old('city') }}" placeholder="{{ trans('labels.city') }}" readonly>
                                @error('city')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state" class="form-label">{{ trans('labels.state') }}</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    value="{{ old('state') }}" placeholder="{{ trans('labels.state') }}" readonly>
                                @error('state')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country" class="form-label">{{ trans('labels.country') }}</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="{{ old('country') }}" placeholder="{{ trans('labels.country') }}" readonly>
                                @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="textLat" value="{{ old('lat') }}">
                    <input type="hidden" name="lng" id="textLng" value="{{ old('lng') }}">
                    @error('lat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @error('lng')
                        <small class="text-danger">{{ $message }}</small>
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
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">{{ trans('labels.select_sports') }}</label>
                            <div class="row">
                                @foreach ($getsportslist as $key => $data)
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="sport_{{ $key }}" name="sport_id[]"
                                                class="form-check-input" value="{{ $data->id }}"
                                                data-sport-name="sport_{{ $key }}"
                                                data-sport="{{ $data->name }}"
                                                {{ !empty(old('sport_id')) && in_array($data->id, old('sport_id')) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="sport_{{ $key }}">{{ $data->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('sport_id')
                                <small class="text-danger">{{ $message }}</small>
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
                                <textarea class="form-control" name="description" id="description" rows="5"
                                    placeholder="{{ trans('labels.dome_description') }}">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Operational Hours Modal -->
            <div class="modal fade" id="add_working_hours" tabindex="-1" aria-labelledby="add_working_hoursLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="add_working_hoursLabel">
                                {{ trans('labels.add_working_hours') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            @endphp
                            <div class="row my-3">
                                <label class="col-lg-3 col-form-label"></label>
                                <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                    {{ trans('labels.availability') }} </label>
                                <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                    {{ trans('labels.opening_time') }} </label>
                                <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                    {{ trans('labels.closing_time') }} </label>
                            </div>
                            @foreach ($days as $key => $day)
                                <div class="row">
                                    <input type="hidden" name="day[]" value="{{ strtolower($day) }}">
                                    <label
                                        class="col-lg-3 col-form-label text-center fw-bold">{{ trans('labels.' . strtolower($day)) }}</label>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <label
                                                class="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.availability') }}</label>
                                            <select class="form-control" name="is_closed[]">
                                                <option value="2" selected> {{ trans('labels.open') }}</option>
                                                <option value="1"> {{ trans('labels.closed') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <label
                                                class="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.opening_time') }}</label>
                                            <input type="text" class="form-control time_picker__ time_picker__start"
                                                placeholder="{{ trans('labels.opening_time') }}" name="open_time[]"
                                                @if (old('open_time')) value="{{ old('open_time')[$key] }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <label
                                                class="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.closing_time') }}</label>
                                            <input type="text" class="form-control time_picker__ time_picker__end"
                                                placeholder="{{ trans('labels.closing_time') }}" name="close_time[]"
                                                @if (old('close_time')) value="{{ old('close_time')[$key] }}" @endif>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success"
                                data-bs-dismiss="modal">{{ trans('labels.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Discount Modal -->
            <div class="modal fade" id="dome_settings" tabindex="-1" aria-labelledby="dome_settingsLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="dome_settingsLabel">{{ trans('labels.discounts') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="field_discounts">
                                <h6>{{ trans('labels.multi_field_discount') }}</h6>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label class="form-label">{{ trans('labels.sports') }}</label>
                                        <select class="form-select sport_el" name="discount_sport[]">
                                            <option value="" selected>{{ trans('labels.select') }}</option>
                                            @foreach ($getsportslist as $sport)
                                                <option value="{{ $sport->id }}" {{ old('discount_sport') == $sport->id ? 'selected' : '' }}> {{ $sport->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="form-label">{{ trans('labels.number_of_fields') }}</label>
                                        <select class="form-select" name="number_of_fields[]">
                                            <option selected value="0">0</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}" {{ old('number_of_fields') == $i ? 'selected' : '' }}> {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label class="form-label">{{ trans('labels.discount_type') }}</label>
                                        <select class="form-select" name="fields_discount_type[]">
                                            <option value="" selected>{{ trans('labels.select') }}</option>
                                            <option value="1">{{ trans('labels.in_percentage') }} </option>
                                            <option value="2">{{ trans('labels.fixed') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="form-label">{{ trans('labels.discount') }}</label>
                                        <input type="number" class="form-control" name="fields_discount[]" placeholder="{{ trans('labels.discount') }}">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary appendfielddicountbtn"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="append-field-discounts"></div>
                            </div>
                            <hr>
                            <div id="AddAgeDiscount">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">{{ trans('labels.sports') }}</label>
                                            <select class="form-select age_sport_el" name="age_sport[]">
                                                <option value="" selected>{{ trans('labels.select') }}</option>
                                                @foreach ($getsportslist as $sport)
                                                    <option value="{{ $sport->id }}" {{ old('age_sport') == $sport->id ? 'selected' : '' }}> {{ $sport->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" >{{ trans('labels.age') }}</label>
                                            <select class="form-select select_from_age" name="from_age[]">
                                                <option value="" selected=""> {{ trans('labels.from_age') }} </option>
                                                @for ($i = 1; $i <= 90; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">&nbsp;</label>
                                            <select class="form-select select_to_age" name="to_age[]">
                                                <option value="" selected=""> {{ trans('labels.to') }}</option>
                                                {{-- @for ($i = 1; $i <= 90; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="age_discount"
                                                class="form-label">{{ trans('labels.discount_type') }}</label>
                                            <select class="form-select" name="discount_type[]">
                                                <option value="" selected>{{ trans('labels.select') }}</option>
                                                <option value="1">{{ trans('labels.in_percentage') }}</option>
                                                <option value="2">{{ trans('labels.fixed') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="age_discount"
                                                class="form-label">{{ trans('labels.discount') }}</label>
                                            <input type="number" max="100" min="0" class="form-control"
                                                name="age_discounts[]" placeholder="{{ trans('labels.discount') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary appendbtn"> <i
                                                    class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="AgeDiscountFields"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success"
                                data-bs-dismiss="modal">{{ trans('labels.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Policies & Rules Modal -->
            <div class="modal fade" id="policies_rules" tabindex="-1" aria-labelledby="policies_rulesLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="policies_rulesLabel">{{ trans('labels.policies_rules') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="form-label"
                                        for="policies_rules_">{{ trans('labels.dome_policy') }}</label>
                                    <textarea class="form-control" name="policies_rules" id="policies_rules_" rows="10"
                                        placeholder="{{ trans('messages.dome_policy') }}" autocomplete="off">{{ old('policies_rules') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-success"
                                data-bs-dismiss="modal">{{ trans('labels.save') }}</button>
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
    <div class="sport-element d-none">
        <select class="form-select sport_el" name="discount_sport[]">
            <option value="" selected>{{ trans('labels.select') }}</option>
            @foreach ($getsportslist as $sport)
                <option value="{{ $sport->id }}"> {{ $sport->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="age-sport-element d-none">
        <select class="form-select age_sport_el" name="age_sport[]">
            <option value="" selected>{{ trans('labels.select') }}</option>
            @foreach ($getsportslist as $sport)
                <option value="{{ $sport->id }}"> {{ $sport->name }}</option>
            @endforeach
        </select>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCvlZaKvRSMouyH9pDgGC6pMGADfytOrsA">
    </script>
    <script type="text/javascript">

        var label_fixed = {{ Js::from(trans('labels.fixed')) }};
        var label_in_percentage = {{ Js::from(trans('labels.in_percentage')) }};
        var label_discount = {{ Js::from(trans('labels.discount')) }};
        var label_age = {{ Js::from(trans('labels.age')) }};
        var label_from_age = {{ Js::from(trans('labels.from_age')) }};
        var label_to = {{ Js::from(trans('labels.to')) }};
        var label_discount_type = {{ Js::from(trans('labels.discount_type')) }};
        var label_select = {{ Js::from(trans('labels.select')) }};

        var label_sports = {{ Js::from(trans('labels.sports')) }};
        var sport_select_element = $('.sport-element').html();
        var label_number_of_fields = {{ Js::from(trans('labels.number_of_fields')) }};
        var age_sport_select_element = $('.age-sport-element').html();

        $('input[data-sport-name]').click(function() {
            if ($('input[data-sport-name]:checked').length > 0) {
                $('.default-price-title').show();
            } else {
                $('.default-price-title').hide();
            }
            if (this.checked) {
                let html = '<div class="col mb-2" id="' + $(this).attr("data-sport-name") + '' + $(this).val() +
                    '"><label class="form-label" for="dome_price' + $(this).val() + '">' + $(this).attr(
                        "data-sport") +
                    '</label><div class="input-group"><span class="input-group-text"><i class="fa fa-dollar"></i></span><input type="text" class="form-control numbers_only" id="dome_price' +
                    $(this).val() +
                    '" name="dome_price[]" placeholder="Price" required></div></div>';
                $('#sport_prices_input').append(html);
            } else {
                $('#' + $(this).attr("data-sport-name") + '' + $(this).val()).remove();
            }
        });
    </script>
    <script src="{{ url('resources/views/admin/domes/domes.js') }}"></script>
@endsection
