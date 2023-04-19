$(function () {
    $('.date-range-picker,.users-date-range-picker,.domez-date-range-picker,.bookings-overview-range-picker,.bookings-chart-date-range-picker').hide();
    $('.date-range-picker').flatpickr({
        mode: "range",
        maxDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates, dateStr, instance) {
            makeincomefilter(dateStr);
        }
    });
    $('.bookings-chart-date-range-picker').flatpickr({
        mode: "range",
        maxDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates, dateStr, instance) {
            makebookingfilter(dateStr);
        }
    });
    $('.users-date-range-picker').flatpickr({
        mode: "range",
        maxDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates, dateStr, instance) {
            makeusersfilter(dateStr);
        }
    });
    $('.domez-date-range-picker').flatpickr({
        mode: "range",
        maxDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates, dateStr, instance) {
            makedomeownersfilter(dateStr);
        }
    });
    $('.bookings-overview-range-picker').flatpickr({
        mode: "range",
        maxDate: "today",
        dateFormat: "Y-m-d",
        onClose: function (selectedDates, dateStr, instance) {
            makebookingsoverviewfilter(dateStr);
        }
    });
})

// Income Chart(Small)
create_income_chart(income_labels, income_data);

function create_income_chart(income_labels, income_data) {
    var options = {
        series: [{
            name: total_income_title,
            data: income_data
        }],
        chart: {
            group: 'sparklines',
            type: 'line',
            height: 100,
            sparkline: {
                enabled: true
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        colors: ['#fff'],
        fill: {
            opacity: 1,
        },
        xaxis: {
            categories: income_labels,
        },
        tooltip: {
            y: {
                formatter: function (income_data) {
                    return "$" + income_data.toFixed(2);
                }
            }
        }
    };
    $('#total_income .apexcharts-canvas').remove();
    if (document.getElementById("total_income")) {
        var incomechart = new ApexCharts(document.getElementById("total_income"), options);
        incomechart.render();
    }
}
$('.income-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.earning-card .date-range-picker').show();
        return false;
    } else {
        $('.earning-card .date-range-picker').hide();
    }
    makeincomefilter('')
});

function makeincomefilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.income-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-income').html(response.total_income_data_sum);
            create_income_chart(response.income_labels, response.income_data)
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}

// Bookings Chart(Small)
create_booking_chart(booking_labels, booking_data);

function create_booking_chart(booking_labels, booking_data) {
    var options = {
        series: [{
            name: total_bookings_title,
            data: booking_data
        }],
        chart: {
            group: 'sparklines',
            type: 'line',
            height: 100,
            sparkline: {
                enabled: true
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        colors: ['#fff'],
        fill: {
            opacity: 1,
        },
        xaxis: {
            categories: booking_labels,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val;
                }
            }
        }
    };
    $('#total_bookings .apexcharts-canvas').remove();
    if (document.getElementById("total_bookings")) {
        var bookingschart = new ApexCharts(document.getElementById("total_bookings"), options);
        bookingschart.render();
    }
}
$('.booking-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.confirm-booking-card .bookings-chart-date-range-picker').show();
        return false;
    } else {
        $('.confirm-booking-card .bookings-chart-date-range-picker').hide();
    }
    makebookingfilter('')
});

function makebookingfilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.booking-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-booking').html(response.total_bookings_count);
            create_booking_chart(response.booking_labels, response.booking_data);
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}
// Bookings Overview Chart
bookings_overview_chart(bookings_overview_labels, bookings_overview_data, arr);

function bookings_overview_chart(bookings_overview_labels, bookings_overview_data, arr) {
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
        chart: {
            type: 'donut',
            height: 350,
        },
        series: bookings_overview_data,
        labels: bookings_overview_labels,
        colors: bookings_data_colors,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    $('#bookings_overview_chart .apexcharts-canvas').remove();
    if (document.getElementById("bookings_overview_chart")) {
        var bookingsoverviewchart = new ApexCharts(document.getElementById("bookings_overview_chart"), options);
        bookingsoverviewchart.render();
    }
}
$('.bookings-overview-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.bookings-overview-range-picker').show();
        return false;
    } else {
        $('.bookings-overview-range-picker').hide();
    }
    makebookingsoverviewfilter('')
});

function makebookingsoverviewfilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.bookings-overview-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-bookings-overview-revenue').html(response.total_bookings_overview);
            bookings_overview_chart(response.bookings_overview_labels, response.bookings_overview_data,
                response.bookings_data_colors)
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}
// Total Revenue Chart
create_revenue_chart(revenue_labels, revenue_data);

function create_revenue_chart(revenue_labels, revenue_data) {
    var options = {
        series: [{
            name: revenue_title,
            data: revenue_data
        }],
        markers: {
            size: 6,
            colors: [secondary_color],
        },
        chart: {
            group: 'sparklines',
            type: 'area',
            height: 350,
            sparkline: {
                enabled: true
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        colors: [secondary_color],
        fill: {
            opacity: 1,
        },
        xaxis: {
            categories: revenue_labels,
        },
        tooltip: {
            y: {
                formatter: function (revenue_data) {
                    return "$" + revenue_data.toFixed(2);
                }
            }
        },
    };
    $('#revenue_chart .apexcharts-canvas').remove();
    if (document.getElementById("revenue_chart")) {
        var revenuechart = new ApexCharts(document.getElementById("revenue_chart"), options);
        revenuechart.render();
    }
}
$('.revenue-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.revenue-card .date-range-picker').show();
        return false;
    } else {
        $('.revenue-card .date-range-picker').hide();
    }
    makerevenuefilter('')
});

function makerevenuefilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.revenue-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-revenue').html(response.total_revenue_data_sum);
            create_revenue_chart(response.revenue_labels, response.revenue_data);
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}
// Total Users Chart
create_users_chart(users_labels, users_data);

function create_users_chart(users_labels, users_data) {
    var options = {
        series: [{
            name: users_title,
            data: users_data
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 4
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: [secondary_color + '40'],
        stroke: {
            show: true,
            width: 2,
            colors: [secondary_color]
        },
        xaxis: {
            categories: users_labels,
        },
        fill: {
            opacity: 1
        }
    };
    $('#users_chart .apexcharts-canvas').remove();
    if (document.getElementById("users_chart")) {
        var userschart = new ApexCharts(document.getElementById("users_chart"), options);
        userschart.render();
    }
}
$('.users-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.users-card .users-date-range-picker').show();
        return false;
    } else {
        $('.users-card .users-date-range-picker').hide();
    }
    makeusersfilter('')
});

function makeusersfilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.users-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-users').html(response.total_users_data_sum);
            create_users_chart(response.users_labels, response.users_data);
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}
// Total Dome Owners Chart
create_dome_owners_chart(dome_owners_labels, dome_owners_data);

function create_dome_owners_chart(dome_owners_labels, dome_owners_data) {
    var options = {
        series: [{
            name: dome_owners_title,
            data: dome_owners_data
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
                horizontal: true,
                borderRadius: 4,
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: [secondary_color + '40'],
        stroke: {
            show: true,
            width: 2,
            colors: [secondary_color]
        },
        xaxis: {
            categories: dome_owners_labels,
        },
        tooltip: {
            enabled: true,
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        fill: {
            opacity: 1
        }
    };
    $('#dome_owners_chart .apexcharts-canvas').remove();
    if (document.getElementById("dome_owners_chart")) {
        var dome_ownerschart = new ApexCharts(document.getElementById("dome_owners_chart"), options);
        dome_ownerschart.render();
    }
}
$('.dome-owners-filter').on('change', function () {
    if ($(this).val() == 'custom_date') {
        $('.dome-owners-card .domez-date-range-picker').show();
        return false;
    } else {
        $('.dome-owners-card .domez-date-range-picker').hide();
    }
    makedomeownersfilter('')
});

function makedomeownersfilter(dates) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            filtertype: $('.dome-owners-filter').val(),
            filterdates: dates,
        },
        method: 'GET',
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            $('.total-dome-owner').text(response.total_dome_owners_data_sum);
            create_dome_owners_chart(response.dome_owners_labels, response.dome_owners_data);
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        }
    });
}
