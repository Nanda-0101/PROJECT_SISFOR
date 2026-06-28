
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutup Sesi – Panitia</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite([
        'resources/css/data_peserta.css',
        'resources/css/tutupsesi_panitia.css',
        'resources/js/tutupsesi_panitia.js'
    ])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <h2>PANITIA</h2>
            <p>Sistem Event Kampus</p>
        </div>

        <ul class="menu">
            <li><a href="/panitia-dashboard">📊 Dashboard</a></li>
            <li><a href="/panitia-data-peserta">👥 Data Peserta</a></li>
            <li class="active">🔒 Tutup Sesi</li>
            <li><a href="/panitia-profil">⚙️ Profil Panitia</a></li>
        </ul>

    </aside>

    <!-- CONTENT -->
    <main class="main-content">

    <!-- HEADER -->
    <div class="header-box">
        <div>
            <span class="badge">TUTUP SESI</span>
            <h1>Kelola Sesi Event</h1>
            <p>Menutup sesi secara manual apabila kapasitas fisik ruangan sudah penuh</p>
        </div>

        <div class="date-box">
            {{ now()->format('d M Y') }}
        </div>
    </div>

    <!-- CARD -->
    <div class="cards">

        <div class="card">
            <p>Total Sesi</p>
            <h2 class="indigo">{{ count($sesis ?? []) }}</h2>
        </div>

        <div class="card">
            <p>Sesi Dibuka</p>
            <h2 class="green">
                {{ collect($sesis ?? [])->where('status','buka')->count() }}
            </h2>
        </div>

        <div class="card">
            <p>Sesi Ditutup</p>
            <h2 class="red">
                {{ collect($sesis ?? [])->where('status','tutup')->count() }}
            </h2>
        </div>

        <div class="card">
            <p>Total Peserta</p>
            <h2 class="blue">
                {{ collect($sesis ?? [])->sum('jumlah_terisi') }}
            </h2>
        </div>

    </div>

    <!-- BOX -->
    <div class="table-box">

        <div class="table-header">
            <h3>Daftar Sesi Event</h3>
        </div>

        @if(isset($sesis) && count($sesis))

            <div class="sesi-grid">

                @foreach($sesis as $sesi)

                <div class="sesi-card">

                    <h4>{{ $sesi->nama_sesi }}</h4>

                    <p>
                        {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }}
                    </p>

                    <p>
                        {{ $sesi->jumlah_terisi }}/{{ $sesi->kapasitas }}
                        Peserta
                    </p>

                    @if($sesi->status == 'buka')

                        <span class="status-buka">
                            ● Buka
                        </span>

                        <button
                            class="btn-tutup-sesi"
                            data-sesi-id="{{ $sesi->id }}"
                            data-sesi-nama="{{ $sesi->nama_sesi }}"
                        >
                            Tutup Sesi
                        </button>

                    @else

                        <span class="status-tutup">
                            ● Ditutup
                        </span>

                        <button
                            class="btn-disabled"
                            disabled
                        >
                            Sudah Ditutup
                        </button>

                    @endif

                </div>

                @endforeach

            </div>

        @else

            <div class="empty-state">

                <div class="lock-icon">
                    🔒
                </div>

                <h3>Tutup Sesi Manual</h3>

                <p>
                    Pilih event untuk melihat sesi yang tersedia
                </p>

            </div>

        @endif

    </div>

</main>

        <!-- DAFTAR SESI -->
        <div class="table-box">

            <div class="table-header">
                <h3>Daftar Sesi Event</h3>

                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="export-btn">
                        Logout
                    </button>
                </form>
            </div>

            @if(isset($sesis) && count($sesis) > 0)

                <div class="row g-4 mt-1">

                    @foreach($sesis as $sesi)

                        <div class="col-md-6">

                            <div class="sesi-card-custom">

                                <h5 class="fw-bold mb-2">
                                    {{ $sesi->nama_sesi }}
                                </h5>

                                <p class="text-muted mb-2">
                                    <i class="bi bi-clock"></i>
                                    {{ \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i') }}
                                </p>

                                <p class="mb-3">
                                    <strong>
                                        {{ $sesi->jumlah_terisi }}/{{ $sesi->kapasitas }}
                                    </strong>
                                    peserta terdaftar
                                </p>

                                @if($sesi->status === 'buka')

                                    <span class="badge bg-success mb-3">
                                        Sesi Dibuka
                                    </span>

                                    <button
                                        class="btn btn-danger w-100 btn-tutup-sesi"
                                        data-sesi-id="{{ $sesi->id }}"
                                        data-sesi-nama="{{ $sesi->nama_sesi }}"
                                    >
                                        🔒 Tutup Sesi
                                    </button>

                                @else

                                    <span class="badge bg-secondary mb-3">
                                        Sesi Ditutup
                                    </span>

                                    <button
                                        class="btn btn-secondary w-100"
                                        disabled
                                    >
                                        Sudah Ditutup
                                    </button>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div style="padding:60px; text-align:center;">
                    <i class="bi bi-calendar-x fs-1 text-secondary"></i>
                    <p class="mt-3 text-muted">
                        Tidak ada sesi tersedia.
                    </p>
                </div>

            @endif

        </div>

    </main>

</div>

<!-- MODAL KONFIRMASI -->
<div class="modal fade" id="confirmModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body text-center p-4">

                <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>

                <h5 class="mt-3 fw-bold">
                    Konfirmasi Tutup Sesi
                </h5>

                <p class="text-muted mb-1">
                    Apakah Anda yakin ingin menutup sesi:
                </p>

                <p class="fw-bold" id="modalSesiNama"></p>

                <div class="d-flex justify-content-center gap-2 mt-4">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="button"
                        class="btn btn-danger"
                        id="btnConfirmTutup"
                    >
                        Ya, Tutup Sesi
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
```
