@extends('admin.layout.default')
@section('title')
    Set Prices
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">Set Prices</p>
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
                        <li class="breadcrumb-item active" aria-current="page">Set Prices</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <form class="card" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h4>Add New Price</h4>
                </div>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Select Dome</label>
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
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Select Sport</label>
                                <select class="form-control mt-2" id="inlineFormSelectPref">
                                    <option selected>Select Sport</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                    <label for="inlineFormSelectPref" class="form-label"><i
                                            class="fa-solid fa-angle-down"></i></label>
                                </select>
                            </div>
                        </div>
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
                    </div>
                </div>
                <div class="col-md-12 my-3">
                    <p>Select Day Wise Price</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 mt-5">
                            <p>Monday</p>
                        </div>
                        <div class="col-md-11">
                            <form class="card" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="YEdTzm1HTIJ7gxbHPzLQDGavoyszN06AqMmbdly7">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="time" class="form-control mt-2" value="00:00 AM" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="time" class="form-control mt-2" value="00:00 AM" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="$" class="form-control mt-2"
                                                        placeholder="Set Price">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <a class="btn-custom-primary mt-4" id="appendbtn"><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            class="icon-tabler icon-tabler-plus" width="20"
                                                            height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="var(--bs-primary)" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="12" y1="5" x2="12"
                                                                y2="19"></line>
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12"></line>
                                                        </svg></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="time" class="form-control mt-2" value="00:00 AM" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="time" class="form-control mt-2" value="00:00 AM" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 time" id="box">
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <input type="$" class="form-control mt-2"
                                                        placeholder="Set Price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1 mt-5">
                            <p>Tuesday</p>
                        </div>
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-3 time" id="box">
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                                    </div>
                                </div>
                                <div class="col-md-3 time" id="box">
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                                    </div>
                                </div>
                                <div class="col-md-3 time" id="box">
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <a class="btn-custom-primary mt-4" id="appendbtn" onclick="add_more_field()""><svg
                                                xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus"
                                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <line x1="12" y1="5" x2="12" y2="19">
                                                </line>
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                            </svg></a>
                                    </div>
                                </div>
                            </div>
    </form>
    </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-5">
            <p>Wednesday</p>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-5">
            <p>Thursday</p>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-5">
            <p>Friday</p>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-5">
            <p>Saturday</p>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 mt-5">
            <p>Sunday</p>
        </div>
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="time" class="form-control mt-2" value="00:00 AM" />
                    </div>
                </div>
                <div class="col-md-3 time" id="box">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="$" class="form-control mt-2" placeholder="Set Price">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"
                                class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg></a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-outline-primary me-3">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </div>
    </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(function() {
            var html ='<div class="row"><div class="col-md-3 time" id="box"><div class="mb-3"><label class="form-label"></label><input type="time" class="form-control mt-2" value="00:00 AM" /></div></div><div class="col-md-3 time" id="box"><div class="mb-3"><label class="form-label"></label><input type="time" class="form-control mt-2" value="00:00 AM" /></div></div><div class="col-md-3 time" id="box"><div class="mb-3"><label class="form-label"></label><input type="$" class="form-control mt-2" placeholder="Set Price"></div></div><div class="col-md-3"><div class="mb-3"><a class="btn-custom-primary mt-4" id="appendbtn"><svg xmlns="http://www.w3.org/2000/svg"class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24"stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round"stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a></div></div></div>'
            $("#appendbtn").click(function() {
                $('#box').append(html);
            });
        });
    </script>
@endsection
