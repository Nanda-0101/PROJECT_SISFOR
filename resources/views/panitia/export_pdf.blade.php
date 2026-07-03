<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Data Peserta</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            font-size: 10pt;
            padding: 20px;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #2563eb;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18pt;
            color: #1e293b;
            font-weight: 700;
        }
        .header h2 {
            font-size: 14pt;
            color: #2563eb;
            font-weight: 600;
        }
        .header p {
            font-size: 10pt;
            color: #64748b;
        }
        .info-box {
            display: flex;
            justify-content: space-between;
            background: #f8fafc;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #2563eb;
        }
        .info-box .left {
            font-size: 10pt;
        }
        .info-box .left strong {
            color: #1e293b;
        }
        .info-box .right {
            font-size: 10pt;
            color: #64748b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }
        table thead th {
            background: #2563eb;
            color: white;
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #2563eb;
            font-weight: 600;
        }
        table tbody td {
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
        }
        table tbody tr:nth-child(even) {
            background: #f8fafc;
        }
        table tbody tr:hover {
            background: #e8f0fe;
        }
        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            font-size: 9pt;
            color: #64748b;
        }
        .footer .left {
            text-align: left;
        }
        .footer .right {
            text-align: right;
        }
        .badge-status {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: 600;
        }
        .status-terdaftar {
            background: #d1fae5;
            color: #065f46;
        }
        .status-menunggu {
            background: #fef3c7;
            color: #92400e;
        }
        .page-break {
            page-break-after: always;
        }
        @page {
            margin: 15mm;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>SISTEM INFORMASI EVENT KAMPUS</h1>
        <h2>SIVENPUS</h2>
        <p>Universitas Udayana - Fakultas Matematika dan Ilmu Pengetahuan Alam</p>
        <p style="font-size: 9pt; color: #94a3b8;">Laporan Data Peserta</p>
    </div>

    <!-- INFO -->
    <div class="info-box">
        <div class="left">
            <strong>Panitia:</strong> {{ $panitia->nama_panitia ?? 'Panitia' }}<br>
            <strong>Event:</strong> {{ $eventName }}<br>
            <strong>Sesi:</strong> {{ $sesiName }}
        </div>
        <div class="right">
            <strong>Total Peserta:</strong> {{ $totalPeserta }} orang<br>
            <strong>Tanggal Cetak:</strong> {{ $tanggalCetak }}
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th style="width:5%;">No</th>
                <th style="width:12%;">NIM</th>
                <th style="width:18%;">Nama Lengkap</th>
                <th style="width:20%;">Email</th>
                <th style="width:12%;">No. WA</th>
                <th style="width:15%;">Event</th>
                <th style="width:10%;">Kategori</th>
                <th style="width:8%;">Sesi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $index => $p)
            <tr>
                <td style="text-align:center;">{{ $index + 1 }}</td>
                <td>{{ $p->nim ?? '-' }}</td>
                <td>{{ $p->nama_lengkap ?? '-' }}</td>
                <td>{{ $p->email ?? '-' }}</td>
                <td>{{ $p->no_wa ?? '-' }}</td>
                <td>{{ $p->nama_event ?? '-' }}</td>
                <td>{{ $p->nama_kategori ?? '-' }}</td>
                <td>{{ $p->nama_sesi ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;padding:30px;color:#94a3b8;">
                    <em>Belum ada data peserta</em>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div class="left">
            <strong>Dokumen ini dicetak dari sistem SIVENPUS</strong><br>
            {{ $tanggalCetak }}
        </div>
        <div class="right">
            {{ $panitia->nama_panitia ?? 'Panitia' }}<br>
            <span style="font-size: 8pt; color: #94a3b8;">Panitia Pelaksana</span>
        </div>
    </div>

</body>
</html>