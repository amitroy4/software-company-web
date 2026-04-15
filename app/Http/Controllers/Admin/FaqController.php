<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::all();
        return view('admin.faq.index',[
            'faqs' => $faqs,
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'question' => 'nullable|string|max:255',
            'answer' => 'nullable|string|max:255',

        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('faq')->with('success', 'Faq created successfully.');
    }

    public function toggleStatus($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->status = !$faq->status;
        $faq->save();
        return redirect()->route('faq')->with('success', 'Faq status updated successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
        'question' => 'nullable|string|max:255',
        'answer' => 'nullable|string|max:255',
        ]);
        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('faq')->with('success', 'Faq updated successfully.');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('faq')->with('success', 'Faq deleted successfully.');
    }
}
