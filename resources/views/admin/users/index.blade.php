@extends('admin.layout.default')
@section('title')
    {{ trans('labels.users') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>User List</p>
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
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.users') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-hover overflow-hidden" data-page-length='10'>
                    <thead>
                        <tr>
                            <th>{{ trans('labels.srno') }}</th>
                            <th>{{ trans('labels.profile') }}</th>
                            <th>{{ trans('labels.phone_number') }}</th>
                            <th>{{ trans('labels.login_type') }}</th>
                            <th>{{ trans('labels.status') }}</th>
                            <th>Action</th>
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
                                <td>{{ $user->phone }}</td>
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
                                    <i class="fa-solid fa-ellipsis-vertical ms-3"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ URL::to('admin/users/details-'.$user->id)}}">View Details</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="{{ URL::to('admin/users/edit-'.$user->id)}}">Edit</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Make Inactive</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                      </ul>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
