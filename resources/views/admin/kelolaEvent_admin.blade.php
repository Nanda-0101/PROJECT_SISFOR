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
    {{-- ========== SIDEBAR ========== --}}
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
            <a href="{{ route('admin.kelola.event') }}" class="menu-item active">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Event</span></div>
            </a>
            <a href="{{ route('admin.kelola.panitia') }}" class="menu-item">
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
            <form method="POST" action="{{ route('admin.logout') }}">
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
            <a href="{{ route('admin.buat.event') }}" class="btn btn-tambah-top">
                <i class="bi bi-plus-lg"></i> Tambah Event
            </a>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="stats-row mb-4">
            <div class="stat-card card-total">
                <div class="stat-icon"><i class="bi bi-calendar-event"></i></div>
                <div class="stat-label">Total Event</div>
                <div class="stat-value">{{ $totalEvent ?? 0 }}</div>
                <div class="stat-sub">Seluruh Event</div>
            </div>
            <div class="stat-card card-aktif">
                <div class="stat-icon"><i class="bi bi-play-circle"></i></div>
                <div class="stat-label">Event Aktif</div>
                <div class="stat-value">{{ $eventAktif ?? 0 }}</div>
                <div class="stat-sub">Status Publikasi</div>
            </div>
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
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Panitia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $index => $event)
                        <tr>
                            <td class="row-num">{{ $events->firstItem() + $index }}</td>
                            <td>
                                <div class="event-cell">
                                    <div class="event-icon-box">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <div class="event-title">{{ $event->nama_event }}</div>
                                        <div class="event-meta">
                                            @if($event->jenis_event == 'gratis')
                                                <span class="text-success">Gratis</span>
                                            @else
                                                <span class="text-primary">Rp {{ number_format($event->biaya, 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($event->tanggal_event)
                                    {{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $event->lokasi }}</td>
                            <td>
                                @if($event->jenis_event == 'gratis')
                                    <span class="badge bg-success">Gratis</span>
                                @else
                                    <span class="badge bg-warning text-dark">Berbayar</span>
                                @endif
                            </td>
                            <td>
                                @switch($event->status_event)
                                    @case('draft')
                                        <span class="badge bg-secondary">Draft</span>
                                        @break
                                    @case('publikasi')
                                        <span class="badge bg-success">Publikasi</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge bg-primary">Selesai</span>
                                        @break
                                    @case('dibatalkan')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $event->status_event }}</span>
                                @endswitch
                            </td>
                            <td>
                                @if($event->panitia)
                                    <span class="panitia-chip">
                                        {{ $event->panitia->nama_panitia }}
                                    </span>
                                @else
                                    <span class="text-danger">Belum ditentukan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-action-wrap">
                                    {{-- Tombol Selesai --}}
                                    @if($event->status_event != 'selesai')
                                        <button type="button"
                                                class="btn btn-sm btn-outline-success btn-complete"
                                                title="Tandai Selesai"
                                                data-bs-toggle="modal"
                                                data-bs-target="#completeModal"
                                                data-id="{{ $event->id_event }}"
                                                data-nama="{{ $event->nama_event }}">
                                            <i class="bi bi-check2-circle"></i>
                                        </button>
                                    @else
                                        <span class="badge bg-primary text-white px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i> Selesai
                                        </span>
                                    @endif

                                    {{-- Tombol Delete --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-delete"
                                            title="Hapus Event"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="{{ $event->id_event }}"
                                            data-nama="{{ $event->nama_event }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-calendar-x" style="font-size: 2.5rem;"></i>
                                    <p class="mt-3 mb-2">Belum ada event yang dibuat.</p>
                                    <a href="{{ route('admin.buat.event') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Buat Event Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer Tabel --}}
            @if($events->count() > 0)
            <div class="table-footer">
                <span class="table-footer-info">
                    Menampilkan {{ $events->firstItem() }}–{{ $events->lastItem() }}
                    dari {{ $events->total() }} event
                </span>
                @if($events->hasPages())
                <nav>
                    <ul class="pagination pagination-sm mb-0 gap-1">
                        {{ $events->links('pagination::bootstrap-5') }}
                    </ul>
                </nav>
                @endif
            </div>
            @endif
        </div>

    </main>
</div>

{{-- ============================================================ --}}
{{-- MODAL DELETE --}}
{{-- ============================================================ --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus event <strong id="deleteEventName"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- MODAL COMPLETE (Tandai Selesai) --}}
{{-- ============================================================ --}}
<div class="modal fade" id="completeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tandai Event Selesai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menandai event <strong id="completeEventName"></strong> sebagai <strong>SELESAI</strong>?</p>
                <p class="text-warning"><small>Status event akan berubah menjadi <strong>Selesai</strong> dan tidak dapat diubah kembali.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="completeForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check2-circle me-2"></i> Ya, Selesai
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- SCRIPT --}}
{{-- ============================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log('Halaman Kelola Event Berhasil Dimuat! 📅');

    //------------------------------------
    // DELETE MODAL
    //------------------------------------
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            document.getElementById('deleteEventName').textContent = nama;
            document.getElementById('deleteForm').action = '/admin/event/' + id;
        });
    }

    //------------------------------------
    // COMPLETE MODAL (Tandai Selesai)
    //------------------------------------
    const completeModal = document.getElementById('completeModal');
    if (completeModal) {
        completeModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            document.getElementById('completeEventName').textContent = nama;
            document.getElementById('completeForm').action = '/admin/event/complete/' + id;
        });
    }

    //------------------------------------
    // TOMBOL TAMBAH EVENT
    //------------------------------------
    const btnTambah = document.getElementById('btn-tambah-event');
    if (btnTambah) {
        btnTambah.addEventListener('click', function () {
            console.log('Navigasi ke form tambah event...');
            // window.location.href = '/admin/buat-event';
        });
    }
    document.getElementById('completeForm').action =
    "{{ url('/admin/event/complete') }}/" + id;
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>