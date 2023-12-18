@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-8 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Your Profile</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#update', Auth::user()->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row m-5">
                                            <div class="col-6 offset-3 ">
                                                @if (Auth::user()->image == null)
                                                    @if (Auth::user()->gender == 'male')
                                                        <img src="{{ asset('image/default_image.jpg') }}"
                                                            class=" img-thumbnail shadow-sm">
                                                    @else
                                                        <img src="{{ asset('image/female_defaule_image.jpg') }}"
                                                            class="img-thumbnail shadow-sm">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        alt={{ Auth::user()->name }} class="img-thumbnail shadow-sm" />
                                                @endif
                                            </div>
                                        </div>

                                        <div class=" form-control mb-3">
                                            <input type="file" name="image"
                                                class=" @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-8 text-center offset-2 bg-dark">
                                                <button type="submit" class=" btn text-white text-center">
                                                    <i class="fa-solid fa-circle-arrow-up mr-2"></i>Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter New Name">
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" type="text"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter New Email">
                                            @error('email')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" type="number"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="09xxxxxxx">
                                            @error('phone')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender"
                                                class=" form-control @error('gender') is-invalid @enderror" id="">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if (Auth::user() == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user() == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="30" rows="10"
                                                class=" form-control @error('address') is-invalid @enderror" placeholder="Enter your new address">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role"
                                                value="{{ old('role', Auth::user()->role) }}" type="text"
                                                class="form-control" disabled>
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
