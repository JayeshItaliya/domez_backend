@extends('admin.layout.default')
@section('title')
    Edit Field
@endsection
@section('styles')
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
@endsection
@section('contents')
    <h1 class="h2">Edit Field</h1>
    <form class="card" action="{{ URL::to('admin/field/update-' . $field->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="mb-4 col-sm-8">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label" for="dome">Select Dome</label>
                            <select class="form-select" name="dome" id="dome">
                                <option disabled selected>{{ trans('labels.select') }}</option>
                                @foreach ($dome as $data)
                                    <option value="{{ $data->id }}" class="text-capitalize"
                                        {{ $field->dome_id == $data->id ? 'selected' : '' }}>{{ $data->name }}</option>
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
                                    <option value="{{ $data->id }}" class="text-capitalize"
                                        {{ $field->sport_id == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                    </option>
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
                    <input type="number" id="field_name" name="field_name" value="{{ $field->name }}" class="form-control"
                        placeholder="Please Enter Field Name">
                    @error('field_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 col-sm-6">
                    <label class="form-label">Capicity</label>
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select" name="min_person" id="min_person">
                                <option value="" class="text-capitalize" disabled>Select Minimum Person</option>
                                @for ($i = 1; $i < 100; $i++)
                                    <option value="{{ $i }}" class="text-capitalize"
                                        {{ $field->min_person == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('min_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <select class="form-select" name="max_person" id="max_person">
                                <option value="" class="text-capitalize" disabled>Select Maximum Person</option>
                                @for ($i = 1; $i < 100; $i++)
                                    <option value="{{ $i }}" class="text-capitalize"
                                        {{ $field->max_person == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                        <div class="avatar avatar-lg mt-4">
                            <img src="{{ Helper::image_path($field->image) }}" alt="..." class="avatar-img">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2 float-end">{{ trans('labels.submit') }}</button>
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
