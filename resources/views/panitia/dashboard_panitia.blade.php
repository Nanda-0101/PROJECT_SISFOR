<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta - Panitia</title>

    @vite(['resources/css/dashPanitia.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        .filter-bar{
            display:flex;
            gap:20px;
            align-items:center;
            margin-bottom:20px;
            flex-wrap:wrap;
        }

        .filter-item{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .filter-item select{
            padding:8px 12px;
            border-radius:8px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="wrapper">

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
                <a href="{{ route('panitia.dashboard') }}" class="menu-item active">
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
                <a href="{{ route('panitia.tutup.sesi') }}" class="menu-item">
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

                <span class="badge">
                    DASHBOARD PANITIA
                </span>

                <h1>Pemantauan Multi Event</h1>

                <p>
                    Monitoring seluruh data event kampus
                </p>

            </div>

            <div class="date-box">
                {{ now()->format('d M Y') }}
            </div>

        </div>

        <!-- CARD -->
        <div class="cards">

            <div class="card">
                <p>Total Pendaftar</p>
                <h2 class="indigo">
                    {{ $totalPeserta }}
                </h2>
            </div>

            <div class="card">
                <p>Sesi Aktif</p>
                <h2 class="green">
                    {{ $sesiAktif }}
                </h2>
            </div>

            <div class="card">
                <p>Total Event</p>
                <h2 class="blue">
                    {{ $totalEvent }}
                </h2>
            </div>

            <div class="card">
                <p>Sesi Penuh</p>
                <h2 class="red">
                    {{ $sesiPenuh }}
                </h2>
            </div>

        </div>

        <!-- CHART -->
        <div class="chart-box">

            <h3>Grafik Jumlah Pendaftar per Event</h3>

            <canvas id="chartPendaftar"></canvas>

        </div>

        <!-- REKAP EVENT -->
        <div class="rekap-box">

            <h3>Rekap Per Event</h3>

            @forelse($rekapEvent as $event)

                @php
                    $persen = ($event->kuota > 0)
                        ? round(($event->peserta / $event->kuota) * 100)
                        : 0;
                @endphp

                <div class="event-item">

                    <div class="event-header">

                        <span>{{ $event->nama_event }}</span>

                        <strong>
                            {{ $event->peserta }} / {{ $event->kuota }}
                        </strong>

                    </div>

                    <div class="progress">

                        <div
                            class="progress-bar"
                            style="width: {{ $persen }}%">
                        </div>

                    </div>

                </div>

            @empty

                <p>Tidak ada data event.</p>

            @endforelse

        </div>

        <!-- TABLE -->
        <div class="table-box">

            <div class="table-header">

                <h3>Pendaftaran Terbaru</h3>

                <a href="{{ route('panitia.data.peserta') }}" class="export-btn">
                    Lihat Semua
                </a>

            </div>

            <table>

                <thead>

                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Event</th>
                        <th>Sesi</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($pendaftaranTerbaru as $row)

                    <tr>

                        <td>{{ $row->nim }}</td>

                        <td>{{ $row->nama }}</td>

                        <td>{{ $row->nama_event }}</td>

                        <td>{{ $row->nama_sesi }}</td>

                        <td>

                            <span class="status">

                                {{ ucfirst(str_replace('_',' ', $row->status_pendaftaran)) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" style="text-align:center">
                            Belum ada data pendaftaran.
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

<script>

const ctx = document.getElementById('chartPendaftar');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: @json($grafik->pluck('nama_event')),

        datasets: [{

            label: 'Jumlah Pendaftar',

            data: @json($grafik->pluck('total'))

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: true

            }

        },

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

</body>
</html>