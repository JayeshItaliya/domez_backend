@extends('admin.layout.default')
@section('title') Stripe @endsection
@section('contents')

    <h1 class="h2">Stripe Configuration</h1>
    <div class="row">
        <div class="col-md-8">
            <form action="{{URL::to('admin/payment-gateway/store-stripe')}}" method="POST" class="card">
                @csrf
                <div class="card-body">
                    <div class="mb-4">
                        <label for="public_key" class="form-label">Public Key</label>
                        <input type="text" class="form-control" name="public_key" id="public_key" placeholder="Enter Stripe Public Key" value="{{!empty($stripe->public_key) ? $stripe->public_key : old('public_key')}}">
                        @error('public_key') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="secret_key" class="form-label">Secret Key</label>
                        <input type="text" class="form-control" name="secret_key" id="secret_key" placeholder="Enter Stripe Secret Key" value="{{!empty($stripe->secret_key) ? $stripe->secret_key : old('secret_key')}}">
                        @error('secret_key') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
