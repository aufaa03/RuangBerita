<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10); // Ambil semua kategori, urutkan dari terbaru
        return view('categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Menyimpan kategori baru ke dalam database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'string|max:255|unique:categories,slug',
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
            'slug.unique' => 'Kategori dengan slug ini sudah ada.',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category) // Route Model Binding
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Memperbarui kategori di database.
     */
    public function update(Request $request, Category $category) // Route Model Binding
    {
        // Validasi, pastikan nama unik tapi abaikan untuk kategori yang sedang diedit
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'Nama kategori tidak boleh kosong.',
            'name.unique' => 'Kategori dengan nama ini sudah ada.',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy(Category $category) // Route Model Binding
    {
        // Pengecekan: Jangan hapus kategori jika masih ada post yang menggunakannya
        if ($category->posts()->count() > 0) {
            return redirect()->route('categories.index')
                             ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh post.');
        }

        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}