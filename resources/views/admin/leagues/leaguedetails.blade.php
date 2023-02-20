@extends('admin.layout.default')
@section('title')
    League Details
@endsection
@section('contents')
<div class="card mb-3">
    <div class="card-body py-2">
        <div class="d-flex align-items-center justify-content-between">
            <p class="text-secondary fw-semibold">League Details ID - 1234656782</p>
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
                    <li class="breadcrumb-item ">Leagues</li>
                    <li class="breadcrumb-item active" aria-current="page">Edit League</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <p class="mb-2 fw-semibold">Indian Premier League</p>
            <div class="d-flex">
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Dome Name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Dome A</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Field') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Field 1, Field 3</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Sport Name') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Vollyball</span>
                        </div>
                    </div>
                </div>
            </div>
            <p class="my-3 fw-semibold">League Details</p>
            <div class="d-flex">
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Team Limit') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">20</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Price (Per team)') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">$ 210</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Start Date') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">20/01/2023</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('End Date') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">30/03/2023</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Start Time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">09:00 AM</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('End Time') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">06:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Min Players') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">10</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Max Players') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">15</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Age') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Above 18 Years</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray col-lg-4">
                    <div class="px-3 py-2 d-flex">
                        <div class="col-md-4">
                            <label>{{ trans('Gender') }}</label>
                        </div>
                        <div class="col-md-8">
                            <span class="text-muted fs-7">Men</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-league-img mt-4">
                <img src="http://localhost/domez/storage/app/public/admin/images/League/league_details.png">
            </div>
        </div>
    </div>
@endsection
