@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dashboard') }}
@endsection
@section('styles')
    <link rel="stylesheet" href={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.min.css') }}>
@endsection
@section('contents')
    <div class="dashboard">
        @if (in_array(Auth::user()->type, [1, 2]))
            <div class="row mb-3">
                <div class="col-md-6 mb-3 h-100">
                    <div class="card earning-card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-auto mb-3">
                                    <div class="earning-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-briefcase" width="25" height="25"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="white" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <rect x="3" y="7" width="18" height="13"
                                                rx="2" />
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
                                        <select class="form-select income-filter"
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
                                    <h1 class="text-white mb-2 total-income">
                                        {{ Helper::currency_format($total_revenue_data_sum) }}</h1>
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
                                            class="icon icon-tabler icon-tabler-calendar-stats" width="25"
                                            height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
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
                                            class="form-control me-2 bg-transparent bookings-chart-date-range-picker text-white"
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
        @endif
        <div class="row mb-3">
            <style>
                :root {
                    --fc-event-bg-color: var(--bs-primary);
                    --fc-event-border-color: var(--bs-primary);
                    --fc-today-bg-color: rgba(var(--bs-secondary-rgb), .15);
                }

                .fc-button {
                    background-color: transparent !important;
                    color: var(--bs-primary) !important;
                    border-color: var(--bs-primary) !important;
                }

                .fc-button.fc-button-active {
                    background-color: var(--bs-primary) !important;
                    color: white !important;
                    border-color: var(--bs-primary) !important;
                }

                .fc-prev-button,
                .fc-next-button {
                    background-color: transparent !important;
                    color: black !important;
                    border-color: transparent !important;
                }

                .fc-event-title {
                    font-size: 12px;
                    line-height: 1;
                }

                .fc-daygrid-event {
                    padding: 0 3px;
                }
            </style>
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
            @if (in_array(Auth::user()->type, [1, 2]))
                <div class="{{ Auth::user()->type == 2 ? 'col-lg-6' : 'col-12' }}">
                    <div class="card revenue-card" style="background: rgba(var(--bs-secondary-rgb),0.1)">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="content">
                                    <p class="mb-2 fw-500 text-muted">{{ trans('labels.revenue') }}</p>
                                    <h4 class="total-revenue">{{ Helper::currency_format($total_revenue_data_sum) }}</h4>
                                </div>
                                <div class="d-flex gap-2">
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
            @endif
            @if (in_array(Auth::user()->type, [2, 4]))
                <div class="{{ Auth::user()->type == 2 ? 'col-lg-6' : 'col-lg-12' }}">
                    <div class="card revenue-card" style="background: rgba(var(--bs-secondary-rgb),0.1)">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="content">
                                    <p class="mb-2 fw-500 text-muted">{{ trans('labels.bookings_overview') }}</p>
                                    <h4 class="total-bookings-overview-revenue">{{ $total_bookings_overview }}</h4>
                                </div>
                                <div class="d-flex gap-2">
                                    <input type="text"
                                        class="form-control me-2 bg-transparent border-primary bookings-overview-range-picker"
                                        placeholder="{{ trans('labels.select_date') }}">
                                    <select class="form-select bookings-overview-filter"
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
                        <div id="bookings_overview_chart"></div>
                    </div>
                </div>
            @endif
        </div>
        @if (Auth::user()->type == 1)
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card h-100 users-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="content">
                                    <p class="mb-2 fw-500 text-muted">{{ trans('labels.user_mobile_app') }}</p>
                                    <h4 class="total-users">{{ $total_users_data_sum }}</h4>
                                </div>
                                <div class="d-flex gap-2">
                                    <input type="text" class="form-control users-date-range-picker"
                                        placeholder="{{ trans('labels.select_date') }}">
                                    <select class="form-select w-auto users-filter"
                                        data-next="{{ URL::to('admin/dashboard') }}">
                                        <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                        <option value="this_month">{{ trans('labels.this_month') }}</option>
                                        <option value="this_year">{{ trans('labels.this_year') }}</option>
                                        <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="users_chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 dome-owners-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="content">
                                    <p class="mb-2 fw-500 text-muted">{{ trans('labels.dome_owners') }}</p>
                                    <h4 class="total-dome-owner">{{ $total_dome_owners_data_sum }}</h4>
                                </div>
                                <div class="d-flex gap-2">
                                    <input type="text" class="form-control domez-date-range-picker"
                                        placeholder="{{ trans('labels.select_date') }}">
                                    <select class="form-select w-auto dome-owners-filter"
                                        data-next="{{ URL::to('admin/dashboard') }}">
                                        <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                        <option value="this_month">{{ trans('labels.this_month') }}</option>
                                        <option value="this_year">{{ trans('labels.this_year') }}</option>
                                        <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div id="dome_owners_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script src={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.js') }}></script>
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script src={{ url('storage/app/public/admin/plugins/fullcalendar/index.global.min.js') }}></script>
    <script>
        // FUll CALENDAR
        $(function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                dayMaxEvents: true,
                contentHeight: '800px',
                headerToolbar: {
                    left: 'prev next today',
                    center: 'title',
                    right: 'dayGridMonth timeGridWeek timeGridDay listWeek'
                },
                events: [
                    @foreach ($getbookingslist as $booking)
                        {
                            title: "#{{ $booking->booking_id }}",
                            start: "{{ $booking->start_date }}",
                            url: "{{ URL::to('admin/bookings/details-' . $booking->booking_id) }}",
                            dome_name: '{{ $booking->dome_name != '' ? Str::limit($booking->dome_name->name, 20) : '' }}',
                            users_name: '{{ $booking->customer_name != '' ? Str::limit($booking->customer_name, 20) : '' }}',
                            league_name: '{{ $booking->league_id != '' ? Str::limit($booking->league_info->name, 20) : '' }}',
                            color: "{{ $booking->league_id != '' ? 'var(--bs-secondary)' : '' }}",
                        },
                    @endforeach
                ],
                eventContent: function(info) {
                    var title = '';
                    if (info.event.extendedProps.dome_name != "") {
                        title = '<b>{{ trans('labels.dome') }}</b> : ' + info.event.extendedProps
                            .dome_name;
                    }
                    if (info.event.extendedProps.users_name != "") {
                        title += '<br><b>{{ trans('labels.user') }}</b> : ' + info.event.extendedProps
                            .users_name;
                    }
                    if (info.event.extendedProps.league_name != "") {
                        title += '<br><b>{{ trans('labels.league') }}</b> : ' + info.event
                            .extendedProps.league_name;
                    }
                    return {
                        html: '<b> {{ trans('labels.booking_id') }} : ' + info.event.title +
                            '</b><br>' + title
                        // + 'Start: ' + info.event.start.toLocaleString() + '<br>' +
                        // + 'End: ' + info.event.end.toLocaleString() + '<br>' +
                    };
                }
            });
            calendar.render();
            fcChangeIconsPositions();
            $('button.fc-button').on('click', function() {
                fcChangeIconsPositions();
            });
        });

        function fcChangeIconsPositions() {
            $(".fc-event-main").addClass('text-wrap');
            $(".fc-toolbar-title").addClass('mx-3');
            $(".fc-toolbar-title").parent().addClass('d-flex align-items-center');
            $(".fc-toolbar-title").before($(".fc-prev-button"));
            $(".fc-toolbar-title").after($(".fc-next-button"));
            $(".fc-next-button").addClass('m-0');
            $('.fc-dayGridMonth-button').html('<i class="fa-light fa-grid-2"></i>');
            $('.fc-timeGridWeek-button').html('<i class="fa-regular fa-chart-tree-map"></i>');
            $('.fc-timeGridDay-button').html('<i class="fa-solid fa-grip-lines"></i>');
            $('.fc-listWeek-button').html('<i class="fa-regular fa-list-ol"></i>');
            $('.fc-today-button').text('Today');
        }
    </script>

    <script>
        // Income Chart(Small)
        var total_income_title = {{ Js::from(trans('labels.total_income')) }};
        var income_labels = {{ Js::from($income_labels) }};
        var income_data = {{ Js::from($income_data) }};
        // Bookings Chart(Small)
        var total_bookings_title = {{ js::from(trans('labels.total_bookings')) }};
        var booking_labels = {{ Js::from($booking_labels) }};
        var booking_data = {{ Js::from($booking_data) }};
        // Bookings Overview Chart
        var bookings_overview_labels = {{ Js::from($bookings_overview_labels) }};
        var bookings_overview_data = {{ Js::from($bookings_overview_data) }};
        var arr = {{ Js::from($bookings_data_colors) }};
        // Total Revenue Chart
        var revenue_title = {{ Js::from(trans('labels.revenue')) }};
        var revenue_labels = {{ Js::from($revenue_labels) }};
        var revenue_data = {{ Js::from($revenue_data) }};
        // Total Users Chart
        var users_title = {{ Js::from(trans('labels.users')) }};
        var users_labels = {{ Js::from($users_labels) }};
        var users_data = {{ Js::from($users_data) }};
        // Total Dome Owners Chart
        var dome_owners_title = {{ Js::from(trans('labels.dome_owners')) }};
        var dome_owners_labels = {{ Js::from($dome_owners_labels) }};
        var dome_owners_data = {{ Js::from($dome_owners_data) }};
        $(function(params) {
            create_income_chart(income_labels, income_data);
            create_booking_chart(booking_labels, booking_data);
            bookings_overview_chart(bookings_overview_labels, bookings_overview_data, arr);
            create_revenue_chart(revenue_labels, revenue_data);
            create_users_chart(users_labels, users_data);
            create_dome_owners_chart(dome_owners_labels, dome_owners_data);
        });
    </script>
    <script src="{{ url('resources/views/admin/dashboard/dashboard.js') }}"></script>
@endsection
