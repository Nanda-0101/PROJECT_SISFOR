<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Event Baru - SIVENTUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite([
        'resources/css/dashboard_admin.css', 
        'resources/css/buatEvent_admin.css', 
        'resources/js/buatEvent_admin.js'
    ])
</head>
<body>
<div class="d-flex min-vh-100 layout-wrapper">

<aside class="sidebar d-flex flex-column" style="position: sticky; top: 0; height: 100vh; overflow-y: auto; flex-shrink: 0;">
    
    <!-- Bagian Logo & Brand -->
    <div class="sidebar-brand d-flex align-items-center gap-3 mb-5">
        <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
        <div class="brand-text d-flex flex-column justify-content-center">
            <div class="mb-0 text-white fw-bold" style="font-size: 16px;">
                SISTEM EVENT KAMPUS
            </div>
            <p class="mb-0" style="font-size: 12px;">
                Multi Event & Sharing Session
            </p>
        </div>
    </div>
    
    <!-- Bagian Menu Navigasi -->
    <div class="sidebar-menu flex-grow-1">
        <a href="#" class="menu-item">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Dashboard Admin</span>
            </div>
        </a>

        <a href="#" class="menu-item active">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" alt="Buat Event" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Buat Event</span>
            </div>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Kelola Event</span>
            </div>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" alt="Kelola Panitia" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Kelola Panitia</span>
            </div>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Kelola Admin.png') }}" alt="Kelola Admin" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Kelola Admin</span>
            </div>
        </a>

        <a href="#" class="menu-item">
            <div class="menu-icon-wrapper">
                <img src="{{ asset('assets/Asset - Profil Panitia.png') }}" alt="Profil Admin" class="menu-icon">
            </div>
            <div class="menu-text-wrapper">
                <span>Profil Admin</span>
            </div>
        </a>
    </div>


        <div class="sidebar-footer mt-auto">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2">
                    <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="content-area flex-grow-1 position-relative">
        <header class="page-header">
            <h1>Buat Event Baru</h1>
            <p>Lengkapi formulir di bawah untuk menambahkan event ke sistem</p>
        </header>

        <!-- KOTAK FORM GLASSMORPHISM -->
        <section class="glass-panel">
            <form action="{{ url('/admin/store-event') }}" method="POST" id="form-event">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nama Event</label>
                        <input type="text" name="nama_event" class="glass-input" placeholder="Masukkan nama event" required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal" class="glass-input" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="glass-input" placeholder="Contoh: Auditorium Utama" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea name="deskripsi" class="glass-input" rows="4" placeholder="Detail deskripsi event..."></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-glass-save">Simpan Event</button>
                </div>
            </form>
        </section>
    </main>

</div>

</body>
</html>