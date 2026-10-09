<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sisforkan - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            background: linear-gradient(135deg, #115e59, #1c5f6b) !important;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
            overflow: hidden;
        }
        .btn-teal {
            background-color: #1c5f6b;
            color: #fff;
            border-radius: 50rem;
            padding: 0.75rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-teal:hover {
            background-color: #115e59;
            color: #fff;
        }
        .form-control-user {
            border-radius: 50rem;
            padding: 0.8rem 1.2rem;
        }
        .bg-login-image {
            position: relative;
            background: url('https://i.pinimg.com/736x/cb/64/7e/cb647e178bbccfb7498002aa2d070f18.jpg') center center;
            background-size: cover;
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; /* Mengatur posisi box ke bawah */
            padding: 25px;
        }
        .quote-box {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(6px);
            padding: 18px 20px;
            border-radius: 0.75rem;
            color: #ffffff;
            border-left: 4px solid #1c5f6b;
            width: 100%;
        }
        .quote-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0 0 6px 0;
        }
        .quote-author {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            font-size: 0.8rem;
            color: #44afa6;
            margin: 0;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row g-0">
                            <!-- Kolom Foto & Quotes di Sebelah Kiri -->
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="quote-box">
                                    <p class="quote-text">"The more that you read, the more things you will know. The more that you learn, the more places you'll go."</p>
                                    <p class="quote-author">— Dr. Seuss</p>
                                </div>
                            </div>

                            <!-- Kolom Form Login di Sebelah Kanan -->
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="p-5 w-100">
                                    <div class="text-center mb-4">
                                        <h1 class="h4 text-gray-900 font-weight-bold">Welcome Here!</h1>
                                        <p class="text-muted small">Silakan login untuk mengakses website Sisforkan</p>
                                    </div>

                                    <form class="user" action="/sesi/login" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ Session::get('email') }}"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                placeholder="Enter The Password">
                                        </div>
                                        <button type="submit" class="btn btn-teal btn-user w-100 shadow-sm">Login</button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
