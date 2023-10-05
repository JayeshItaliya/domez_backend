$(document).ready(function () {
    $(".time_picker__start").timepicker({
        interval: 60,
        timeFormat: "HH:mm",
        minTime: "00:00",
        maxTime: "23:59",
        scrollbar: true,
        dynamic: false,
        dropdown: true,
        change: function (time) {
            var element = $(this);
            var timepicker = element.timepicker();
            var start_time = timepicker.format(time);
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var dateString = year + "-" + month + "-" + day;
            start_time = new Date(dateString + " " + start_time);
            start_time.setMinutes(start_time.getMinutes() + 30);
            var end_time_element = $(this)
                .parent()
                .parent()
                .next()
                .find(".time_picker__end");
            end_time_element.val("");
            end_time_element.timepicker("destroy");
            end_time_element.timepicker({
                interval: 30,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                timeFormat: "HH:mm",
                startTime: start_time,
                minTime: start_time,
                maxTime: "23:59",
            });
            end_time_element.on("focus", function () {
                if (
                    $(".ui-timepicker-viewport").find("a:last").html() !=
                    "23:59"
                ) {
                    $(".ui-timepicker-viewport").append(
                        '<li class="ui-menu-item" style="width: 133.312px;"><a class="ui-corner-all">23:59</a></li>'
                    );
                }
            });
        },
    });
});
// $(document).ready(function () {
//     $('.time_picker__start').timepicker({
//         interval: 60,
//         timeFormat: 'HH:mm',
//         minTime: '00:00',
//         maxTime: '23:59',
//         scrollbar: true,
//         dynamic: false,
//         dropdown: true
//     });
//     $('.time_picker__end').timepicker({
//         timeFormat: 'HH:mm',
//         interval: 60,
//         minTime: '00:30',
//         maxTime: '23:59',
//         scrollbar: true,
//         dynamic: false,
//         dropdown: true
//     });
//     $('.time_picker__end').on('focus', function() {
//         if ($('.ui-timepicker-viewport').find('a:last').html() != '23:59') {
//             $('.ui-timepicker-viewport').append('<li class="ui-menu-item" style="width: 133.312px;"><a class="ui-corner-all">23:59</a></li>');
//         }
//     });
// });

$(function () {
    "use strict";
    if ($("input[data-sport-name]:checked").length > 0) {
        $(".default-price-title").show();
    } else {
        $(".default-price-title").hide();
    }
    $(".total-bookings-picker, .dome-revenue-picker").hide();
    if ($(".total-bookings-picker").length > 0) {
        $(".total-bookings-picker").flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            },
        });
    }
    if ($(".dome-revenue-picker").length > 0) {
        $(".dome-revenue-picker").flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            },
        });
    }
    initMap();
});

$("#adddome, #editdome").on("submit", function (event) {
    event.preventDefault();
    var check = 1;
    $(".time_picker__").each(function () {
        if ($.trim($(this).val()) == "") {
            $(this).addClass("is-invalid");
            check = 0;
        } else {
            $(this).removeClass("is-invalid");
        }
        if (check == 0) {
            return false;
        }
    });
    if (check == 0) {
        if ($("#add_working_hours").is(":hidden")) {
            $("#add_working_hours").modal("show");
        }
        return false;
    }
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            if (response.status == 1) {
                toastr.success(response.message);
                if(response.url){
                    location.href = response.url;
                }
            } else {
                toastr.error(response.message);
            }
            return false;
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        },
    });
});

function dome_revenue_chart(dome_revenue_labels, dome_revenue_data) {
    var options = {
        series: [
            {
                name: revenue,
                data: dome_revenue_data,
            },
        ],
        chart: {
            height: 400,
            type: "line",
            zoom: {
                enabled: false,
            },
            dropShadow: {
                enabled: true,
                color: "#000",
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2,
            },
            toolbar: {
                show: false,
            },
        },
        colors: [secondary_color],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return "$" + val.toFixed(2);
            },
        },
        tooltip: {
            x: {
                show: true,
            },
            y: {
                formatter: function (value, series) {
                    return "$" + value.toFixed(2);
                },
            },
        },
        stroke: {
            curve: "straight",
        },
        grid: {
            borderColor: "#e7e7e7",
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
        },
        markers: {
            size: 1,
        },
        xaxis: {
            categories: dome_revenue_labels,
        },
    };
    $("#dome_revenue_chart .apexcharts-canvas").remove();
    if (document.getElementById("dome_revenue_chart")) {
        var domerevenuechart = new ApexCharts(
            document.querySelector("#dome_revenue_chart"),
            options
        );
        domerevenuechart.render();
    }
}
$(".dome-revenue-filter").on("change", function () {
    if ($(this).val() == "custom_date") {
        $(".dome-revenue-picker").show();
        return false;
    } else {
        $(".dome-revenue-picker").hide();
    }
    domerevenuefilter("");
});

function domerevenuefilter(dates) {
    $.ajax({
        url: $(this).attr("data-next"),
        data: {
            filtertype: $(".dome-revenue-filter").val(),
            filterdates: dates,
        },
        method: "GET",
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $(".dome-revenue-count").html(response.dome_revenue);
            dome_revenue_chart(
                response.dome_revenue_labels,
                response.dome_revenue_data
            );
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        },
    });
}

function bookings_chart(bookings_labels, bookings_data, arr) {
    var bookings_data_colors = $.map(arr, function (val, i) {
        if (val == "primary_color") {
            return primary_color;
        } else if (val == "secondary_color") {
            return secondary_color;
        } else if (val == "danger_color") {
            return danger_color;
        } else {
            return val;
        }
    });
    var options = {
        series: bookings_data,
        chart: {
            height: 450,
            type: "pie",
        },
        labels: bookings_labels,
        colors: bookings_data_colors,
        responsive: [
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        show: false,
                        position: "bottom",
                    },
                },
            },
        ],
    };
    $("#bookings_chart .apexcharts-canvas").remove();
    if (document.getElementById("bookings_chart")) {
        var totalbookingschart = new ApexCharts(
            document.querySelector("#bookings_chart"),
            options
        );
        totalbookingschart.render();
    }
}
$(".total-bookings-filter").on("change", function () {
    if ($(this).val() == "custom_date") {
        $(".total-bookings-picker").show();
        return false;
    } else {
        $(".total-bookings-picker").hide();
    }
    totalbookingsfilter("");
});

function totalbookingsfilter(dates) {
    $.ajax({
        url: $(this).attr("data-next"),
        data: {
            filtertype: $(".total-bookings-filter").val(),
            filterdates: dates,
        },
        method: "GET",
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $(".total-bookings-count").html(response.total_bookings);
            bookings_chart(
                response.bookings_labels,
                response.bookings_data,
                response.bookings_data_colors
            );
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        },
    });
}

if (document.getElementById("textLat") && $("#textLat").val() != "") {
    var lat = parseFloat($("#textLat").val());
    var lng = parseFloat($("#textLng").val());
} else {
    var lat = 43.65107;
    var lng = -79.347015;
}

function initMap() {
    if (!document.getElementById("map_canvas")) {
        return false;
    }
    var myLatLng = {
        lat: lat,
        lng: lng,
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), {
        center: myLatLng,
        zoom: 13,
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: "Domez Location",
        draggable: false,
    });
    google.maps.event.addListener(marker, "dragend", function (marker) {
        var latLng = marker.latLng;
        var lat = (document.getElementById("textLat").innerHTML = latLng.lat());
        var lng = (document.getElementById("textLng").innerHTML = latLng.lng());
        $("#textLat").val(lat);
        $("#textLng").val(lng);
    });
    var autocomplete = new google.maps.places.Autocomplete(
        document.getElementById("address")
    );
    google.maps.event.addListener(autocomplete, "place_changed", function () {
        var place = autocomplete.getPlace();
        var latValue = place.geometry.location.lat();
        var lngValue = place.geometry.location.lng();
        var latInput = document.getElementById("textLat");
        var lngInput = document.getElementById("textLng");
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
        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            center: {
                lat: latValue,
                lng: lngValue,
            },
            zoom: 13,
        });
        var marker = new google.maps.Marker({
            position: {
                lat: latValue,
                lng: lngValue,
            },
            map: map,
            title: "Domez Location",
            draggable: false,
        });
        $("#pin_code").val(getZipCode(latInput.value, lngInput.value));
        $("#city").val(city.long_name);
        $("#state").val(state.long_name);
        $("#country").val(country.long_name);
    });
}

function getZipCode(lat, lng) {
    var zipcode = "";
    $.ajax({
        url:
            "https://maps.googleapis.com/maps/api/geocode/json?latlng=" +
            lat +
            "," +
            lng +
            "&key=AIzaSyCvlZaKvRSMouyH9pDgGC6pMGADfytOrsA",
        type: "GET",
        dataType: "json",
        async: false,
        headers: "",
        success: function (data) {
            var results = data.results;
            results[0].address_components.forEach((element) => {
                if (element.types[0] == "postal_code") {
                    zipcode = element.long_name;
                }
            });
        },
    });
    return zipcode;
}





$('#AddAgeDiscount .appendbtn').click(function(e) {
    e.preventDefault();
    var check = 1;
    $('#AddAgeDiscount select, #AddAgeDiscount input, #AgeDiscountFields select, #AgeDiscountFields input')
        .each(function(index, element) {
            if ($.trim($(element).val()) == "") {
                $(element).addClass('is-invalid');
                check = 0;
                return false
            } else {
                $(element).removeClass('is-invalid');
            }
            if (check == 0) {
                return false;
            }
        });
    if (check == 0) {
        return false;
    }

    var selectoptions = '';
    for (var i = 1; i <= 90; i++) {
        selectoptions += '<option value="'+i+'">'+i+'</option>';
    }

    var temp = Math.floor(Math.random() * 100);
    var clonedCode = $(
        '<div class="row"><div class="col-md-3"><div class="form-group"><label class="form-label" for="">' + label_age + '</label><select class="form-select" name="from_age[]"><option value="" selected="">' + label_from_age + '</option>'+selectoptions+'</select></div></div><div class="col-md-3"><div class="form-group"><label for="" class="form-label">&nbsp;</label><select class="form-select" name="to_age[]"><option value="" selected="">' + label_to + '</option>'+selectoptions+'</select></div></div><div class="col-md-2"><div class="form-group"><label for="age_discount_' + temp + '"class="form-label">' + label_discount + '</label><input type="number" max="100" min="0" class="form-control" name="age_discounts[]" id="age_discount_' + temp + '" placeholder="'+label_discount+'"></div></div><div class="col-md-3"><div class="form-group"><label for="discount_type_' + temp + '" class="form-label">' + label_discount_type + '</label><select class="form-select" id="discount_type_' + temp + '" name="discount_type[]"><option value="" selected>' + label_select + '</option><option value="1">' + label_in_percentage + '</option><option value="2">' + label_fixed + '</option></select></div></div><div class="col-md-1 d-flex align-items-end"><div class="form-group"><button type="button" class="btn btn-sm btn-outline-danger deletebtn"><i class="fa fa-close"></i> </button></div></div></div>');
    $("#AgeDiscountFields").append(clonedCode);
});
$("#AgeDiscountFields").on("click", ".deletebtn", function() {
    $(this).closest(".row").remove();
});
