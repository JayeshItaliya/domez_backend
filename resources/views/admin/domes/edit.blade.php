@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css">

    <style>
        .ui-timepicker-container {
            z-index: 9999 !important;
        }
    </style>
@endsection
@section('title')
    {{ trans('labels.edit_dome') }}
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_dome') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/domes/update-' . $dome->id) }}" method="post"
        enctype="multipart/form-data" id="editdome">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-end">
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">{{ trans('labels.edit_working_hours') }}</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_name">{{ trans('labels.dome_name') }}</label>
                                <input type="text" id="dome_name" name="dome_name"
                                    value="{{ !empty(old('dome_name')) ? old('dome_name') : $dome->name }}"
                                    class="form-control" placeholder="Please Enter Dome Name">
                                @error('dome_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_hst">{{ trans('labels.hst') }}</label>
                                <div class="input-group">
                                    <input type="number" id="dome_hst" name="dome_hst" class="form-control"
                                        placeholder="{{ trans('labels.hst') }}"
                                        value="{{ !empty(old('dome_hst')) ? old('dome_hst') : $dome->hst }}">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_time" class="form-label">{{ trans('labels.start_time') }}</label>
                                <input type="text" class="form-control time_picker" name="start_time" value="{{ $dome->start_time }}" id="start_time" placeholder="{{ trans('labels.start_time') }}" autocomplete="off">
                                @error('start_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="end_time" class="form-label">{{ trans('labels.end_time') }}</label>
                                <input type="text" class="form-control time_picker" name="end_time" value="{{ $dome->end_time }}" id="end_time" placeholder="{{ trans('labels.end_time') }}" autocomplete="off">
                                @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slot_duration" class="form-label">{{ trans('labels.slot_duration') }}</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="1" {{ $dome->slot_duration == 1 ? 'checked' : (!empty(old('slot_duration')) && old('slot_duration') == 1 ? 'checked' : '') }} id="slot_duration1">
                                        <label class="form-check-label" for="slot_duration1"> {{ trans('labels.60_minutes') }} </label>
                                    </div>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="slot_duration" value="2" {{ $dome->slot_duration == 2 ? 'checked' : (!empty(old('slot_duration')) && old('slot_duration') == 2 ? 'checked' : '') }} id="slot_duration2">
                                        <label class="form-check-label" for="slot_duration2"> {{ trans('labels.90_minutes') }} </label>
                                    </div>
                                </div>
                                @error('slot_duration') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            @php $benefit = explode('|', $dome->benefits) @endphp
                            <div class="form-group">
                                <label class="form-label mb-2">{{ trans('labels.amenities') }}<span class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="free_wifi" name="benefits[]" value="Free Wifi"class="form-check-input" {{ in_array('Free Wifi', $benefit) ? 'checked' : (!empty(old('benefits')) && in_array('Free Wifi', old('benefits')) ? 'checked' : '') }}>
                                            <label class="form-check-label"
                                                for="free_wifi">{{ trans('labels.free_wifi') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="changing_room" name="benefits[]"
                                                value="Changing Room" class="form-check-input" {{ in_array('Changing Room', $benefit) ? 'checked' : (!empty(old('benefits')) && in_array('Changing Room', old('benefits')) ? 'checked' : '') }}>
                                            <label class="form-check-label"
                                                for="changing_room">{{ trans('labels.changing_room') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="parking" name="benefits[]" value="Parking"class="form-check-input" {{ in_array('Parking', $benefit) ? 'checked' : (!empty(old('benefits')) && in_array('Parking', old('benefits')) ? 'checked' : '') }}>
                                            <label class="form-check-label"
                                                for="parking">{{ trans('labels.parking') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="pool" name="benefits[]" value="Pool"class="form-check-input" {{ in_array('Pool', $benefit) ? 'checked' : (!empty(old('benefits')) && in_array('Pool', old('benefits')) ? 'checked' : '') }}>
                                            <label class="form-check-label"
                                                for="pool">{{ trans('labels.pool') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="others" name="benefits[]" value="Others"class="form-check-input" {{ in_array('Others', $benefit) ? 'checked' : (!empty(old('benefits')) && in_array('Others', old('benefits')) ? 'checked' : '') }}>
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
                                    for="benefits_description">{{ trans('labels.amenities_description') }} <span
                                        class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <textarea class="form-control" name="benefits_description" id="benefits_description" rows="4"
                                    placeholder="Please Enter Benefits Description">{{ !empty(old('benefits_description')) ? old('benefits_description') : $dome->benefits_description }}</textarea>
                                @error('benefits_description') <span class="text-danger">{{ $message }}</span> @enderror
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
                                <input type="text" class="form-control" name="address"
                                    value="{{ !empty(old('address')) ? old('address') : $dome->address }}" id="address"
                                    placeholder="{{ trans('labels.dome_address') }}">
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pin_code" class="form-label">{{ trans('labels.pincode') }}</label>
                                <input type="text" class="form-control" name="pin_code" id="pin_code"
                                    value="{{ !empty(old('pin_code')) ? old('pin_code') : $dome->pin_code }}"
                                    placeholder="{{ trans('labels.pincode') }}" readonly>
                                @error('pin_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city" class="form-label">{{ trans('labels.city') }}</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    value="{{ !empty(old('city')) ? old('city') : $dome->city }}"
                                    placeholder="{{ trans('labels.city') }}" readonly>
                                @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state" class="form-label">{{ trans('labels.state') }}</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    value="{{ !empty(old('state')) ? old('state') : $dome->state }}"
                                    placeholder="{{ trans('labels.state') }}" readonly>
                                @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country" class="form-label">{{ trans('labels.country') }}</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="{{ !empty(old('country')) ? old('country') : $dome->country }}"
                                    placeholder="{{ trans('labels.country') }}" readonly>
                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="textLat"
                        value="{{ !empty(old('lat')) ? old('lat') : $dome->lat }}">
                    <input type="hidden" name="lng" id="textLng"
                        value="{{ !empty(old('lng')) ? old('lng') : $dome->lng }}">
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
                                @error('dome_images') <span class="text-danger">{{ $message }}</span> @enderror
                                @foreach ($errors->get('dome_images') as $key => $err)
                                    <span class="text-danger">{{ $errors->get('dome_images')[$key] }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">{{ trans('labels.select_sports') }}</label>
                            <div class="row">
                                @php $sport_id = explode(',', $dome->sport_id) @endphp
                                @foreach ($getsportslist as $key => $data)
<<<<<<< HEAD
                                    @php
                                        $trimmedName = str_replace(' ', '', $data->name);
                                    @endphp
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="sp_{{ $key }}" name="sport_id[]"
                                                class="form-check-input" value="{{ $data->id }}"
                                                data-sport-name="sp_{{ $key }}"
                                                data-show-input="{{ $trimmedName . $data->id }}"
                                                {{ in_array($data->id, $sport_id) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="sp_{{ $key }}">{{ $data->name }}</label>
=======
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="sp_{{$key}}" name="sport_id[]"class="form-check-input" value="{{ $data->id }}"
                                                data-sport-name="{{ $data->name }}"
                                                data-show-input="{{ $data->name . $data->id }}" {{ in_array($data->id, $sport_id) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="sp_{{$key}}">{{ $data->name }}</label>
>>>>>>> c58dad1cdd8a7f6548c2f0c85f2772af2dc6d9db
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('sport_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for=""
                                class="form-label default-price-title">{{ trans('labels.sport_default_price') }}</label>
                            <div class="row row-cols-md-4" id="sport_prices_input">
                                @foreach ($getsportslist as $sport)
                                @php
                                        $trimmedName = str_replace(' ', '', $sport->name);
                                    @endphp
                                    @if (in_array($sport->id, $sport_id))
                                        <div class="col mb-2" id="{{ $trimmedName . $sport->id }}">
                                        @else
                                            <div class="col mb-2" id="{{ $trimmedName . $sport->id }}"
                                                style="display:none">
                                    @endif
                                    <label class="form-label" for="">{{ $sport->name }}</label>
                                    <div class="input-group">
<<<<<<< HEAD
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-dollar"></i>
                                        </span>
=======
                                        <span class="input-group-text" id="basic-addon1"><iclass="fa fa-dollar"></iclass=></span>
>>>>>>> c58dad1cdd8a7f6548c2f0c85f2772af2dc6d9db
                                        <input type="number" class="form-control" name="dome_price[]"
                                            value="{{ Helper::get_dome_price($dome->id, $sport->id) }}"
                                            placeholder="Price" {{ in_array($sport->id, $sport_id) ? '' : 'disabled' }}>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">{{ trans('labels.dome_description') }}</label>
                            <textarea class="form-control" name="description" @required(true) id="description" rows="5"
                                placeholder="{{ trans('labels.dome_description') }}">{{ !empty(old('dome_description')) ? old('dome_description') : $dome->description }}</textarea>
                            @error(' description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            @foreach ($dome['dome_images'] as $key => $demoimages)
                <div class="avatar avatar-xl col-auto">
                    <div class="dome-img">
                        <img src="{{ $demoimages->image }}" alt="..." class="mb-3 rounded d-block">
                        @if (count($dome['dome_images']) > 1)
                            <div class="dome-img-overlay rounded">
                                <a onclick="deletedata('{{ $demoimages->id }}','{{ URL::to('admin/domes/image_delete') }}')"
                                    class="delete-icon fs-5 rounded-circle py-2 px-3"><i
                                        class="fa-light fa-trash-can"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                <a href="{{ URL::to('admin/domes') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
            </div>
        </div>
        </div>
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ trans('labels.edit_working_hours') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ URL::to('admin/domes/manage-time') }}" method="post" id="workinghoursform">
                    <input type="hidden" name="id" value="{{ $dome->id }}">
                    <div class="modal-body">
                        <div class="row my-3">
                            <label class="col-lg-3 col-form-label"></label>
                            <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                {{ trans('labels.availability') }} </label>
                            <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                {{ trans('labels.opening_time') }} </label>
                            <label class="col-lg-3 text-center mb-0 d-none d-lg-block d-xl-block d-xxl-block fw-bold">
                                {{ trans('labels.closing_time') }} </label>
                        </div>
                        @if (count($dome['working_hours']) > 0)
                            @foreach ($dome['working_hours'] as $key => $time)
                                <div class="row">
                                    <label
                                        class="col-lg-3 col-form-label text-center fw-bold">{{ trans('labels.' . strtolower($time->day)) }}</label>
                                    <input type="hidden" name="day[]" value="{{ $time->id }}">
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.availability') }}</labelclass=>
                                            <select class="form-control" name="is_closed[]">
                                                <option value="2" {{ $time->is_closed == 2 ? 'selected' : '' }}> {{ trans('labels.open') }} </option>
                                                <option value="1" {{ $time->is_closed == 1 ? 'selected' : '' }}> {{ trans('labels.closed') }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.opening_time') }}</labelclass=>
                                            <input type="text" class="form-control time_picker__ time_picker__start"
                                                placeholder="{{ trans('labels.opening_time') }}" name="open_time[]"
                                                value="{{ date('H:i', strtotime($time->open_time)) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.closing_time') }}</labelclass=>
                                            <input type="text" class="form-control time_picker__ time_picker__end"
                                                placeholder="{{ trans('labels.closing_time') }}" name="close_time[]"
                                                value="{{ date('H:i', strtotime($time->close_time)) }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @php
                                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                            @endphp
                            @foreach ($days as $key => $day)
                                <div class="row">
                                    <input type="hidden" name="day[]" value="{{ strtolower($day) }}">
                                    <label
                                        class="col-lg-3 col-form-label text-center fw-bold">{{ trans('labels.' . strtolower($day)) }}</label>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.availability') }}</labelclass=>
                                            <select class="form-control" name="is_closed[]">
                                                <option value="2" selected> {{ trans('labels.open') }} </option>
                                                <option value="1"> {{ trans('labels.closed') }} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.opening_time') }}</labelclass=>
                                            <input type="text" class="form-control time_picker__ time_picker__start"
                                                placeholder="{{ trans('labels.opening_time') }}" name="open_time[]"
                                                @if (old('open_time')) value="{{ old('open_time')[$key] }}" @endif>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group d-grid align-items-end">
                                            <labelclass="d-lg-none d-xl-none d-xxl-none">{{ trans('labels.closing_time') }}</labelclass=>
                                            <input type="text" class="form-control time_picker__ time_picker__end"
                                                placeholder="{{ trans('labels.closing_time') }}" name="close_time[]"
                                                @if (old('close_time')) value="{{ old('close_time')[$key] }}" @endif>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success" id="submitBtn"
                            style="display: none;">{{ trans('labels.save') }}</button>
                        {{-- <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">{{ trans('labels.save') }}</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js"></script>

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
                $('#' + $(this).attr('data-show-input')).show();
                $('#' + $(this).attr('data-show-input')).find('input[type=number]').attr('disabled', false);
            } else {
                $('#' + $(this).attr('data-show-input')).hide();
                $('#' + $(this).attr('data-show-input')).find('input[type=number]').attr('disabled', true);
            }
        });



        function showSubmitButton() {
            $("#submitBtn").show();
        }

        function hideSubmitButton() {
            $("#submitBtn").hide();
        }
        $("#exampleModal input, #exampleModal select").on("change", showSubmitButton);
        var update_ = 0;
        $('#workinghoursform').on('submit', function(event) {
            "use strict";
            event.preventDefault();
            var formData = new FormData(this);
            formData.set('update_', update_);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function(response) {
                    showpreloader();
                },
                success: function(response) {
                    // if (response.errors && Object.keys(response.errors).length > 0) {
                    // $.each(response.errors, function(key, value) {
                    //     toastr.error(value);
                    //     return false;
                    // });
                    // }
                    hidepreloader();
                    if (response.status == 0) {
                        toastr.error(response.message);
                        return false;
                    } else if (response.status == 2) {
                        needconfirmation(response.message);
                    } else {
                        update_ = 0;
                        toastr.success(response.message);
                        Swal.close();
                        hideSubmitButton();
                        $('#exampleModal').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    hidepreloader();
                    toastr.error(wrong);
                    return false;
                }
            });
        });

        function needconfirmation(msg) {
            "use strict";
            swalWithBootstrapButtons.fire({
                icon: "warning",
                title: are_you_sure,
                text: msg,
                showCancelButton: !0,
                allowOutsideClick: !1,
                allowEscapeKey: !1,
                confirmButtonText: yes,
                cancelButtonText: no,
                reverseButtons: !0,
                showLoaderOnConfirm: !0,
                preConfirm: function() {
                    return new Promise(function(o, n) {
                        update_ = 1;
                        $('#workinghoursform').submit();
                    })
                }
            }).then(t => {
                t.isConfirmed || (t.dismiss, Swal.DismissReason.cancel)
            })
        }
    </script>
    <script src="{{ url('resources/views/admin/domes/domes.js') }}"></script>
@endsection
