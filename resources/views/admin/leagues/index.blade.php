@extends('admin.layout.default')
@section('title')
    {{ trans('labels.domes_list') }}
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('Leagues') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('Leagues') }}</li>
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
                        <th data-field="League Name">League Name</th>
                        <th data-field="Domes">Domes</th>
                        <th data-field="Fields">Fields</th>
                        <th data-field="Sports">Sports</th>
                        <th data-field="Start Date">Start Date</th>
                        <th data-field="End Date">End Date</th>
                        <th data-field="Start Time">Start Time</th>
                        <th data-field="End Time">End Time</th>
                        <th data-field="Age">Age</th>
                        <th data-field="Gender">Gender</th>
                        <th data-field="Team Limit">Team Limit</th>
                        <th data-field="Min Players">Min players</th>
                        <th data-field="Max Players">Max Players</th>
                        <th data-field="Prices">Prices</th>
                        <th data-field="Action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    <tr>
                        <td>01</td>
                        <td>Canada National League</td>
                        <td>Dome Stadium</td>
                        <td>Field 1</td>
                        <td>#</td>
                        <td>01/01/23</td>
                        <td>28/02/23</td>
                        <td>09:00 AM</td>
                        <td>06:00 PM</td>
                        <td>Above 18 Years</td>
                        <td>Men</td>
                        <td>20</td>
                        <td>10</td>
                        <td>15</td>
                        <td>$210</td>
                        <td>Action</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let html =
                '<a href="{{ URL::to('admin/leagues/add') }}" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';

            $('.fixed-table-toolbar .btn-group').append(html);
        })
    </script>
@endsection
