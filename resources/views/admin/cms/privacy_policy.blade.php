@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.privacy_policy') }}
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/plugins/richtexteditor/rte_theme_default.css') }}" />
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.privacy_policy') }}</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.privacy_policy') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ URL::to('admin/settings/store-cms') }}" method="post">
                @csrf
                <textarea name="content" id="ckeditor">{{ @$content->content }}</textarea>
                <button type="submit" name="privacy_policy"
                    class="btn btn-primary mt-3">{{ trans('labels.submit') }}</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src={{url('storage/app/public/admin/plugins/ckeditor/ckeditor.js')}}></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            height: '500',
        });
    </script>
@endsection
