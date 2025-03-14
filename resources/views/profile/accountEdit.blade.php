@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="container vh-75 d-flex justify-content-center align-items-center" style="margin-top: 2rem">
            <div class="card shadow p-5" style="width: 100%; max-width: 600px;">
                <h3 class="text-center mb-4 text-primary">Account Edition (<small class="text-danger">{{ Auth::user()->role }}
                        Role</small>)</h3>
                <form action="{{ route('accountUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Profile Image -->
                    <div class="d-flex">
                        <div class="col mr-5">
                            <div class="mt-5 text-center">
                                <div class="d-flex justify-content-center mb-3">
                                    <!-- Add an id to the img tag for preview -->
                                    @if ($userData->profile == null)
                                        <img id="previewImage" src="{{ asset('admin/img/undraw_profile.svg') }}"
                                            class="rounded" style="width: 150px; height: 150px;">
                                    @else
                                        <img id="previewImage" src="{{ asset('storage/profile/' . $userData->profile) }}"
                                            class="rounded" style="width: 150px; height: 150px;">
                                    @endif
                                </div>
                                <input type="file" id="output" name="image"
                                    class="form-control @error('image') is-invalid @enderror" onchange="loadFile(event)">
                                @error('image')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <!-- Name -->
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text"
                                    class="form-control  @error('name')
                                    is-invalid
                                @enderror"
                                    name="name"
                                    value="{{ old('name', $userData->name != null ? $userData->name : $userData->nickname) }}"
                                    placeholder="Enter your name">
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"
                                    class="form-control  @error('email')
                                    is-invalid
                                @enderror"
                                    value="{{ old('email', $userData->email) }}" name="email"
                                    placeholder="Enter your email">
                                @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel"
                                    class="form-control  @error('phone')
                                    is-invalid
                                @enderror"
                                    name="phone" value="{{ old('phone', $userData->phone) }}"
                                    placeholder="Enter your phone number">
                                @error('phone')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-2">
                                <label for="address" class="form-label">Address</label>
                                <textarea
                                    class="form-control  @error('address')
                                    is-invalid
                                @enderror"
                                    name="address" rows="3" placeholder="Enter your address">{{ old('address', $userData->address) }}</textarea>
                                @error('address')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-3">
                                <input type="submit" class="btn btn-primary w-100" value="Save Profile"></input>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
