<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Role_PermissionController extends Controller
{

    public function __contruct()
    {
        $this->middleware('role_or_permission:super-admin|view role', ['only' => ['rolelist']]);
        $this->middleware('role_or_permission:super-admin|add role', ['only' => ['rolelist', 'roleStore', 'roleUpdate']]);
        $this->middleware('role_or_permission:super-admin|add role', ['only' => ['rolelist', 'roleUpdate', 'roleStore']]);

    }

    //Permission method start-----------------------------------------
    public function permissionList()
    {

        $permissions = Permission::get();
        return view('backend.role_permission.permissionList', compact('permissions'));
    }

    public function permissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
        ]);
        return back();
    }
    //Permission method start-------------------------------------------

    // Role method start-------------------------------------------------

    public function rolelist()
    {
        $roles = Role::whereNotIn('name', ['super admin'])->get();
        return view('backend.role_permission.roleList', compact('roles'));
    }

    public function roleCreate()
    {
        $permissions = Permission::get();

        return view('backend.role_permission.roleCreate', compact('permissions'));

    }

    public function roleStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->givePermissionTo($request->permission);

        return back();

    }

    public function roleEdit(Request $request, $id)
    {
        $permissions = Permission::get();
        $role = Role::find($id);
        return view('backend.Role_Permission.roleEdit', compact('permissions', 'role'));

    }

    public function roleUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required',
        ]);

        $role->update([
            'name' => $request->name,

        ]);
        $role->syncPermissions($request->permission);
        return back();

    }

    public function roleDestroy(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = Permission::find($id);

        $role->revokePermissionTo($permissions);
        $role->delete();
        return back();

    }
    //Role Method end-------------------------------------------------------------

    // User all function start----------------------------------------------------

    public function userList()
    {

        $users = User::get();

        return view('backend.role_permission.userList', compact('users'));
    }
    
    public function userCreate()
    {
        $roles = Role::get();

        return view('backend.role_permission.userCreate', compact('roles'));

    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);
        $user->assignRole($request->role);

        return redirect()->route('backend.user.list');

    }

    public function userEdit($id)
    {
        $roles = Role::whereNotIn('name', ['super admin'])->get();

        $user = User::find($id);

        return view('backend.role_permission.userEdit', compact('user', 'roles'));
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // dd($request);
        $user = User::find($id);

        $user->syncRoles($request->role);

        return redirect()->route('backend.user.list');


    }

    public function userDestroy($id)
    {
        $user = User::find($id)->delete();
        return redirect()->route('backend.user.list');

    }
    // User all function end-----------------------------------------------------------

}
