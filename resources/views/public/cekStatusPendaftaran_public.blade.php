<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pendaftaran</title>

    @vite([
        'resources/css/cekStatusPendaftaran_public.css', 'resources/js/cekStatusPendaftaran_public.js'])
    
</head>

<body>

<div class="layout-wrapper">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="sidebar-top">

            <div class="brand-box glass-effect">
                <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" class="brand-logo">

                <div class="brand-text">
                    <h2>SISTEM EVENT KAMPUS</h2>
                    <p>Multi Event & Sharing Session</p>
                </div>
            </div>

            <nav class="sidebar-menu">

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Landing Page.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Landing Page & Info Event
                    </div>
                </a>

                <a href="#" class="menu-item">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Pendaftaran Peserta.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Pendaftaran Peserta
                    </div>

                </a>

                <a href="#" class="menu-item active">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Cek Status Pendaftaran.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Cek Status Pendaftaran
                    </div>

                </a>

                <a href="#" class="menu-item">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Login Admin.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Login Admin
                    </div>

                </a>

            </nav>

        </div>

        <div class="sidebar-bottom">

            <a href="#" class="btn-logout">
                <img src="{{ asset('assets/Asset - Logout.png') }}" class="menu-icon">
                <span>Logout</span>
            </a>

        </div>

    </aside>

    <!-- ================= CONTENT ================= -->

    <main class="main-content">

        <!-- ===== SEARCH CARD ===== -->
        <div class="search-card">

            <span class="badge-tag">CEK STATUS</span>

            <h2>Cek Status Pendaftaran</h2>
            <p class="search-desc">Masukkan NIM atau Email yang kamu gunakan saat mendaftar untuk melihat status pendaftaranmu.</p>

            <div class="search-form" id="searchForm">

                <div class="search-input-group">

                    <div class="form-group">
                        <label>NIM atau Email <span>*</span></label>
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Contoh: 2201010043 atau nama@email.com">
                    </div>

                    <div class="form-group">
                        <label>Pilih Event <span>*</span></label>
                        <select id="eventSelect">
                            <option value="">-- Pilih Event --</option>
                            <option value="grand-tech">Grand Tech Annual Fest 2026</option>
                            <option value="workshop-uiux">Workshop UI/UX</option>
                            <option value="seminar-ai">Seminar AI</option>
                        </select>
                    </div>

                </div>

                <button class="btn-search" id="btnCek" type="button">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    Cek Status
                </button>

            </div>

        </div>

        <!-- ===== RESULT AREA ===== -->
        <div class="result-area" id="resultArea" style="display:none;">

            <!-- ---- Skeleton Loader ---- -->
            <div class="skeleton-wrapper" id="skeletonLoader">
                <div class="skeleton skeleton-title"></div>
                <div class="skeleton skeleton-line"></div>
                <div class="skeleton skeleton-line short"></div>
            </div>

            <!-- ---- Status Card: Diterima ---- -->
            <div class="status-card" id="cardDiterima" style="display:none;">

                <div class="status-header status-diterima">
                    <div class="status-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div>
                        <div class="status-label">Status Pendaftaran</div>
                        <div class="status-title">DITERIMA</div>
                    </div>
                    <div class="status-pill pill-diterima">Aktif</div>
                </div>

                <div class="status-body">

                    <div class="info-grid">

                        <div class="info-item">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value" id="resultNama">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">NIM</span>
                            <span class="info-value" id="resultNIM">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value" id="resultEmail">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">No. WhatsApp</span>
                            <span class="info-value" id="resultWA">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Event</span>
                            <span class="info-value" id="resultEvent">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Sesi</span>
                            <span class="info-value" id="resultSesi">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Kategori</span>
                            <span class="info-value" id="resultKategori">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Tanggal Daftar</span>
                            <span class="info-value" id="resultTanggal">—</span>
                        </div>

                    </div>

                    <div class="ticket-divider">
                        <span>Nomor Tiket</span>
                    </div>

                    <div class="ticket-box">
                        <div class="ticket-code" id="resultTicket">—</div>
                        <p class="ticket-note">Tunjukkan kode ini kepada panitia saat check-in di lokasi acara.</p>
                    </div>

                </div>

            </div>

            <!-- ---- Status Card: Pending ---- -->
            <div class="status-card" id="cardPending" style="display:none;">

                <div class="status-header status-pending">
                    <div class="status-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <div class="status-label">Status Pendaftaran</div>
                        <div class="status-title">MENUNGGU VERIFIKASI</div>
                    </div>
                    <div class="status-pill pill-pending">Proses</div>
                </div>

                <div class="status-body">

                    <div class="info-grid">

                        <div class="info-item">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value" id="pendingNama">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">NIM</span>
                            <span class="info-value" id="pendingNIM">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Event</span>
                            <span class="info-value" id="pendingEvent">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Sesi</span>
                            <span class="info-value" id="pendingSesi">—</span>
                        </div>

                    </div>

                    <div class="info-banner banner-pending">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Pendaftaranmu sedang dalam proses verifikasi oleh panitia. Harap menunggu konfirmasi lebih lanjut melalui email.</span>
                    </div>

                </div>

            </div>

            <!-- ---- Status Card: Ditolak ---- -->
            <div class="status-card" id="cardDitolak" style="display:none;">

                <div class="status-header status-ditolak">
                    <div class="status-icon-wrap">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </div>
                    <div>
                        <div class="status-label">Status Pendaftaran</div>
                        <div class="status-title">TIDAK DITERIMA</div>
                    </div>
                    <div class="status-pill pill-ditolak">Ditolak</div>
                </div>

                <div class="status-body">

                    <div class="info-grid">

                        <div class="info-item">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value" id="ditolakNama">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">NIM</span>
                            <span class="info-value" id="ditolakNIM">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Event</span>
                            <span class="info-value" id="ditolakEvent">—</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Alasan</span>
                            <span class="info-value" id="ditolakAlasan">—</span>
                        </div>

                    </div>

                    <div class="info-banner banner-ditolak">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <span>Maaf, pendaftaranmu tidak dapat diterima. Hubungi panitia untuk informasi lebih lanjut.</span>
                    </div>

                </div>

            </div>

            <!-- ---- Status Card: Tidak Ditemukan ---- -->
            <div class="status-card" id="cardNotFound" style="display:none;">

                <div class="not-found-wrap">
                    <div class="not-found-icon">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/><line x1="11" y1="8" x2="11" y2="11"/><line x1="11" y1="14" x2="11.01" y2="14"/></svg>
                    </div>
                    <h3>Data Tidak Ditemukan</h3>
                    <p>NIM / Email yang kamu masukkan tidak tercatat dalam sistem. Pastikan data sudah benar atau coba event yang berbeda.</p>
                    <button class="btn-try-again" id="btnTryAgain">Coba Lagi</button>
                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>