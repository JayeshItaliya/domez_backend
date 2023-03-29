@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_details') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_details') }}</p>
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
                        <li class="breadcrumb-item">{{ trans('labels.domes') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.dome_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            @if (Auth::user()->type == 1)
                <p class="mb-2 fw-semibold">{{ trans('labels.dome_owner') }}</p>
                <div class="d-flex bg-gray">
                    <div class=" col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.name') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7">{{ $getdomedata->dome_owner->name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.status') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span
                                    class="badge rounded-pill cursor-pointer text-bg-{{ $getdomedata->dome_owner->is_available == 1 ? 'success' : 'danger' }}"
                                    onclick="change_status('{{ $getdomedata->dome_owner->id }}','{{ $getdomedata->dome_owner->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/vendors/change_status') }}')">{{ $getdomedata->dome_owner->is_available == 1 ? trans('labels.active') : trans('labels.inactive') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.email') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7">{{ $getdomedata->dome_owner->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="px-3 py-2 d-flex">
                            <div class="col-md-4">
                                <label>{{ trans('labels.phone_number') }}</label>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted fs-7">{{ $getdomedata->dome_owner->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <p class="mb-2 fw-semibold">{{ trans('labels.dome_details') }}</p>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.hst') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->hst }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.start_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->start_time }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_address') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.end_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->end_time }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.dome_description') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Str::limit($getdomedata->description, 50, '...') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.amenities') }}</label>
                        </div>
                        <div class="col-lg-8">
                            <ul class="d-flex flex-wrap">
                                @foreach (explode('|', $getdomedata->benefits) as $data)
                                    <li class="text-muted fs-7 me-3" style="list-style: inside">{{ $data }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.city') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->city }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.amenities_description') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Str::limit($getdomedata->benefits_description, 50, '...') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.pincode') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->pin_code }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-lg-4 col-md-2">
                            <label>{{ trans('labels.sports') }}</label>
                        </div>
                        <div class="col-lg-8 col-md-10">
                            <ul class="d-flex flex-wrap">
                                @foreach ($getsportslist as $sport)
                                    <li class="text-muted fs-7 me-3 " style="list-style: inside">{{ $sport->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.state') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->state }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.sports_price') }}</label>
                        </div>
                        <div class="col-md-8">
                            <ul class="d-flex flex-wrap">
                                @foreach ($getsportslist as $sport)
                                    <li class="text-muted fs-7 me-3 me-mb-0" style="list-style: inside">
                                        {{ Helper::currency_format(Helper::get_dome_price($getdomedata->id,$sport->id)) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-6 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.country') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getdomedata->country }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 py-2 d-flex">
                <div class="col-12">
                    <label>{{ trans('labels.dome_images') }}</label>
                </div>
            </div>
            <div class="px-3 py-2 d-flex">
                @foreach ($getdomedata['dome_images'] as $images)
                    <div class="col-auto me-3">
                        <img src="{{ $images->image }}" alt="" width="100" height="60" class="rounded"
                            style="object-fit: cover; object-position:center;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-auto">
                            <span class="text-muted fs-7">{{ trans('labels.dome_revenue') }}</span>
                            <p class="fw-semibold">5000 $</p>
                        </div>
                        <select class="form-select w-auto" name="" id="">
                            <option value="last-7">{{ trans('labels.last_7_days') }}</option>
                            <option value="this-month">{{ trans('labels.this_month') }}</option>
                            <option value="this-year">{{ trans('labels.this_year') }}</option>
                        </select>
                    </div>
                    <div id="dome_revenue"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="col-auto">
                            <span class="text-muted fs-7">{{ trans('labels.total_bookings') }}</span>
                            <p class="fw-semibold">110</p>
                        </div>
                        <select class="form-select w-auto" name="" id="">
                            <option value="last-7">{{ trans('labels.last_7_days') }}</option>
                            <option value="this-month">{{ trans('labels.this_month') }}</option>
                            <option value="this-year">{{ trans('labels.this_year') }}</option>
                        </select>
                    </div>
                    <div id="booking_chart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/charts/apexchart/apexcharts.js') }}"></script>
    <script>
        // Dome Revenue Chart
        var options = {
            series: [{
                name: "Revenue",
                data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 155, 200, 230]
            }],
            chart: {
                height: 400,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val + "$"
                }
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.3
                },
            },
            colors: [secondary_color],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            }
        };
        var chart = new ApexCharts(document.querySelector("#dome_revenue"), options);
        chart.render();
        //Total Bookings Chart
        var options = {
            series: [44, 55, 11],
            chart: {
                height: 450,
                type: 'pie',
            },
            labels: ['{{ trans('labels.confirm_bookings') }}', '{{ trans('labels.pending_bookings') }}',
                '{{ trans('labels.cancel_bookings') }}'
            ],
            colors: [primary_color, secondary_color, light_secondary_color],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        show: false,
                        position: 'bottom'
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#booking_chart"), options);
        chart.render();
    </script>
@endsection
