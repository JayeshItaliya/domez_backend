@extends('admin.layout.default')
@section('title')
    Settings
@endsection
@section('contents')
    <h1 class="h2">Settings</h1>
    <div class="row rows-col-lg-2">
        <div class="col">
            <form class="card" action="{{URL::to('admin/settings/edit-profile'.$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Edit Profile</h4>
                    <div class="form-group mb-4">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" value="{{$user->email}}">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="image">Profile Image</label>
                        <input type="file" id="image" class="form-control">
                    </div>
                    <div class="avatar avatar-xxl avatar-circle mb-6">
                        <img src="{{Helper::image_path($user->image)}}" alt="..." class="avatar-img">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="col">
            <form class="card" action="{{URL::to('admin/settings/edit-profile'.$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h4 class="card-title">Edit Profile</h4>
                    <div class="form-group mb-4">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" id="email" class="form-control" value="{{$user->email}}">
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="image">Profile Image</label>
                        <input type="file" id="image" class="form-control">
                    </div>
                    <div class="avatar avatar-xxl avatar-circle mb-6">
                        <img src="{{Helper::image_path($user->image)}}" alt="..." class="avatar-img">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
