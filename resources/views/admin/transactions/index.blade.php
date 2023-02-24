@extends('admin.layout.default')
@section('title')
    Transactions
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Transactions</p>
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
                        <li class="breadcrumb-item">Transactions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if (count($transactions) != 0)
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <input class="form-control list-search mw-300px float-end mb-5" type="search" placeholder="Search">
                    <table class="table table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="w-80px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">
                                        ID
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="payment_id">
                                        Payment ID
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="payment_type">
                                        Payment Type
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="vendor_name">
                                        Dome owners
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="user_name">
                                        User Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="booking_details">
                                        Booking Details
                                    </a>
                                </th>
                                <th class="min-w-200px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="paid_amount">
                                        Paid Amount
                                    </a>
                                </th>
                                <th class="min-w-200px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="due_amount">
                                        Due Amount
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">
                                        Status
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td>01</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>02</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>03</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>04</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>05</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>06</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td>07</td>
                                <td>OI3v7zGMF7</td>
                                <td>
                                    Google Pay
                                </td>
                                <td>Domez</td>
                                <td>Soham</td>
                                <td>
                                    <span class="fs-7">Dome Name:- Dome B</span><br>
                                    <span class="fs-7">Field Name:- Test 2</span><br>
                                    <span class="fs-7">Booking Amount:- 21</span>
                                </td>
                                <td>$500</td>
                                <td>0</td>
                                <td><span class="badge rounded-pill cursor-pointer text-bg-success" onclick="change_status('2','2','http://localhost/domez/admin/Transactions/change_status')">Active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <img class="img-fluid w-50" src="{{ Helper::image_path('no_data.svg') }}">
        </div>
    @endif
@endsection
