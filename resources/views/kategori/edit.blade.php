@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-folder-pen me-2"></i>Edit Data Kategori</h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan Nama Kategori">
                        @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('kategori.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-brand"><i class="fa-solid fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
