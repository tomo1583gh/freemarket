<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // キーワード検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // カテゴリ検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 商品一覧取得
        $products = $query->latest()->paginate(5);

        // カテゴリ一覧を取得
        $categories = Category::all();

        // ビューに渡す
        return view('products.index', compact('products','categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'image|nullable',
        ]);

        //画像がある場合の処理
        if ($request->hasfile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        //ログインユーザーのIDを代入
        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('user.products.index');
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
}