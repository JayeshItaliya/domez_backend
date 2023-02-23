@extends('admin.layout.default')
@section('styles')
@endsection
@section('title')
    {{ trans('labels.add_league') }}
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_league') }}</p>
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
<<<<<<< HEAD
                        <li class="breadcrumb-item ">{{ trans('labels.leagues') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_league') }}</li>
=======
                        <li class="breadcrumb-item ">League</li>
                        <li class="breadcrumb-item active" aria-current="page">Add League</li>
>>>>>>> e20aae5ffc8eafa76f608b065ced514a69881ad6
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <form class="card" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">{{ trans('labels.select_sports') }}</label>
                    <div class="radio-box d-flex">
                        <div class="form-check pe-3">
                            <input type="radio" name="sport" class="form-check-input" value="Vollyball" id="Vollyball"
                                checked>
                            <label class="form-check-label" for="Vollyball">Vollyball</label>
                        </div>
                        <div class="form-check pe-3">
                            <input type="radio" name="sport" class="form-check-input" value="Golf" id="Golf">
                            <label class="form-check-label" for="Golf">Golf</label>
                        </div>
                        <div class="form-check pe-3">
                            <input type="radio" name="sport" class="form-check-input" value="Tennis" id="Tennis">
                            <label class="form-check-label" for="Tennis">Tennis</label>
                        </div>
                        <div class="form-check pe-3">
                            <input type="radio" name="sport" class="form-check-input" value="Soccer" id="Soccer">
                            <label class="form-check-label" for="Soccer">Soccer</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="league_name" class="form-label">{{ trans('labels.league_name') }}</label>
                        <input type="text" class="form-control" id="league_name" name="league_name"
                            placeholder="{{ trans('labels.league_name') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dome</label>
                                <select class="form-control mt-2" id="inlineFormSelectPref">
                                    <option selected>Select Dome</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <label for="inlineFormSelectPref" class="form-label"><i
                                            class="fa-solid fa-angle-down"></i></label>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Field</label>
                                <select class="form-control mt-2" id="inlineFormSelectPref">
                                    <option selected>Select Field</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <label for="inlineFormSelectPref" class="form-label"><i
                                            class="fa-solid fa-angle-down"></i></label>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="text" class="form-control date mt-2" id="datepicker" value="00/00/0000">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="text" class="form-control date mt-2" id="datepicker" value="00/00/0000">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" class="form-control mt-2" value="00:00 AM" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">End Time</label>
                                <input type="time" class="form-control mt-2" value="00:00 AM" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Select Age</label>
                                <select class="form-control mt-2" id="inlineFormSelectPref">
                                    <option selected>Select Age</option>
                                    <option value="1">17</option>
                                    <option value="2">21</option>
                                    <option value="3">25</option>
                                    <label for="inlineFormSelectPref" class="form-label"><i
                                            class="fa-solid fa-angle-down"></i></label>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Select Gender</label>
                                <select class="form-control mt-2" id="inlineFormSelectPref">
                                    <option selected>Select Gender</option>
                                    <option value="1">Men</option>
                                    <option value="2">Female</option>
                                    <label for="inlineFormSelectPref" class="form-label"><i
                                            class="fa-solid fa-angle-down"></i></label>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Min Players</label>
                                <input placeholder="Enter Min Players" class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Max Players</label>
                                <input placeholder="Enter Max Players" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Team Limit</label>
                                <input placeholder="Enter Team Limit" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Price Per Team</label>
                                <input placeholder="Enter Price" class="form-control mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">League Banner Images</label>
                        <input type="file" class="form-control mt-2 mb-4">
                        <div class="add-league-img mt-2">
                            <img src="http://localhost/domez/storage/app/public/admin/images/League/Add_League.png">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
