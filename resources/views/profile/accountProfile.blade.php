@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="container vh-75 d-flex justify-content-center align-items-center" style="margin-top: 4rem">
            <div class="card shadow p-5" style="width: 100%; max-width: 800px;">
                <h3 class="text-center mb-4 text-primary">Account Edition</h3>
                <form id="accountInfoForm">
                    <!-- Profile Image -->
                    <div class="d-flex">
                        <div class="col mr-5">
                            <div class="mb-3 text-center">
                                <div class="d-flex justify-content-center mb-3">
                                    <img id="profileImagePreview"
                                        src="{{ asset(Auth::user()->profile == null ? 'admin/img/undraw_profile.svg' : 'storage/profile/' . Auth::user()->profile) }}"
                                        alt="Profile Image" class="rounded-circle" style="width: 150px; height: 150px;">
                                </div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="col">
                            <div class="mb-2">
                                <h5>Name : {{ Auth::user()->name == null ? Auth::user()->nickname : Auth::user()->name }}
                                </h5>
                            </div>

                            <!-- Email -->
                            <div class="mb-2">
                                <h5>Email : {{ Auth::user()->email }}</h5>
                            </div>

                            <!-- Phone -->
                            <div class="mb-2">
                                <h5>Phone : {{ Auth::user()->phone }}</h5>
                            </div>

                            <!-- Address -->
                            <div class="mb-2">
                                <h5>Name : {{ Auth::user()->address }}</h5>
                            </div>

                            <!-- Role -->
                            <div class="mb-2">
                                <h5>Role : <span class="text-danger">{{ Auth::user()->role }}</span></h5>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-3">
                                <a class="btn btn-primary w-100 rounded shadow-sm" href="{{ route('accountEdit') }}"><i
                                        class="fa-solid fa-pen-to-square mr-2"></i></i>Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
