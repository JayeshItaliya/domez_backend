@extends('admin.layout.default')
@section('title')
    {{ trans('labels.blocked-timeslots') }}
@endsection
@section('styles')
    <link rel="stylesheet" href={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.min.css') }}>
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>{{ trans('labels.blocked-timeslots') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.blocked-timeslots') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @include('admin.slots.fetchform')
@endsection
@section('scripts')
    <script src={{ url('storage/app/public/admin/plugins/flatpickr/flatpickr.js') }}></script>
    <script src="{{ url('resources/views/admin/slots/slots.js') }}"></script>
@endsection
