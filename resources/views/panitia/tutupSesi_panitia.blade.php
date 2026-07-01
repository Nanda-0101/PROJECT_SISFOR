<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutup Sesi - Panitia</title>

    @vite([
        'resources/css/data_peserta.css',
        'resources/css/tutupsesi_panitia.css'
    ])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-brand">
            <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
            <div class="brand-text">
                <h2>{{ session('nama_panitia') }}</h2>
                <p>Sistem Event Kampus</p>
            </div>
        </div>

        <ul class="menu sidebar-menu">
            <li>
                <a href="{{ route('panitia.dashboard') }}" class="menu-item">
                    <span class="menu-icon-wrapper"><i class="bi bi-grid menu-icon"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('panitia.data.peserta') }}" class="menu-item">
                    <span class="menu-icon-wrapper"><i class="bi bi-people menu-icon"></i></span>
                    <span class="menu-text">Data Peserta</span>
                </a>
            </li>
            <li>
                <a href="{{ route('panitia.tutup.sesi') }}" class="menu-item active">
                    <span class="menu-icon-wrapper"><i class="bi bi-lock menu-icon"></i></span>
                    <span class="menu-text">Kelola Sesi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('panitia.logout') }}" class="menu-item">
                    <span class="menu-icon-wrapper"><i class="bi bi-box-arrow-right menu-icon"></i></span>
                    <span class="menu-text">Logout</span>
                </a>
            </li>
        </ul>

    </aside>

    <!-- CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <div class="header-box">

            <div>
                <span class="badge">KELOLA SESI</span>

                <h1>Daftar Sesi Event</h1>

                <p>
                    Menutup sesi apabila kuota peserta telah terpenuhi.
                </p>
            </div>

            <div class="date-box">
                {{ now()->format('d M Y') }}
            </div>

        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- LIST SESI -->
        <div class="table-box">

            <div class="table-header">
                <h3>List Sesi Event</h3>
            </div>

            @forelse($sesis as $sesi)

                @php
                    $persen = $sesi->kuota_maksimal > 0
                        ? ($sesi->jumlah_peserta / $sesi->kuota_maksimal) * 100
                        : 0;
                @endphp

                <div class="sesi-card">

                    <div class="sesi-header">

                        <div>

                            <h4>{{ $sesi->nama_sesi }}</h4>

                            <small>
                                {{ \Carbon\Carbon::parse($sesi->waktu_mulai)->format('d M Y H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($sesi->waktu_selesai)->format('d M Y H:i') }}
                            </small>

                        </div>

                        @if($sesi->status_sesi == 'buka')
                            <span class="status-buka">
                                ● Dibuka
                            </span>
                        @else
                            <span class="status-tutup">
                                ● Ditutup
                            </span>
                        @endif

                    </div>

                    <div class="progress-info">
                        <strong>
                            {{ $sesi->jumlah_peserta }}
                            /
                            {{ $sesi->kuota_maksimal }}
                            Peserta
                        </strong>
                    </div>

                    <div class="progress">
                        <div
                            class="progress-bar"
                            style="width: {{ min($persen,100) }}%">
                        </div>
                    </div>

                    @if($sesi->status_sesi == 'buka')

                        <form
                            action="{{ route('panitia.tutup.sesi.proses', $sesi->id_sesi) }}"
                            method="POST"
                            style="margin-top:15px;">

                            @csrf

                            <button
                                type="submit"
                                class="btn-tutup-sesi"
                                onclick="return confirm('Yakin ingin menutup sesi {{ $sesi->nama_sesi }}?')">

                                Tutup Sesi

                            </button>

                        </form>

                    @else

                        <button
                            class="btn-disabled"
                            disabled
                            style="margin-top:15px;">

                            Sudah Ditutup

                        </button>

                    @endif

                </div>

            @empty

                <div class="empty-state">

                    <div class="lock-icon">
                        🔒
                    </div>

                    <h3>Belum Ada Sesi</h3>

                    <p>
                        Belum terdapat sesi event yang menjadi tanggung jawab Anda.
                    </p>

                </div>

            @endforelse

        </div>

    </main>

</div>

</body>
</html>