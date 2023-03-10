@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/timepicker/jquery.timepicker.min.css') }}">
@endsection
@section('title')
    {{ trans('labels.edit_dome') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_dome') }}</p>
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
                        <li class="breadcrumb-item">{{ trans('labels.domes') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_dome') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/domes/update-' . $dome->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-sm-6">
                    <label class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="row">
                        @php $cat_id = explode(',', $dome->sport_id) @endphp
                        @foreach ($getsportslist as $data)
                            <div class="col-auto">
                                <div class="form-check mb-3">
                                    <input type="checkbox" id="{{ $data->name }}" name="sport_id[]"
                                        class="form-check-input" value="{{ $data->id }}"
                                        data-sport-name="{{ $data->name }}"
                                        {{ in_array($data->id, $cat_id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $data->name }}">{{ $data->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('sport_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label" for="dome_name">{{ trans('labels.dome_name') }}</label>
                    <input type="text" id="dome_name" name="dome_name" value="{{ $dome->name }}" class="form-control"
                        placeholder="{{ trans('labels.dome_name') }}">
                    @error('dome_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-sm-6">
                    <div class="row row-cols-lg-5 row-cols-md-4" id="sport_prices_input"></div>
                </div>
                <div class="col-md-0 col-lg-6">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="col">
                                <label class="form-label" for="dome_hst">{{ trans('labels.hst') }}</label>
                                <div class="input-group">
                                    <input type="text" id="dome_hst" name="dome_hst" value="{{ $dome->hst }}"
                                        class="form-control" placeholder="0">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label for="start_time" class="form-label">{{ trans('labels.start_time') }}</label>
                            <input type="text" class="form-control time_picker" name="start_time"
                                value="{{ $dome->start_time }}" id="start_time"
                                placeholder="{{ trans('labels.start_time') }}" autocomplete="off">
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <label for="end_time" class="form-label">{{ trans('labels.end_time') }}</label>
                            <input type="text" class="form-control time_picker" name="end_time"
                                value="{{ $dome->end_time }}" id="end_time" placeholder="{{ trans('labels.end_time') }}"
                                autocomplete="off">
                            @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-sm-6 mt-3">
                    <label class="form-label" for="address">{{ trans('labels.dome_address') }}</label>
                    <input type="text" class="form-control" name="address" value="{{ $dome->address }}"
                        id="address" placeholder="{{ trans('labels.dome_address') }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row mt-3">
                        <div class="col">
                            <label for="pin_code" class="form-label">{{ trans('labels.pincode') }}</label>
                            <input type="text" class="form-control" name="pin_code" id="pin_code"
                                value="{{ $dome->pin_code }}" placeholder="{{ trans('labels.pincode') }}" readonly>
                        </div>
                        <div class="col">
                            <label for="city" class="form-label">{{ trans('labels.city') }}</label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ $dome->city }}" placeholder="{{ trans('labels.city') }}" readonly>
                        </div>
                        <div class="col">
                            <label for="state" class="form-label">{{ trans('labels.state') }}</label>
                            <input type="text" class="form-control" name="state" id="state"
                                value="{{ $dome->state }}" placeholder="{{ trans('labels.state') }}" readonly>
                        </div>
                        <div class="col">
                            <label for="country" class="form-label">{{ trans('labels.country') }}</label>
                            <input type="text" class="form-control" name="country" id="country"
                                value="{{ $dome->country }}" placeholder="{{ trans('labels.country') }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-sm-6 mt-3">
                    <label class="form-label" for="description">{{ trans('labels.dome_description') }}</label>
                    <textarea class="form-control" name="description" value="{{ old('description') }}" id="description" rows="5"
                        placeholder="{{ trans('labels.dome_description') }}">{{ $dome->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    @php $benefit = explode('|', $dome->benefits) @endphp
                    <div class="form-group mb-4">
                        <label class="form-label mb-3">{{ trans('labels.amenities') }}<span
                                class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="free_wifi" name="benefits[]" value="Free Wifi"
                                        class="form-check-input" {{ in_array('Free Wifi', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="free_wifi">{{ trans('labels.free_wifi') }}</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="changing_room" name="benefits[]" value="Changing Room"
                                        class="form-check-input"
                                        {{ in_array('Changing Room', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="changing_room">{{ trans('labels.changing_room') }}</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="parking" name="benefits[]" value="Parking"
                                        class="form-check-input" {{ in_array('Parking', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="parking">{{ trans('labels.parking') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dome_images">{{ trans('labels.dome_images') }}</label>
                        <input type="file" class="form-control" id="dome_images" name="dome_images[]" multiple>
                        @error('dome_images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label" for="benefits_description">{{ trans('labels.amenities_description') }}<span
                            class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                    <textarea class="form-control" name="benefits_description" value="{{ old('benefits_description') }}"
                        id="benefits_description" rows="5" placeholder="Please Enter Benefits Description">{{ $dome->benefits_description }}</textarea>
                    @error('benefits_description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row mb-4">
                @foreach ($dome['dome_images'] as $demoimages)
                    <div class="avatar avatar-xl">
                        <div class="position-relative">
                            <img src="{{ $demoimages->image }}" alt="..." class="mb-3 rounded"
                                style="width:120px; height:70px;">
                            <div class="img-overlay">
                                <a onclick="dome_delete('{{ $demoimages->id }}','{{ URL::to('admin/domes/image_delete') }}')"
                                    class="text-bg-danger-soft fs-3 rounded-circle py-2 px-3"><i
                                        class="fa-light fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label class="form-label" for="location">{{ trans('labels.dome_location') }}</label>
                <input type="text" name="lat" id="textLat"value="{{ $dome->lat }}" hidden>
                <input type="text" name="lng" id="textLng"value="{{ $dome->lng }}" hidden>
                <div id="map_canvas" class="w-auto" style="height: 500px;"></div>
                @error('lat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2 float-end">{{ trans('labels.submit') }}</button>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/timepicker/jquery.timepicker.min.js') }}" defer=""></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCvlZaKvRSMouyH9pDgGC6pMGADfytOrsA">
    </script>
    <script type="text/javascript">
        // Timepicker
        $(document).ready(function() {
            "use strict";            $(".time_picker").timepicker({
                interval: 60,
            });
        });
        // Sport Price
        $('input[data-sport-name]').click(function() {
            if (this.checked) {
                let html = '<div class="col mb-2" id="' + $(this).attr("data-sport-name") + '' + $(this).val() +
                    '"><label class="form-label" for="dome_price">' + $(this).attr("data-sport-name") +
                    ' Price</label><div class="input-group"><input type="text" class="form-control" id="dome_price" name="dome_price" placeholder="0"><span class="input-group-text" id="basic-addon1">$</span></div></div>';
                $('#sport_prices_input').append(html);
            } else {
                $('#' + $(this).attr("data-sport-name") + '' + $(this).val()).remove();
            }
        });
        // Dome Image Delete
        function dome_delete(id, url) {
            "use strict";
            swalWithBootstrapButtons
                .fire({
                    title: are_you_sure,
                    icon: "warning",
                    confirmButtonText: yes,
                    cancelButtonText: no,
                    showCancelButton: true,
                    reverseButtons: true,
                })
                .then((result) => {
                    showpreloader();
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: url,
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    hidepreloader();
                                    toastr.success("Success");
                                    location.reload();
                                } else {
                                    hidepreloader();
                                    swal_cancelled(wrong);
                                }
                            },
                            failure: function(response) {
                                hidepreloader();
                                swal_cancelled(wrong);
                            },
                        });
                    }
                    hidepreloader();
                });
        }
        // Google Map For Location
        $(document).ready(function() {
            initMap();
        });

        function initMap() {
            var myLatLng = {
                lat: {{ $dome->lat }},
                lng: {{ $dome->lng }}
            };
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                center: myLatLng,
                zoom: 15
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Dome Location',
                draggable: false
            });
            google.maps.event.addListener(marker, 'dragend', function(marker) {
                var latLng = marker.latLng;
                var lat = document.getElementById('textLat').innerHTML = latLng.lat();
                var lng = document.getElementById('textLng').innerHTML = latLng.lng();
                $('#textLat').val(lat);
                $('#textLng').val(lng);
            });
        }

        function init() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed',
                function() {
                    var place = autocomplete.getPlace();
                    var latValue = place.geometry.location.lat();
                    var lngValue = place.geometry.location.lng();
                    var placeInput = document.getElementById('place');
                    var latInput = document.getElementById('textLat');
                    var lngInput = document.getElementById('textLng');
                    console.log(place.address_components);
                    let country = place.address_components.find(function(component) {
                        return component.types[0] === "country";
                    });
                    let postalCode = place.address_components.find(function(component) {
                        return component.types[0] === "postal_code";
                    });
                    let state = place.address_components.find(function(component) {
                        return component.types[0] === "administrative_area_level_1";
                    });
                    let city = place.address_components.find(function(component) {
                        return component.types[0] === "administrative_area_level_3";
                    });

                    //placeInput.value = place.name;
                    latInput.value = latValue;
                    lngInput.value = lngValue;
                    var map = new google.maps.Map(document.getElementById('map_canvas'), {
                        center: {
                            lat: latValue,
                            lng: lngValue
                        },
                        zoom: 15
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
                    // alert(components_by_type['state']);
                    // alert((state.long_name).length);
                    // return false;
                    $('#pin_code').val(postalCode.long_name);
                    $('#city').val(city.long_name);
                    $('#state').val(state.long_name);
                    $('#country').val(country.long_name);
                }
            );
        }
        init();
    </script>
@endsection
