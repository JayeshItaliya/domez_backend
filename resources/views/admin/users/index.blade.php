@extends('admin.layout.default')
@section('title')
    {{ trans('labels.users_list') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>{{ trans('labels.users_list') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.users_list') }}</li>
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
                            <th>{{ trans('labels.profile') }}</th>
                            <th>{{ trans('labels.phone_number') }}</th>
                            <th>{{ trans('labels.login_type') }}</th>
                            <th>{{ trans('labels.status') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items center">
                                        <img class="border-radius" src="{{ Helper::image_path($user->image) }}"
                                            width="40" height="40">
                                        <div class="mx-2">
                                            <h6>{{ $user->name }}</h6>
                                            <span class="text-muted fs-7">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->phone != '' ? '+1' . $user->phone : '' }}</td>
                                <td>
                                    <img class="border-radius"
                                        src="{{ Helper::image_path($user->login_type == 1 ? 'email.svg' : ($user->login_type == 2 ? 'google.svg' : ($user->login_type == 3 ? 'apple.svg' : ($user->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                        width="25" height="25">
                                </td>
                                <td><span
                                        class="badge rounded-pill cursor-pointer text-bg-{{ $user->is_available == 1 ? 'success' : 'danger' }}"
                                        onclick="change_status('{{ $user->id }}','{{ $user->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/users/change_status') }}')">{{ $user->is_available == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a class="cursor-pointer me-2"
                                        href="{{ URL::to('admin/users/details-' . $user->id) }}">
                                        {!! Helper::get_svg(1) !!}
                                    </a>
                                    <a class="cursor-pointer me-2" href="{{ URL::to('admin/users/edit-' . $user->id) }} ">
                                        {!! Helper::get_svg(2) !!}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
