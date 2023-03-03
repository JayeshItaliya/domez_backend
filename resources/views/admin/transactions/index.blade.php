@extends('admin.layout.default')
@section('title')
    {{ trans('labels.transactions') }}
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.transactions') }}</p>
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
                        <li class="breadcrumb-item">{{ trans('labels.transactions') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if (count($transactions) != 0)
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="bootstrapTable" class="table-responsive">
                        <thead>
                            <tr>
                                <th>{{ trans('labels.srno') }}</th>
                                <th>{{ trans('labels.payment_id') }}</th>
                                <th>{{ trans('labels.payment_type') }}</th>
                                @if (Auth::user()->type == 1)
                                    <th>{{ trans('labels.dome_owners') }}</th>
                                @endif
                                <th>{{ trans('labels.user_name') }}</th>
                                <th>{{ trans('labels.booking_id') }}</th>
                                <th>{{ trans('labels.amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $transaction->transaction_id }}</td>
                                    <td>{{ $transaction->payment_method == 1 ? 'Card' : ($transaction->payment_method == 2 ? 'Apple Pay' : 'Google Pay') }}
                                    </td>
                                    @if (Auth::user()->type == 1)
                                        <td>{{ $transaction->dome_owner->name }}</td>
                                    @endif
                                    <td>{{ $transaction->user_name->name }}</td>
                                    <td>{{ $transaction->booking_id }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <img class="img-fluid w-50" src="{{ Helper::image_path('no_data.svg') }}">
        </div>
    @endif
@endsection
