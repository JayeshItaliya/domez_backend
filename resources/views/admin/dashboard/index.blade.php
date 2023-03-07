@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dashboard') }}
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
                                <select name="" id="" class="form-select income-filter">
                                    <option value="" selected>{{ trans('labels.this_week') }}</option>
                                    <option value="">{{ trans('labels.this_month') }}</option>
                                    <option value="">{{ trans('labels.this_year') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-white mb-2">{{ Helper::currency_format('54842') }}</h1>
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
                                <select name="" id="" class="form-select booking-filter">
                                    <option value="" selected>{{ trans('labels.this_week') }}</option>
                                    <option value="">{{ trans('labels.this_month') }}</option>
                                    <option value="">{{ trans('labels.this_year') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="text-white mb-2">156</h1>
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
                <div class="card" style="background: rgba(var(--bs-secondary-rgb),0.1)">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="mb-2 fw-500 text-muted">{{ trans('labels.revenue') }}</p>
                                <h4>{{ Helper::currency_format('54842') }}</h4>
                            </div>
                            <select class="form-select w-auto" name="" id=""
                                style="background-color: transparent;border-color:var(--bs-primary);">
                                <option value="this-week">{{ trans('labels.this_week') }}</option>
                                <option value="this-month">{{ trans('labels.this_month') }}</option>
                                <option value="this-year">{{ trans('labels.this_year') }}</option>
                            </select>
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
    <script></script>
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script>

        // Total Income Chart
        var options = {
            series: [{
                name:'{{trans('labels.total_income')}}',
                data: [10, 41, 35, 99, 26, 75, 15]
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
                type: 'days',
                categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#total_income"), options);
        chart.render();


        // Total Bookings Chart
        var options = {
            series: [{
                name:'{{trans('labels.bookings')}}',
                data: [10, 41, 35, 99, 26, 75, 15]
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
                type: 'days',
                categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#total_bookings"), options);
        chart.render();


        // Total Revenue Chart
        var options = {
            series: [{
                name:'{{trans('labels.revenue')}}',
                data: [10, 41, 35, 99, 26, 75, 15]
            }],
            chart: {
                group: 'sparklines',
                type: 'area',
                height: 300,
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
                type: 'days',
                categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            },
        };
        var chart = new ApexCharts(document.querySelector("#revenue_chart"), options);
        chart.render();


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
        $('#dome_owner_filter').on('change', function(){
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
