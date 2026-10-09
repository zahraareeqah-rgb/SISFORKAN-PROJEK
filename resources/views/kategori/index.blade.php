@extends('layout.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold text-brand"><i class="fa-solid fa-users me-2"></i>Data Kategori</h5>
        <a href="{{ route('kategori.create') }}" class="btn btn-brand btn-sm"><i class="fa-solid fa-plus me-1"></i> Tambah Data Kategori</a>
    </div>
    <div class="px-3 pt-3 pb-2">
        <form action="{{ url()->current() }}" method="GET">
            <div class="input-group w-100">
                <input type="text" name="search" class="form-control shadow-none" placeholder="Cari data..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
                @if(request('search'))
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nama Kategori</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $index => $item)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item->nama_kategori }}</td>
                            <td class="text-center">
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-warning btn-sm text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Belum ada data manager.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (alertEl) {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
            bsAlert.close();
        });
    }, 5000);
</script>
<div class="px-3 py-3 border-top bg-white d-flex justify-content-end">
    {{ $kategori->appends(request()->query())->links() }}
</div>
@endsection
