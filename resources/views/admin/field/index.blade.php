@extends('admin.layout.default')
@section('title')
    {{ trans('labels.fields') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.fields') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.fields') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body hii">
            <table id="bootstrapTable">
                <thead>
                    <tr>
                        <th>{{ trans('labels.srno') }}</th>
                        <th>{{ trans('labels.image') }}</th>
                        @if (Auth::user()->type == 1)
                            <th>{{ trans('labels.dome_owner') }}</th>
                            <th>{{ trans('labels.dome_name') }}</th>
                        @endif
                        <th>{{ trans('labels.field_name') }}</th>
                        <th>{{ trans('labels.sports') }}</th>
                        <th>{{ trans('labels.min_person') }}</th>
                        <th>{{ trans('labels.max_person') }}</th>
                        <th>{{ trans('labels.maintenance') }}</th>
                        @if (Auth::user()->type == 2)
                            <th>{{ trans('labels.action') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($fields as $data)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td> <img src="{{ Helper::image_path($data->image) }}" width="100" height="60"
                                    class="rounded"> </td>
                            @if (Auth::user()->type == 1)
                                <td>{{ $data->dome_owner->name }}</td>
                                <td>{{ $data->dome_name->name }}</td>
                            @endif
                            <td>{{ $data->name }}</td>
                            <td> <img src="{{ $data->sport_data->image }}" width="20" height="20" class="rounded">
                            </td>
                            <td>{{ $data->min_person }}</td>
                            <td>{{ $data->max_person }}</td>
                            <td>
                                @if ($data->in_maintenance == 1)
                                    <span class="badge rounded-pill bg-danger cursor-pointer"
                                        onclick="fieldinactive('{{ $data->id }}','{{ $data->in_maintenance }}','{{ URL::to('admin/fields/maintenance') }}')">Inactive</span>
                                        <br>
                                    <small class="text-danger">{{ Helper::date_format($data->maintenance_date) }}</small>
                                @else
                                    <span class="badge rounded-pill bg-success cursor-pointer"
                                        onclick="fieldinactive('{{ $data->id }}','{{ $data->in_maintenance }}','{{ URL::to('admin/fields/maintenance') }}')">Active</span>
                                @endif
                            </td>
                            @if (Auth::user()->type == 2)
                                <td>
                                    <a href="{{ URL::to('admin/fields/edit-') . $data->id }}"
                                        class="text-secondary me-2 fs-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Edit">
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
                                    <a onclick="deletedata('{{ $data->id }}','{{ URL::to('admin/fields/delete') }}')"
                                        class="text-danger me-2 fs-3" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        data-bs-title="Delete">
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
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var select_date = {{ Js::from(trans('labels.select_date')) }};
        var save_date = {{ Js::from(trans('labels.save_date')) }};
        var cancel = {{ Js::from(trans('labels.cancel')) }};
        var min_date = {{ Js::from(date('Y-m-d')) }};
        // var min_date = {{ Js::from(date('Y-m-d', strtotime(date('Y-m-d') . ' +1 days'))) }};
    </script>
    <script src="{{ url('resources/views/admin/field/field.js') }}"></script>
@endsection
