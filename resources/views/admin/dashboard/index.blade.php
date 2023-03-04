@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dashboard') }}
@endsection
@section('contents')
    <div class="dashboard">
        <div class="row">
            <div class="col-lg-4 mb-3 h-100">
                <div class="card earning-card">
                    <div class="card-body">
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
                        <h1 class="text-white mb-2">$54756.86</h1>
                        <p class="text-white text-opacity-75">Income</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 h-100">
                <div class="card confirm-booking-card">
                    <div class="card-body">
                        <div class="confirm-booking-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-stats"
                                width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                <path d="M18 14v4h4" />
                                <circle cx="18" cy="18" r="4" />
                                <path d="M15 3v4" />
                                <path d="M7 3v4" />
                                <path d="M3 11h16" />
                            </svg>
                        </div>
                        <h1 class="text-white mb-2">156</h1>
                        <p class="text-white text-opacity-75">Confirm Bookings</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 h-100">
                <div class="card pending-booking-card mb-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="pending-booking-icon mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time"
                                    width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                    <circle cx="18" cy="18" r="4" />
                                    <path d="M15 3v4" />
                                    <path d="M7 3v4" />
                                    <path d="M3 11h16" />
                                    <path d="M18 16.496v1.504l1 1" />
                                </svg>
                            </div>
                            <div class="mx-2">
                                <h6 class="text-white">78</h6>
                                <p class="text-white text-opacity-75 fs-7">Pending Bookings</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card cancel-booking-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="cancel-booking-icon mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus"
                                    width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <rect x="4" y="5" width="16" height="16" rx="2" />
                                    <line x1="16" y1="3" x2="16" y2="7" />
                                    <line x1="8" y1="3" x2="8" y2="7" />
                                    <line x1="4" y1="11" x2="20" y2="11" />
                                    <line x1="10" y1="16" x2="14" y2="16" />
                                </svg>
                            </div>
                            <div class="mx-2">
                                <h6 class="text-dark">78</h6>
                                <p class="text-dark text-opacity-50 fs-7">Cancelled Bookings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-3 h-100">
                <div class="card total-booking-chart">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="mb-2 text-muted">Total Bookings</p>
                                <h4>156</h4>
                            </div>
                            <a role="button" class="py-2 px-3 text-dark border-radius border dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Last 7 Days
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                        <div id="total_bookings"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3 h-100">
                <div class="card total-income-chart">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="content">
                                <p class="text-muted fw-500">Total Income</p>
                            </div>
                            <a role="button" class="px-2" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dots"
                                    width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="var(--bs-secondary)" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <circle cx="5" cy="12" r="1" />
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="19" cy="12" r="1" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                        </div>
                        <div id="total_income" class="mb-3"></div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-start justify-content-between">
                                <div class="content">
                                    <p class="fw-600 ">Apple Pay</p>
                                    <span class="text-muted fs-8">OI3v7zGMF7</span>
                                </div>
                                <p class="text-success fw-500">$500.00</p>
                            </li>
                            <li class="list-group-item d-flex align-items-start justify-content-between">
                                <div class="content">
                                    <p class="fw-600 ">Google Pay</p>
                                    <span class="text-muted fs-8">OI3v7zGMF7</span>
                                </div>
                                <p class="text-success fw-500">$564.00</p>
                            </li>
                            <li class="list-group-item d-flex align-items-start justify-content-between">
                                <div class="content">
                                    <p class="fw-600 ">Card</p>
                                    <span class="text-muted fs-8">OI3v7zGMF7</span>
                                </div>
                                <p class="text-success fw-500">$544.00</p>
                            </li>
                            <li class="list-group-item d-flex align-items-start justify-content-between">
                                <div class="content">
                                    <p class="fw-600 ">Apple Pay</p>
                                    <span class="text-muted fs-8">OI3v7zGMF7</span>
                                </div>
                                <p class="text-success fw-500">$745.00</p>
                            </li>
                            <li class="list-group-item d-flex align-items-start justify-content-between">
                                <div class="content">
                                    <p class="fw-600 ">Apple Pay</p>
                                    <span class="text-muted fs-8">OI3v7zGMF7</span>
                                </div>
                                <p class="text-success fw-500">$984.00</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <p class="mb-2 text-muted">Recent Bookings</p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover overflow-hidden" data-page-length='10'>
                        <thead class="table-secondary">
                            <tr>
                                <th>ID</th>
                                <th>Booking ID</th>
                                <th>Vendor Name</th>
                                <th>Dome Name</th>
                                <th>Dome Price</th>
                                <th>Booking Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#" class="text-decoration-underline">#8321847</a></td>
                                <td>Domez</td>
                                <td>Dome A</td>
                                <td>49$</td>
                                <td>26-Dec-2022</td>
                                <td>12:00 PM</td>
                                <td>4:00 PM</td>
                                <td><span class="badge rounded-pill text-bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="#" class="text-decoration-underline">#8321847</a></td>
                                <td>Domez</td>
                                <td>Dome A</td>
                                <td>49$</td>
                                <td>26-Dec-2022</td>
                                <td>12:00 PM</td>
                                <td>4:00 PM</td>
                                <td><span class="badge rounded-pill text-bg-danger">Cancelled</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="#" class="text-decoration-underline">#8321847</a></td>
                                <td>Domez</td>
                                <td>Dome A</td>
                                <td>49$</td>
                                <td>26-Dec-2022</td>
                                <td>12:00 PM</td>
                                <td>4:00 PM</td>
                                <td><span class="badge rounded-pill text-bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="#" class="text-decoration-underline">#8321847</a></td>
                                <td>Domez</td>
                                <td>Dome A</td>
                                <td>49$</td>
                                <td>26-Dec-2022</td>
                                <td>12:00 PM</td>
                                <td>4:00 PM</td>
                                <td><span class="badge rounded-pill text-bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><a href="#" class="text-decoration-underline">#8321847</a></td>
                                <td>Domez</td>
                                <td>Dome A</td>
                                <td>49$</td>
                                <td>26-Dec-2022</td>
                                <td>12:00 PM</td>
                                <td>4:00 PM</td>
                                <td><span class="badge rounded-pill text-bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="primaryColor" style="color: var(--bs-primary)"></div>
    <div id="secondaryColor" style="color: var(--bs-secondary)"></div>
    <div id="lightSecondaryColor" style="color: rgba(var(--bs-secondary-rgb),0.75)"></div>
@endsection
@section('scripts')
    <script>
        let primary_color = $('#primaryColor').css('color');
        let secondary_color = $('#secondaryColor').css('color');
        let light_secondary_color = $('#lightSecondaryColor').css('color');
    </script>
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script>
        // Total Bookings Chart
        var options = {
            series: [{
                name: 'Confirm',
                data: [44, 55, 41, 67, 22, 43, 18]
            }, {
                name: 'Pending',
                data: [13, 23, 20, 8, 13, 27, 26]
            }, {
                name: 'Cancelled',
                data: [11, 17, 15, 15, 21, 14, 35]
            }],
            chart: {
                type: 'bar',
                height: 500,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: false
                }
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
            plotOptions: {
                bar: {
                    horizontal: false,
                    dataLabels: {
                        total: {
                            enabled: false
                        }
                    }
                },
            },
            colors: [ primary_color, secondary_color, light_secondary_color],
            xaxis: {
                type: 'days',
                categories: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            },
            legend: {
                position: 'right',
                offsetY: 40
            },
            fill: {
                opacity: 1
            }
        };
        var chart = new ApexCharts(document.querySelector("#total_bookings"), options);
        chart.render();
        // Total Bookings Chart
        var options = {
            series: [{
                name: 'series1',
                data: [58, 86, 58, 51, 42, 109, 100]
            }],
            chart: {
                height: 200,
                type: 'area',
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            colors: [primary_color],
            xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                    "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                    "2018-09-19T06:30:00.000Z"
                ]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };
        var chart = new ApexCharts(document.querySelector("#total_income"), options);
        chart.render();
    </script>
@endsection
