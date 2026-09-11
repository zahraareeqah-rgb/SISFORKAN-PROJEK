<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori created successfully.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori updated successfully.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        try {
            $kategori->delete();

            return redirect()->route('kategori.index')
                ->with('success', 'Kategori deleted successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('kategori.index')
                ->with('error', 'Kategori ini tidak bisa dihapus karena masih digunakan oleh data buku. Ganti kategori buku terkait terlebih dahulu, atau biarkan kategori ini tetap ada.');
        }
    }
}
