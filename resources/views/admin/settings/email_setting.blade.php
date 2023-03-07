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
                        <li class="breadcrumb-item">{{ trans('labels.general_settings') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.email_settings') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1"
                                    class="form-label">{{ trans('labels.mailer') }}</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="{{ trans('labels.mailer') }}">
                            </div>
                            <div class="form-group">
                                <label for="staticport" class="form-label">{{ trans('labels.port') }}</label>
                                <input type="text" class="form-control" id="examplestaticport" placeholder="Enter Port">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1"
                                    class="form-label">{{ trans('labels.password') }}</label>
                                <input type="password" class="form-control" id="exampleFormControlInput1"
                                    placeholder="{{ trans('labels.password') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1"
                                    class="form-label">{{ trans('labels.from_email_address') }}</label>
                                <input type="Email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="{{ trans('labels.from_email_address') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput2" class="form-label">{{ trans('labels.host') }}</label>
                                <input type="text" class="form-control" id="exampleFormControlInput2"
                                    placeholder="{{ trans('labels.host') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.username') }}</label>
                                <input type="text" class="form-control" placeholder="{{ trans('labels.username') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1"
                                    class="form-label">{{ trans('labels.encryption') }}</label>
                                <select class="form-select">
                                    <option selected value="tls">{{ trans('labels.tls') }}</option>
                                    <option value="ssl">{{ trans('labels.ssl') }}</option>
                                </select>
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
