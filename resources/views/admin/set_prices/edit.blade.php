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
                        <li class="breadcrumb-item " aria-current="page">{{ trans('labels.set_prices') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_set_price') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <b>{{ trans('labels.dome') }}</b> : {{ $getslotpricedata['dome_name']->name }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <b>{{ trans('labels.sport_name') }}</b> : {{ $getslotpricedata['sport_info']->name }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <b>{{ trans('labels.start_date') }}</b> : {{ Helper::date_format($getslotpricedata->start_date) }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <b>{{ trans('labels.end_date') }}</b> : {{ Helper::date_format($getslotpricedata->end_date) }}
                </div>
            </div>
        </div>
        <div class="w-100">
            <hr>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="row">
            @foreach ($getdata as $key => $data)
                <div class="col-md-3 text-center my-1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $key + 1 }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                                aria-controls="collapse{{ $key }}"> {{ Helper::date_format($data->date) }} :
                                {{ date('l', strtotime($data->date)) }} </button>
                        </h2>
                        <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $key + 1 }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @php
                                    $getslotslist = App\Models\SetPricesDaysSlots::where('dome_id', $data->dome_id)
                                        ->where('sport_id', $data->sport_id)
                                        ->whereDate('date', date('Y-m-d', strtotime($data->date)))
                                        ->get();
                                @endphp
                                @foreach ($getslotslist as $slot)
                                    @php
                                        $slot_ = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
                                    @endphp
                                    <div class="d-flex justify-content-center align-items-center gap-2 my-2">
                                        <p> {{ $slot_ }}
                                            : <b>{{ Helper::currency_format($slot->price) }}</b> </p>
                                        @if ($slot->status == 1)
                                            <a class="cursor-pointer edit_data" data-sid="{{ $slot->id }}"
                                                data-slot="{{ $slot_ }}" data-price="{{ $slot->price }}">
                                                {!! Helper::get_svg(2) !!}</a>
                                            <a class="cursor-pointer"
                                                onclick="deletedata('{{ $slot->id }}','{{ URL::to('admin/set-prices/delete-slot') }}')">
                                                {!! Helper::get_svg(3) !!} </a>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let start_time_title = {{ Js::from(trans('labels.start_time')) }};
        let end_time_title = {{ Js::from(trans('labels.end_time')) }};
        let price = {{ Js::from(trans('labels.price')) }};
        var validatetimeurl = {{ Js::from(URL::to('admin/validate-time')) }};
        var es_url = {{ Js::from(URL::to('admin/update-slot')) }};
    </script>
    <script src="{{ url('resources/views/admin/set_prices/set_prices.js') }}"></script>
    <script>
        $('.edit_data').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-sid');
            var price = $(this).attr('data-price');
            var slot = $(this).attr('data-slot');
            swalWithBootstrapButtons.fire({
                icon: "warning",
                title: 'Update price',
                input: 'number',
                inputAttributes: {
                    required: true,
                    min: 0.1,
                    step: '1',
                    placeholder: 'Price',
                },
                inputValue: 10, // Default value
                focusConfirm: false,
                showCancelButton: !0,
                allowOutsideClick: !1,
                allowEscapeKey: !1,
                confirmButtonText: yes,
                cancelButtonText: no,
                reverseButtons: !0,
                showLoaderOnConfirm: !0,
                didOpen: function() {
                    $('.swal2-icon').hide();
                },
                preConfirm: function(value) {
                    return new Promise(function(o, n) {
                        if (value <= 0 || isNaN(value)) {
                            Swal.showValidationMessage('Please enter a valid price greater than 0.');
                            Swal.disableLoading();
                            return false;
                        } else {
                            $.ajax({
                                type: "POST",
                                url: ajurl,
                                data: {
                                    id: id,
                                    type: type,
                                    coins: coins,
                                    description: description,
                                },
                                success: function(t) {
                                    if (t.status == 1) {
                                        if (t.tblname) {
                                            $('#' + t.tblname).bootstrapTable(
                                                'refresh');
                                            Swal.close();
                                            showtoast('success', t.message);
                                        } else {
                                            location.reload()
                                        }
                                    } else {
                                        swal_cancelled(t.message);
                                    }
                                },
                                error: function(t) {
                                    return swal_cancelled(wrong), !1
                                }
                            })
                        }
                    })
                }
            }).then(t => {
                t.isConfirmed || (t.dismiss, Swal.DismissReason.cancel)
            })
        });
    </script>
@endsection
