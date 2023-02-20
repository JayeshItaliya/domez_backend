@extends('admin.layout.default')
@section('title')
    Transactions
@endsection
@section('contents')
    <!-- Title -->
    <h1 class="h2">Transactions</h1>

    @if (count($transactions) != 0)
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <input class="form-control list-search mw-300px float-end mb-5" type="search" placeholder="Search">
                    <table class="table table-nowrap mb-0" data-list='{"valueNames": ["id", "name", "manager", "status"]}'>
                        <thead class="thead-light">
                            <tr>
                                <th class="w-80px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="id">
                                        ID
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="payment_id">
                                        Payment ID
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="payment_type">
                                        Payment Type
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="vendor_name">
                                        Vendor Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="user_name">
                                        User Name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="booking_details">
                                        Booking Details
                                    </a>
                                </th>
                                <th class="min-w-200px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="paid_amount">
                                        Paid Amount
                                    </a>
                                </th>
                                <th class="min-w-200px">
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="due_amount">
                                        Due Amount
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-muted list-sort" data-sort="status">
                                        Status
                                    </a>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @php $i = 1; @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="id">{{ $i }}</td>
                                    <td class="payment_id">{{ $transaction->transaction_id }}</td>
                                    <td class="payment_type">
                                        {{ $transaction->payment_type == 1 ? 'Card' : ($transaction->payment_type == 2 ? 'Apple Pay' : 'Google Pay') }}
                                    </td>
                                    <td class="vendor_name">{{ $transaction->vendor_name->name }}</td>
                                    <td class="user_name">{{ $transaction->user_name->name }}</td>
                                    <td class="booking_details">
                                        <span class="fs-7">Dome Name:- {{ $transaction->dome_name->name }}</span><br>
                                        <span class="fs-7">Field Name:- {{ $transaction->field_name->name }}</span><br>
                                        <span class="fs-7">Booking Amount:- {{ $transaction->amount }}</span>
                                    </td>
                                    <td class="paid_amount">500</td>
                                    <td class="due_amount">0</td>
                                    <td class="status"><span class="badge text-bg-success rounded-pill">Completed</span>
                                    </td>
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
