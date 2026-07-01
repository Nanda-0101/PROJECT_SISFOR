<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIVENPUS - Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/login.css'])
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Left -->
        <div class="col-md-6 left-section"
             style="background-image: url('{{ asset('assets/Landing Page .png') }}');">

            <div class="content-left">
                <h2 id="title">
                    Halo<br>
                    <span style="white-space: nowrap;">Admin 👋</span>
                </h2>

                <p id="desc">
                    SIVENPUS adalah Sistem Informasi Pendaftaran Peserta Event Kampus
                    dengan Validasi Kuota dan Pembagian Sesi. Sistem ini membantu
                    panitia mengelola proses pendaftaran peserta secara terkomputerisasi,
                    mulai dari registrasi, validasi kuota, hingga pembagian sesi secara
                    otomatis sehingga proses penyelenggaraan event menjadi lebih efektif
                    dan terorganisir.
                </p>
            </div>

        </div>

        <!-- Right -->
        <div class="col-md-6 right-section">

            <div class="login-box">

                <div class="logo-container mb-2">
                    <img src="{{ asset('assets/Logo - Unud.png') }}" class="brand-logo" alt="Logo Unud">
                    <img src="{{ asset('assets/Logo - Informatika.png') }}" class="brand-logo" alt="Logo Informatika">
                </div>

                <h3 class="brand-title">
                    SIVENPUS
                </h3>

                <h5 class="welcome-text mt-4">
                    Selamat Datang!
                </h5>

                <p class="info-text">
                    Silakan login menggunakan akun Admin.
                </p>

                {{-- Alert Error --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="alert">
                        </button>

                    </div>
                @endif

                <form action="{{ url('/admin-login') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <input
                            type="text"
                            class="form-control"
                            name="username"
                            placeholder="Username"
                            value="{{ old('username') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <input
                            type="password"
                            class="form-control"
                            name="password"
                            placeholder="Password"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-login w-100">

                        Login

                    </button>

                </form>

                <div class="forgot-box mt-3">

                    <p class="forgot-text">
                        Lupa kata sandi?
                        <a href="#" class="click-here">
                            Klik di sini
                        </a>
                    </p>

                </div>

                <p class="admin-text">

                    Anda adalah Panitia?

                    <a href="{{ url('/panitia-login') }}"
                       class="toggle text-decoration-none">

                        Login di sini

                    </a>

                </p>

            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
