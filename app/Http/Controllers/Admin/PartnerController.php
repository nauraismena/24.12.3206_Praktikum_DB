<?php

namespace App\Http\Controllers\Admin;

// 💡 SEKARANG SUDAH AMAN: Mengimpor Controller utama agar tidak eror 'Class not found'
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    // TAMPIL DATA
    public function index(Request $request)
{
    $search = $request->input('search');
    
    // Fitur filter berdasarkan nama partner (Soal 3)
    $partners = Partner::when($search, function ($query, $search) {
        return $query->where('name', 'LIKE', "%{$search}%");
    })->latest()->get();

    return view('admin.partners.index', compact('partners'));
}

    // TAMBAH DATA
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required'
        ]);

        Partner::create([
            'name' => $request->name,
            'logo_url' => $request->logo_url
        ]);

        return redirect('/admin/partners')
            ->with('success', 'Partner berhasil ditambahkan');
    }

    // HALAMAN EDIT
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // UPDATE DATA 
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required',
            'logo_url' => 'required'
        ]);

        $partner->update([
            'name' => $request->name,
            'logo_url' => $request->logo_url
        ]);

        return redirect('/admin/partners')
            ->with('success', 'Partner berhasil diupdate');
    }

    // HAPUS DATA
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect('/admin/partners')
            ->with('success', 'Partner berhasil dihapus');
    }
}