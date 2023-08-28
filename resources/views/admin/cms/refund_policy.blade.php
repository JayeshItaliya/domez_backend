@extends('admin.layout.default')
@section('title')
    {{ trans('labels.refund_policy') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.refund_policy') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.cms') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.refund_policy') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <form class="card-body" action="{{ URL::to('admin/cms/store') }}" method="post">
                @csrf
                <textarea id="ckeditor" name="content">{{ old('content') != "" && old('content') != Helper::cms(3) ? old('content') : Helper::cms(3) }}</textarea>
                @error('content') <p class="text-danger my-2">{{ $message }}</p> @enderror
                <button type="submit" name="refund_policy" value="1" class="btn btn-primary mt-3">{{ trans('labels.submit') }}</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            height: '500',
        });
    </script>
@endsection
