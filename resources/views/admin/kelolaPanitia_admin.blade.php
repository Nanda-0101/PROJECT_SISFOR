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
    
    <aside class="sidebar d-flex flex-column">
        <div class="sidebar-brand d-flex align-items-center gap-3 mb-5">
            <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
            <div class="brand-text d-flex flex-column justify-content-center">
                <div class="mb-0 text-white fw-bold" style="font-size: 16px;">SISTEM EVENT KAMPUS</div>
                <p class="mb-0" style="font-size: 12px;">Multi Event & Sharing Session</p>
            </div>
        </div>
        
        <div class="sidebar-menu flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Dashboard Admin</span></div>
            </a>
            <a href="{{ route('admin.buat.event') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" alt="Buat Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Buat Event</span></div>
            </a>
            <a href="{{ route('admin.kelola.event') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Event</span></div>
            </a>
            <a href="{{ route('admin.kelola.panitia') }}" class="menu-item active">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" alt="Kelola Panitia" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Panitia</span></div>
            </a>
            <a href="{{ route('admin.kelola.admin') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Admin.png') }}" alt="Kelola Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Admin</span></div>
            </a>
            <a href="{{ route('admin.profil') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Profil Panitia.png') }}" alt="Profil Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Profil Admin</span></div>
            </a>
        </div>

        <div class="sidebar-footer mt-auto">
            <a href="{{ route('admin.logout') }}" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2" style="text-decoration:none;">
                <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
            </a>
        </div>
    </aside>

    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Kelola Panitia</h4>
                <p class="mb-0 text-white-50">Kelola data dan hak akses panitia event</p>
            </div>
            <button class="btn btn-tambah-top" data-bs-toggle="modal" data-bs-target="#modalTambahPanitia">
                <i class="bi bi-person-plus-fill"></i> Tambah Panitia
            </button>
        </div>

        {{-- Alert Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Filter & Search --}}
        <div class="filter-bar mb-3">
            <div class="input-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" id="searchPanitia" class="form-control" placeholder="Cari nama atau username panitia...">
            </div>
            <select class="form-select" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        {{-- Tabel Panitia --}}
        <div class="data-card bg-white rounded-3 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="panitiaTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Panitia</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($panitias as $index => $p)
                        <tr data-status="{{ $p->status }}">
                            <td class="row-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="panitia-cell">
                                    <div class="panitia-avatar">
                                        {{ strtoupper(substr($p->nama_panitia, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="panitia-name">{{ $p->nama_panitia }}</div>
                                        <div class="panitia-role">Panitia Event</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="email-text">
                                    <i class="bi bi-person me-1" style="color:#CBD5E0;"></i>
                                    {{ $p->username }}
                                </span>
                            </td>
                            <td>
                                @if($p->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-action-wrap">
                                    <button
                                        class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailPanitia{{ $p->id_panitia }}"
                                        title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <form action="{{ route('panitia.destroy', $p->id_panitia) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus panitia {{ $p->nama_panitia }}?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- ============================================================ --}}
                        {{-- MODAL DETAIL PANITIA --}}
                        {{-- ============================================================ --}}
                        <div class="modal fade" id="detailPanitia{{ $p->id_panitia }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="bi bi-person-circle me-2"></i> Detail Panitia
                                        </h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Nama Panitia</label>
                                            <input class="form-control" value="{{ $p->nama_panitia }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Username</label>
                                            <input class="form-control" value="{{ $p->username }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Status</label>
                                            <input class="form-control" value="{{ ucfirst($p->status) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="fw-bold">Bergabung</label>
                                            <input class="form-control" value="{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y H:i') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                Data panitia tidak tersedia di database.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer Tabel --}}
            <div class="table-footer">
                <span class="table-footer-info">
                    Total: {{ count($panitias) }} panitia terdaftar
                </span>
            </div>
        </div>

    </main>
</div>

{{-- ============================================================ --}}
{{-- MODAL TAMBAH PANITIA --}}
{{-- ============================================================ --}}
<div class="modal fade" id="modalTambahPanitia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('panitia.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-person-plus-fill me-2"></i> Tambah Panitia
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Panitia <span class="text-danger">*</span></label>
                        <input type="text" name="nama_panitia" class="form-control" placeholder="Masukkan nama panitia" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                        <small class="text-muted">Username harus unik dan tidak boleh sama dengan yang lain.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="text" name="password" class="form-control" placeholder="Masukkan password" required>
                        <small class="text-muted">Minimal 4 karakter.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ============================================================
    // FITUR LIVE SEARCH PANITIA
    // ============================================================
    document.getElementById('searchPanitia').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#panitiaTable tbody tr:not(.text-center)').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(q) ? '' : 'none';
        });
    });

    // ============================================================
    // FITUR FILTER STATUS
    // ============================================================
    document.getElementById('filterStatus').addEventListener('change', function () {
        const status = this.value;
        document.querySelectorAll('#panitiaTable tbody tr:not(.text-center)').forEach(row => {
            if (status === '') {
                row.style.display = '';
            } else {
                row.style.display = row.dataset.status === status ? '' : 'none';
            }
        });
    });
</script>
</body>
</html>