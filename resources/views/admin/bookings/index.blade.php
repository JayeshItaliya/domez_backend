@extends('admin.layout.default')
@section('title')
    {{ trans('labels.bookings') }}
@endsection
@section('styles')
    <link rel="stylesheet" href={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.min.css') }}>
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.bookings') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
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
                        <input type="text" class="form-control date-range-picker" value="{{ $dates }}"
                            placeholder="{{ trans('labels.select_date') }}"
                            style="{{ $filter == 'custom-date' ? 'display:block;' : 'display:none;' }}">
                    </div>
                </div>
            </div>
            <table class="table table-nowrap mb-0" id="bootstrapTable">
                <thead>
                    <tr>
                        <th> {{ trans('labels.srno') }} </th>
                        <th> {{ trans('labels.booking_id') }} </th>
                        <th> {{ trans('labels.dome_owners') }} </th>
                        <th> {{ trans('labels.dome_name') }} </th>
                        <th> {{ trans('labels.booking_date') }} </th>
                        <th> {{ trans('labels.time') }} </th>
                        <th> {{ trans('labels.amount') }} </th>
                        <th> {{ trans('labels.payment_status') }} </th>
                        <th> {{ trans('labels.status') }} </th>
                        <th> {{ trans('labels.action') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($getbookingslist as $bookingdata)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $bookingdata->booking_id }}</td>
                            <td>{{ $bookingdata['dome_owner']->name }}</td>
                            <td>{{ $bookingdata['dome_name']->name }}</td>
                            <td>{{ Helper::date_format($bookingdata->start_date) }}</td>
                            <td>{{ Helper::time_format($bookingdata->start_time) }} -
                                {{ Helper::time_format($bookingdata->end_time) }}</td>
                            <td>{{ Helper::currency_format($bookingdata->total_amount) }}</td>
                            <td>
                                @if ($bookingdata->payment_status == 1)
                                    <span
                                        class="badge rounded-pill cursor-pointer complete-pill">{{ trans('labels.completed') }}</span>
                                @elseif ($bookingdata->payment_status == 3)
                                    <span
                                        class="badge rounded-pill cursor-pointer text-bg-danger">{{ trans('labels.refunded') }}</span>
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
                                <a class="cursor-pointer me-2" href="{{ URL::to('admin/bookings/details-' . $bookingdata->booking_id) }}"> {!! Helper::get_svg(1) !!} </a>
                                @if (in_array(Auth::user()->type, [2, 4]) && $bookingdata->booking_status == 2)
                                    <a class="cursor-pointer me-2" href="javascript:void(0)"
                                        onclick="deletedata('{{ $bookingdata->id }}','{{ URL::to('admin/bookings/cancel') }}')">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z"
                                                stroke="var(--bs-danger)" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697"
                                                stroke="var(--bs-danger)" stroke-linecap="round"
                                                stroke-linejoin="round" />
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
    <script src={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.js') }}></script>
    <script src="{{ url('resources/views/admin/bookings/bookings.js') }}"></script>
@endsection
