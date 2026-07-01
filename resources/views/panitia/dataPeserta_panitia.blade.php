<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <title>Data Peserta</title>

    @vite(['resources/css/data_peserta.css'])

</head>
<body>

<div class="wrapper">

    <aside class="sidebar">

        <div class="logo">

            <h2>{{ session('nama_panitia') }}</h2>

            <p>Sistem Event Kampus</p>

        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('panitia.dashboard') }}">
                    📊 Dashboard
                </a>
            </li>

            <li class="active">
                👥 Data Peserta
            </li>



            <li>
                🔒 Tutup Sesi
            </li>

            <li>
                ⚙️ Profil Panitia
            </li>

        </ul>

    </aside>

    <main class="main-content">

        <div class="header-box">

            <div>

                <h2>Data Peserta</h2>

                <p>
                    Daftar peserta pada event yang Anda kelola.
                </p>

            </div>

        </div>

        <div class="table-box">

            <table>

                <thead>

                <tr>

                    <th>No</th>

                    <th>NIM</th>

                    <th>Nama</th>

                    <th>Event</th>

                    <th>Sesi</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                @forelse($peserta as $index => $row)

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $row->nim }}</td>

                        <td>{{ $row->nama }}</td>

                        <td>{{ $row->nama_event }}</td>

                        <td>{{ $row->nama_sesi }}</td>

                        <td>

                            <span class="status">

                                {{ ucfirst($row->status_pendaftaran) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" style="text-align:center">

                            Belum ada peserta.

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