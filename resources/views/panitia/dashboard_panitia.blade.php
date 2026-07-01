<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panitia</title>

    @vite(['resources/css/dashPanitia.css'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <h2>{{ session('nama_panitia') }}</h2>
            <p>Sistem Event Kampus</p>
        </div>

        <ul class="menu">
            <li class="active">📊 Dashboard</li>
            <li>👥 Data Peserta</li>
            <li>🔒 Tutup Sesi</li>
            <li>⚙️ Profil Panitia</li>
        </ul>

    </aside>

    <!-- CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <div class="header-box">

            <div>

                <span class="badge">
                    PANITIA LEVEL
                </span>

                <h1>Dashboard Pemantauan Multi Event</h1>

                <p>
                    Monitoring seluruh data pendaftaran event kampus
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