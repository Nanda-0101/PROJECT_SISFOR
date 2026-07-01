<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - SIVENTUS</title>
    
    @vite(['resources/css/pembayaran.css'])
</head>
<body>

<div class="payment-wrapper">
    <div class="payment-card">
        <!-- Header -->
        <div class="payment-header">
            <div class="payment-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                    <line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
            </div>
            <h1>Pembayaran Event</h1>
            <p class="subtitle">Silakan selesaikan pembayaran Anda</p>
        </div>

        <!-- Info Event -->
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Event</span>
                <span class="info-value">{{ $namaEvent }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran</span>
                <span class="info-value">{{ $metode->nama_metode ?? 'QRIS' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Pembayaran</span>
                <span class="info-value amount">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Kode Pembayaran -->
        <div class="payment-code-box">
            <div class="code-label">Kode Pembayaran</div>
            <div class="code-display">{{ $kodePembayaran }}</div>
            <button class="btn-copy" onclick="copyCode()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                </svg>
                Salin Kode
            </button>
        </div>

        <!-- QR Code Simulasi -->
        <div class="qr-section">
            <div class="qr-label">Scan QR Code untuk Membayar</div>

            <p class="qr-hint">Gunakan aplikasi pembayaran untuk scan QR Code di atas</p>
        </div>

        <!-- Metode Pembayaran Detail -->
        <div class="metode-detail">
            <div class="metode-icon">
                @if($metode->tipe == 'qris')
                    <span class="badge-qris">QRIS</span>
                @elseif($metode->tipe == 'ewallet')
                    <span class="badge-ewallet">E-Wallet</span>
                @else
                    <span class="badge-va">Virtual Account</span>
                @endif
            </div>
            <div>
                <div class="metode-name">{{ $metode->nama_metode ?? 'QRIS' }}</div>
                <div class="metode-desc">Silakan lakukan pembayaran melalui metode yang dipilih</div>
            </div>
        </div>

        <!-- Tombol Konfirmasi -->
        <div class="payment-actions">
            <form action="{{ route('payment.confirm') }}" method="POST">
                @csrf
                <input type="hidden" name="id_pembayaran" value="{{ $idPembayaran }}">
                <button type="submit" class="btn-confirm">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Konfirmasi Pembayaran
                </button>
            </form>
            <p class="note">* Setelah melakukan pembayaran, klik tombol di atas untuk konfirmasi</p>
        </div>

        <!-- Footer -->
        <div class="payment-footer">
            <p>Sistem Event Kampus &copy; 2026</p>
        </div>
    </div>
</div>

<script>
function copyCode() {
    const code = document.querySelector('.code-display').textContent;
    navigator.clipboard.writeText(code).then(() => {
        const btn = document.querySelector('.btn-copy');
        const originalText = btn.innerHTML;
        btn.innerHTML = `
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Tersalin!
        `;
        btn.style.background = '#10b981';
        btn.style.color = 'white';
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = '';
            btn.style.color = '';
        }, 2000);
    });
}
</script>

</body>
</html>