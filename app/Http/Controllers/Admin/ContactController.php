<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        return view('admin.contact.index',[
            'contacts' => $contacts,
        ]);
    }

    public function store(Request $request) {

        $request->validate([
            'branch' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'map' => 'nullable|string',
        ]);

        $contact = new Contact();
        $contact->branch = $request->branch;
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->whatsapp = $request->whatsapp;
        $contact->email = $request->email;
        $contact->map = $request->map;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Contact created successfully.');
    }

    public function toggleStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = !$contact->status;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Contact status updated successfully.');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'address' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'map' => 'nullable|string',
        ]);
        $contact = Contact::findOrFail($id);
        $contact->branch = $request->branch;
        $contact->address = $request->address;
        $contact->phone = $request->phone;
        $contact->whatsapp = $request->whatsapp;
        $contact->email = $request->email;
        $contact->map = $request->map;

        $contact->save();
        return redirect()->route('contact')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact')->with('success', 'Contact deleted successfully.');
    }


    // ...................................contact messages ..........................................

    // public function contactMessages(){
    //     $messages = ContactMessage::all();
    //     return view('admin.contact-message.index');
    // }

    public function unreadContactMessages(){
        // $messages = ContactMessage::all();
        return view('admin.contact-message.index');
    }


    public function readContactMessages(){
        // $messages = ContactMessage::all();
        return view('admin.contact-message.read-message');
    }

    // unread messages api
    public function apiMessages(){
        return ContactMessage::where('status', true)->with('service')
                ->orderBy('updated_at', 'desc')
                ->get();

    }

    // read messages api
    public function readMessages(){
        return ContactMessage::where('status', false)->with('service')
                ->orderBy('updated_at', 'desc')
                ->get();
    }

    // update status as read
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->status = $request->status;
        $message->save();

        return response()->json(['message' => 'Status updated successfully.']);
    }

    // delete message
    public function destroyMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully.']);
    }


}
