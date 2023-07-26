@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\plugins\multi-select\select2.min.css') }}" />
    <link rel="stylesheet"
        href="{{ url('storage\app\public\admin\plugins\multi-select\select2-bootstrap-5-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage\app\public\admin\css\bootstrap\bootstrap-select.min.css') }}" />
@endsection
@section('title')
    {{ trans('labels.add_league') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_league') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item"><a
                                href="{{ URL::to('admin/leagues') }}">{{ trans('labels.leagues') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_league') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <form class="card" action="{{ URL::to('admin/leagues/store') }}" method="post" enctype="multipart/form-data">
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
                                            {{ $dome->id == old('dome') ?? 'selected' }}>{{ $dome->name }}</option>
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
                                <select class="form-control" required name="field[]" id="field"
                                    data-placeholder="{{ trans('labels.select') }}" multiple>
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
                                    value="{{ old('name') }}" placeholder="{{ trans('labels.league_name') }}">
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
                                    name="booking_deadline" value="{{ old('booking_deadline') }}"
                                    min="{{ date('Y-m-d') }}" {{ old('booking_deadline') == '' ? 'disabled' : '' }}>
                                @error('booking_deadline')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="d-flex radio-editer" data-sport-selected="{{ old('sport') ?? '' }}"></div>
                    @error('sport')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                <input type="date" required class="form-control" name="start_date" id="start_date"
                                    value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}">
                                @error('start_date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                <input type="date" required class="form-control" name="end_date" id="end_date"
                                    value="{{ old('end_date') }}" disabled>
                                @error('end_date')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="start_time">{{ trans('labels.start_time') }}</label>
                                <input type="text" required class="form-control start time_picker" name="start_time"
                                    value="{{ old('start_time') }}" placeholder="{{ trans('labels.start_time') }}"
                                    id="start_time">
                                @error('start_time')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="end_time">{{ trans('labels.end_time') }}</label>
                                <input type="text" required class="form-control end time_picker" name="end_time"
                                    value="{{ old('end_time') }}" placeholder="{{ trans('labels.end_time') }}"
                                    id="end_time">
                                @error('end_time')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="days">{{ trans('labels.select_days') }}</label>
                        <select class="form-control" name="days[]" id="days" multiple required>
                            {{-- <option value="Mon" selected> {{ trans('labels.monday') }} </option>
                            <option value="Tue" selected> {{ trans('labels.tuesday') }} </option>
                            <option value="Wed" selected> {{ trans('labels.wednesday') }} </option>
                            <option value="Thu" selected> {{ trans('labels.thursday') }} </option>
                            <option value="Fri" selected> {{ trans('labels.friday') }} </option>
                            <option value="Sat" selected> {{ trans('labels.saturday') }} </option>
                            <option value="Sun" selected> {{ trans('labels.sunday') }} </option> --}}
                        </select>
                        @error('days')
                            <span class="text-danger"> {{ $message }} </span>
                        @enderror
                        @if ($errors->has('days.0'))
                            <span class="text-danger"> <br> {{ $errors->first('days.0') }} </span>
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
                                    @for ($i = 1; $i <= 90; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == old('from_age') ? 'selected' : '' }}>{{ $i }}</option>
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
                                <select class="form-select" required id="to_age" name="to_age"
                                    data-to-age="{{ old('to_age') }}">
                                    <option value="" disabled selected>{{ trans('labels.to') }}</option>
                                </select>
                                @error('to_age')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="min_player">{{ trans('labels.players_per_team') }}</label>
                                <select class="form-select" required id="min_player" name="min_player">
                                    <option value="" disabled selected>{{ trans('labels.min_player') }}</option>
                                    @for ($i = 1; $i <= 30; $i++)
                                        <option value="{{ $i }}"
                                            {{ $i == old('min_player') ? 'selected' : '' }}>{{ $i }}</option>
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
                                <select class="form-select" required id="max_player" name="max_player"
                                    data-max-players="{{ old('max_player') }}">
                                    <option value="" disabled selected>{{ trans('labels.max_player') }}</option>
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
                                    <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>
                                        {{ trans('labels.men') }}</option>
                                    <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>
                                        {{ trans('labels.women') }}</option>
                                    <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>
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
                                            {{ $i == old('team_limit') ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('team_limit')
                                    <span class="text-danger"> {{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="price">{{ trans('labels.price_per_team') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-dollar"></i></span>
                                    <input type="number" required class="form-control" name="price" id="price"
                                        value="{{ old('price') }}" placeholder="{{ trans('labels.price_per_team') }}">
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
                        <input type="file" required class="form-control" name="images[]" id="image">
                        @if ($errors->has('images'))
                            <span class="text-danger">{{ $errors->first('images') }}</span>
                        @endif
                    </div>
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
    <script src="{{ url('storage\app\public\admin\js\bootstrap\bootstrap-select.min.js') }}"></script>
    <script>
        $('.radio-editer').parent().hide();
        var field_selected = [];
        var days_selected = $.map({{ Js::from(explode(' | ', 'Mon | Tue | Wed | Thu | Fri | Sat | Sun')) }}, function(
            value) {
            return value;
        });
        var sport_selected = $('.radio-editer').attr('data-sport-selected');
    </script>
    <script src="{{ url('resources/views/admin/leagues/leagues.js') }}"></script>
@endsection
