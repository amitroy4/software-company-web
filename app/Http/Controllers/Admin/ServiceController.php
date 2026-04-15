<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Service;
use App\Models\ServiceFaq;
use App\Models\ServiceNeed;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceClient;
use App\Models\OfferedService;
use Illuminate\Validation\Rule;
use App\Models\ServiceTechnology;
use Illuminate\Http\JsonResponse;
use App\Models\ServiceDevelopment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index', [
            'services' => $services,
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
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'nullable|string|max:255',
            'service_details' => 'nullable|string',
            'image' => 'nullable|image',
            'service_keypoint_1' => 'nullable|string|max:255',
            'service_keypoint_2' => 'nullable|string|max:255',
            'service_keypoint_3' => 'nullable|string|max:255',
            // 'counter_title' => 'nullable|string|max:255',
            // 'data_count' => 'nullable|integer',
            // 'counter_symbol' => 'nullable|string|max:255',
            // 'counter_icon' => 'nullable|image|mimes:png,svg|max:2048',
            // 'contact_title' => 'nullable|string|max:255',
            // 'button_text' => 'nullable|string|max:255',
            // 'contact_url' => 'nullable|string|max:255',

        ]);

        $slug = Str::slug($request->service_name);

        // Check if name OR slug already exists
        $exists = Service::where('service_name', $request->service_name)
                        ->orWhere('slug', $slug)
                        ->exists();

        if ($exists) {
            return redirect()->route('service.index')->with('error', 'Same Service Name Already Exists');
        }


        $service = new Service();
        $service->service_name = $request->service_name;
        $service->slug = Str::slug($request->service_name);
        $service->service_details = $request->service_details;
        $service->service_keypoint_1 = $request->service_keypoint_1;
        $service->service_keypoint_2 = $request->service_keypoint_2;
        $service->service_keypoint_3 = $request->service_keypoint_3;
        // $service->counter_title = $request->counter_title;
        // $service->data_count = $request->data_count;
        // $service->counter_symbol = $request->counter_symbol;
        // $service->contact_url = $request->contact_url;
        // $service->contact_title = $request->contact_title;
        // $service->button_text = $request->button_text;

        // Save main image if provided
        if ($request->hasFile('image')) {
            $service->image = $this->handleFileUpload($request->file('image'), 'service/images');
        }
        if ($request->hasFile('counter_icon')) {
            $service->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'service/counter');
        }
        $service->save();
        return redirect()->route('service.index')->with('success', 'Service created successfully.');
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        $benefits = ServiceNeed::where('service_id', $service->id)->get();
        $offeredServices = OfferedService::where('service_id', $service->id)->get();
        $developemntProcess = ServiceDevelopment::where('service_id', $service->id)->get();
        $technologies = ServiceTechnology::where('service_id', $service->id)->get();
        $faqs = ServiceFaq::where('service_id', $service->id)->get();

        $clientIds = ServiceClient::where('service_id', $service->id)->pluck('client_id');

        $clients = Client::whereIn('id', $clientIds)->get();
        return view('admin.service.edit', [
            'service' => $service,
            'benefits' => $benefits,
            'offeredServices' => $offeredServices,
            'developemntProcess' => $developemntProcess,
            'technologies' => $technologies,
            'faqs' => $faqs,
            'clients' => $clients,
        ]);
    }
    // public function apiServiceShow(Service $service)
    // {
    //     $service->load([
    //         'whyNeeds',
    //         'offeredService',
    //         'clients',
    //         'technologies',
    //         'faqs',
    //         'developmentProcess',
    //     ]);
    //     return response()->json($service, 200);
    // }
    public function apiWhyNeedUpdate(Request $request, Service $service)
{
    $request->validate([
        'benefit_title.*' => 'nullable|string|max:255',
        'benefit_details.*' => 'nullable|string',
    ]);

    $titles = $request->input('benefit_title', []);
    $details = $request->input('benefit_details', []);
    $ids = $request->input('benefit_ids', []);

    foreach ($titles as $i => $title) {
        if (!isset($details[$i])) continue;

        $data = [
            'service_id' => $service->id,
            'keypoint_title' => $title,
            'keypoint_details' => $details[$i],
            'status' => true,
        ];

        $id = $ids[$i] ?? null;

        if ($id) {
            // Update existing
            $benefit = $service->whyNeeds()->find($id);
            if ($benefit) {
                $benefit->update($data);
            }
        } else {
            // Create new
            $service->whyNeeds()->create($data);
        }
    }

    // Optional: only delete if `removed_benefit_ids` explicitly sent
    if ($request->has('removed_benefit_ids')) {
        $service->whyNeeds()->whereIn('id', $request->removed_benefit_ids)->delete();
    }

    return response()->json([
        'message' => 'Keypoints saved successfully.',
        'data' => $service->whyNeeds()->get(),
    ]);
}


    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'service_name' => 'nullable|string|max:255',
            'service_details' => 'nullable|string',
            'image' => 'nullable|image',
            'service_keypoint_1' => 'nullable|string|max:255',
            'service_keypoint_2' => 'nullable|string|max:255',
            'service_keypoint_3' => 'nullable|string|max:255',

            // 'counter_title' => 'nullable|string|max:255',
            // 'data_count' => 'nullable|integer',
            // 'counter_symbol' => 'nullable|string|max:255',
            // 'counter_icon' => 'nullable|image|mimes:png,svg|max:2048',
            // 'contact_title' => 'nullable|string|max:255',
            // 'contact_url' => 'nullable|string|max:255',
            // 'button_text' => 'nullable|string|max:255',
        ]);
        $service = Service::findOrFail($id);
        $service->service_name = $request->service_name;
        $service->slug = Str::slug($request->service_name);
        $service->service_details = $request->service_details;
        $service->service_keypoint_1 = $request->service_keypoint_1;
        $service->service_keypoint_2 = $request->service_keypoint_2;
        $service->service_keypoint_3 = $request->service_keypoint_3;

        // $service->counter_title = $request->counter_title;
        // $service->data_count = $request->data_count;
        // $service->counter_symbol = $request->counter_symbol;
        // $service->contact_title = $request->contact_title;
        // $service->contact_url = $request->contact_url;
        // $service->button_text = $request->button_text;
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $this->handleFileDelete($service->image);
            $service->image = $this->handleFileUpload($request->file('image'), 'service/image');
        }
        if ($request->hasFile('counter_icon')) {
            $this->handleFileDelete($service->counter_icon);
            $service->counter_icon = $this->handleFileUpload($request->file('counter_icon'), 'service/counter');
        }
        $service->save();
        return redirect()->back()->with('success', 'Service Overview updated successfully.')
            ->with('activeTab', 'overview');
    }
    public function offeredService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if($request->offered_service_id){

        $request->validate([
            'offered_service_id.*' => 'nullable|integer|exists:offered_services,id',
            'offered_service_name.*' => 'nullable|string|max:255',
            'offered_service_icon.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $ids = $request->offered_service_id;
        $names = $request->offered_service_name;
        $icons = $request->file('offered_service_icon');

        foreach ($names as $index => $name) {
            $offered_service_id = $ids[$index] ?? null;
            $icon = $icons[$index] ?? null;

            $data = ['offered_service' => $name];

            if ($icon && $icon->isValid()) {
                $data['service_image'] = $this->handleFileUpload($icon, 'service/offered-service');
            }

            if ($offered_service_id) {
                // Update existing
                $offeredService = $service->offeredService()->find($offered_service_id);
                if ($offeredService) {
                    // Replace image if new one uploaded
                    if (isset($data['service_image'])) {
                        $this->handleFileDelete($offeredService->service_image);
                    }
                    $offeredService->update($data);
                }
            } else {
                // Create new
                $service->offeredService()->create($data);
            }
        }
    }

        return redirect()->back()->with('success', 'Offered Services updated successfully.')->with('activeTab', 'offeredService');
    }


    public function storeclient(Request $request, $id)
    {
        $request->validate([
            'service_client' => 'required|string|max:255',
            'url' => 'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = [
            'service_id' => $id,
            'service_client' => $request->service_client,
            'url' => $request->url,
        ];
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('service_clients', 'public');
        }
        ServiceClient::create($data);
        return redirect()->back()->with('success', 'Client added successfully')->with('activeTab', 'provideClient');
    }
public function updateclient(Request $request, string $id)
{
    $service = Service::findOrFail($id);

    $clientIds = is_array($request->selected_clients)
        ? $request->selected_clients
        : json_decode($request->selected_clients, true);

    if (empty($clientIds)) {
        return redirect()->back()
            ->with('error', 'Please select at least one client.')
            ->with('activeTab', 'serviceClients');
    }
    // Make sure it's always an array
    $clientIds = $clientIds ?? [];

    // Delete clients not in the incoming list
    $service->clients()->whereNotIn('client_id', $clientIds)->delete();

    // Add or update the selected clients
    foreach ($clientIds as $clientId) {
        $service->clients()->updateOrCreate(
            ['client_id' => $clientId],
            ['service_id' => $service->id]
        );
    }

    return redirect()->back()
        ->with('success', 'Service clients updated successfully.')
        ->with('activeTab', 'serviceClients');
}

    public function toggleclientStatus($id)
    {
        $client = ServiceClient::findOrFail($id);
        $client->status = !$client->status;
        $client->save();
        return redirect()->back()->with('success', 'Client status updated successfully.')
            ->with('activeTab', 'provideClient');
    }

    public function destroyclient($id)
    {
        $client = ServiceClient::findOrFail($id);
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();

        return redirect()->back()->with('success', 'Client status updated successfully.')
            ->with('activeTab', 'provideClient');
    }
    public function showUrl($id)
    {
        $client = ServiceClient::findOrFail($id);
        $client->show_url = !$client->show_url;
        $client->save();
        return redirect()->back()->with('success', 'Client status updated successfully.')
            ->with('activeTab', 'provideClient');
    }
public function processUpdate(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $request->validate([
        'process_title.*' => 'nullable|string|max:255',
        'process_details.*' => 'nullable|string',
    ]);

    $titles = $request->process_title ?? [];
    $details = $request->process_details ?? [];
    $ids = $request->process_ids ?? [];

    foreach ($titles as $index => $title) {
        if (empty($title)) continue;

        $data = [
            'process_title' => $title,
            'process_details' => $details[$index] ?? '',
            'service_id' => $service->id,
        ];

        $processId = $ids[$index] ?? null;

        if ($processId) {
            // Update existing process
            $process = $service->developmentProcess()->find($processId);
            if ($process) {
                $process->update($data);
            }
        } else {
            // Create new process
            $service->developmentProcess()->create($data);
        }
    }

    return redirect()->back()
        ->with('success', 'Service development process updated successfully.')
        ->with('activeTab', 'developmentProcess');
}


public function technologyUpdate(Request $request, $id)
{
    // dd($request->all());
    $service = Service::findOrFail($id);

    $request->validate([
        'technology_id.*' => 'nullable|integer|exists:service_technologies,id', // adjust table name as needed
        'technology_name.*' => 'nullable|string|max:255',
        'technology_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $ids = $request->technology_id ?? [];
    $names = $request->technology_name ?? [];
    $icons = $request->file('technology_image') ?? [];

    foreach ($names as $index => $name) {
        $technology_id = $ids[$index] ?? null;
        $icon = $icons[$index] ?? null;

        $data = [
            'technology_name' => $name,
            'service_id' => $service->id,
        ];

        if ($icon && $icon->isValid()) {
            $data['technology_image'] = $this->handleFileUpload($icon, 'service/technology');
        }

        if ($technology_id) {
            $technology = $service->technologies()->find($technology_id);
            if ($technology) {
                if (isset($data['technology_image'])) {
                    $this->handleFileDelete($technology->technology_image);
                }
                $technology->update($data);
            }
        } else {
            $service->technologies()->create($data);
        }
    }

    return redirect()->back()
        ->with('success', 'Technologies updated successfully.')
        ->with('activeTab', 'technology');
}







public function faqUpdate(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $request->validate([
        'faq_question.*' => 'required|string|max:255',
        'faq_answer.*' => 'required|string',
    ]);

    $questions = $request->input('faq_question', []);
    $answers = $request->input('faq_answer', []);
    $ids = $request->input('faq_ids', []);

    foreach ($questions as $i => $question) {
        if (isset($answers[$i])) {
            $service->faqs()->updateOrCreate(
                ['id' => $ids[$i] ?? null],
                [
                    'service_id' => $service->id,
                    'question' => $question,
                    'answer' => $answers[$i] ?? '',
                ]
            );
        }
    }

    // No deletion here — only update or create

    return redirect()->back()
        ->with('success', 'FAQs updated successfully.')
        ->with('activeTab', 'faq');
}


    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->status = !$service->status;
        $service->save();
        return redirect()->route('service.index')->with('success', 'Service status updated successfully.');
    }
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $this->handleFileDelete($service->image);
        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service deleted successfully.');
    }



    public function destroyBenefit($id, Request $request)
    {
        $benefit = ServiceNeed::find($id);

        if (!$benefit) {
            return response()->json(['message' => 'Benefit not found.'], 404);
        }

        $benefit->delete();

        return response()->json(['message' => 'Benefit deleted successfully.']);
    }

    public function destroyOfferedServices($id, Request $request)
    {
        $offerService = OfferedService::find($id);

        if (!$offerService) {
            return response()->json(['message' => 'Offered Service not found.'], 404);
        }

        if ($offerService->service_image) {
            $this->handleFileDelete($offerService->service_image);
        }

        $offerService->delete();

        return response()->json(['message' => 'Offered Service deleted successfully.']);
    }
    public function destroyDevelopmentProcess($id, Request $request)
    {
        $developemntProcess = ServiceDevelopment::find($id);

        if (!$developemntProcess) {
            return response()->json(['message' => 'Development Process not found.'], 404);
        }

        $developemntProcess->delete();

        return response()->json(['message' => 'Development Process deleted successfully.']);
    }
    public function destroyTechnology($id, Request $request)
    {
        $serviceTechnology = ServiceTechnology::find($id);

        if (!$serviceTechnology) {
            return response()->json(['message' => 'Service Technology not found.'], 404);
        }

        if ($serviceTechnology->technology_image) {
            $this->handleFileDelete($serviceTechnology->technology_image);
        }

        $serviceTechnology->delete();

        return response()->json(['message' => 'Service Technology deleted successfully.']);
    }


    public function destroyFaq($id, Request $request)
    {
        $faq = ServiceFaq::find($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ not found.'], 404);
        }


        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully.']);
    }
}
