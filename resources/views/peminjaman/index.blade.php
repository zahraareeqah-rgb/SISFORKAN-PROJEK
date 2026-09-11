@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-right-left me-2"></i>Data Peminjaman</h5>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-brand btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Peminjaman</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nama Member</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjaman as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $item->member ? $item->member->nama_member : 'Member tidak ditemukan' }}
                            </td>

                            <td>
                                @if($item->pinjamanBuku && $item->pinjamanBuku->count() > 0)
                                    @foreach($item->pinjamanBuku as $detail)
                                        <span class="badge bg-secondary mb-1">
                                            {{ $detail->buku ? $detail->buku->nama_buku : 'Buku tidak ditemukan' }}
                                        </span><br>
                                    @endforeach
                                @else
                                    <span class="text-muted italic">Tidak ada buku</span>
                                @endif
                            </td>

                            <td class="{{ $item->status == 'dikembalikan' ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $item->tanggal_pinjam }}
                            </td>

                            <td class="{{ $item->status == 'dikembalikan' ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $item->tanggal_kembali ?? '-' }}
                            </td>

                            <td class="text-center">
                                @if($item->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @else
                                    <span class="badge bg-success">Dikembalikan</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-warning btn-sm text-white me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('peminjaman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
