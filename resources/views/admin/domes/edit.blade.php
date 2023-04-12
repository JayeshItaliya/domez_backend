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
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="dome_name">{{ trans('labels.dome_name') }}</label>
                                <input type="text" id="dome_name" name="dome_name" value="{{ $dome->name }}"
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
                                        placeholder="{{ trans('labels.hst') }}" value="{{ $dome->hst }}">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="start_time" class="form-label">{{ trans('labels.start_time') }}</label>
                                <input type="text" class="form-control time_picker" name="start_time"
                                    value="{{ $dome->start_time }}" id="start_time"
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
                                    value="{{ $dome->end_time }}" id="end_time"
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
                                            {{ $dome->slot_duration == 1 ? 'checked' : '' }} id="slot_duration1">
                                        <label class="form-check-label" for="slot_duration1"> {{ trans('labels.60_minutes') }} </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="slot_duration"
                                            value="2" {{ $dome->slot_duration == 2 ? 'checked' : '' }}
                                            id="slot_duration2">
                                        <label class="form-check-label" for="slot_duration2"> {{ trans('labels.90_minutes') }} </label>
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
                            @php $benefit = explode('|', $dome->benefits) @endphp
                            <div class="form-group">
                                <label class="form-label mb-2">{{ trans('labels.amenities') }}<span
                                        class="form-label-secondary px-2">{{ trans('labels.optional') }}</span></label>
                                <div class="row">
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="free_wifi" name="benefits[]" value="Free Wifi"
                                                class="form-check-input"
                                                {{ in_array('Free Wifi', $benefit) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="free_wifi">{{ trans('labels.free_wifi') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="changing_room" name="benefits[]"
                                                value="Changing Room" class="form-check-input"
                                                {{ in_array('Changing Room', $benefit) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="changing_room">{{ trans('labels.changing_room') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="parking" name="benefits[]" value="Parking"
                                                class="form-check-input"
                                                {{ in_array('Parking', $benefit) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="parking">{{ trans('labels.parking') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="pool" name="benefits[]" value="Pool"
                                                class="form-check-input"
                                                {{ in_array('Pool', $benefit) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="pool">{{ trans('labels.pool') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-check mb-0">
                                            <input type="checkbox" id="others" name="benefits[]" value="Others"
                                                class="form-check-input"
                                                {{ in_array('Pool', $benefit) ? 'checked' : '' }}>
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
                                <textarea class="form-control" name="benefits_description" id="benefits_description" rows="4"
                                    placeholder="Please Enter Benefits Description">{{ $dome->benefits_description }}</textarea>
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
                                <input type="text" class="form-control" name="address" value="{{ $dome->address }}"
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
                                    value="{{ $dome->pin_code }}" placeholder="{{ trans('labels.pincode') }}" readonly>
                                @error('pin_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city" class="form-label">{{ trans('labels.city') }}</label>
                                <input type="text" class="form-control" name="city" id="city"
                                    value="{{ $dome->city }}" placeholder="{{ trans('labels.city') }}" readonly>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state" class="form-label">{{ trans('labels.state') }}</label>
                                <input type="text" class="form-control" name="state" id="state"
                                    value="{{ $dome->state }}" placeholder="{{ trans('labels.state') }}" readonly>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country" class="form-label">{{ trans('labels.country') }}</label>
                                <input type="text" class="form-control" name="country" id="country"
                                    value="{{ $dome->country }}" placeholder="{{ trans('labels.country') }}" readonly>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="textLat" value="{{ $dome->lat }}">
                    <input type="hidden" name="lng" id="textLng" value="{{ $dome->lng }}">
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
                                @php $sport_id = explode(',', $dome->sport_id) @endphp
                                @foreach ($getsportslist as $data)
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input type="checkbox" id="{{ $data->name }}" name="sport_id[]"
                                                class="form-check-input" value="{{ $data->id }}"
                                                data-sport-name="{{ $data->name }}"
                                                data-show-input="{{ $data->name . $data->id }}"
                                                {{ in_array($data->id, $sport_id) ? 'checked' : '' }}>
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
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">{{ trans('labels.sport_default_price') }}</label>
                            <div class="row row-cols-md-4" id="sport_prices_input">
                                @foreach ($getsportslist as $sport)
                                    @if (in_array($sport->id, $sport_id))
                                        <div class="col mb-2" id="{{ $sport->name . $sport->id }}">
                                        @else
                                            <div class="col mb-2" id="{{ $sport->name . $sport->id }}"
                                                style="display:none">
                                    @endif
                                    <label class="form-label"
                                        for="">{{ $sport->name . ' ' . trans('labels.price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                        <input type="number" class="form-control" name="dome_price[]"
                                            value="{{ Helper::get_dome_price($dome->id, $sport->id) }}" placeholder="0"
                                            {{ in_array($sport->id, $sport_id) ? '' : 'disabled' }}>
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
                            <textarea class="form-control" name="description" id="description" rows="5"
                                placeholder="{{ trans('labels.dome_description') }}" maxlength="100">{{ $dome->description }}</textarea>
                            @error(' description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            @foreach ($dome['dome_images'] as $demoimages)
                <div class="avatar avatar-xl col-auto">
                    <div class="dome-img">
                        <img src="{{ $demoimages->image }}" alt="..." class="mb-3 rounded d-block">
                        <div class="dome-img-overlay rounded">
                            <a onclick="deletedata('{{ $demoimages->id }}','{{ URL::to('admin/domes/image_delete') }}')"
                                class="delete-icon fs-5 rounded-circle py-2 px-3"><i
                                    class="fa-light fa-trash-can"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
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
            if (this.checked) {
                $('#' + $(this).attr('data-show-input')).show();
                $('#' + $(this).attr('data-show-input')).find('input[type=number]').attr('disabled', false);
            } else {
                $('#' + $(this).attr('data-show-input')).hide();
                $('#' + $(this).attr('data-show-input')).find('input[type=number]').attr('disabled', true);
            }
        });
        $(function() {
            "use strict";
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
            var lat = parseFloat($('#textLat').val());
            var lng = parseFloat($('#textLng').val());
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

        function deletedata(id, url) {
            "use strict";
            swalWithBootstrapButtons
                .fire({
                    icon: 'warning',
                    title: are_you_sure,
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: yes,
                    cancelButtonText: no,
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve, reject) {
                            $.ajax({
                                type: "GET",
                                url: url,
                                data: {
                                    id: id,
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.status == 1) {
                                        location.reload();
                                    } else {
                                        swal_cancelled(wrong);
                                        return false;
                                    }
                                },
                                error: function(response) {
                                    swal_cancelled(wrong);
                                    return false;
                                },
                            });
                        });
                    },
                }).then((result) => {
                    if (!result.isConfirmed) {
                        result.dismiss === Swal.DismissReason.cancel
                    }
                })
        }
    </script>
@endsection
