@extends('admin.layout.default')
@section('title')
    {{ trans('labels.reviews') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.reviews') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.reviews') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="bootstrapTable" class="table-responsive">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.srno') }}</th>
                            <th>{{ trans('labels.dome_name') }}</th>
                            <th>{{ trans('labels.user_name') }}</th>
                            <th>{{ trans('labels.rattings') }}</th>
                            <th>{{ trans('labels.comments') }}</th>
                            <th>{{ trans('labels.reply') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($reviewslist as $review)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $review->dome_name->name }}</td>
                                <td>{{ $review->user_name->name }}</td>
                                <td>
                                    <span class="stars-{{ $i }}">
                                        @for ($j = 1; $j <= 5; $j++)
                                            <i
                                                class="fa-{{ $j <= $review->ratting ? 'solid' : 'regular' }} fa-star {{ $j <= $review->ratting ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </span>
                                </td>
                                <td>{{ $review->comment }}</td>
                                <td>{{ $review->reply_message ?? '-' }}</td>
                                <td>
                                    @if ($review->reply_message == null)
                                        <span class="badge rounded-pill cursor-pointer reply-pill review_action"
                                            data-id="{{ $i }}" data-user-name="{{ $review->user_name->name }}"
                                            data-comment="{{ $review->comment }}" data-bs-toggle="modal"
                                            data-bs-target="#replymessage">
                                            <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3.25833 3.70833L1.125 6.04167L3.25833 8.375M1.125 6.04167H6.99167C7.55746 6.04167 8.10008 5.79583 8.50016 5.35825C8.90024 4.92066 9.125 4.32717 9.125 3.70833C9.125 3.08949 8.90024 2.496 8.50016 2.05842C8.10008 1.62083 7.55746 1.375 6.99167 1.375H6.45833"
                                                    stroke="#2196F3" stroke-width="1.25" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            {{ trans('labels.reply') }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="replymessage" tabindex="-1" aria-labelledby="replymessageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ URL::to('admin/reviews/reply') }}" method="post"
                id="review_reply_form">
                @csrf
                <input type="hidden" name="id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_name" class="form-label fw-bold">{{ trans('labels.user_name') }}</label>
                                <p class="show_user_name"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label fw-bold">{{ trans('labels.subject') }}</label>
                                <p class="show-stars"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment" class="form-label fw-bold">{{ trans('labels.comments') }}</label>
                                <p class="show_comment"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="reply" class="form-label fw-bold">{{ trans('labels.reply') }}</label>
                                <textarea class="form-control" name="reply" id="reply" placeholder="{{ trans('labels.reply') }}"
                                    autocomplete="off" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="review_reply" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#review_reply').on('click', function() {
            if ($('#review_reply_form textarea').val() == "") {
                $('#review_reply_form textarea').addClass('is-invalid');
                return false;
            } else {
                showpreloader();
                $('#review_reply_form textarea').removeClass('is-invalid');
            }
        });
        $(function() {
            $(".review_action").on('click', function() {
                $('input[name=id]').val($(this).attr('data-id'));
                $('.show_user_name').text($(this).attr('data-user-name'));
                $(".show-stars").html('').html($(".stars-" + $(this).attr('data-id')).html());
                $('.show_comment').text($(this).attr('data-comment'));
            });
        });
    </script>
@endsection
