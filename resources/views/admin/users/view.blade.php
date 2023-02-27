@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    User Details
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">User Details</p>
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
                        <li class="breadcrumb-item active" aria-current="page">User Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Curtis</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Login Type</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Google</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="class d-flex">
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">wiegand@hotmail.com</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Phone number</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">+1 123456789</span>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-nowrap mt-3">
                <h5 class="mt-5">Booking History</h5>
                <thead class="thead-light">
                    <tr>
                        @if (Auth::user()->type == 1)
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">ID</a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort"
                                    data-sort="vendor_id">Booking ID</a>
                            </th>
                        @endif
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="dome_name">Dome Owners</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="dome_price">Dome Name</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="dome_price">Booking Date</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="end_time">Amount</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="end_time">Payment Status</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="end_time">Status</a>
                        </th>
                        <th>
                            <a href="javascript: void(0);" class="text-muted list-sort" data-sort="end_time">Actions</a>
                        </th>
                        @if (Auth::user()->type == 2)
                            <th class="text-center">
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="action">Action</a>
                            </th>
                        @endif
                    </tr>
                </thead>

                <tbody class="list">
                    <tr data-index="0">
                        <td>01</td>
                        <td>OI3v7zGMF7</td>
                        <td>Kelly Doyle</td>
                        <td>Dome A</td>
                        <td>12/1/2023</td>
                        <td>$500</td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-primary" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Partial</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-warning" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Pending</span>
                        </td>
                        <td>
                            <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
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
                        <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </a>
                        </td>
                    </tr>
                    <tr data-index="0">
                        <td>02</td>
                        <td>OI3v7zGMF7</td>
                        <td>Kelly Doyle</td>
                        <td>Dome B</td>
                        <td>12/1/2023</td>
                        <td>$500</td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-info" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Completed</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-danger" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Cancel </span>
                        </td>
                        <td>
                            <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
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
                        <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        </td>
                    </tr>
                    <tr data-index="0">
                        <td>03</td>
                        <td>OI3v7zGMF7</td>
                        <td>Kelly Doyle</td>
                        <td>Dome C</td>
                        <td>12/1/2023</td>
                        <td>$500</td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-primary" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Partial</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-warning" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Pending</span>
                        </td>
                        <td>
                            <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
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
                        <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </td>
                    </tr>
                    <tr data-index="0">
                        <td>04</td>
                        <td>OI3v7zGMF7</td>
                        <td>Kelly Doyle</td>
                        <td>Dome D</td>
                        <td>12/1/2023</td>
                        <td>$500</td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-info" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Completed</span>
                        </td>
                        <td>
                            <span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Completed</span>
                        </td>
                        <td>
                            <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
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
                        <a class="cursor-pointer me-2"
                            href="{{ URL::to('admin/bookings/details-21') }}">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.99964 16.6364C13.2171 16.6364 16.636 13.2175 16.636 9.00001C16.636 4.78256 13.2171 1.36365 8.99964 1.36365C4.7822 1.36365 1.36328 4.78256 1.36328 9.00001C1.36328 13.2175 4.7822 16.6364 8.99964 16.6364Z" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.30273 7.30304L10.6967 10.697M10.6967 7.30304L7.30273 10.697" stroke="#616161" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
