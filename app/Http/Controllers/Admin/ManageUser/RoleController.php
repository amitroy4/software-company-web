<?php

namespace App\Http\Controllers\Admin\ManageUser;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // public function __construct()
    // {
    //     // examples:
    //     $this->middleware('permission:Add User',['only'=>['store']]);
    //     $this->middleware('permission:Update User',['only'=>['update']]);
    //     $this->middleware('permission:Delete User',['only'=>['update']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::all();
        $roles = Role::whereNot('name','Super Admin')->get();
        return view('admin.manageuser.role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->all();
        Role::create($data);
        return redirect()->back()->with('success', 'Role added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        session()->flash('success', 'Role updated successfully!');

        return response()->json(['success' => 'Role updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect()->back()->with('success', 'Role deleted successfully.');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::all();
        $categories = $permissions->map(function ($permission) {
            // Extract the category from the permission name (after the first space)
            return Str::after($permission->name, ' ');
        })->unique()->values();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id' , $role->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        return view('admin.manageuser.addpermission',compact('role','permissions','rolePermissions','categories'));
    }
    public function givePermissionToRole(Request $request, $roleId)
    {
        // dd( $roleId);
        $request->validate([
            'permission' => 'required',
        ]);
// dd($request->permission);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'Premission added to Role successfully.');
    }
}
