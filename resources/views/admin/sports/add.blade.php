@extends('admin.layout.default')
@section('title') Add Sports @endsection
@section('contents')
    <h1 class="h2">Add Sports</h1>

    <div class="row">
        <div class="col-md-8">
            <form class="card" action="{{URL::to('admin/sports/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label" for="name">Sports Name</label>
                        <input type="text" id="cat_name" name="name" class="form-control" value="{{old('name')}}" placeholder="Please Enter Sports Name">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>    
                    <div class="mb-4">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
