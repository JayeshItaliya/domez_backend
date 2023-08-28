@extends('admin.layout.default')
@section('title')
    {{ trans('labels.sports') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.sports') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.sports') }}</li>
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
                        <th>{{ trans('labels.image') }}</th>
                        <th>{{ trans('labels.sports_name') }}</th>
                        <th>{{ trans('labels.status') }}</th>
                        <th>{{ trans('labels.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($getsportslist as $sport)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <div class="d-flex align-items center">
                                    <img class="border-radius" src="{{ Helper::image_path($sport->image) }}" width="40"
                                        height="40">
                                </div>
                            </td>
                            <td class="category">{{ $sport->name }}</td>
                            <td class="status">
                                <a onclick="change_status('{{ $sport->id }}','{{ $sport->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/sports/change_status') }}')"
                                    class="badge text-bg-{{ $sport->is_available == 1 ? 'success' : 'danger' }} rounded-pill cursor-pointer">{{ $sport->is_available == 1 ? 'Active' : 'Inactive' }}</a>
                            </td>
                            <td class="action">
                                <a href="{{ URL::to('admin/sports/edit-') . $sport->id }}" class="text-warning me-2"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit">
                                    {!! Helper::get_svg(2) !!}
                                </a>
                                <a data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    data-bs-title="{{ $sport->is_deleted == 2 ? 'Delete' : 'Recover' }}"
                                    onclick="delete_sport('{{ $sport->id }}','{{ $sport->is_deleted == 1 ? 2 : 1 }}','{{ URL::to('admin/sports/delete') }}')"
                                    class="text-{{ $sport->is_deleted == 2 ? 'danger' : 'info' }}">
                                    @if ($sport->is_deleted == 2)
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
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-rotate-clockwise" width="25"
                                            height="25" viewBox="0 0 24 24" stroke-width="1" stroke="var(--bs-info)"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                        </svg>
                                    @endif
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
<script src="{{ url('resources/views/admin/sports/sports.js') }}"></script>
@endsection
