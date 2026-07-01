<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta - Panitia</title>

    @vite(['resources/css/data_peserta.css'])
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
                <a href="{{ route('panitia.data.peserta') }}" class="menu-item active">
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
                    DATA PESERTA
                </span>

                <h1>Daftar Peserta</h1>

                <p>
                    Daftar peserta pada event yang menjadi tanggung jawab Anda.
                </p>

            </div>

            <div class="date-box">
                {{ now()->format('d M Y') }}
            </div>

        </div>

        <!-- TABLE -->
        <div class="table-box">

            <div class="table-header">

                <h3>Data Peserta</h3>

                <<a href="{{ route('panitia.data.peserta.export', request()->query()) }}"
                    class="export-btn">
                    ⬇ Export Excel
                </a>

            </div>

            <!-- FILTER -->

            <form
                method="GET"
                action="{{ route('panitia.data.peserta') }}"
                id="formFilter">

                <div class="filter-bar">

                    <div class="filter-item">

                        <label>Event</label>

                        <select
                            name="event"
                            onchange="document.getElementById('formFilter').submit()">

                            <option value="">
                                Semua Event
                            </option>

                            @foreach($events as $event)

                                <option
                                    value="{{ $event->id_event }}"
                                    {{ request('event') == $event->id_event ? 'selected' : '' }}>

                                    {{ $event->nama_event }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="filter-item">

                        <label>Sesi</label>

                        <select
                            name="sesi"
                            onchange="document.getElementById('formFilter').submit()">

                            <option value="">
                                Semua Sesi
                            </option>

                            @foreach($sesiList as $sesi)

                                <option
                                    value="{{ $sesi->id_sesi }}"
                                    {{ request('sesi') == $sesi->id_sesi ? 'selected' : '' }}>

                                    {{ $sesi->nama_sesi }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </form>

            <!-- TABLE -->

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

                        <td>
                            <strong>{{ $p->nim }}</strong>
                        </td>

                        <td>
                            {{ $p->nama_lengkap }}
                        </td>

                        <td>
                            {{ $p->email }}
                        </td>

                        <td>
                            {{ $p->no_wa ?? '-' }}
                        </td>

                        <td>
                            {{ $p->nama_event }}
                        </td>

                        <td>

                            <span class="status">

                                {{ $p->nama_kategori }}

                            </span>

                        </td>

                        <td>
                            {{ $p->nama_sesi }}
                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($p->waktu_daftar)->format('d-m-Y H:i') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            style="text-align:center;padding:35px;color:#64748b;">

                            Belum ada peserta pada event Anda.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>