@extends('user.layouts.master')

@section('content')
    <div class="container-fluid" style="margin-top: 10rem">
        <div class="container vh-75 d-flex justify-content-center align-items-center" style="margin-top: 5rem">
            <div class="p-4 shadow card" style="width: 100%; max-width: 600px;">
                <h3 class="mb-4 text-center">Change Password</h3>
                <form action="{{ route('userChangePassword') }}" method="POST">
                    @csrf
                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" name="currentPassword"
                            class="form-control @error('currentPassword')
                            is-invalid
                        @enderror"
                            id="currentPassword" placeholder="Enter current password">
                        @error('currentPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" name="newPassword"
                            class="form-control @error('newPassword')
                            is-invalid
                        @enderror"
                            id="newPassword" placeholder="Enter new password">
                        @error('newPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" name="confirmPassword"
                            class="form-control @error('confirmPassword')
                            is-invalid
                        @enderror"
                            id="confirmPassword" placeholder="Confirm new password">
                        @error('confirmPassword')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="">
                        <input type="submit" class="text-white btn btn-primary w-50" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
