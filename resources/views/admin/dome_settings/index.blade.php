@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_settings') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_settings') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 align-items-center">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.dome_settings') }}</li>
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
                        <th>{{ trans('labels.srno') }}</th>
                        @if (auth()->user()->type == 1)
                            <th>{{ trans('labels.dome_owners') }}</th>
                        @endif
                        <th>{{ trans('labels.dome_name') }}</th>
                        <th>{{ trans('labels.sports') }}</th>
                        <th>{{ trans('labels.country') }}</th>
                        <th>{{ trans('labels.start_time') }}</th>
                        <th>{{ trans('labels.end_time') }}</th>
                        <th class="text-center">{{ trans('labels.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    <td>{{ $i }}</td>
                </tbody>
            </table>
        </div>
    </div>
    <!-- New Dome Request Modal -->
    <div class="modal fade" id="new_dome_request" tabindex="-1" aria-labelledby="new_dome_requestLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ URL::to('admin/domes/new-request') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="new_dome_requestLabel">{{ trans('labels.new_dome_request') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dome_name" class="form-label">{{ trans('labels.dome_name') }}</label>
                        <input type="text" class="form-control" name="dome_name" id="dome_name"
                            placeholder="{{ trans('labels.dome_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dome_address" class="form-label">{{ trans('labels.dome_address') }}</label>
                        <input type="text" class="form-control" name="dome_address" id="dome_address"
                            placeholder="{{ trans('labels.dome_address') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dome_city" class="form-label">{{ trans('labels.dome_city') }}</label>
                        <input type="text" class="form-control" name="dome_city" id="dome_city"
                            placeholder="{{ trans('labels.dome_city') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dome_zipcode" class="form-label">{{ trans('labels.pincode') }}</label>
                        <input type="text" class="form-control" name="dome_zipcode" id="dome_zipcode"
                            placeholder="{{ trans('labels.pincode') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dome_state" class="form-label">{{ trans('labels.dome_state') }}</label>
                        <input type="text" class="form-control" name="dome_state" id="dome_state"
                            placeholder="{{ trans('labels.dome_state') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dome_country" class="form-label">{{ trans('labels.dome_country') }}</label>
                        <input type="text" class="form-control" name="dome_country" id="dome_country"
                            placeholder="{{ trans('labels.dome_country') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger"
                        data-bs-dismiss="modal">{{ trans('labels.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            if (is_vendor) {
                $('.fixed-table-toolbar .btn-group').append('<a href="' + window.location.href.replace(window
                    .location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>');
            }
        });
    </script>
@endsection
