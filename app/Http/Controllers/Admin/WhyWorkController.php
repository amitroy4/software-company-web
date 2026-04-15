<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyWork;
use App\Models\WhyWorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyWorkController extends Controller
{
    public function index() {
        $whyWorks = WhyWork::all();
        $image = WhyWorkImage::first();
        return view('admin.why-work.index',[
            'whyWorks' => $whyWorks,
            'image' => $image,
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

    public function imageToggleStatus($id)
    {
        $image = WhyWorkImage::findOrFail($id);
        $image->status = !$image->status;
        $image->save();
        return redirect()->route('why-work.index')->with('success', 'Image status updated successfully.');
    }

    public function imageUpdate(Request $request, $id)
    {

        $request->validate([

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

          ]);

          $image = WhyWorkImage::findOrFail($id);

           // Handle Image Upload
           if ($request->hasFile('image')) {
            $this->handleFileDelete($image->image);
            $image->image = $this->handleFileUpload($request->file('image'), 'why-work');
        }
          $image->save();
        return redirect()->route('why-work.index')->with('success', 'Counter updated successfully.');
    }
    public function store(Request $request) {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:255',

        ]);

        $whyWork = new WhyWork();
        $whyWork->title = $request->title;
        $whyWork->details = $request->details;
        $whyWork->save();
        return redirect()->route('why-work.index')->with('success', 'Keypoint added successfully.');
    }

    public function toggleStatus($id)
    {
        $whyWork = WhyWork::findOrFail($id);
        $whyWork->status = !$whyWork->status;
        $whyWork->save();
        return redirect()->route('why-work.index')->with('success', 'Why Work status updated successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:255',
        ]);

        $whyWork = WhyWork::findOrFail($id);
        $whyWork->title = $request->title;
        $whyWork->details = $request->details;
        $whyWork->save();
        return redirect()->route('why-work.index')->with('success', 'Keypoint updated successfully.');
    }

    public function destroy($id)
    {
        $whyWork = WhyWork::findOrFail($id);
        $whyWork->delete();
        return redirect()->route('why-work.index')->with('success', 'Keypoint deleted successfully.');
    }
}
