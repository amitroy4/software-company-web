<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    private function blogListingQuery()
    {
        return Blog::with('blogCategory')->where('status', true)->latest();
    }

    public function blogs()
    {
        $blogs = $this->blogListingQuery()->paginate(9)->withQueryString();
        return view('frontend.blogs', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blogDetails = Cache::remember("frontend.blog.details.{$slug}", now()->addMinutes(10), function () use ($slug) {
            $blogs = Blog::with('blogCategory')
                ->where('status', true)
                ->where('slug', '!=', $slug)
                ->latest()
                ->take(3)
                ->get();

            $blog = Blog::with('blogCategory')
                ->where('status', true)
                ->where('slug', $slug)
                ->firstOrFail();

            $categories = BlogCategory::withCount([
                'blog' => function ($query) {
                    $query->where('status', true);
                }
            ])->get();
            $allTags = Blog::where('status', true)
                ->pluck('tags')
                ->flatMap(fn($tags) => explode(',', $tags))
                ->map(fn($tag) => trim($tag))
                ->unique()
                ->filter()
                ->values();

            return compact('blogs', 'blog', 'categories', 'allTags');
        });

        return view('frontend.blog_details', $blogDetails);
    }

    public function newsAndBlogs()
    {
        $blogs = $this->blogListingQuery()->paginate(9)->withQueryString();
        return view('frontend.blogs', compact('blogs'));
    }

    public function blogTag(Request $request)
    {
        // dd($request->all());
        $tag = $request->query('tag');
        $blogs = $this->blogListingQuery()
            ->where('tags', 'LIKE', "%{$tag}%")
            ->paginate(9)
            ->withQueryString();
        return view('frontend.blogs', compact('blogs', 'tag'));
    }

    public function blogCategory($request)
    {
        // dd($request->all());

        $category = BlogCategory::where('id', $request->query('id'))->firstOrFail();
        $blogs = $this->blogListingQuery()
            ->where('blog_category_id', $category->id)
            ->paginate(9)
            ->withQueryString();

        return view('frontend.blogs', compact('blogs', 'category'));
    }
    public function searchBlogs(Request $request)
    {
        // dd($request->all());
        $query = $request->input('query');

        /* $blogs = Blog::where('status', true)
            ->where('title', 'like', '%' . $query . '%')
            ->take(5)
            ->get();

        return response()->json([
            'blogs' => $blogs
        ]); */

        $results = Blog::where('title', 'LIKE', "%{$query}%")
        ->select('id', 'title', 'slug')
        ->limit(10)
        ->get();

    return response()->json($results);
    }

}

