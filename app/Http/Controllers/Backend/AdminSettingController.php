<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageUploadTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDO;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSettingController extends Controller
{
    use ImageUploadTraits;
    public function index(AdminDataTable $dataTable)
    {
        // return view('admin.admin_setting.index');
        return $dataTable->render('admin.admin_setting.index');
    }

    public function addAdmin()
    {
        $roles = Role::all();
        return view('admin.admin_setting.add_admin', compact('roles'));
        // return view('admin.admin_setting.add_admin');
    }

    public function storeAdmin(Request $request)
    {
        // dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $imagePath = $this->uploadImage($request, 'photo', 'upload');
        $user->photo = $imagePath;
        $user->save();

        // if ($request->roles) {
        //     $user->assignRole($request->roles);
        // }
        // Change Code ///////
        if ($request->roles) {
            $roles = is_array($request->roles) ? $request->roles : [$request->roles];

            $roleNames = Role::whereIn('id', $roles)->pluck('name')->toArray();

            $user->assignRole($roleNames);
        }

        return redirect()->route('admin.admin-setting.index')->with('success', 'Admin Created Successfully!');
    }

    public function editAdmin($id)
    {
        $admin = User::find($id);
        $roles = Role::all();
        return view('admin.admin_setting.edit_admin', compact('admin', 'roles'));
    }


    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'roles' => 'required|exists:roles,id',

        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $roleName = Role::find($request->roles)->name;
        $user->syncRoles([$roleName]);

        $notification = [
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.admin-setting.index')->with($notification);
    }


    public function deleteAdmin($id)
    {
        $user = User::find($id);
        $user->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
