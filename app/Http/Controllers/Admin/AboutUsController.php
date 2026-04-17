<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function index()
    {
        $abouts = About::all();

        return view('admin.about-us.index', [
            'abouts' => $abouts,
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

    public function toggleStatus($id)
    {
        $about = About::findOrFail($id);
        $about->status = !$about->status;
        $about->save();
        return redirect()->route('about')->with('success', 'About status updated successfully.');
    }
    public function edit($id)
    {
        $about = About::findOrFail($id);

        return view('admin.about-us.edit', [
            'about' => $about,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'quote' => 'nullable|string|max:255',
            'description' => 'required|string',
            'year_of_experience' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'counter_title' => 'required|string|max:255',
            'data_count' => 'required|integer',
            'counter_symbol' => 'nullable|string|max:255',
            'counter_icon' => 'nullable|image|mimes:png,svg|max:2048',
            'keypoints' => 'array',
            'keypoints.*' => 'string|nullable',
            'keypoint_ids' => 'array',
            'keypoint_ids.*' => 'nullable|integer',
            'removed_keypoint_ids' => 'array',
            'removed_keypoint_ids.*' => 'nullable|integer',
        ]);
        $about = About::findOrFail($id);
        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->quote = $request->quote;
        $about->description = $request->description;
        $about->counter_title = $request->counter_title;
        $about->data_count = $request->data_count;
        $about->counter_symbol = $request->counter_symbol;
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $this->handleFileDelete($about->image);
            $about->image = $this->handleFileUpload($request->file('image'), 'about/image');
        }
        if ($request->hasFile('counter_icon')) {
            $this->handleFileDelete($about->counter_icon);
            $about->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'about/counter');
        }
        $about->save();
        // Update existing keypoints
        if ($request->has('keypoint_ids')) {
            foreach ($request->keypoint_ids as $index => $faqId) {
                if ($faqId && isset($request->keypoints[$index])) {
                    $keypoint = $about->keypoints()->find($faqId);
                    if ($keypoint) {
                        $keypoint->update([
                            'keypoint' => $request->keypoints[$index],
                        ]);
                    }
                }
            }
        }

        // Add new keypoints (those without an ID)
        if ($request->has('keypoints')) {
            foreach ($request->keypoints as $index => $keypoint) {
                if (
                    !$request->has('keypoint_ids') ||
                    !isset($request->keypoint_ids[$index]) ||
                    !$request->keypoint_ids[$index]
                ) {
                    $about->keypoints()->create([
                        'keypoint' => $keypoint,
                    ]);
                }
            }
        }
        if ($request->has('removed_keypoint_ids')) {
            $about->keypoints()->whereIn('id', $request->removed_keypoint_ids)->delete();
        }

        return redirect()->route('about-us')->with('success', 'About Us updated successfully.');
    }
}
