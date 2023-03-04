@extends('admin.layout.default')
@section('title')
    Bookings
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Bookings</p>
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
                        <li class="breadcrumb-item">Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            @if (count($getbookingslist) > 0)
                <div class="filter_content">
                    <div class="row gx-2">
                        <div class="col-auto">
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled>Select</option>
                                <option value="all" selected>All</option>
                                <option value="domes">Domes</option>
                                <option value="leagues">Leagues</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select class="form-select" name="" id="">
                                <option value="" selected disabled>Select</option>
                                <option value="today" selected>Today</option>
                                <option value="last-7">Last 7 days</option>
                                <option value="this-month">This Month</option>
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <table class="table table-nowrap mb-0" id="bootstrapTable">
                <thead>
                    <tr>
                        <th> {{ trans('labels.srno') }} </th>
                        <th> {{ trans('labels.booking_id') }} </th>
                        <th> {{ trans('labels.dome_owner') }} </th>
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
    <script>
        $(function() {
            $(".filter_content").appendTo($(".fixed-table-toolbar .float-left"));
        });
        // Dome Delete
        function dome_delete(id, status, url) {
            "use strict";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2",
                    cancelButton: "btn btn-danger mx-2",
                },
                buttonsStyling: false,
            });
            swalWithBootstrapButtons
                .fire({
                    title: "Are You Sure?",
                    icon: "warning",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showCancelButton: true,
                    reverseButtons: true,
                })
                .then((result) => {
                    $("#preloader , #status").show();
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: url,
                            data: {
                                id: id,
                                status: status,
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    $("#preloader , #status").hide();
                                    toastr.success("Success");
                                    location.reload();
                                } else {
                                    $("#preloader , #status").hide();
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: wrong,
                                    });
                                }
                            },
                            failure: function(response) {
                                $("#preloader , #status").hide();
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: wrong,
                                });
                            },
                        });
                    }
                    $("#preloader , #status").hide();
                });
        }
    </script>
@endsection
