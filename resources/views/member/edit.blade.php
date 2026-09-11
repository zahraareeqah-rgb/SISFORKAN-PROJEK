@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-user-pen me-2"></i>Edit Data Member</h5>
            </div>

            <div class="card-body p-4">

                <div class="mb-4">
                    <label class="form-label fw-bold">Status Peminjaman Saat Ini</label>
                    <div class="border rounded p-3 bg-light">
                        @forelse($member->peminjaman as $pinjam)
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark mb-1">
                                    <i class="fa-solid fa-calendar me-1"></i> Dipinjam sejak {{ $pinjam->tanggal_pinjam }}
                                </span>
                                <ul class="mb-0 mt-1">
                                    @foreach($pinjam->pinjamanBuku as $detail)
                                        <li>{{ $detail->buku->nama_buku ?? 'Buku tidak ditemukan' }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @empty
                            <span class="text-muted"><i class="fa-solid fa-circle-check me-1"></i> Tidak sedang meminjam buku</span>
                        @endforelse
                    </div>
                </div>

                <form action="{{ route('member.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Member</label>
                        <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" value="{{ old('nama_member', $member->nama_member) }}" placeholder="Masukkan Nama Lengkap">
                        @error('nama_member') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $member->email) }}" placeholder="Masukkan Email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon', $member->no_telepon) }}" placeholder="Masukkan No. Telepon">
                            @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="" hidden>-- Pilih Jenis Kelamin --</option>
                                <option value="P" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'P' ? 'selected' : '' }}>Pria</option>
                                <option value="W" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'W' ? 'selected' : '' }}>Wanita</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir', $member->tgl_lahir) }}">
                        @error('tgl_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Member</label>
                        @if($member->foto_member)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $member->foto_member) }}" alt="Foto Lama" class="rounded border object-fit-cover" width="80" height="80">
                                <small class="text-muted d-block mt-1">*Foto saat ini. Biarkan kosong jika tidak ingin mengganti.</small>
                            </div>
                        @endif
                        <input type="file" name="foto_member" class="form-control @error('foto_member') is-invalid @enderror">
                        @error('foto_member') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between pt-2 border-top">
                        <a href="{{ route('member.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
                        <button type="submit" class="btn btn-brand"><i class="fa-solid fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
