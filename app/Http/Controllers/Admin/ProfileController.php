<?php

namespace App\Http\Controllers\Admin;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct account profile
    public function accountProfile()
    {
        return view("profile.accountProfile");
    }

    //direct new admin add page
    public function newAdminPage()
    {
        return view("admin.adminAccount.create");
    }

    //admin list page
    public function adminListPage()
    {
        $admins = User::when(request('searchKey'), function ($query) {
            $query->where(function ($q) {
                $searchKey = '%' . request('searchKey') . '%';
                $q->whereAny(['name', 'email', 'phone', 'address'], 'like', $searchKey);
            });
        })
            ->select('id', 'name', 'email', 'address', 'phone', 'role', 'created_at')
            ->where('role', 'admin')
            ->paginate(5);

        return view('admin.adminAccount.list', compact('admins'));
    }

    //user list page
    public function userListPage()
    {
        $users = User::when(request('searchKey'), function ($query) {
            $query->where(function ($q) {
                $searchKey = '%' . request('searchKey') . '%';
                $q->whereAny(['name', 'email', 'phone', 'address'], 'like', $searchKey);
            });
        })
            ->select('id', 'name', 'email', 'address', 'phone', 'role', 'created_at')
            ->where('role', 'user')
            ->paginate(5);

        return view('admin.adminAccount.userList', compact('users'));
    }

    //delete admin account
    public function deleteAdmin(Request $request)
    {
        $admin = User::findOrFail($request->id);
        $admin->delete();
        Alert::success('Admin Account Delete', 'Admin Account Deleted Successfully!');
        return back();
    }

    //delete user account
    public function deleteUser(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();
        Alert::success('User Account Delete', 'User Account Deleted Successfully!');
        return back();
    }

    //create new admin account
    public function createAdminAccount(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'min:8', 'max:15', 'unique:users,phone'],
            'password' => ['required', 'min:6', 'max:15'],
            'confirmPassword' => ['required', 'same:password', 'min:6', 'max:15'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        // Success alert
        Alert::success('Add New Admin', 'New Admin Account Added Successfully!');

        return to_route("adminListPage");
    }

    //account edit page
    public function accountEdit()
    {
        $userData = Auth::user();
        return view("profile.accountEdit", compact('userData'));
    }

    public function accountUpdate(Request $request)
    {
        $userId = Auth::id();

        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $userId,
            'phone' => 'required|min:8|max:15|unique:users,phone,' . $userId,
            'address' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:5120', // max 5MB
        ]);

        if ($request->hasFile('image')) {
            $user = User::find($userId);

            // Check if there's an existing image to delete
            if ($user->profile) {
                Storage::disk('public')->delete('profile/' . $user->profile);
            }


            // Store new image with unique name
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('profile', $fileName, 'public');
            $fields['profile'] = $fileName;
        }

        unset($fields['image']);

        // Update user profile with validated data
        User::where('id', $userId)->update($fields);

        // Success alert
        Alert::success('Profile Change', 'Profile Changed Successfully!');

        return to_route('accountProfile');
    }

    //change password page
    public function changePasswordPage()
    {
        return view('profile.changePassword');
    }

    public function changePassword(Request $request)
    {
        $fields = $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:newPassword'
        ]);

        $dbHashPassword = Auth::user()->password;
        $authId = Auth::user()->id;

        if (Hash::check($request->currentPassword, $dbHashPassword)) {

            $data = ['password' => Hash::make($request->newPassword)];

            User::where('id', $authId)->update($data);

            Alert::success('Password Change', 'Password Changed Successfully!');

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        } else {
            Alert::success('Error Message', 'Old password do not match , Try again!');

            return back();
        }
    }
}
