<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        return view('buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto_buku'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_buku'   => 'required|string|max:255',
            'pengarang'   => 'required|string|max:255',
            'ISBN'        => 'required|string|max:20|unique:buku,ISBN',
            'stok'        => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id',
        ]);

        if ($request->hasFile('foto_buku')) {
            $validatedData['foto_buku'] = $request->file('foto_buku')->store('buku_images', 'public');
        }

        Buku::create($validatedData);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();

        return view('buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'foto_buku'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_buku'   => 'required|string|max:255',
            'pengarang'   => 'required|string|max:255',
            'ISBN'        => 'required|string|max:20|unique:buku,ISBN,' . $id,
            'stok'        => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id',
        ]);

        $buku = Buku::findOrFail($id);

        if ($request->hasFile('foto_buku')) {
            if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)) {
                Storage::disk('public')->delete($buku->foto_buku);
            }

            $validatedData['foto_buku'] = $request->file('foto_buku')->store('buku_images', 'public');
        }

        $buku->update($validatedData);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        try {
            if ($buku->foto_buku && Storage::disk('public')->exists($buku->foto_buku)) {
                Storage::disk('public')->delete($buku->foto_buku);
            }

            $buku->delete();

            return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus!');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('buku.index')
                ->with('error', 'Buku ini tidak bisa dihapus karena masih memiliki riwayat peminjaman. Hapus dulu data peminjaman terkait, atau biarkan buku ini tetap ada untuk menjaga riwayat.');
        }
    }
}
