<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ: Menampilkan semua kategori
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('categories.index', compact('categories'));
    }

    // CREATE: Form tambah kategori (untuk view)
    public function create()
    {
        return view('categories.create');
    }

    // STORE: Simpan kategori baru
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    // READ: Menampilkan detail kategori (redirect to edit for UI)
    public function show(Category $category)
    {
        return redirect()->route('categories.edit', $category);
    }

    // UPDATE: Form edit kategori (untuk view)
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // UPDATE: Update kategori
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // DELETE: Hapus kategori
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}