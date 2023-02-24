@extends('admin.layout.default')
@section('title')
     Booking Details
@endsection
@section('contents')
<div class="card mb-3">
    <div class="card-body py-2">
        <div class="d-flex align-items-center justify-content-between">
            <p class="text-secondary fw-semibold">Booking Details</p>
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
                    <li class="breadcrumb-item ">Bookings</li>
                    <li class="breadcrumb-item active" aria-current="page">Booking Details</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <h4 class="my-4 fw-semibold">ID - OI3v7zGMF7</h4>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Dome Owner</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">Jon</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Dome Name</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">Dome A</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Field Name</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">Field 1</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Booking ID</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">OI3v7zGMF7</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Customer Name</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">Jack</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Customer Email</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">abcd1@gmail</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class=" col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Customer Mobile</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">98798798977</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Payment Mode</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">Completed</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Players</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">12</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Booking Date</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">12-05-2023</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Start Time</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">09 : 30 AM</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>End Time</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">05 : 00 PM</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Total Amount</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">$500</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Paid Amount</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">$500</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Due Amount</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7 mx-3">$500</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Payment Type</label>
                    </div>
                    <div class="col-md-8">
                        <span class="text-muted fs-7 mx-3">Google Pay</span>
                    </div>
                </div>
            </div>
            <div class="bg-gray">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Payment Status</label>
                        </div>
                        <div class="col-md-8">
                            <span class="badge rounded-pill cursor-pointer text-bg-info mx-3" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-4">
                <div class="px-3 py-2 d-flex">
                    <div class="col-md-4">
                        <label>Booking Status</label>
                    </div>
                    <div class="col-md-8">
                        <span class="badge rounded-pill cursor-pointer text-bg-warning mx-3" onclick="change_status('2','2','http://localhost/domez/admin/vendors/change_status')">Confirm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

