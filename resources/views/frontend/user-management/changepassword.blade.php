@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-3">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Change Password</h3>
                    <div class="my-3">
                        <x-flash-message></x-flash-message>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('frontend.updatepassword') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Fill your old_password..">
                            @error('old_password')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Fill your password..">
                            @error('password')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Fill your password_confirmation..">
                            @error('password_confirmation')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-dark">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
