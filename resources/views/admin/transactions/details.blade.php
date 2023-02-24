@extends('admin.layout.default')
@section('title')
    Transactions details
@endsection
@section('contents')
<div class="card mb-3">
    <div class="card-body py-2">
        <div class="d-flex align-items-center justify-content-between">
            <p class="text-secondary fw-semibold">League Details ID - 1234656782</p>
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
                    <li class="breadcrumb-item active" aria-current="page">Transactions details</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <p class="mb-2 fw-semibold">Dome Owner Details</p>
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
                            <label>Phone number</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">+1 123456789</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
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
            </div>
            <p class="my-3 fw-semibold">User Details</p>
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
                            <label>Phone number</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">+1 123456789</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
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
            </div>
            <p class="my-3 fw-semibold">Bookings Details</p>
            <div class="d-flex">
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Booking ID</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">1234656782</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Total  Amount</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">700 $</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Booking  Date</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">20:01:2023</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Due Amount</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">200 $</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Booking Time</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">09:00 AM - 02:00 PM</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Paid Amount</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">500 $</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Dome Name</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Dome  A</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Payment Type</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Google Pay</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Field Name</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Field Name 1</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Payment Status</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Completed</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Player</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">12</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Booking Status</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Pending</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>Payment Mode</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Partial</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6"></div>
            </div>
        </div>
    </div>
@endsection
