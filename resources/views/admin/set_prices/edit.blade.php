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
                    <ol class="breadcrumb m-0 align-items-center">
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
                                    $cnt = App\Models\SetPricesDaysSlots::where('dome_id', $data->dome_id)
                                        ->where('sport_id', $data->sport_id)
                                        ->whereDate('date', date('Y-m-d', strtotime($data->date)))
                                        ->where('status', 0)
                                        ->count();
                                @endphp
                                @foreach ($getslotslist as $slot)
                                    @php
                                        $slot_ = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
                                    @endphp
                                    <div class="d-flex justify-content-center align-items-center gap-2 my-2">
                                        <p> {{ $slot_ }} : <b>{{ Helper::currency_format($slot->price) }}</b> </p>
                                        @if ($slot->status == 1)
                                            <a class="cursor-pointer edit_slot" data-sid="{{ $slot->id }}"
                                                data-slot="{{ $slot_ }}" data-price="{{ $slot->price }}">
                                                {!! Helper::get_svg(2) !!}</a>
                                        @endif
                                    </div>
                                @endforeach
                                @if ($cnt == 0)
                                    <a class="btn btn-sm btn-outline-danger"
                                        onclick="deleteslots('{{ $data->dome_id }}','{{ $data->sport_id }}','{{ $data->date }}','{{ URL::to('admin/set-prices/delete-slot') }}')">
                                        {{ trans('labels.delete_all') }} </a>
                                @endif
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
        var es_url = {{ Js::from(URL::to('admin/set-prices/update-slot')) }};
        var title_edit = {{ Js::from(trans('labels.edit')) }};
        var title_price = {{ Js::from(trans('labels.price')) }};
        var title_cancel = {{ Js::from(trans('labels.cancel')) }};
    </script>
    <script src="{{ url('resources/views/admin/set_prices/set_prices.js') }}"></script>
    <script>
        $('.edit_slot').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-sid');
            var price = $(this).attr('data-price');
            var slot = $(this).attr('data-slot');
            swalWithBootstrapButtons.fire({
                icon: "info",
                title: title_edit + ' ' + title_price,
                input: 'number',
                inputAttributes: {
                    required: true,
                    min: 0,
                    step: '1',
                    placeholder: title_price,
                },
                inputValue: price,
                focusConfirm: false,
                showCancelButton: !0,
                allowOutsideClick: !1,
                allowEscapeKey: !1,
                confirmButtonText: title_edit,
                cancelButtonText: title_cancel,
                reverseButtons: !0,
                showLoaderOnConfirm: !0,
                didOpen: function() {
                    $('.swal2-icon').hide();
                },
                preConfirm: function(price) {
                    return new Promise(function(o, n) {
                        if (price <= 0 || isNaN(price)) {
                            Swal.showValidationMessage(
                                'Please enter a valid price greater than 0.');
                            Swal.disableLoading();
                            return false;
                        } else {
                            $.ajax({
                                type: "POST",
                                url: es_url,
                                data: {
                                    id: id,
                                    price: price,
                                },
                                success: function(t) {
                                    Swal.disableLoading();
                                    if (t.status == 1) {
                                        toastr.success(t.message);
                                        $('.swal2-confirm,.swal2-cancel').addClass(
                                            'disabled').attr('disabled', true);
                                        setTimeout(() => {
                                            location.reload()
                                        }, 200);
                                    } else {
                                        Swal.showValidationMessage(t.message);
                                    }
                                    return false;
                                },
                                error: function(t) {
                                    Swal.showValidationMessage(wrong);
                                    Swal.disableLoading();
                                    return false;
                                }
                            })
                        }
                    })
                }
            }).then(t => {
                t.isConfirmed || (t.dismiss, Swal.DismissReason.cancel)
            })
        });

        function deleteslots(dome, sport, date, e) {
            "use strict";
            swalWithBootstrapButtons.fire({
                icon: "warning",
                title: are_you_sure,
                showCancelButton: !0,
                allowOutsideClick: !1,
                allowEscapeKey: !1,
                confirmButtonText: yes,
                cancelButtonText: no,
                reverseButtons: !0,
                showLoaderOnConfirm: !0,
                preConfirm: function() {
                    return new Promise(function(o, n) {
                        $.ajax({
                            type: "GET",
                            url: e,
                            data: {
                                dome: dome,
                                sport: sport,
                                date: date,
                            },
                            dataType: "json",
                            success: function(t) {
                                if (1 != t.status) return swal_cancelled(wrong), !1;
                                location.reload()
                            },
                            error: function(t) {
                                return swal_cancelled(wrong), !1
                            }
                        })
                    })
                }
            }).then(t => {
                t.isConfirmed || (t.dismiss, Swal.DismissReason.cancel)
            })
        }
    </script>
@endsection
