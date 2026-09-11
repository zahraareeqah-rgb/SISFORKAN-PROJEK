@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-right-left me-2"></i>Edit Data Peminjaman</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Member</label>
                            <input type="text" class="form-control" value="{{ $peminjaman->member->nama_member ?? '-' }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Buku yang Dipinjam</label>
                            <div class="form-control bg-light" style="height: auto; min-height: 38px;">
                                <ul class="mb-0 ps-3">
                                    @forelse($peminjaman->pinjamanBuku as $detail)
                                        <li>{{ $detail->buku->nama_buku ?? 'Buku tidak ditemukan' }}</li>
                                    @empty
                                        <li class="text-muted">Tidak ada buku</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Pinjam</label>
                            <input type="text" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}">
                            @error('tanggal_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
