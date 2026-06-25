<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Admin - SIVENTUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite([
        'resources/css/dashboard_admin.css', 
        'resources/css/admin/kelolaAdmin_admin.css', 
        'resources/js/admin/kelolaAdmin_admin.js'
    ])
</head>
<body>
<div class="d-flex min-vh-100 layout-wrapper">

    <aside class="sidebar d-flex flex-column">
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
        
        <div class="sidebar-menu flex-grow-1">
            <a href="#" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Dashboard Admin</span>
                </div>
            </a>

            <a href="#" class="menu-item">
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

            <a href="#" class="menu-item active">
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

        <section class="glass-panel">
            <!-- Search bar untuk kemudahan penggunaan -->
            <div class="search-wrapper mb-4">
                <input type="text" id="searchAdmin" class="glass-input" placeholder="Cari admin...">
            </div>

            <div class="glass-table-wrapper">
                <table class="glass-table" id="adminTable">
                    <thead>
                        <tr>
                            <th>Nama Super Admin</th>
                            <th>Email</th>
                            <th>Akses Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin Utama Pusat</td>
                            <td>admin.siventus@kampus.ac.id</td>
                            <td>12 Januari 2026</td>
                            <td>
                                <button class="btn-action-glass btn-edit"><i class="bi bi-pencil"></i> Edit</button>
                                <button class="btn-action-glass btn-delete"><i class="bi bi-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
</body>
</html>