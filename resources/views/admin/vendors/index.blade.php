@extends('admin.layout.default')
@section('title')
    {{ trans('labels.dome_owners') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.dome_owners') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.dome_owners') }}</li>
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
                        <th>{{ trans('labels.profile') }}</th>
                        <th>{{ trans('labels.phone_number') }}</th>
                        <th>{{ trans('labels.login_type') }}</th>
                        <th>{{ trans('labels.status') }}</th>
                        <th>{{ trans('labels.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <div class="d-flex align-items center">
                                    <img class="border-radius" src="{{ Helper::image_path($vendor->image) }}"
                                        width="40" height="40">
                                    <div class="mx-2">
                                        <h6>{{ $vendor->name }}</h6>
                                        <span class="text-muted fs-7">{{ $vendor->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $vendor->phone }}</td>
                            <td>
                                <img class="border-radius"
                                    src="{{ Helper::image_path($vendor->login_type == 1 ? 'email.svg' : ($vendor->login_type == 2 ? 'google.svg' : ($vendor->login_type == 3 ? 'apple.svg' : ($vendor->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                    width="25" height="25">
                            </td>
                            <td><span
                                    class="badge rounded-pill cursor-pointer text-bg-{{ $vendor->is_available == 1 ? 'success' : 'danger' }}"
                                    onclick="change_status('{{ $vendor->id }}','{{ $vendor->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/vendors/change_status') }}')">{{ $vendor->is_available == 1 ? trans('labels.active') : trans('labels.inactive') }}</span>
                            </td>
                            <td>
                                <a class="cursor-pointer me-2"
                                    href="{{ URL::to('admin/vendors/dome-owner-details-' . $vendor->id) }}">
                                    {!! Helper::get_svg(1) !!} </a>
                                <a class="cursor-pointer me-2" href="{{ URL::to('admin/vendors/edit-' . $vendor->id) }}">
                                    {!! Helper::get_svg(2) !!} </a>
                                <a class="cursor-pointer me-2"
                                    onclick="vendor_delete('{{ $vendor->id }}','{{ $vendor->is_deleted == 2 ? 1 : 2 }}','{{ URL::to('admin/vendors/delete') }}')"
                                    class="mx-2"> {!! Helper::get_svg(3) !!} </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('resources/views/admin/vendors/vendors.js') }}"></script>
@endsection
