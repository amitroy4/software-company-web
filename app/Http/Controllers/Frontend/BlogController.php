<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::with('blogCategory')->where('status', true)->latest()->get();
        return view('frontend.blogs', compact('blogs'));
    }

    public function blogDetails($slug)
    {
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

        return view('frontend.blog_details', compact('blogs', 'blog', 'categories', 'allTags'));
    }

    public function newsAndBlogs()
    {
        $blogs = Blog::where('status', true)->latest()->get();
        return view('frontend.blogs', compact('blogs'));
    }

    public function blogTag(Request $request)
    {
        // dd($request->all());
        $tag = $request->query('tag');
        $blogs = Blog::where('status', true)
            ->where('tags', 'LIKE', "%{$tag}%")
            ->latest()
            ->get();
        return view('frontend.blogs', compact('blogs', 'tag'));
    }

    public function blogCategory($request)
    {
        // dd($request->all());

        $category = BlogCategory::where('id', $request->query('id'))->firstOrFail();
        $blogs = Blog::where('status', true)
            ->where('blog_category_id', $category->id)
            ->latest()
            ->get();

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

