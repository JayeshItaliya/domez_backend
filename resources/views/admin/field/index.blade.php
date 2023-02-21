@extends('admin.layout.default')
@section('title')
    Fields List
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Fields</p>
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
                        <li class="breadcrumb-item active" aria-current="page">Fields</li>
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
                        <th data-field="{{ trans('labels.srno') }}">{{ trans('labels.srno') }}</th>
                        <th data-field="{{ trans('labels.image') }}">{{ trans('labels.image') }}</th>
                        @if (Auth::user()->type == 1)
                            <th data-field="{{ trans('labels.dome_owner') }}">{{ trans('labels.dome_owner') }}</th>
                            <th data-field="{{ trans('labels.dome_name') }}">{{ trans('labels.dome_name') }}</th>
                        @endif
                        <th data-field="{{ trans('labels.field_name') }}">{{ trans('labels.field_name') }}</th>
                        <th data-field="{{ trans('labels.sports') }}">{{ trans('labels.sports') }}</th>
                        <th data-field="{{ trans('labels.min_person') }}">{{ trans('labels.min_person') }}</th>
                        <th data-field="{{ trans('labels.max_person') }}">{{ trans('labels.max_person') }}</th>
                        @if (Auth::user()->type == 2)
                            <th data-field="{{ trans('labels.action') }}">{{ trans('labels.action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($fields as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <div class="avatar avatar-lg">
                                    <img src="{{ Helper::image_path($data->image) }}" alt="..." class="avatar-img"
                                        style="width: 100px">
                                </div>
                            </td>
                            @if (Auth::user()->type == 1)
                                <td>{{ $data->vendor_name->name }}</td>
                                <td>{{ $data->dome_name->name }}</td>
                            @endif
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->category_name->name }}</td>
                            <td>{{ $data->min_person }}</td>
                            <td>{{ $data->max_person }}</td>
                            @if (Auth::user()->type == 2)
                                <td class="text-center">
                                    <a href="{{ URL::to('admin/field/edit-') . $data->id }}"
                                        class="text-secondary me-2 fs-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Edit"><i class="fa-duotone fa-pen-to-square"></i></a>
                                    <a onclick="field_delete('{{ $data->id }}','{{ $data->is_deleted == 2 ? 1 : 2 }}','{{ URL::to('admin/field/delete') }}')"
                                        class="text-danger me-2 fs-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Delete"><i class="fa-duotone fa-trash-can"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>









            {{-- <div class="table-responsive">
                <input class="form-control list-search mw-300px float-end mb-5" type="search" placeholder="Search">
                <table class="table table-nowrap mb-0" data-list='{"valueNames": ["id", "name", "manager", "status"]}'>
                    <thead class="thead-light">
                        <tr>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">ID</a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="image">Image</a>
                            </th>
                            @if (Auth::user()->type == 1)
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="vendor_id">Vendor
                                        Name</a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Dome
                                        Name</a>
                                </th>
                            @endif
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="name">Name</a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="sports">Sports</a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="start_time">Min
                                    Person</a>
                            </th>
                            <th>
                                <a href="javascript: void(0);" class="text-muted list-sort" data-sort="end_time">Max
                                    Person</a>
                            </th>
                            @if (Auth::user()->type == 2)
                                <th class="text-center">
                                    <a href="javascript: void(0);" class="text-muted list-sort"
                                        data-sort="action">Action</a>
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($fields as $data)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>
                                    <div class="avatar avatar-lg">
                                        <img src="{{ Helper::image_path($data->image) }}" alt="..." class="avatar-img"
                                            style="width: 100px">
                                    </div>
                                </td>
                                @if (Auth::user()->type == 1)
                                    <td>{{ $data->vendor_name->name }}</td>
                                    <td>{{ $data->dome_name->name }}</td>
                                @endif
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->category_name->name }}</td>
                                <td>{{ $data->min_person }}</td>
                                <td>{{ $data->max_person }}</td>
                                @if (Auth::user()->type == 2)
                                    <td class="text-center">
                                        <a href="{{ URL::to('admin/field/edit-') . $data->id }}"
                                            class="text-secondary me-2 fs-3" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Edit"><i
                                                class="fa-duotone fa-pen-to-square"></i></a>
                                        <a onclick="field_delete('{{ $data->id }}','{{ $data->is_deleted == 2 ? 1 : 2 }}','{{ URL::to('admin/field/delete') }}')"
                                            class="text-danger me-2 fs-3" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Delete"><i
                                                class="fa-duotone fa-trash-can"></i></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div> --}}
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        // Field Delete
        function field_delete(id, status, url) {
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
                    title: "Are You Sure?",
                    icon: "warning",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
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
                                        title: "Oops...",
                                        text: wrong,
                                    });
                                }
                            },
                            failure: function(response) {
                                $("#preloader , #status").hide();
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
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
