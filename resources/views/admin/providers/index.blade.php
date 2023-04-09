@extends('admin.layout.default')
@section('title')
    {{ trans('labels.providers_list') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>{{ trans('labels.providers_list') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.providers_list') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="bootstrapTable">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.srno') }}</th>
                            <th>{{ trans('labels.profile') }}</th>
                            <th>{{ trans('labels.login_type') }}</th>
                            <th>{{ trans('labels.status') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($providers as $provider)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items center">
                                        <img class="border-radius" src="{{ Helper::image_path($provider->image) }}"
                                            width="40" height="40">
                                        <div class="mx-2">
                                            <h6>{{ $provider->name }}</h6>
                                            <span class="text-muted fs-7">{{ $provider->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <img class="border-radius"
                                        src="{{ Helper::image_path($provider->login_type == 1 ? 'email.svg' : ($provider->login_type == 2 ? 'google.svg' : ($provider->login_type == 3 ? 'apple.svg' : ($provider->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                        width="25" height="25">
                                </td>
                                <td><span
                                        class="badge rounded-pill cursor-pointer text-bg-{{ $provider->is_available == 1 ? 'success' : 'danger' }}"
                                        onclick="change_status('{{ $provider->id }}','{{ $provider->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/providers/change_status') }}')">{{ $provider->is_available == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a class="cursor-pointer me-2"
                                        href="{{ URL::to('admin/providers/edit-' . $provider->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-warning)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a class="cursor-pointer me-2"
                                        onclick="deletedata('{{ $provider->id }}','{{ $provider->is_deleted == 2 ? 1 : 2 }}','{{ URL::to('admin/providers/delete') }}')"
                                        class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-danger)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addprovider" tabindex="-1" aria-labelledby="addproviderLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addproviderLabel">{{ trans('labels.add_provider') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{ URL::to('admin/providers/store-worker') }}" method="POST"
                    id="store_provider">
                    @csrf
                    <div class="form-group">
                        <label class="form-label fw-bold" for="name">{{ trans('labels.name') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="{{ trans('labels.name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label fw-bold" for="email">{{ trans('labels.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="{{ trans('labels.email') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label fw-bold" for="password">{{ trans('labels.password') }}</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="{{ trans('labels.password') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-auto float-end">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        if (is_vendor) {
            $(document).ready(function() {
                let html =
                    '<a class="btn-custom-primary" data-bs-target="#addprovider" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
                $('.fixed-table-toolbar .btn-group').append(html);
            })
            $('#store_provider').on('submit', function() {
                if ($('#store_provider #name').val() == "") {
                    $('#store_provider #name').addClass('is-invalid');
                    return false;
                } else {
                    $('#store_provider #name').removeClass('is-invalid');
                    if ($('#store_provider #email').val() == "") {
                        $('#store_provider #email').addClass('is-invalid');
                        return false;
                    } else {
                        $('#store_provider #email').removeClass('is-invalid');
                        if ($('#store_provider #password').val() == "") {
                            $('#store_provider #password').addClass('is-invalid');
                            return false;
                        } else {
                            $('#store_provider #password').removeClass('is-invalid');
                        }
                    }
                }
                showpreloader();
            });
        }



        // Vendor Delete
        function deletedata(id, status, url) {
            "use strict";
            swalWithBootstrapButtons
                .fire({
                    title: are_you_sure,
                    icon: "warning",
                    confirmButtonText: yes,
                    cancelButtonText: no,
                    showCancelButton: true,
                    reverseButtons: true,
                })
                .then((result) => {
                    showpreloader();
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "get",
                            url: url,
                            data: {
                                id: id,
                                status: status,
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    hidepreloader();
                                    toastr.success("Success");
                                    location.reload();
                                } else {
                                    hidepreloader();
                                    swal_cancelled(wrong);
                                }
                            },
                            failure: function(response) {
                                hidepreloader();
                                swal_cancelled(wrong);
                            },
                        });
                    }
                    hidepreloader();
                });
        }
    </script>
@endsection
