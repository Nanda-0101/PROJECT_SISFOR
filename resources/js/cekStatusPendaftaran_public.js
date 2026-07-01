'use strict';

/* ================================================
   ELEMEN DOM
   ================================================ */
const btnCek         = document.getElementById('btnCek');
const btnTryAgain    = document.getElementById('btnTryAgain');
const emailInput     = document.getElementById('emailInput');
const eventSelect    = document.getElementById('eventSelect');
const resultArea     = document.getElementById('resultArea');
const skeletonLoader = document.getElementById('skeletonLoader');

const cardDiterima   = document.getElementById('cardDiterima');
const cardPending    = document.getElementById('cardPending');
const cardDitolak    = document.getElementById('cardDitolak');
const cardNotFound   = document.getElementById('cardNotFound');

/* ================================================
   HELPERS
   ================================================ */

function hideAllCards() {
    [cardDiterima, cardPending, cardDitolak, cardNotFound].forEach(c => {
        if (c) c.style.display = 'none';
    });
}

function showSkeleton() {
    resultArea.style.display = 'block';
    skeletonLoader.style.display = 'block';
    hideAllCards();
}

function hideSkeleton() {
    skeletonLoader.style.display = 'none';
}

function scrollToResult() {
    resultArea.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

/* ================================================
   RENDER HASIL
   ================================================ */
function renderDiterima(data) {
    document.getElementById('resultNama').textContent     = data.nama || '—';
    document.getElementById('resultNIM').textContent      = data.nim || '—';
    document.getElementById('resultEmail').textContent    = data.email || '—';
    document.getElementById('resultWA').textContent       = data.whatsapp || '—';
    document.getElementById('resultEvent').textContent    = data.nama_event || '—';
    document.getElementById('resultSesi').textContent     = data.nama_sesi || '—';
    document.getElementById('resultKategori').textContent = data.nama_kategori || '—';
    document.getElementById('resultTanggal').textContent  = data.waktu_daftar ? new Date(data.waktu_daftar).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '—';
    document.getElementById('resultTicket').textContent   = data.kode_pendaftaran || '—';
    cardDiterima.style.display = 'block';
}

function renderPending(data) {
    const isPembayaran = data.status_pendaftaran === 'menunggu_pembayaran';
    
    document.getElementById('pendingNama').textContent  = data.nama || '—';
    document.getElementById('pendingNIM').textContent   = data.nim || '—';
    document.getElementById('pendingEvent').textContent = data.nama_event || '—';
    document.getElementById('pendingSesi').textContent  = data.nama_sesi || '—';
    
    const titleEl = document.getElementById('pendingTitle');
    const msgEl = document.getElementById('pendingMessage');
    
    if (isPembayaran) {
        titleEl.textContent = 'MENUNGGU PEMBAYARAN';
        msgEl.textContent = 'Silakan selesaikan pembayaran Anda. Kode pembayaran akan dikirim ke email Anda.';
    } else {
        titleEl.textContent = 'MENUNGGU VERIFIKASI';
        msgEl.textContent = 'Pendaftaranmu sedang dalam proses verifikasi oleh panitia. Harap menunggu konfirmasi lebih lanjut melalui email.';
    }
    
    cardPending.style.display = 'block';
}

function renderDitolak(data) {
    document.getElementById('ditolakNama').textContent  = data.nama || '—';
    document.getElementById('ditolakNIM').textContent   = data.nim || '—';
    document.getElementById('ditolakEvent').textContent = data.nama_event || '—';
    document.getElementById('ditolakSesi').textContent  = data.nama_sesi || '—';
    cardDitolak.style.display = 'block';
}

function renderNotFound() {
    cardNotFound.style.display = 'block';
}

/* ================================================
   VALIDASI INPUT
   ================================================ */
function validate() {
    const val = emailInput.value.trim();
    const evt = eventSelect.value;

    if (!val) {
        emailInput.focus();
        emailInput.style.borderColor = '#ef4444';
        emailInput.style.boxShadow   = '0 0 0 4px rgba(239,68,68,0.1)';
        setTimeout(() => {
            emailInput.style.borderColor = '';
            emailInput.style.boxShadow   = '';
        }, 2000);
        return false;
    }

    if (!evt) {
        eventSelect.focus();
        eventSelect.style.borderColor = '#ef4444';
        eventSelect.style.boxShadow   = '0 0 0 4px rgba(239,68,68,0.1)';
        setTimeout(() => {
            eventSelect.style.borderColor = '';
            eventSelect.style.boxShadow   = '';
        }, 2000);
        return false;
    }

    return true;
}

/* ================================================
   CEK STATUS VIA AJAX
   ================================================ */
async function handleCek() {
    if (!validate()) return;

    const email = emailInput.value.trim();
    const idEvent = eventSelect.value;

    showSkeleton();
    scrollToResult();

    try {
        const response = await fetch('/cek-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                email: email,
                id_event: idEvent
            })
        });

        const result = await response.json();

        hideSkeleton();
        hideAllCards();

        if (!result.success) {
            renderNotFound();
            return;
        }

        const data = result.data;

        if (data.status_pendaftaran === 'terdaftar') {
            renderDiterima(data);
        } else if (data.status_pendaftaran === 'menunggu_verifikasi' || data.status_pendaftaran === 'menunggu_pembayaran') {
            renderPending(data);
        } else if (data.status_pendaftaran === 'dibatalkan') {
            renderDitolak(data);
        } else {
            renderNotFound();
        }

    } catch (error) {
        console.error('Error:', error);
        hideSkeleton();
        hideAllCards();
        renderNotFound();
    }
}

/* ================================================
   COBA LAGI
   ================================================ */
function handleTryAgain() {
    resultArea.style.display = 'none';
    hideAllCards();
    emailInput.value  = '';
    eventSelect.value  = '';
    emailInput.focus();
    document.querySelector('.search-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/* ================================================
   REGISTER EVENTS
   ================================================ */
btnCek.addEventListener('click', handleCek);
btnTryAgain.addEventListener('click', handleTryAgain);

// Enter key di input
emailInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') handleCek();
});

eventSelect.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') handleCek();
});