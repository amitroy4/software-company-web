<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
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
        $allBlog = Blog::with('blogCategory')->latest()->get();
        $blogCategory = BlogCategory::all();
        $blogCategories = BlogCategory::with('blog')
            ->where('status', true)
            ->get();
        return view('admin.blog.index', [
            'allBlog' => $allBlog,
            'blogCategory' => $blogCategory,
            'blogCategories' => $blogCategories,

        ]);
    }
    public function storeCategory(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('blog.index')->with('success', 'Blog Category created successfully.');
    }
    public function updateCategory(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);
        $category = BlogCategory::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('blog.index')->with('success', 'Blog Category updated successfully.');
    }
    public function toggleCategoryStatus($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();
        return redirect()->route('blog.index')->with('success', 'Blog Category status updated successfully.');
    }

    public function destroyCategory($id)
    {
        $category = BlogCategory::findOrFail($id);
        if ($category->blog()->exists()) {
            return redirect()->route('blog.index')->with('danger', 'Cannot delete category as it is associated with blog.');
        }
        $category->delete();
        return redirect()->route('blog.index')->with('success', 'Blog Category deleted successfully.');
    }
    public function store(Request $request)
    {
        $this->validateBlog($request);
        $blog = new Blog();
        $blog->title = $request->title;
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $blog->slug = $slug;
        $blog->description = $request->description;
        $blog->date = $request->date;
        $blog->author = $request->author;
        $blog->blog_url = $request->blog_url;
        $blog->tags = $request->tags;
        $blog->blog_category_id = $request->blog_category_id;
        if ($request->hasFile('image')) {
            $blog->image = $this->handleFileUpload($request->file('image'), 'blog/images');
        }
        $blog->save();
        return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    }

    public function update(Request $request, $id)
    {
        $this->validateBlog($request, true, $id);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $blog->slug = $slug;
        $blog->date = $request->date;
        $blog->author = $request->author;
        $blog->blog_url = $request->blog_url;
        $blog->description = $request->description;
        $blog->tags = $request->tags;
        $blog->blog_category_id = $request->blog_category_id;
        if ($request->hasFile('image')) {
            $this->handleFileDelete($blog->image);
            $blog->image = $this->handleFileUpload($request->file('image'), 'blog/images');
        }
        $blog->save();
        return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    }


    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = !$blog->status;
        $blog->save();
        return redirect()->route('blog.index')->with('success', 'Blog status updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $this->handleFileDelete($blog->image);
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }

    private function validateBlog(Request $request, $isUpdate = false, $id = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'date' => 'nullable|date',
            'blog_url' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ];
        if (!$isUpdate) {
            $rules['title'] .= '|unique:blogs,title';
        } else {
            $rules['title'] .= '|unique:blogs,title,' . $id;
        }
        return $request->validate($rules);
    }

}
