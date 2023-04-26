@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_details') }}
@endsection
@section('styles')
    <link rel="stylesheet" href={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.min.css') }}>
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_details') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/domes') }}">{{ trans('labels.domes') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.dome_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @if (Auth::user()->type == 1)
                <p class="mb-2 fw-semibold">{{ trans('labels.dome_owner') }}</p>
                <div class="d-flex bg-gray">
                    <div class=" col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7">{{ $getdomedata->dome_owner->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.status') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="badge rounded-pill cursor-pointer text-bg-{{ $getdomedata->dome_owner->is_available == 1 ? 'success' : 'danger' }}"
                                    onclick="change_status('{{ $getdomedata->dome_owner->id }}','{{ $getdomedata->dome_owner->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/vendors/change_status') }}')">{{ $getdomedata->dome_owner->is_available == 1 ? trans('labels.active') : trans('labels.inactive') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.email') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7">{{ $getdomedata->dome_owner->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.phone_number') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="text-muted fs-7">{{ $getdomedata->dome_owner->phone != '' ? '+1' . $getdomedata->dome_owner->phone : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <p class="mb-2 fw-semibold">{{ trans('labels.dome_details') }}</p>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.hst') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->hst . '%' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.start_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->start_time }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_address') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.end_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->end_time }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_description') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Str::limit($getdomedata->description, 50, '...') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.amenities') }}</label>
                        </div>
                        <div class="col-lg-8">
                            <ul class="d-flex flex-wrap">
                                @foreach (explode('|', $getdomedata->benefits) as $data)
                                    <li class="text-muted fs-7 me-3" style="list-style: inside">{{ $data }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.city') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->city }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.amenities_description') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span
                                class="text-muted fs-7">{{ Str::limit($getdomedata->benefits_description, 50, '...') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.pincode') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->pin_code }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-lg-4 col-md-2">
                            <label>{{ trans('labels.sports') }}</label>
                        </div>
                        <div class="col-lg-8 col-md-10">
                            <ul class="d-flex flex-wrap">
                                @foreach ($getsportslist as $sport)
                                    <li class="text-muted fs-7 me-3 " style="list-style: inside">{{ $sport->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.state') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->state }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.sports_price') }}</label>
                        </div>
                        <div class="col-md-8">
                            <ul class="d-flex flex-wrap">
                                @foreach ($getsportslist as $sport)
                                    <li class="text-muted fs-7 me-3 me-mb-0" style="list-style: inside">
                                        {{ Helper::currency_format(Helper::get_dome_price($getdomedata->id, $sport->id)) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.country') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->country }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 py-2 d-flex">
                <div class="col-12">
                    <label>{{ trans('labels.dome_images') }}</label>
                </div>
            </div>
            <div class="px-3 py-2 d-flex">
                @foreach ($getdomedata['dome_images'] as $images)
                    <div class="col-auto me-3">
                        <img src="{{ $images->image }}" alt="" width="100" height="60" class="rounded"
                            style="object-fit: cover; object-position:center;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
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
        @if (auth()->user()->type != 4)
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="col-auto">
                                <span class="text-muted fs-7">{{ trans('labels.dome_revenue') }}</span>
                                <p class="fw-semibold dome-revenue-count">{{ Helper::currency_format($dome_revenue) }}</p>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text"
                                    class="form-control me-2 bg-transparent border-primary dome-revenue-picker"
                                    placeholder="{{ trans('labels.select_date') }}">
                                <select class="form-select dome-revenue-filter"
                                    style="background-color: transparent;border-color:var(--bs-primary);"
                                    data-next="{{ URL::to('admin/domes/details-' . $getdomedata->id) }}">
                                    <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                    <option value="this_month">{{ trans('labels.this_month') }}</option>
                                    <option value="this_year">{{ trans('labels.this_year') }}</option>
                                    <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                                </select>
                            </div>
                        </div>
                        <div id="dome_revenue_chart"></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-auto">
                            <span class="text-muted fs-7">{{ trans('labels.total_bookings') }}</span>
                            <p class="fw-semibold total-bookings-count">{{ $total_bookings }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="text"
                                class="form-control me-2 bg-transparent border-primary total-bookings-picker"
                                placeholder="{{ trans('labels.select_date') }}">
                            <select class="form-select total-bookings-filter"
                                style="background-color: transparent;border-color:var(--bs-primary);"
                                data-next="{{ URL::to('admin/domes/details-' . $getdomedata->id) }}">
                                <option value="this_week" selected>{{ trans('labels.this_week') }}</option>
                                <option value="this_month">{{ trans('labels.this_month') }}</option>
                                <option value="this_year">{{ trans('labels.this_year') }}</option>
                                <option value="custom_date">{{ trans('labels.custom_date') }}</option>
                            </select>
                        </div>
                    </div>
                    <div id="bookings_chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.js') }}></script>
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script>
        // Dome Revenue Chart
        var revenue = {{ Js::from(trans('labels.revenue')) }}
        var dome_revenue_labels = {{ Js::from($dome_revenue_labels) }}
        var dome_revenue_data = {{ Js::from($dome_revenue_data) }}
        // Total Bookings Chart
        var bookings_labels = {{ Js::from($bookings_labels) }}
        var bookings_data = {{ Js::from($bookings_data) }}
        var arr = {{ Js::from($bookings_data_colors) }}
        $(function(params) {
            dome_revenue_chart(dome_revenue_labels, dome_revenue_data);
            bookings_chart(bookings_labels, bookings_data, arr);
        });
    </script>
    <script src="{{ url('resources/views/admin/domes/domes.js') }}"></script>
@endsection
