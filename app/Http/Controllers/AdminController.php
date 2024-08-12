<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use ImageUploadTraits;
    //

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        toastr('Logged out successfully', 'warning');
        return redirect()->route('admin.logout-page');
    }
    // After logout Return this page
    public function logoutPage()
    {
        return view('admin.admin_logout');
    }
    // Admin Profile

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $admindata = User::findOrFail($id);
        return view('admin.admin-profile', compact('admindata'));
    }

    public function storeAdminProfile(Request $request)
    {
        // dd($request->all());
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $imagePath = $this->updateImage($request, 'photo', 'upload', $data->photo);
        $data->photo = empty(!$imagePath) ? $imagePath : $data->photo;;
        $data->save();
        toastr('Admin Profile Updated Successfully!', 'success');
        return redirect()->back();
    }

    public function passwordChange()
    {
        return view('admin.password_change');
    }

    public function passwordUpdate(Request $request)
    {
        // Debug the incoming request
        // dd($request->all());

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Check if the old password matches
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            toastr('Password mismatch', 'error');
            return redirect()->back();
        }

        // Update the password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        toastr('Password updated', 'success');
        return redirect()->back();
    }
}
