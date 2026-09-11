@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-user-plus me-2"></i>Tambah Data Member</h5>
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

                <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Member</label>
                        <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" value="{{ old('nama_member') }}" placeholder="Masukkan Nama Member">
                        @error('nama_member') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Masukkan Email Member">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" placeholder="Masukkan No. Telepon">
                        @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Pria</option>
                            <option value="W" {{ old('jenis_kelamin') == 'W' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Member</label>
                        <input type="file" name="foto_member" class="form-control @error('foto_member') is-invalid @enderror">
                        @error('foto_member') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2">
                        <a href="{{ route('member.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-brand"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
