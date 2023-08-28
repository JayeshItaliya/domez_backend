@extends('admin.layout.default')
@section('title')
    {{ trans('labels.help_support') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.help_support') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.help_support') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="bootstrapTable">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.srno') }}</th>
                            <th>{{ trans('labels.email') }}</th>
                            <th>{{ trans('labels.subject') }}</th>
                            <th>{{ trans('labels.message') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($enquiries as $enquiry)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $enquiry->email }}</td>
                                <td>{{ $enquiry->subject }}</td>
                                <td>{{ $enquiry->message }}</td>
                                <td>
                                    <span class="badge rounded-pill cursor-pointer reply-pill me-2 reply_action"
                                        data-show-name="{{ $enquiry->name }}" data-show-email="{{ $enquiry->email }}"
                                        data-show-subject="{{ $enquiry->subject }}"
                                        data-show-message="{{ $enquiry->message }}" data-id="{{ $enquiry->id }}"
                                        data-bs-target="#reply_modal" data-bs-toggle="modal" style="height: fit-content">
                                        <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.25833 3.70833L1.125 6.04167L3.25833 8.375M1.125 6.04167H6.99167C7.55746 6.04167 8.10008 5.79583 8.50016 5.35825C8.90024 4.92066 9.125 4.32717 9.125 3.70833C9.125 3.08949 8.90024 2.496 8.50016 2.05842C8.10008 1.62083 7.55746 1.375 6.99167 1.375H6.45833"
                                                stroke="#2196F3" stroke-width="1.25" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        {{ trans('labels.reply') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reply_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replymessageLabel">{{ trans('labels.reply') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ URL::to('admin/enquiries/help-support-reply') }}" method="POST" class="modal-body"
                    id="reply_help_support_form">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="email" class="form-label fw-bold">{{ trans('labels.email') }}</label>
                            <p class="show_email"></p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="phone_number" class="form-label fw-bold">{{ trans('labels.subject') }}</label>
                            <p class="show_subject"></p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="dome_name" class="form-label fw-bold">{{ trans('labels.message') }}</label>
                            <p class="show_message"></p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="reply" class="form-label fw-bold">{{ trans('labels.reply') }}</label>
                            <textarea class="form-control" id="ckeditor" name="reply" placeholder="{{ trans('labels.reply') }}" autocomplete="off"
                                rows="4" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
<script>
        CKEDITOR.replace('ckeditor', {
            height: '300',
        });
        $('#reply_help_support_form').on('submit', function() {
            if ($('#reply_help_support_form textarea').val() == "") {
                $('#reply_help_support_form textarea').addClass('is-invalid');
                return false;
            } else {
                showpreloader();
                $('#reply_help_support_form textarea').removeClass('is-invalid');
            }
        });
        $(function() {
            $(".reply_action").on('click', function() {
                $('input[name=id]').val($(this).attr('data-id'));
                $('.show_email').text($(this).attr('data-show-email'));
                $('.show_subject').text($(this).attr('data-show-subject'));
                $('.show_message').text($(this).attr('data-show-message'));
            });
        });
    </script>
@endsection
