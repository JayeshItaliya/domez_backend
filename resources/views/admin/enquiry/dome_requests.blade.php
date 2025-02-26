@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_requests') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_requests') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item">{{ trans('labels.dome_requests') }}</li>
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
                            <th>{{ trans('labels.name') }}</th>
                            <th>{{ trans('labels.email') }}</th>
                            <th>{{ trans('labels.phone_number') }}</th>
                            <th>{{ trans('labels.dome_name') }}</th>
                            <th>{{ trans('labels.country') }}</th>
                            <th>{{ trans('labels.requested_from') }}</th>
                            <th>{{ trans('labels.status') }}</th>
                            @if (auth()->user()->type == 1)
                                <th>{{ trans('labels.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($enquiries as $enquiry)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $enquiry->name }}</td>
                                <td>{{ $enquiry->email }} <span
                                        class="badge rounded-pill cursor-pointer text-bg-{{ $enquiry->is_exist == 1 ? 'info' : 'warning' }}">{{ $enquiry->is_exist == 1 ? trans('labels.exist') : trans('labels.new') }}</span>
                                </td>
                                <td>{{ $enquiry->phone != '' ? '+1' . $enquiry->phone : '' }}</td>
                                <td>{{ $enquiry->dome_name }}</td>
                                <td>{{ $enquiry->dome_country }}</td>
                                <td>{{ $enquiry->type == 3 ? trans('labels.dome_owner_panel') : trans('labels.mobile_application') }}
                                </td>
                                <td>
                                    @if ($enquiry->is_accepted == 1)
                                        <span
                                            class="badge rounded-pill cursor-pointer text-bg-success">{{ trans('labels.verified') }}</span>
                                    @elseif ($enquiry->is_accepted == 2)
                                        <span
                                            class="badge rounded-pill cursor-pointer text-bg-warning">{{ trans('labels.pending') }}</span>
                                    @else
                                        <span
                                            class="badge rounded-pill cursor-pointer text-bg-danger">{{ trans('labels.declined') }}</span>
                                    @endif
                                </td>
                                @if (auth()->user()->type == 1)
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($enquiry->is_replied == 2)
                                                <span class="badge rounded-pill cursor-pointer reply-pill me-2 reply_action"
                                                    data-show-name="{{ $enquiry->name }}"
                                                    data-show-email="{{ $enquiry->email }}"
                                                    data-show-phone="{{ $enquiry->phone != '' ? '+1' . $enquiry->phone : '' }}"
                                                    data-show-dome-name="{{ $enquiry->dome_name }}"
                                                    data-show-dome-zipcode="{{ $enquiry->dome_zipcode }}"
                                                    data-show-dome-city="{{ $enquiry->dome_city }}"
                                                    data-show-dome-state="{{ $enquiry->dome_state }}"
                                                    data-show-dome-country="{{ $enquiry->dome_country }}"
                                                    data-id="{{ $enquiry->id }}" data-bs-target="#reply_modal"
                                                    data-bs-toggle="modal" style="height: fit-content">
                                                    <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M3.25833 3.70833L1.125 6.04167L3.25833 8.375M1.125 6.04167H6.99167C7.55746 6.04167 8.10008 5.79583 8.50016 5.35825C8.90024 4.92066 9.125 4.32717 9.125 3.70833C9.125 3.08949 8.90024 2.496 8.50016 2.05842C8.10008 1.62083 7.55746 1.375 6.99167 1.375H6.45833"
                                                            stroke="#2196F3" stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg> {{ trans('labels.reply') }}
                                                </span>
                                            @endif
                                            @if ($enquiry->is_accepted == 2)
                                                <i class="fa-regular fa-circle-check me-2 text-success fs-4 cursor-pointer"
                                                    onclick="deletedata('{{ $enquiry->id }}','{{ URL::to('admin/enquiries/dome-request-status') }}')"></i>
                                                <i class="fa-regular fa-circle-xmark text-danger fs-4 cursor-pointer"
                                                    onclick="deletedata('{{ $enquiry->id }}','{{ URL::to('admin/enquiries/dome-request-delete') }}')"></i>
                                            @endif
                                        </div>
                                    </td>
                                @endif
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
                <form action="{{ URL::to('admin/enquiries/dome-request-reply') }}" method="POST" class="modal-body"
                    id="reply_dome_request_form">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label fw-bold">{{ trans('labels.name') }}</label>
                            <p class="show_name"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="email" class="form-label fw-bold">{{ trans('labels.email') }}</label>
                            <p class="show_email"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="phone_number" class="form-label fw-bold">{{ trans('labels.phone_number') }}</label>
                            <p class="show_phone"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="dome_name" class="form-label fw-bold">{{ trans('labels.dome_name') }}</label>
                            <p class="show_dome_name"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="pincode" class="form-label fw-bold">{{ trans('labels.pincode') }}</label>
                            <p class="show_dome_zipcode"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="city" class="form-label fw-bold">{{ trans('labels.city') }}</label>
                            <p class="show_dome_city"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="state" class="form-label fw-bold">{{ trans('labels.state') }}</label>
                            <p class="show_dome_state"></p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="country" class="form-label fw-bold">{{ trans('labels.country') }}</label>
                            <p class="show_dome_country"></p>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="reply" class="form-label fw-bold">{{ trans('labels.reply') }}</label>
                            <textarea class="form-control" id="ckeditor" name="reply" placeholder="{{ trans('labels.reply') }}"
                                autocomplete="off" rows="4" required></textarea>
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
        $('#reply_dome_request_form').on('submit', function() {
            if ($('#reply_dome_request_form textarea').val() == "") {
                $('#reply_dome_request_form textarea').addClass('is-invalid');
                return false;
            } else {
                showpreloader();
                $('#reply_dome_request_form textarea').removeClass('is-invalid');
            }
        });
        $(function() {
            $(".reply_action").on('click', function() {
                $('input[name=id]').val($(this).attr('data-id'));
                $('.show_name').text($(this).attr('data-show-name'));
                $('.show_email').text($(this).attr('data-show-email'));
                $('.show_phone').text($(this).attr('data-show-phone'));
                $('.show_dome_name').text($(this).attr('data-show-dome-name'));
                $('.show_dome_zipcode').text($(this).attr('data-show-dome-zipcode'));
                $('.show_dome_city').text($(this).attr('data-show-dome-city'));
                $('.show_dome_state').text($(this).attr('data-show-dome-state'));
                $('.show_dome_country').text($(this).attr('data-show-dome-country'));
            });
        });
    </script>
@endsection
