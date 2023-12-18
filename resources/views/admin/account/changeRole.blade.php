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
                            <div class="ms-3">
                                <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row m-5">
                                            <div class="col-6 offset-3 ">
                                                @if ($account->image == null)
                                                    @if ($account->gender == 'male')
                                                        <img src="{{ asset('image/default_image.jpg') }}"
                                                            class=" img-thumbnail ">
                                                    @else
                                                        <img src="{{ asset('image/female_defaule_image.jpg') }}"
                                                            class="img-thumbnail ">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $account->image) }}"
                                                        alt={{ $account->name }} />
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-8 text-center offset-2 bg-dark">
                                                <button type="submit" class=" btn text-white text-center">
                                                    <i class="fa-solid fa-circle-arrow-up mr-2"></i>Change</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name"
                                                value="{{ old('name', $account->name) }}" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter New Name">
                                            @error('name')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email"
                                                value="{{ old('email', $account->email) }}" type="text"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter New Email">
                                            @error('email')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled name="phone"
                                                value="{{ old('phone', $account->phone) }}" type="number"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="09xxxxxxx">
                                            @error('phone')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select disabled name="gender"
                                                class=" form-control @error('gender') is-invalid @enderror" id="">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if ($account == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Address</label>
                                            <textarea disabled name="address" id="" cols="30" rows="10"
                                                class=" form-control @error('address') is-invalid @enderror" placeholder="Enter your new address">{{ old('address', $account->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback"> {{ $message }} </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
