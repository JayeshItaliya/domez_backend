@extends('admin.layout.default')
@section('title')
    {{ trans('labels.calendar') }}
@endsection
@section('contents')
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
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.calendar') }}</p>
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
                        <li class="breadcrumb-item">{{ trans('labels.calendar') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <div id='calendar'></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src={{url('storage/app/public/admin/plugins/fullcalendar/index.global.min.js')}}></script>
    <script>
        $(function() {
            // start: {{ Js::from($booking->start_date) }} + ' ' + {{ Js::from($booking->start_time) }},
            // end: {{ Js::from($booking->start_date) }} + ' ' + {{ Js::from($booking->end_time) }},
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // initialDate: '2024-05-05',
                // eventDisplay: 'list-item',
                // timeFormat: 'h:mm a',
                initialView: 'timeGridWeek',
                dayMaxEvents: true,
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
                        // 'Start: ' + info.event.start.toLocaleString() + '<br>' +
                        // 'End: ' + info.event.end.toLocaleString() + '<br>' +
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
@endsection
