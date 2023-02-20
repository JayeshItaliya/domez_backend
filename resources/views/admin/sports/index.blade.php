@extends('admin.layout.default')
@section('title')
    Sports
@endsection
@section('contents')
    <!-- Title -->
    <div class="d-flex align-items-center justify-content-between mb-5">
        <h1 class="h2 mb-0">Sports</h1>
        <a href="{{ URL::to('admin/sports/add') }}" class="btn btn-primary">Add</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <input class="form-control list-search mw-300px float-end mb-5" type="search" placeholder="Search">
                <table class="table table-nowrap mb-0" data-list='{"valueNames": ["id", "name", "manager", "status"]}'>
                    <thead class="thead-light">
                        <tr>
                            <th class="w-80px"><a href="javascript: void(0);" class="text-muted list-sort"
                                    data-sort="id">ID</a></th>
                            <th><a href="javascript: void(0);" class="text-muted list-sort">Image</a></th>
                            <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="sport">Sport
                                    Name</a></th>
                            <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">Status</a>
                            </th>
                            <th><a href="javascript: void(0);" class="text-muted list-sort" data-sort="action">Action</a>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="list">
                        @php $i=1 @endphp
                        @foreach ($getsportslist as $sport)
                            <tr>
                                <td class="id">{{ $i++ }}</td>
                                <td><img src="{{ Helper::image_path($sport->image) }}" alt="category image"
                                        class="avatar avatar-sm"></td>
                                <td class="category">{{ $sport->name }}</td>
                                <td class="status">
                                    <a onclick="change_status('{{ $sport->id }}','{{ $sport->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/sports/change_status') }}')"
                                        class="badge fs-5 text-bg-{{ $sport->is_available == 1 ? 'success' : 'danger' }} rounded-pill cursor-pointer">{{ $sport->is_available == 1 ? 'Active' : 'Inactive' }}</a>
                                </td>
                                <td class="action">
                                    <a href="{{URL::to('admin/sports/edit-').$sport->id}}" class="text-gray-700 me-2 fs-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $sport->is_deleted == 2 ? 'Delete' : 'Recover' }}" onclick="delete_category('{{ $sport->id }}','{{ $sport->is_deleted == 1 ? 2 : 1 }}','{{ URL::to('admin/sports/delete') }}')" class="text-{{ $sport->is_deleted == 2 ? 'danger' : 'info' }} fs-3">
                                        @if ($sport->is_deleted == 2)
                                            <i class="fa-regular fa-trash-can"></i>                                            
                                        @else
                                            <i class="fa-regular fa-rotate"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // live search
        $(document).ready(function() {
            "use strict";
            $("#search_bar").keyup(function() {
                var value = $(this).val().toLowerCase();
                $(".search_row #search_vendor").filter(function() {
                    $(this).toggle($(this).find('#vendor_name').text().toLowerCase().indexOf(
                        value) > -1)
                });
            });
        });

        // Vendor Delete
        function delete_category(id, status, url) {
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
