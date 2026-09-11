@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-building-user me-2"></i>Buku</h5>
        <a href="{{ route('buku.create') }}" class="btn btn-brand btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Buku</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Foto Buku</th>
                        <th>Nama Buku</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buku as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                @if($item->foto_buku)
                                    <img src="{{ asset('storage/' . $item->foto_buku) }}" alt="Foto Buku" width="50" height="50" class="rounded object-fit-cover border">
                                @else
                                    <span class="badge bg-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $item->nama_buku }}</td>
                            <td>{{ $item->kategori ? $item->kategori->nama_kategori : 'Tidak ada kategori' }}</td>
                            <td>{{ $item->pengarang }}</td>
                            <td>{{ $item->ISBN }}</td>
                            <td>{{ $item->stok }}</td>

                            <td class="text-center">
                                <a href="{{ route('buku.edit', $item->id) }}" class="btn btn-warning btn-sm text-white me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('buku.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada data Buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
