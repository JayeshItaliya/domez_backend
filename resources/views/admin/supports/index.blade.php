@extends('admin.layout.default')
@section('title')
    {{ trans('labels.supports') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.supports') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.supports') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="bootstrapTable">
                <thead>
                    <tr>
                        <th> {{ trans('labels.srno') }} </th>
                        @if (auth()->user()->type == 1)
                            <th> {{ trans('labels.dome_owner') }} </th>
                            <th> {{ trans('labels.email') }} </th>
                        @endif
                        <th> {{ trans('labels.subject') }} </th>
                        <th> {{ trans('labels.message') }} </th>
                        @if (auth()->user()->type == 1)
                            <th> {{ trans('labels.action') }} </th>
                        @else
                            <th class="text-center"> {{ trans('labels.status') }} </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($getsupportslist as $support)
                        <tr>
                            <td>{{ $i++ }}</td>
                            @if (auth()->user()->type == 1)
                                <td>{{ $support['dome_owner']->name }}</td>
                                <td>{{ $support['dome_owner']->email }}</td>
                            @endif
                            <td>{{ $support->subject }}</td>
                            <td>{{ $support->message }}</td>
                            <td>
                                @if (auth()->user()->type == 1)
                                    <span class="badge rounded-pill cursor-pointer partial-pill me-4 reply_support"
                                        data-subject="{{ $support->subject }}"
                                        data-user-name="{{ $support['dome_owner']->name }}"
                                        data-message="{{ $support->message }}" data-id="{{ $support->id }}"
                                        data-bs-target="#replysupport" data-bs-toggle="modal">
                                        <i class="fa-solid fa-reply"></i>
                                        {{ trans('labels.reply') }}
                                    </span>
                                @else
                                    <span
                                        class="badge rounded-pill {{ $support->is_replied == 1 ? 'text-bg-success' : 'text-bg-warning' }}">
                                        {{ $support->is_replied == 1 ? trans('labels.replied') : trans('labels.pending') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="raiseticket" tabindex="-1" aria-labelledby="raiseticketLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="raiseticketLabel">{{ trans('labels.raise_ticket') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{ URL::to('admin/supports/store-ticket') }}" method="POST"
                    id="store_ticket">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold" for="subject">{{ trans('labels.subject') }}</label>
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="{{ trans('labels.subject') }}" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message" class="form-label fw-bold">{{ trans('labels.message') }}</label>
                                <textarea class="form-control" name="message" placeholder="{{ trans('labels.message') }}" autocomplete="off"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-auto float-end">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="replysupport" tabindex="-1" aria-labelledby="replysupportLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="modal-body" action="{{ URL::To('admin/supports/ticket-reply') }}" method="POST"
                    id="ticket_reply">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.user_name') }}</label>
                                <p class="data_user_name"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.subject') }}</label>
                                <p class="data_subject"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.message') }}</label>
                                <p class="data_message"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="reply" class="form-label fw-bold">{{ trans('labels.reply') }}</label>
                                <textarea class="form-control" id="ckeditor" name="reply" placeholder="{{ trans('labels.reply') }}" autocomplete="off"
                                    rows="4"></textarea>
                            </div>
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
        if (is_vendor || is_employee) {
            $(document).ready(function() {
                let html =
                    '<a class="btn-custom-primary" data-bs-target="#raiseticket" data-bs-toggle="modal">' +
                    plus_svg_icon + '</a>';
                $('.fixed-table-toolbar .btn-group').append(html);
            })
        }
        $('#store_ticket').on('submit', function() {
            if ($('#store_ticket #subject').val() == "") {
                $('#store_ticket #subject').addClass('is-invalid');
                return false;
            } else {
                $('#store_ticket textarea').removeClass('is-invalid');
                if ($('#store_ticket textarea').val() == "") {
                    $('#store_ticket textarea').addClass('is-invalid');
                    return false;
                } else {
                    $('#store_ticket textarea').removeClass('is-invalid');
                }
            }
            showpreloader();
        });
        $('#ticket_reply').on('submit', function() {
            if ($('#ticket_reply textarea').val() == "") {
                $('#ticket_reply textarea').addClass('is-invalid');
                return false;
            } else {
                showpreloader();
                $('#ticket_reply textarea').removeClass('is-invalid');
            }
        });
        $(function() {
            $(".reply_support").on('click', function() {
                $('input[name=id]').val($(this).attr('data-id'));
                $('.data_user_name').text($(this).attr('data-user-name'));
                $('.show_email').text($(this).attr('data-show-email'));
                $('.data_subject').text($(this).attr('data-subject'));
                $('.data_message').text($(this).attr('data-message'));
            });
        });
    </script>
@endsection
