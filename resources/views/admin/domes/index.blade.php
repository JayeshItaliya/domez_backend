@extends('admin.layout.default')
@section('title')
    {{ trans('labels.domes_list') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.domes') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.domes') }}</li>
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
                        @if (Auth::user()->type == 1)
                            <th>{{ trans('labels.dome_owners') }}</th>
                        @endif
                        <th>{{ trans('labels.dome_name') }}</th>
                        <th>{{ trans('labels.sports') }}</th>
                        <th>{{ trans('labels.country') }}</th>
                        <th>{{ trans('labels.start_time') }}</th>
                        <th>{{ trans('labels.end_time') }}</th>
                        <th class="text-center">{{ trans('labels.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($domes as $dome)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @if (Auth::user()->type == 1)
                                <td>{{ $dome->dome_owner->name }}</td>
                            @endif
                            <td>{{ $dome->name }}</td>
                            <td>
                                @foreach ($sports as $sport)
                                    @foreach (explode(',', $dome->sport_id) as $sport_id)
                                        @if ($sport->id == $sport_id)
                                            {{ $sport->name }} {{ !$loop->last ? '|' : '' }}
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>{{ $dome->country }}</td>
                            <td>{{ $dome->start_time }}</td>
                            <td>{{ $dome->end_time }}</td>
                            <td>
                                <a class="cursor-pointer me-2" href="{{ URL::to('admin/domes/details-' . $dome->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                                        stroke="var(--bs-info)" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path
                                            d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7">
                                        </path>
                                    </svg>
                                </a>
                                @if (Auth::user()->type == 2)
                                    <a class="cursor-pointer me-2" href="{{ URL::to('admin/domes/edit-' . $dome->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-warning)" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a class="cursor-pointer me-2"
                                        onclick="deletedata('{{ $dome->id }}','{{ URL::to('admin/domes/delete') }}')"
                                        class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-danger)" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- New Dome Request Modal -->
    <div class="modal fade" id="new_dome_request" tabindex="-1" aria-labelledby="new_dome_requestLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ URL::to('admin/domes/new-request') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="new_dome_requestLabel">{{ trans('labels.new_dome_request') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dome_name" class="form-label">{{ trans('labels.dome_name') }}</label>
                        <input type="text" class="form-control" name="dome_name" id="dome_name"
                            placeholder="{{ trans('labels.dome_name') }}">
                    </div>
                    <div class="form-group">
                        <label for="dome_address" class="form-label">{{ trans('labels.dome_address') }}</label>
                        <input type="text" class="form-control" name="dome_address" id="dome_address"
                            placeholder="{{ trans('labels.dome_address') }}">
                    </div>
                    <div class="form-group">
                        <label for="dome_city" class="form-label">{{ trans('labels.dome_city') }}</label>
                        <input type="text" class="form-control" name="dome_city" id="dome_city"
                            placeholder="{{ trans('labels.dome_city') }}">
                    </div>
                    <div class="form-group">
                        <label for="dome_zipcode" class="form-label">{{ trans('labels.dome_zipcode') }}</label>
                        <input type="text" class="form-control" name="dome_zipcode" id="dome_zipcode"
                            placeholder="{{ trans('labels.dome_zipcode') }}">
                    </div>
                    <div class="form-group">
                        <label for="dome_state" class="form-label">{{ trans('labels.dome_state') }}</label>
                        <input type="text" class="form-control" name="dome_state" id="dome_state"
                            placeholder="{{ trans('labels.dome_state') }}">
                    </div>
                    <div class="form-group">
                        <label for="dome_country" class="form-label">{{ trans('labels.dome_country') }}</label>
                        <input type="text" class="form-control" name="dome_country" id="dome_country"
                            placeholder="{{ trans('labels.dome_country') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ trans('labels.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let dome_count = {{ Js::from($domes_count) }};
        let dome_limit = {{ Js::from(Auth::user()->dome_limit) }};

        if (is_vendor) {
            $(document).ready(function() {
                if (dome_limit < dome_count) {
                    let html =
                        '<a href="' + window.location.href.replace(window.location.search, '') +
                        '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
                    $('.fixed-table-toolbar .btn-group').append(html);
                } else {
                    let html =
                        '<a data-bs-toggle="modal" data-bs-target="#new_dome_request" class="btn-custom-primary cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
                    $('.fixed-table-toolbar .btn-group').append(html);
                }
            })
        }

        function deletedata(id, url) {
            "use strict";
            swalWithBootstrapButtons
                .fire({
                    icon: 'warning',
                    title: are_you_sure,
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: yes,
                    cancelButtonText: no,
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        return new Promise(function(resolve, reject) {
                            $.ajax({
                                type: "GET",
                                url: url,
                                data: {
                                    id: id,
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.status == 1) {
                                        location.reload();
                                    } else {
                                        swal_cancelled(wrong);
                                        return false;
                                    }
                                },
                                error: function(response) {
                                    swal_cancelled(wrong);
                                    return false;
                                },
                            });
                        });
                    },
                }).then((result) => {
                    if (!result.isConfirmed) {
                        result.dismiss === Swal.DismissReason.cancel
                    }
                })
        }
    </script>
@endsection
