<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
   
class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', true)->get();
        $categories = ProductCategory::where('status', true)->get();
        return view('admin.product.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);

        $category = new ProductCategory();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('product.index')->with('success', 'product Category created successfully.');
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
        ]);
        $category = ProductCategory::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return redirect()->route('product.index')->with('success', 'product Category updated successfully.');
    }
    public function toggleCategoryStatus($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();
        return redirect()->route('product.index')->with('success', 'product Category status updated successfully.');
    }

    public function destroyCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('product.index')->with('success', 'product Category deleted successfully.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'link' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->link = $request->link;
        $product->product_category_id = $request->product_category_id;
        $product->save();
        return redirect()->route('product.index')->with('success', 'product created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'product_category_id' => 'nullable|exists:product_categories,id',
            'link' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->link = $request->link;
        $product->product_category_id = $request->product_category_id;
        $product->save();
        return redirect()->route('product.index')->with('success', 'product updated successfully.');
    }


    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();
        return redirect()->route('product.index')->with('success', 'product status updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'product deleted successfully.');
    }


}
