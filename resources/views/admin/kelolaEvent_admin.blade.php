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
            <a href="{{ route('admin.logout') }}" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2" style="text-decoration:none;">
                <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
            </a>
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
                                @if($event->status_event == 'publikasi')
                                    <span class="badge bg-success">Publikasi</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($event->status_event) }}</span>
                                @endif
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
                                    {{-- Tombol Edit --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-primary btn-edit"
                                            title="Edit Event"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal"
                                            data-id="{{ $event->id_event }}"
                                            data-nama="{{ $event->nama_event }}"
                                            data-deskripsi="{{ $event->deskripsi }}"
                                            data-tanggal="{{ $event->tanggal_event }}"
                                            data-lokasi="{{ $event->lokasi }}"
                                            data-jenis="{{ $event->jenis_event }}"
                                            data-biaya="{{ $event->biaya }}"
                                            data-panitia="{{ $event->created_by }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>

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
{{-- MODAL EDIT --}}
{{-- ============================================================ --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil-square me-2"></i> Edit Event
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Nama Event --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Event <span class="text-danger">*</span></label>
                        <input type="text" name="nama_event" id="editNama" class="form-control" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="editDeskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- Tanggal & Lokasi --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Event <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_event" id="editTanggal" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi" id="editLokasi" class="form-control" required>
                        </div>
                    </div>

                    {{-- Jenis Event & Biaya --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Event <span class="text-danger">*</span></label>
                            <select name="jenis_event" id="editJenis" class="form-select">
                                <option value="gratis">Gratis</option>
                                <option value="berbayar">Berbayar</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Biaya</label>
                            <input type="number" name="biaya" id="editBiaya" class="form-control" min="0" step="1000">
                            <small class="text-muted">Kosongkan jika gratis</small>
                        </div>
                    </div>

                    {{-- Panitia --}}
                    <div class="mb-3">
                        <label class="form-label">Panitia Penanggung Jawab <span class="text-danger">*</span></label>
                        <select name="created_by" id="editPanitia" class="form-select" required>
                            <option value="">Pilih Panitia</option>
                            @foreach($panitia as $item)
                                <option value="{{ $item->id_panitia }}">
                                    {{ $item->nama_panitia }} ({{ $item->username }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Informasi Status (Readonly) --}}
                    <div class="mb-3">
                        <label class="form-label">Status Event</label>
                        <input type="text" class="form-control" value="Publikasi (Otomatis)" readonly style="background: #e9ecef; color: #10b981; font-weight: 600;">
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Status akan otomatis menjadi Publikasi</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
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
{{-- SCRIPT --}}
{{-- ============================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log('Halaman Kelola Event Berhasil Dimuat! 📅');

    //------------------------------------
    // EDIT MODAL
    //------------------------------------
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            // Set action form
            document.getElementById('editForm').action = '/admin/event/' + btn.dataset.id;

            // Isi field dengan data dari button
            document.getElementById('editNama').value = btn.dataset.nama || '';
            document.getElementById('editDeskripsi').value = btn.dataset.deskripsi || '';
            document.getElementById('editTanggal').value = btn.dataset.tanggal || '';
            document.getElementById('editLokasi').value = btn.dataset.lokasi || '';
            document.getElementById('editJenis').value = btn.dataset.jenis || 'gratis';
            document.getElementById('editBiaya').value = btn.dataset.biaya || 0;
            document.getElementById('editPanitia').value = btn.dataset.panitia || '';
        });
    }

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
    // TOMBOL TAMBAH EVENT
    //------------------------------------
    const btnTambah = document.getElementById('btn-tambah-event');
    if (btnTambah) {
        btnTambah.addEventListener('click', function () {
            console.log('Navigasi ke form tambah event...');
        });
    }

    //------------------------------------
    // TOGGLE BIAYA BERDASARKAN JENIS EVENT
    //------------------------------------
    const editJenis = document.getElementById('editJenis');
    const editBiaya = document.getElementById('editBiaya');

    function toggleBiaya() {
        if (editJenis.value === 'gratis') {
            editBiaya.value = 0;
            editBiaya.readOnly = true;
            editBiaya.style.backgroundColor = '#e9ecef';
        } else {
            editBiaya.readOnly = false;
            editBiaya.style.backgroundColor = '';
        }
    }

    if (editJenis) {
        editJenis.addEventListener('change', toggleBiaya);
        // Jalankan saat modal pertama kali terbuka
        const observer = new MutationObserver(function() {
            if (editModal.classList.contains('show')) {
                toggleBiaya();
            }
        });
        observer.observe(editModal, { attributes: true, attributeFilter: ['class'] });
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>