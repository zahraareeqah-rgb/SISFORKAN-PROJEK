@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-right-left me-2"></i>Tambah Data Peminjaman</h5>
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-brand mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Member</label>
                        <select name="id_member" class="form-select @error('id_member') is-invalid @enderror">
                            <option value="" hidden>-- Pilih Member --</option>
                            @foreach($member as $m)
                                <option value="{{ $m->id }}" {{ old('id_member') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nama_member }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_member') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Buku</label>
                        <select name="id_buku[]" class="form-select @error('id_buku') is-invalid @enderror" required>
                            <option value="" hidden>-- Pilih Buku --</option>
                            @foreach($buku as $item)
                                <option value="{{ $item->id }}" {{ old('id_buku.0') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_buku }} (Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted d-block mt-1">Pilih satu buku untuk peminjaman ini.</small>
                        @error('id_buku') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam') }}">
                            @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali') }}">
                            @error('tanggal_kembali') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between pt-2">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
