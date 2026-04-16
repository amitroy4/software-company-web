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

    public function contactMessages(){
        return view('admin.contact-message.index', [
            'activeFilter' => 'all',
        ]);
    }

    public function unreadContactMessages(){
        return view('admin.contact-message.index', [
            'activeFilter' => 'unread',
        ]);
    }


    public function readContactMessages(){
        return view('admin.contact-message.index', [
            'activeFilter' => 'read',
        ]);
    }

    // messages api with filter: all | unread | read
    public function apiMessages(){
        $filter = request()->query('filter', 'all');

        $query = ContactMessage::query()->with('service');
        if ($filter === 'read') {
            $query->where('status', false);
        } elseif ($filter === 'unread') {
            $query->where('status', true);
        }

        return $query->orderBy('updated_at', 'desc')->get();

    }

    // read messages api
    public function readMessages(){
        return ContactMessage::where('status', false)->with('service')
                ->orderBy('updated_at', 'desc')
                ->get();
    }

    // open notification: mark unread message as read and go to read message list
    public function openMessage($id)
    {
        $message = ContactMessage::findOrFail($id);

        if ($message->status) {
            $message->status = false;
            $message->save();
        }

        return redirect()->route('contact.messages.show', $message->id);
    }

    public function showMessage($id)
    {
        $message = ContactMessage::with('service')->findOrFail($id);

        if ($message->status) {
            $message->status = false;
            $message->save();
        }

        return view('admin.contact-message.show', compact('message'));
    }

    // update status as read
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $message = ContactMessage::findOrFail($id);

        // One-way transition only: unread(true) -> read(false)
        if ($message->status === false && (bool) $request->status === true) {
            return response()->json(['message' => 'Read messages cannot be marked unread.'], 422);
        }

        $message->status = (bool) $request->status;
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
