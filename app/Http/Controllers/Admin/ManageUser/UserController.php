<?php

namespace App\Http\Controllers\Admin\ManageUser;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Admin\HrAdminSetup\Department;
use App\Models\Admin\SystemConfiguration\Branch;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // examples:
    //     $this->middleware('permission:Add User',['only'=>['store']]);
    //     $this->middleware('permission:Update User',['only'=>['update']]);
    // }

    public function index()
    {
        $users = User::where('is_superadmin', 0)->get();
        $roles = Role::pluck('name','name')->all();

        return view('admin.manageuser.user',compact('users','roles'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',  // Validate username (snake case)
            // 'phone' => 'required|string|max:255',
            // 'email' => 'required|email',
            // 'status' => 'required',
            'password' => 'required',
        ]);

        // Create the user
        $user =  User::create([
            'name' => $request->name,
            'username' => $request->username,  // Correctly map 'username' to the database field
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'status' => $request->status,
            'password' => Hash::make($request->password),  // Hash the password
        ]);
        $user->syncRoles($request->roles);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User added successfully.');
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            // 'phone' => 'required|string|max:255',
            // 'status' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        // $user->phone = $request->phone;
        // $user->email = $request->email;
        // $user->status = $request->status;
        if($request->password)
        {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->syncRoles($request->roles);

        session()->flash('success', 'User updated successfully!');

        return response()->json(['success' => 'User updated successfully!'], 200);
    }


    public function destroy(string $id)
    {
        // User::destroy($id);
        // return redirect()->back()->with('success', 'user deleted successfully.');
    }


    public function status($id)
    {

        $user = User::findOrFail($id);
        $user->status = $user->status === 1 ? 0 : 1 ;
        $user->save();

        return redirect()->back()->with('success','User Status updated successfully!');
    }
}
