@extends('admin.layout.default')
@section('title')
    {{ trans('labels.booking_details') }}
@endsection
@section('contents')
    <style>
        .d-none+label {
            font-weight: bold;
        }

        .d-none.main-slots:checked+label {
            color: white !important;
            background-color: var(--bs-primary);
        }

        .d-none.new-slot-radio+label {
            border: 1px solid transparent;
        }

        .d-none.new-slot-radio:checked+label {
            color: var(--bs-primary);
            border: 1px solid var(--bs-primary);
            background-color: var(--bs-primary-rgb);
        }
    </style>
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.booking_details') }}</p>
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
                        <li class="breadcrumb-item"><a
                                href="{{ URL::to('admin/bookings') }}">{{ trans('labels.bookings') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.booking_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        @if (!empty($bookingdata))
            <div class="card-body">
                <div class="d-flex justify-content-between my-4">
                    <h4 class="fw-semibold">{{ trans('labels.booking_id') }} - {{ $bookingdata->booking_id }}</h4>

                    @if (Auth::user()->type == 2 || Auth::user()->type == 4)
                        <a href="javascript:;" class="btn btn-outline-primary extend-time" data-bs-toggle="modal"
                            data-bs-target="#slotsmodal"><i class="fa fa-plus"></i> Extend Time </a>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4"> <label>{{ trans('labels.dome_owner') }}</label> </div>
                        <div class="col-md-8"> <span
                                class="text-muted fs-7 mx-3">{{ $bookingdata['dome_owner']->name }}</span> </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4"> <label>{{ trans('labels.dome_name') }}</label> </div>
                            <div class="col-md-8"> <span
                                    class="text-muted fs-7 mx-3">{{ $bookingdata['dome_name']->name }}</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4"> <label>{{ trans('labels.field_name') }}</label> </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">{{ $bookingdata->field_id }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.customer_name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ $bookingdata['user_info']->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.customer_email') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">{{ $bookingdata['user_info']->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class=" col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.customer_phone') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ $bookingdata['user_info']->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.players') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">{{ $bookingdata->players }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.booking_date') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="text-muted fs-7 mx-3">{{ Helper::date_format($bookingdata->start_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.start_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">{{ Helper::time_format($bookingdata->start_time) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.end_time') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ Helper::time_format($bookingdata->end_time) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.total_amount') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span
                                class="text-muted fs-7 mx-3">{{ Helper::currency_format($bookingdata->total_amount) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.paid_amount') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="text-muted fs-7 mx-3">{{ Helper::currency_format($bookingdata->paid_amount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.due_amount') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span
                                class="text-muted fs-7 mx-3">{{ Helper::currency_format($bookingdata->due_amount) }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.refunded_amount') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="text-muted fs-7 mx-3">{{ Helper::currency_format($bookingdata->refunded_amount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.payment_status') }}</label>
                        </div>
                        <div class="col-md-8">
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
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-4">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.status') }}</label>
                            </div>
                            <div class="col-md-8">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <img class="img-fluid w-50" src="{{ Helper::image_path('no_data.svg') }}">
            </div>
        @endif
    </div>

    <div class="modal fade" id="slotsmodal" tabindex="-1" aria-labelledby="slotsmodalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="slotsmodalLabel">Slots</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($slots as $key => $slot)
                            <div class="col-lg-4 col-6">
                                {{-- data-picker-start-time="{{ date('h:i A', strtotime('+60 minutes', strtotime($slot->end_time))) }}" --}}
                                <input class="form-check-input d-none main-slots" type="radio" name="flexRadioDefault"
                                    id="check{{ $key }}" {{ $slot->status == 0 ? 'disabled' : '' }}
                                    data-booking-id="{{ $bookingdata->booking_id }}" data-slot-id="{{ $slot->id }}"
                                    data-start-time="{{ date('h:i A', strtotime($slot->start_time)) }}"
                                    data-end-time="{{ date('h:i A', strtotime($slot->end_time)) }}"
                                    data-price="{{ $slot->price }}" data-show-target="hidden{{ $key }}">


                                {{--
                                    @if (\Carbon\Carbon::parse($slot->end_time) < \Carbon\Carbon::now()->format('H:i'))
                                        <p>End time is less than the current time</p>
                                    @else
                                        <p>End time is greater than or equal to the current time</p>
                                    @endif
                                 --}}

                                <label
                                    class="form-check-label d-grid my-2 rounded text-center {{ $slot->status == 1 ? 'border border-secondary text-secondary' : 'bg-dark text-white' }}"
                                    for="check{{ $key }}">
                                    <span>{{ date('h:i A', strtotime($slot->start_time)) }} -
                                        {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                                    <b>{{ Helper::currency_format($slot->price) }}</b>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="lists"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger"
                        data-bs-dismiss="modal">{{ trans('labels.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var start_time = '';
        var booking_id = {{ Js::from($bookingdata->booking_id) }};
        $('.d-none').on('change', function() {
            "use strict";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                url: location.href,
                data: {
                    booking_id: booking_id,
                    slot_id: $(this).attr('data-slot-id'),
                },
                method: 'get',
                beforeSend: function(response) {
                    $('.' + $(this).attr('data-show-target')).show();
                    $('.lists').html(
                        '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                    );
                },
                success: function(response) {
                    if (response.status == 0) {
                        toastr.error(response.message);
                    } else {
                        $('.lists').html(response.slots);
                        toastr.success(response.message);
                    }
                    return false;
                },
                error: function(e) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });

        var my_val = '';
        var old_slot_id = '';
        var new_slot_id = '';
        var slot_price = '';
        var slot = '';

        function manageslot(el) {
            my_val = $(el).val();
            old_slot_id = $(el).attr('data-old-slot-id');
            new_slot_id = $(el).attr('data-new-slot-id');
            slot_price = $(el).attr('data-slot-price');
            slot = $(el).attr('data-slot');
            $('.lists button[type="button"]:hidden').show();
        }

        function submitdata() {
            // $('#slotsmodal').modal('hide')
            // $('.lists').html('')
            // $('.d-none.main-slots:checked').prop('checked', false)
            var html = $('.lists').html();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                url: location.href,
                data: {
                    manage_slot: 1,
                    booking_id: booking_id,
                    slot_time: my_val,
                    slot: slot,
                    old_slot_id: old_slot_id,
                    new_slot_id: new_slot_id,
                    slot_price: slot_price,
                },
                method: 'get',
                beforeSend: function(response) {
                    $('.lists').html(
                        '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                    );
                },
                success: function(response) {
                    if (response.status == 0) {
                        $('.lists').html(html);
                        $('.lists button[type="button"]').hide();
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        location.reload()
                    }
                    return false;
                },
                error: function(e) {
                    $('.lists').html(html);
                    $('.lists button[type="button"]').hide();
                    toastr.error(wrong);
                    return false;
                }
            });

            // Swal.fire({
            //     title: 'Enter the price',
            //     input: 'text',
            //     inputPlaceholder: 'Enter the price',
            //     inputAttributes: {
            //         type: 'number',
            //         min: 0,
            //         step: 0.01
            //     },
            //     showCancelButton: true,
            //     confirmButtonText: 'Submit',
            //     cancelButtonText: 'Cancel',
            //     allowOutsideClick: false,
            //     preConfirm: function(price) {
            //         // You can perform some validation here
            //         // If the validation fails, return false to prevent the dialog from closing
            //         // Otherwise, return the validated value
            //         if (price <= 0) {
            //             Swal.showValidationMessage('Price must be greater than zero');
            //             return false;
            //         }
            //         return price;
            //     }
            // }).then(function(result) {
            //     if (result.value) {
            //         // Do something with the validated price value
            //         console.log(result.value);
            //     }
            // });
        }
    </script>
@endsection
