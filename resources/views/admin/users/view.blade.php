@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.user_details') }}
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.user_details') }}</p>
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
                        <li class="breadcrumb-item">Users</li>
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
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $booking->booking_id }}</td>
                            <td>{{ $booking->dome_owner->name }}</td>
                            <td>{{ $booking->dome_name->name }}</td>
                            <td>{{ Helper::date_format($booking->booking_date) }}</td>
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
                                <a class="cursor-pointer me-2"
                                    href="{{ URL::to('admin/bookings/details-' . $booking->booking_id) }}">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
