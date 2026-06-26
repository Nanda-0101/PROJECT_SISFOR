<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Kelola Panitia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/kelola_panitia.css', 'resources/js/kelola_panitia.js'])
</head>
<body>

<div class="d-flex min-vh-100 layout-wrapper">
    {{-- ========== SIDEBAR (tidak diubah) ========== --}}
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
            <a href="/admin/kelola-panitia" class="menu-item active">
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
    {{-- ========== END SIDEBAR ========== --}}

    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Kelola Panitia</h4>
                <p class="mb-0 text-white-50">Kelola data dan hak akses panitia event</p>
            </div>
            <button class="btn btn-tambah-top" id="btn-tambah-panitia">
                <i class="bi bi-person-plus-fill"></i> Tambah Panitia
            </button>
        </div>

        {{-- Filter & Search --}}
        <div class="filter-bar mb-3">
            <div class="input-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cari nama atau email panitia...">
            </div>
            <select class="form-select">
                <option value="">Semua Divisi</option>
                <option value="acara">Acara</option>
                <option value="logistik">Logistik</option>
                <option value="humas">Humas</option>
                <option value="publikasi">Publikasi</option>
                <option value="konsumsi">Konsumsi</option>
            </select>
        </div>

        {{-- Tabel Panitia --}}
        <div class="data-card bg-white rounded-3 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Panitia</th>
                            <th>Email</th>
                            <th>Divisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($panitia ?? [] as $index => $p)
                        <tr>
                            <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="panitia-cell">
                                    <div class="panitia-avatar">
                                        {{ strtoupper(substr($p->name, 0, 1)) }}{{ strtoupper(substr(strstr($p->name, ' '), 1, 1)) }}
                                    </div>
                                    <div>
                                        <div class="panitia-name">{{ $p->name }}</div>
                                        <div class="panitia-role">Anggota Aktif</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="email-text">
                                    <i class="bi bi-envelope me-1" style="color:#CBD5E0;"></i>
                                    {{ $p->email }}
                                </span>
                            </td>
                            <td>
                                <span class="divisi-badge divisi-{{ strtolower($p->divisi) }}">{{ $p->divisi }}</span>
                            </td>
                            <td>
                                <div class="btn-action-wrap">
                                    <button class="btn btn-sm btn-outline-info btn-detail" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- Baris contoh (hapus saat data sudah dari database) --}}
                        <tr>
                            <td class="row-num">01</td>
                            <td>
                                <div class="panitia-cell">
                                    <div class="panitia-avatar">BS</div>
                                    <div>
                                        <div class="panitia-name">Budi Santoso</div>
                                        <div class="panitia-role">Anggota Aktif</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="email-text">
                                    <i class="bi bi-envelope me-1" style="color:#CBD5E0;"></i>
                                    budi@mahasiswa.ac.id
                                </span>
                            </td>
                            <td><span class="divisi-badge divisi-acara">Acara</span></td>
                            <td>
                                <div class="btn-action-wrap">
                                    <button class="btn btn-sm btn-outline-info btn-detail" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer Tabel --}}
            <div class="table-footer">
                <span class="table-footer-info">
                    Menampilkan {{ isset($panitia) ? $panitia->firstItem() . '–' . $panitia->lastItem() : '1–1' }}
                    dari {{ isset($panitia) ? $panitia->total() : '1' }} panitia
                </span>
                @if(isset($panitia) && $panitia->hasPages())
                <nav>
                    <ul class="pagination pagination-sm mb-0 gap-1">
                        <li class="page-item {{ $panitia->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $panitia->previousPageUrl() }}">‹</a>
                        </li>
                        @foreach($panitia->getUrlRange(1, $panitia->lastPage()) as $page => $url)
                        <li class="page-item {{ $page === $panitia->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $panitia->onLastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $panitia->nextPageUrl() }}">›</a>
                        </li>
                    </ul>
                </nav>
                @else
                <nav>
                    <ul class="pagination pagination-sm mb-0 gap-1">
                        <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item disabled"><a class="page-link" href="#">›</a></li>
                    </ul>
                </nav>
                @endif
            </div>
        </div>

    </main>
</div>

</body>
</html>