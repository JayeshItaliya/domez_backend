@extends('admin.layout.default')
@section('title')
    {{ trans('labels.league_details') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.league_details') }}</p>
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
                        <li class="breadcrumb-item"><a
                                href="{{ URL::to('admin/leagues') }}">{{ trans('labels.leagues') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.league_details') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <p class="mb-2 fw-semibold">{{ trans('labels.dome_details') }}</p>
            <div class="d-flex bg-gray">
                <div class="col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Dome Name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getleaguedata->dome_info->name }}</span>
                        </div>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.fields') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">
                                @foreach ($fields as $field)
                                    {{ $field->name }} {{ !$loop->last ? '&' : '' }}
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 py-2 row">
                <div class="col-md-2">
                    <label>{{ trans('labels.dome_address') }}</label>
                </div>
                <div class="col-md-10 ps-0">
                    <span class="text-muted fs-7">{{ $getleaguedata->dome_info->address }}</span>
                </div>
            </div>
            <p class="my-3 fw-semibold">{{ trans('labels.league_details') }}</p>
            <div class="d-flex bg-gray">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.league_name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getleaguedata->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.price_per_team') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::currency_format($getleaguedata->price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.team_limit') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getleaguedata->team_limit }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.price_per_team') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::currency_format($getleaguedata->price) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.start_date') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::date_format($getleaguedata->start_date) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.end_date') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::date_format($getleaguedata->end_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.start_time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::time_format($getleaguedata->start_time) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.end_time') }}<label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ Helper::time_format($getleaguedata->end_time) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex bg-gray">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.min_player') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getleaguedata->min_player }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.max_player') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">{{ $getleaguedata->max_player }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.age') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span
                                class="text-muted fs-7">{{ $getleaguedata->from_age . ' - ' . $getleaguedata->to_age . ' ' . trans('labels.years') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('labels.gender') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span
                                class="text-muted fs-7">{{ $getleaguedata->gender == 1 ? trans('labels.men') : ($getleaguedata->gender == 2 ? trans('labels.women') : trans('labels.other')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 py-2 d-flex">
                @foreach ($getleaguedata['league_images'] as $images)
                    <div class="col-auto me-3">
                        <img src="{{ $images->image }}" alt="" width="100" height="60" class="rounded"
                            style="object-fit: cover; object-position:center;">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
