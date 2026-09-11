<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PinjamanBuku;
use App\Models\Buku;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['member', 'pinjamanBuku.buku'])->latest()->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $buku = Buku::where('stok', '>', 0)->get();
        $member = Member::all();
        return view('peminjaman.create', compact('buku', 'member'));
    }

    public function store(Request $request)
    {
        // Bersihkan input id_buku dari nilai kosong (null atau string kosong)
        $request->merge([
            'id_buku' => array_filter($request->id_buku ?? [], function($value) {
                return !is_null($value) && $value !== '';
            })
        ]);

        $request->validate([
            'id_member'       => 'required|exists:member,id',
            'id_buku'         => 'required|array|min:1|max:3',
            'id_buku.*'       => 'exists:buku,id',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
        ]);

        // Hitung total buku aktif yang sedang dipinjam menggunakan query langsung ke tabel pivot
        $existingActiveBooks = PinjamanBuku::whereHas('peminjaman', function ($query) use ($request) {
            $query->where('id_member', $request->id_member)
                  ->where('status', 'dipinjam');
        })->count();

        $newBooksCount = count($request->id_buku);

        // Validasi ketat batas maksimal 3 buku
        if (($existingActiveBooks + $newBooksCount) > 3) {
            return back()->withErrors([
                'id_buku' => 'Gagal! Maksimal peminjaman adalah 3 buku. Saat ini member sudah aktif meminjam ' . $existingActiveBooks . ' buku, dan Anda mencoba meminjam ' . $newBooksCount . ' buku lagi.'
            ])->withInput();
        }

        // Validasi stok buku
        foreach ($request->id_buku as $idBuku) {
            $buku = Buku::find($idBuku);
            if (!$buku || $buku->stok <= 0) {
                return back()->withErrors([
                    'id_buku' => 'Stok buku salah satu yang dipilih sudah habis atau tidak valid.'
                ])->withInput();
            }
        }

        DB::transaction(function () use ($request) {
            $peminjaman = Peminjaman::create([
                'id_member'       => $request->id_member,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => 'dipinjam',
            ]);

            foreach ($request->id_buku as $idBuku) {
                PinjamanBuku::create([
                    'id_peminjaman' => $peminjaman->id,
                    'id_buku'       => $idBuku,
                ]);

                $buku = Buku::findOrFail($idBuku);
                $buku->decrement('stok');
            }
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman created successfully.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::with('pinjamanBuku')->findOrFail($id);
        $buku = Buku::all();
        $member = Member::all();
        return view('peminjaman.edit', compact('peminjaman', 'buku', 'member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status'          => 'required|in:dipinjam,dikembalikan',
        ]);

        DB::transaction(function () use ($request, $id) {
            $peminjaman = Peminjaman::with('pinjamanBuku')->findOrFail($id);
            $statusLama = $peminjaman->status;

            $peminjaman->update([
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => $request->status,
            ]);

            if ($statusLama === 'dipinjam' && $request->status === 'dikembalikan') {
                foreach ($peminjaman->pinjamanBuku as $detail) {
                    if ($detail->buku) {
                        $detail->buku->increment('stok');
                    }
                }
            } elseif ($statusLama === 'dikembalikan' && $request->status === 'dipinjam') {
                foreach ($peminjaman->pinjamanBuku as $detail) {
                    if ($detail->buku) {
                        $detail->buku->decrement('stok');
                    }
                }
            }
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman updated successfully.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $peminjaman = Peminjaman::with('pinjamanBuku')->findOrFail($id);

            if ($peminjaman->status === 'dipinjam') {
                foreach ($peminjaman->pinjamanBuku as $detail) {
                    if ($detail->buku) {
                        $detail->buku->increment('stok');
                    }
                }
            }

            $peminjaman->pinjamanBuku()->delete();
            $peminjaman->delete();
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman deleted successfully.');
    }
}
