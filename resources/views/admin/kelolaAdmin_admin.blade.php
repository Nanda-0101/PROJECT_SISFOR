<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - SIVENTUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite([
        'resources/css/dashboard_admin.css',
        'resources/css/kelolaAdmin_admin.css',
        'resources/js/kelolaAdmin_admin.js'
    ])
</head>
<body>
<div class="d-flex min-vh-100 layout-wrapper">

    <aside class="sidebar d-flex flex-column" style="position: sticky; top: 0; height: 100vh; overflow-y: auto; flex-shrink: 0; width: 320px;">
    
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

        <div class="sidebar-footer mt-auto d-flex align-items-center gap-3">
            <div class="sidebar-user-avatar">SA</div>
            <div class="overflow-hidden">
                <div class="sidebar-username">Super Admin</div>
                <div class="sidebar-useremail">admin@siventus.ac.id</div>
            </div>
            <form method="POST" action="{{ url('/logout') }}" class="ms-auto m-0">
                @csrf
                <button type="submit" class="sidebar-logout" title="Keluar" style="background: transparent; border: none; padding: 0;">
                    <i class="bi bi-box-arrow-right fs-5" style="color: #EF4444;"></i>
                </button>
            </form>
        </div>

    </aside>

    <main class="main-content flex-grow-1 d-flex flex-column">

        {{-- Topbar --}}
        <div class="topbar d-flex align-items-center justify-content-between">
            <div>
                <div class="page-eyebrow">Manajemen Sistem</div>
                <h1 class="page-title">Kelola Admin</h1>
            </div>
            <button class="btn-add-admin" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                <i class="bi bi-plus-lg"></i>
                Tambah Admin
            </button>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon indigo"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="stat-value">12</div>
                    <div class="stat-label">Total Admin</div>
                </div>
                <div class="stat-trend up ms-auto"><i class="bi bi-arrow-up-short"></i> 2</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div class="stat-value">9</div>
                    <div class="stat-label">Admin Aktif</div>
                </div>
                <div class="stat-trend up ms-auto"><i class="bi bi-arrow-up-short"></i> 1</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber"><i class="bi bi-clock-history"></i></div>
                <div>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Ditambah Bulan Ini</div>
                </div>
                <div class="stat-trend neutral ms-auto"><i class="bi bi-dash"></i> 0</div>
            </div>
        </div>

        <div class="table-card">

            <div class="table-toolbar d-flex align-items-center justify-content-between gap-3">
                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="searchAdmin" class="search-input" placeholder="Cari nama atau email admin...">
                </div>
                <div class="d-flex gap-2">
                    <button class="btn-toolbar"><i class="bi bi-funnel"></i><span>Filter</span></button>
                    <button class="btn-toolbar"><i class="bi bi-download"></i><span>Export</span></button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="admin-table" id="adminTable">
                    <thead>
                        <tr>
                            <th style="width:48px;">#</th>
                            <th>Admin</th>
                            <th>Email</th>
                            <th>Akses Dibuat</th>
                            <th>Status</th>
                            <th style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="row-num">01</td>
                            <td>
                                <div class="admin-info">
                                    <div class="admin-avatar" style="--av:#6C63FF;">AU</div>
                                    <div>
                                        <div class="admin-name">Admin Utama Pusat</div>
                                        <div class="admin-role">Super Admin</div>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-muted">admin.siventus@kampus.ac.id</td>
                            <td class="cell-date"><i class="bi bi-calendar3"></i> 12 Jan 2026</td>
                            <td><span class="badge-status active">Aktif</span></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-action edit" title="Detail Admin" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn-action delete" title="Hapus Admin" data-bs-toggle="modal" data-bs-target="#modalHapusAdmin">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="row-num">02</td>
                            <td>
                                <div class="admin-info">
                                    <div class="admin-avatar" style="--av:#10B981;">DR</div>
                                    <div>
                                        <div class="admin-name">Dina Rahmawati</div>
                                        <div class="admin-role">Admin Biasa</div>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-muted">dina.r@kampus.ac.id</td>
                            <td class="cell-date"><i class="bi bi-calendar3"></i> 20 Feb 2026</td>
                            <td><span class="badge-status active">Aktif</span></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-action edit" title="Detail Admin" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn-action delete" title="Hapus Admin" data-bs-toggle="modal" data-bs-target="#modalHapusAdmin">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="row-num">03</td>
                            <td>
                                <div class="admin-info">
                                    <div class="admin-avatar" style="--av:#F59E0B;">BN</div>
                                    <div>
                                        <div class="admin-name">Budi Nugroho</div>
                                        <div class="admin-role">Admin Biasa</div>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-muted">budi.n@kampus.ac.id</td>
                            <td class="cell-date"><i class="bi bi-calendar3"></i> 05 Mar 2026</td>
                            <td><span class="badge-status inactive">Nonaktif</span></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-action edit" title="Detail Admin" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn-action delete" title="Hapus Admin" data-bs-toggle="modal" data-bs-target="#modalHapusAdmin">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer d-flex align-items-center justify-content-between">
                <div class="table-info">Menampilkan <strong>3</strong> dari <strong>12</strong> admin</div>
                <div class="pagination-wrap d-flex gap-1">
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn page-next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

        </div>

    </main>

</div>

<div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold">Tambah Admin Baru</h5>
                    <p class="modal-subtitle">Isi detail untuk membuat akun admin baru</p>
                </div>
                <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-lbl">Nama Lengkap</label>
                    <input type="text" class="form-ctrl" placeholder="Masukkan nama lengkap">
                </div>
                <div class="mb-3">
                    <label class="form-lbl">Alamat Email</label>
                    <input type="email" class="form-ctrl" placeholder="nama@kampus.ac.id">
                </div>
                <div class="mb-3">
                    <label class="form-lbl">Password</label>
                    <div class="input-icon-wrap">
                        <input type="password" class="form-ctrl" id="passwordInput" placeholder="Minimal 8 karakter">
                        <button type="button" class="btn-toggle-pw" onclick="togglePassword()">
                            <i class="bi bi-eye" id="pwIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-lbl">Role Admin</label>
                    <select class="form-ctrl form-select-ctrl">
                        <option value="">-- Pilih Role --</option>
                        <option value="super">Super Admin</option>
                        <option value="biasa">Admin Biasa</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button class="btn-modal-save">
                    <i class="bi bi-plus-circle-fill"></i> Buat Akun Admin
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content admin-modal">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title fw-bold">Detail Admin</h5>
                    <p class="modal-subtitle">Informasi lengkap akun admin</p>
                </div>
                <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-lbl">Nama Lengkap</label>
                    <input type="text" class="form-ctrl" value="Admin Utama Pusat" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-lbl">Alamat Email</label>
                    <input type="email" class="form-ctrl" value="admin.siventus@kampus.ac.id" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-lbl">Role Admin</label>
                    <input type="text" class="form-ctrl" value="Super Admin" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapusAdmin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content admin-modal text-center p-4">
            <div class="mx-auto mb-3" style="width: 60px; height: 60px; background: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
            </div>
            <h5 class="fw-bold mb-2 text-dark">Hapus Admin?</h5>
            <p class="text-muted mb-4" style="font-size: 14px;">Apakah Anda yakin ingin menghapus admin ini?</p>
            <div class="d-flex gap-2 justify-content-center">
                <button class="btn-modal-cancel w-50" data-bs-dismiss="modal">Batal</button>
                <button class="btn-modal-delete w-50">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. Toggle Password
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const icon  = document.getElementById('pwIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }

    // 2. Search Fitur
    document.getElementById('searchAdmin').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#adminTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });

    // 3. Pindah Halaman 1, 2, 3
    const pageButtons = document.querySelectorAll('.page-btn:not(.page-next)');
    pageButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            pageButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>