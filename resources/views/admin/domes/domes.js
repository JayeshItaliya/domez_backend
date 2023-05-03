$(function () {
    "use strict";
    if ($('input[data-sport-name]:checked').length > 0) {
        $('.default-price-title').show();
    } else {
        $('.default-price-title').hide();
    }
    $('.time_picker__').timepicker({
        interval: 60,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        timeFormat: 'HH:mm',
    });
    $('.total-bookings-picker, .dome-revenue-picker').hide();
    if ($('.total-bookings-picker').length > 0) {
        $('.total-bookings-picker').flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            }
        });
    }
    if ($('.dome-revenue-picker').length > 0) {
        $('.dome-revenue-picker').flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            }
        });
    }
    initMap();
});

$('#adddome').on('submit', function () {
    var check = 1;
    $('.time_picker__').each(function () {
        if ($.trim($(this).val()) == '') {
            $(this).addClass('is-invalid');
            check = 0;
        } else {
            $(this).removeClass('is-invalid');
        }
        if (check == 0) {
            return false;
        }
    });
    if (check == 0) {
        if ($('#exampleModal').is(':hidden')) {
            $('#exampleModal').modal('show');
        }
        return false;
    }
});

function dome_revenue_chart(dome_revenue_labels, dome_revenue_data) {
    var options = {
        series: [{
            name: revenue,
            data: dome_revenue_data
        }],
        chart: {
            height: 400,
            type: 'line',
            zoom: {
                enabled: false
            },
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        colors: [secondary_color],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "$"
            }
        },
        stroke: {
            curve: 'straight'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: dome_revenue_labels,
        }
    };
    $('#dome_revenue_chart .apexcharts-canvas').remove();
    if (document.getElementById("dome_revenue_chart")) {
        var domerevenuechart = new ApexCharts(document.querySelector("#dome_revenue_chart"), options);
        domerevenuechart.render();
    }
}
$('.dome-revenue-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.dome-revenue-picker').show();
        return false;
    } else {
        $('.dome-revenue-picker').hide();
    }
    domerevenuefilter('')
});

function domerevenuefilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.dome-revenue-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.dome-revenue-count').html(response.dome_revenue);
            dome_revenue_chart(response.dome_revenue_labels, response.dome_revenue_data)
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}

function bookings_chart(bookings_labels, bookings_data, arr) {
    var bookings_data_colors = $.map(arr, function (val, i) {
        if (val == 'primary_color') {
            return primary_color;
        } else if (val == 'secondary_color') {
            return secondary_color;
        } else if (val == 'danger_color') {
            return danger_color;
        } else {
            return val;
        }
    });
    var options = {
        series: bookings_data,
        chart: {
            height: 450,
            type: 'pie',
        },
        labels: bookings_labels,
        colors: bookings_data_colors,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    show: false,
                    position: 'bottom'
                }
            }
        }]
    };
    $('#bookings_chart .apexcharts-canvas').remove();
    if (document.getElementById("bookings_chart")) {
        var totalbookingschart = new ApexCharts(document.querySelector("#bookings_chart"), options);
        totalbookingschart.render();
    }
}
$('.total-bookings-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.total-bookings-picker').show();
        return false;
    } else {
        $('.total-bookings-picker').hide();
    }
    totalbookingsfilter('')
});

function totalbookingsfilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.total-bookings-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-bookings-count').html(response.total_bookings);
            bookings_chart(response.bookings_labels, response.bookings_data, response
                .bookings_data_colors)
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}

if (document.getElementById('textLat') && $('#textLat').val() != "") {
    var lat = parseFloat($('#textLat').val());
    var lng = parseFloat($('#textLng').val());
} else {
    var lat = -33.8688197;
    var lng = 151.2092955;
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
    google.maps.event.addListener(marker, 'dragend', function (marker) {
        var latLng = marker.latLng;
        var lat = document.getElementById('textLat').innerHTML = latLng.lat();
        var lng = document.getElementById('textLng').innerHTML = latLng.lng();
        $('#textLat').val(lat);
        $('#textLng').val(lng);
    });
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));
    google.maps.event.addListener(autocomplete, 'place_changed',
        function () {
            var place = autocomplete.getPlace();
            var latValue = place.geometry.location.lat();
            var lngValue = place.geometry.location.lng();
            var latInput = document.getElementById('textLat');
            var lngInput = document.getElementById('textLng');
            let country = place.address_components.find(function (component) {
                return component.types[0] == "country";
            });
            let state = place.address_components.find(function (component) {
                return component.types[0] == "administrative_area_level_1";
            });
            let city = place.address_components.find(function (component) {
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
        success: function (data) {
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
