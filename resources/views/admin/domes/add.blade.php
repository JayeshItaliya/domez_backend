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
                                        placeholder="{{ trans('labels.hst') }}">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        {{-- Amenities description --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label"
                                    for="benefits_description">{{ trans('labels.amenities_description') }}<span
                                        class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <textarea class="form-control" name="benefits_description" value="{{ old('benefits_description') }}"
                                    id="benefits_description" rows="4" placeholder="Please Enter Benefits Description"></textarea>
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
                            <label for="" class="form-label default-price-title">{{ trans('labels.sport_default_price') }}</label>
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

                    <button type="submit" class="btn btn-primary mt-2 float-end">{{ trans('labels.submit') }}</button>
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

            if($('input[data-sport-name]:checked').length > 0){
                $('.default-price-title').show();
            }else{
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
        $(function() {
            "use strict";
            $('.default-price-title').hide();
            $(".time_picker").timepicker({
                interval: 60,
            });
            initMap();
        });

        // Google Map For Location
        if ($('#textLat').val().length == 0) {
            var lat = -33.8688197;
            var lng = 151.2092955;
        } else {
            var lat = $('#textLat').val();
            var lng = $('#textLng').val();
        }

        function initMap() {
            if (!document.getElementById('map_canvas')) {
                return false;
            }
            var myLatLng = {
                lat: lat,
                lng: lng
            };
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                center: myLatLng,
                zoom: 13
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Domez Location',
                draggable: false
            });
            google.maps.event.addListener(marker, 'dragend', function(marker) {
                var latLng = marker.latLng;
                var lat = document.getElementById('textLat').innerHTML = latLng.lat();
                var lng = document.getElementById('textLng').innerHTML = latLng.lng();
                $('#textLat').val(lat);
                $('#textLng').val(lng);
            });

            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(autocomplete, 'place_changed',
                function() {
                    var place = autocomplete.getPlace();
                    var latValue = place.geometry.location.lat();
                    var lngValue = place.geometry.location.lng();
                    var latInput = document.getElementById('textLat');
                    var lngInput = document.getElementById('textLng');
                    let country = place.address_components.find(function(component) {
                        return component.types[0] == "country";
                    });
                    let state = place.address_components.find(function(component) {
                        return component.types[0] == "administrative_area_level_1";
                    });
                    let city = place.address_components.find(function(component) {
                        return component.types[0] == "locality";
                    });
                    latInput.value = latValue;
                    lngInput.value = lngValue;
                    var map = new google.maps.Map(document.getElementById('map_canvas'), {
                        center: {
                            lat: latValue,
                            lng: lngValue
                        },
                        zoom: 13
                    });
                    var marker = new google.maps.Marker({
                        position: {
                            lat: latValue,
                            lng: lngValue
                        },
                        map: map,
                        title: 'Domez Location',
                        draggable: false
                    });
                    $('#pin_code').val(getZipCode(latInput.value, lngInput.value));
                    $('#city').val(city.long_name);
                    $('#state').val(state.long_name);
                    $('#country').val(country.long_name);
                });

        }

        function getZipCode(lat, lng) {
            var zipcode = '';
            $.ajax({
                url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + lat + ',' + lng +
                    '&key=AIzaSyCvlZaKvRSMouyH9pDgGC6pMGADfytOrsA',
                type: "GET",
                dataType: 'json',
                async: false,
                success: function(data) {
                    var results = data.results;
                    results[0].address_components.forEach(element => {
                        if (element.types[0] == "postal_code") {
                            zipcode = element.long_name;
                        }
                    });
                }
            });
            return zipcode;
        }
    </script>
@endsection
