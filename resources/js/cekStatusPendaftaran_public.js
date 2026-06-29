'use strict';

/* ================================================
   MOCK DATA — BACKEND TOLONG GANTI Y HIDUP JOKOWI
   ================================================ */
const mockData = [
    {
        nim: '2201010043',
        email: 'budi.santoso@student.ac.id',
        event: 'grand-tech',
        nama: 'Budi Santoso',
        wa: '081234567890',
        sesi: 'Sesi Pagi — AI (08.00–12.00)',
        kategori: 'Internal Kampus',
        tanggal: '12 Juni 2026',
        status: 'diterima',
        ticket: 'EVT-2026-00432',
    },
    {
        nim: '2201020087',
        email: 'siti.rahayu@student.ac.id',
        event: 'workshop-uiux',
        nama: 'Siti Rahayu',
        wa: '082198765432',
        sesi: 'Sesi Penuh (09.00–17.00)',
        kategori: 'Internal Kampus',
        tanggal: '15 Juni 2026',
        status: 'pending',
        ticket: null,
    },
    {
        nim: '2201030011',
        email: 'alex.wijaya@student.ac.id',
        event: 'seminar-ai',
        nama: 'Alex Wijaya',
        wa: '085611223344',
        sesi: 'Sesi Siang — Full',
        kategori: 'Umum',
        tanggal: '10 Juni 2026',
        status: 'ditolak',
        alasan: 'Kuota sesi yang dipilih sudah penuh.',
        ticket: null,
    },
];

/* ================================================
   ELEMEN DOM
   ================================================ */
const btnCek         = document.getElementById('btnCek');
const btnTryAgain    = document.getElementById('btnTryAgain');
const searchInput    = document.getElementById('searchInput');
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
        c.style.display = 'none';
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

function fetchStatus(nimOrEmail, eventId) {
    return new Promise((resolve) => {
        // Simulasi network delay
        setTimeout(() => {
            const query = nimOrEmail.trim().toLowerCase();
            const found = mockData.find(d =>
                (d.nim === query || d.email.toLowerCase() === query) &&
                d.event === eventId
            );
            resolve(found || null);
        }, 1400);
    });
}

/* ================================================
   RENDER HASIL
   ================================================ */
function renderDiterima(data) {
    document.getElementById('resultNama').textContent     = data.nama;
    document.getElementById('resultNIM').textContent      = data.nim;
    document.getElementById('resultEmail').textContent    = data.email;
    document.getElementById('resultWA').textContent       = data.wa || '—';
    document.getElementById('resultEvent').textContent    = eventSelect.options[eventSelect.selectedIndex].text;
    document.getElementById('resultSesi').textContent     = data.sesi;
    document.getElementById('resultKategori').textContent = data.kategori;
    document.getElementById('resultTanggal').textContent  = data.tanggal;
    document.getElementById('resultTicket').textContent   = data.ticket;
    cardDiterima.style.display = 'block';
}

function renderPending(data) {
    document.getElementById('pendingNama').textContent  = data.nama;
    document.getElementById('pendingNIM').textContent   = data.nim;
    document.getElementById('pendingEvent').textContent = eventSelect.options[eventSelect.selectedIndex].text;
    document.getElementById('pendingSesi').textContent  = data.sesi;
    cardPending.style.display = 'block';
}

function renderDitolak(data) {
    document.getElementById('ditolakNama').textContent   = data.nama;
    document.getElementById('ditolakNIM').textContent    = data.nim;
    document.getElementById('ditolakEvent').textContent  = eventSelect.options[eventSelect.selectedIndex].text;
    document.getElementById('ditolakAlasan').textContent = data.alasan || 'Tidak ada keterangan.';
    cardDitolak.style.display = 'block';
}

function renderNotFound() {
    cardNotFound.style.display = 'block';
}

/* ================================================
   VALIDASI INPUT
   ================================================ */
function validate() {
    const val = searchInput.value.trim();
    const evt = eventSelect.value;

    if (!val) {
        searchInput.focus();
        searchInput.style.borderColor = '#ef4444';
        searchInput.style.boxShadow   = '0 0 0 4px rgba(239,68,68,0.1)';
        setTimeout(() => {
            searchInput.style.borderColor = '';
            searchInput.style.boxShadow   = '';
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
   Tombol Cek
   ================================================ */
async function handleCek() {
    if (!validate()) return;

    const nimOrEmail = searchInput.value.trim();
    const eventId    = eventSelect.value;

    showSkeleton();
    scrollToResult();

    const data = await fetchStatus(nimOrEmail, eventId);

    hideSkeleton();
    hideAllCards();

    if (!data) {
        renderNotFound();
        return;
    }

    if (data.status === 'diterima') renderDiterima(data);
    else if (data.status === 'pending') renderPending(data);
    else if (data.status === 'ditolak') renderDitolak(data);
    else renderNotFound();
}

/* ================================================
    Tombol Coba Lagi
   ================================================ */
function handleTryAgain() {
    resultArea.style.display = 'none';
    hideAllCards();
    searchInput.value  = '';
    eventSelect.value  = '';
    searchInput.focus();

    // Scroll ke form
    document.querySelector('.search-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/* ================================================
   REGISTER EVENTS
   ================================================ */
btnCek.addEventListener('click', handleCek);
btnTryAgain.addEventListener('click', handleTryAgain);

// Juga trigger saat Enter di input
searchInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') handleCek();
});