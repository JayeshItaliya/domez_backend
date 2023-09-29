@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.email_settings') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.email_settings') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.general_settings') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.email_settings') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="card" action="{{ URL::to('admin/settings/email-setting') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mailer" class="form-label">{{ trans('labels.mailer') }}</label>
                                <input type="text" class="form-control" name="mailer" id="mailer"
                                    value="{{ env('MAIL_MAILER') }}" placeholder="{{ trans('labels.mailer') }}">
                                    @error('mailer') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="port" class="form-label">{{ trans('labels.port') }}</label>
                                <input type="text" class="form-control" name="port" id="port"
                                    value="{{ env('MAIL_PORT') }}" placeholder="Enter Port">
                                    @error('port') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{ trans('labels.password') }}</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    value="{{ env('MAIL_PASSWORD') }}" placeholder="{{ trans('labels.password') }}">
                                    @error('password') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="host" class="form-label">{{ trans('labels.host') }}</label>
                                <input type="text" class="form-control" name="host" id="host"
                                    value="{{ env('MAIL_HOST') }}" placeholder="{{ trans('labels.host') }}">
                                    @error('host') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="username">{{ trans('labels.username') }}</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    value="{{ env('MAIL_USERNAME') }}" placeholder="{{ trans('labels.username') }}">
                                    @error('username') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                            <div class="form-group">
                                <label for="encryption" class="form-label">{{ trans('labels.encryption') }}</label>
                                <select class="form-select" name="encryption" id="encryption">
                                    <option value="ssl" {{ env('MAIL_ENCRYPTION') == 'ssl' ? 'selected' : '' }}>
                                        {{ trans('labels.ssl') }}</option>
                                    <option selected value="tls"
                                        {{ env('MAIL_ENCRYPTION') == 'tls' ? 'selected' : '' }}>{{ trans('labels.tls') }}
                                    </option>
                                </select>
                                @error('encryption') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
