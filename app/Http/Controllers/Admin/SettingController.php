<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the settings form.
     */
    public function index()
    {
        $setting = Setting::first(); // For single settings row
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Update the settings.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Settings not found.',
            ], 404);
        }

        $validated = $request->validate([
            'company_name'        => 'nullable|string|max:255',
            'copyright_text'      => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'registration_number' => 'nullable|string|max:255',
            'trade_license'       => 'nullable|string|max:255',
            'vat_number'          => 'nullable|string|max:255',
            'contact_number'      => 'nullable|string|max:255',
            'whatsapp_number'     => 'nullable|string|max:255',
            'hotline_number'      => 'nullable|string|max:255',
            'email'               => 'nullable|email|max:255',
            'alt_email'           => 'nullable|email|max:255',
            'website'             => 'nullable|string|max:255',
            'linkedin'            => 'nullable|string|max:255',
            'facebook'            => 'nullable|string|max:255',
            'landing_page'        => 'nullable|string|max:255',
            'google_map'          => 'nullable|string',
            'address'             => 'nullable|string',
            'logo_dark'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'logo_light'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'favicon'             => 'nullable|image|mimes:jpg,jpeg,png,ico|max:1024',
        ]);

        try {
            // Handle file uploads
            foreach (['logo_dark', 'logo_light', 'favicon'] as $field) {
                if ($request->hasFile($field)) {
                    // Delete old file if exists
                    if ($setting->$field && Storage::disk('public')->exists($setting->$field)) {
                        Storage::disk('public')->delete($setting->$field);
                    }

                    // Store new file with unique filename
                    $filename = $field . '-' . time() . '.' . $request->file($field)->getClientOriginalExtension();
                    $path = $request->file($field)->storeAs('settings', $filename, 'public');
                    $setting->$field = $path;
                }
            }

            // Update other fields
            $setting->fill($request->except(['logo_dark', 'logo_light', 'favicon']));
            $setting->save();

            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating settings: ' . $e->getMessage()
            ], 500);
        }
    }
}
