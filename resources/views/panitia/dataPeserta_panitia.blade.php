<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta - Panitia</title>

    @vite(['resources/css/data_peserta.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ============================================================ */
        /* FILTER BAR */
        /* ============================================================ */
        .filter-bar {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .filter-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-item label {
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            margin-bottom: 0;
        }

        .filter-item select {
            padding: 8px 14px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: white;
            font-size: 13px;
            color: #1e293b;
            min-width: 180px;
            transition: all 0.3s ease;
        }

        .filter-item select:focus {
            border-color: #4F39F6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 57, 246, 0.1);
        }

        .filter-item select:hover {
            border-color: #4F39F6;
        }

        .total-badge {
            background: #4F39F6;
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-left: auto;
        }

        /* ============================================================ */
        /* TABLE HEADER - EXPORT BUTTONS */
        /* ============================================================ */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0;
        }

        .btn-export-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-export {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-export::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
        }

        .btn-export:hover::before {
            left: 100%;
        }

        .btn-export i {
            font-size: 16px;
        }

        /* ============================================================ */
        /* EXPORT PDF - RED */
        /* ============================================================ */
        .btn-export-pdf {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-export-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
            color: white;
        }

        .btn-export-pdf:active {
            transform: translateY(0);
        }

        /* ============================================================ */
        /* EXPORT EXCEL - GREEN */
        /* ============================================================ */
        .btn-export-csv {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-export-csv:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-export-csv:active {
            transform: translateY(0);
        }

        /* ============================================================ */
        /* TABLE STYLING */
        /* ============================================================ */
        .table-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .table-box table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .table-box table thead th {
            background: #f1f5f9;
            color: #475569;
            padding: 12px 15px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-box table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }

        .table-box table tbody tr:hover {
            background: #f8fafc;
        }

        .table-box table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-box table tbody td strong {
            color: #4F39F6;
            font-weight: 600;
        }

        .status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #dbeafe;
            color: #1e40af;
        }

        /* ============================================================ */
        /* RESPONSIVE */
        /* ============================================================ */
        @media (max-width: 768px) {
            .table-header {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-export-group {
                flex-wrap: wrap;
            }

            .btn-export {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-item {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-item select {
                width: 100%;
                min-width: unset;
            }

            .total-badge {
                margin-left: 0;
                text-align: center;
            }

            .table-box {
                padding: 15px;
                overflow-x: auto;
            }
        }

        @media (max-width: 480px) {
            .btn-export {
                font-size: 12px;
                padding: 8px 14px;
            }

            .btn-export i {
                font-size: 14px;
            }

            .table-box table {
                font-size: 12px;
            }

            .table-box table thead th,
            .table-box table tbody td {
                padding: 8px 10px;
            }
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

                <h3>
                    <i class="bi bi-people-fill me-2" style="color: #4F39F6;"></i>
                    Data Peserta
                </h3>

                <div class="btn-export-group">
                    {{-- Export PDF --}}
                    <a href="{{ route('panitia.data.peserta.export-pdf', request()->query()) }}"
                       class="btn-export btn-export-pdf" target="_blank">
                        <i class="bi bi-filetype-pdf"></i>
                        <span>Export PDF</span>
                    </a>

                    {{-- Export CSV --}}
                    <a href="{{ route('panitia.data.peserta.export', request()->query()) }}"
                       class="btn-export btn-export-csv">
                        <i class="bi bi-file-earmark-excel"></i>
                        <span>Export Excel</span>
                    </a>
                </div>

            </div>

            <!-- FILTER -->
            <form
                method="GET"
                action="{{ route('panitia.data.peserta') }}"
                id="formFilter">

                <div class="filter-bar">

                    <div class="filter-item">

                        <label>
                            <i class="bi bi-calendar-event me-1"></i> Event
                        </label>

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


                    <span class="total-badge">
                        <i class="bi bi-people me-1"></i>
                        {{ $peserta->count() }} Peserta
                    </span>

                </div>

            </form>

            <!-- TABLE -->
            <div class="table-responsive">
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
                                <a href="mailto:{{ $p->email }}" style="color: #4F39F6; text-decoration: none;">
                                    {{ $p->email }}
                                </a>
                            </td>

                            <td>
                                <a href="tel:{{ $p->no_wa }}" style="color: #1e293b; text-decoration: none;">
                                    {{ $p->no_wa ?? '-' }}
                                </a>
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

                            <td style="font-size: 12px; color: #64748b;">

                                {{ \Carbon\Carbon::parse($p->waktu_daftar)->format('d-m-Y H:i') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                style="text-align:center;padding:35px;color:#64748b;">

                                <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                Belum ada peserta pada event Anda.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </main>

</div>

</body>
</html>