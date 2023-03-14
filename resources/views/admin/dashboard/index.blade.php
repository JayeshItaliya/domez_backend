@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dashboard') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('contents')
    <div class="dashboard">
        <div class="row mb-3">
            <div class="col-md-6 mb-3 h-100">
                <div class="card earning-card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto mb-3">
                                <div class="earning-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase"
                                        width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <rect x="3" y="7" width="18" height="13" rx="2" />
                                        <path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                        <line x1="12" y1="12" x2="12" y2="12.01" />
                                        <path d="M3 13a20 20 0 0 0 18 0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-auto mb-3" style="z-index:9;">
                                <div class="d-flex">
                                    <input type="text"
                                        class="form-control me-2 bg-transparent date-range-picker text-white"
                                        placeholder="{{ trans('labels.select_date') }}">
                                    <select class="form-select income-filter" data-next="{{ URL::to('admin/dashboard') }}">
                                        <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                        <option value="this_month">{{ trans('labels.this_month') }}</option>
                                        <option value="this_year">{{ trans('labels.this_year') }}</option>
                                        <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-white mb-2 total-income">
                                    {{ Helper::currency_format($total_income_data_sum) }}</h1>
                                <p class="text-white text-opacity-75">{{ trans('labels.total_income') }}</p>
                            </div>
                            <div class="col-md-6" style="z-index: 9;">
                                <div id="total_income"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 h-100">
                <div class="card confirm-booking-card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-auto mb-3">
                                <div class="confirm-booking-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-calendar-stats" width="25" height="25"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                        <path d="M18 14v4h4" />
                                        <circle cx="18" cy="18" r="4" />
                                        <path d="M15 3v4" />
                                        <path d="M7 3v4" />
                                        <path d="M3 11h16" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-auto mb-3" style="z-index:9;">
                                <div class="d-flex">
                                    <input type="text"
                                        class="form-control me-2 bg-transparent date-range-picker text-white"
                                        placeholder="{{ trans('labels.select_date') }}">
                                    <select class="form-select booking-filter"
                                        data-next="{{ URL::to('admin/dashboard') }}">
                                        <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                        <option value="this_month">{{ trans('labels.this_month') }}</option>
                                        <option value="this_year">{{ trans('labels.this_year') }}</option>
                                        <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-white mb-2 total-booking">{{ $total_bookings_count }}</h1>
                                <p class="text-white text-opacity-75">{{ trans('labels.total_bookings') }}</p>
                            </div>
                            <div class="col-md-6" style="z-index: 9;">
                                <div id="total_bookings"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card revenue-card" style="background: rgba(var(--bs-secondary-rgb),0.1)">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="mb-2 fw-500 text-muted">{{ trans('labels.revenue') }}</p>
                                <h4 class="total-revenue">{{ Helper::currency_format($total_revenue_data_sum) }}</h4>
                            </div>
                            <div class="d-flex">
                                <input type="text"
                                    class="form-control me-2 bg-transparent date-range-picker border-primary"
                                    placeholder="{{ trans('labels.select_date') }}">
                                <select class="form-select revenue-filter"
                                    style="background-color: transparent;border-color:var(--bs-primary);"
                                    data-next="{{ URL::to('admin/dashboard') }}">
                                    <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                    <option value="this_month">{{ trans('labels.this_month') }}</option>
                                    <option value="this_year">{{ trans('labels.this_year') }}</option>
                                    <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="revenue_chart"></div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="mb-2 fw-500 text-muted">{{ trans('labels.user_mobile_app') }}</p>
                                <h4>6874</h4>
                            </div>
                            <select class="form-select w-auto" name="" id="">
                                <option value="this-week">{{ trans('labels.this_week') }}</option>
                                <option value="this-month">{{ trans('labels.this_month') }}</option>
                                <option value="this-year">{{ trans('labels.this_year') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="users_chart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="mb-2 fw-500 text-muted">{{ trans('labels.dome_owners') }}</p>
                                <h4>685</h4>
                            </div>
                            <select class="form-select w-auto" id="dome_owner_filter">
                                <option value="this-week">{{ trans('labels.this_week') }}</option>
                                <option value="this-month">{{ trans('labels.this_month') }}</option>
                                <option value="this-year">{{ trans('labels.this_year') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="dome_owner_chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script>
        $(function() {
            $('.date-range-picker').hide();
            $('.date-range-picker').flatpickr({
                mode: "range",
                maxDate: "today",
                dateFormat: "Y-m-d",
                onClose: function(selectedDates, dateStr, instance) {
                    makeincomefilter(dateStr)
                }
            });
        })
    </script>
    <script>
        // Total Income Chart
        var income_labels = {{ Js::from($income_labels) }}
        var income_data = {{ Js::from($income_data) }}
        create_income_chart(income_labels, income_data);

        function create_income_chart(income_labels, income_data) {
            var options = {
                series: [{
                    name: '{{ trans('labels.total_income') }}',
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
            };
            $('#total_income .apexcharts-canvas').remove();
            var incomechart = new ApexCharts(document.querySelector("#total_income"), options);
            incomechart.render();
        }
        // Total Income Filter
        $('.income-filter').on('change', function() {
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
                beforeSend: function() {
                    showpreloader();
                },
                success: function(response) {
                    hidepreloader();
                    $('.total-income').html(response.total_income_data_sum);
                    create_income_chart(response.income_labels, response.income_data)
                    console.table(income_labels);
                },
                error: function(e) {
                    hidepreloader();
                    toastr.error(wrong);
                    return false;
                }
            });
        }
    </script>


    <script>
        // Total Bookings Chart
        var booking_labels = {{ Js::from($booking_labels) }}
        var booking_data = {{ Js::from($booking_data) }}
        create_booking_chart(booking_labels, booking_data);

        function create_booking_chart(booking_labels, booking_data) {
            var options = {
                series: [{
                    name: '{{ trans('labels.total_bookings') }}',
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
            };
            $('#total_bookings .apexcharts-canvas').remove();
            var bookingschart = new ApexCharts(document.querySelector("#total_bookings"), options);
            bookingschart.render();
        }
        // Total Bookings Filter
        $('.booking-filter').on('change', function() {
            if ($(this).val() == 'custom_date') {
                $('.confirm-booking-card .date-range-picker').show();
                return false;
            } else {
                $('.confirm-booking-card .date-range-picker').hide();
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
                beforeSend: function() {
                    showpreloader();
                },
                success: function(response) {
                    hidepreloader();
                    $('.total-booking').html(response.total_bookings_count);
                    create_booking_chart(response.booking_labels, response.booking_data);
                },
                error: function(e) {
                    hidepreloader();
                    toastr.error(wrong);
                    return false;
                }
            });
        }
    </script>


    <script>
        // Total Revenue Chart
        var revenue_labels = {{ Js::from($revenue_labels) }}
        var revenue_data = {{ Js::from($revenue_data) }}
        create_revenue_chart(revenue_labels, revenue_data);

        function create_revenue_chart(revenue_labels, revenue_data) {
            console.log(revenue_data);
            var options = {
                series: [{
                    name: '{{ trans('labels.total_revenue') }}',
                    data: revenue_data
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
                colors: [primary_color],
                fill: {
                    opacity: 1,
                },
                xaxis: {
                    categories: revenue_labels,
                },
            };
            $('#revenue_chart .apexcharts-canvas').remove();
            var revenuechart = new ApexCharts(document.querySelector("#revenue_chart"), options);
            revenuechart.render();
        }
        // Total Revenue Filter
        $('.revenue-filter').on('change', function() {
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
                beforeSend: function() {
                    showpreloader();
                },
                success: function(response) {
                    hidepreloader();
                    $('.total-revenue').html(response.total_revenue_data_sum);
                    create_revenue_chart(response.revenue_labels, response.revenue_data);
                },
                error: function(e) {
                    hidepreloader();
                    toastr.error(wrong);
                    return false;
                }
            });
        }
    </script>






















    <script>
        // Total Users Of Mobile Chart
        var options = {
            series: [{
                name: 'Users',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 4,
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#57A70040'],
            stroke: {
                show: true,
                width: 2,
                colors: [secondary_color]
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.querySelector("#users_chart"), options);
        chart.render();


        // Total Dome Owner Chart
        $('#dome_owner_filter').on('change', function() {
            alert(123);
        });
        var options = {
            series: [{
                name: 'Dome Owners',
                data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            colors: ['#468F7240'],
            stroke: {
                show: true,
                width: 2,
                colors: ['#468F72']
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
                    'United States', 'China', 'Germany'
                ],
            }
        };
        var chart = new ApexCharts(document.querySelector("#dome_owner_chart"), options);
        chart.render();
    </script>
@endsection
