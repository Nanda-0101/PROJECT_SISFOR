<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIVENPUS - Panitia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-6 left-section" style="background-image: url('{{ asset('assets/Landing Page .png') }}');">
            <div class="content-left">
                <h2 id="title">Halo<br><span style="white-space: nowrap;">Panitia 👋</span></h2>
                <p id="desc">
                    SIVENPUS adalah
                </p>
            </div>
        </div>

        <div class="col-md-6 right-section">
            <div class="login-box">

                <div class="logo-container mb-2">
                    <img src="{{ asset('assets/Logo - Unud.png') }}" alt="Logo Unud" class="brand-logo">
                    <img src="{{ asset('assets/Logo - Informatika.png') }}" alt="Logo Informatika" class="brand-logo">
                </div>
                <h3 class="brand-title">SIVENPUS - PANITIA</h3>

                <h5 class="welcome-text mt-4">Selamat Datang!</h5>

                </p>

                <form method="POST" action="{{ url('/login') }}">
                    @csrf 
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3 py-2" role="alert" style="font-size: 13px;">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <input
                            type="text"
                            class="form-control"
                            name="Username"
                            placeholder="Username"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <input
                            type="Password"
                            class="form-control"
                            name="Password"
                            placeholder="Password"
                            required
                        >
                    </div>

                    <input type="hidden" name="role" value="mahasiswa">

                    <button type="submit" class="btn btn-login mt-2">
                        Login
                    </button>
                </form>

                <div class="forgot-box">
                    <p class="forgot-text">Lupa kata sandi? <a href="#" class="click-here">Klik disini</a></p>
                </div>
                    </a>
                </p>

            </div>
        </div>

    </div>
</div>

</body>
</html> 