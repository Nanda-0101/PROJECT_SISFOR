<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta – Panitia</title>

    @vite(['resources/css/data_peserta.css'])

  <style>
        .filter-bar {
            display: flex !important;
            flex-direction: row !important;
            gap: 16px !important;
            margin-bottom: 20px !important;
            align-items: center !important;
        }

        .filter-item {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            gap: 8px !important;
        }
    </style>

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
    <li class="active">👥 Data Peserta</li>
    <li><a href="/panitia-tutup-sesi">🔒 Tutup Sesi</a></li>
    <li><a href="/panitia-profil">⚙️ Profil Panitia</a></li>
</ul>

    </aside>

    <!-- CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <div class="header-box">
            <div>
                <span class="badge">DATA PESERTA</span>
                <h1>Daftar Peserta Terdaftar</h1>
                <p>Monitoring seluruh data pendaftaran event kampus</p>
            </div>
            <div class="date-box">
                {{ now()->format('d M Y') }}
            </div>
        </div>

        <!-- CARD -->
        <div class="cards">
            <div class="card">
                <p>Total Peserta</p>
                <h2 class="indigo">{{ $totalPeserta }}</h2>
            </div>
            <div class="card">
                <p>Total Event</p>
                <h2 class="blue">{{ $totalEvent }}</h2>
            </div>
            <div class="card">
                <p>Total Sesi</p>
                <h2 class="green">{{ $totalSesi }}</h2>
            </div>
            <div class="card">
                <p>Sesi Penuh</p>
                <h2 class="red">{{ $sesiPenuh }}</h2>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-box">

            <div class="table-header">
                <h3>Daftar Peserta Terdaftar</h3>
                <a href="#" class="export-btn">⬇ Ekspor Data</a>
            </div>

            <!-- FILTER -->
            <form id="formFilter" method="GET" action="/panitia-data-peserta">

                <div class="filter-bar">

                    <div class="filter-item">
                        <label>Filter Event:</label>
                        <select name="event" onchange="document.getElementById('formFilter').submit()">
                            <option value="">Semua Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event') == $event->id ? 'selected' : '' }}>
                                    {{ $event->nama_event }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-item">
                        <label>Filter Sesi:</label>
                        <select name="sesi" onchange="document.getElementById('formFilter').submit()">
                            <option value="">Semua Sesi</option>
                            @foreach($sesiList as $sesi)
                                <option value="{{ $sesi->id }}" {{ request('sesi') == $sesi->id ? 'selected' : '' }}>
                                    {{ $sesi->nama_sesi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </form>

            <table>

                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No. WA</th>
                        <th>Event</th>
                        <th>Kategori</th>
                        <th>Sesi</th>
                        <th>Waktu Daftar</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($peserta as $p)
                    <tr>
                        <td><strong>{{ $p->nim }}</strong></td>
                        <td>{{ $p->nama_lengkap }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->no_wa ?? '–' }}</td>
                        <td>{{ $p->event->nama_event ?? '–' }}</td>
                        <td>
                            <span class="status">{{ $p->kategori }}</span>
                        </td>
                        <td>{{ $p->sesi->nama_sesi ?? '–' }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:40px; color:#94a3b8;">
                            Tidak ada data peserta.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- PAGINATION -->
            <div class="pagination-wrap">
                {{-- pagination --}}
            </div>

        </div>

    </main>

</div>

</body>
</html>