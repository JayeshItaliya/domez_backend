@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.privacy_policy') }}
@endsection
@section('styles')
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }

        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endsection
@section('contents')
    <!-- Title -->
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
            <textarea id="editor"></textarea>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin/js/ckeditor/ckeditor.js') }}"></script>

    <script>
        ClassicEditor.create(document.querySelector('#editor'), {
                toolbar: ['htmlEmbed', /* ... */ ],
                htmlEmbed: {
                    showPreviews: true,
                    sanitizeHtml: (inputHtml) => {
                        // Strip unsafe elements and attributes, e.g.:
                        // the `<script>` elements and `on*` attributes.
                        const outputHtml = sanitize(inputHtml);

                        return {
                            html: outputHtml,
                            // true or false depending on whether the sanitizer stripped anything.
                            hasChanged: true
                        };
                    }
                }
            })
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>
@endsection
