@extends('admin.layout.default')
@section('title') Refund Policy @endsection
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/summernote/summernote.min.css') }}">
@endsection
@section('contents')
    <h1 class="h2">Refund Policy</h1>
    <div class="row">
        <div class="card">
            <form class="card-body" action="{{URL::to('admin/cms/store-refund-policy')}}" method="post">
                @csrf
                @error('refund_policy') <span class="text-danger mb-3">{{$message}}</span> @enderror
                <textarea id="refund_policy" name="content">{{!empty($content) ? $content->content : ''}}</textarea>
                <button type="submit" class="btn btn-primary mt-4 float-end">Save</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#refund_policy').summernote({
                placeholder: 'Please Enter Refund Policy',
                tabsize: 2,
                minHeight: 500
            });
        });
    </script>
@endsection
