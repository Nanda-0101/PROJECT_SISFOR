<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/profil_admin.css', 'resources/js/profil_admin.js'])
</head>
<body>

<div class="d-flex min-vh-100 layout-wrapper">
    <aside class="sidebar d-flex flex-column">
        <div class="sidebar-brand d-flex align-items-center gap-3 mb-5">
            <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
            <div class="brand-text d-flex flex-column justify-content-center">
                <div class="mb-0 text-white fw-bold" style="font-size: 16px;">SISTEM EVENT KAMPUS</div>
                <p class="mb-0" style="font-size: 12px;">Multi Event & Sharing Session</p>
            </div>
        </div>
        
        <div class="sidebar-menu flex-grow-1">
            <a href="/admin/dashboard" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Dashboard Admin</span></div>
            </a>
            <a href="/admin/buat-event" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" alt="Buat Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Buat Event</span></div>
            </a>
            <a href="/admin/kelola-event" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Event</span></div>
            </a>
            <a href="/admin/kelola-panitia" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" alt="Kelola Panitia" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Panitia</span></div>
            </a>
            <a href="/admin/kelola-admin" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Admin.png') }}" alt="Kelola Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Admin</span></div>
            </a>
            <a href="/admin/profil" class="menu-item active">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Profil Panitia.png') }}" alt="Profil Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Profil Admin</span></div>
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

    <main class="content-area flex-grow-1">
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Profil Admin</h4>
                <p class="mb-0 text-white-50">Kelola informasi pribadi dan pengaturan akun Anda</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-card bg-white p-4 rounded-3 shadow-sm border border-light">
                    <form id="form-profil">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control custom-input" name="name" value="Admin Utama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control custom-input" name="email" value="admin@siventus.com" required>
                        </div>
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3">Ubah Password (Opsional)</h6>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password Baru</label>
                            <input type="password" class="form-control custom-input" name="password" placeholder="Masukkan password baru">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-simpan">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>