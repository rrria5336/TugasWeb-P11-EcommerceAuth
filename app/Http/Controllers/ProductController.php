<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Tampilkan semua produk (public)
    public function index()
    {
        $products = Product::with('category')->inStock()->paginate(12);
        return view('products.index', compact('products'));
    }

    // Tampilkan detail produk (public)
    public function show(Product $product)
    {
        $product->load('category', 'reviews.user');
        return view('products.show', compact('product'));
    }

    // Form create produk (editor/admin only)
    public function create()
    {
        Gate::authorize('create', Product::class);
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Simpan produk baru (editor/admin only)
    public function store(Request $request)
    {
        Gate::authorize('create', Product::class);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Form edit produk (editor/admin only)
    public function edit(Product $product)
    {
        Gate::authorize('update', $product);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update produk (editor/admin only)
    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Hapus produk (admin only)
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}