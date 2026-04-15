<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    private function handleFileUpload($file, $path)
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs('uploads/' . $path, $fileName, 'public');
    }

    private function handleFileDelete($filePath)
    {
        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
        }
    }

    public function index(){
        $careers = Career::get();
        return view('admin.career.index', [
            'careers' => $careers,
        ]);
    }

    public function toggleStatus($id)
    {
        $career = Career::findOrFail($id);
        $career->status = !$career->status;
        $career->save();
        return redirect()->route('career.index')->with('success', 'status updated successfully.');
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'       => 'required|string',
            'vacancy'         => 'nullable|string',
            'location'       => 'nullable|string',
            'publish_date'   => 'nullable|date',
            'deadline'       => 'nullable|date',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'company_name'   => 'nullable|string|max:255',
            'email'          => 'nullable|email',
            'phone'          => 'nullable|string|max:20',
            'responsibilities.*' => 'nullable|string',
            'requirements.*'  => 'nullable|string',
            'status'        => 'boolean',
        ]);

        $career = new Career();
        $career->title = $request->title;
        $career->description = $request->description;
        $career->vacancy = $request->vacancy;
        $career->location = $request->location;
        $career->publish_date = $request->publish_date;
        $career->deadline = $request->deadline;
        $career->company_name = $request->company_name;
        $career->email = $request->email;
        $career->phone = $request->phone;

        if ($request->hasFile('image')) {
            $career->image = $this->handleFileUpload($request->image, 'career');
        }  
        if ($request->hasFile('logo')) {
            $career->logo = $this->handleFileUpload($request->logo, 'career');
        }  

        // Convert arrays to JSON
        $career->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
        $career->requirements     = $request->requirements ? json_encode($request->requirements) : null;
        $career->save();

        return redirect()->route('career.index')->with('success', 'career created successfully.');
    }


    public function update(Request $request, $id)
    {
        $career = Career::findOrFail($id);

        $request->validate([
            'title'         => 'required|string|max:255',
            'description'       => 'required|string',
            'vacancy'         => 'nullable|string',
            'location'       => 'nullable|string',
            'publish_date'   => 'nullable|date',
            'deadline'       => 'nullable|date',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'company_name'   => 'nullable|string|max:255',
            'email'          => 'nullable|email',
            'phone'          => 'nullable|string|max:20',
            'responsibilities.*' => 'nullable|string',
            'requirements.*'  => 'nullable|string',
            'status'        => 'boolean',
        ]);

        $career->title = $request->title;
        $career->description = $request->description;
        $career->vacancy = $request->vacancy;
        $career->location = $request->location;
        $career->publish_date = $request->publish_date;
        $career->deadline = $request->deadline;
        $career->company_name = $request->company_name;
        $career->email = $request->email;
        $career->phone = $request->phone;

        if ($request->hasFile('image')) {
            $this->handleFileDelete($career->image);
            $career->image = $this->handleFileUpload($request->image, 'career');
        }  
        if ($request->hasFile('logo')) {
            $this->handleFileDelete($career->logo);
            $career->logo = $this->handleFileUpload($request->logo, 'career');
        }  

        // Convert arrays to JSON
        $career->responsibilities = $request->responsibilities ? json_encode($request->responsibilities) : null;
        $career->requirements     = $request->requirements ? json_encode($request->requirements) : null;
        $career->save();

        return redirect()->route('career.index')->with('success', 'career updated successfully.');
    }


    public function destroy($id)
    {
        $career = Career::findOrFail($id);
        $this->handleFileDelete($career->image);
        $this->handleFileDelete($career->logo);
        $career->delete();

        return redirect()->route('career.index')->with('success', 'career deleted successfully.');
    }


    public function getApplications($id)
    {
        $career = Career::findOrFail($id);

        return view('admin.career.job-applicant', compact('career'));
    }

    public function destroyApplication($id, $careerId)
    {
        $application = JobApplication::findOrFail($id);
        $this->handleFileDelete($application->cv);
        $application->delete();

        return redirect()->route('career.applications', $careerId)->with('success', 'applications deleted successfully.');
    }



}
