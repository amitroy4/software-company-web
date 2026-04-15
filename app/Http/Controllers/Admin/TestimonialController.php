<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{

    public function index() {
        $testimonials = Testimonial::all();
        return view('admin.testimonial.index',[
            'testimonials' => $testimonials,
        ]);
    }
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
    public function store(Request $request) {

        $request->validate([
            'client_name' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $testimonial = new Testimonial();
        $testimonial->client_name = $request->client_name;
        $testimonial->organization = $request->organization;
        $testimonial->designation = $request->designation;
        $testimonial->review = $request->review;
        if ($request->hasFile('image')) {
            $testimonial->image = $this->handleFileUpload($request->file('image'), 'testimonial-image');
        }


        $testimonial->save();
        return redirect()->route('testimonial')->with('success', 'Testimonial created successfully.');
    }

    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = !$testimonial->status;
        $testimonial->save();
        return redirect()->route('testimonial')->with('success', 'Testimonial status updated successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'client_name' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'review' => 'nullable|string|max:400',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->client_name = $request->client_name;
        $testimonial->organization = $request->organization;
        $testimonial->designation = $request->designation;
        $testimonial->review = $request->review;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $this->handleFileDelete($testimonial->image);
            $testimonial->image = $this->handleFileUpload($request->file('image'), 'testimonial-image');
        }
        $testimonial->save();
        return redirect()->route('testimonial')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $this->handleFileDelete($testimonial->image);
        $testimonial->delete();
        return redirect()->route('testimonial')->with('success', 'Testimonial deleted successfully.');
    }
}
