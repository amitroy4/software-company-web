<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallToAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CallToActionController extends Controller
{
    public function index() {
        $action = CallToAction::first();

        return view('admin.call-to-action.index',[
            'action' => $action,
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
    public function toggleStatus($id)
    {
        $action = CallToAction::findOrFail($id);
        $action->status = !$action->status;
        $action->save();
        return redirect()->route('action.index')->with('success', 'Status updated successfully.');
    }
    public function update(Request $request, $id)
    {
        $action = CallToAction::findOrFail($id);
        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
            'call_button_text' => 'nullable|string|max:255',
            'call_button_url' => 'nullable|string',
            'contact_no' => 'nullable|string|max:255',
            'main_icon' => [
                'nullable',
                'image',
                'mimes:png,svg',
                Rule::requiredIf(function () use ($action) {
                    return empty($action->main_icon); // Required if no existing image
                }),
            ],
            'call_button_icon' => 'nullable|image|mimes:png,svg',

        ]);
        $action = CallToAction::findOrFail($id);
        $action->title = $request->title;
        $action->sub_title = $request->sub_title;
        $action->button_text = $request->button_text;
        $action->button_url = $request->button_url;
        $action->call_button_text = $request->call_button_text;
        $action->call_button_url = $request->call_button_url;
        $action->contact_no = $request->contact_no;
        // Handle Image Upload
        if ($request->hasFile('main_icon')) {
            $this->handleFileDelete($action->main_icon);
            $action->main_icon = $this->handleFileUpload($request->file('main_icon'), 'call-to-action');
        }
        if ($request->hasFile('call_button_icon')) {
            $this->handleFileDelete($action->call_button_icon);
            $action->call_button_icon = $this->handleFileUpload($request->file('call_button_icon'), 'call-to-action');
        }
        $action->save();
        return redirect()->route('action.index')->with('success', 'Call to Action updated successfully.');
    }
}
