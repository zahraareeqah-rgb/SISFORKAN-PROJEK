<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::with(['peminjaman' => function ($query) {
            $query->where('status', 'dipinjam');
        }, 'peminjaman.pinjamanBuku.buku'])->get();

        return view('member.index', compact('member'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_member'     => 'required|string|max:255',
            'email'           => 'required|email|unique:member,email',
            'no_telepon'      => 'nullable|string|max:20',
            'jenis_kelamin'   => 'required|in:P,W',
            'tgl_lahir'       => 'nullable|date',
            'foto_member'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_member')) {
            $validatedData['foto_member'] = $request->file('foto_member')->store('member_images', 'public');
        }

        Member::create([
            'nama_member'   => $validatedData['nama_member'],
            'email'         => $validatedData['email'],
            'no_telepon'    => $validatedData['no_telepon'] ?? null,
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'tgl_lahir'     => $validatedData['tgl_lahir'] ?? null,
            'foto_member'   => $validatedData['foto_member'] ?? null,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member created successfully.');
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        $peminjaman = Peminjaman::where('id_member', $id)
            ->with('pinjamanBuku.buku')
            ->latest()
            ->get();

        return view('member.show', compact('member', 'peminjaman'));
    }

    public function edit($id)
    {
        $member = Member::with(['peminjaman' => function ($query) {
            $query->where('status', 'dipinjam');
        }, 'peminjaman.pinjamanBuku.buku'])->findOrFail($id);

        return view('member.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_member'     => 'required|string|max:255',
            'email'           => 'required|email|unique:member,email,' . $id,
            'no_telepon'      => 'nullable|string|max:20',
            'jenis_kelamin'   => 'required|in:P,W',
            'tgl_lahir'       => 'nullable|date',
            'foto_member'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = Member::findOrFail($id);

        if ($request->hasFile('foto_member')) {
            if ($member->foto_member && Storage::disk('public')->exists($member->foto_member)) {
                Storage::disk('public')->delete($member->foto_member);
            }

            $validatedData['foto_member'] = $request->file('foto_member')->store('member_images', 'public');
        }

        $member->update([
            'nama_member'   => $validatedData['nama_member'],
            'email'         => $validatedData['email'],
            'no_telepon'    => $validatedData['no_telepon'] ?? null,
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'tgl_lahir'     => $validatedData['tgl_lahir'] ?? null,
            'foto_member'   => $validatedData['foto_member'] ?? $member->foto_member,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = Member::with('peminjaman')->findOrFail($id);

        // Pengecekan: Apakah member masih memiliki buku dengan status 'dipinjam'
        $adaPeminjamanAktif = $member->peminjaman()->where('status', 'dipinjam')->exists();

        if ($adaPeminjamanAktif) {
            return redirect()->route('member.index')
                ->with('error', 'Gagal menghapus! Member ini masih memiliki buku yang sedang dipinjam.');
        }

        // Hapus foto jika ada
        if ($member->foto_member && Storage::disk('public')->exists($member->foto_member)) {
            Storage::disk('public')->delete($member->foto_member);
        }

        $member->delete();

        return redirect()->route('member.index')
            ->with('success', 'Member deleted successfully.');
    }
}
