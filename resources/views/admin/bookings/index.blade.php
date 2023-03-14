@extends('admin.layout.default')
@section('title')
    {{ trans('labels.bookings') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.bookings') }}</p>
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
                        <li class="breadcrumb-item">{{ trans('labels.bookings') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <div class="filter_content">
                <div class="row gx-2">
                    @php
                        $type = request()->get('type') != '' ? request()->get('type') : '';
                        $filter = request()->get('filter') != '' ? request()->get('filter') : '';
                        $dates = request()->get('dates') != '' ? request()->get('dates') : '';
                    @endphp
                    <div class="col-auto">
                        <select class="form-select" name="type" id="type"
                            onchange="location.href=$(this).find(':selected').attr('data-url')">
                            <option value="" selected disabled>{{ trans('labels.select') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=all&filter=' . $filter) }}" value="all"
                                {{ $type == 'all' || $type == '' ? 'selected' : '' }}>{{ trans('labels.all') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=domes&filter=' . $filter) }}" value="domes"
                                {{ $type == 'domes' ? 'selected' : '' }}>{{ trans('labels.domes') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=leagues&filter=' . $filter) }}"
                                value="leagues" {{ $type == 'leagues' ? 'selected' : '' }}>{{ trans('labels.leagues') }}
                            </option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" name="filter" id="filter"
                            onchange="$(this).val() != 'custom-date' ? location.href=$(this).find(':selected').attr('data-url') : $('.date-range-picker').show() ">
                            <option data-url="{{ URL::to('admin/bookings?type=' . $type . '&filter=this-week') }}"
                                value="this-week" {{ $filter == 'this-week' || $filter == '' ? 'selected' : '' }}>
                                {{ trans('labels.this_week') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=' . $type . '&filter=this-month') }}"
                                value="this-month" {{ $filter == 'this-month' ? 'selected' : '' }}>
                                {{ trans('labels.this_month') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=' . $type . '&filter=this-year') }}"
                                value="this-year" {{ $filter == 'this-year' ? 'selected' : '' }}>
                                {{ trans('labels.this_year') }}</option>
                            <option data-url="{{ URL::to('admin/bookings?type=' . $type . '&filter=custom-date') }}"
                                value="custom-date" {{ $filter == 'custom-date' ? 'selected' : '' }}>
                                {{ trans('labels.custom_date') }}</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <input type="text" class="form-control date-range-picker" value="{{ $dates }}" placeholder="{{ trans('labels.select_date') }}" style="{{ $filter == 'custom-date' ? 'display:block;' : 'display:none;' }}">
                    </div>
                </div>
            </div>
            <table class="table table-nowrap mb-0" id="bootstrapTable">
                <thead>
                    <tr>
                        <th data-sortable="true"> {{ trans('labels.srno') }} </th>
                        <th data-sortable="true"> {{ trans('labels.booking_id') }} </th>
                        <th data-sortable="true"> {{ trans('labels.dome_owner') }} </th>
                        <th data-sortable="true"> {{ trans('labels.dome_name') }} </th>
                        <th data-sortable="true"> {{ trans('labels.booking_date') }} </th>
                        <th data-sortable="true"> {{ trans('labels.time') }} </th>
                        <th data-sortable="true"> {{ trans('labels.amount') }} </th>
                        <th data-sortable="true"> {{ trans('labels.payment_status') }} </th>
                        <th data-sortable="true"> {{ trans('labels.status') }} </th>
                        <th data-sortable="true"> {{ trans('labels.action') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($getbookingslist as $bookingdata)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bookingdata->booking_id }}</td>
                            <td>{{ $bookingdata['dome_owner']->name }}</td>
                            <td>{{ $bookingdata['dome_name']->name }}</td>
                            <td>{{ Helper::date_format($bookingdata->booking_date) }}</td>
                            <td>{{ Helper::time_format($bookingdata->start_time) }} -
                                {{ Helper::time_format($bookingdata->end_time) }}</td>
                            <td>{{ Helper::currency_format($bookingdata->total_amount) }}</td>
                            <td>
                                @if ($bookingdata->payment_status == 1)
                                    <span
                                        class="badge rounded-pill cursor-pointer complete-pill">{{ trans('labels.completed') }}</span>
                                @else
                                    <span
                                        class="badge rounded-pill cursor-pointer partial-pill">{{ trans('labels.partial') }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($bookingdata->booking_status == 1)
                                    <span
                                        class="badge rounded-pill cursor-pointer text-bg-success">{{ trans('labels.confirmed') }}</span>
                                @elseif ($bookingdata->booking_status == 2)
                                    <span
                                        class="badge rounded-pill cursor-pointer text-bg-warning">{{ trans('labels.pending') }}</span>
                                @else
                                    <span
                                        class="badge rounded-pill cursor-pointer text-bg-danger">{{ trans('labels.cancelled') }}</span>
                                @endif
                            </td>
                            <td>
                                <a class="cursor-pointer me-2"
                                    href="{{ URL::to('admin/bookings/details-' . $bookingdata->booking_id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path
                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                        </path>
                                    </svg>
                                </a>
                                @if (Auth::user()->type == 2)
                                    <a class="cursor-pointer me-2"
                                        href="{{ URL::to('admin/bookings/details-' . $bookingdata->booking_id) }}">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z"
                                                stroke="#616161" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697"
                                                stroke="#616161" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function() {
            $(".filter_content").appendTo($(".fixed-table-toolbar .float-left"));
            $('.date-range-picker').flatpickr({
                mode: "range",
                // maxDate: "today",
                placeHolder: "Select Date",
                dateFormat: "Y-m-d",
                onClose: function(selectedDates, dateStr, instance) {
                    window.location.href = window.location.href.replace(window.location.search, '') +
                        "?type=" + $('#type').val() + "&filter=" + $('#filter').val() + "&dates=" +
                        dateStr;
                }
            });
        });
    </script>
@endsection
