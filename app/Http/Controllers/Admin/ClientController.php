<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\ServiceClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index() {
        $clients = Client::all();
        return view('admin.client.index',[
            'clients' => $clients,
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
    public function store(Request $request) {

        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,svg,jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|string',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->url = $request->url;

        if ($request->hasFile('logo')) {
            $client->logo = $this->handleFileUpload($request->file('logo'), 'client-logo');
        }


        $client->save();
        return redirect()->route('client')->with('success', 'Client created successfully.');
    }

    public function toggleStatus($id)
    {
        $client = Client::findOrFail($id);
        $client->status = !$client->status;
        $client->save();
        return redirect()->route('client')->with('success', 'Client status updated successfully.');
    }
    public function showURL($id)
    {
        $client = Client::findOrFail($id);

        // Toggle the `show_url` status
        $client->show_url = !$client->show_url;
        $client->save();



        return redirect()->route('client')->with('success', 'Url Update successfully');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,svg,jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|string',
        ]);

        $client = Client::findOrFail($id);
        $client->name = $request->name;
        $client->url = $request->url;

        // Handle Image Upload
        if ($request->hasFile('logo')) {
            $this->handleFileDelete($client->logo);
            $client->logo = $this->handleFileUpload($request->file('logo'), 'client-logo');
        }
        $client->save();
        return redirect()->route('client')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $this->handleFileDelete($client->logo);
        $client->delete();
        return redirect()->route('client')->with('success', 'Client deleted successfully.');
    }

    public function activeClients(Request $request)
{
    $status = $request->status;
    $serviceId = $request->service_id;

    // Get clients with given status
    $clients = Client::where('status', $status)->get();

    // Get client IDs already linked to the service
    $linkedClientIds = ServiceClient::where('service_id', $serviceId)
                                    ->pluck('client_id')
                                    ->toArray();

    // Add is_linked property to each client
    $clients->transform(function ($client) use ($linkedClientIds) {
        $client->is_linked = in_array($client->id, $linkedClientIds);
        return $client;
    });

    return response()->json($clients);
}


}
