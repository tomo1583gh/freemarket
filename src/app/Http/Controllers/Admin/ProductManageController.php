<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductManageController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); //現在ログイン中のユーザー

        $query = Product::where('user_id', $user->id)->with('user', 'category'); //自分の商品だけ取得

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', "%{$keyword}%");
        }

        $products = $query->latest()->paginate(5);

        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', '更新しました');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', '削除しました');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'image|nullable',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', '商品を登録しました。');
    }
}
