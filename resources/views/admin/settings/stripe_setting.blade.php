@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.stripe_settings') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.stripe_settings') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.stripe_settings') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ URL::to('admin/payment-gateway/store-stripe') }}" method="POST" class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        @if (Auth::user()->type == 1)
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="public_key" class="form-label">{{ trans('labels.public_key') }}</label>
                                    <input type="text" name="public_key" class="form-control" id="public_key"
                                        placeholder="{{ trans('labels.public_key') }}"
                                        value="{{ !empty($stripe->public_key) ? $stripe->public_key : old('public_key') }}">
                                    @error('public_key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="secret_key" class="form-label">{{ trans('labels.secret_key') }}</label>
                                    <input type="text" class="form-control" id="secret_key"
                                        name="secret_key"placeholder="{{ trans('labels.secret_key') }}"value="{{ !empty($stripe->secret_key) ? $stripe->secret_key : old('secret_key') }}">
                                    @error('secret_key')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="account_id" class="form-label">{{ trans('labels.account_id') }}</label>
                                    <input type="text" class="form-control" id="account_id"
                                        name="account_id"placeholder="{{ trans('labels.account_id') }}"value="{{ !empty($stripe->account_id) ? $stripe->account_id : old('account_id') }}" aria-describedby="account_idHelp">
                                        <div id="account_idHelp" class="form-text text-muted">How do i find?<a class="ms-2" href="https://stripe.com/docs/dashboard/basics#:~:text=Find%20your%20account%20ID,ID%E2%80%9D%20in%20the%20search%20bar." target="_blank">Click Here</a></div>
                                    @error('account_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
