<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta</title>

    @vite([
        'resources/css/pendaftaranpeserta.css',
    ])
</head>

<body>

<div class="layout-wrapper">

    <!-- ================= SIDEBAR ================= -->

    <aside class="sidebar">

        <div class="sidebar-top">

            <div class="brand-box glass-effect">
                <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" class="brand-logo">

                <div class="brand-text">
                    <h2>SISTEM EVENT KAMPUS</h2>
                    <p>Multi Event & Sharing Session</p>
                </div>
            </div>

            <nav class="sidebar-menu">

                <a href="#" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Landing Page.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Landing Page & Info Event
                    </div>
                </a>

                <a href="#" class="menu-item active">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Pendaftaran Peserta.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Pendaftaran Peserta
                    </div>

                </a>

                <a href="#" class="menu-item">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Cek Status Pendaftaran.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Cek Status Pendaftaran
                    </div>

                </a>

                <a href="#" class="menu-item">

                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Login Admin.png') }}" class="menu-icon">
                    </div>

                    <div class="menu-text-wrapper">
                        Login Admin
                    </div>

                </a>

            </nav>

        </div>

        <div class="sidebar-bottom">

            <a href="#" class="btn-logout">
                <img src="{{ asset('assets/Asset - Logout.png') }}" class="menu-icon">
                <span>Logout</span>
            </a>

        </div>

    </aside>

    <!-- ================= CONTENT ================= -->

    <main class="main-content">

        <div class="form-card">

            <span class="badge-tag">
                FORM PUBLIK
            </span>

            <h2>Input Formulir Pendaftaran</h2>

            <form>

                <div class="form-group">

                    <label>Pilih Event <span>*</span></label>

                    <select>

                        <option>Grand Tech Annual Fest 2026</option>

                        <option>Workshop UI/UX</option>

                        <option>Seminar AI</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>NIM (Nomor Induk Mahasiswa) <span>*</span></label>

                    <input
                        type="text"
                        placeholder="Contoh : 2201010043">

                </div>

                <div class="form-group">

                    <label>Nama Lengkap <span>*</span></label>

                    <input
                        type="text"
                        placeholder="Nama sesuai KTM">

                </div>

                <div class="form-group">

                    <label>Email <span>*</span></label>

                    <input
                        type="email"
                        placeholder="nama@email.com">

                </div>

                <div class="form-group">

                    <label>No. WhatsApp</label>

                    <input
                        type="text"
                        placeholder="08123456789">

                </div>

                <div class="row">

                    <div class="form-group">

                        <label>Pilih Kategori <span>*</span></label>

                        <select>

                            <option>Internal Kampus</option>
                            <option>Umum</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>Pilih Sesi <span>*</span></label>

                        <select>

                            <option>Sesi Pagi - AI (65 kuota)</option>

                            <option>Sesi Siang - Full</option>

                        </select>

                    </div>

                </div>

                <button class="btn-submit">

                    Daftar Sekarang

                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>