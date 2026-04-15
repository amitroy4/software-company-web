<?php

namespace App\Http\Controllers\Frontend;

use App\Models\JobApplication;
use Carbon\Carbon;
use App\Models\Career;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\About;
use App\Models\Album;
use App\Models\Client;
use App\Models\Member;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Service;
use App\Models\WhyNeed;
use App\Models\WhyWork;
use App\Models\Application;
use App\Models\MainCounter;
use App\Models\Testimonial;
use App\Models\BlogCategory;
use App\Models\CallToAction;
use App\Models\WhyWorkImage;
use Illuminate\Http\Request;
use App\Models\ServiceClient;
use App\Models\SliderCounter;
use App\Models\ContactMessage;
use App\Models\AlbumImageVideo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\LinesOfCode\Counter;

class FrontendController extends Controller
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
        $sliders = Slider::where('status', true)->get();
        $sliderCounter = SliderCounter::where('status', true)->first();
        $about = About::where('status', true)->first();
        $action = CallToAction::where('status', true)->first();
        $applications = Application::where('status', true)
            ->latest()
            ->take(8)
            ->get();
        $counters = MainCounter::where('status', true)
            ->latest()
            ->take(4)
            ->get();
        $whyWorkImage = WhyWorkImage::where('status', true)->first();
        $whyWorks = WhyWork::where('status', true)->get();
        $chunks = $whyWorks->chunk(ceil($whyWorks->count() / 2));
        $firstHalf = $chunks->first();  // First 50%
        $secondHalf = $chunks->last();  // Second 50%
        $testimonials = Testimonial::where('status', true)->get();
        $services = Service::where('status', true)
            ->where('status', true)
            ->get();

        $clients = Client::where('status', true)->get();
        $blogs = Blog::with('blogCategory')
            ->where('status', true)
            ->latest()
            ->take(3)
            ->get();
        $faqs = Faq::where('status', true)->get();
        $contacts = Contact::where('status', true)
            ->latest()
            ->take(3)
            ->get();
        return view('frontend.index', [
            'sliders' => $sliders,
            'sliderCounter' => $sliderCounter,
            'about' => $about,
            'action' => $action,
            'applications' => $applications,
            'whyWorkImage' => $whyWorkImage,
            'whyWorks' => $whyWorks,
            'firstHalf' => $firstHalf,
            'secondHalf' => $secondHalf,
            'services' => $services,
            'counters' => $counters,
            'clients' => $clients,
            'testimonials' => $testimonials,
            'faqs' => $faqs,
            'blogs' => $blogs,
            'contacts' => $contacts,
        ]);
    }
    public function aboutUs()
    {
        $about = About::where('status', true)->first();
        $clients = Client::where('status', true)->get();

        return view('frontend.about-us', [

            'about' => $about,
            'clients' => $clients,
        ]);
    }

    public function service()
    {
        $services = Service::where('status', true)->get();

        return view('frontend.services', [
            'services' => $services,
        ]);
    }


    public function serviceDetails($slug)
    {

        $service = Service::with([
            'whyNeeds',
            'offeredService',
            'faqs',
            'developmentProcess',
            'technologies',
            'clients' => function ($query) {
                $query->where('status', true);
            }
        ])->where('slug', $slug)->where('status', true)->firstOrFail();

        $clientCount = Client::where('status', true)->count();

        return view('frontend.service-details', [
            'service' => $service,
            'clientCount' => $clientCount,
        ]);
    }



    public function blogs()
    {
        return app(BlogController::class)->blogs();

    }
    public function blogDetails($slug)
    {
        return app(BlogController::class)->blogDetails($slug);

    }
    public function contactUs()
    {
        // $contacts = Contact::where('status', true)->get();
        $contact = Contact::where('status', true)->first();

        return view('frontend.contact', [

            'contact' => $contact,

        ]);
    }

    public function newsAndBlogs()
    {
        return app(BlogController::class)->newsAndBlogs();

    }
    public function blogTag(Request $request)
    {
        return app(BlogController::class)->blogTag($request);
    }
    public function blogCategory(Request $request)
    {
        return app(BlogController::class)->blogCategory($request);
    }
    public function searchBlogs(Request $request)
    {
        return app(BlogController::class)->searchBlogs($request);
    }



    public function sendContactMessage(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Insert into database
        $contact = ContactMessage::create([
            'service_id' => $validated['service_id'] ?? null,
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => true,
        ]);

        return response()->json([
            'message' => 'Your message send successfully.',
            'data' => $contact
        ], 201);

    }


    public function powerhouseTeam(){

        $managements = Member::where('status', true)->where('department', 'Management')->orderBy('created_at', 'asc')->get();
        $members = Member::where('status', true)->where('department', '!=', 'Management')->orderBy('created_at', 'asc')->get();
        return view('frontend.team',compact('managements','members'));
    }

    public function gallery()
    {
        $albums = Album::where('status', 1)->orderBy('id', 'desc')->get();
        return view('frontend.gallery',compact('albums'));
    }

    public function images($number)
    {
        $media = AlbumImageVideo::query(); // start query builder without status

        if ($number) {
            $media->where('album_id', $number);
        } else {
            abort(404); // invalid type
        }

        $album = Album::where('id', $number)->first();

        $mediaItems = $media->orderBy('id', 'desc')->get();

        return view('frontend.gallery-all', compact('mediaItems', 'album'));
    }

    public function products(){
        $categories = ProductCategory::where('status', true)->get();
        $products = Product::where('status', true)->get();
        return view('frontend.products',compact('categories', 'products'));
    }

    public function career()
    {
        // dd(Carbon::today());
        $careers = Career::where('status', true)->where('deadline', '>=', Carbon::today())->get();
        return view('frontend.career',compact('careers'));
    }

    public function apply(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'cv' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);


        if ($request->hasFile('cv')) {
            $cvPath = $this->handleFileUpload($request->cv, 'cv_files');
        }


        JobApplication::create([
            'career_id' => $request->career_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cover_letter' => $request->cover_letter,
            'cv' => $cvPath,
        ]);

        return response()->json([
                'success' => 'Your application has been submitted successfully!'
                ]);
    }

}
