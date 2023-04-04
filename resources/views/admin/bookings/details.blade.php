@extends('admin.layout.default')
@section('title')
    {{ trans('labels.booking_details') }}
@endsection
@section('contents')
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
                    <a href="javascript:;" class="btn btn-outline-primary extend-time"
                        data-next="{{ URL::to('admin/bookings/extend-time') }}" data-booking-id="{{ $bookingdata->id }}"><i
                            class="fa fa-plus"></i> Extend Time </a>
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
                <form class="" action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger"
                            data-bs-dismiss="modal">{{ trans('labels.cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.extend-time').on('click', function() {
            "use strict";
            let html = $('.extend-time').html();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).attr('data-next'),
                data: {
                    booking_id: $(this).attr('data-booking-id'),
                },
                method: 'POST',
                beforeSend: function() {
                    $('.extend-time').attr('disabled', true);
                    $('.extend-time').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    );
                },
                success: function(response) {
                    $('.extend-time').html(html);
                    $('.extend-time').attr('disabled', false);
                    if (response.status == 1) {
                        $('#slotsmodal').modal('show');
                        var html = '<div class="row">';
                        response.slots.forEach(element => {
                            var btn = element.status == 1 ? 'btn btn-sm btn-outline-primary' :
                                'btn btn-sm btn-danger';
                            html +=
                                '<div class="col-auto"><label class="form-check-label ' + btn +
                                ' d-grid" for="check' + element.id +
                                '"><input class="form-check-input d-none" type="radio" name="flexRadioDefault" id="check' +
                                element.id +
                                '"><span>' + element.start_time + ' - ' + element.end_time +
                                '</span><b>' + element.price +
                                '</b></label></div>';
                        });
                        html += '</div>';
                        $('#slotsmodal .modal-body').html(html);
                        // toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                        return false;
                    }
                },
                error: function(e) {
                    $('.extend-time').attr('disabled', false);
                    $('.extend-time').html(html);
                    toastr.error(wrong);
                    return false;
                }
            });
        });
    </script>
@endsection
