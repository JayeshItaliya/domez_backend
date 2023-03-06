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
                        <th> {{ trans('labels.dome_owner') }} </th>
                        <th> {{ trans('labels.email') }} </th>
                        <th> {{ trans('labels.subject') }} </th>
                        <th> {{ trans('labels.message') }} </th>
                        <th> {{ trans('labels.action') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($getsupportslist as $support)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $support['dome_owner']->name }}</td>
                            <td>{{ $support['dome_owner']->email }}</td>
                            <td>{{ $support->subject }}</td>
                            <td>{{ $support->message }}</td>
                            <td>
                                <span class="badge rounded-pill cursor-pointer partial-pill me-4 reply_support"
                                    data-subject="{{ $support->subject }}"
                                    data-user-name="{{ $support['dome_owner']->name }}"
                                    data-message="{{ $support->message }}" data-bs-target="#replysupport"
                                    data-bs-toggle="modal">
                                    <i class="fa-solid fa-reply"></i>
                                    {{ trans('labels.reply') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="replysupport" tabindex="-1" aria-labelledby="replysupportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="replysupportLabel">{{ trans('labels.reply') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.user_name') }}</label>
                                <p class="show_user_name"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.subject') }}</label>
                                <p class="show_subject"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.message') }}</label>
                                <p class="show_message"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="reply" class="form-label fw-bold">{{ trans('labels.reply') }}</label>
                                <textarea class="form-control" name="reply" placeholder="{{ trans('labels.reply') }}" autocomplete="off"
                                    rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $(".reply_support").on('click', function() {
                $('.show_user_name').text($(this).attr('data-user-name'));
                $(".show_subject").text($(this).attr('data-subject'));
                $('.show_message').text($(this).attr('data-message'));
            });
        });
    </script>
@endsection
