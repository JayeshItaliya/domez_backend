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
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a
                                href="{{ URL::to('admin/bookings') }}">{{ trans('labels.bookings') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.booking_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card extend-time-only">
        @if (!empty($bookingdata))
            <div class="card-body">
                <div class="d-flex justify-content-between my-4">
                    <h4 class="fw-semibold">{{ trans('labels.booking_id') }} - {{ $bookingdata->booking_id }}</h4>
                    @if (
                        (auth()->user()->type == 2 || auth()->user()->type == 4) &&
                            date('Y-m-d') == date('Y-m-d', strtotime($bookingdata->start_date)) &&
                            $bookingdata->league_id == '')
                        <a href="javascript:;" class="btn btn-outline-primary extend-time" data-bs-toggle="modal"
                            data-bs-target="#slotsmodal"><i class="fa fa-plus"></i> {{ trans('labels.extend_time') }} </a>
                    @endif
                </div>
                @if ($bookingdata->type == 2)
                    <div class="bg-gray">
                        <div class="col-lg-5">
                            <div class="px-3 py-2 d-flex">
                                <div class="col-md-4"> <label>{{ trans('labels.league_name') }}</label> </div>
                                <div class="col-md-8"> <span
                                        class="text-muted fs-7 mx-3">{{ $bookingdata['league_info']->name }}</span> </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-5">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4"> <label>{{ trans('labels.dome_owner') }}</label> </div>
                        <div class="col-md-8"> <span
                                class="text-muted fs-7 mx-3">{{ $bookingdata['dome_owner']->name }}</span> </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-5">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4"> <label>{{ trans('labels.dome_name') }}</label> </div>
                            <div class="col-md-8"> <span
                                    class="text-muted fs-7 mx-3">{{ $bookingdata['dome_name']->name }}</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4"> <label>{{ trans('labels.field_name') }}</label> </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">{{ $bookingdata->fields_name() }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray">
                    <div class="col-lg-5">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.customer_name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ $bookingdata['user_info']->name ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
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
                    <div class=" col-lg-5">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.customer_phone') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ $bookingdata['user_info']->phone ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
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
                    <div class="col-lg-5">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ $bookingdata->type == 1 ? trans('labels.booking_date') : trans('labels.date') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7 mx-3">{{ Helper::date_format($bookingdata->start_date) }}
                                    {{ $bookingdata->type == 2 ? trans('labels.to') . ' ' . Helper::date_format($bookingdata->end_date) : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
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
                    <div class="col-lg-5">
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
                <div class="col-lg-5">
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
                    <div class="col-lg-5">
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
                <div class="col-lg-5">
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
                    <div class="col-lg-5">
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
                <div class="col-lg-5">
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
                    <div class="col-lg-5">
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
    <div class="modal fade" id="slotsmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="slotsmodalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="slotsmodalLabel">{{ trans('labels.slots') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach ($slots as $key => $slot)
                            <div class="col-lg-4 col-6">
                                @php
                                    $inputattr = '';
                                    $labelcolor = 'border border-primary text-primary';
                                    if ($slot->status == 0 || \Carbon\Carbon::parse($slot->end_time) < \Carbon\Carbon::now() || \Carbon\Carbon::parse($slot->end_time) < \Carbon\Carbon::parse($bookingdata->end_time)) {
                                        $inputattr = 'disabled';
                                        $labelcolor = 'bg-dark text-white';
                                    }
                                @endphp
                                <input class="form-check-input d-none main-slots" type="radio" name="flexRadioDefault"
                                    id="check{{ $key }}" {{ $inputattr }}
                                    data-booking-id="{{ $bookingdata->booking_id }}" data-slot-id="{{ $slot->id }}"
                                    data-start-time="{{ date('h:i A', strtotime($slot->start_time)) }}"
                                    data-end-time="{{ date('h:i A', strtotime($slot->end_time)) }}"
                                    data-price="{{ $slot->price }}" data-show-target="hidden{{ $key }}">
                                <label class="form-check-label d-grid my-2 rounded text-center {{ $labelcolor }}"
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var start_time = '';
        var booking_id = {{ Js::from($bookingdata->booking_id) }};
    </script>
    <script src="{{ url('resources/views/admin/bookings/bookings.js') }}"></script>
@endsection
