<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Panitia</title>

    @vite(['resources/css/data_peserta.css'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <li class="active">📊 Dashboard</li>
            <li>👥 Data Peserta</li>
            <li>📁 Export Data</li>
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
                <h2 class="indigo">150</h2>
            </div>

            <div class="card">
                <p>Sesi Aktif</p>
                <h2 class="green">4</h2>
            </div>

            <div class="card">
                <p>Total Event</p>
                <h2 class="blue">8</h2>
            </div>

            <div class="card">
                <p>Sesi Penuh</p>
                <h2 class="red">2</h2>
            </div>

        </div>

        <!-- CHART -->
        <div class="chart-box">

            <h3>Grafik Jumlah Pendaftar</h3>

            <canvas id="chartPendaftar"></canvas>

        </div>

        <!-- REKAP EVENT -->
        <div class="rekap-box">

            <h3>Rekap Per Event</h3>

            <div class="event-item">

                <div class="event-header">
                    <span>Grand Tech Annual Fest 2026</span>
                    <strong>80 / 100</strong>
                </div>

                <div class="progress">
                    <div class="progress-bar" style="width:80%"></div>
                </div>

            </div>

            <div class="event-item">

                <div class="event-header">
                    <span>Workshop Kreativitas Digital</span>
                    <strong>45 / 60</strong>
                </div>

                <div class="progress">
                    <div class="progress-bar green-bar" style="width:75%"></div>
                </div>

            </div>

            <div class="event-item">

                <div class="event-header">
                    <span>Seminar Artificial Intelligence</span>
                    <strong>65 / 100</strong>
                </div>

                <div class="progress">
                    <div class="progress-bar blue-bar" style="width:65%"></div>
                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-box">

            <div class="table-header">

                <h3>Pendaftaran Terbaru</h3>

                <button class="export-btn">
                    Export Excel
                </button>

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

                    <tr>
                        <td>2201010043</td>
                        <td>I Putu Nanda Aditya</td>
                        <td>Tech Fest</td>
                        <td>Sesi Pagi</td>
                        <td>
                            <span class="status">
                                Terdaftar
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>2201010050</td>
                        <td>Ni Made Ayu Pratiwi</td>
                        <td>Workshop Digital</td>
                        <td>Sesi Siang</td>
                        <td>
                            <span class="status">
                                Terdaftar
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>2201010060</td>
                        <td>Kadek Dwi</td>
                        <td>Seminar AI</td>
                        <td>Sesi 2</td>
                        <td>
                            <span class="status">
                                Terdaftar
                            </span>
                        </td>
                    </tr>

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
        labels: [
            'Tech Fest',
            'Workshop',
            'Seminar AI',
            'UI UX Camp'
        ],
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: [80,45,65,90]
        }]
    }
});

</script>

</body>
</html>