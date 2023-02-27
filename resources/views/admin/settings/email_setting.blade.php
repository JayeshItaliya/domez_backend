@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    Email Settings
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Email Settings</p>
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
                        <li class="breadcrumb-item">General Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Email Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Mailer</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Mailer">
                            </div>
                            <div class="mb-3">
                                <label for="staticport" class="form-label">Port</label>
                                <input type="text" class="form-control" id="staticport"
                                    placeholder="Enter Port">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Password">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">From Email Address</label>
                                <input type="Email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput2" class="form-label">Host</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="Enter Host">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control"
                                    placeholder="Enter User Name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label" placeholder="TLS">Encryption</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>TLS</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
