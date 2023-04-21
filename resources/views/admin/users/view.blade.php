@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.user_details') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.user_details') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/users') }}">{{ trans('labels.users_list') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.user_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body table-responsive">
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $user->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.login_type') }}</label>
                        </div>
                        <div class="col-md-8">
                            <img class="border-radius"
                                src="{{ Helper::image_path($user->login_type == 1 ? 'email.svg' : ($user->login_type == 2 ? 'google.svg' : ($user->login_type == 3 ? 'apple.svg' : ($vendor->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                width="25" height="25">
                        </div>
                    </div>
                </div>
            </div>
            <div class="class d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.email') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6   ">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.phone_number') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $user->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <table id="bootstrapTable">
                <thead>
                    <tr>
                        <th>{{ trans('labels.srno') }}</th>
                        <th>{{ trans('labels.booking_id') }}</th>
                        <th>{{ trans('labels.dome_owner') }}</th>
                        <th>{{ trans('labels.dome_name') }}</th>
                        <th>{{ trans('labels.booking_date') }}</th>
                        <th>{{ trans('labels.amount') }}</th>
                        <th>{{ trans('labels.payment_status') }}</th>
                        <th>{{ trans('labels.status') }}</th>
                        <th>{{ trans('labels.action') }}</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $booking->booking_id }}</td>
                        <td>{{ $booking->dome_owner->name }}</td>
                        <td>{{ $booking->dome_name->name }}</td>
                        <td>{{ Helper::date_format($booking->start_date) }}</td>
                        <td>{{ Helper::currency_format($booking->total_amount) }}</td>
                        <td>
                            @if ($booking->payment_status == 1)
                                <span
                                    class="badge rounded-pill cursor-pointer complete-pill">{{ trans('labels.completed') }}</span>
                            @else
                                <span
                                    class="badge rounded-pill cursor-pointer partial-pill">{{ trans('labels.partial') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($booking->booking_status == 1)
                                <span
                                    class="badge rounded-pill cursor-pointer text-bg-success">{{ trans('labels.confirmed') }}</span>
                            @elseif ($booking->booking_status == 2)
                                <span
                                    class="badge rounded-pill cursor-pointer text-bg-warning">{{ trans('labels.pending') }}</span>
                            @else
                                <span
                                    class="badge rounded-pill cursor-pointer text-bg-danger">{{ trans('labels.cancelled') }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="cursor-pointer me-2" href="{{ URL::to('admin/bookings/details-' . $booking->booking_id) }}"> {!! Helper::get_svg(1) !!} </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
