@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/timepicker/jquery.timepicker.min.css') }}">
@endsection
@section('title')
    Edit Dome
@endsection
@section('contents')
    <!-- Title -->
    <h1 class="h2">Edit Dome</h1>

    <form class="card" action="{{ URL::to('admin/domes/update-' . $dome->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-sm-6">
                    <label class="form-label">Select Sport</label>
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
                    <label class="form-label" for="dome_name">Dome Name</label>
                    <input type="text" id="dome_name" name="dome_name" value="{{ $dome->name }}" class="form-control"
                        placeholder="Please Enter Dome Name">
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
                                <label class="form-label" for="dome_hst">HST</label>
                                <div class="input-group">
                                    <input type="text" id="dome_hst" name="dome_hst" value="{{ $dome->hst }}"
                                        class="form-control" placeholder="0">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="text" class="form-control time_picker" name="start_time"
                                value="{{ $dome->start_time }}" id="start_time" placeholder="Select Start Time"
                                autocomplete="off">
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="text" class="form-control time_picker" name="end_time"
                                value="{{ $dome->end_time }}" id="end_time" placeholder="Select End Time"
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
                    <label class="form-label" for="address">Dome Address</label>
                    <input type="text" class="form-control" name="address" value="{{ $dome->address }}" id="address"
                        placeholder="Please Enter Dome Address">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="row mt-3 gx-5">
                        <div class="col-auto">
                            <label for="pin_code" class="form-label">Pin Code</label>
                            <input type="text" class="form-control" name="pin_code" id="pin_code"
                                value="{{ $dome->pin_code }}" placeholder="Enter Pincode Name" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" id="city"
                                value="{{ $dome->city }}" placeholder="Enter City Name" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" name="state" id="state"
                                value="{{ $dome->state }}" placeholder="Enter State Name" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" id="country"
                                value="{{ $dome->country }}" placeholder="Enter Country Name" readonly>
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-sm-6 mt-3">
                    <label class="form-label" for="description">Dome Description</label>
                    <textarea class="form-control" name="description" value="{{ old('description') }}" id="description" rows="5"
                        placeholder="Please Enter Dome Description">{{ $dome->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    @php $benefit = explode('|', $dome->benefits) @endphp
                    <div class="form-group mb-4">
                        <label class="form-label mb-3">Benefits<span
                                class="form-label-secondary px-2">(Optional)</span></label>
                        <div class="row">
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="free_wifi" name="benefits[]" value="Free Wifi"
                                        class="form-check-input" {{ in_array('Free Wifi', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="free_wifi">Free Wifi</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="changing_room" name="benefits[]" value="Changing Room"
                                        class="form-check-input"
                                        {{ in_array('Changing Room', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="changing_room">Changing Room</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input type="checkbox" id="parking" name="benefits[]" value="Parking"
                                        class="form-check-input" {{ in_array('Parking', $benefit) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="parking">Parking</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dome_images">Dome Images</label>
                        <input type="file" class="form-control" id="dome_images" name="dome_images[]" multiple>
                        @error('dome_images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label" for="benefits_description">Benefits Description<span
                            class="form-label-secondary px-2">(Optional)</span></label>
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
                <label class="form-label" for="location">Dome Location</label>
                <input type="text" name="lat" id="textLat"value="{{ $dome->lat }}" hidden>
                <input type="text" name="lng" id="textLng"value="{{ $dome->lng }}" hidden>
                <div id="map_canvas" class="w-auto" style="height: 500px;"></div>
                @error('lat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2 float-end">Update</button>
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
            "use strict";
            $(".time_picker").timepicker({
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
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2",
                    cancelButton: "btn btn-danger mx-2",
                },
                buttonsStyling: false,
            });

            swalWithBootstrapButtons
                .fire({
                    title: "Are You Sure?",
                    icon: "warning",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showCancelButton: true,
                    reverseButtons: true,
                })
                .then((result) => {
                    $("#preloader , #status").show();
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
                                    $("#preloader , #status").hide();
                                    toastr.success("Success");
                                    location.reload();
                                } else {
                                    $("#preloader , #status").hide();
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: wrong,
                                    });
                                }
                            },
                            failure: function(response) {
                                $("#preloader , #status").hide();
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: wrong,
                                });
                            },
                        });
                    }
                    $("#preloader , #status").hide();
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
