@extends('admin.layouts.master')

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="card w-75 shadow-sm">
            <div class="p-5">
                <div class="text-center card-title">
                    <h1 class="h4 text-primary mb-4">Create New Admin Account!</h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('createAdminAccount') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="Enter Name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="examplePhoneNumber"
                                    placeholder="09 xxxxxxxx" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                    placeholder="Repeat Password" name="confirmPassword">
                                @error('confirmPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       <div class="d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary btn-user btn-block w-50" value="Create">
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
