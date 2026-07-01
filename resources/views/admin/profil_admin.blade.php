<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Event Kampus - Profil Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/profil_admin.css'])
</head>
<body>

<div class="d-flex min-vh-100 layout-wrapper">
    {{-- ========== SIDEBAR ========== --}}
    <aside class="sidebar d-flex flex-column">
        <div class="sidebar-brand d-flex align-items-center gap-3 mb-5">
            <img src="{{ asset('assets/Logo - SIVENTUS.png') }}" alt="Logo SIVENTUS" class="brand-logo">
            <div class="brand-text d-flex flex-column justify-content-center">
                <div class="mb-0 text-white fw-bold" style="font-size: 16px;">SISTEM EVENT KAMPUS</div>
                <p class="mb-0" style="font-size: 12px;">Multi Event & Sharing Session</p>
            </div>
        </div>
        
        <div class="sidebar-menu flex-grow-1">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Dashboard Panitia.png') }}" alt="Dashboard" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Dashboard Admin</span></div>
            </a>
            <a href="{{ route('admin.buat.event') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Buat Event Siderbar.png') }}" alt="Buat Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Buat Event</span></div>
            </a>
            <a href="{{ route('admin.kelola.event') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Event.png') }}" alt="Kelola Event" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Event</span></div>
            </a>
            <a href="{{ route('admin.kelola.panitia') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Panitia.png') }}" alt="Kelola Panitia" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Panitia</span></div>
            </a>
            <a href="{{ route('admin.kelola.admin') }}" class="menu-item">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Kelola Admin.png') }}" alt="Kelola Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Kelola Admin</span></div>
            </a>
            <a href="{{ route('admin.profil') }}" class="menu-item active">
                <div class="menu-icon-wrapper"><img src="{{ asset('assets/Asset - Profil Panitia.png') }}" alt="Profil Admin" class="menu-icon"></div>
                <div class="menu-text-wrapper"><span>Profil Admin</span></div>
            </a>
        </div>

        <div class="sidebar-footer mt-auto">
            <a href="{{ route('admin.logout') }}" class="btn-logout-sidebar w-100 d-flex justify-content-center align-items-center gap-2" style="text-decoration:none;">
                <i class="bi bi-box-arrow-right fs-5 text-info"></i> Log Out
            </a>
        </div>
    </aside>
    {{-- ========== END SIDEBAR ========== --}}

    <main class="content-area flex-grow-1">

        {{-- Welcome Banner --}}
        <div class="welcome-banner d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Profil Admin</h4>
                <p class="mb-0 text-white-50">Kelola informasi pribadi dan pengaturan akun Anda</p>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- Kolom Kiri: Form --}}
            <div class="col-md-8">

                {{-- Avatar & Info Singkat --}}
                <div class="profile-header-card mb-4">
                    @php
                        $nama = $admin->nama_admin ?? 'Admin';
                        $namaParts = explode(' ', $nama);
                        $avatar = strtoupper(substr($namaParts[0], 0, 1));
                        if (isset($namaParts[1])) {
                            $avatar .= strtoupper(substr($namaParts[1], 0, 1));
                        }
                    @endphp
                    <div class="profile-avatar">
                        {{ $avatar }}
                    </div>
                    <div>
                        <div class="profile-info-name">{{ $admin->nama_admin }}</div>
                        <div class="profile-info-role">Administrator</div>
                        <div class="profile-info-email">{{ $admin->username }}</div>
                    </div>
                </div>

                {{-- Form Edit Profil --}}
                <div class="form-card bg-white rounded-3 shadow-sm border border-light">
                    <div class="form-card-body">
                        <form action="{{ route('admin.profil.update') }}" method="POST">
                            @csrf

                            {{-- Nama Admin (Readonly) --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Admin</label>
                                <div class="input-icon-wrapper">
                                    <i class="bi bi-person input-icon"></i>
                                    <input type="text"
                                           class="form-control custom-input"
                                           value="{{ $admin->nama_admin }}"
                                           readonly>
                                </div>
                            </div>

                            {{-- Username (Readonly) --}}
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <div class="input-icon-wrapper">
                                    <i class="bi bi-person-badge input-icon"></i>
                                    <input type="text"
                                           class="form-control custom-input"
                                           value="{{ $admin->username }}"
                                           readonly>
                                </div>
                            </div>

                            {{-- Divider --}}
                            <div class="form-section-label">
                                <span>Ubah Password</span>
                            </div>

                            {{-- Password Baru --}}
                            <div class="mb-3">
                                <label class="form-label">Password Baru <span style="color:#94A3B8; font-weight:400;">(opsional)</span></label>
                                <div class="input-password-wrapper">
                                    <input type="password"
                                           class="form-control custom-input @error('password') is-invalid @enderror"
                                           name="password"
                                           id="inputPassword"
                                           placeholder="Buat password baru">
                                    <button type="button" class="btn-toggle-pass" onclick="togglePassword('inputPassword', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div class="input-hint">
                                    <i class="bi bi-info-circle" style="font-size:12px;"></i>
                                    Minimal 4 karakter. Kosongkan jika tidak ingin mengubah.
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password --}}
                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-password-wrapper">
                                    <input type="password"
                                           class="form-control custom-input"
                                           name="password_confirmation"
                                           id="inputPasswordConfirm"
                                           placeholder="Ulangi password baru">
                                    <button type="button" class="btn-toggle-pass" onclick="togglePassword('inputPasswordConfirm', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn-simpan">
                                <i class="bi bi-check-lg me-2"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Info Akun --}}
            <div class="col-md-4">
                <div class="info-side-card">
                    <div class="info-side-title">Info Akun</div>

                    <div class="info-side-item">
                        <div class="info-side-icon"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <div class="info-side-label">Role</div>
                            <div class="info-side-value">Administrator</div>
                        </div>
                    </div>

                    <div class="info-side-item">
                        <div class="info-side-icon"><i class="bi bi-calendar-check"></i></div>
                        <div>
                            <div class="info-side-label">Bergabung</div>
                            <div class="info-side-value">
                                {{ \Carbon\Carbon::parse($admin->created_at)->isoFormat('D MMMM YYYY') }}
                            </div>
                        </div>
                    </div>

                    <div class="info-side-item">
                        <div class="info-side-icon"><i class="bi bi-clock-history"></i></div>
                        <div>
                            <div class="info-side-label">Login Terakhir</div>
                            <div class="info-side-value">Hari ini</div>
                        </div>
                    </div>

                    <div class="info-side-item">
                        <div class="info-side-icon"><i class="bi bi-toggle-on"></i></div>
                        <div>
                            <div class="info-side-label">Status Akun</div>
                            <div class="info-side-value" style="color:#059669;">Aktif</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>

<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>