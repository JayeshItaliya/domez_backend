@extends('admin.layout.default')
@section('title')
    {{ trans('labels.workers_list') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p>{{ trans('labels.workers_list') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        {!! Helper::breadcrumb_home_li() !!}
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.workers_list') }}</li>
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
                            <th>{{ trans('labels.login_type') }}</th>
                            <th>{{ trans('labels.status') }}</th>
                            <th>{{ trans('labels.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($workers as $worker)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items center">
                                        <img class="border-radius" src="{{ Helper::image_path($worker->image) }}"
                                            width="40" height="40">
                                        <div class="mx-2">
                                            <h6>{{ $worker->name }}</h6>
                                            <span class="text-muted fs-7">{{ $worker->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <img class="border-radius"
                                        src="{{ Helper::image_path($worker->login_type == 1 ? 'email.svg' : ($worker->login_type == 2 ? 'google.svg' : ($worker->login_type == 3 ? 'apple.svg' : ($worker->login_type == 4 ? 'facebook.svg' : '')))) }}"
                                        width="25" height="25">
                                </td>
                                <td><span
                                        class="badge rounded-pill cursor-pointer text-bg-{{ $worker->is_available == 1 ? 'success' : 'danger' }}"
                                        onclick="change_status('{{ $worker->id }}','{{ $worker->is_available == 1 ? 2 : 1 }}','{{ URL::to('admin/workers/change_status') }}')">{{ $worker->is_available == 1 ? 'Active' : 'Inactive' }}</span>
                                </td>
                                <td>
                                    <a class="cursor-pointer me-2" href="javascript:void(0);" data-bs-target="#editworker"
                                        data-bs-toggle="modal" data-show-name="{{ $enquiry->name }}"
                                        data-show-email="{{ $enquiry->email }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-warning)" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                            <line x1="16" y1="5" x2="19" y2="8" />
                                        </svg>
                                    </a>
                                    <a class="cursor-pointer me-2"
                                        onclick="deletedata('{{ $worker->id }}','{{ URL::to('admin/workers/delete') }}')"
                                        class="mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                            width="25" height="25" viewBox="0 0 24 24" stroke-width="1"
                                            stroke="var(--bs-danger)" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="4" y1="7" x2="20" y2="7" />
                                            <line x1="10" y1="11" x2="10" y2="17" />
                                            <line x1="14" y1="11" x2="14" y2="17" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Add Worker --}}
    <div class="modal fade" id="addworker" tabindex="-1" aria-labelledby="addworkerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addworkerLabel">{{ trans('labels.add_worker') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{ URL::to('admin/workers/store-worker') }}" method="POST"
                    id="store_worker">
                    @csrf
                    <div class="form-group">
                        <label class="form-label fw-bold" for="name">{{ trans('labels.name') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="{{ trans('labels.name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label fw-bold" for="email">{{ trans('labels.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="{{ trans('labels.email') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label fw-bold" for="password">{{ trans('labels.password') }}</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="{{ trans('labels.password') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-auto float-end">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit Worker --}}
    <div class="modal fade" id="editworker" tabindex="-1" aria-labelledby="editworkerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editworkerLabel">{{ trans('labels.add_worker') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body" action="{{ URL::to('admin/workers/edit-' . $worker->id) }}" method="POST"
                    id="update_worker">
                    @csrf
                    <div class="form-group">
                        <label class="form-label fw-bold" for="name">{{ trans('labels.name') }}</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="{{ trans('labels.name') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label fw-bold" for="email">{{ trans('labels.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="{{ trans('labels.email') }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-auto float-end">{{ trans('labels.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('resources/views/admin/workers/workers.js') }}"></script>
@endsection
