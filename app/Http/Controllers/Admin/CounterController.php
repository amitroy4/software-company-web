<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\MainCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CounterController extends Controller
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
    public function index()
    {
        $counters = MainCounter::all();

        return view('admin.counter.index', [

            'counters' => $counters,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'counter_title' => 'required|string|max:255',
            'data_count' => 'required|integer',
            'counter_symbol' => 'nullable|string|max:255',
            'counter_icon' => 'nullable|image|mimes:png,svg|max:2048',
        ]);

        $counter = new MainCounter();
        $counter->counter_title = $request->counter_title;
        $counter->data_count = $request->data_count;
        $counter->counter_symbol = $request->counter_symbol;
        if ($request->hasFile('counter_icon')) {
            $counter->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'counter-icon');
        }
        $counter->save();
        return redirect()->route('counter.index')->with('success', 'MainCounter created successfully.');
    }
    public function toggleStatus($id)
    {
        $counter = MainCounter::findOrFail($id);
        $counter->status = !$counter->status;
        $counter->save();
        return redirect()->route('counter.index')->with('success', 'Counter status updated successfully.');
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'counter_title' => 'required|string|max:255',
            'data_count' => 'required|integer',
            'counter_symbol' => 'nullable|string|max:255',
            'counter_icon' => 'nullable|image|mimes:png,svg|max:2048',

        ]);

        $counter = MainCounter::findOrFail($id);
        $counter->counter_title = $request->counter_title;
        $counter->data_count = $request->data_count;
        $counter->counter_symbol = $request->counter_symbol;
        // Handle Image Upload
        if ($request->hasFile('counter_icon')) {
            $this->handleFileDelete($counter->counter_icon);
            $counter->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'counter-icon');
        }
        $counter->save();
        return redirect()->route('counter.index')->with('success', 'MainCounter updated successfully.');
    }
    public function destroy($id)
    {
        $counter = MainCounter::findOrFail($id);
        $this->handleFileDelete($counter->image);
        $counter->delete();
        return redirect()->route('counter.index')->with('success', 'MainCounter deleted successfully.');
    }
}
