<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Kelola Sesi</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/tutupsesi_panitia.css', 'resources/js/tutupsesi_panitia.js'])
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
            <a href="{{ url('/admin/dashboard') }}" class="menu-item">
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

            <a href="#" class="menu-item active">
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

            <a href="#" class="menu-item">
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

        <div class="sidebar-footer mt-auto">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2">
                    <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Kelola Sesi Event</h4>
                <p class="mb-0 text-white-50">Tutup sesi secara manual apabila kapasitas fisik ruangan sudah penuh!</p>
            </div>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout-top fw-bold">Logout</button>
            </form>
        </div>

        <div class="tutup-sesi-card">

            <div class="text-center tutup-sesi-header mb-4">
                <div class="lock-icon-wrapper mx-auto mb-3">
                    <i class="bi bi-lock-fill"></i>
                </div>
                <h3 class="fw-bold tutup-sesi-title mb-2">Tutup Sesi Manual</h3>
                <p class="tutup-sesi-subtitle">
                    Digunakan apabila kuota fisik di ruangan sudah penuh sebelum<br>kapasitas database habis.
                </p>
            </div>

            <div id="sesiContainer">

                <div id="emptyState" class="text-center py-5 {{ isset($sesis) && count($sesis) > 0 ? 'd-none' : '' }}">
                    <i class="bi bi-calendar-x empty-state-icon"></i>
                    <p class="text-muted mt-3 mb-0 fw-medium">Pilih event untuk melihat sesi yang tersedia</p>
                </div>

                <div id="loadingState" class="text-center py-5 d-none">
                    <div class="spinner-border text-primary" role="status" style="width: 2.5rem; height: 2.5rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted mt-3 mb-0 fw-medium">Memuat data sesi...</p>
                </div>

                <div class="row g-3" id="sesiGrid">
                    @isset($sesis)
                        @forelse($sesis as $sesi)
                            <div class="col-md-6">
                                <div class="sesi-card {{ $sesi->status === 'tutup' ? 'sesi-card-closed' : '' }}">
                                    <h5 class="sesi-name">{{ $sesi->nama_sesi }}</h5>
                                    <p class="sesi-info">
                                        {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }} |
                                        {{ $sesi->jumlah_terisi }}/{{ $sesi->kapasitas }} terisi
                                    </p>
                                    <div class="mb-3">
                                        @if($sesi->status === 'buka')
                                            <span class="badge-status badge-buka">
                                                <span class="status-dot dot-buka"></span> Buka
                                            </span>
                                        @else
                                            <span class="badge-status badge-tutup">
                                                <span class="status-dot dot-tutup"></span> Tutup
                                            </span>
                                        @endif
                                    </div>
                                    @if($sesi->status === 'buka')
                                        <button class="btn-tutup-sesi w-100"
                                                data-sesi-id="{{ $sesi->id }}"
                                                data-sesi-nama="{{ $sesi->nama_sesi }}">
                                            Tutup Sesi Ini
                                        </button>
                                    @else
                                        <button class="btn-sudah-ditutup w-100" disabled>
                                            Sudah Ditutup
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-calendar-x empty-state-icon"></i>
                                <p class="text-muted mt-3 mb-0 fw-medium">Tidak ada sesi untuk event ini</p>
                            </div>
                        @endforelse
                    @endisset
                </div>

            </div>{{-- end #sesiContainer --}}
        </div>{{-- end .tutup-sesi-card --}}

    </main>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content confirm-modal-content">
            <div class="modal-body text-center p-5">
                <div class="confirm-icon-wrapper mx-auto mb-3">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h5 class="fw-bold mb-2" id="confirmModalLabel">Konfirmasi Tutup Sesi</h5>
                <p class="text-muted mb-1">
                    Apakah Anda yakin ingin menutup sesi
                </p>
                <p class="fw-bold modal-sesi-nama-text mb-3" id="modalSesiNama"></p>
                <p class="text-danger mb-4" style="font-size: 13px;">
                    <i class="bi bi-info-circle me-1"></i>
                    Pendaftar baru tidak akan bisa mendaftar ke sesi ini setelah ditutup.
                </p>
                <div class="d-flex gap-3 justify-content-center">
                    <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <button type="button" class="btn-confirm-modal" id="btnConfirmTutup">
                        <span class="confirm-text">
                            <i class="bi bi-lock-fill me-1"></i> Ya, Tutup Sesi
                        </span>
                        <span class="confirm-loading d-none">
                            <span class="spinner-border spinner-border-sm me-1" role="status"></span> Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="successToast" class="toast align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex align-items-center px-3 py-2 gap-2">
            <i class="bi bi-check-circle-fill text-success fs-5"></i>
            <span id="toastMessage" class="toast-body ps-0">Sesi berhasil ditutup!</span>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>