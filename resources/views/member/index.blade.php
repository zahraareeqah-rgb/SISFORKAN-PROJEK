@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-users me-2"></i>Data Member</h5>
        <a href="{{ route('member.create') }}" class="btn btn-brand btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Member</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Foto Member</th>
                        <th>Nama Member</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Pinjam</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($member as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>
                                @if($item->foto_member)
                                    <img src="{{ asset('storage/' . $item->foto_member) }}" alt="Foto Member" width="50" height="50" class="rounded object-fit-cover border">
                                @else
                                    <span class="badge bg-danger">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $item->nama_member }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>
                                @if($item->jenis_kelamin == 'P')
                                    <span class="badge bg-primary"><i class="fa-solid fa-person me-1"></i> Pria</span>
                                @else
                                    <span class="badge bg-danger"><i class="fa-solid fa-person-dress me-1"></i> Wanita</span>
                                @endif
                            </td>
                            <td>{{ $item->tgl_lahir }}</td>

                            <td>
                                @php
                                    $totalPinjam = $item->peminjaman->where('status', 'dipinjam')->sum(function($p) {
                                        return $p->pinjamanBuku->count();
                                    });
                                @endphp

                                @if($totalPinjam > 0)
                                    <span class="badge bg-warning text-dark mb-2">
                                        <i class="fa-solid fa-book me-1"></i>
                                        Sedang pinjam {{ $totalPinjam }} buku
                                    </span>
                                    <ul class="list-unstyled mb-0 ps-1 small text-start">
                                        @foreach($item->peminjaman->where('status', 'dipinjam') as $pinjam)
                                            @foreach($pinjam->pinjamanBuku as $detail)
                                                @if($detail->buku)
                                                    <li class="d-flex align-items-center mb-1">
                                                        @if($detail->buku->foto_buku)
                                                            <img src="{{ asset('storage/' . $detail->buku->foto_buku) }}" alt="Cover" width="24" height="32" class="rounded object-fit-cover border me-2">
                                                        @else
                                                            <span class="badge bg-secondary me-2" style="font-size: 9px; width: 24px; height: 32px; display: inline-flex; align-items: center; justify-content: center;">No Pic</span>
                                                        @endif
                                                        <span>{{ $detail->buku->nama_buku }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Tidak ada pinjaman</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('member.edit', $item->id) }}" class="btn btn-warning btn-sm text-white me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('member.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">Belum ada data member.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
