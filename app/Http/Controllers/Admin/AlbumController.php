<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\AlbumImageVideo;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
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
    public function index()
    {
        return view('admin.gallery.album');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            // Use your custom file upload handler
            $filePath = $this->handleFileUpload($request->file('cover_image'), 'album_covers');
            $validated['cover_image'] = $filePath;
        }

        Album::create($validated);

        return response()->json(['message' => 'Album created successfully']);
    }




    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            $albums = Album::all(); // Or ->latest()

            return datatables()->of($albums)
                ->addIndexColumn()

                // Album Name
                ->editColumn('name', function ($row) {
                    return e($row->name);
                })

                // Cover Image
                ->editColumn('cover_image', function ($row) {
                    return '<img src="' . asset('storage/' . $row->cover_image) . '" width="96" height="72" alt="cover">';
                })

                // Placeholder for Images count
                ->addColumn('images', function ($row) {
                    $imagecount = $row->albumImageVideos()->where('type', 'image')->count();
                    return $imagecount; // adjust if you have gallery relationship
                })

                // Placeholder for Videos count
                ->addColumn('videos', function ($row) {
                    $videocount = $row->albumImageVideos()->where('type', 'video')->count();
                    return $videocount; // adjust if you have video relationship
                })

                // Status Column
                ->editColumn('status', function ($row) {

                    return '
                        <a href="#" class="action-btn-info me-1 add-image-video" data-id="'. $row->id .'" title="View Image"><i class="bx bx-image-add fs-2" ></i></a>
                        ';
                })

                // Action Buttons
                ->addColumn('action', function ($row) {
                    $checked = $row->status ? '' : 'checked';
                    return '
                        <div class="button r mb-2" id="button-1">
                            <input type="checkbox" class="checkbox toggle-status" data-id="' . $row->id . '" ' . $checked . '>
                            <div class="knobs"></div>
                            <div class="layer"></div>
                        </div>
                        <a href="#" class="action-btn-info me-1 edit-album" data-id="' . $row->id . '" title="Edit"><i class="bx bxs-edit"></i></a>
                        <a href="#" class="action-btn-danger delete-album" data-id="' . $row->id . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                })

                ->rawColumns(['cover_image', 'status', 'action'])
                ->make(true);
        }
    }


    public function toggleStatus($id)
    {
        $album = Album::findOrFail($id);
        $album->status = !$album->status;
        $album->save();

        return response()->json([
            'message' => 'Status updated successfully',
            'status' => $album->status
        ]);
    }


    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        if ($album->albumImageVideos()->exists()) {
            foreach ($album->albumImageVideos as $file) {
                $this->handleFileDelete($file->file_path); // delete from storage
                $file->delete(); // delete from database
            }
        }

        $this->handleFileDelete($album->cover_image); // your helper function

        $album->delete();

        return response()->json(['message' => 'Album deleted successfully.']);
    }


    public function edit($id)
    {
        $album = Album::findOrFail($id);

        return response()->json([
            'id' => $album->id,
            'name' => $album->name,
            'status' => $album->status,
            'cover_image_url' => $album->cover_image ? asset('storage/' . $album->cover_image) : null,
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        $album = Album::findOrFail($id);
        $album->name = $request->name;
        $album->status = $request->status;

        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            $this->handleFileDelete($album->cover_image);

            // Upload new image and get the stored file path
            $path = $this->handleFileUpload($request->file('cover_image'), 'albums');

            // Save path in DB (relative path)
            $album->cover_image = $path;
        }

        $album->save();

        return response()->json(['message' => 'Album updated successfully']);
    }




    public function storeImageVideo(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'album_id' => 'required|integer',
            'image_video.*' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        foreach ($request->file('image_video') as $file) {
            $storedPath = $this->handleFileUpload($file, 'albums');

            AlbumImageVideo::create([
                'album_id'  => $request->album_id,
                'file_path' => $storedPath,
                'type'      => str_contains($file->getMimeType(), 'video') ? 'video' : 'image',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Files uploaded successfully.'
        ]);
    }


    public function getImageVideo($id)
    {
        return response()->json([
            'success' => true,
            'files' => AlbumImageVideo::where('album_id', $id)
                ->get(['id','file_path', 'type']),
        ]);
    }

    public function deleteImageVideo($id)
    {
        $file = AlbumImageVideo::find($id);

        if (!$file) {
            return response()->json(['success' => false, 'message' => 'File not found']);
        }

        // Use your custom file delete helper
        $this->handleFileDelete($file->file_path);

        $file->delete();

        return response()->json(['success' => true]);
    }




}
