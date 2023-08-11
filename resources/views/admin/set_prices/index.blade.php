@extends('admin.layout.default')
@section('title')
    {{ trans('labels.set_prices') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.set_prices') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.set_prices') }}</li>
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
                        <th>{{ trans('labels.dome_name') }}</th>
                        <th>{{ trans('labels.sports') }}</th>
                        <th>{{ trans('labels.start_date') }}</th>
                        <th>{{ trans('labels.end_date') }}</th>
                        <th>{{ trans('labels.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($getsetpriceslist as $setprice)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $setprice['dome_name']->name }}</td>
                            <td>{{ $setprice['sport_info']->name }}</td>
                            <td>{{ $setprice->start_date != '' ? Helper::date_format($setprice->start_date) : '-' }} </td>
                            <td>{{ $setprice->end_date != '' ? Helper::date_format($setprice->end_date) : '-' }} </td>
                            <td>
                                @if ($setprice->price_type == 2)
                                    <a class="cursor-pointer me-2" href="{{ URL::to('admin/set-prices/show-' . $setprice->id) }}"> {!! Helper::get_svg(1) !!} </a>
                                @else
                                    --
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
    <script src="{{ url('resources/views/admin/set_prices/set_prices.js') }}"></script>
@endsection
