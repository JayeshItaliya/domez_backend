@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.add_league') }}
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_league') }}</p>
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
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/leagues')}}">{{ trans('labels.leagues') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_league') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <form class="card" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <label for="" class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="d-flex radio-editer">
                        @foreach ($sports as $sport)
                            <div class="form-check pe-3">
                                <input type="radio" name="sport" class="form-check-input" value="{{ $sport->id }}"
                                    id="{{ $sport->name . $sport->id }}" {{ $loop->first ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="{{ $sport->name . $sport->id }}">{{ $sport->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="league_name" class="form-label">{{ trans('labels.league_name') }}</label>
                        <input type="text" class="form-control" id="league_name" name="league_name"
                            placeholder="{{ trans('labels.league_name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="domes">{{ trans('labels.select_dome') }}</label>
                                <select class="form-select" id="domes">
                                    <option disabled selected>{{ trans('labels.select_dome') }}</option>
                                    @foreach ($domes as $dome)
                                        <option value="{{ $dome->id }}">{{ $dome->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="fields">{{ trans('labels.select_field') }}</label>
                                <select class="form-select" id="fields">
                                    <option selected>Select Field</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.start_date') }}</label>
                                <input type="date" class="form-control" id="datepicker">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.end_date') }}</label>
                                <input type="date" class="form-control" id="datepicker">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="start_time">{{ trans('labels.start_time') }}</label>
                                <input type="time" class="form-control " name="start_time" id="start_time">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="end_time">{{ trans('labels.end_time') }}</label>
                                <input type="time" class="form-control " name="end_time" id="end_time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-2 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="from_age">{{ trans('labels.from_age') }}</label>
                                <select class="form-select" id="from_age" name="from_age">
                                    <option disabled selected>{{ trans('labels.age') }}</option>
                                    @for ($i = 12; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="to_age">{{ trans('labels.to_age') }}</label>
                                <select class="form-select" id="to_age" name="to_age">
                                    <option disabled selected>{{ trans('labels.age') }}</option>
                                    @for ($i = 12; $i <= 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="select_gender">{{ trans('labels.select_gender') }}</label>
                                <select class="form-select" id="select_gender">
                                    <option selected>{{ trans('labels.select_gender') }}</option>
                                    <option value="1">{{ trans('labels.male') }}</option>
                                    <option value="2">{{ trans('labels.female') }}</option>
                                    <option value="3">{{ trans('labels.other') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="min_player">{{ trans('labels.min_player') }}</label>
                                <select class="form-select" id="min_player" name="min_player">
                                    <option disabled selected>{{ trans('labels.min_player') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="max_player">{{ trans('labels.max_player') }}</label>
                                <select class="form-select" id="max_player" name="max_player">
                                    <option disabled selected>{{ trans('labels.max_player') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.team_limit') }}</label>
                                <select class="form-select" id="team_limit" name="team_limit">
                                    <option disabled selected>{{ trans('labels.team_limit') }}</option>
                                    @for ($i = 5; $i <= 20; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Price Per Team</label>
                                <input type="number" placeholder="0" class="form-control ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="form-label">League Banner Images</label>
                        <input type="file" class="form-control mb-4">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
