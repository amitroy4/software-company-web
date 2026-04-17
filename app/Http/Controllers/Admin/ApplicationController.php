<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index() {
        $applications = Application::all();
        return view('admin.application.index',[
            'applications' => $applications,
        ]);
    }
    private function handleFileUpload($file, $path)
    {
        return \uploadFile($file, $path);
    }

    private function handleFileDelete($filePath)
    {
        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
        }

    }
    public function store(Request $request) {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:png,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        $application = new Application();
        $application->title = $request->title;
        $application->url = $request->url;

        if ($request->hasFile('icon')) {
            $application->icon = $this->handleFileUpload($request->file('icon'), 'application-icon');
        }


        $application->save();
        return redirect()->route('application.index')->with('success', 'Application created successfully.');
    }

    public function toggleStatus($id)
    {
        $application = Application::findOrFail($id);
        $application->status = !$application->status;
        $application->save();
        return redirect()->route('application.index')->with('success', 'Application status updated successfully.');
    }
    public function showURL($id)
    {
        $application = Application::findOrFail($id);

        // Toggle the `show_url` status
        $application->show_url = !$application->show_url;
        $application->save();



        return redirect()->route('application.index')->with('success', 'Url Update successfully');
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());

        $request->validate([
            'title' => 'nullable|string|max:255',
            'icon' => 'nullable|image|mimes:png,svg|max:2048',
            'url' => 'nullable|string',
        ]);

        $application = Application::findOrFail($id);
        $application->title = $request->title;
        $application->url = $request->url;

        // Handle Image Upload
        if ($request->hasFile('icon')) {
            $this->handleFileDelete($application->icon);
            $application->icon = $this->handleFileUpload($request->file('icon'), 'application-icon');
        }
        $application->save();
        return redirect()->route('application.index')->with('success', 'Application updated successfully.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $this->handleFileDelete($application->icon);
        $application->delete();
        return redirect()->route('application.index')->with('success', 'Application deleted successfully.');
    }

}
