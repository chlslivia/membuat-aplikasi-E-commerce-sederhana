<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // READ: Menampilkan semua produk
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('products.index', compact('categories'));
    }

    // CREATE: Form tambah produk (untuk view)
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // STORE: Simpan produk baru
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
    }

    // READ: Menampilkan detail produk (redirect to edit for UI)
    public function show(Product $product)
    {
        return redirect()->route('products.edit', $product);
    }

    // UPDATE: Form edit produk (untuk view)
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    // UPDATE: Update produk
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // DELETE: Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
} 