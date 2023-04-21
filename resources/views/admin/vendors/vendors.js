$(function () {
    if (!is_vendor) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }
    $('.total-bookings-picker, .dome-revenue-picker').hide();
    if ($('body').find('.total-bookings-picker').length > 0) {
        $('.total-bookings-picker').flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            }
        });
    }
    if ($('body').find('.dome-revenue-picker').length > 0) {
        $('.dome-revenue-picker').flatpickr({
            mode: "range",
            maxDate: "today",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                totalbookingsfilter(dateStr);
            }
        });
    }
})
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
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "$"
            }
        },
        colors: [secondary_color],
        stroke: {
            curve: 'straight'
        },
        grid: {
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

function vendor_delete(id, status, url) {
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
                        id: id,
                        status: status,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 1) {
                            hidepreloader();
                            toastr.success("Success");
                            location.reload();
                        } else {
                            hidepreloader();
                            swal_cancelled(wrong);
                        }
                    },
                    failure: function (response) {
                        hidepreloader();
                        swal_cancelled(wrong);
                    },
                });
            }
            hidepreloader();
        });
}
