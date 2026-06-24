<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Landing Page</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/landingpage_public.css', 'resources/js/landingpage_public.js']); ?>
</head>
<body>

    <div class="layout-wrapper">
        <aside class="sidebar">
    <div class="sidebar-top">
        <div class="brand-box glass-effect">
            <img src="<?php echo e(asset('assets/Logo - SIVENTUS.png')); ?>" alt="Logo SIVENTUS" class="brand-logo">
            <div class="brand-text">
                <h2>SISTEM EVENT KAMPUS</h2>
                <p>Multi Event & Sharing Session</p>
            </div>
        </div>

        <nav class="sidebar-menu">
            <a href="#" class="menu-item active">
                <div class="menu-icon-wrapper">
                    <img src="<?php echo e(asset('assets/Asset - Landing Page.png')); ?>" alt="icon" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Landing Page & Info Event</span>
                </div>
            </a>

            <a href="#" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="<?php echo e(asset('assets/Asset - Pendaftaran Peserta.png')); ?>" alt="icon" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Pendaftaran Peserta</span>
                </div>
            </a>

            <a href="#" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="<?php echo e(asset('assets/Asset - Cek Status Pendaftaran.png')); ?>" alt="icon" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Cek Status Pendaftaran</span>
                </div>
            </a>

            <a href="#" class="menu-item">
                <div class="menu-icon-wrapper">
                    <img src="<?php echo e(asset('assets/Asset - Login Admin.png')); ?>" alt="icon" class="menu-icon">
                </div>
                <div class="menu-text-wrapper">
                    <span>Login Admin</span>
                </div>
            </a>
        </nav>
    </div>

    <div class="sidebar-bottom">
        <a href="#" class="btn-logout">
            <img src="<?php echo e(asset('assets/Asset - Logout.png')); ?>" alt="icon" class="menu-icon">
            <span>Log Out</span>
        </a>
    </div>
</aside>

        <main class="main-content">
            
            <div class="event-card">
                <div class="badge-tag">Event Technology - Annual Fest 2026</div>
                <h1 class="event-title">Grand Tech Annual Fest 2026</h1>
                <p class="event-subtitle">Acara tahunan teknologi terbesar di Indonesia.</p>
                
                <div class="event-meta">
                    <div class="meta-item">
                        <img src="<?php echo e(asset('assets/Asset - Kalender.png')); ?>" alt="date">
                        <span>30 Februari, 2026</span>
                    </div>
                    <div class="meta-item">
                        <img src="<?php echo e(asset('assets/Asset - Lokasi.png')); ?>" alt="location">
                        <span>Aula Lantai 4, Lecture Building</span>
                    </div>
                </div>

                <div class="event-detail-box">
                    <h3>Detail Acara & Kategori Kepesertaan</h3>
                    <p>Acara ini dibagi menjadi beberapa sesi, silahkan pilih sesi yang diinginkan!</p>
                </div>

                <div class="sessions-grid">
                    <div class="session-card">
                        <div class="session-header bg-blue">Sesi Pagi - Dasar AI (09.40 - 12.00)</div>
                        <div class="session-body">
                            <p><strong>Pembicara :</strong> Putu Nanda Aditya S,SI</p>
                            <p><strong>Quota Terpenuhi :</strong> 90 / 100 Slot</p>
                            <span class="status-badge status-available">Sesi Tersedia</span>
                        </div>
                    </div>

                    <div class="session-card">
                        <div class="session-header bg-blue">Sesi Siang - Implementasi Algoritma Fuzzy Logic (14.00 - 16.00)</div>
                        <div class="session-body">
                            <p><strong>Pembicara :</strong> Putu Nanda Aditya S,SI</p>
                            <p><strong>Quota Terpenuhi :</strong> 100 / 100 Slot</p>
                            <span class="status-badge status-full">Sesi Tidak Tersedia</span>
                        </div>
                    </div>

                    <div class="speaker-profile">
                        <img src="https://ui-avatars.com/api/?name=Nanda+Aditya&background=0D8ABC&color=fff" alt="Profile" class="profile-img">
                        <div class="profile-info">
                            <h4>I Putu Nanda Aditya</h4>
                            <p>Seorang yang memiliki kelebihan di bidang pemrograman dan menguasai algoritma Fuzzy Logic</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="event-card-full mt-4">
    <div class="badge-tag">Workshop Ektif - Workshop Digital 2026</div>
    <h1 class="event-title">Workshop Kreativitas Digital</h1>
    <p class="event-subtitle">Eksplorasi kreativitas mahasiswa dan desain digital</p>
    
    <div class="meta-container">
        <div class="glass-box">
            <img src="<?php echo e(asset('assets/Asset - Kalender.png')); ?>" alt="date" style="width:14px;">
            <span>33 Februari, 2026</span>
        </div>
        <div class="glass-box">
            <img src="<?php echo e(asset('assets/Asset - Lokasi.png')); ?>" alt="location" style="width:14px;">
            <span>Aula Lantai 4, Gedung BG</span>
        </div>
    </div>
</div>

        </main>
    </div>

</body>
</html><?php /**PATH D:\DOKUMEN KULIAH\Tugas Kuliah\SEMESTER 4\Sistem Informasi\Tugas kelompok\PROJECT_SISFOR-main\PROJECT_SISFOR-main\resources\views/public/landingpage_public.blade.php ENDPATH**/ ?>