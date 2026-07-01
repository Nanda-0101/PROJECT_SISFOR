<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil - SIVENTUS</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #F4F7FE 0%, #E8ECF8 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .success-card {
            background: white;
            border-radius: 24px;
            padding: 50px 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(79, 57, 246, 0.15);
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .success-icon i {
            font-size: 40px;
            color: white;
        }
        .success-card h1 {
            font-size: 28px;
            font-weight: 800;
            color: #1A202C;
            margin-bottom: 8px;
        }
        .success-card .subtitle {
            color: #718096;
            font-size: 16px;
            margin-bottom: 24px;
        }
        .success-card .alert {
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }
        .btn-home {
            display: inline-block;
            padding: 12px 32px;
            background: #4F39F6;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-home:hover {
            background: #3B2BD4;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 57, 246, 0.3);
        }
        .btn-home i {
            margin-right: 8px;
        }
        .features {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #E2E8F0;
        }
        .features .item {
            text-align: center;
        }
        .features .item i {
            font-size: 24px;
            color: #4F39F6;
            display: block;
            margin-bottom: 4px;
        }
        .features .item span {
            font-size: 12px;
            color: #718096;
        }
        @media (max-width: 480px) {
            .success-card {
                padding: 30px 20px;
                margin: 20px;
            }
            .success-card h1 {
                font-size: 22px;
            }
            .features {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>
<body>

<div class="success-card">
    <div class="success-icon">
        <i class="bi bi-check-lg"></i>
    </div>

    <h1>Pendaftaran Berhasil! 🎉</h1>
    <p class="subtitle">Selamat! Anda telah berhasil mendaftar event.</p>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('landing.page') }}" class="btn-home">
        <i class="bi bi-house"></i> Kembali ke Beranda
    </a>

    <div class="features">
        <div class="item">
            <i class="bi bi-envelope"></i>
            <span>Email Konfirmasi<br>Dikirim</span>
        </div>
        <div class="item">
            <i class="bi bi-calendar-check"></i>
            <span>Cek Status<br>Pendaftaran</span>
        </div>
        <div class="item">
            <i class="bi bi-whatsapp"></i>
            <span>Info Event<br>via WhatsApp</span>
        </div>
    </div>
</div>

</body>
</html>