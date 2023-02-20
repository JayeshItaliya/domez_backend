@extends('admin.layout.default')
@section('title') Privacy Policy @endsection
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin/css/summernote/summernote.min.css') }}">
@endsection
@section('contents')
    <!-- Title -->
    <h1 class="h2">Privacy Policy</h1>
    <div class="row">
        <div class="card">
            <form class="card-body" action="{{ URL::to('admin/cms/store-privacy-policy') }}" method="post">
                @csrf
                @error('privacy_policy')
                    <span class="text-danger mb-3">{{ $message }}</span>
                @enderror
                <textarea id="privacy_policy" name="content">{{!empty($content) ? $content->content : ''}}</textarea>
                <button type="submit" class="btn btn-primary mt-4 float-end">Save</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#privacy_policy').summernote({
                placeholder: 'Please Enter Privacy Policy',
                tabsize: 2,
                minHeight: 500,
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
