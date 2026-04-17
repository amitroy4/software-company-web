<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoverImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CoverImageController extends Controller
{

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

    public function index(){
        $coverImages = CoverImage::all();
        return view('admin.cover-image.index',compact('coverImages'));
    }



    public function loadCoverImage()
    {
        $coverImages = CoverImage::all();
        return response()->json($coverImages);
    }



    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255|unique:cover_images,page_name',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $this->handleFileUpload($request->file('cover_image'), 'cover_images');
        }

        $coverImage = CoverImage::create([
            'page_name' => $request->page_name,
            'cover_image' => $imagePath,
            'status' => $request->has('status') ? $request->status : true,
        ]);

        return response()->json([
            'message' => 'Cover image added successfully',
            'data' => $coverImage
        ], 201);
    }




    public function updateImage(Request $request)
    {
        $request->validate([
            'hiddenId' => 'required|exists:cover_images,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $coverImage = CoverImage::findOrFail($request->hiddenId);

        if ($request->hasFile('cover_image')) {
            // Delete old file if exists
            $this->handleFileDelete($coverImage->cover_image);

            // Upload new file
            $imagePath = $this->handleFileUpload($request->file('cover_image'), 'cover_images');

            $coverImage->cover_image = $imagePath;
        }

        $coverImage->save();

        return response()->json(['message' => 'Cover image updated successfully']);
    }

}
