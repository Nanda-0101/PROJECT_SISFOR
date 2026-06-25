<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Kelola Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/kelola_event.css', 'resources/js/kelola_event.js'])
</head>
<body>

<div class="d-flex min-vh-100 layout-wrapper">
    {{-- SIDEBAR (tidak diubah) --}}
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
            <a href="/admin/kelola-event" class="menu-item active">
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
            <a href="/admin/profil" class="menu-item">
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

    {{-- KONTEN UTAMA --}}
    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-white">Kelola Event</h4>
                <p class="mb-0 text-white-50">Manajemen seluruh event yang ada di sistem</p>
            </div>
            <button class="btn btn-tambah-top" id="btn-tambah-event">
                <i class="bi bi-plus-lg"></i> Tambah Event
            </button>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="filter-bar mb-3">
            <div class="position-relative flex-grow-1" style="max-width: 360px;">
                <i class="bi bi-search position-absolute" style="left: 14px; top: 50%; transform: translateY(-50%); color: #A0AEC0; font-size: 14px;"></i>
                <input type="text" class="form-control" style="padding-left: 40px; border-radius: 10px; border: 1.5px solid #E2E8F0; font-size: 14px;" placeholder="Cari nama event...">
            </div>
            <select class="form-select" style="width: auto; border-radius: 10px; border: 1.5px solid #E2E8F0; font-size: 14px; padding: 9px 36px 9px 14px; color: #4A5568;">
                <option value="">Semua Kategori</option>
                <option value="seminar">Seminar</option>
                <option value="workshop">Workshop</option>
                <option value="kompetisi">Kompetisi</option>
            </select>
            <select class="form-select" style="width: auto; border-radius: 10px; border: 1.5px solid #E2E8F0; font-size: 14px; padding: 9px 36px 9px 14px; color: #4A5568;">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        {{-- Tabel Data Event --}}
        <div class="data-card bg-white">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Event</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th style="width: 110px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-muted fw-semibold" style="font-size:13px;">01</td>
                            <td>
                                <div class="event-name-cell">
                                    <div class="event-icon">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="event-title">Seminar Teknologi 2026</div>
                                        <div class="event-subtitle">Aula Gedung A · 250 peserta</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 14px; font-weight: 500; color: #2D3748;">12 Mei 2026</div>
                                <div style="font-size: 12px; color: #A0AEC0;">09.00 – 16.00 WIB</div>
                            </td>
                            <td><span class="kategori-chip">Seminar</span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="btn-action-group">
                                    <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit Event">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" title="Hapus Event">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        {{-- Tambah baris data di sini --}}
                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            <div class="pagination-wrapper">
                <span class="pagination-info">Menampilkan 1–1 dari 1 event</span>
                <nav>
                    <ul class="pagination pagination-sm mb-0" style="gap: 4px;">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" style="border-radius: 8px; border-color: #E2E8F0; color: #A0AEC0;">&laquo;</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#" style="border-radius: 8px; background: #4F39F6; border-color: #4F39F6;">1</a>
                        </li>
                        <li class="page-item disabled">
                            <a class="page-link" href="#" style="border-radius: 8px; border-color: #E2E8F0; color: #A0AEC0;">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </main>
</div>

</body>
</html>