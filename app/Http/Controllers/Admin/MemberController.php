<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index() {
        return view('admin.powerhouse-team.powerful-team.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'member_code' => 'nullable|string|max:100',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'dob' => 'nullable|string',
            'joining_date' => 'nullable|string',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'nullable|string|max:20|unique:members',
            'email' => 'nullable|email|max:100|unique:members',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $member = new Member();
            $member->name = $request->name;
            $member->member_code = $request->member_code;
            $member->department = $request->department;
            $member->designation = $request->designation;
            $member->dob = $request->dob;
            $member->joining_date = $request->joining_date;
            $member->gender = $request->gender;
            $member->blood_group = $request->blood_group;
            $member->phone = $request->phone;
            $member->email = $request->email;
            $member->whatsapp = $request->whatsapp;
            $member->facebook = $request->facebook;
            $member->linkedin = $request->linkedin;
            $member->github = $request->github;
            $member->address = $request->address;
            $member->about = $request->about;
            $member->status = true;
            if ($request->hasFile('image')) {
                $member->image = uploadFile($request->file('image'), 'member/image');
            }
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member created successfully!',
                'data' => $member
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'member_code' => 'nullable|string|max:100',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'dob' => 'nullable|string',
            'joining_date' => 'nullable|string',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'nullable|string|max:20|unique:members,phone,' . $id,
            'email' => 'nullable|email|max:100|unique:members,email,' . $id,
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $member = Member::findOrFail($id);
            $member->name = $request->name;
            $member->member_code = $request->member_code;
            $member->department = $request->department;
            $member->designation = $request->designation;
            $member->dob = $request->dob;
            $member->joining_date = $request->joining_date;
            $member->gender = $request->gender;
            $member->blood_group = $request->blood_group;
            $member->phone = $request->phone;
            $member->email = $request->email;
            $member->whatsapp = $request->whatsapp;
            $member->facebook = $request->facebook;
            $member->linkedin = $request->linkedin;
            $member->github = $request->github;
            $member->address = $request->address;
            $member->about = $request->about;
            if ($request->hasFile('image')) {
                deleteFile($member->image);
                $member->image = uploadFile($request->file('image'), 'member/image');
            }
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member updated successfully!',
                'data' => $member
            ]);
        } catch (\Exception $e) {

            Log::error('Error updating member', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $member = Member::findOrFail($id);
            if ($member->image) {
                deleteFile($member->image);
            }
            $member->delete();
            return response()->json([
                'success' => true,
                'message' => 'Member deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function status($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->status = !$member->status;
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member status updated successfully!',
                'status' => $member->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating member status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function get(Request $request)
    {
        $members = Member::query()
            ->where('department','!=', 'Management')
            ->when($request->search, function($query) use ($request) {
                $query->where([['name', 'like', '%'.$request->search.'%'],[ 'department','!=', 'Management' ]])
                      ->orWhere([['member_code', 'like', '%'.$request->search.'%'],['department','!=', 'Management']])
                      ->orWhere([['department', 'like', '%'.$request->search.'%'],['department','!=', 'Management']])
                      ->orWhere([['designation', 'like', '%'.$request->search.'%'],['department','!=', 'Management']])
                      ->orWhere([['whatsapp', 'like', '%'.$request->search.'%'],['department','!=', 'Management']])
                      ->orWhere([['email', 'like', '%'.$request->search.'%'],['department','!=', 'Management']])
                      ->orWhere([['phone', 'like', '%'.$request->search.'%'],['department','!=', 'Management']]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(21);

        return view('admin.powerhouse-team.powerful-team._member-card', compact('members'))->render();
    }











     public function indexManagementBody() {
        return view('admin.powerhouse-team.management-body.index');
    }

    public function storeManagementBody(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'member_code' => 'nullable|string|max:100',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'dob' => 'nullable|string',
            'joining_date' => 'nullable|string',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'nullable|string|max:20|unique:members',
            'email' => 'nullable|email|max:100|unique:members',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $member = new Member();
            $member->name = $request->name;
            $member->member_code = $request->member_code;
            $member->department = $request->department;
            $member->designation = $request->designation;
            $member->dob = $request->dob;
            $member->joining_date = $request->joining_date;
            $member->gender = $request->gender;
            $member->blood_group = $request->blood_group;
            $member->phone = $request->phone;
            $member->email = $request->email;
            $member->whatsapp = $request->whatsapp;
            $member->facebook = $request->facebook;
            $member->linkedin = $request->linkedin;
            $member->github = $request->github;
            $member->address = $request->address;
            $member->about = $request->about;
            $member->status = true;
            if ($request->hasFile('image')) {
                $member->image = uploadFile($request->file('image'), 'member/image');
            }
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member created successfully!',
                'data' => $member
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editManagementBody($id)
    {
        $member = Member::findOrFail($id);
        return response()->json($member);
    }

    public function updateManagementBody(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'member_code' => 'nullable|string|max:100',
            'department' => 'nullable|string',
            'designation' => 'nullable|string',
            'dob' => 'nullable|string',
            'joining_date' => 'nullable|string',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'phone' => 'nullable|string|max:20|unique:members,phone,' . $id,
            'email' => 'nullable|email|max:100|unique:members,email,' . $id,
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $member = Member::findOrFail($id);
            $member->name = $request->name;
            $member->member_code = $request->member_code;
            $member->department = $request->department;
            $member->designation = $request->designation;
            $member->dob = $request->dob;
            $member->joining_date = $request->joining_date;
            $member->gender = $request->gender;
            $member->blood_group = $request->blood_group;
            $member->phone = $request->phone;
            $member->email = $request->email;
            $member->whatsapp = $request->whatsapp;
            $member->facebook = $request->facebook;
            $member->linkedin = $request->linkedin;
            $member->github = $request->github;
            $member->address = $request->address;
            $member->about = $request->about;
            if ($request->hasFile('image')) {
                deleteFile($member->image);
                $member->image = uploadFile($request->file('image'), 'member/image');
            }
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member updated successfully!',
                'data' => $member
            ]);
        } catch (\Exception $e) {

            Log::error('Error updating member', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroyManagementBody($id)
    {
        try {
            $member = Member::findOrFail($id);
            if ($member->image) {
                deleteFile($member->image);
            }
            $member->delete();
            return response()->json([
                'success' => true,
                'message' => 'Member deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting member: ' . $e->getMessage()
            ], 500);
        }
    }

    public function statusManagementBody($id)
    {
        try {
            $member = Member::findOrFail($id);
            $member->status = !$member->status;
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'Member status updated successfully!',
                'status' => $member->status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating member status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getManagementBody(Request $request)
    {
        $members = Member::query()
            ->where('department', 'Management')
            ->when($request->search, function($query) use ($request) {
                $query->where([['name', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['member_code', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['department', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['designation', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['whatsapp', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['email', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]])
                      ->orWhere([['phone', 'like', '%'.$request->search.'%'],[ 'department', 'Management' ]]);
            })
            ->orderBy('designation', 'asc')
            ->paginate(21);

        return view('admin.powerhouse-team.management-body._member-card', compact('members'))->render();
    }

}
