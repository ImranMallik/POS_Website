<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PermissionDataTable;
use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    //

    public function index(PermissionDataTable $dataTable)
    {
        // $permissions = Permission::orderBy('id', 'desc')->get();

        return $dataTable->render('admin.pages.permission.all_permission');
    }

    public function addPermission()
    {
        return view('admin.pages.permission.add_permission');
    }

    public function storePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        return redirect()->route('admin.all-permission')->with('success', 'Permission added successfully.');
    }

    public function editPermission($id)
    {
        $permissions = Permission::findOrFail($id);
        return view('admin.pages.permission.edit_permission', compact('permissions'));
    }


    public function updatePermission(Request $request, $id)
    {
        // dd($request->all());
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        return redirect()->route('admin.all-permission')->with('success', 'Permission updated successfully.');
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            $permission->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Permission not found or cannot be deleted.'
        ]);
    }


    // Roles------
    public function addRole()
    {
        return view('admin.pages.roles.add');
    }

    public function storeRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.all-role')->with('success', 'Role added successfully.');
    }

    public function allRole(RoleDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.roles.index');
    }

    public function editRole($id)
    {
        $role = Role::find($id);

        return view('admin.pages.roles.edit', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.all-role')->with('success', 'Role updated successfully.');
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Role not found or cannot be deleted.'
        ]);
    }


    // Add role for permissions
    public function addPermissionToRole()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.pages.roles.permission_to_role', compact('permissions', 'roles', 'permission_groups'));
    }

    // Add role for permissions

    public function storePermissionToRole(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['permission_id'] = $item;
            $data['role_id'] = $request->role_id;

            DB::table('role_has_permissions')->insert($data);
        }

        return redirect()->route('admin.add-permission-to-role')->with('success', 'Role Permission assigned successfully.');
    }


    public function allPermissionForRole()
    {
        $roles = Role::all();
        return view('admin.pages.roles.all_roles_permission', compact('roles'));
    }

    public function editAllPermissionForRole($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('admin.pages.roles.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }


    public function updateAllPermissionForRole(Request $request, $id)
    {
        // dd($request->all());
        $role = Role::find($id);
        $permissions = $request->permission;
        if (!empty($permissions)) {
            $permissions = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('admin.all-permission-for-role')->with('success', 'Role Permission updated successfully.');
    }

    public function deletePermissionForRole($id)
    {
        $role = Role::findOrFail($id);

        if (!is_null($role)) {
            $role->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role Permission Deleted Successfully',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Role not found.',
        ]);
    }
}
