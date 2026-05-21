<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * 1. Halaman Utama (Daftar Kategori)
     */
    public function index(Request $request)
    {
        $categories = Category::query()
            ->when($request->search, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * 2. Simpan Kategori Baru (Tambah Data)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $validated['slug'] = Str::slug($request->name);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil ditambahin!');
    }

    /**
     * 3. Halaman Edit (INI YANG TADI ERROR NYARIIN FUNGSI EDIT)
     */
    public function edit(Category $category)
    {
        // Membuka halaman edit sambil membawa data kategori yang mau diedit
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * 4. Simpan Perubahan Kategori (Proses Update Data)
     */
    public function update(Request $request, Category $category)
    {
        // Validasi, kolom name wajib unik kecuali untuk kategori itu sendiri
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        // Update slug otomatis jika nama diubah
        $validated['slug'] = Str::slug($request->name);

        $category->update($validated);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * 5. Hapus Kategori (Delete Data)
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}