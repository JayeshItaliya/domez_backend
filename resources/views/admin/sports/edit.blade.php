@extends('admin.layout.default')
@section('title') Edit Sports @endsection
@section('contents')
    <h1 class="h2">Edit Sports</h1>

    <div class="row">
        <div class="col-md-8">
            <form class="card" action="{{URL::to('admin/sports/update-').$sportsdata->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label" for="name">Sports Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$sportsdata->name}}" placeholder="Please Enter Sports Name">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>    
                    <div class="mb-4">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                        @error('image') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <img src="{{Helper::image_path($sportsdata->image)}}" alt="category image" class="avatar avatar-lg mb-4"><br>
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
