<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    // 商品詳細表示
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品登録画面表示
    public function create()
    {
        return view('products.create');
    }

    // 商品登録処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // 画像のアップロード処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images/products');
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        } else{
            $imagePath = null;
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    // 商品更新処理
    public function update(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = Product::findOrFail($productId);

        //画像のアップロード処理
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            //新しい画像を保存
            $imagePath = $request->file('image')->store('public/images/products');
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        } else {
            $imagePath = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.show', $productId)->with('success', '商品を更新しました');
    }

    // 商品削除処理
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

    // 商品検索・並び替え
    public function search(Request $request)
    {
        $query = Product::query();

        $sortLabel = null;

        // 商品名検索
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 並び替え
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'search' => $request->search,
            'sort' => $request->sort,
            'sortLabel' => $sortLabel,
        ]);
    }
}
