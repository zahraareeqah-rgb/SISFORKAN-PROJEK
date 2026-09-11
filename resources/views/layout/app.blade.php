<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
    html, body {
        height: 100%;
    }

    body {
        min-height: 100vh;
        background-image:
            linear-gradient(rgba(10, 15, 30, 0.65), rgba(10, 15, 30, 0.65)),
            url('{{ asset('storage/images/bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(4px);
        border: none;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background: linear-gradient(to right, #0a0f1e, #1c5f6b, #0a0f1e);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fa-solid fa-book-open me-2"></i>SISFORKAN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->is('kategori*') ? 'active fw-bold' : '' }}" href="{{ route('kategori.index') }}">
                            <i class="fa-solid fa-tags me-1"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->is('buku*') ? 'active fw-bold' : '' }}" href="{{ route('buku.index') }}">
                            <i class="fa-solid fa-book me-1"></i> Buku
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link {{ request()->is('member*') ? 'active fw-bold' : '' }}" href="{{ route('member.index') }}">
                            <i class="fa-solid fa-users me-1"></i> Member
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('peminjaman*') ? 'active fw-bold' : '' }}" href="{{ route('peminjaman.index') }}">
                            <i class="fa-solid fa-right-left me-1"></i> Peminjaman
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
