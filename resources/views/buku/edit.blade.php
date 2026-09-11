@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-folder-plus me-2"></i>Edit Data Buku</h5>
            </div>
            <div class="card-body p-4">

            <div class="card-body p-4">
                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Buku</label>
                        <input type="text" name="nama_buku" class="form-control @error('nama_buku') is-invalid @enderror" value="{{ old('nama_buku', $buku->nama_buku) }}" placeholder="Masukkan Nama Buku">
                        @error('nama_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">ISBN</label>
                            <input type="text" name="ISBN" class="form-control @error('ISBN') is-invalid @enderror" value="{{ old('ISBN', $buku->ISBN) }}" placeholder="Contoh: 978-602-291-134-9">
                            @error('ISBN') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror">
                                <option value="" hidden>-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}" {{ old('id_kategori', $buku->id_kategori) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Pengarang</label>
                            <input type="text" name="pengarang" class="form-control @error('pengarang') is-invalid @enderror" value="{{ old('pengarang', $buku->pengarang) }}" placeholder="Masukkan Nama Pengarang">
                            @error('pengarang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok</label>
                            <input type="number" name="stok" min="0" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $buku->stok) }}" placeholder="Jumlah Stok">
                            @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Buku</label>
                        @if($buku->foto_buku)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $buku->foto_buku) }}" alt="Foto Lama" class="rounded border object-fit-cover" width="80" height="80">
                                <small class="text-muted d-block mt-1">*Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</small>
                            </div>
                        @endif
                        <input type="file" name="foto_buku" class="form-control @error('foto_buku') is-invalid @enderror">
                        @error('foto_buku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('buku.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-brand"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
