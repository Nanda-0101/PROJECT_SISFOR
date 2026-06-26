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
    {{-- ========== END SIDEBAR ========== --}}

    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Kelola Event</h4>
                <p class="mb-0 text-white-50">Manajemen seluruh event yang ada di sistem</p>
            </div>
            <button class="btn btn-tambah-top" id="btn-tambah-event">
                <i class="bi bi-plus-lg"></i> Tambah Event
            </button>
        </div>

        {{-- Stat Cards --}}
        <div class="stats-row mb-4">
            <div class="stat-card card-total">
                <div class="stat-icon"><i class="bi bi-calendar-event"></i></div>
                <div class="stat-label">Total Event</div>
                <div class="stat-value">{{ $totalEvent ?? 24 }}</div>
                <div class="stat-sub">Sepanjang tahun ini</div>
            </div>
            <div class="stat-card card-aktif">
                <div class="stat-icon"><i class="bi bi-play-circle"></i></div>
                <div class="stat-label">Aktif Sekarang</div>
                <div class="stat-value">{{ $eventAktif ?? 8 }}</div>
                <div class="stat-sub">Sedang berlangsung</div>
            </div>
            <div class="stat-card card-datang">
                <div class="stat-icon"><i class="bi bi-clock"></i></div>
                <div class="stat-label">Akan Datang</div>
                <div class="stat-value">{{ $eventMendatang ?? 6 }}</div>
                <div class="stat-sub">Dalam 30 hari ke depan</div>
            </div>
        </div>

        {{-- Filter & Search --}}
        <div class="filter-bar mb-3">
            <div class="input-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" class="form-control" placeholder="Cari nama event...">
            </div>
            <select class="form-select">
                <option value="">Semua Kategori</option>
                <option value="seminar">Seminar</option>
                <option value="workshop">Workshop</option>
                <option value="kompetisi">Kompetisi</option>
                <option value="talkshow">Talkshow</option>
            </select>
            <select class="form-select">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
                <option value="draft">Draft</option>
            </select>
        </div>

        {{-- Tabel Event --}}
        <div class="data-card bg-white rounded-3 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events ?? [] as $index => $event)
                        <tr>
                            <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="event-cell">
                                    <div class="event-icon-box">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="event-title">{{ $event->nama }}</div>
                                        <div class="event-meta">{{ $event->lokasi }} · {{ $event->kuota }} peserta</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date-primary">{{ \Carbon\Carbon::parse($event->tanggal)->isoFormat('D MMM YYYY') }}</div>
                                <div class="date-secondary">{{ $event->waktu_mulai }} – {{ $event->waktu_selesai }}</div>
                            </td>
                            <td>
                                <span class="kategori-chip chip-{{ strtolower($event->kategori) }}">{{ $event->kategori }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $event->status === 'Aktif' ? 'success' : ($event->status === 'Draft' ? 'warning' : 'secondary') }}">
                                    {{ $event->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-action-wrap">
                                    <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit Event">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" title="Hapus Event">
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
                                <div class="event-cell">
                                    <div class="event-icon-box">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="event-title">Seminar Teknologi 2026</div>
                                        <div class="event-meta">Aula Gedung A · 250 peserta</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date-primary">12 Mei 2026</div>
                                <div class="date-secondary">09.00 – 16.00 WIB</div>
                            </td>
                            <td><span class="kategori-chip chip-seminar">Seminar</span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                            <td>
                                <div class="btn-action-wrap">
                                    <button class="btn btn-sm btn-outline-primary btn-edit" title="Edit Event">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-delete" title="Hapus Event">
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
                    Menampilkan {{ isset($events) ? $events->firstItem() . '–' . $events->lastItem() : '1–1' }}
                    dari {{ isset($events) ? $events->total() : '1' }} event
                </span>
                @if(isset($events) && $events->hasPages())
                <nav>
                    <ul class="pagination pagination-sm mb-0 gap-1">
                        <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $events->previousPageUrl() }}">‹</a>
                        </li>
                        @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                        <li class="page-item {{ $page === $events->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $events->onLastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $events->nextPageUrl() }}">›</a>
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