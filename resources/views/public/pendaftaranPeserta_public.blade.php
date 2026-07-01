<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta</title>

    @vite([
        'resources/css/pendaftaranpeserta.css',
        'resources/js/pendaftaranpeserta.js'
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
                <a href="{{ route('landing.page') }}" class="menu-item">
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

                <a href="{{ url('/cekstatuspendaftaran-peserta') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Cek Status Pendaftaran.png') }}" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        Cek Status Pendaftaran
                    </div>
                </a>

                <a href="{{ route('admin.login') }}" class="menu-item">
                    <div class="menu-icon-wrapper">
                        <img src="{{ asset('assets/Asset - Login Admin.png') }}" class="menu-icon">
                    </div>
                    <div class="menu-text-wrapper">
                        Login Admin
                    </div>
                </a>
            </nav>
        </div>
    </aside>

    <!-- ================= CONTENT ================= -->
    <main class="main-content">
        <div class="form-card">
            <span class="badge-tag">FORM PUBLIK</span>
            <h2>Input Formulir Pendaftaran</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form id="formPendaftaran" method="POST" action="{{ route('pendaftaran.store') }}">
                @csrf

                <!-- ==================== PILIH EVENT ==================== -->
                <div class="form-group">
                    <label>Pilih Event <span>*</span></label>
                    <select id="pilihEvent" name="id_event" required>
                        <option value="">-- Pilih Event --</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id_event }}" 
                                    data-jenis="{{ $event->jenis_event }}" 
                                    data-biaya="{{ $event->biaya }}">
                                {{ $event->nama_event }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- ==================== PILIH SESI ==================== -->
                <div class="form-group" id="sesiContainer" style="display:none;">
                    <label>Pilih Sesi <span>*</span></label>
                    <select id="pilihSesi" name="id_sesi" required>
                        <option value="">-- Pilih Sesi --</option>
                    </select>
                    <div id="kuotaInfo" class="kuota-info"></div>
                    <div id="kategoriInfo" class="kategori-info"></div>
                </div>

                <!-- ==================== DYNAMIC FIELDS ==================== -->
                <div id="fieldsContainer" style="display:none;">
                    <div class="divider">
                        <span>Data Peserta</span>
                    </div>
                    <div id="dynamicFields"></div>
                </div>

                <!-- ==================== METODE PEMBAYARAN (Jika Berbayar) ==================== -->
                <div id="paymentContainer" style="display:none;">
                    <div class="divider">
                        <span>Metode Pembayaran</span>
                    </div>

                    <div class="form-group">
                        <label>Pilih Metode Pembayaran <span>*</span></label>
                        <select id="metodePembayaran" name="metode_pembayaran">
                            <option value="">-- Pilih Metode --</option>
                            @foreach($metodePembayaran as $metode)
                                <option value="{{ $metode->id_metode }}">
                                    {{ $metode->nama_metode }} ({{ strtoupper($metode->tipe) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="payment-summary">
                        <div class="payment-label">Total Biaya</div>
                        <div class="payment-amount" id="totalBiaya">Rp 0</div>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="btnDaftar">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formPendaftaran');

    // ============================================================
    // PILIH EVENT → LOAD SESI
    // ============================================================
    document.getElementById('pilihEvent').addEventListener('change', function() {
        const eventId = this.value;
        const sesiContainer = document.getElementById('sesiContainer');
        const sesiSelect = document.getElementById('pilihSesi');
        const fieldsContainer = document.getElementById('fieldsContainer');

        if (!eventId) {
            sesiContainer.style.display = 'none';
            fieldsContainer.style.display = 'none';
            document.getElementById('paymentContainer').style.display = 'none';
            return;
        }

        sesiContainer.style.display = 'block';
        sesiSelect.innerHTML = '<option value="">Loading sesi...</option>';
        document.getElementById('kuotaInfo').textContent = '';
        document.getElementById('kategoriInfo').textContent = '';
        fieldsContainer.style.display = 'none';
        document.getElementById('paymentContainer').style.display = 'none';

        fetch(`/api/event/${eventId}/sesi`)
            .then(response => response.json())
            .then(data => {
                sesiSelect.innerHTML = '<option value="">-- Pilih Sesi --</option>';
                data.forEach(sesi => {
                    const option = document.createElement('option');
                    option.value = sesi.id_sesi;
                    option.dataset.kategori = sesi.id_kategori;
                    option.dataset.namaKategori = sesi.nama_kategori;
                    option.dataset.kuota = sesi.kuota_maksimal;
                    option.textContent = `${sesi.nama_sesi} (${sesi.nama_kategori}) - Kuota: ${sesi.kuota_maksimal}`;
                    sesiSelect.appendChild(option);
                });
            });
    });

    // ============================================================
    // PILIH SESI → LOAD FIELDS & TAMPILKAN KATEGORI
    // ============================================================
    document.getElementById('pilihSesi').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const kategoriId = selectedOption.dataset.kategori;
        const namaKategori = selectedOption.dataset.namaKategori;
        const kuota = selectedOption.dataset.kuota;
        const fieldsContainer = document.getElementById('fieldsContainer');

        if (!kategoriId) {
            fieldsContainer.style.display = 'none';
            document.getElementById('paymentContainer').style.display = 'none';
            return;
        }

        // Tampilkan info kategori dan kuota
        document.getElementById('kategoriInfo').textContent = `Kategori: ${namaKategori}`;
        document.getElementById('kuotaInfo').textContent = `Kuota: ${kuota} peserta`;

        fieldsContainer.style.display = 'block';

        // Load fields berdasarkan kategori
        fetch(`/api/kategori/${kategoriId}/fields`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('dynamicFields');
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-muted">Tidak ada field untuk kategori ini.</p>';
                    return;
                }

                data.forEach(field => {
                    const group = document.createElement('div');
                    group.className = 'form-group';

                    const label = document.createElement('label');
                    label.textContent = field.nama_field;
                    if (field.wajib) {
                        const span = document.createElement('span');
                        span.textContent = ' *';
                        label.appendChild(span);
                    }
                    group.appendChild(label);

                    let input;
                    const tipe = field.tipe_field;

                    if (tipe === 'textarea') {
                        input = document.createElement('textarea');
                        input.rows = 3;
                    } else if (tipe === 'number') {
                        input = document.createElement('input');
                        input.type = 'number';
                    } else if (tipe === 'email') {
                        input = document.createElement('input');
                        input.type = 'email';
                    } else if (tipe === 'tel') {
                        input = document.createElement('input');
                        input.type = 'tel';
                    } else if (tipe === 'date') {
                        input = document.createElement('input');
                        input.type = 'date';
                    } else {
                        input = document.createElement('input');
                        input.type = 'text';
                    }

                    input.name = `fields[${field.id_field}]`;
                    input.className = 'form-control';
                    input.placeholder = `Masukkan ${field.nama_field.toLowerCase()}`;
                    if (field.wajib) input.required = true;

                    group.appendChild(input);
                    container.appendChild(group);
                });

                // Cek apakah event berbayar
                const eventSelect = document.getElementById('pilihEvent');
                const selectedEvent = eventSelect.options[eventSelect.selectedIndex];
                const jenisEvent = selectedEvent.dataset.jenis;
                const biaya = selectedEvent.dataset.biaya;

                const paymentContainer = document.getElementById('paymentContainer');
                const metodeSelect = document.getElementById('metodePembayaran');

                if (jenisEvent === 'berbayar') {
                    paymentContainer.style.display = 'block';
                    document.getElementById('totalBiaya').textContent =
                        `Rp ${parseInt(biaya).toLocaleString('id-ID')}`;
                    metodeSelect.required = true;
                } else {
                    paymentContainer.style.display = 'none';
                    metodeSelect.required = false;
                }
            });
    });

    // ============================================================
    // VALIDASI FORM
    // ============================================================
    form.addEventListener('submit', function(e) {
        const eventSelect = document.getElementById('pilihEvent');
        const sesiSelect = document.getElementById('pilihSesi');

        if (!eventSelect.value) {
            e.preventDefault();
            alert('Silakan pilih event terlebih dahulu!');
            return;
        }

        if (!sesiSelect.value) {
            e.preventDefault();
            alert('Silakan pilih sesi terlebih dahulu!');
            return;
        }

        // Cek apakah ada field yang kosong
        const fields = document.querySelectorAll('#dynamicFields input, #dynamicFields textarea, #dynamicFields select');
        let empty = false;
        fields.forEach(field => {
            if (field.hasAttribute('required') && !field.value.trim()) {
                empty = true;
                field.style.borderColor = '#dc2626';
            } else {
                field.style.borderColor = '';
            }
        });

        if (empty) {
            e.preventDefault();
            alert('Silakan lengkapi semua field yang wajib diisi!');
            return;
        }

        // Cek pembayaran jika berbayar
        const paymentContainer = document.getElementById('paymentContainer');
        if (paymentContainer.style.display !== 'none') {
            const metode = document.getElementById('metodePembayaran');
            if (!metode.value) {
                e.preventDefault();
                alert('Silakan pilih metode pembayaran!');
                return;
            }
        }
    });
});
</script>

</body>
</html>