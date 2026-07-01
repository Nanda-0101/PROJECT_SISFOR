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
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Dashboard Admin</span>
                </div>
            </a>
            <a href="{{ route('admin.buat.event') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" alt="Buat Event" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Buat Event</span>
                </div>
            </a>
            <a href="{{ route('admin.kelola.event') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Kelola Event</span>
                </div>
            </a>
            <a href="{{ route('admin.kelola.panitia') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" alt="Kelola Panitia" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Kelola Panitia</span>
                </div>
            </a>
            <a href="{{ route('admin.kelola.admin') }}" class="menu-item active">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Admin.png') }}" alt="Kelola Admin" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Kelola Admin</span>
                </div>
            </a>
            <a href="{{ route('admin.profil') }}" class="menu-item">
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
            <a href="{{ route('admin.logout') }}" class="ms-auto m-0 sidebar-logout" title="Keluar">
                <i class="bi bi-box-arrow-right fs-5" style="color: #EF4444;"></i>
            </a>
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

        {{-- Alert Notifikasi Sukses/Gagal --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon indigo"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="stat-value">{{ count($admins) }}</div>
                    <div class="stat-label">Total Admin</div>
                </div>
                <div class="stat-trend up ms-auto"><i class="bi bi-arrow-up-short"></i> Active</div>
            </div>
        </div>

        <div class="table-card">

            <div class="table-toolbar d-flex align-items-center justify-content-between gap-3">
                <div class="search-box">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="searchAdmin" class="search-input" placeholder="Cari nama admin...">
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
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th style="width:110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $index => $admin)
                        <tr>
                            <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="admin-info">
                                    <div class="admin-avatar" style="--av:#6C63FF;">
                                        {{ strtoupper(substr($admin->nama_admin, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="admin-name">{{ $admin->nama_admin }}</div>
                                        <div class="admin-role">Administrator</div>
                                    </div>
                                </div>
                            </td>
                            <td class="cell-muted">{{ $admin->username }}</td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-action edit" title="Detail Admin" data-bs-toggle="modal" data-bs-target="#modalDetailAdmin{{ $admin->id_admin }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('admin.destroy', $admin->id_admin) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->nama_admin }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Hapus Admin">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Detail Admin Dinamis --}}
                        <div class="modal fade" id="modalDetailAdmin{{ $admin->id_admin }}" tabindex="-1" aria-hidden="true">
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
                                            <input type="text" class="form-ctrl" value="{{ $admin->nama_admin }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-lbl">Username</label>
                                            <input type="text" class="form-ctrl" value="{{ $admin->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Data admin tidak ditemukan di database.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-footer d-flex align-items-center justify-content-between">
                <div class="table-info">Total <strong>{{ count($admins) }}</strong> admin terdaftar</div>
            </div>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fitur Live Search
    document.getElementById('searchAdmin').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#adminTable tbody tr').forEach(row => {
            if(!row.classList.contains('text-center')) {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            }
        });
    });
</script>

</body>
</html>