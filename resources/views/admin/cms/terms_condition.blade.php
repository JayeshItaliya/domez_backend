@extends('admin.layout.default')
@section('title') Terms & Conditions @endsection
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/summernote/summernote.min.css') }}">
@endsection
@section('contents')
    <!-- Title -->
    <h1 class="h2">Terms & Conditions</h1>
    <div class="row">
        <div class="card">
            <form class="card-body" action="{{URL::to('admin/cms/store-terms-condition')}}" method="post">
                @csrf
                @error('terms_condition') <span class="text-danger mb-3">{{$message}}</span> @enderror
                <textarea id="terms_condition" name="content">{{!empty($content) ? $content->content : ''}}</textarea>
                <button type="submit" class="btn btn-primary mt-4 float-end">Save</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#terms_condition').summernote({
                placeholder: 'Please Enter Terms & Conditions',
                tabsize: 2,
                minHeight: 500
            });
        });
    </script>
@endsection
