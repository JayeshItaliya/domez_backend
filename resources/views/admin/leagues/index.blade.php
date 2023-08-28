@extends('admin.layout.default')
@section('title')
    {{ trans('labels.leagues') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.leagues') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.leagues') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="bootstrapTable" class="table-responsive">
                <thead>
                    <tr>
                        <th>{{ trans('labels.srno') }}</th>
                        @if (Auth::user()->type == 1)
                            <th>{{ trans('labels.dome_owners') }}</th>
                        @endif
                        <th>{{ trans('labels.league_name') }}</th>
                        <th>{{ trans('labels.last_date_registration') }}</th>
                        <th>{{ trans('labels.dome_name') }}</th>
                        <th>{{ trans('labels.sports') }}</th>
                        <th>{{ trans('labels.date') }}</th>
                        <th>{{ trans('labels.time') }}</th>
                        <th class="text-center">{{ trans('labels.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($leaguesdata as $league)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @if (Auth::user()->type == 1)
                                <td>{{ $league->dome_owner->name }}</td>
                            @endif
                            <td>{{ $league->name }}</td>
                            <td>{{ Helper::date_format($league->booking_deadline) }}</td>
                            <td>{{ @$league->dome_info->name }}</td>
                            <td>
                                {{ $league->sport_info->name }}
                            </td>
                            <td>{{ Helper::date_format($league->start_date) . ' - ' . Helper::date_format($league->end_date) }}
                            </td>
                            <td>{{ Helper::time_format($league->start_time) . ' - ' . Helper::time_format($league->end_time) }}
                            </td>
                            <td>
                                <a class="cursor-pointer me-2"
                                    href="{{ URL::to('admin/leagues/details-' . $league->id) }}">
                                    {!! Helper::get_svg(1) !!}
                                </a>
                                @if (in_array(Auth::user()->type, [2, 4, 5]))
                                    <a class="cursor-pointer me-2"
                                        href="{{ URL::to('admin/leagues/edit-' . $league->id) }}"> {!! Helper::get_svg(2) !!}
                                    </a>
                                    @if (Auth::user()->type == 2)
                                        <a class="cursor-pointer me-2"
                                            onclick="deletedata('{{ $league->id }}','{{ URL::to('admin/leagues/delete') }}')"
                                            class="mx-2"> {!! Helper::get_svg(3) !!} </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.js') }}"></script>
    <script src="{{ url('resources/views/admin/leagues/leagues.js') }}"></script>
@endsection
