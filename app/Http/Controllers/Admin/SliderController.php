<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderCounter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index() {
        $sliders = Slider::all();
        $counter = SliderCounter::first();
        return view('admin.slider.index',[
            'sliders' => $sliders,
            'counter' => $counter,
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

    public function counterToggleStatus($id)
    {
        $counter = SliderCounter::findOrFail($id);
        $counter->status = !$counter->status;
        $counter->save();
        return redirect()->route('slider.index')->with('success', 'Counter status updated successfully.');
    }

    public function counterUpdate(Request $request, $id)
    {

        $request->validate([
            'counter_title' => 'required|string|max:255',
            'data_count' => 'required|integer',
            'counter_symbol' => 'nullable|string|max:255',
            'counter_icon' => 'nullable|image|mimes:svg|max:2048',

          ]);

          $counter = SliderCounter::findOrFail($id);
          $counter->counter_title = $request->counter_title;
          $counter->data_count = $request->data_count;
          $counter->counter_symbol = $request->counter_symbol;
           // Handle Image Upload
           if ($request->hasFile('counter_icon')) {
            $this->handleFileDelete($counter->counter_icon);
            $counter->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'slider/counter');
        }
          $counter->save();
        return redirect()->route('slider.index')->with('success', 'Counter updated successfully.');
    }
    public function store(Request $request) {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;

        if ($request->hasFile('image')) {
            $slider->image = $this->handleFileUpload($request->file('image'), 'slider');
        }


        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    public function toggleStatus($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = !$slider->status;
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider status updated successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50048',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $this->handleFileDelete($slider->image);
            $slider->image = $this->handleFileUpload($request->file('image'), 'slider');
        }
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $this->handleFileDelete($slider->image);
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }


}
