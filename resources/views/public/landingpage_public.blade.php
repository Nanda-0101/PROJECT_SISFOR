<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Landing Page</title>
    
    @vite(['resources/css/landingpage_public.css', 'resources/js/landingpage_public.js'])
</head>
<body>

<div class="layout-wrapper">
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="brand-box glass-effect">
                <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
                <div class="brand-text">
                    <h2>SISTEM EVENT KAMPUS</h2>
                    <p>Multi Event & Sharing Session</p>
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="#" class="menu-item active">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Landing Page.png') }}" alt="icon" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        <span>Landing Page & Info Event</span>
                    </div>
                </a>

                <a href="{{ url('/pendaftaran-peserta') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Pendaftaran Peserta.png') }}" alt="icon" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        <span>Pendaftaran Peserta</span>
                    </div>
                </a>

                <a href="{{ url('/cekstatuspendaftaran-peserta') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Cek Status Pendaftaran.png') }}" alt="icon" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        <span>Cek Status Pendaftaran</span>
                    </div>
                </a>

                <a href="{{ route('admin.login') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Login Admin.png') }}" alt="icon" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        <span>Login Admin</span>
                    </div>
                </a>
            </nav>
        </div>

 
    </aside>

    <main class="main-content">
        @php
            $colors = [
                'linear-gradient(135deg,#2563EB,#1E40AF)',
                'linear-gradient(135deg,#7C3AED,#5B21B6)',
                'linear-gradient(135deg,#059669,#047857)',
                'linear-gradient(135deg,#EA580C,#C2410C)',
                'linear-gradient(135deg,#DB2777,#BE185D)',
                'linear-gradient(135deg,#0891B2,#155E75)',
                'linear-gradient(135deg,#0F766E,#115E59)',
                'linear-gradient(135deg,#6366F1,#4338CA)',
            ];
        @endphp

        @forelse($events as $index => $event)
        <div class="event-card" style="background: {{ $colors[$index % count($colors)] }};">
            <div class="badge-tag">
                {{ strtoupper($event->jenis_event) }}
                <span class="badge-status badge-publikasi"></span>
            </div>

            <h1 class="event-title">{{ $event->nama_event }}</h1>
            <p class="event-subtitle">{{ $event->deskripsi ?: 'Deskripsi event belum tersedia.' }}</p>

            <div class="event-meta">
                <div class="meta-item">
                    <img src="{{ asset('assets/Asset - Kalender.png') }}" alt="date">
                    <span>{{ \Carbon\Carbon::parse($event->tanggal_event)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="meta-item">
                    <img src="{{ asset('assets/Asset - Lokasi.png') }}" alt="location">
                    <span>{{ $event->lokasi }}</span>
                </div>
                @if($event->jenis_event == 'berbayar')
                <div class="meta-item">
                    <i class="bi bi-currency-dollar" style="color: #FBBF24;"></i>
                    <span>Rp {{ number_format($event->biaya, 0, ',', '.') }}</span>
                </div>
                @endif
            </div>

            <div class="event-detail-box">
                <h3>Informasi Event</h3>
                <div class="detail-grid">
                    <div>
                        <span class="detail-label">Jenis</span>
                        <span class="detail-value">{{ ucfirst($event->jenis_event) }}</span>
                    </div>
                    <div>
                        <span class="detail-label">Status</span>
                        <span class="detail-value text-success">Publikasi</span>
                    </div>
                    @if($event->jenis_event == 'berbayar')
                    <div>
                        <span class="detail-label">Biaya</span>
                        <span class="detail-value">Rp {{ number_format($event->biaya, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div>
                        <span class="detail-label">Total Sesi</span>
                        <span class="detail-value">{{ $event->sesi->count() }} Sesi</span>
                    </div>
                </div>
            </div>

            @if($event->sesi->count() > 0)
            <div class="sessions-grid">
                @foreach($event->sesi as $sesi)
                @php
                    $jumlahPeserta = $sesi->pendaftaran->count();
                    $full = $jumlahPeserta >= $sesi->kuota_maksimal;
                    $persentase = $sesi->kuota_maksimal > 0 ? ($jumlahPeserta / $sesi->kuota_maksimal) * 100 : 0;
                @endphp
                <div class="session-card">
                    <div class="session-header">
                        {{ $sesi->nama_sesi }}
                        <span class="session-status {{ $full ? 'status-full' : 'status-available' }}">
                            {{ $full ? 'Penuh' : 'Tersedia' }}
                        </span>
                    </div>
                    <div class="session-body">
                        <p>
                            <strong>Kategori:</strong>
                            {{ $sesi->kategori->nama_kategori ?? '-' }}
                        </p>
                        <p>
                            <strong>Waktu:</strong>
                            {{ \Carbon\Carbon::parse($sesi->waktu_mulai)->translatedFormat('d M Y H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($sesi->waktu_selesai)->translatedFormat('H:i') }}
                        </p>
                        <p>
                            <strong>Kuota:</strong>
                            <span class="kuota-number {{ $full ? 'text-danger' : 'text-success' }}">
                                {{ $jumlahPeserta }} / {{ $sesi->kuota_maksimal }}
                            </span>
                        </p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ min($persentase, 100) }}%;"></div>
                        </div>
                        @if($full)
                            <span class="status-badge status-full">Sesi Penuh</span>
                        @else
                            <a href="{{ url('/pendaftaran-peserta') }}" class="btn-daftar">Daftar Sekarang</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-center text-white-50" style="padding: 20px;">Belum ada sesi untuk event ini.</p>
            @endif
        </div>
        @empty
        <div class="event-card" style="background: linear-gradient(135deg,#64748B,#475569);">
            <div class="badge-tag">Info</div>
            <h1 class="event-title">Belum Ada Event</h1>
            <p class="event-subtitle">Saat ini belum ada event yang dipublikasikan. Silakan cek kembali nanti.</p>
            <div style="margin-top: 20px; text-align: center;">
                <a href="{{ route('admin.login') }}" class="btn-daftar" style="background: rgba(255,255,255,0.2);">
                    Login Admin untuk Membuat Event
                </a>
            </div>
        </div>
        @endforelse
    </main>
</div>

</body>
</html>