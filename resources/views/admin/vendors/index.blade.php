@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_owners') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_owners') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.dome_owners') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="bootstrapTable">
                <thead>
                    <tr>
                        <th>{{ trans('labels.srno') }}</th>
                        <th>{{ trans('labels.profile') }}</th>
                        <th>{{ trans('labels.phone_number') }}</th>
                        <th>{{ trans('labels.login_type') }}</th>
                        <th>{{ trans('labels.status') }}</th>
                        <th>{{ trans('labels.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <div class="d-flex align-items center">
                                    <img class="border-radius" src="{{ Helper::image_path($vendor->image) }}"
                                        width="40" height="40">
                                    <div class="mx-2">
                                        <h6>{{ $vendor->name }}</h6>
                                        <span class="text-muted fs-7">{{ $vendor->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $vendor->phone }}</td>
                            <td>
                                <img class="border-radius"
                                    src="{{ Helper::image_path($vendor->login_type == 1 ? 'email.svg' : ($vendor->login_type == 2 ? 'google.svg' : ($vendor->login_type == 3 ? 'apple.svg' : ($vendor->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                    width="25" height="25">
                            </td>
                            <td><span class="badge rounded-pill cursor-pointer text-bg-{{ $vendor->is_available == 1 ? 'success' : 'danger' }}"
                                    onclick="change_status('{{ $vendor->id }}','{{ $vendor->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/vendors/change_status') }}')">{{ $vendor->is_available == 1 ? trans('labels.active') : trans('labels.inactive') }}</span>
                            </td>
                            <td>
                                <a class="cursor-pointer me-2"
                                    href="{{ URL::to('admin/vendors/dome-owner-details-' . $vendor->id) }}">
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
                                <a class="cursor-pointer me-2" href="{{ URL::to('admin/vendors/edit-' . $vendor->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                        width="25" height="25" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                        <line x1="16" y1="5" x2="19" y2="8" />
                                    </svg>
                                </a>
                                <a class="cursor-pointer me-2"
                                    onclick="vendor_delete('{{ $vendor->id }}','{{ $vendor->is_deleted == 2 ? 1 : 2 }}','{{ URL::to('admin/vendors/delete') }}')"
                                    class="mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="25" height="25" viewBox="0 0 24 24" stroke-width="1" stroke="#2c3e50"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
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
@endsection
@section('scripts')
    <script>
        if (!is_vendor) {
            $(document).ready(function() {
                let html =
                    '<a href="{{ URL::to('admin/vendors/add') }}" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
                $('.fixed-table-toolbar .btn-group').append(html);
            })
        }

        // Vendor Delete
        function vendor_delete(id, status, url) {
            "use strict";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success mx-2",
                    cancelButton: "btn btn-danger mx-2",
                },
                buttonsStyling: false,
            });
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
                    $("#preloader , #status").show();
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
                                    $("#preloader , #status").hide();
                                    toastr.success("Success");
                                    location.reload();
                                } else {
                                    $("#preloader , #status").hide();
                                    Swal.fire({
                                        icon: "error",
                                        title: oops,
                                        text: wrong,
                                    });
                                }
                            },
                            failure: function(response) {
                                $("#preloader , #status").hide();
                                Swal.fire({
                                    icon: "error",
                                    title: oops,
                                    text: wrong,
                                });
                            },
                        });
                    }
                    $("#preloader , #status").hide();
                });
        }
    </script>
@endsection
