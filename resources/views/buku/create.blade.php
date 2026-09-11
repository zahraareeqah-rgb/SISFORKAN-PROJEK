@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-book-medical me-2"></i>Tambah Data Buku</h5>
            </div>
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Buku</label>
                        <input type="text" name="nama_buku" class="form-control @error('nama_buku') is-invalid @enderror" value="{{ old('nama_buku') }}" placeholder="Masukkan Nama Buku">
                        @error('nama_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pengarang</label>
                        <input type="text" name="pengarang" class="form-control @error('pengarang') is-invalid @enderror" value="{{ old('pengarang') }}" placeholder="Masukkan Nama Pengarang">
                        @error('pengarang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Kategori</label>
                        <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror">
                            <option value="" hidden>-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}" {{ old('id_kategori') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ISBN</label>
                            <input type="text" name="ISBN" class="form-control @error('ISBN') is-invalid @enderror" value="{{ old('ISBN') }}" placeholder="Contoh: 978-602-291-134-9">
                            @error('ISBN') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" min="0" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="Jumlah Stok">
                            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Buku</label>
                        <input type="file" name="foto_buku" class="form-control @error('foto_buku') is-invalid @enderror">
                        @error('foto_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2">
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-brand"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
