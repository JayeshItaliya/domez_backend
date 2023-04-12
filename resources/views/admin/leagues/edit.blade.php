@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.css') }}" />
    <link rel="stylesheet"
        href="{{ url('storage\app\public\admin\plugins\multi-select\select2-bootstrap-5-theme.min.css') }}" />
@endsection
@section('title')
    {{ trans('labels.edit_league') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.edit_league') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit_league') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/leagues/update-' . $getleaguedata->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="dome">{{ trans('labels.select_dome') }}</label>
                                <select class="form-select" required name="dome" id="dome"
                                    data-next="{{ URL::to('/admin/leagues/sports-fields') }}">

                                    @foreach ($domes as $dome)
                                        <option value="{{ $dome->id }}" data-start-time="{{ $dome->start_time }}"
                                            data-end-time="{{ $dome->end_time }}"
                                            data-slot-duration="{{ $dome->slot_duration }}"
                                            {{ $dome->id == $getleaguedata->dome_id ? 'selected' : '' }}>
                                            {{ $dome->name }}</option>
                                    @endforeach
                                </select>
                                @error('dome')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="field">{{ trans('labels.select_field') }}</label>
                                <select class="form-select" required name="field[]" id="field"
                                    data-placeholder="{{ trans('labels.select') }}" multiple>
                                    {{-- @foreach ($fields as $field)
                                        <option value="{{ $field->id }}"
                                            {{ in_array($field->id, explode(',', $getleaguedata->field_id)) ? 'selected' : '' }}>
                                            {{ $field->name }}</option>
                                    @endforeach --}}
                                </select>
                                @error('field')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">{{ trans('labels.league_name') }}</label>
                                <input type="text" required class="form-control" id="name" name="name"
                                    value="{{ $getleaguedata->name }}" placeholder="{{ trans('labels.league_name') }}">
                                @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name"
                                    class="form-label">{{ trans('labels.last_date_registration') }}</label>
                                <input type="date" required class="form-control" id="booking_deadline"
                                    name="booking_deadline" value="{{ $getleaguedata->booking_deadline }}"
                                    max="{{ $getleaguedata->start_date }}">
                                @error('booking_deadline')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="d-flex radio-editer">
                        {{-- @foreach ($sports as $key => $sport)
                            <div class="form-check pe-3">
                                <input type="radio" name="sport" class="form-check-input" value="{{ $sport->id }}"
                                    id="radio{{ $key }}"
                                    {{ $sport->id == $getleaguedata->sport_id ? 'checked' : '' }}>
                                <label class="form-check-label" for="radio{{ $key }}">{{ $sport->name }}</label>
                            </div>
                        @endforeach --}}
                    </div>
                    @error('sport')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                <input type="date" required class="form-control" name="start_date"
                                    value="{{ $getleaguedata->start_date }}" id="start_date"
                                    min="{{ $getleaguedata->start_date }}">
                                @error('start_date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                <input type="date" required class="form-control" name="end_date"
                                    value="{{ $getleaguedata->end_date }}" id="end_date" disabled>
                                @error('end_date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="start_time">{{ trans('labels.start_time') }}</label>
                                <input type="text" required class="form-control start time_picker" name="start_time"
                                    value="{{ $getleaguedata->start_time }}"
                                    placeholder="{{ trans('labels.start_time') }}" id="start_time">
                                @error('start_time')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="end_time">{{ trans('labels.end_time') }}</label>
                                <input type="text" required class="form-control end time_picker" name="end_time"
                                    value="{{ $getleaguedata->end_time }}" placeholder="{{ trans('labels.end_time') }}"
                                    id="end_time">
                                @error('end_time')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="from_age">{{ trans('labels.age') }}</label>
                                <select class="form-select" required id="from_age" name="from_age">
                                    <option value="" disabled selected>{{ trans('labels.from_age') }}</option>
                                    @for ($i = 12; $i <= 50; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->from_age ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('from_age')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="to_age"></label>
                                <select class="form-select" required id="to_age" name="to_age">
                                    <option value="" disabled selected>{{ trans('labels.to_age') }}</option>
                                    @for ($i = 12; $i <= 50; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->to_age ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                                @error('to_age')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
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
                                @error('min_player')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="max_player"></label>
                                <select class="form-select" required id="max_player" name="max_player">
                                    <option value="" disabled selected>{{ trans('labels.max_player') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->max_player ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('max_player')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
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
                                    <option value="1" {{ $getleaguedata->gender == 1 ? 'selected' : '' }}>
                                        {{ trans('labels.men') }}</option>
                                    <option value="2" {{ $getleaguedata->gender == 2 ? 'selected' : '' }}>
                                        {{ trans('labels.women') }}</option>
                                    <option value="3" {{ $getleaguedata->gender == 3 ? 'selected' : '' }}>
                                        {{ trans('labels.mixed') }}</option>
                                </select>
                                @error('gender')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.team_limit') }}</label>
                                <select class="form-select" required id="team_limit" name="team_limit">

                                    @for ($i = 5; $i <= 20; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == $getleaguedata->team_limit ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('team_limit')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="price">{{ trans('labels.price') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                    <input type="number" required class="form-control" name="price" id="price"
                                        value="{{ $getleaguedata->price }}" placeholder="{{ trans('labels.price') }}">
                                </div>
                                @error('price')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label class="form-label" for="image">{{ trans('labels.banner_images') }}</label>
                        <input type="file" class="form-control" name="images[]" id="image">
                        @if ($errors->has('images'))
                            <span class="text-danger">{{ $errors->first('images') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row mb-4">
                    @foreach ($getleaguedata['league_images'] as $leagueimages)
                        <div class="avatar avatar-xl col-auto">
                            <div class="dome-img">
                                <img src="{{ $leagueimages->image }}" alt="..." class="mb-3 rounded d-block">
                                <div class="dome-img-overlay rounded">
                                    <a onclick="deletedata('{{ $leagueimages->id }}','{{ URL::to('admin/leagues/image_delete') }}')"
                                        class="delete-icon fs-5 rounded-circle py-2 px-3"><i
                                            class="fa-light fa-trash-can"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary me-3">{{ trans('labels.submit') }}</button>
                    <a href="{{ URL::to('admin/leagues') }}"
                        class="btn btn-outline-danger">{{ trans('labels.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.js') }}"></script>
    <script>
        // var validatetimeurl = {{ Js::from(URL::to('admin/validate-time')) }};
        $('.radio-editer').parent().show();
        var field_selected = $.map({{ Js::from(explode(',', $getleaguedata->field_id)) }}, function(value) {
            return parseInt(value, 10);
        });
        var sport_selected = {{ Js::from($getleaguedata->sport_id) }};
    </script>
    <script src="{{ url('resources/views/admin/leagues/leagues.js') }}"></script>
@endsection
