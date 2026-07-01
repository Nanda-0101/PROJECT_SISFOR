<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Event Baru - SIVENTUS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite([
        'resources/css/dashboard_admin.css',
        'resources/css/buatEvent_admin.css',
        'resources/js/buatEvent_admin.js'
    ])
</head>
<body>

<div class="d-flex min-vh-100 layout-wrapper">

    {{-- ========================= SIDEBAR ========================= --}}
    <aside class="sidebar d-flex flex-column">

        <div class="sidebar-brand d-flex align-items-center gap-3 mb-5">
            <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" class="brand-logo">

            <div class="brand-text">
                <div class="fw-bold text-white">
                    SISTEM EVENT KAMPUS
                </div>

                <small>
                    Multi Event & Sharing Session
                </small>
            </div>
        </div>

        <div class="sidebar-menu flex-grow-1">

            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Dashboard Admin
                </div>
            </a>

            <a href="{{ route('admin.buat.event') }}" class="menu-item active">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Buat Event
                </div>
            </a>

            <a href="{{ route('admin.kelola.event') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Event.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Kelola Event
                </div>
            </a>

            <a href="{{ route('admin.kelola.panitia') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Kelola Panitia
                </div>
            </a>

            <a href="{{ route('admin.kelola.admin') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Kelola Admin.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Kelola Admin
                </div>
            </a>

            <a href="{{ route('admin.profil') }}" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="{{ asset('assets/Asset - Profil Panitia.png') }}" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    Profil Admin
                </div>
            </a>

        </div>

       <div class="sidebar-footer mt-auto">
            <a href="{{ route('admin.logout') }}" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2" style="text-decoration:none;">
                <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
            </a>
        </div>

    </aside>

    {{-- ========================= CONTENT ========================= --}}
    <main class="content-area flex-grow-1">

        <div class="page-header mb-4">
            <h2>Buat Event Baru</h2>
            <p>
                Lengkapi data event kemudian tambahkan sesi untuk event tersebut.
            </p>
        </div>

        {{-- Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-panel">

            <form
                action="{{ route('admin.store.event') }}"
                method="POST"
                id="form-event">

                @csrf

                {{-- ==================== Nama Event ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Nama Event <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="nama_event"
                        class="glass-input"
                        value="{{ old('nama_event') }}"
                        placeholder="Masukkan nama event"
                        required>
                </div>

                {{-- ==================== Tanggal ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Tanggal Event <span class="text-danger">*</span></label>
                    <input
                        type="date"
                        name="tanggal_event"
                        class="glass-input"
                        value="{{ old('tanggal_event') }}"
                        required>
                </div>

                {{-- ==================== Lokasi ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="lokasi"
                        class="glass-input"
                        value="{{ old('lokasi') }}"
                        placeholder="Lokasi Event"
                        required>
                </div>

                {{-- ==================== Deskripsi ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Deskripsi Event</label>
                    <textarea
                        name="deskripsi"
                        class="glass-input"
                        rows="4"
                        placeholder="Deskripsi Event">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- ==================== Jenis Event ==================== --}}
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Jenis Event <span class="text-danger">*</span></label>
                        <select name="jenis_event" class="glass-input" id="jenis_event" required>
                            <option value="gratis" {{ old('jenis_event') == 'gratis' ? 'selected' : '' }}>Gratis</option>
                            <option value="berbayar" {{ old('jenis_event') == 'berbayar' ? 'selected' : '' }}>Berbayar</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label">Biaya</label>
                        <input
                            type="number"
                            name="biaya"
                            id="biaya"
                            class="glass-input"
                            value="{{ old('biaya', 0) }}"
                            min="0"
                            step="1000">
                    </div>
                </div>

                {{-- ==================== Panitia ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Panitia Penanggung Jawab <span class="text-danger">*</span></label>
                    <select name="created_by" class="glass-input" required>
                        <option value="">Pilih Panitia</option>
                        @foreach($panitia as $item)
                            <option
                                value="{{ $item->id_panitia }}"
                                {{ old('created_by') == $item->id_panitia ? 'selected' : '' }}>
                                {{ $item->nama_panitia }} ({{ $item->username }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ==================== STATUS ==================== --}}
                <div class="mb-4">
                    <label class="form-label">Status Event</label>
                    <input
                        type="text"
                        class="glass-input"
                        value="Publikasi (Otomatis)"
                        readonly
                        style="background: rgba(16, 185, 129, 0.1); border-color: #10b981; color: #10b981;">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i>
                        Status otomatis menjadi <strong>Publikasi</strong> setelah event disimpan.
                    </small>
                </div>

                {{-- ======================================================== --}}
                {{-- ==================== FORM SESI ==================== --}}
                {{-- ======================================================== --}}
                <div class="mt-5 pt-3 border-top border-secondary">
                    <h4 class="mb-3">
                        <i class="bi bi-clock-history me-2"></i>
                        Tambah Sesi
                    </h4>
                    <p class="text-muted small">Tambahkan minimal 1 sesi untuk event ini.</p>

                    <div id="sesi-container">
                        {{-- Sesi 1 --}}
                        <div class="sesi-item card bg-dark bg-opacity-25 p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Sesi 1</h6>
                                <button type="button" class="btn btn-sm btn-danger remove-sesi" style="display: none;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>

                            <div class="row g-2">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Nama Sesi</label>
                                    <input type="text" name="sesi_nama[]" class="glass-input" placeholder="Contoh: Sesi Pagi" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label small">Kategori</label>
                                    <select name="sesi_kategori[]" class="glass-input" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Mulai</label>
                                    <input type="datetime-local" name="sesi_mulai[]" class="glass-input" required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Selesai</label>
                                    <input type="datetime-local" name="sesi_selesai[]" class="glass-input" required>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label small">Kuota</label>
                                    <input type="number" name="sesi_kuota[]" class="glass-input" placeholder="50" min="1" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="tambah-sesi" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Sesi
                    </button>
                </div>

                {{-- ==================== BUTTON ==================== --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn-glass-save">
                        <i class="bi bi-check-circle me-2"></i>
                        Simpan Event
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

{{-- ============================================================ --}}
{{-- SCRIPT --}}
{{-- ============================================================ --}}
<script>
document.addEventListener("DOMContentLoaded", function() {

    // ============================================================
    // TOGGLE BIAYA
    // ============================================================
    const jenis = document.getElementById("jenis_event");
    const biaya = document.getElementById("biaya");

    function toggleBiaya() {
        if (jenis.value === "gratis") {
            biaya.value = 0;
            biaya.readOnly = true;
        } else {
            biaya.readOnly = false;
        }
    }

    toggleBiaya();
    jenis.addEventListener("change", toggleBiaya);

    // ============================================================
    // TAMBAH SESI
    // ============================================================
    const container = document.getElementById("sesi-container");
    const tambahBtn = document.getElementById("tambah-sesi");
    let sesiCount = 1;

    tambahBtn.addEventListener("click", function() {
        sesiCount++;

        const sesiItem = document.createElement("div");
        sesiItem.className = "sesi-item card bg-dark bg-opacity-25 p-3 mb-3";

        sesiItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Sesi ${sesiCount}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-sesi">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </div>

            <div class="row g-2">
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Nama Sesi</label>
                    <input type="text" name="sesi_nama[]" class="glass-input" placeholder="Contoh: Sesi Pagi" required>
                </div>
                <div class="col-md-3 mb-2">
                    <label class="form-label small">Kategori</label>
                    <select name="sesi_kategori[]" class="glass-input" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Mulai</label>
                    <input type="datetime-local" name="sesi_mulai[]" class="glass-input" required>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Selesai</label>
                    <input type="datetime-local" name="sesi_selesai[]" class="glass-input" required>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label small">Kuota</label>
                    <input type="number" name="sesi_kuota[]" class="glass-input" placeholder="50" min="1" required>
                </div>
            </div>
        `;

        container.appendChild(sesiItem);

        // Event listener untuk tombol hapus
        const removeBtn = sesiItem.querySelector(".remove-sesi");
        removeBtn.addEventListener("click", function() {
            if (container.children.length > 1) {
                sesiItem.remove();
                // Renumber sesi
                document.querySelectorAll(".sesi-item").forEach((item, index) => {
                    item.querySelector("h6").textContent = `Sesi ${index + 1}`;
                });
                sesiCount = document.querySelectorAll(".sesi-item").length;
            } else {
                alert("Minimal harus ada 1 sesi!");
            }
        });
    });

    // ============================================================
    // HAPUS SESI PERTAMA (jika ada tombol)
    // ============================================================
    document.querySelectorAll(".remove-sesi").forEach(btn => {
        btn.addEventListener("click", function() {
            const parent = this.closest(".sesi-item");
            if (container.children.length > 1) {
                parent.remove();
                document.querySelectorAll(".sesi-item").forEach((item, index) => {
                    item.querySelector("h6").textContent = `Sesi ${index + 1}`;
                });
                sesiCount = document.querySelectorAll(".sesi-item").length;
            } else {
                alert("Minimal harus ada 1 sesi!");
            }
        });
    });

});
</script>

</body>
</html>