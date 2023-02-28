@extends('admin.layout.default')
@section('title')
    {{ trans('labels.add_field') }}
@endsection
@section('styles')
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
@endsection
@section('contents')
    <!-- Title -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.add_field') }}</p>
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
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/fields')}}">{{ trans('labels.fields') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add_field') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <form class="card" action="{{ URL::to('admin/field/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" for="dome">Select Dome</label>
                            <select class="form-select" name="dome" id="dome">
                                <option disabled selected>------Select------</option>
                                @foreach ($dome as $data)
                                    <option value="{{ $data->id }}" class="text-capitalize">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('dome')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="sport_id">Select Sport</label>
                            <select class="form-select" name="sport_id" id="sport_id">
                                @foreach ($getsportslist as $data)
                                    <option value="{{ $data->id }}" class="text-capitalize">{{ $data->name }}</option>
                                @endforeach
                            </select>
                            @error('sport_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4 col-sm-4">
                    <label class="form-label" for="field_name">Field Name</label>
                    <input type="text" id="field_name" name="field_name" value="{{ old('field_name') }}"
                        class="form-control" placeholder="Please Enter Field Name">
                    @error('field_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label">Capicity</label>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select" name="min_person" id="min_person">
                                <option value="" class="text-capitalize" disabled selected>Select Minimum Person</option>
                                @for ($i = 1; $i < 100; $i++)
                                    <option value="{{ $i }}" class="text-capitalize">{{ $i }}</option>
                                @endfor
                            </select>
                            @error('min_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                                <select class="form-select" name="max_person" id="max_person">
                                    <option value="" class="text-capitalize" disabled selected>Select Maximum Person</option>
                                    @for ($i = 1; $i < 100; $i++)
                                        <option value="{{ $i }}" class="text-capitalize">{{ $i }}</option>
                                    @endfor
                                </select>
                            @error('max_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-4">
                        <label class="form-label" for="field_image">Dome Images</label>
                        <input type="file" class="form-control" id="field_image" name="field_image">
                        @error('field_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </div>
    </form>
@endsection
{{-- @section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script>
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        })
    </script>
@endsection --}}
