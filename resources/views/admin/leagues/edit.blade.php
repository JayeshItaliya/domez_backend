@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\plugins\multi-select\select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\css\bootstrap\bootstrap-select.min.css') }}" />
@endsection
@section('title')
    {{ trans('labels.edit_league') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_league') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/leagues') }}">{{ trans('labels.leagues') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_league') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/leagues/update-' . $getleaguedata->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="dome">{{ trans('labels.select_dome') }}</label>
                                <select class="form-select" required name="dome" id="dome" data-next="{{ URL::to('/admin/leagues/sports-fields') }}">
                                    @foreach ($domes as $dome)
                                        <option value="{{ $dome->id }}" data-start-time="{{ $dome->start_time }}" data-end-time="{{ $dome->end_time }}" data-slot-duration="{{ $dome->slot_duration }}" {{ $dome->id == $getleaguedata->dome_id ? 'selected' : '' }}> {{ $dome->name }}</option>
                                    @endforeach
                                </select>
                                @error('dome') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="field">{{ trans('labels.select_field') }}</label>
                                <select class="form-control" name="field[]" id="field" data-placeholder="{{ trans('labels.select') }}" multiple required></select>
                                @error('field') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ trans('labels.league_name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ !empty(old('name')) ? old('name') : $getleaguedata->name }}" placeholder="{{ trans('labels.league_name') }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ trans('labels.last_date_registration') }}</label>
                                <input type="date" required class="form-control" id="booking_deadline" name="booking_deadline" value="{{ $getleaguedata->booking_deadline }}" max="{{ $getleaguedata->start_date }}">
                                @error('booking_deadline') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="d-flex radio-editer"></div>
                    @error('sport') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                <input type="date" required class="form-control" name="start_date" value="{{ $getleaguedata->start_date }}" id="start_date" min="{{ $getleaguedata->start_date }}">
                                @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                <input type="date" required class="form-control" name="end_date" value="{{ $getleaguedata->end_date }}" id="end_date" disabled>
                                @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="start_time">{{ trans('labels.start_time') }}</label>
                                <input type="text" required class="form-control start time_picker" name="start_time" value="{{ $getleaguedata->start_time }}" placeholder="{{ trans('labels.start_time') }}" id="start_time">
                                @error('start_time') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="end_time">{{ trans('labels.end_time') }}</label>
                                <input type="text" required class="form-control end time_picker" name="end_time" value="{{ $getleaguedata->end_time }}" placeholder="{{ trans('labels.end_time') }}" id="end_time">
                                @error('end_time') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="days">{{ trans('labels.select_days') }}</label>
                        <select class="form-control" name="days[]" id="days" multiple required>
                        </select>
                        @error('days')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if ($errors->has('days.0'))
                            <small class="text-danger"> <br> {{ $errors->first('days.0') }} </small>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="from_age">{{ trans('labels.age') }}</label>
                                <select class="form-select" required id="from_age" name="from_age">
                                    <option value="" disabled selected>{{ trans('labels.from_age') }}</option>
                                    @for ($i = 1; $i <= 89; $i++)
                                        <option value="{{ $i }}" {{ $i == $getleaguedata->from_age ? 'selected' : '' }}>{{ $i }} </option>
                                    @endfor
                                </select>
                                @error('from_age') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="to_age"></label>
                                <select class="form-select" required id="to_age" name="to_age" data-to-age="{{ $getleaguedata->to_age }}">
                                    <option value="" disabled selected>{{ trans('labels.to') }}</option>
                                </select>
                                @error('to_age') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="min_player">{{ trans('labels.players') }}</label>
                                <select class="form-select" required id="min_player" name="min_player">
                                    <option value="" disabled selected>{{ trans('labels.min_player') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->min_player ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('min_player') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="max_player"></label>
                                <select class="form-select" required id="max_player" name="max_player" data-max-players="{{ $getleaguedata->max_player }}">
                                    <option value="" disabled selected>{{ trans('labels.max_player') }}</option>
                                </select>
                                @error('max_player') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="gender">{{ trans('labels.select_gender') }}</label>
                                <select class="form-select" required name="gender" id="gender">
                                    <option value="1" {{ $getleaguedata->gender == 1 ? 'selected' : '' }}> {{ trans('labels.men') }}</option>
                                    <option value="2" {{ $getleaguedata->gender == 2 ? 'selected' : '' }}> {{ trans('labels.women') }}</option>
                                    <option value="3" {{ $getleaguedata->gender == 3 ? 'selected' : '' }}> {{ trans('labels.mixed') }}</option>
                                </select>
                                @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.team_limit') }}</label>
                                <select class="form-select" required id="team_limit" name="team_limit">
                                    @for ($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->team_limit ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('team_limit') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="price">{{ trans('labels.price_per_team') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                    <input type="text" class="form-control numbers_only" name="price" id="price" required value="{{ $getleaguedata->price }}" placeholder="{{ trans('labels.price_per_team') }}">
                                </div>
                                @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="image">{{ trans('labels.banner_images') }}</label>
                        <input type="file" class="form-control" name="images[]" id="image">
                        @if ($errors->has('images'))
                            <small class="text-danger">{{ $errors->first('images') }}</small>
                        @endif
                    </div>
                </div>
                <div class="row my-4">
                    @foreach ($getleaguedata['league_images'] as $leagueimages)
                        <div class="avatar avatar-xl col-auto">
                            <div class="dome-img">
                                <img src="{{ $leagueimages->image }}" alt="..." class="mb-3 rounded d-block">
                                <div class="dome-img-overlay rounded">
                                    <a onclick="deletedata('{{ $leagueimages->id }}','{{ URL::to('admin/leagues/image_delete') }}')" class="delete-icon fs-5 rounded-circle py-2 px-3"><i class="fa-light fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                    <a href="{{ URL::to('admin/leagues') }}" class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.js') }}"></script>
    <script src="{{ url('storage\app\public\admin\js\bootstrap\bootstrap-select.min.js') }}"></script>
    <script>
        $('.radio-editer').parent().show();
        var field_selected = $.map({{ Js::from(explode(',', $getleaguedata->field_id)) }}, function(value) {
            return parseInt(value, 10);
        });
        var days_selected = $.map({{ Js::from(explode(' | ', $getleaguedata->days)) }}, function(value) {
            return value;
        });
        var sport_selected = {{ Js::from($getleaguedata->sport_id) }};
    </script>
    <script src="{{ url('resources/views/admin/leagues/leagues.js') }}"></script>
@endsection
