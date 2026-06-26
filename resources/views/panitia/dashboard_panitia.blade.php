<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIVENPUS - Dashboard Panitia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/dashPanitia-CcmZzLND.css') }}">
    <script type="module" src="{{ asset('build/assets/app-DMRtMKZ6.js') }}"></script>
</head>
<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-icon">S</div>
                <div>
                    <p class="brand-label">Sistem Event Kampus</p>
                    <p class="brand-subtitle">Multi Event & Sharing Session</p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="/panitia-dashboard" class="nav-item active">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard Panitia</span>
                </a>
                <a href="/panitia-data-peserta" class="nav-item">
                    <span class="nav-icon">👥</span>
                    <span>Data Peserta</span>
                </a>
                <a href="/panitia-tutup-sesi" class="nav-item">
                    <span class="nav-icon">🔒</span>
                    <span>Tutup Sesi Manual</span>
                </a>
                <a href="/panitia-profil" class="nav-item">
                    <span class="nav-icon">👤</span>
                    <span>Profil Panitia</span>
                </a>
            </nav>

            <a href="/panitia-login" class="logout-button">Log Out</a>
        </aside>

        <main class="main-panel">
            <header class="header-card">
                <div>
                    <p class="header-label">Selamat Datang di Dashboard Panitia</p>
                    <p class="header-description">Lakukan Pemantauan pada Multi Event Disini!</p>
                </div>
                <a href="/panitia-login" class="header-logout">Logout</a>
            </header>

            <section class="stats-grid">
                <article class="stat-card card-primary">
                    <p class="stat-value">100</p>
                    <p class="stat-name">Mahasiswa</p>
                    <p class="stat-note">Total Pendaftar<br>Ini merupakan total dari pendaftar event pada saat ini.</p>
                </article>
                <article class="stat-card card-secondary">
                    <p class="stat-value">50</p>
                    <p class="stat-name">Sesi</p>
                    <p class="stat-note">Sesi Aktif Terbuka<br>Ini merupakan total dari sesi event terbuka pada saat ini.</p>
                </article>
            </section>

            <section class="recap-card">
                <div class="recap-header">Rekap Per Event</div>
                <div class="recap-list">
                    <div class="recap-item">
                        <span>Grand Tech Annual Fest 2026</span>
                        <span>180 Pendaftar</span>
                    </div>
                    <div class="recap-item">
                        <span>Workshop Kreativitas Digital</span>
                        <span>190 Pendaftar</span>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
